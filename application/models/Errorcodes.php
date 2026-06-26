<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errorcodes extends CI_Model {
    public function save($data) {
        return $this->db->insert_batch('smpp_dlr_err_mapping', $data);
    }
    public function getTransaction(){
        return $query = $this->db->get('smpp_dlr_err_mapping');
    }

    public function getAllSmscList(){
        $q =  $this->db->get('smpp_smsc');
         return $data = $q->result_array();
    }

    public function edit($data,$eid){
       $this->db->where('id', $eid);
       return $this->db->update('smpp_dlr_err_mapping', $data);
    }


    public function getDetailById($eid){
        $this->db->where('id', $eid);
        return $query = $this->db->get('smpp_dlr_err_mapping');
    }

     public function delete($id,$tableName){
        $this->db->where("id", $id);
        return $this->db->delete('smpp_dlr_err_mapping');
    }
}