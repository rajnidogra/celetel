<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set("display_errors",1);
class User extends CI_Model {
	
	function getUser($email,$password,$wl_id) {
        $queryString = "select users.*,usertypes.isAdmin from users left join usertypes on usertypes.id = users.user_type  WHERE wl_id='$wl_id' and password = '$password' and (username='$email' or email='$email' or mobile='$email')";
	    $query=$this->db->query($queryString);
	    return $query->row_array();
    }

    function saveLoginHistory($data){
		  $insert = $this->db->insert('login_histories', $data);
      if($insert){
          return $this->db->insert_id();
      }else{
          return false;
      }
    }

    function saveUserRegistration($data){
       $this->db->set($data);
       $this->db->insert("users");
       return $this->db->insert_id();
    }

 
    function getMethods(){
      $this->db->select("*");
      $query = $this->db->get('callback_methods');
      return $data = $query->result_array();
    }
    
    function getAccountByUserChain($userChain){
      $queryString = "select * from smpp_user where user like '$userChain%'";
      $query=$this->db->query($queryString);
      return $data = $query->result_array();
    }

    function getEnterpriseUsers(){
        $this->db->select("*");
        $this->db->where('user_type',2);
        if($this->session->userdata('isAdmin')==0){
          // $this->db->where('parent_id',$this->session->userdata('userC'));
          $this->db->like('user_chain',$this->session->userdata('userChain'),'after');
        }
        $query = $this->db->get('users');
        return $data = $query->result_array();
    }

    function getResellerUsers(){
        $this->db->select("*");
        // $this->db->where('user_type',2);
        $this->db->where_in('user_type',array('4','3'));
        if($this->session->userdata('isAdmin')==0){
          $this->db->where('parent_id',$this->session->userdata('userId'));
        }
        $query = $this->db->get('users');
        return $data = $query->result_array();
    }

     function getAccountByUser($user_id){
      $this->db->select("*");
      $this->db->where('user_id',$user_id);
      $query = $this->db->get('smpp_user');
      return $data = $query->result_array();
    }

    function getUserDetailById($id){
      $this->db->select("*");
      $this->db->where('id',$id);
      $query = $this->db->get('users');
      return $data = $query->row_array();
    }

    function getUserDetailDocById($id){
      $this->db->select("*");
      $this->db->where('user_id',$id);
      $query = $this->db->get('document_details');
      return $data = $query->row_array();
    }

    function getRouteList(){
        $this->db->select("res.*,grp.group_id");
        $this->db->from('reseller_route as res');

        if($this->session->userdata('isAdmin')==0){
          $this->db->where('res.user_id',$this->session->userdata('userId'));
        }
        $this->db->join('routing_group grp', 'grp.id = res.route_id', 'left'); 

        $query = $this->db->get();
        return $data = $query->result_array();
    }

    function getGroupList(){
        $this->db->select("*");
        $this->db->from('routing_group');
        $this->db->group_by('group_id'); 

        $query = $this->db->get();
        return $data = $query->result_array();
    }

    function getUsersByParentId($userId,$userType){
        $this->db->select("*");
        $this->db->where('user_type !=',1);
        if($userType!=1){
            $this->db->where('parent_id',$userId);
        }
        return $query = $this->db->get('users');
        // return $data = $query->result_array();

    }

    function getSmppUserDetail(){
        $this->db->select("smp.*,usr.name as parent_name");
        if($this->session->userdata('isAdmin')==0){
          $this->db->where('smp.created_by',$this->session->userdata('userId'));
          $this->db->or_like('smp.parent',$this->session->userdata('userChain'),'after');
        }//parent_name
        $this->db->join('users usr', 'smp.user_id = usr.id', 'left'); 
        return $query = $this->db->get('smpp_user as smp');
        // return $data = $query->row_array();
    }

    function saveUserDocuments($data){
       $this->db->set($data);
       $this->db->insert("document_details");
       return $this->db->insert_id();
    }

    function addSmppRoute($data){
      return $this->db->insert_batch('smpp_route', $data); 
    }

    function deleteAccountRouteUser($route,$system_id){
      // $this->db->where('route_id', $route);
      $this->db->where('system_id', $system_id);
      return $this->db->delete('smpp_route');
    }

    function saveUserSetting($data){
       return $this->db->insert_batch("setting",$data);
    }

    function updateUserData($id,$spam){
        $data = array("spam"=>$spam);
        $this->db->where('system_id', $id);
       return $this->db->update('smpp_user', $data);
    }

    function updateUserRegistration($data,$id){
        $this->db->where('id', $id);
       return $this->db->update('users', $data);
    }

