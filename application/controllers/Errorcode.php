<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errorcode extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('whitelabels');
        $this->load->model('errorcodes');
        $this->load->model('user');
        is_login();
    }

     function index(){
        $data = array();
        $data['smsclist'] = $this->errorcodes->getAllSmscList();
        $data["userList"] = $this->user->getEnterpriseUsers();
        $this->load->view('errorcode',$data);
    }

    public function getAccountList(){
        $user_id = $this->input->post('user_id');
        $typeValues = $this->user->getAccountByUserChain($user_id);
        echo '<option value="">Select Account</option>';
        echo '<option value="0">ALL</option>';
        foreach ($typeValues as $value) {
            echo '<option value="'.$value['system_id'].'">'.ucfirst(strtolower($value['system_id'])).'</option>';
        }
    }

    function edit($id){
        $data =  array();
        $user_id=$this->session->userdata("userId");
        $data["user_id"] = $user_id;
        $data['smsclist'] = $this->errorcodes->getAllSmscList();
        $data["contentData"] = $this->errorcodes->getDetailById($id);

        $this->load->view('errorcode',$data);
    }

    function saveDetails(){

        $data = array();

        if($this->input->post("eid")){
            $data = array(
                  'smsc_id'=>$this->input->post('smsc_id'),
                  'actual_err_code'=>$this->input->post('actual_err_code'),
                  'updated_err_code'=>$this->input->post('updated_err_code'),
                  'description'=>$this->input->post('description'),
                  'user_chain'=>$this->input->post('user_id'),
                  'account'=>$this->input->post('user_account_id'),
            );
            $getusers=$this->errorcodes->edit($data,$this->input->post("eid"));

         }else{
              if($this->input->post('create_by')==1){
                   if(file_exists($_FILES['file']['tmp_name']) || is_uploaded_file($_FILES['file']['tmp_name'])){

                        $randString = md5(time()); 
                        $fileName = $_FILES["file"]["name"]; 
                        $splitName = explode(".", $fileName); 
                        $fileExt = end($splitName); 
                        $tmpName = $_FILES['file']['tmp_name'];
                        $i=0;
                         if($fileExt === 'csv'){
                           if(($handle = fopen($tmpName, 'r')) !== FALSE) {
                              while(($row = fgetcsv($handle)) !== FALSE) {
                                  if($i!=0){
                                   $data[$i-1] = array(
                                          'smsc_id'=>$this->input->post('smsc_id'),
                                          'description'=>$this->input->post('description'),
                                          'user_chain'=>$this->input->post('user_id'),
                                          'account'=>$this->input->post('user_account_id'),
                                          'actual_err_code'=>$row[0],
                                          'updated_err_code'=>$row[1],
                                          // 'status'=>1,
                                    );
                                  }
                                  $i++;
                              }
                          }
                        }
                  }
              }else{
                  $data[0]= array(
                          'smsc_id'=>$this->input->post('smsc_id'),
                          'actual_err_code'=>$this->input->post('actual_err_code'),
                          'updated_err_code'=>$this->input->post('updated_err_code'),
                          'description'=>$this->input->post('description'),
                          'user_chain'=>$this->input->post('user_id'),
                          'account'=>$this->input->post('user_account_id'),
                    );
              }
             
              $getusers=$this->errorcodes->save($data);
        }
        if($getusers){
            $this->session->set_flashdata('success', 'Details has been saved successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while saving the details!!!');
        }
       

        redirect(base_url('errorcode'));

    }

    function getList(){
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));   

      $getusers=$this->errorcodes->getTransaction();
      $mem = array();  
        $i=1;
        foreach($getusers->result() as $r) { 
           $edit_url= base_url("errorcode/edit/".$r->id);
           $delete_url= base_url("errorcode/delete/".$r->id);
           $edit = '<a href="'.$edit_url.'" data-toggle="tooltip" title="Edit" class="fa fa-edit" style="padding-right:5px;"></a> ';
           $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>';
          
           $mem[] = array(
                $i,
                $r->smsc,
                $r->updated_err_code,
                $r->updated_err_code,
                $edit . $delete
          );     
           $i++;
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

    function delete($id){
          $getusers=$this->errorcodes->delete($id);
         if($getusers){
            $this->session->set_flashdata('success', 'Error Code data has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting error code data!!!');
        }
         redirect(base_url('errorcode'));
    }
}