<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dlrrepush extends CI_Controller {

	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('dlrrepushs');
        $this->load->model('user');
    }

	public function index()
	{
        $data = array();
        $data["userList"] = $this->user->getEnterpriseUsers();

		$this->load->view('repush',$data);
	}

    public function getAccountList(){
        $user_id = $this->input->post('user_id');
        $typeValues = $this->user->getAccountByUser($user_id);
        echo '<option value="">Select Account</option>';
        foreach ($typeValues as $value) {
            echo '<option value="'.$value['system_id'].'">'.ucfirst(strtolower($value['system_id'])).'</option>';
        }
    }


	public function edit($id){
		$data =  array();
        $data["userList"] = $this->user->getEnterpriseUsers();
        $data["contentData"] = $this->dlrrepushs->getListById($id);
        $this->load->view('/repush',$data);
	}

	 function delete($id){
         $getusers=$this->dlrrepushs->delete($id);
         if($getusers){
            $this->session->set_flashdata('success', 'Webhook has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting webhook data!!!');
        }

        redirect(base_url('dlrrepush'));
    }

	public function get_tables(){
		$draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        $user_id=$this->session->userdata("userId");
      
        $getusers=$this->dlrrepushs->getList();
        
        $mem = array();  

        foreach($getusers->result() as $r) {  

     
        // $edit_url= base_url("dlrrepush/edit/".$r->id);
        // $delete_url= base_url("dlrrepush/delete/".$r->id);

        // $edit = '<a href="'.$edit_url.'" data-toggle="tooltip" title="Edit" class="fa fa-edit" style="padding-right:5px;"></a> ';
        // $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>'; 
        	
        $mem[] = array(
            $r->id ,
            $r->user_id,
            $r->user_account_id,
            $r->todate,
            $r->fromdate,
            $r->created_date,
            // $r->status,
            // $edit.$delete
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
                'todate'=>date('Y-m-d',strtotime($this->input->post('todate'))),
                'fromdate'=>date('Y-m-d',strtotime($this->input->post('fromdate'))),
          );
        if($this->input->post("eid")){
            $getusers=$this->dlrrepushs->edit($data,$this->input->post("eid"));
        }else{
            $getusers=$this->dlrrepushs->save($data);

            $getData = $this->dlrrepushs->getDataFromSMPP(strtotime($this->input->post('todate')),strtotime($this->input->post('fromdate')),$this->input->post('user_account_id'));
            if(count($getData)>0)
                $this->dlrrepushs->saveBulkStore($getData);
        }

        if($getusers){
            $this->session->set_flashdata('success', 'Repush has been saved successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while saving repush!!!');
        }

        redirect(base_url('dlrrepush'));
	}

	
}