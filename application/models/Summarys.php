<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Summarys extends CI_Model {

	function getAccountByChain($userChain){
		$queryString = "select * from smpp_user where parent like '$userChain%'";
		$query=$this->db->query($queryString);
		return $query->result_array();
	}

	function getErrorListByGroup()
	{
		$queryString = "select error from sms_summary_error group by error";

		$query=$this->db->query($queryString);
		return $query->result_array();

	}

	function getHeadersDetail()
	{
		$userChain = $this->session->userdata('userChain');
		$queryString = "select header from sms_summary_header where user like '$userChain%' group by header";

		$query=$this->db->query($queryString);
		return $query->result_array();
	}

	function getSMSCCodeDetail()
	{
		$queryString = "select smsc from sms_summary_smsc group by smsc";

		$query=$this->db->query($queryString);
		return $query->result_array();
	}

	function getCampaignByChain($user_chain){
	    $queryString = "select * from temp_campaigns where user_chain like '$user_chain%'";

	    $query=$this->db->query($queryString);
	    return $result = $query->result_array();

    }

	function getSummaryErrorReporting($systemIds,$user_id,$account,$errorcode,$todate,$fromdate)
	{
		$where = "where submit_date between '$fromdate' and '$todate'";
		if($user_id!=1 && $account=="")
		{
			$where .= " and account In ($systemIds)";
		}else if(!(empty($account))){
			$where .= " and account ='$account'";
		}

		if($errorcode!=""){
			$where .= " and error ='$errorcode'";
		}
		$group = " group by submit_date,error";
		$queryString = "select *,sum(count) as sumcount from sms_summary_error ".$where.$group;
		$query=$this->db->query($queryString);
		return $query;
		
	}

	function getSummaryHeaderReporting($systemIds,$user_id,$account,$headercode,$todate,$fromdate){
		  $where = "where submit_date between '$fromdate' and '$todate'";
		if($user_id!=1 && $account=="")
		{
			$where .= " and account In ($systemIds)";
		}else if(!(empty($account))){
			$where .= " and account ='$account'";
		}

		if(!(empty($headercode))){
			$where .= " and header ='$headercode'";
		}

		$group = " group by submit_date,user";

		$queryString = "select * from sms_summary_header ".$where.$group;
		$query=$this->db->query($queryString);
		return $query;
	}
	function getSummarySMSCReporting($systemIds,$user_id,$account,$smsccode,$todate,$fromdate){
		$where = "where submit_date between '$fromdate' and '$todate'";
		if($user_id!=1 && $account=="")
		{
			$where .= " and account In ($systemIds)";
		}else if(!(empty($account))){
			$where .= " and account ='$account'";
		}
		if(!empty($smsccode)){
			$where .= " and smsc ='$smsccode'";
		}

		$group = " group by submit_date,smsc,account";

		$queryString = "select account,smsc,submit_date, sum(submit_count) as submit_count, sum(dlr_count) as dlr_count, sum(status_delivered) as status_delivered, sum(status_failed) as status_failed, sum(status_pending) as status_pending, sum(status_nack) as status_nack from sms_summary_smsc ".$where.$group;
		$query=$this->db->query($queryString);
		return $query;
	}

	  function getCampaignByAccount($account){
	    // $queryString = "select campaign_name as campaign from temp_campaigns where account = '$account' group by campaign_name";
	    // $queryString = "select campaign_name as campaign from temp_campaigns where account = '$account' and schedule_date >= ( CURDATE() - INTERVAL 10 DAY) group by campaign_name order by schedule_date desc";
	    $queryString = "select campaign_name as campaign from yourls_url where user_chain like '$account%' and created_date >= ( CURDATE() - INTERVAL 10 DAY) group by campaign_name order by created_date desc";

	    $query=$this->db->query($queryString);
	    return $result = $query->result_array();

    }

     function getCampaignTrackingData($campaign,$account){
        // $sql = "select * from campaign_trackings Where campaign_id = '$campaign' and clicks!='0'";
        // $sql = "select campaign_name,contact,keyword,url,timestamp,clicks FROM yourls_url where campaign_name = '$campaign' and clicks!='0' order by timestamp desc";
        // return $query=$this->db->query($sql);
        // return $query=$this->db->query($dbq);

     	$user_chain = $this->session->userdata('userChain');
     	// $sql = "select * from yourls_url where user_chain like '$user_chain%' and campaign_name = '$campaign' and clicks!='0'";
     	$where = " where user like '$user_chain%' and clicks!='0'";
     	if($campaign){
     		$where .= " and campaign = '$campaign'";
     	}
     	if($account){
     		$where .= " and account = '$account'";
     	}

     	$sql = "select * from sms_summary_clicks".$where;
        return $query=$this->db->query($sql);
        // return $query=$this->db->query($dbq)
    }

     function getSummaryTrackingData($campaign){
        // $sql = "select * from campaign_trackings Where date(created_time) BETWEEN '".$fromdate."' and '".$todate."' and campaign_id = '$campaign'";
        $sql = "select * from sms_summary_clicks Where campaign = '$campaign'";
        return $query=$this->db->query($sql);
        // return $query=$this->db->query($dbq);
    }

    function getSmSSummary($filter){
		$group  = " group by submit_date,user";
		$sql = "select submit_date, account, sum(submit_count) as submit_count, sum(dlr_count) as dlr_count, sum(status_delivered) as status_delivered, sum(status_failed) as status_failed, sum(status_pending) as status_pending, sum(status_nack) as status_nack ,users.name as username from sms_summary as sum left join users on users.id=sum.userid Where 1 ".$filter.$group;
        return $query=$this->db->query($sql);
    }

    function getUsersByParentId($userChain,$userTypes){
    	$userTypes = implode(",",$userTypes);
        // $sql = "select * from users Where user_chain like '$userChain%' and user_type in ($userTypes)";
        $sql = "select * from users Where user_chain like '$userChain%'";
        $query = $this->db->query($sql);
        return $query->result_array();

    }

    function deleteBlankDataBySummary(){
    	$sql = "delete from sms_summary where account='NA'";
        return $this->db->query($sql);
    }

	function getcampaignSummary($account,$campaign,$todate,$fromdate){
    	// $user_chain = $this->session->userdata('userChain');
    	// $filter = "where clicks!='0' and date(timestamp) between '$fromdate' and '$todate' and user_chain like '$user_chain%'";

    	// if($campaign){
    	// 	$filter .=" and campaign_name = '$campaign'";
    	// }
    	$filter = "Where user like '$account%' and submit_date between '$fromdate' and '$todate'";
    	if($campaign){
    		$filter .=" and campaign = '$campaign'";
    	}

    	$group  = " group by submit_date,campaign";
    	$sql = "select submit_date, account, campaign, sum(submit_count) as submit_count, sum(dlr_count) as dlr_count, sum(status_delivered) as status_delivered, sum(status_failed) as status_failed, sum(status_pending) as status_pending, sum(status_nack) as status_nack ,users.name as username from sms_summary_campaign as sum left join users on users.id=sum.userid ".$filter.$group;
    	//$sql = "select * from sms_summary_campaign ".$filter.$group;
    	// $sql = "select ssc.*,sum(clicks) as clicks from sms_summary_campaign ssc left join yourls_url yu on yu.campaign_name= ssc.campaign ".$filter.$group;
    	// $sql = "select campaign_name,contact,keyword,url,timestamp,clicks FROM yourls_url ".$filter." order by timestamp desc";
        return $query=$this->db->query($sql);
    }

    function getLatencysDetail()
	{
		$userChain = $this->session->userdata('userChain');
		$queryString = "select latency from sms_summary_latency where user like '$userChain%' group by latency";

		$query=$this->db->query($queryString);
		return $query->result_array();
	}

	function getSummaryLatencyReporting($systemIds,$user_id,$account,$latency,$todate,$fromdate){
		$group = " group by user,submit_date";
		$where = "where submit_date between '$fromdate' and '$todate'";
		if($user_id!=1 && $account=="")
		{
			$where .= " and account In ($systemIds)";
		}else if(!(empty($account))){
			$where .= " and account ='$account'";
		}

		if(!(empty($latency))){
			$where .= " and latency ='$latency'";
		}

		$queryString = "select * from sms_summary_latency ".$where.$group;
		$query=$this->db->query($queryString);
		return $query;
	}

    function getChannelDetail()
	{
		$userChain = $this->session->userdata('userChain');
		$queryString = "select channel from sms_summary_channel where user like '$userChain%' group by channel";
		$query=$this->db->query($queryString);
		return $query->result_array();
	}

    function getTrafficDetail()
	{
		$userChain = $this->session->userdata('userChain');
		$queryString = "select sender_type from sms_summary_traffic where user like '$userChain%' group by sender_type";
		$query=$this->db->query($queryString);
		return $query->result_array();
	}

	function getSummaryChannelReporting($systemIds,$user_id,$account,$channel,$todate,$fromdate){
		$group = " group by user,submit_date";
		$where = "where submit_date between '$fromdate' and '$todate'";
		if($user_id!=1 && $account=="")
		{
			$where .= " and account In ($systemIds)";
		}else if(!(empty($account))){
			$where .= " and account ='$account'";
		}

		if(!(empty($channel))){
			$where .= " and channel ='$channel'";
		}

		$queryString = "select * from sms_summary_channel ".$where.$group;
		$query=$this->db->query($queryString);
		return $query;
	}

	function getSummaryTrafficReporting($systemIds,$user_id,$account,$traffic,$todate,$fromdate){
		$group = " group by user,submit_date";
		$where = "where submit_date between '$fromdate' and '$todate'";
		if($user_id!=1 && $account=="")
		{
			$where .= " and user In ($systemIds)";
		}
		if(!(empty($account))){
			$where .= " and user like '$account%'";
		}
		if(!(empty($traffic))){
			$where .= " and sender_type like '$traffic'";
		}

		$queryString = "select * from sms_summary_traffic ".$where.$group;
		$query=$this->db->query($queryString);
		return $query;
	}

	function getCampaignTrackingDataNew($campaign,$account){
		$where = "where clicks!='0'";

        // if(!empty($campaign)){
        	$where .= " and campaign_name = '$campaign'";
        // }
        $sql = "select campaign_name,contact,keyword,url,timestamp,clicks FROM yourls_url ".$where." order by timestamp desc";
        return $query=$this->db->query($sql);
	}
}