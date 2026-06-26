<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Senderid extends CI_Controller {

	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('senders');
        $this->load->model('user');
    }

	public function index()
	{
        $data["userList"] = $this->user->getEnterpriseUsers();
		$this->load->view('sender',$data);
	}


	public function editGroup($id){
        $data =  array();
        $data["contentData"] = $this->senders->getDataById($id);
        $data["userList"] = $this->user->getEnterpriseUsers();
        $this->load->view('/sender',$data);
	}

	 function deleteGroup($id){
        $getusers=$this->senders->delete($id);
        if($getusers){
            $this->session->set_flashdata('success', 'Sender has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting sender data!!!');
        }

        redirect(base_url('senderid')); 
    }

	public function get_group_tables(){
		$draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

         $user_id=$this->input->post("user");
      
        $getusers=$this->senders->getList($user_id);
        
        $mem = array();  

        foreach($getusers->result() as $r) {  

     
        $edit_url= base_url("senderid/editGroup/".$r->id);
        $delete_url= base_url("senderid/deleteGroup/".$r->id);

        $edit = '<a href="'.$edit_url.'" data-toggle="tooltip" title="Edit" class="fa fa-edit" style="padding-right:5px;"></a> ';
        $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>'; 
        	
        $mem[] = array(
            $r->id ,
            $r->sender_id ,
            $r->peid,
            $r->status,
            $edit.$delete
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
        $user_id = $this->input->post('user_id');
        $data = array();
		// print_r($_POST);die;
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
                                    'user_id'=>$this->input->post('user_id'),
                                    'sender_id'=>$row[0],
                                    'peid'=>$row[1],
                                    'status'=>1,
                              );
                            }
                            $i++;
                        }
                       
                       
                     }
                  }
            }
        }else{
            $data[0]= array(
                    'user_id'=>$this->input->post('user_id'),
                    'sender_id'=>$this->input->post('sender_id'),
                    'peid'=>$this->input->post('peid'),
                    'status'=>1,
              );
        }
        
        if(!empty($this->input->post("eid"))){
             $data = array(
                    'user_id'=>$this->input->post('user_id'),
                    'sender_id'=>$this->input->post('sender_id'),
                    'peid'=>$this->input->post('peid'),
                    'status'=>1,
              );
            $getusers=$this->senders->edit($data,$this->input->post("eid"));
        }else{

            $getusers=$this->senders->save($data);
        }

        if($getusers){
            $this->session->set_flashdata('success', 'Sender has been created successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while creating sender!!!');
        }

        redirect(base_url('senderid'));
	}

	
}