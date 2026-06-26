<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends CI_Controller {

	function index(){

        $data =  array();
        $user_id=$this->session->userdata("userId");
        $data["user_id"] = $user_id;

        $this->load->view('/serverStatus',$data);
    }

}