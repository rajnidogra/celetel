<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign extends CI_Controller {

	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('campaigns');
    }

    function index(){
        $data = array();
        $user_id=$this->session->userdata("userId");
        $data["user_id"] = $user_id;
        $data["templateList"] = $this->campaigns->getTemplateList($user_id);
        
        $data["accountList"] = $this->campaigns->getAccountList($user_id);
        

        $getUrl = $this->campaigns->getTrackingUrlByUserId($user_id);
        $data["urlList"] = $getUrl->result_array();

        $this->load->view('campaign',$data);
    }

    function getTemplateList(){

        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        $user_id=$this->session->userdata("userId");
        $templateList = $this->campaigns->getTemplateList($user_id);

        $mem = array(); 
        foreach ($templateList as $value) {
                    $template_name = $value["template_name"];
                    $template = $value["template"];
                    $id = $value["id"];
                    $header = $value["header"];
                    $peid = $value["peid"];
                    $content = $value["contentid"];

                    $radio = '<input type="radio" name="templateRadio" value="<?php echo  $id;?>" onClick="gettemplateValue(`'.$id.'`,`'.$template.'`,`'.$peid.'`,`'.$content.'`,`'.$header.'`);">';

                     $mem[] = array(
                            $radio,
                            $template_name,
                            $header,
                            $template,
                        );  
                }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($templateList),
            "recordsFiltered" => count($templateList),
            "data" => $mem
        );

        echo json_encode($output);
        exit(); 
    }

     function getList(){
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        $user_id=$this->session->userdata("userId");
        $getusers=$this->campaigns->getCamapaignDetails($user_id);
        
        $mem = array();  
        foreach($getusers->result() as $r) { 
             $edit_url= base_url("campaign/editcampaign/".$r->id);
            $delete_url= base_url("campaign/delete/".$r->id);

             $edit = '<a href="'.$edit_url.'" data-toggle="tooltip" title="Edit" class="fa fa-edit" style="padding-right:5px;"></a> ';
              $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>';
            
             $mem[] = array(
                $r->id,
                $r->campaign_name,
                $r->header,
                $r->peid,
                $r->template,
                $r->message,
                $r->account,
                $r->url,
                $r->created_date,
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

    function editCampaign($id){
        $data =  array();
        $user_id=$this->session->userdata("userId");
        $data["user_id"] = $user_id;

        $data["templateList"] = $this->campaigns->getTemplateList($user_id);
        
        $data["accountList"] = $this->campaigns->getAccountList($user_id);
        

        $getUrl = $this->campaigns->getTrackingUrlByUserId($user_id);
        $data["urlList"] = $getUrl->result_array();

        $data["contentData"] = $this->campaigns->getcampaignFromId($id);

        $this->load->view('campaign',$data);
    }

    function saveCampaignData(){
        $data = array( 
            'header' => $this->input->post('header'),
            'peid' => $this->input->post('peid'),
            'template' => $this->input->post('contentid'),
            'message' => $this->input->post('template'),
            "user_id" => $this->session->userdata("userId"),
            'account'=>$this->input->post("account"),
            'tracking_url'=>$this->input->post("tracking_url"),
            'campaign_name'=>$this->input->post("campaign_name"),
          );

         if($this->input->post("eid")){
            $getusers=$this->campaigns->updateCampaignData($data,$this->input->post("eid"));
         }else{
            $getusers=$this->campaigns->saveCampaignData($data);
         }

        if($getusers){
            $this->session->set_flashdata('success', 'Campaign data has been saved successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while saving campaign data!!!');
        }

        redirect(base_url('campaign')); 
    }

    function edittemplate($id){
        $data =  array();
        $user_id=$this->session->userdata("userId");
        $data["user_id"] = $user_id;

        $data["contentData"] = $this->campaigns->getTemplateFromId($id);

        $this->load->view('templateList',$data);
    }

    function delete($id){
          $getusers=$this->campaigns->delete($id);
         if($getusers){
            $this->session->set_flashdata('success', 'Template data has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting template data!!!');
        }
         redirect(base_url('campaign'));
    }
}