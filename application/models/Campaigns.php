<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaigns extends CI_Model {

	function getTemplateList($id){
        $this->db->where("userId", $id);
        $q = $this->db->get('http_dlt');
        return $data = $q->result_array();
    }

    function getAccountList($id){
        if($id!=1){
            $this->db->where("user_id", $id);
        }
        $this->db->where("channel", 'WEBPANEL');
        $q = $this->db->get('smpp_user');
        return $data = $q->result_array();
    }

    function getTrackingUrlByUserId($user_id){
        $this->db->select("*");
        if($this->session->userdata('isAdmin')==0){
            $this->db->where('user_id ',$user_id);
        }
        return $query = $this->db->get('shorten_url');

    }

     function getCamapaignDetails($user_id){
        $where = " where cam.user_id='$user_id'";
       
        $queryString = "select cam.*,track.url from campaign as cam left join shorten_url as track on cam.tracking_url = track.id ".$where;
        return $query=$this->db->query($queryString);
    }

     function saveCampaignData($data){
       $this->db->set($data);
       $this->db->insert("campaign");
       return $this->db->insert_id();
    }

    function updateCampaignData($data,$eid){
        $this->db->where('id', $eid);
       return $this->db->update('campaign', $data);
    }

    function getCampaignList($id){
        if($id!=1){ $this->db->where("user_id", $id); }
        $q = $this->db->get('campaign');
        return $data = $q->result_array();
    }

    function getcampaignFromId($id){
        $this->db->where("id", $id);
        $q = $this->db->get('campaign');
        return $data = $q->row_array();
    }

     function getGroupData($id){
        $queryString = "select * from usergroups where user_id = '$id' and isAddressbook='1' order by id desc";
        $query=$this->db->query($queryString);
        return $result = $query->result();
    }

     function delete($id){
        $this->db->where("id", $id);
        return $this->db->delete("campaign");
    }
}