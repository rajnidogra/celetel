<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends CI_Model {

	function getTemplateDetails($user_id)
    {
        if($user_id!=1){
            $this->db->where('userId', $user_id);
        }
    	$query = $this->db->get('http_dlt');
        return $query;
    }

    function updateTemplateData($data,$eid){
        $this->db->where('id', $eid);
       return $this->db->update('http_dlt', $data);
    }

    function saveTemplateData($data){
         // return $this->db->insert('http_dlt',$data); 
        return $this->db->insert_batch('http_dlt', $data);
    }

    function getTemplateFromId($id){
        $this->db->where('id', $id);
        $q = $this->db->get('http_dlt');
        return $data = $q->row_array();
    }

    function deleteTemplateData($id){
        $this->db->where("id", $id);
        return $this->db->delete("http_dlt");
    }

    function getTemplateList($id){
        $this->db->where("userId", $id);
        $q = $this->db->get('http_dlt');
        return $data = $q->result_array();
    }
}