<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telcos extends CI_Model {
	
	public function saveRoutngGroup($data) {
		$insert = $this->db->insert('routing_group', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    function getSMSCList()
    {
        $q = $this->db->get('smpp_smsc');
        return $data = $q->result_array();
    }

    public function getTelcoGroupList(){
        $this->db->select('grp.*,sms.smsc-id as smscname');
        $this->db->join('smpp_smsc as sms', 'grp.smsc_id = sms.id','left');
		return $query = $this->db->get('routing_group as grp');
    }

    public function getTelcoGroupListById($id){
        $this->db->where('id', $id);
        $q = $this->db->get('routing_group');
        return $data = $q->row_array();
    }

    public function editRoutingGroup($data,$eid){
       $this->db->where('id', $eid);
       return $this->db->update('routing_group', $data);
    }

    public function deleteTelcoGroup($id){
        $this->db->where("id", $id);
        return $this->db->delete("routing_group");
    }


    public function getResellerRouteList(){
        $this->db->select('route.id,users.name as username,group_id as groupname');
        $this->db->join('users', 'users.id = route.user_id','left');
        $this->db->join('routing_group as grp', 'grp.id = route.route_id','left');
        return $query = $this->db->get('reseller_route as route');
    }

    public function saveResellerRoute($data) {
        $insert = $this->db->insert('reseller_route', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function deleteResellerRoute($id){
        $this->db->where("id", $id);
        return $this->db->delete("reseller_route");
    }

    public function getResellerList(){
        $this->db->where('is_deleted', 0);
        $this->db->where('account_status', 1);
        $this->db->where('user_type', 3);
        $query = $this->db->get('users');
        return $data = $query->result_array();
    }

    public function getGroupList(){
        $this->db->group_by('group_id');
        $query = $this->db->get('routing_group');
        return $data = $query->result_array();
    }

    public function getGroupCount(){
        $queryString = "select route,count(*) as count FROM `smpp_user` group by route";
        $q=$this->db->query($queryString);
        return $data = $q->result_array();
    }

    function getRoutesList($route){
        $this->db->select("*");
        $this->db->where("route", $route);
        $query = $this->db->get("smpp_user");
        return $data = $query->result_array();
    }

    function getDetailsByRoute($route){
        $this->db->select("*");
        $this->db->where("group_id", $route);
        $query = $this->db->get("routing_group");
        return $data = $query->result_array();
    }

    function UpdateRoute($route,$system_id){
        $data = array('route'=>$route);
        $this->db->where('system_id', $system_id);
       return $this->db->update('smpp_user', $data);
    }

    function UpdateRouteInRouteTbl($route,$system_id){
        $data = array('route_id'=>$route);
        $this->db->where('system_id', $system_id);
       return $this->db->update('smpp_route', $data);
    }

    function UpdateRouteByRoute($original_route,$replaced_route){
        $data = array('route'=>$replaced_route);
        $this->db->where('route', $original_route);
       return $this->db->update('smpp_user', $data);
    }

     function insertRouteInRouteTbl($data){
        return $this->db->insert_batch('smpp_route', $data);
    }

    function groupListBySystemId($route){
        $queryString = "select system_id FROM smpp_user where route='$route'";
        $q=$this->db->query($queryString);
        return $data = $q->result_array();
    }


}