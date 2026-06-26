<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accountuser extends CI_Controller {

	function __construct() {
        ini_set("display_errors",0);
        parent::__construct();
        is_login();
        $this->load->model('user');
    }

	public function index()
	{
        $data =  array();
        $user_id=$this->session->userdata("userId");
        $data["userList"] = $this->user->getEnterpriseUsers();
        if($this->session->userdata('isAdmin')==0){
            $data["routeList"] = $this->user->getRouteList();
        }else{
            $data["routeList"] = $this->user->getGroupList();
        }
		$this->load->view('accountUserList',$data);
	}

    function chkExist(){
        $value = $this->input->post('value');
        $key = $this->input->post('key');

        $getusers=$this->user->chkAccountUserData($key,$value);

        if($getusers){
            echo '<div class="txt-danger">Already Exists</div>';
        }else{
            echo '<div class="txt-primary">Available</div>';
        }
    }

    function edit($id)
    {
        $data =  array();
        $user_id=$this->session->userdata("userId");
        $data["userList"] = $this->user->getEnterpriseUsers();
         if($this->session->userdata('isAdmin')==0){
            $data["routeList"] = $this->user->getRouteList();
        }else{
            $data["routeList"] = $this->user->getGroupList();
        }
        $data["contentData"] = $this->user->getUserDataById($id);

        $this->load->view('/accountUserList',$data);
    }


    function delete($id){
        $getusers=$this->user->deleteAccountUser($id);
        if($getusers){
            $this->session->set_flashdata('success', 'Account has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting account data!!!');
        }

        redirect(base_url('accountuser')); 
    }

	 function get_tables()
    {
    	$draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        $user_id=$this->session->userdata("userId");
      
        $getusers=$this->user->getSmppUserDetail();
        
        $mem = array();  
        $i=1;
        foreach($getusers->result() as $r) {  

        if($r->spam==1){
            $update_url= base_url("accountuser/updateUser/".$r->system_id."/0");
            $update = '<a href="'.$update_url.'" data-toggle="tooltip" title="Remove from spam" style="padding-right:5px;" onclick="return confirm(\'Are you sure to remove from spam?\')"><i class="fa fa-check-square"></i></a> '; 
        }else{
            $update_url= base_url("accountuser/updateUser/".$r->system_id."/1");
            $update = '<a href="'.$update_url.'" data-toggle="tooltip" title="Add to spam" style="padding-right:5px;" onclick="return confirm(\'Are you sure to add to spam?\')"><i class="fa fa-square-o"></i></a> '; 
        }

        $edit_url= base_url("accountuser/edit/".$r->id);
        $delete_url= base_url("accountuser/delete/".$r->id);
        $unbind_url = base_url("accountuser/unbind/".$r->id);

        $edit = '<a href="'.$edit_url.'" data-toggle="tooltip" title="Edit" class="fa fa-edit" style="padding-right:5px;"></a> ';
        $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>'; 
        $unbind = '<a href="'.$unbind_url.'" data-toggle="tooltip" class="fa fa-link" title="Click to unbind" style="padding-right:5px;" onclick="return confirm(\'Are you sure to unbind?\')"  style="padding-right:5px;" ></a>'; 
        	
        $mem[] = array(
            // $r->id ,
            $i,
            $r->department_name,
            $r->system_id,
            $r->parent_name,
            $r->route,
            $r->channel,
            $r->max_binds,
            $r->throughput,
            $r->connect_allow_ip,
            $r->dlt,
            $r->default_cost,
            $r->dlt_cost,
            $r->refund_amount,
            $r->sender_type,
            $edit.$delete.$update.$unbind
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

    function updateUser($id,$spam)
    {
       $getusers=$this->user->updateUserData($id,$spam);
         if($getusers){
            $this->session->set_flashdata('success', 'User has been updated successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while updating user data!!!');
        }

        redirect('userlist'); 
    }

    function unbindUser($system_id){
        $unbind = unbindUrl($system_id);
        if($unbind){
            $this->session->set_flashdata('success', 'User has been updated successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while updating user data!!!');
        }
        // print_r($unbind);die;
        redirect('userlist');
    }

    


    function saveUserDetails(){
        
        $spamVal = $this->input->post('spam');
        $spam = isset($spamVal[0]) ? $spamVal[0] : 0;
        $spam .= isset($spamVal[1]) ? $spamVal[1] : 0;

        $receiverVal = $this->input->post('receiver');
        $receiver = isset($receiverVal[0]) ? $receiverVal[0] : 0;
        $receiver .= isset($receiverVal[1]) ? $receiverVal[1] : 0;

        $senderVal = $this->input->post('sender');
        $sender = isset($senderVal[0]) ? $senderVal[0] : 0;
        $sender .= isset($senderVal[1]) ? $senderVal[1] : 0;

        $contentVal = $this->input->post('content');
        $content = isset($contentVal[0]) ? $contentVal[0] : 0;
        $content .= isset($contentVal[1]) ? $contentVal[1] : 0;

        $apikey = generateRandomString(14);
        // $username=$this->input->post('system_id');
        // $accounttype=$this->input->post('sender_type');
        // $channel=$this->input->post('channel');
        // $password=$this->input->post('password');
        // $binds=$this->input->post('max_binds');

        // print_r($this->input->post());die;

        if($this->input->post('password')){
             $pass = "*" . strtoupper(sha1(sha1($this->input->post('password'), TRUE)));
             $pass1 = $this->input->post('password');
        }else{
            $pass = $this->input->post('oldPassword');
            $pass1 = $this->input->post('oldPassword');
        }

        // $user_id = $this->session->userdata('userId');
        $user_id = $this->input->post('user_id');
        $userData = getUserInfo($user_id);
        $billingStatus = $userData["billing_type"];
        // $user_chain = $userData["user_chain"]."#".$this->input->post('system_id');
        $user_chain = $userData["user_chain"];

        if($this->input->post('channel')=="HTTP"){
            $dataTbl = array(
                    'username'=>$this->input->post('system_id'),
                    'accounttype'=>1,
                    'dlt'=>0,
                    'apiid'=>$this->input->post('system_id'),
                    // 'passtxt'=>$pass1,
                    'isactive'=>1,
                    'servicetype'=>1,
                    'isipcheckactive'=>0,
                    'islogenabled'=>0,
                    'ismultipartallowed'=>1,
                    'user_chain'=>$user_chain,
            ); 
            if($this->input->post('password')){
                $dataTbl['passtxt']=$pass1;
            }
           
            $getTblData = $this->user->getapiUsers($this->input->post('system_id'));

            // print_r($getTblData);die;

            if($this->input->post("eid") && $getTblData){
                $getusers=$this->user->EditapiUsers($dataTbl,$this->input->post('system_id'));
                $getTblData = $this->user->getapiUsers($this->input->post('system_id'));
            }else{
		    $dataTbl['apikey']=$apikey;
		    print_r($dataTbl);
                $getusers=$this->user->apiUsers($dataTbl);
            }
        }
//die;
        $data = array(
                'user_id'=>$this->input->post('user_id'),
                'system_id'=>$this->input->post('system_id'),
                'department_name'=>$this->input->post('department_name'),
                'password'=> $pass,
                'channel'=>$this->input->post('channel'),
                'max_binds'=>$this->input->post('max_binds'),
                'throughput'=>$this->input->post('throughput'),
                'connect_allow_ip'=>$this->input->post('connect_allow_ip'),
                'dlt'=>$this->input->post('dlt'),
                'webhook_method'=>$this->input->post('webhook_method'),
                'webhook_url'=>$this->input->post('webhook_url'),
                'webhook_body'=>$this->input->post('webhook_body'),
                'default_cost'=>$this->input->post('default_cost'),
                'refund_amount'=>$this->input->post('refund_amount'),
                'dlt_cost'=>$this->input->post('dlt_cost'),
                'sender_type'=>$this->input->post('sender_type'),
                'route'=>$this->input->post('route'),
                // 'enable_prepaid_billing '=>($billingStatus==1)?1:0,
                'enable_prepaid_billing '=>1,
                'parent'=>$user_chain,
                'user'=>$user_chain,
                'spam'=> $spam.$receiver.$sender.$content,
                'created_by'=>$user_id
          );
        $getROuteDataArr = $this->user->getRouteDataById($this->input->post('route'));

        $i = 0;

        foreach ($getROuteDataArr as $getROuteData) {
            if(isset($getROuteData)){
                if(isset($getROuteData) && $getROuteData["routing_type"] == 'Percentage'){
                   $regex = null;
                   $source_regex = null;
                   $percent = $getROuteData["identifier"];
                }elseif(isset($getROuteData) && $getROuteData["routing_type"] == 'Header'){
                   $regex = null;
                   $source_regex = $getROuteData["identifier"];
                   $percent = null;
                }elseif(isset($getROuteData) && $getROuteData["routing_type"] == 'Receiver'){
                    $regex = $getROuteData["identifier"];
                    $source_regex = null;
                    $percent = null;
                }
                $data_smppRoute[$i] = array(
                                'route_id'=>$this->input->post('route'),
                                'system_id'=>$this->input->post('system_id'),
                                'cost'=>$this->input->post('default_cost'),
                                'tps'=>1,
                                'smsc_id'=>$getROuteData['smsc_id'],
                                'priority'=>$getROuteData['priority'],
                                'regex'=>$regex,
                                'source_regex'=>$source_regex,
                                'percent'=>$percent,
                                'direction'=>1
                        );
                $i++;
            }
        }
        if($this->input->post("eid")){
            $deleteSMPPRoute = $this->user->deleteAccountRouteUser($this->input->post('route'),$this->input->post('system_id'));
            $getusers=$this->user->editUsers($data,$this->input->post("eid"));
        }else{
            $getusers=$this->user->addUsers($data);
        }
        if(!empty($data_smppRoute)){
         $getSmppRoute=$this->user->addSmppRoute($data_smppRoute);
        }

        

        if($getusers){
            $successData = array(
                        'username'=>$this->input->post('system_id'),
                        'accounttype'=>$this->input->post('sender_type'),
                        'channel'=>$this->input->post('channel'),
                    );
            if($this->input->post('channel')=="HTTP"){
                $successData['apikey']= (!empty($getTblData) && $getTblData["apikey"])?$getTblData["apikey"]:$apikey;
                $successData['password']=$this->input->post('password');
               // $successData['binds']=$this->input->post('max_binds');
            }
            if($this->input->post('channel')=="SMPP"){
                //$successData['apikey']=$apikey;
                $successData['password']=$this->input->post('password');
                $successData['binds']=$this->input->post('max_binds');
            }
            $this->session->set_flashdata('successData',$successData );
            $this->session->set_flashdata('success', 'User has been created successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while creating users!!!');
        }

        getDATAURL("RELOAD_SMPP");
        getDATAURL("HTTP_ADD");
        redirect(base_url('accountuser')); 
    }
}
