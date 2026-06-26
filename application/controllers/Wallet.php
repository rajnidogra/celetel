<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Configuration of redis
// system/libraries/Redis.php
// config/autoload.php  
// config/redis.php  


class Wallet extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('whitelabels');
		$this->load->model('wallets');
		is_login();
	}

	function index(){

		// $this->redis->HINCRBY('foo1', 'bar');
        // $this->redis->hincrby("smpp_user", "test:credit", 500);
        // echo $this->redis->HGET("smpp_user", "test:credit");

        //HINCRBY smpp_user test:credit 100
        // die;
		$data = array();
		// print_r($this->session->userdata('userId'));die;
		$data['userlist'] = $this->whitelabels->getChildUser($this->session->userdata('userId'));
		$this->load->view('wallet',$data);
	}

	function saveDetails(){

		$log_user_id = $this->session->userdata('userId');
		$log_user_chain = $this->session->userdata('userChain');
		$log_key = $log_user_chain.":credit";

		$userData = explode("^",$this->input->post('user_id'));
		$user_id = $userData[0];
		$user_chain = $userData[1];
		$amount = $this->input->post('amount');

		$key = $user_chain.":credit";

		 $data = array(
            'user_id'=>$user_id,
            'user_chain'=>$user_chain,
            'amount'=>$this->input->post('amount'),
          );

		 if(($this->redis->HGET("smpp_user", strtolower($log_key))>=$this->input->post('amount')) && ($this->session->userdata('isAdmin')!=1)){
		 	$datas = array(
	            'user_id'=>$log_user_id,
	            'user_chain'=>$log_user_chain,
	            'amount'=>"-".$this->input->post('amount'),
	          );
		 	// print_r(($this->redis->HGET("smpp_user", strtolower($log_key)).">=".$this->input->post('amount')));echo "PHP_EOL";
		 	// print_r(($this->redis->HGET("smpp_user", strtolower($key)).">=".$this->input->post('amount')));echo "PHP_EOL";
		 	// print_r($data);echo "PHP_EOL";
		 	// print_r($datas);die;
		 	$getusers=$this->wallets->saveTransaction($datas);
		 	$this->redis->hincrbyfloat("smpp_user", strtolower($log_key), "-".$amount);
		 }
		 // print_r($this->redis->HGET("smpp_user", strtolower($key)));
		 // print_r($this->input->post('amount'));die;
		 
		// if(($this->redis->HGET("smpp_user", strtolower($log_key))>=$this->input->post('amount')) || ($this->session->userdata('isAdmin')==1)){
		// if($this->session->userdata('isAdmin')==1){
		 	

	        $this->redis->hincrbyfloat("smpp_user", strtolower($key), $amount);
	      	// print_r(strtolower($key));
	      	// print_r($data);
		 	// echo $amount;die;

	        $getusers=$this->wallets->saveTransaction($data);

	        if($getusers){
	            $this->session->set_flashdata('success', 'User transaction has been credited successfully.');
	        }else{
	            $this->session->set_flashdata('error', 'Error occured while crediting user transaction!!!');
	        }
	    // }

        redirect('wallet'); 

	}

	function getTransaction(){
	  $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));   

      $user_id = $this->input->post('user_id');

      $getusers=$this->wallets->getTransaction($user_id);
      $mem = array();  
	    $i=1;
	    foreach($getusers->result() as $r) { 
	      
	       $mem[] = array(
	       		$i,
	       		$r->username,
	            $r->created_date,
	            $r->amount
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
}