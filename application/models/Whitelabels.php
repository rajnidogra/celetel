<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whitelabels extends CI_Model {
	
	public function getCountry() {

		return $this->db->get('country')->result();
    }

	public function getWhitelabelUsers() {

		return $this->db->query("select user.*,setting.value as company_name FROM user as user left join setting as setting on user.wl_id = setting.user_id WHERE user.user_type IN (2,3) and setting.keys ='company_name'");
    }

	public function getClientUsers() {

		return $this->db->query("
			select 
			user.*,usertype.name as usertype_name,bt_action.name as billingtype_name,bc_action.name as billingcycle_name
			FROM vi_user as user 
			left join usertype as usertype on usertype.id = user.user_type 
			left join actionvalue as bt_action on bt_action.id = user.billing_type 
			left join actionvalue as bc_action on bc_action.id = user.billing_cycle 
			WHERE user.user_type IN (4,5)");
    }

	public function getState($country) {
		$this->db->select('*');
	    $this->db->from('state');
	    $this->db->where('country_id',$country);
	    $this->db->order_by("name", "asc");
	    $query=$this->db->get();
	    return $query->result_array();
    }

	public function getCity($state) {
		$this->db->select('*');
	    $this->db->from('city');
	    $this->db->where('state_id',$state);
	    $this->db->order_by("name", "asc");
	    $query=$this->db->get();
	    return $query->result_array();
    }

    public function get_settings($uid) {
		$this->db->where('user_id', $uid);
		$query = $this->db->get('setting');
		return $query->result();
    }

    public function getUserDetailById($uid) {
		$this->db->where('id', $uid);
		$query = $this->db->get('users');
		return $query->row_array();
    }

    public function getAccountUsersByParentId($uid) {
		// $this->db->where('parent_id', $uid);
		// return $query = $this->db->get('vi_account_users');

		return $this->db->query("
			select 
			user.*,bt_action.name as smstype_name,bc_action.name as accounttype_name
			FROM account_users as user 
			left join actionvalue as bt_action on bt_action.id = user.sms_type 
			left join actionvalue as bc_action on bc_action.id = user.account_type 
			WHERE user.parent_id ='$uid'
		");
    }

    public function getAccountUsersById($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		return $query->row_array();
    }

    public function saveUser($data = array()) {
	    $insert = $this->db->insert('users', $data);
	        if($insert){
	            return $this->db->insert_id();
	        }else{
	            return false;
	        }
    }

    public function saveAccountUser($data = array()) {
	    $insert = $this->db->insert('users', $data);
	        if($insert){
	            return $this->db->insert_id();
	        }else{
	            return false;
	        }
    }

    public function saveSetting($data = array()) {
	    $insert = $this->db->insert('setting', $data);
	        if($insert){
	            return $this->db->insert_id();
	        }else{
	            return false;
	        }
    }

    public function getActionValues($typeId) {
		$this->db->where('type_id', $typeId);
		$query = $this->db->get('actionvalue');
		return $query->result();
    }

     public function updateAccountUser($data, $id) {
        if(!empty($data) && !empty($id)){
            $update = $this->db->update('users', $data, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }

    public function deleteAccountUser($id){
        $delete = $this->db->delete('users',array('id'=>$id));
        return $delete?true:false;
    }

    public function getChildUser($pid){
    	$this->db->where('parent_id', $pid);
    	$this->db->where('account_status', 1);
    	$this->db->where('is_deleted', 0);
		$query = $this->db->get('users');
		return $query->result_array();
    }
    public function getEnterpriseUserChain($user_chain){
		$res = "select * from users where user_chain like '$user_chain%' and account_status='1' and is_deleted='0' and user_type='2'";
        $query=$this->db->query($res);
		return $query->result_array();
    }
}

/* End of file Setting.php */
/* Location: ./application/models/Setting.php */