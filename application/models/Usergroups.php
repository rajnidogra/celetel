<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usergroups extends CI_Model {

	function __construct() {
       
    }

    function getGroupDetail($user_id){
         $where = "";
        if($user_id!=1)
        {
            $where .= " where user_id ='$user_id'";
        }
        $queryString = "select * from usergroups".$where;
        return $query=$this->db->query($queryString);
    }

    function getContactCount($id){
        $queryString = "select count(*) as count from usercontacts where groupid = '$id'";
        $query=$this->db->query($queryString);
        return $result = $query->row_array();
    }

    function getContactData($id){
        $queryString = "select * from usercontacts where groupid = '$id'";
        $query=$this->db->query($queryString);
        return $result = $query->result_array();
    }

    function getGroupList($user_id){
        $where = "";
        if($this->session->userdata('isAdmin')==0)
        {
            $where .= " where user_id ='$user_id'";
        }
       
        $queryString = "select * from usergroups ".$where;
        return $query=$this->db->query($queryString);
    }

    function saveUserGroupData($data){
        $this->db->insert('usergroups',$data);   
        return $this->db->insert_id();
    }

    function saveUserContctData($data){
        return $this->db->insert_batch('usercontacts',$data);   
    }

    function deletegroupDetail($id){
        $this->db->where('id', $id);
       return $this->db->delete('usergroups');
    }

    function deleteAddressBook($groupid){
        $this->db->where('groupid', $id);
       return $this->db->delete('usercontacts');
    }

    function downloadAddressBook($groupid){
       $this->db->select("contact");
        $this->db->where('groupid ',$groupid);
        return $query = $this->db->get('usercontacts');
    }

    function updateContactCount($groupid){
        $queryString = "update usergroups set count=(select count(uc.groupid) as count from usercontacts as uc where uc.groupid=".$groupid.") where id=".$groupid;
        return $query=$this->db->query($queryString);
    }

}