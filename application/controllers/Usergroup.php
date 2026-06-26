<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// ini_set('memory_limit', '8192M');
class Usergroup extends CI_Controller {

	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('usergroups');
        ini_set("display_error",1);
    }

    function index()
    {
        $data =  array();
        $user_id=$this->session->userdata("userId");
        $this->load->view('userGroup',$data);
    }

    function get_group_tables()
    {
        $user_id=$this->session->userdata("userId");
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   
        $getusers=$this->usergroups->getGroupList($user_id);
        // print_r($getusers->result());die;
        $mem = array();  
        foreach($getusers->result() as $r) {   
            $delete_url= base_url("usergroup/deletegroup/".$r->id);
            $download_url= base_url("usergroup/downloadContact/".$r->id);
            $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>';

            $download = '<a href="'.$download_url.'" data-toggle="tooltip" title="Download"  class="fa fa-download"  style="padding-right:5px; margin-left:5%;" ></a>';

            if($r->count==0){ $download = ""; }

             $mem[] = array(
                $r->id ,
                $r->groupname,
                $r->count."   ".$download,
                $r->created_date,
                $delete
            );     

        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $getusers->num_rows(),
            "recordsFiltered" => $getusers->num_rows(),
            "data" => $mem
        );

        echo json_encode($output);
        exit(); 

    }

    function addUserGroup(){
        $data =  array();
        $user_id=$this->session->userdata("userId");
        $data["user_id"] = $user_id;
        $this->load->view('addUsergroup',$data);
    }

    function addUserContact()
    {
        $data =  array();
        $user_id=$this->session->userdata("userId");
        $data["user_id"] = $user_id;
        $this->load->view('addUserContact',$data);
    }

    function saveGroupData($groupname){
        $data = array(
            'user_id'=>$this->session->userdata("userId"),
            'groupname'=>$groupname,
            'count'=>0,
            'isAddressbook'=>1
          );

        $getusers=$this->usergroups->saveUserGroupData($data);
        return $getusers;
        // if($getusers){
        //     $this->session->set_flashdata('success', 'User group has been created successfully.');
        // }else{
        //     $this->session->set_flashdata('error', 'Error occured while creating user group!!!');
        // }

        // redirect('usergroup'); 
    }

    function saveContactData(){
        if(!empty($this->input->post('groupname')) && $this->input->post('groupid')==0){
            $groupid = $this->saveGroupData($this->input->post('groupname'));
        }else{
            $groupid = $this->input->post('groupid');
        }
        if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name']))
          { 
            $randString = md5(time()); 
            $fileName = $_FILES["image"]["name"]; 
            $splitName = explode(".", $fileName); 
            $fileExt = end($splitName); 
            $newFileName  = strtolower($randString.'.'.$fileExt); 
            $move=move_uploaded_file( $_FILES['image']['tmp_name'],"images/".$newFileName);
           
            $image = "images/".$newFileName;
          }else{
            $image = "";
          }
          if($image){
              $fileData = fileApiLink($image,$fileExt);
              $fileData = json_decode($fileData,true);
              // print_r($fileData);die;
                if($fileData && $fileData){
                    $data = $fileData["data"];
                    $i = 0;
                    foreach ($data as $value) {
                        $data = $value;
                        $data = $data;
                        if(!empty($data) && $data !== "msisdn"){
                            $dataArr[$i] = array(
                                'user_id'=>$this->session->userdata("userId"),
                                'groupid' => $groupid,
                                'contact' => $data,
                                'var1'=>"",
                                'var2'=>"",
                                'var3'=>"",
                                'var4'=>"",
                            );
                            $i++;
                        }
                    }
                    $getusers=$this->usergroups->saveUserContctData($dataArr);
                    $updateCount = $this->usergroups->updateContactCount($groupid);
                    if($getusers){
                        $this->session->set_flashdata('success', 'User Contact has been added successfully.');
                    }else{
                        $this->session->set_flashdata('error', 'Error occured while adding user contact!!!');
                    }
                }
            }
        unlink($image);
        redirect('usergroup'); 
    }

    function getGroupList(){
        $user_id=$this->session->userdata("userId");
        $getusers=$this->usergroups->getGroupDetail($user_id);
        echo "<option value=''>Select Group Name</option>";
        foreach($getusers->result() as $r) { 
            echo "<option value='".$r->id."'>".$r->groupname."</option>";
         }
         echo "<option value='0'>New Group</option>";
    }

    function deletegroup($id){
        $res = $this->usergroups->deletegroupDetail($id);
        $res = $this->usergroups->deleteAddressBook($id);

        if($res){
            $this->session->set_flashdata('success', 'User group has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting routing data!!!');
        }
        redirect(base_url('usergroup')); 
    }

    function downloadContact($id){
        $res = $this->usergroups->downloadAddressBook($id);

        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"Sent_Data_Report".".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        $handle = fopen('php://output', 'w');

        $fields = array('Contact No');

        fputcsv($handle, $fields);
        foreach ($res->result_array() as $data_array) {
            fputcsv($handle, $data_array);
        }
        fclose($handle);
        exit;


        redirect(base_url("sentDump"));
    }
}