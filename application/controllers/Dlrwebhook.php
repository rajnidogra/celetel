<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dlrwebhook extends CI_Controller {

	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('dlrwebhooks');
        $this->load->model('user');
    }

	public function index()
	{
        $data["userList"] = $this->user->getEnterpriseUsers();
        $data["methodList"] = $this->user->getMethods();

        // print_r($data);die;
		$this->load->view('webhook',$data);
	}

    function getAccountList(){
        $user_id = $this->input->post('user_id');
        $typeValues = $this->user->getAccountByUser($user_id);
        // print_r($typeValues);die;
        echo '<option value="">Select Account</option>';
        foreach ($typeValues as $value) {
            echo '<option value="'.$value['id'].'">'.ucfirst(strtolower($value['system_id'])).'</option>';
        }
    }


	public function edit($id){
		$data =  array();
        $data["userList"] = $this->user->getEnterpriseUsers();
        $data["methodList"] = $this->user->getMethods();
        $data["contentData"] = $this->dlrwebhooks->getListById($id);
        $this->load->view('/webhook',$data);
	}

	 function delete($id){
         $getusers=$this->dlrwebhooks->delete($id);
         if($getusers){
            $this->session->set_flashdata('success', 'Webhook has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting webhook data!!!');
        }

        redirect(base_url('dlrwebhook'));
    }

	public function get_tables(){
		$draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        $user_id=$this->session->userdata("userId");
      
        $getusers=$this->dlrwebhooks->getList();
        
        $mem = array();  

        foreach($getusers->result() as $r) {  

     
        $edit_url= base_url("dlrwebhook/edit/".$r->id);
        $delete_url= base_url("dlrwebhook/delete/".$r->id);

        $edit = '<a href="'.$edit_url.'" data-toggle="tooltip" title="Edit" class="fa fa-edit" style="padding-right:5px;"></a> ';
        $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>'; 
        	
        $mem[] = array(
            $r->id ,
            $r->user_id,
            $r->user_account_id,
            $r->method,
            $r->url,
            $r->body,
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
		$data = array(
                'user_id'=>$this->input->post('user_id'),
                'user_account_id'=>$this->input->post('user_account_id'),
                'method'=>$this->input->post('method'),
                'url'=>$this->input->post('url'),
                'body'=>$this->input->post('body'),
          );
        // print_r($_POST);die;
        if($this->input->post("eid")){
            $getusers=$this->dlrwebhooks->edit($data,$this->input->post("eid"));
        }else{
            $getusers=$this->dlrwebhooks->save($data);
        }

        if($getusers){
            $this->session->set_flashdata('success', 'Webhook has been created successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while creating webhook!!!');
        }

        redirect(base_url('dlrwebhook'));
	}

	
}