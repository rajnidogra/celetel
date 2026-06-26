<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set("display_errors",1);

class Registration extends CI_Controller {
	function __construct() {
        parent::__construct();
		is_login();
        $this->load->model('user');
        $this->load->model('masters');
    }

	public function index()
	{
		$data = array();
		$data["userType"] = $this->masters->getUserTypes();
		$data["billingType"] = $this->masters->getBilligTypes();
		$data["billingCycle"] = $this->masters->getBillingCycles();
		$data["accountStatus"] = $this->masters->getAccountStatus();
		$this->load->view('userList',$data);
	}

	public function edit($id)
	{
		$data = array();
		$data["userType"] = $this->masters->getUserTypes();
		$data["billingType"] = $this->masters->getBilligTypes();
		$data["billingCycle"] = $this->masters->getBillingCycles();
		$data["accountStatus"] = $this->masters->getAccountStatus();
		$data["contentData"] = $this->user->getUserDetailById($id);
		$data["contentDataDoc"] = $this->user->getUserDetailDocById($id);
		$this->load->view('userList',$data);
	}

	function chkExist(){
		$value = $this->input->post('value');
		$key = $this->input->post('key');

		$getusers=$this->user->chkUserData($key,$value);

		if($getusers){
			echo '<div class="txt-danger">Already Exists</div>';
		}else{
			echo '<div class="txt-primary">Available</div>';
		}

	}