    function updateUserDocuments($data,$id){
        $this->db->where('user_id', $id);
       return $this->db->update('document_details', $data);
    }

    function UpdateUserWlId($id){
        $data = array("wl_id"=>$id);
        $this->db->where('id', $id);
       return $this->db->update('users', $data);
    }

    function EditapiUsers($data,$eid){
        $this->db->where('apiid', $eid);
       return $this->db->update('tbl_user_api_smpp_credential', $data);
    }

    function getapiUsers($id){
        $this->db->where('apiid', $id);
        $q = $this->db->get('tbl_user_api_smpp_credential');
        return $data = $q->row_array();
    }

    function getUserDataById($id){
        $this->db->where('id', $id);
        $q = $this->db->get('smpp_user');
        return $data = $q->row_array();
    }

    function deleteUser($id){
      $this->db->where('id', $id);
      return $this->db->update('users', array('account_status'=>0,'is_deleted'=>1));
    }

    function deleteAccountUser($id){
      $this->db->where('id', $id);
      return $this->db->delete('smpp_user');
    }

    function deleteUserSetting($id){
      $this->db->where('user_id', $id);
      return $this->db->delete('setting');
    }

    function editUsers($data,$eid){
        $this->db->where('id', $eid);
       return $this->db->update('smpp_user', $data);
    }

    function getRouteDataById($route){
      $this->db->where('group_id',$route);
      $query = $this->db->get('routing_group');
      return $data = $query->result_array();
    }

    function addUsers($data){
        return $this->db->insert('smpp_user',$data);   
    }

    function apiUsers($data){
        return $this->db->insert('tbl_user_api_smpp_credential',$data);   
    }

    function getUserChain($userChain){
      $queryString = "select usr.name,typ.name as typ_name from users usr left join usertypes as typ on typ.id=usr.user_type where user_chain like '$userChain%'";
      $query=$this->db->query($queryString);
      return $data = $query->result_array();
    }

    function getUsersByType($userType){
      $where = " usr.is_deleted=0 and usr.account_status=1 and usr.user_type='".$userType."'";
      if($this->session->userdata('isAdmin')==0){
        $where .= " and usr.parent_id='".$this->session->userdata('userId')."'";
      }

      $queryString = "select usr.*,usrp.name as parent_name,uas.value as status_name
                from users as usr 
                left join users as usrp on usr.parent_id=usrp.id
                left join user_accounts_status as uas on uas.id=usr.account_status 
                where ".$where;
      $query=$this->db->query($queryString);
        return $data = $query->result();
    }

    function chkUserData($key,$value){
        $this->db->where($key, $value);
        $this->db->where("wl_id",$this->session->userdata('wlId'));
        $q = $this->db->get('users');
        return $data = $q->row_array();
    }

    function chkAccountUserData($key,$value){
        $this->db->where($key, $value);
        $q = $this->db->get('smpp_user');
        return $data = $q->row_array();
    }

    // function getUsersByChain($userChain){
    //   $this->db->like("user_chain",$userChain,'after');
    //   $this->db->where_not_in('id',$this->session->userdata('userId'));
    //   $q = $this->db->get('users');
    //   return $data = $q->result_array();
    // }

    // function getAccountByUserChain($user_id){
    //     $this->db->select("smp.*");
    //     // if($this->session->userdata('isAdmin')==0){
    //       // $this->db->where('smp.created_by',$this->session->userdata('userId'));
    //       $this->db->like('smp.parent',$user_id,'after');
    //     // }//parent_name
    //     // $this->db->join('users usr', 'smp.user_id = usr.id', 'left'); 
    //     $query = $this->db->get('smpp_user as smp');
    //     return $data = $query->result_array();
    // }

    function saveDownloadRequest($data){
      $insert = $this->db->insert('download_request', $data);
      if($insert){
          return $this->db->insert_id();
      }else{
          return false;
      }
    }

    function getDownloadCenterList(){
        $this->db->select("ds.*,usr.name as username");
        // $this->db->where('',$this->session->userdata('userId'));
        $this->db->like('created_by_user_chain',$this->session->userdata('userChain'),'after');
        $this->db->join('users usr', 'ds.user_id = usr.id', 'left'); 
        return $query = $this->db->get('download_request as ds');
    }

    function deleteDownloadRequest($id){
        $this->db->where('id', $id);
        return $this->db->delete('download_request');
    }

    function get_setting() {

		return $this->db->get('setting')->result();
    }

    function get_settings($uid) {
		$this->db->where('user_id', $uid);
		$query = $this->db->get('setting');
		return $query->result();
    }
}
