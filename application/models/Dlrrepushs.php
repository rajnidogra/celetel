<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dlrrepushs extends CI_Model {

	public function save($data) {
		$insert = $this->db->insert('dlr_repush', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function getList(){
		return $query = $this->db->get('dlr_repush');
    }

    public function getListById($id){
        $this->db->where('id', $id);
        $q = $this->db->get('dlr_repush');
        return $data = $q->row_array();
    }

    public function edit($data,$eid){
       $this->db->where('id', $eid);
       return $this->db->update('dlr_repush', $data);
    }

    public function delete($id){
        $this->db->where("id", $id);
        return $this->db->delete("dlr_repush");
    }

    public function getDataFromSMPP($todate,$fromdate,$account){
        $where = " where time >= '$todate' and time <= '$fromdate' and service = '$account'";
       
        $queryString = "select * from smpp_dlr_repush ".$where;
        $q=$this->db->query($queryString);
        return $data = $q->result_array();
    }

     public function saveBulkStore($data) {
        // print_r($data);die;
       return $this->db->insert_batch('smpp_store', $data); 
    }

}