	function getUsers()
    {
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));   


      $userType = $this->input->post('usertype');
      $getusers=$this->user->getUsersByType($userType);
      $mem = array();  
        $i=1;
        foreach($getusers as $r) { 
            $edit_url= base_url("registration/edit/".$r->id);
            $delete_url= base_url("registration/delete/".$r->id);

            $edit = '<a href="'.$edit_url.'" data-toggle="tooltip" title="Edit" class="fa fa-edit" style="padding-right:5px;"></a> ';
            $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>'; 
            $user_chain = '<a href="javascript:;"  class="fa fa-child  modal-trigger" onclick="getUserChain(\''.$r->user_chain.'\')" style="padding-right:5px;" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"></a>'; 
           $key = $r->user_chain.":credit";
           	
           $mem[] = array(
                $i,
                $r->name,
                $r->username,
                $r->email,
                $r->mobile,
                round($this->redis->HGET("smpp_user", strtolower($key)),2),
                $r->account_validity,
                $r->status_name,
		$r->parent_name,
		$r->threshold,
                $edit. $delete.$user_chain
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

	
	function saveUserDetails(){
		try{
			$user_id = $this->session->userdata("userId");
			$loginUserData = getUserInfo($user_id);

			$wl_id = $this->session->userdata("wlId");
			$usertype = $this->input->post('usertype');
			$threshold = $this->input->post('threshold');
			$name = $this->input->post('name');
			$username = $this->input->post('username');
			if(!empty($this->input->post('password')))
				$password = md5($this->input->post('password'));
			else
				$password = $this->input->post('password_old');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$allow_ip = $this->input->post('allow_ip');
			$account_validity = date('Y-m-d',strtotime($this->input->post('account_validity')));
			$billing_cycle = $this->input->post('billing_cycle');
			$billing_type = $this->input->post('billing_type');
			$account_status = 1;
			if($usertype==1){
				$user_chain = "admin";
			}else{
				$user_chain = $loginUserData["user_chain"]."#".$username;
			}
			
			$is_allow_ip = 0;

			if(!empty($allow_ip)){$is_allow_ip = 1;}

		
	      	$data = array(
	  			'user_type' => $usertype,
	  			'name' => $name,
				'username' => $username,
				'password' => $password,
				'email' => $email,
				'mobile' => $mobile,
				'is_allow_ip' => $is_allow_ip,
				'allow_ip' => $allow_ip,
				'account_validity' => $account_validity,
				'billing_cycle' => $billing_cycle,
				'billing_type' => $billing_type,
				'account_status' => $account_status,
				'parent_id' => $user_id,
				'wl_id'=>$wl_id,
				'user_chain'=>$user_chain,
				'threshold' => $threshold
	      	);

	      	if(!empty($this->input->post('eid'))){
	      		$updateusers=$this->user->updateUserRegistration($data,$this->input->post('eid'));
	      		$getusers = $this->input->post('eid');
	      	}else{
	      		$getusers=$this->user->saveUserRegistration($data);
	      	}

	      	
	      	

	      	if(!empty($this->input->post('pan_no')) && !empty($this->input->post('aadhar_no')) && !empty($this->input->post('gst_no'))){

		      	$pan_no = $this->input->post('pan_no');
				$aadhar_no = $this->input->post('aadhar_no');
				$gst_no = $this->input->post('gst_no');
				$gst_file = "";
				$pan_file = "";
				$aadhar_file = "";

		      	if(file_exists($_FILES['gst_file']['tmp_name']) || is_uploaded_file($_FILES['gst_file']['tmp_name'])){
		          $randString = md5(time()); 
		          $fileName = $_FILES["gst_file"]["name"]; 
		          $splitName = explode(".", $fileName); 
		          $fileExt = end($splitName); 
		          $newFileName  = strtolower($randString."_gst".'.'.$fileExt); 
		          $move=move_uploaded_file( $_FILES['gst_file']['tmp_name'],"uploads/".$newFileName);
		         
		          $gst_file = "uploads/".$newFileName;
		      	}else{
		      		$gst_file = $this->input->post('gst_file_old');
		      	}

				if(file_exists($_FILES['pan_file']['tmp_name']) || is_uploaded_file($_FILES['pan_file']['tmp_name'])){
		          $randString = md5(time()); 
		          $fileName = $_FILES["pan_file"]["name"]; 
		          $splitName = explode(".", $fileName); 
		          $fileExt = end($splitName); 
		          $newFileName  = strtolower($randString."_pan".'.'.$fileExt); 
		          $move=move_uploaded_file( $_FILES['pan_file']['tmp_name'],"uploads/".$newFileName);
		         
		          $pan_file = "uploads/".$newFileName;
		      	}else{
		      		$pan_file = $this->input->post('pan_file_old');
		      	}

				if(file_exists($_FILES['aadhar_file']['tmp_name']) || is_uploaded_file($_FILES['aadhar_file']['tmp_name'])){
		          $randString = md5(time()); 
		          $fileName = $_FILES["aadhar_file"]["name"]; 
		          $splitName = explode(".", $fileName); 
		          $fileExt = end($splitName); 
		          $newFileName  = strtolower($randString."_aadhar".'.'.$fileExt); 
		          $move=move_uploaded_file( $_FILES['aadhar_file']['tmp_name'],"uploads/".$newFileName);
		         
		          $aadhar_file = "uploads/".$newFileName;
		      	}else{
		      		$aadhar_file = $this->input->post('aadhar_file_old');
		      	}


		      	$documentData = array(
		      		'pan_no' => $pan_no,
					'aadhar_no' => $aadhar_no,
					'gst_no' => $gst_no,
					'gst_file' => $gst_file,
					'pan_file' => $pan_file,
					'aadhar_file' => $aadhar_file,
					'user_id' => $getusers,
		      	);
		      	if(!empty($this->input->post('eid'))){
		      		$getDocuments=$this->user->updateUserDocuments($documentData,$getusers);
		      	}else{
			      $getDocuments=$this->user->saveUserDocuments($documentData);
			    }
	        }
	      	if(!empty($this->input->post('domain_name')) && !empty($this->input->post('company_name'))){
	      		$updateUsers=$this->user->UpdateUserWlId($getusers);

		      	$domain_name = $this->input->post('domain_name');
				$company_name = $this->input->post('company_name');
				$spitCompany = explode(" ",$company_name);
				$upload_logo = "";
			    $upload_favicon = "";

				if(file_exists($_FILES['upload_logo']['tmp_name']) || is_uploaded_file($_FILES['upload_logo']['tmp_name'])){
		          $randString = md5(time()); 
		          $fileName = $_FILES["upload_logo"]["name"]; 
		          $splitName = explode(".", $fileName); 
		          $fileExt = end($splitName); 
		          $newFileName  = strtolower($randString."_logo".'.'.$fileExt); 
		          $move=move_uploaded_file( $_FILES['upload_logo']['tmp_name'],"uploads/".$newFileName);
		         
		          $upload_logo = "uploads/".$newFileName;
		      	}else{
		      		$upload_logo = $this->input->post('upload_logo_old');
		      	}

				if(file_exists($_FILES['upload_favicon']['tmp_name']) || is_uploaded_file($_FILES['upload_favicon']['tmp_name'])){
		          $randString = md5(time()); 
		          $fileName = $_FILES["upload_favicon"]["name"]; 
		          $splitName = explode(".", $fileName); 
		          $fileExt = end($splitName); 
		          $newFileName  = strtolower($randString."_favicon".'.'.$fileExt); 
		          $move=move_uploaded_file( $_FILES['upload_favicon']['tmp_name'],"uploads/".$newFileName);
		         
		          $upload_favicon = "uploads/".$newFileName;
		      	}else{
		      		$upload_favicon = $this->input->post('upload_favicon_old');
		      	}

		      	$settingData = array(
		      			'website'=>$domain_name,
		      			'company_name'=>$company_name,
		      			'title1'=>$spitCompany[0],
		      			'title2'=>$spitCompany[1],
		      			'upload_favicon'=>$upload_favicon,
		      			'upload_logo'=>$upload_logo,
		      		);
		      	$i = 0;
		      	foreach ($settingData as $key => $value)
	            {
	                $postDataq[$i]['keys'] = $key;
	                $postDataq[$i]['value'] = $value;
	                $postDataq[$i]['user_id'] = $getusers;
	              $i++;
	            } 
	            if(!empty($this->input->post('eid'))){
	            	$deleteusers=$this->user->deleteUserSetting($getusers);
	            }
		      	$getusers=$this->user->saveUserSetting($postDataq);
			      
		    }

	        if($getusers){
	        	$this->session->set_flashdata('success', 'User details has been saved successfully.');
	            
	        }else{
	            $this->session->set_flashdata('error', 'Error occured while saving user details!!!');
	        }

	        redirect(base_url('registration')); 
        }catch(Exception $error){
	        $this->session->set_flashdata('error', $error);
	        redirect(base_url('registration'));
      	}
	}

	function userTree(){
		$user_id = 1;
		$wl_id = 1;
		$data = array();


		$data["userList"] = $this->masters->getTreeUsers();
		$this->load->view('tree',$data);
	}

	function delete($id){
         $getusers=$this->masters->deleteUser($id);
         if($getusers){
            $this->session->set_flashdata('success', 'User has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting user data!!!');
        }

        redirect(base_url('registration')); 
    }

    function getUserChain(){
    	$userChain = $this->input->post('userChain');
    	$getusers=$this->user->getUserChain($userChain);
    	$data = "";
    	$i = 1;
    	foreach ($getusers as $value) {
    		$data .= "<tr>"; 
    		$data .= "<td>".$i."</td>"; 
    		$data .= "<td>".$value["name"]."</td>"; 
    		$data .= "<td>".$value["typ_name"]."</td>"; 
    		$data .= "</tr>"; 
    		$i++;
    	}

    	echo $data;
    }

}
