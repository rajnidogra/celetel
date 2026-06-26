<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telco extends CI_Controller {

	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('telcos');
        $this->load->model('user');
    }

	public function index()
	{
        $data =  array();
        $data['smsc'] = $this->telcos->getSMSCList();
		$this->load->view('telcoList',$data);
	}

	public function addRoutingGroup(){

		$this->load->view('addRoutingGroup');

	}

	public function editGroup($id){
		$data =  array();
        $data['smsc'] = $this->telcos->getSMSCList();
        $data["contentData"] = $this->telcos->getTelcoGroupListById($id);
        $this->load->view('/telcoList',$data);
	}

	 function deleteGroup($id){
         $getusers=$this->telcos->deleteTelcoGroup($id);
         if($getusers){
            $this->session->set_flashdata('success', 'Group has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting group data!!!');
        }

        redirect(base_url('telco')); 
    }

	public function get_group_tables(){
		$draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        $user_id=$this->session->userdata("userId");
      
        $getusers=$this->telcos->getTelcoGroupList();
        
        $mem = array();  

        foreach($getusers->result() as $r) {  

     
        $edit_url= base_url("telco/editGroup/".$r->id);
        $delete_url= base_url("telco/deleteGroup/".$r->id);

        $edit = '<a href="'.$edit_url.'" data-toggle="tooltip" title="Edit" class="fa fa-edit" style="padding-right:5px;"></a> ';
        $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>'; 
        	
        $mem[] = array(
            $r->id ,
            $r->group_id ,
            $r->routing_type,
            $r->tps,
            $r->identifier,
            $r->priority,
            $r->smsc_id,
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

	public function saveRoutingGroup(){
		$data = array(
                'group_id'=>$this->input->post('group_id'),
                'routing_type'=>$this->input->post('routing_type'),
                'tps'=>$this->input->post('tps'),
                'identifier'=>$this->input->post('identifier'),
                'priority'=>$this->input->post('priority'),
                'smsc_id'=>$this->input->post('smsc_id'),
          );
        if($this->input->post("eid")){
            $getusers=$this->telcos->editRoutingGroup($data,$this->input->post("eid"));
             $getSystems=$this->telcos->groupListBySystemId($this->input->post('group_id'));
            // print_r($getSystems);
            foreach ($getSystems as $getSystem) {
                $this->changeRoute($this->input->post('group_id'),$getSystem['system_id']);
            }
            getDATAURL("RELOAD_SMPP");
        }else{
            $getusers=$this->telcos->saveRoutngGroup($data);
        }

        if($getusers){
            $this->session->set_flashdata('success', 'Group has been created successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while creating group!!!');
        }

        redirect(base_url('telco')); 
	}

    function changeRoute($route,$system_id){
        // $route = $this->input->post('route');
        // $system_id = $this->input->post('system_id');

        $getRoute = $this->telcos->UpdateRoute($route,$system_id);

        $deleteSMPPRoute = $this->user->deleteAccountRouteUser($route,$system_id);
        // die;
        $getDetail = $this->telcos->getDetailsByRoute($route);
        $i=0;
        // echo "test";
        // print_r($getDetails);
        foreach ($getDetail as $getDetails) {
           // $getRoute = $this->telcos->UpdateRouteInRouteTbl($getDetails["id"],$system_id);
             if(isset($getDetails) && $getDetails["routing_type"] == 'Percentage'){
                   $regex = null;
                   $source_regex = null;
                   $percent = $getDetails["identifier"];
                }elseif(isset($getDetails) && $getDetails["routing_type"] == 'Header'){
                   $regex = null;
                   $source_regex = $getDetails["identifier"];
                   $percent = null;
                }elseif(isset($getDetails) && $getDetails["routing_type"] == 'Receiver'){
                    $regex = $getDetails["identifier"];
                    $source_regex = null;
                    $percent = null;
                }
          $data[$i] = array(
                    'system_id' => $system_id,
                    'smsc_id '=> $getDetails['smsc_id'],
                    'priority '=> $getDetails['priority'],
                    // 'routing_type '=> $getDetails['routing_type'],
                    'regex'=>$regex,
                    'source_regex'=>$source_regex,
                    'percent'=>$percent,
                    'tps '=> $getDetails['tps'],
                    'direction '=> 1
                );
          $i++; 
        }
        // print_r($data);
        $getRoute = $this->telcos->insertRouteInRouteTbl($data);

    }

	public function resellerRouteList(){
        $data = array();
        $data["userList"] = $this->user->getResellerUsers();
        $routeList = $this->telcos->getTelcoGroupList();
        $data["routeList"] = $routeList->result_array();
		$this->load->view('resellerRouteList',$data);
	}

	public function get_reseller_route_tables(){
		$draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        $user_id=$this->session->userdata("userId");
      
        $getusers=$this->telcos->getResellerRouteList();
        
        $mem = array();  

        foreach($getusers->result() as $r) {  

     
        $delete_url= base_url("telco/deleteResellerRoute/".$r->id);

        $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>'; 
        	
        $mem[] = array(
            $r->id,
            $r->username ,
            $r->groupname,
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

	public function deleteResellerRoute($id){
		 $getusers=$this->telcos->deleteResellerRoute($id);
         if($getusers){
            $this->session->set_flashdata('success', 'Route has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting route data!!!');
        }

        redirect(base_url('telco/resellerRouteList'));
	}

	public function addResellerRoute(){

		$data = array();
		$data["userList"] = $this->telcos->getResellerList();
		$data["routeList"] = $this->telcos->getGroupList();
		$this->load->view('addResellerRoute',$data);
	}

	public function saveResellerRoute(){
		$data = array(
                'route_id'=>$this->input->post('route_id'),
                'user_id'=>$this->input->post('user_id'),
          );
        
        $getusers=$this->telcos->saveResellerRoute($data);

        if($getusers){
            $this->session->set_flashdata('success', 'Route has been created successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while creating route!!!');
        }

        redirect('telco/resellerRouteList');
	}
}