<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dlrwebhooks extends CI_Model {

	public function save($data) {
		$insert = $this->db->insert('dlr_webhook', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function getList(){
		return $query = $this->db->get('dlr_webhook');
    }

    public function getListById($id){
        $this->db->where('id', $id);
        $q = $this->db->get('dlr_webhook');
        return $data = $q->row_array();
    }

    public function edit($data,$eid){
       $this->db->where('id', $eid);
       return $this->db->update('dlr_webhook', $data);
    }

    public function delete($id){
        $this->db->where("id", $id);
        return $this->db->delete("dlr_webhook");
    }

}