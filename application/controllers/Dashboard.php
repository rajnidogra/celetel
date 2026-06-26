<?php
ini_set("display_errors",1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('dashboards');
        ini_set("display_error",1);
    }

    function index()
    {
        $data =  array();
        $user_id=$this->session->userdata("userId");
        $user_chain=$this->session->userdata("userChain");

        // $getSystem_ids = $this->dashboards->getSystemIds($user_id);
        // $systemIds = "'".str_replace(',',"','",$getSystem_ids['systems'])."'";
        

        // if($this->session->userdata("isAdmin")==1)
        // {
        //     $totalCountUser = $this->dashboards->getTotalCountUser();
        // }else{
        //     $totalCountUser = $this->dashboards->getTotalCountSystemUser($user_id);
        // }
        $totalCountUser = $this->dashboards->getTotalCountSystemUser($user_chain);
        $data["totalCountUser"] = $totalCountUser["total"];
        // $data["totalCountUser"] = 0;

        $dailySmsReport = $this->dashboards->getDailySmsReport($user_chain);
        $data["dailySmsReport"] = $dailySmsReport;

        $montlySmsReport = $this->dashboards->getMonthlySmsReport($user_chain);
        $data["montlySmsReport"] = $montlySmsReport;
        
        $data["campaignTracking"] = $this->dashboards->getCampaignTracking($user_chain);

        $data["dailySMS"] = $this->dashboards->dailySmsReport($user_chain);

        // $data["dailySmsReport"] = array();
        // $data["montlySmsReport"] = array();
        // $data["campaignTracking"] = array();
        // $data["dailySMS"] = array('submit_count'=>0,'status_delivered'=>0,'status_failed'=>0);
     
        
        $this->load->view('dashboard',$data);
    }

}
