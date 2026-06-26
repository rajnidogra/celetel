<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends CI_Controller {

	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('templates');
    }

    function index(){
        $data = array();
        $this->load->view('templateList');
    }

     function getList(){
      $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   
        $user_id=$this->session->userdata("userId");
        
        $getusers=$this->templates->getTemplateDetails($user_id);
        
        $mem = array();  
        foreach($getusers->result() as $r) {   
             $edit_url= base_url("template/edittemplate/".$r->id);
            $delete_url= base_url("template/deletetemplate/".$r->id);

             $edit = '<a href="'.$edit_url.'" data-toggle="tooltip" title="Edit" class="fa fa-edit" style="padding-right:5px;"></a> ';
              $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>';
            if($r->status==1)
            {
                $status = "Active";
            }else{
                $status = "Deactive";
            }
             $mem[] = array(
                $r->id,
                $r->template_name,
                $r->header,
                $r->peid,
                $r->contentid,
                $r->template,
                $r->created_date,
                $status,
                $edit.$delete
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

    function savetemplatedata(){
        if($this->input->post("eid")){
            $data = array( 
                'template_name' => $this->input->post('template_name'),
                'header' => $this->input->post('header'),
                'peid' => $this->input->post('peid'),
                'contentid' => $this->input->post('contentid'),
                'template' => $this->input->post('template'),
                "userId" => $this->session->userdata("userId")
            );
            $getusers=$this->templates->updateTemplateData($data,$this->input->post("eid"));
         }else{
            $data = array();
            if($this->input->post('type')==1){
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
                                    'template_name' => $row[0],
                                    'header' => $row[1],
                                    'peid' => $row[2],
                                    'contentid' => $row[3],
                                    'template' => $row[4],
                                    "userId" => $this->session->userdata("userId")
                              );
                            }
                            $i++;
                        }
                       
                       
                     }
                  }
                }
            }else{
                $data[0]= array(
                    'template_name' => $this->input->post('template_name'),
                    'header' => $this->input->post('header'),
                    'peid' => $this->input->post('peid'),
                    'contentid' => $this->input->post('contentid'),
                    'template' => $this->input->post('template'),
                    "userId" => $this->session->userdata("userId")
              );
            }
            // print_r($data);die;
            $getusers=$this->templates->saveTemplateData($data);
        }

        if($getusers){
            $this->session->set_flashdata('success', 'Template data has been saved successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while saving template data!!!');
        }

        redirect(base_url('template')); 
    }

    function edittemplate($id){
        $data =  array();
        $user_id=$this->session->userdata("userId");
        $data["user_id"] = $user_id;

        $data["contentData"] = $this->templates->getTemplateFromId($id);

        $this->load->view('templateList',$data);
    }

    function deletetemplate($id){
          $getusers=$this->templates->deleteTemplateData($id);
         if($getusers){
            $this->session->set_flashdata('success', 'Template data has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting template data!!!');
        }
         redirect(base_url('template'));
    }
}