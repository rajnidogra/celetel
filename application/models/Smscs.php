
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smscs extends CI_Model {
	
	function getgroupsmscids()
    {
        $queryString="select `smsc-id` FROM smpp_smsc group by `smsc-id`";
        $query=$this->db->query($queryString);
        return $data = $query->result_array();
    }

     function getKernelDetailById($id)
    {
        $this->db->where('id', $id);
        $q = $this->db->get('smpp_smsc');
        return $data = $q->row_array();
    }

    function deleteKernelDetail($id){
        $this->db->where('id', $id);
       return $this->db->delete('smpp_smsc');
    }

    function getkernalDetail()
    {
        $queryString = "select * from smpp_smsc";
        return $query=$this->db->query($queryString);
    }

    function updateSMPPUser($data,$eid){
        $this->db->where('id', $eid);
       return $this->db->update('smpp_smsc', $data);
    }

    function insertSMPPUser($data){
        return $this->db->insert("smpp_smsc", $data);
    }

    function getSmppConfDetail()
    {
        $query = $this->db->get('smpp_smsc');
        return $data = $query->result_array();
    }

    function updateSMPPUserId($eid,$data){
        $this->db->where('smsc-id', $eid);
       return $this->db->update('smpp_smsc', $data);
    }
 
    function updateSMPPUserAllId($data){
        return $this->db->update('smpp_smsc', $data);
     }
}