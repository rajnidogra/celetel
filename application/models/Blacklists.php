<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blacklists extends CI_Model {
	
	public function saveData($data,$tableName) {
		// $insert = $this->db->insert($tableName, $data);
  //       if($insert){
  //           return $this->db->insert_id();
  //       }else{
  //           return false;
  //       }
        return $this->db->insert_batch($tableName, $data);
    }
    public function getData($tableName,$key){
      $user_chain = $this->session->userdata('userChain');
    //   $this->db->like("user_chain", $user_chain,'after');
		  // return $query = $this->db->get($tableName);

      $where = " where user_chain like '$user_chain%'";

      $group = " group by account";
     
      $queryString = "select count(*) as ".$key.",account from ".$tableName.$where.$group;
      return $query=$this->db->query($queryString);
    }

    public function delete($id,$tableName){
        $this->db->where("account", $id);
        return $this->db->delete($tableName);
    }

    public function getAccountList($user_chain){
        $this->db->like("user", $user_chain,'after');
        $query = $this->db->get('smpp_user');
        return $query->result_array();

    }

    public function downloadBlacklist($account,$tableName,$key){
        $this->db->select($key);
        $this->db->where("account", $account);
        $query = $this->db->get($tableName);
        return $query->result_array();

    }

    function deleteDuplicateRecord($tableName,$key){
      $queryString = "delete c1 from ".$tableName." c1 inner join ".$tableName." c2 where c1.id > c2.id and c1.account = c2.account and c1.".$key." = c2.".$key;
      return $query=$this->db->query($queryString);
    }
}