<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends CI_Model {

	function getUsersTypeList(){
		$this->db->where('status',1);
		return $query = $this->db->get('usertypes');
	}

	function getMenuList(){
		$this->db->where('status',1);
		return $query = $this->db->get('menu');
	}

	function savePermission($data){
		$insert = $this->db->insert('permission_usertype', $data);
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

    function updatePermission($user_type,$data){
    	$this->db->where('user_type', $user_type);
       return $this->db->update('permission_usertype', $data);
    }

    function getUserTypes(){
    	$this->db->select("*");
      $this->db->where('status ',1);
      $query = $this->db->get('usertypes');
      return $data = $query->result_array();
    }
}