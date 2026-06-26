<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blacklist extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('whitelabels');
        $this->load->model('blacklists');
        is_login();
    }

    function index(){
        $data = array();
        $data['userlist'] = $this->whitelabels->getEnterpriseUserChain($this->session->userdata('userChain'));
        $this->load->view('blacklist',$data);
    }

    function saveDetails(){
        $user_id = $this->input->post('user_id');
        $keyword = $this->input->post('keyword');
        $type = $this->input->post('type');
        // $isglobal = ($this->input->post('user_id')==0)?1:0;

         $data = array(
            'user_chain'=>$this->input->post('user_chain'),
            'account'=>$this->input->post('account'),
            // 'keyword'=>$this->input->post('keyword'),
            // 'isglobal'=>$isglobal
          );

        // if($type==1){
        //     $tableName = "smpp_blacklist_contentid";
        //     $data["contentid"] = $this->input->post('keyword');
        // }else if($type==2){
        //     $tableName = "smpp_blacklist_sender";
        //     $data["sender"] = $this->input->post('keyword');
        // }else if($type==3){
        //     $tableName = "smpp_blacklist_receiver";
        //     $data["receiver"] = $this->input->post('keyword');
        // }else if($type==4){
        //     $tableName = "smpp_blacklist_spam";
        //     $data["keyword"] = $this->input->post('keyword');
        // }else{
        //    $tableName = "smpp_blacklist_spam"; 
        //    $data["keyword"] = $this->input->post('keyword');
        // }

         if($type==1){
            $tableName = "smpp_blacklist_contentid";
            // $data["contentid"] = $this->input->post('keyword');
            $key = 'contentid';
        }else if($type==2){
            $tableName = "smpp_blacklist_sender";
            // $data["sender"] = $this->input->post('keyword');
            $key = 'sender';
        }else if($type==3){
            $tableName = "smpp_blacklist_receiver";
            // $data["receiver"] = $this->input->post('keyword');
            $key = 'receiver';
        }else if($type==4){
            $tableName = "smpp_blacklist_spam";
            // $data["keyword"] = $this->input->post('keyword');
            $key = 'keyword';
        }else{
           $tableName = "smpp_blacklist_spam"; 
           // $data["keyword"] = $this->input->post('keyword');
           $key = 'keyword';
        }

        $data = array();
         if($this->input->post('create_by')==1){
            // echo "<pre>";
            // print_r($_FILES);
            // print_r($_POST);
            // die;
             if(file_exists($_FILES['file']['tmp_name']) || is_uploaded_file($_FILES['file']['tmp_name'])){

                  $randString = md5(time()); 
                  $fileName = $_FILES["file"]["name"]; 
                  $splitName = explode(".", $fileName); 
                  $fileExt = end($splitName); 
                  $tmpName = $_FILES['file']['tmp_name'];
                  $i=0;
                   if($fileExt === 'csv'){
                     if(($handle = fopen($tmpName, 'r')) !== FALSE) {
                        while(($row = fgetcsv($handle)) !== FALSE) {
                            if($i!=0){
                             $data[$i-1] = array(
                                    'user_chain'=>$this->input->post('user_chain'),
                                    'account'=>$this->input->post('account'),
                                    $key => $row[0]
                              );
                            }
                            $i++;
                        }
                       
                       
                     }
                  }
                  $limit = round(count($data)/5000);
                  // print_r(round($limit));die;
            $data  = array_chunk($data,$limit);  
            // echo "<pre>";
            // print_r($data);die;
            foreach ($data as $value) {
               $getusers=$this->blacklists->saveData($value,$tableName);
            }
            // $getusers=$this->blacklists->saveData($data,$tableName);
            }
        }else{
            $data[0]= array(
                'user_chain'=>$this->input->post('user_chain'),
                'account'=>$this->input->post('account'),
                $key => $this->input->post('keyword')
          );
             $getusers=$this->blacklists->saveData($data,$tableName);
        }
        
       // $delete = $this->blacklists->deleteDuplicateRecord($tableName,$key);

        if($type==1){
            $curl = getDATAURL("SMPP_CONTENTID");
        }else if($type==2){
            $curl = getDATAURL("SMPP_SENDER");
        }else if($type==3){
            $curl = getDATAURL("SMPP_RECEIVER");
        }else if($type==4){
            $curl = getDATAURL("SMPP_SPAM");
        }else{
           $curl = getDATAURL("SMPP_CONTENTID");
        }
        // print_r($curl);
        // die;

        if($getusers){
            $this->session->set_flashdata('success', 'Detail has been saved successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while saving the details!!!');
        }

        redirect(base_url('blacklist')); 

    }

    function getList(){
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));  
        $type = $this->input->post('type');
        if($type==1){
            $tableName = "smpp_blacklist_contentid";
            $key = 'contentid';
        }else if($type==2){
            $tableName = "smpp_blacklist_sender";
            $key = 'sender';
        }else if($type==3){
            $tableName = "smpp_blacklist_receiver";
            $key = 'receiver';
        }else if($type==4){
            $tableName = "smpp_blacklist_spam";
            $key = 'keyword';
        }else{
           $tableName = "smpp_blacklist_spam"; 
           $key = 'keyword';
        }
        $getusers=$this->blacklists->getData($tableName,$key);
        $mem = array();  
        $i=1;
        // print_r($getusers->result_array());die;
        foreach($getusers->result_array() as $r) { 

            $delete_url= base_url("blacklist/delete/".$r['account']."/".$tableName);

            $download_url= base_url("blacklist/downloadKeywords/".$r['account']."/".$type);

            $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>';

            $download = '<a href="'.$download_url.'" data-toggle="tooltip" title="Download"  class="fa fa-download"  style="padding-right:5px;" ></a>'; 
          if($r[$key]!=0){
               $mem[] = array(
                    $i,
                    $r['account'],
                    $r[$key],
                    $delete.$download
              );  
          }   
           $i++;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($mem),
            "recordsFiltered" => count($mem),
            "data" => $mem
        );

        echo json_encode($output);
        exit();
        }

        function delete($id,$tableName){
             $getusers=$this->blacklists->delete($id,$tableName);
             if($getusers){
                $this->session->set_flashdata('success', 'Detail has been deleted successfully.');
            }else{
                $this->session->set_flashdata('error', 'Error occured while deleting data!!!');
            }

            redirect(base_url('blacklist'));
        }

        function getAccountList(){
            $user_chain = $this->input->post('user_chain');

            $getusers=$this->blacklists->getAccountList($user_chain);

            if($this->session->userdata('isAdmin')==1){
             echo '<option value="ALL">ALL</option>';
             }else{
              echo '<option value="">Select Account</option>';
             }

            // echo '<option value="ALL">ALL</option>';
            foreach ($getusers as $value) {
                echo '<option value="'.$value['system_id'].'">'.$value['system_id'].'</option>';
            }

        }

         function downloadKeywords($account,$type=""){

            if($type==1){
                $tableName = "smpp_blacklist_contentid";
                $key = 'contentid';
            }else if($type==2){
                $tableName = "smpp_blacklist_sender";
                $key = 'sender';
            }else if($type==3){
                $tableName = "smpp_blacklist_receiver";
                $key = 'receiver';
            }else if($type==4){
                $tableName = "smpp_blacklist_spam";
                $key = 'keyword';
            }else{
               $tableName = "smpp_blacklist_spam"; 
               $key = 'keyword';
            }
            $res = $this->blacklists->downloadBlacklist($account,$tableName,$key);

            header("Content-type: application/csv");
            header("Content-Disposition: attachment; filename=\"Blacklist_Keywords".".csv\"");
            header("Pragma: no-cache");
            header("Expires: 0");

            $handle = fopen('php://output', 'w');

            $fields = array('Keyword');

            fputcsv($handle, $fields);
            foreach ($res as $data_array) {
                fputcsv($handle, $data_array);
            }
            fclose($handle);
        }
}