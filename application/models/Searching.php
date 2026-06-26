<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Searching extends CI_Model {
	
    public function getTransaction(){
		return $query = $this->db->get('spam');
    }

    public function getDailyData($search,$tableName){
     	$res = "select * from ".$tableName." where ".$search;
        return $query=$this->db->query($res);
    }

	public function getAccountList($user_chain){
	    $this->db->where("user", $user_chain);
	    $query = $this->db->get('smpp_user');
	    return $query->result_array();
    }

	public function getSenderList($user_chain,$account){
	    $res = "select * from sms_cdr where user='$user_chain' and account='$account' group by sender";
        $query=$this->db->query($res);
	    return $query->result_array();
    }

	public function getReceiverList($user_chain,$account,$sender){
	    $res = "select * from sms_cdr where user='$user_chain' and account='$account' and sender='$sender' group by receiver";
        $query=$this->db->query($res);
	    return $query->result_array();
    }
}