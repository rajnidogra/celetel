<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Composesmss extends CI_Model {

	function getScheduleDetail($id){
        $this->db->where("user_id", $id);
        $this->db->where("short_url_Status", 0);
        $this->db->where("http_sms_status", 0);
        return $q = $this->db->get('temp_campaigns');
    }
    
    function getTrackUrlDataById($id){
        $this->db->where("id", $id); 
        $q = $this->db->get('shorten_url');
        return $data = $q->row_array();
    }
	function savecomposeTempdata($data){
      return $this->db->insert('temp_campaigns',$data); 
    }

    function getSummaryCampaignTemp($campaign,$user_id,$todate,$fromdate){
        // $where = " where temp.short_url_Status!=1 and temp.http_sms_status!=1 and user_chain like 'user_id'";

        // if($campaign){
        //     $where .= " and temp.campaign_name ='$campaign'";
        // }
        

        // $group = " GROUP BY temp.contact_group_id";

        // $queryString = "select temp.*, COUNT(uc.groupid) AS TotalCount from temp_campaigns as temp LEFT JOIN usercontacts AS uc ON uc.groupid = temp.contact_group_id".$where.$group;

        // $query=$this->db->query($queryString);
        // return $query;
        $user_id = $this->session->userdata("userChain");
        $where = "where date(created_time) between '$fromdate' and '$todate'";
        $where .= " and user_chain like '$user_id%'";
        if(!empty($campaign)){
            $where .= " and campaign ='$campaign'";
        }
        $where .= " and paused ='0'";
        $group = " group by campaign,account";
        $queryString = "select campaign,account,scheduled_time,count(*) as TotalCount,paused,header from http_sms ".$where.$group;

        $query=$this->db->query($queryString);
        return $query;
    }
}