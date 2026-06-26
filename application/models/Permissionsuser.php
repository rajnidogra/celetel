<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissionsuser extends CI_Model {

	public function getUsersTypeList(){
		$this->db->where('status',1);
		return $query = $this->db->get('usertypes');
	}

	public function getMenuList(){
		$this->db->where('status',1);
		return $query = $this->db->get('menu');
	}

	public function savePermission($data){
		$insert = $this->db->insert('permission_user', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
	}

	public function getPermissionByUserType($type){
    	$this->db->where('user_type', $type);
		$query = $this->db->get('permission_usertype');
		return $query->row_array();
    }

	public function getPermissionByUser($type){
    	$this->db->where('user_id', $type);
		$query = $this->db->get('permission_user');
		return $query->row_array();
    }

    public function updatePermission($user_type,$data){
    	$this->db->where('user_id', $user_type);
       return $this->db->update('permission_user', $data);
    }

    public function getUsersByTypes($userType){
    	$this->db->where('user_type', $userType);
    	$this->db->where('is_deleted', 0);
    	$this->db->where('account_status', 1);
		$query = $this->db->get('users');
		return $query->result_array();
    }
}