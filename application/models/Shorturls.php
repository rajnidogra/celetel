<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shorturls extends CI_Model {

    function saveTrackingUrl($data){
       $this->db->set($data);
       $this->db->insert("shorten_url");
       return $this->db->insert_id();
    }

    function getTrackingUrlByUserId($user_id){
    	$this->db->select("*");
        $this->db->where('user_id ',$user_id);
        return $query = $this->db->get('shorten_url');

    }

    function getTrackingDetailById($id){
    	$this->db->select("*");
        $this->db->where('id ',$id);
        $query = $this->db->get('shorten_url');
        return $data = $query->row_array();

    }

    function deleteTrackingUrlDetail($id){
    	$this->db->where('id', $id);
       return $this->db->delete('shorten_url');
    }

    function updateTrackingUrlDetail($data,$eid){
        $this->db->where('id', $eid);
       return $this->db->update('shorten_url', $data);
    }
}