<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Senders extends CI_Model {

	public function save($data) {
		$insert = $this->db->insert('sender_id', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function getList($id){
        $this->db->where("user_id", $id);
		return $query = $this->db->get('sender_id');
    }

    public function getDataById($id){
        $this->db->where('id', $id);
        $q = $this->db->get('sender_id');
        return $data = $q->row_array();
    }

    public function edit($data,$eid){
       $this->db->where('id', $eid);
       return $this->db->update('sender_id', $data);
    }

    public function delete($id){
        $this->db->where("id", $id);
        return $this->db->delete("sender_id");
    }

}