<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user'); 
        $this->load->model('permissionsuser'); 
	}

	public function index()
	{

        // $this->redis->HGET("smpp_user", strtolower($log_key))
        // die;
		$data = array();
		if($this->session->userdata('isUserLoggedIn')){        	
        	redirect('dashboard');
        }
        // if($this->session->userdata('success_msg')){
        //     $data['success_msg'] = $this->session->userdata('success_msg');
        //     $this->session->unset_userdata('success_msg');
        // }
        // if($this->session->userdata('error_msg')){
        //     $data['error_msg'] = $this->session->userdata('error_msg');
        //     $this->session->unset_userdata('error_msg');
        // }

        // if($this->input->post('loginSubmit')){
        // 	 $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        //     $this->form_validation->set_rules('password', 'password', 'required');
        //     if ($this->form_validation->run() == true) {
        //     }
        // }
		$this->load->view('login');
	}

	public function loginSubmit(){

		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$remember_me = $this->input->post('remember_me');
		$wlId = settingsuserid();


		// $condition = array(
		// 	'email'=>$email,
		// 	'password'=>md5($password),
		// 	'wl_id'=> $wlId
		// );

		$checkLogin = $this->user->getUser($email,md5($password),$wlId);

		$getloc = json_decode(file_get_contents("http://ipinfo.io/"),true);

		if(
            isset($checkLogin) && 
            $checkLogin["account_status"] == 1 && 
            $checkLogin["is_deleted"]==0  && 
            (strtotime($checkLogin["account_validity"])>=strtotime(date('Y-m-d')))
        ){


            $permission = $this->getPermission($checkLogin['id'],$checkLogin['user_type']);

			$this->session->set_userdata('isUserLoggedIn',TRUE);
            $this->session->set_userdata('userType',$checkLogin['user_type']);
            $this->session->set_userdata('userId',$checkLogin['id']);
            $this->session->set_userdata('wlId',$checkLogin['wl_id']);
            $this->session->set_userdata('isAdmin',$checkLogin['isAdmin']);
            $this->session->set_userdata('userChain',$checkLogin['user_chain']);
            $this->session->set_userdata('permission',$permission);
            

            if( $remember_me == '1' )
           {
                $cookie_time = 60 * 60 * 24 * 30; // 30 days
                $cookie_time_Onset=$cookie_time+ time();
                setcookie("email", $this->input->post("email"), $cookie_time_Onset);
                setcookie("password", $this->input->post("password"), $cookie_time_Onset);  

            } else {

                $cookie_time_fromOffset=time() -$cookie_time;
                setcookie("email", '',$cookie_time_fromOffset );
                setcookie("password", '', $cookie_time_fromOffset);  

            } 
            if(count($getloc)>0){
            	$ipDetails = array(
            		'user_id' =>$checkLogin['id'],
            		'ip' =>$getloc['ip'],
            		'city' =>$getloc['city'],
            		'region' =>$getloc['region'],
            		'country' =>$getloc['country'],
            		'loc' =>$getloc['loc'],
            		'postal' =>$getloc['postal'],
            		'timezone' =>$getloc['timezone'],
            	);

            	$checkLogin = $this->user->saveLoginHistory($ipDetails);
            	// print_r($ipDetails);
            	// redirect('dashboard');
                redirect(base_url('dashboard'));

            }
		}
        redirect(base_url('login'));

		// print_r($checkLogin);
	}

	public function logout(){
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->unset_userdata('userType');
        $this->session->unset_userdata('wlId');
        $this->session->sess_destroy();
        redirect('login');
    }

    function getPermission($user_id,$user_type){

        $permission = array();

        $getPermission = $this->permissionsuser->getPermissionByUser($user_id);

        if(!isset($getPermission)){
            $getPermission = $this->permissionsuser->getPermissionByUserType($user_type);
        }

        if(isset($getPermission)){
            $permission = json_decode($getPermission["text"],true);
        }

        return $permission;

    }
}

