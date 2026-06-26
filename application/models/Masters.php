<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Masters extends CI_Model {

	function __construct() {
       
    }
   
    function getBilligTypes()
    {
      $this->db->select("*");
      $this->db->where('status ',1);
      $query = $this->db->get('billing_types');
      return $data = $query->result_array();
    }
   
    function getBillingCycles()
    {
      $this->db->select("*");
      $this->db->where('status ',1);
      $query = $this->db->get('billing_cycles');
      return $data = $query->result_array();
    }
   
    function getAccountStatus()
    {
      $this->db->select("*");
      $this->db->where('status ',1);
      $query = $this->db->get('user_accounts_status');
      return $data = $query->result_array();
    }

    function getUserTypes(){
      // $this->db->select("*");
      // $this->db->where('status ',1);
      // $query = $this->db->get('usertypes');
      $userType = $this->session->userdata('userType');
      $queryString = "select *  from usertypes where FIND_IN_SET($userType,isAccess) and status='1'";
      $query=$this->db->query($queryString);
      return $data = $query->result_array();

    }

    function getTreeUsers(){
      // SELECT id,user_type,parent_id,name,email FROM users;
      $this->db->select("id,user_type,parent_id,name,email");
      // $this->db->where('status ',1);
      $query = $this->db->get('users');
      return $data = $query->result_array();

    }

    function deleteUser(){
      $this->db->where("id", $id);
      return $this->db->delete("users");
    }


}