<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallets extends CI_Model {
	
	public function saveTransaction($data) {
		$insert = $this->db->insert('credit_transaction', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    public function getTransaction($user_id){
        $this->db->select('trs.*,usr.name as username');
        if($user_id){
            $this->db->where('trs.user_id', $user_id);
        }
        $this->db->like('trs.user_chain',$this->session->userdata('userChain'),'after');
        $this->db->join('users as usr', 'usr.id = trs.user_id');
		return $query = $this->db->get('credit_transaction as trs');
    }
}