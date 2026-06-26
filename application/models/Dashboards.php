<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboards extends CI_Model {

	function __construct() {
       
    }

    function getCurrentDateCount($systemIds,$user_id)
    {
    	$date = date("Y-m-d");
    	
        $where = " where submit_date='$date'";
        if($user_id!=1)
        {
            $where .= " and account In ($systemIds)";
        }
        $queryString = "select COALESCE(sum(submit_count),0) as total from sms_summary".$where;
        $query=$this->db->query($queryString);
        return $result = $query->row_array();
    }

    function getTotalCount($systemIds,$user_id)
    {
     //    if($user_id!=1)
     //    {
     //        $this->db->where_in('account ',$systemIds);
     //    }
    	// $this->db->select("count(*) as total");
    	// $query = $this->db->get('sms_cdr');
        $where = "";
        if($user_id!=1)
        {
            $where .= " where account In ($systemIds)";
        }
        $queryString = "select COALESCE(sum(parts),0) as total from sms_cdr".$where;
        $query=$this->db->query($queryString);
        return $result = $query->row_array();
    }

    function getTotalCountUser()
    {
    	$this->db->select("count(*) as total");
    	$query = $this->db->get('smpp_user');
        return $result = $query->row_array();
    }

    // function getTotalCountSystemUser($user_id)
    // {
    //     $this->db->select("count(*) as total");
    //     $this->db->where('login_user_id ',$user_id);
    //     $query = $this->db->get('smpp_users_mapping');

    //     return $result = $query->row_array();
    // }

    function getTotalCountSystemUser($user_chain)
    {
        // $this->db->select("count(*) as total");
        // $this->db->where('user_chain',$user_id);
        // $query = $this->db->get('smpp_users');
        $where = " where user_chain like '$user_chain%' ";
        $queryString = "select count(*) as total from users".$where;
        $query=$this->db->query($queryString);
        return $result = $query->row_array();
    }

    function getCurrentMonthCount($systemIds,$user_id)
    {
    	$year = date("Y");
    	$month = date("m");
     
        $where = " where month(submit_date)='$month' and year(submit_date)='$year'";
        if($user_id!=1)
        {
            $where .= " and account In ($systemIds)";
        }

        $queryString = "select COALESCE(sum(submit_count),0) as total from sms_summary".$where;
        $query=$this->db->query($queryString);
        return $result = $query->row_array();
    }

    function getDailySmsReport($user_chain)
    {
        $where = "";
        $limit = " LIMIT 10";
        $order_by = " ORDER BY submit_date DESC";
        $group_by = " GROUP BY submit_date";
        // if($user_id!=1)
        // {
        //     $where .= " where account In ($systemIds)";
        // }
        $where = " where user like '$user_chain%' ";
        $queryString = "select submit_date as submit_time,COALESCE(sum(submit_count),0) as parts from sms_summary".$where.$group_by.$order_by.$limit;
        $query=$this->db->query($queryString);
    	return $result = $query->result_array();
    }

    // function getMonthlySmsReport($systemIds,$user_id)
    // {
    //     //"SELECT `dlr_time`, sum(parts) as parts FROM `sms_cdr1` WHERE `account` IN('\'ESME\',\'ESME240\'') GROUP BY month(dlr_time), year(dlr_time) ORDER BY `dlr_time` DESC LIMIT 10";
    //     $where = "";
    //     $limit = " LIMIT 10";
    //     $order_by = " ORDER BY year(submit_date) DESC, month(submit_date) DESC";
    //     $group_by = " GROUP BY month(submit_date), year(submit_date)";
    //     if($user_id!=1)
    //     {
    //         $where .= " where account In ($systemIds)";
    //     }

    //     $queryString = "select month(submit_date) as month,year(submit_date) as year,COALESCE(sum(submit_count),0) as parts from sms_summary".$where.$group_by.$order_by.$limit;
    //     $query=$this->db->query($queryString); 
    //     return $result = $query->result_array();
    // }

    function getMonthlySmsReport($user_chain)
    {
        //"SELECT `dlr_time`, sum(parts) as parts FROM `sms_cdr1` WHERE `account` IN('\'ESME\',\'ESME240\'') GROUP BY month(dlr_time), year(dlr_time) ORDER BY `dlr_time` DESC LIMIT 10";
        $where = "";
        $limit = " LIMIT 10";
        $order_by = " ORDER BY year(submit_date) DESC, month(submit_date) DESC";
        $group_by = " GROUP BY month(submit_date), year(submit_date)";
        // if($user_id!=1)
        // {
        //     $where .= " where account In ($systemIds)";
        // }
        $where = " where user like '$user_chain%' ";
        $queryString = "select month(submit_date) as month,year(submit_date) as year,COALESCE(sum(submit_count),0) as submit_count, 
        sum(dlr_count) as dlr_count, sum(status_delivered) as status_delivered, sum(status_failed) as status_failed, sum(status_pending) as status_pending, sum(status_nack) as status_nack
        from sms_summary".$where.$group_by.$order_by.$limit;
        $query=$this->db->query($queryString); 
        return $result = $query->result_array();
    }

    function getSystemIds($login_user_id)
    {
        $set=$this->db->query("SET GLOBAL group_concat_max_len = 1000000");
        $query=$this->db->query("select group_concat(system_user_id) as systems from smpp_users_mapping where login_user_id='$login_user_id'"); 
        return $result = $query->row_array();
    }

    function getCapaignTracking($systemIds,$user_id){
        $where = " where ";
        if($user_id!=1)
        {
            $where .= " cam.account In ($systemIds) and ";
        }
        $where .= " clicks!=0 and date(timestamp) = ".date("Y-m-d");

       $queryString = "select camp.campaign_name as campaign_id,track.clicks FROM temp_campaigns as camp left join campaign_trackings as track on camp.campaign_name=track.campaign_id ".$where;
        $query=$this->db->query($queryString); 
        return $result = $query->result_array();
    }

    function getCampaignTracking($user_chain){
        // $where = "where clicks!=0 ";
        // if($user_id!=1)
        // {
        //     $where .= " and account In ($systemIds) ";
        // }
        $order = " order by created_date desc";
        $group = " group by campaign_name";
        $limit = " limit 30";

       // $queryString = "select camp.campaign_name as campaign_id,track.clicks FROM temp_campaigns as camp left join campaign_trackings as track on camp.campaign_name=track.campaign_id ".$where;

       // $queryString = "select sum(clk.clicks) as sumClicks,clk.id,campaign,clk.campaign_date,temp.account from sms_summary_clicks as clk left join temp_campaigns as temp on temp.campaign_name=clk.campaign ".$where.$order.$limit;

        // $queryString = "select sum(clicks) as sumClicks,campaign_id as campaign,date(created_date) as campaign_date,account FROM campaign_trackings ".$where.$group.$order.$limit;

        $queryString = "select sum(clicks) as sumClicks,campaign_name as campaign,date(created_date) as campaign_date from yourls_url where user_chain like '$user_chain%' and clicks!='0'".$group.$order.$limit;

        $query=$this->db->query($queryString); 
        return $result = $query->result_array();
    }


    // function dailySmsReport($systemIds,$user_id){
    function dailySmsReport($user_chain){
        // $where = "";
        // if($user_id!=1)
        // {
        //     // $where .= " and account In ($systemIds) ";
        // }
        $where = " and user like '$user_chain%' ";
        $date = date('Y-m-d');
        $queryString ="select COALESCE(sum(submit_count),0) as submit_count, COALESCE(sum(status_delivered),0) as status_delivered, COALESCE(sum(status_failed),0) as status_failed from sms_summary where date(submit_date)= '$date'".$where;
        $query=$this->db->query($queryString); 
        return $result = $query->row_array();
    }

 

}
?>
