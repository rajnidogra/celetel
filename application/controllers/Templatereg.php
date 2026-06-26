<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Templatereg extends CI_Controller {

	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('templateregs');
        $this->load->model('user');
    }

	public function index()
	{  
        $data =  array();
        $data["userList"] = $this->user->getEnterpriseUsers();
		$this->load->view('template',$data);
	}


    function getSenderIdList(){
        $user_id = $this->input->post('user_id');
        $senderList = $this->templateregs->getSenderList($user_id);

        echo '<option>Select Sender Id</option>';
        foreach ($senderList as $value) {
            echo '<option value="'.$value["sender_id"].'^'.$value["peid"].'">'.$value["sender_id"].'</option>';
        }
        
    }

    public function edit($id){
        $data =  array();
        $user_id=$this->session->userdata("userId");
        $data["senderList"] = $this->templateregs->getSenderList($user_id);
        $data["userList"] = $this->user->getEnterpriseUsers();
        $data["contentData"] = $this->templateregs->getListById($id);

        $this->load->view('/template',$data);
    }

     function delete($id){
         $getusers=$this->templateregs->delete($id);
         if($getusers){
            $this->session->set_flashdata('success', 'Group has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting group data!!!');
        }
        getDATAURL("SAVE_TEMPLATE");
        redirect(base_url('templatereg'));
    }

    public function get_group_tables(){
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        $user_id=$this->input->post("user");
      
        $getusers=$this->templateregs->getList($user_id);
        
        $mem = array();  

        foreach($getusers->result() as $r) {  

     
        $edit_url= base_url("templatereg/edit/".$r->id);
        $delete_url= base_url("templatereg/delete/".$r->id);

        $edit = '<a href="'.$edit_url.'" data-toggle="tooltip" title="Edit" class="fa fa-edit" style="padding-right:5px;"></a> ';
        $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>'; 
            
        $mem[] = array(
            $r->id ,
            $r->sender,
            $r->template,
            $r->contentid,
            $r->peid,
            $r->tmid,
            // $edit.$delete
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

    public function save(){
        $user = $this->input->post('user_id');
        // $ex = explode("^",$userData);
        // $user = $ex[1];

        $senderCom = $this->input->post('sender_id');

        // print_r($senderCom);die;
        $data = array();
        $i=0;
        foreach ($senderCom as $value) {
            $exSend = explode("^",$value);
            $sender = $exSend[0];
            $peid = $exSend[1];
            if($this->input->post('create_by')==1){
                if(file_exists($_FILES['file']['tmp_name']) || is_uploaded_file($_FILES['file']['tmp_name'])){
                      $randString = randFunction(); 
                      $fileName = $_FILES["file"]["name"]; 
                      $splitName = explode(".", $fileName); 
                      $fileExt = end($splitName); 
                      $tmpName = $_FILES['file']['tmp_name'];
                       if($fileExt === 'csv'){
                         if(($handle = fopen($tmpName, 'r')) !== FALSE) {
                            while(($row = fgetcsv($handle)) !== FALSE) {
                                if($i!=0){
                                 $data[$i-1] = array(
                                            'user_id'=>$user,
                                            'sender'=>$sender,
                                            'peid'=>$peid,
                                            'template'=>$row[0],
                                            'contentid'=>$row[1],
                                            'tmid'=>$row[2],
                                      );
                                }
                                $i++;
                            }
                        }
                      }
                }
            }else{
                 $data[$i] = array(
                    'user_id'=>$user,
                    'sender'=>$sender,
                    'peid'=>$peid,
                    'template'=>$this->input->post('template'),
                    'contentid'=>$this->input->post('contentid'),
                    'tmid'=>$this->input->post('tmid')
              );
              $i++;
            }
        }
        // echo "test";
        // print_r($data);die;
        if(count($data)){
            $getusers=$this->templateregs->saveBulk($data);
            // getDATAURL("SAVE_TEMPLATE");
            if($getusers){
                $this->session->set_flashdata('success', 'Templates has been created successfully.');
            }else{
                $this->session->set_flashdata('error', 'Error occured while creating templates!!!');
            }
        }

        redirect(base_url('templatereg'));
    }
}

