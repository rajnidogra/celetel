<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telcomapping extends CI_Controller {

	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('telcos');
        $this->load->model('user');
    }


    function index(){
    	$data =  array();
        $user_id=$this->session->userdata("userId");

        $data['groupList'] = $this->telcos->getGroupList();
        $data['routeList'] = $this->telcos->getGroupCount();
    	$this->load->view('telcoMapping',$data);
    }

    function get_tables(){
    	$draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

    	$getusers=$this->telcos->getGroupCount();
        $mem = array();  
        $i=1;
        foreach($getusers as $r) { 

            //  $edit_url= base_url("smsc/kernel_edit/".$r["id"]);
            //  $delete_url= base_url("smsc/kernel_delete/".$r["id"]);
            $count = '<a href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal1" style="padding-right:5px;" onclick="getRoute(\''.$r['route'].'\')">'.$r["count"].'</a> ';
            // $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>'; 
        	
        	 $mem[] = array(
        	 	$i,
        	 	$r["route"],
                $count,
                // $edit. $delete

       		);     
        	 $i++;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($getusers),
            "recordsFiltered" => count($getusers),
            "data" => $mem
        );

        echo json_encode($output);
        exit(); 
    }

    function getRoute(){
    	$route = $this->input->post('route');
    	$getRoute = $this->telcos->getRoutesList($route);
    	$getusers=$this->telcos->getGroupList();
    	$i = 1;
    	$data = "";
    	foreach ($getRoute as $value) {
			$data .= '<tr><td>'.$i.'</td><td>'.$value["system_id"].'</td>
			<td>
			<select class="form-control" id="rute'.$i.'" onchange="changeRoute(\''.$i.'\',\''.$value['system_id'].'\')">';
			foreach ($getusers as $key) {
				$select ="";
				if($key['group_id']==$value["route"]){$select ='selected';}
				$data .= '<option value="'.$key['group_id'].'" '.$select.'>'.$key['group_id'].'</option>';
			}
			$data .='</select>
			</td></tr>';
			$i++;
    	}

    	print_r($data);
    }

    function changeRoute(){
        $route = $this->input->post('route');
        $system_id = $this->input->post('system_id');
        $group_id = $this->input->post('group_id');

        $getRoute = $this->telcos->UpdateRoute($route,$system_id);

        $deleteSMPPRoute = $this->user->deleteAccountRouteUser($route,$system_id);
        // die;
        $getDetail = $this->telcos->getDetailsByRoute($route);
        $i=0;
        // echo "test";
        // print_r($getDetail);
        // die;
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
        // print_r($getRoute);die;
        
        getDATAURL("RELOAD_SMPP");
        if($getRoute){
            $this->session->set_flashdata('success', 'User has been updated successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while updating user data!!!');
        }
        // redirect('telcomapping');
    }

    function saveDetails(){
    	$original_route = $this->input->post('original_route');
    	$replaced_route = $this->input->post('replaced_route');

    	$getRoute = $this->telcos->UpdateRouteByRoute($original_route,$replaced_route);

    	 if($getRoute){
            $this->session->set_flashdata('success', 'User has been updated successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while updating user data!!!');
        }
        redirect('telcomapping');
    }
}