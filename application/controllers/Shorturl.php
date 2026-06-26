<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shorturl extends CI_Controller {

	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('shorturls');
    }

    function index()
    {
        $data =  array();
        $user_id=$this->session->userdata("userId");
        $this->load->view('shorturl',$data);
    }

    function saveData(){
        $title = $this->input->post("title");
        $url = $this->input->post("url");
        $user_id=$this->session->userdata("userId");

        $data = array(
            'title'=>$title,
            'url' =>$url,
            'user_id'=>$user_id
        );

        if(!empty($_POST["eid"])){
         $res = $this->shorturls->updateTrackingUrlDetail($data,$_POST["eid"]);
        }else{

            $getusers=$this->shorturls->saveTrackingUrl($data);
        }

         if($getusers){
            $this->session->set_flashdata('success', 'Url details has been saved successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while saving url details!!!');
        }

        redirect('shorturl'); 
    }

    function get_tables()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));  

        $user_id=$this->session->userdata("userId"); 

        $getusers=$this->shorturls->getTrackingUrlByUserId($user_id);
        $mem = array();  
        foreach($getusers->result() as $r) { 

             //$edit_url= base_url("shorturl/editTrackingUrl/".$r->id);
             $delete_url= base_url("shorturl/deleteTrackingUrl/".$r->id);

             ///$edit = '<a href="'.$edit_url.'" data-toggle="tooltip" title="Edit" class="fa fa-edit" style="padding-right:5px;"></a> ';
             $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>'; 
             
             $mem[] = array(
                $r->id,
                $r->title,
                $r->url,
                $delete

            );     

        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $getusers->num_rows(),
            "recordsFiltered" => $getusers->num_rows(),
            "data" => $mem
        );

        echo json_encode($output);
        exit(); 

    }

    function deleteTrackingUrl($id){
        $res = $this->shorturls->deleteTrackingUrlDetail($id);

        if($res){
            $this->session->set_flashdata('success', 'Url has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting Url data!!!');
        }
        redirect('shorturl'); 
    }

    function editTrackingUrl($id){
        $data =  array();
        $data["contentData"] = $this->shorturls->getTrackingDetailById($id);
        
        $this->load->view('shorturl',$data);
    }
}
