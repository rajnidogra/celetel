<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Todaysearch extends CI_Controller {
	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('searching');
        $this->load->model('user');
    }

    function index(){
    	$data =  array();
        $user_id=$this->session->userdata("userId");
        $data["userList"] = $this->user->getEnterpriseUsers();
		$this->load->view('todayList',$data);
    }

    function getList(){
    	$draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        // $user_id=$this->session->userdata("userId");
        if($user_chain = $this->input->post('user_chain')){
            $user_chain = $this->input->post('user_chain');

        }else{
            $user_chain = $user_id=$this->session->userdata("userChain");
        }
        $account = $this->input->post('account');
        $sender = $this->input->post('sender');
        $receiver = $this->input->post('receiver');
        $date = date("Y-m-d",strtotime($this->input->post('date')));
        $currentdate = date("Y-m-d");

        $tableName = "sms_cdr";

        if($currentdate != $date){
            $tableName = $tableName."_".date("d_m_Y",strtotime($date));
        }
      
        $search = "1=1";

        $search .= " and user like '$user_chain%'";

        if($sender){
            $search .= " and sender = '$sender'";
        }

        if($account){
            $search .= " and account = '$account'";
        }

        if($receiver){
            $search .= " and receiver like '%".$receiver."'";
        }
        $search .= " ORDER BY submit_time DESC LIMIT 10000";
        $getusers=$this->searching->getDailyData($search,$tableName);
        
        $mem = array();  

        foreach($getusers->result() as $r) {  
            if($this->session->userdata("isAdmin")){
                    $mem[] = array(
                                $r->sql_id,
                                $r->sender,
                                $r->receiver,
                                $r->account,
                                $r->submit_time,
                                $r->dlr_time,
                            
                                
                                
                                $r->parts,
                                $r->entity_id,
                                $r->content_id,
                                $r->campaign,
                                $r->status,
                                $r->reason,
                                $r->encoding,
                                $r->content,
                                    $r->message_id,
                                    $r->smsc,
                            ); 
            } else{
                $mem[] = array(
                    $r->sql_id,
                    $r->sender,
                    $r->receiver,
                    $r->account,
                    $r->submit_time,
                    $r->dlr_time, 
                    $r->parts,
                    $r->entity_id,
                    $r->content_id,
                    $r->campaign,
                    $r->status,
                    $r->reason,
                    $r->encoding,
                    $r->content,
                ); 
            }  
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

    function getAccountList(){
        $user_chain = $this->input->post('user_chain');

        $getusers=$this->searching->getAccountList($user_chain);
        echo '<option value="">Select Account</option>';
        foreach ($getusers as $value) {
            echo '<option value="'.$value['system_id'].'">'.$value['system_id'].'</option>';
        }
    }

    function getSenderList(){
        $user_chain = $this->input->post('user_chain');
        $account = $this->input->post('account');

        $getusers=$this->searching->getSenderList($user_chain,$account);
        echo '<option value="">Select Sender</option>';
        foreach ($getusers as $value) {
            echo '<option value="'.$value['sender'].'">'.$value['sender'].'</option>';
        }
    }

    function getReceiverList(){
        $user_chain = $this->input->post('user_chain');
        $account = $this->input->post('account');
        $sender = $this->input->post('sender');

        $getusers=$this->searching->getReceiverList($user_chain,$account,$sender);
        echo '<option value="">Select Receiver</option>';
        foreach ($getusers as $value) {
            echo '<option value="'.$value['receiver'].'">'.$value['receiver'].'</option>';
        }
    }
}