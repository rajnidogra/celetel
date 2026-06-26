<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templateregs extends CI_Model {

	public function getSenderList($id){
        $this->db->where("user_id", $id);
        $q = $this->db->get("sender_id");
        return $data = $q->result_array();
    }

      public function saveBulk($data) {
       return $this->db->insert_batch('smpp_scrub', $data); 
    }

    public function getList($id){
        $this->db->select('temp.*');
        $this->db->where("temp.user_id", $id);
        // $this->db->join('sender_id as sender', 'sender.id = temp.sender');
		return $query = $this->db->get('smpp_scrub as temp');
    }

    public function getListById($id){
        $this->db->where('id', $id);
        $q = $this->db->get('smpp_scrub');
        return $data = $q->row_array();
    }

    public function edit($data,$eid){
       $this->db->where('id', $eid);
       return $this->db->update('smpp_scrub', $data);
    }

    public function delete($id){
        $this->db->where("id", $id);
        return $this->db->delete("smpp_scrub");
    }

}