<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downloadcenter extends CI_Controller {

	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('user');
    }

    public function index()
    {
        $data = array();
        // $user_chain=$this->session->userdata("userChain");
        // $data["userList"] = $this->user->getUsersByChain($user_chain);
        $data["userList"] = $this->user->getEnterpriseUsers();

        $this->load->view('downloadCenter',$data);
    }

    public function getAccountList(){
        $user_id = $this->input->post('user_id');
        $typeValues = $this->user->getAccountByUser($user_id);
        echo '<option value="">Select Account</option>';
        foreach ($typeValues as $value) {
            echo '<option value="'.$value['system_id'].'">'.ucfirst(strtolower($value['system_id'])).'</option>';
        }
    }

   
	 function get_tables()
    {
    	$draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

      
        $getusers=$this->user->getDownloadCenterList();
        
        $mem = array();  
        $i=1;
        foreach($getusers->result() as $r) {  

            $delete_url= base_url("downloadcenter/delete/".$r->id);
            // $file_url= base_url("downloadcenter/delete/".$r->id);

            $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>'; 
            $link = '<a href="'.node_url().'download/downloadFile/'.$r->id.'" data-toggle="tooltip" title="Download File"  class="fa fa-download"  style="padding-right:5px;" ></a>'; 

            if(empty($r->file)){
                $link = "";
            }

            if($r->file_status==2){
                $status = 'Completed';
            }else if($r->file_status==1){
                $status = 'Pending';
            }else if($r->file_status==0){
                $status = 'In Queue';
            }
            	
            $mem[] = array(
                // $r->id ,
                $i,
                $r->username,
                $r->account,
                $r->todate,
                $r->fromdate,
                $link,
                $status,
                $delete
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

      function save(){
        $data = array(
                'user_id'=>$this->input->post('user'),
                'account'=>$this->input->post('account'),
                'date'=>date('Y-m-d',strtotime($this->input->post('todate'))),
                'todate'=>date('Y-m-d',strtotime($this->input->post('todate'))),
                'fromdate'=>date('Y-m-d',strtotime($this->input->post('fromdate'))),
                'created_by_user_chain'=>$this->session->userdata("userChain")
          );

        $getusers=$this->user->saveDownloadRequest($data);
        if($getusers){
            $this->session->set_flashdata('success', 'Request has been saved successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while saving request!!!');
        }
        // print_r($getusers);die;
        redirect(base_url('downloadcenter')); 
    }

     function delete($id){
        $res = $this->user->deleteDownloadRequest($id);

        if($res){
            $this->session->set_flashdata('success', 'Request has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting request data!!!');
        }
        redirect(base_url('downloadcenter')); 
    }
}