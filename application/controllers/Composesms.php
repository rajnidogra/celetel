<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Composesms extends CI_Controller {

	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('composesmss');
        $this->load->model('campaigns');
        $this->load->model('usergroups');
        $this->load->model('summarys');
    }

    function index(){
        $data = array();
        $user_id=$this->session->userdata("userId");
        $data["user_id"] = $user_id;
        
        $gettemplate=$this->campaigns->getTemplateList($user_id);
        $data["templateList"] = $gettemplate;
        
        $getaccount=$this->campaigns->getAccountList($user_id);
        $data["accountList"] = $getaccount;

        $getUrl=$this->campaigns->getTrackingUrlByUserId($user_id);
        $data["urlList"] = $getUrl->result_array();

        $getCampaignData = $this->campaigns->getCampaignList($user_id);
        $data["campaignList"] = $getCampaignData;

        $userChain = $this->session->userdata('userChain');

        $data["userAccountList"] = $this->summarys->getAccountByChain($userChain);

        $this->load->view('composesms',$data);
    }

    function getCampaignList(){
      $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        $user_id=$this->session->userdata("userId");
        $campaignList = $this->campaigns->getCampaignList($user_id);

        $mem = array(); 
        foreach ($campaignList as $value) {
            $campaign_name = $value["campaign_name"];
            $contentid = $value["template"];
            $id = $value["id"];
            $header = $value["header"];
            $peid = $value["peid"];
            $message = $value["message"];
            $account = $value["account"];
            $tracking_url = $value["tracking_url"];

            $radio = '<input type="radio" name="templateRadio" value="<?php echo  $id;?>" onClick="getCampaignValue(`'.$id.'`,`'.$contentid.'`,`'.$peid.'`,`'.$message.'`,`'.$header.'`,`'.$campaign_name.'`,`'.$account.'`,`'.$tracking_url.'`);">';

             $mem[] = array(
                    $radio,
                    $campaign_name,
                    $header,
                    $contentid,
                );  
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($campaignList),
            "recordsFiltered" => count($campaignList),
            "data" => $mem
        );

        echo json_encode($output);
        exit(); 
    }

    function getContactData(){
      $user_id=$this->session->userdata("userId");
      $getusers=$this->campaigns->getGroupData($user_id);
      $mem = array();  
      $details = "";
      foreach($getusers as $r) {   
          $id = $r->id;
          $title = $r->groupname;
          $count = $r->count;
          $details .= "<tr>";
          /*$details .= '<td><input type="radio" name="templateRadio" value="<?php echo  $id;?>" onClick="getContactValue(\''.$id.'\',\''.$title.'\',\''.$count.'\');"></td>';*/
          $details .= '<td><input type="radio" name="templateRadio" value="<?php echo  $id;?>" onClick="getContactValue(\''.$id.'\',\''.$count.'\');"></td>';
          $details .= "<td>".$title."</td>";
          $details .= "<td>".$count."</td>";
          $details .= "</tr>"; 

      }
      echo $details;
    }

     function savecomposedata(){
      try{
        ini_set('memory_limit', -1);

        $user_id=$this->session->userdata("userId");
        $user_chain=$this->session->userdata("userChain");
        $campaign_name = $this->input->post('campaignName');
        $header = $this->input->post('header');
        $peid = $this->input->post('peid');
        $account = $this->input->post('account');
        $trackUrlId = $this->input->post('tracking_url');
        $content_id = $this->input->post('contentid');
        $compose_sms = $this->input->post('template');
        $type = $this->input->post('type');
        $msisdn = $this->input->post('msisdn');
        $sec_date = $this->input->post('schedule_date');
        // $sec_time = $this->input->post('schedule_time');
        $typecam = "TEST";
        if($type==1){
          $typecam = "TEST";
        }else if($type==2){
          $typecam = "QUICK";
        }else if($type==3){
          $typecam = "FILE";
        }else if($type==4){
          $typecam = "ADDRESS";
        }
        $contact_group_id = $this->input->post('group_id');
        if(empty($trackUrlId)){
          $trackUrlId = 0;
        }
        if($this->input->post("schedule_time")){
            $sec_time = $this->input->post("schedule_time");
        }else{
            date_default_timezone_set("Asia/Calcutta"); 
            $sec_time = date("h:i:s");
        }

        // Tracking Url Data 
        $trackDataKey = "";
        $original_url = "";
        if($this->input->post('tracking_url')){
            $getTrackingData=$this->composesmss->getTrackUrlDataById($trackUrlId);
            $original_url = $getTrackingData["url"];
            $trackDataKey  = strtolower(str_replace(" ","",trim($getTrackingData["title"])));
        }

        if(($type == 1 || $type == 2) && $this->input->post('msisdn')){
            $msisdn = $this->input->post('msisdn');
            $ContaArr = array_filter(explode("\r\n", $msisdn));
            
            $contactGroupData = array('groupname'=>$campaign_name,'user_id'=>$user_id);

            $getGroupContact=$this->usergroups->saveUserGroupData($contactGroupData);
            $i = 0;
            foreach ($ContaArr as $value) {
             $mobileArr[$i] = array(
                      'user_id'=>$this->session->userdata("userId"),
                      'groupid' => $getGroupContact,
                      'contact' => $value,
                      'var1'=>"",
                      'var2'=>"",
                      'var3'=>"",
                      'var4'=>"",
                  );
              $i++;
            }
            
            $getusers=$this->usergroups->saveUserContctData($mobileArr);
            $contact_group_id = $getGroupContact;
          }

          $dataSaveArr = array(
            'header'=>$header,
            'peid'=>$peid,
            'account'=>$account,
            'campaign_name'=>$campaign_name,
            'compose_sms'=>$compose_sms,
            'schedule_date'=>$sec_date,
            'schedule_time'=>$sec_time,
            'content_id'=>$content_id,
            'tracking_url'=>$trackUrlId,
            'tracking_url_key'=>$trackDataKey,
            'contact_group_id'=>$contact_group_id,
            'original_url'=>$original_url,
            'user_id'=>$user_id,
            'user_chain'=>$user_chain,
            'type'=>$typecam
          );
          // print_r($dataSaveArr);die;
        $getusers=$this->composesmss->savecomposeTempdata($dataSaveArr);
        if($getusers){
          $this->session->set_flashdata('success', 'Template data has been saved successfully.');
        }else{
          $this->session->set_flashdata('error', 'Error occured while saving template data!!!');
        }
        redirect(base_url('composesms')); 


      }catch(Exception $error){
        $this->session->set_flashdata('error', $error);
        redirect(base_url('composesms')); 
      }
     }

     function savecomposedata1(){
      try{
        ini_set('memory_limit', -1);

        $user_id=$this->session->userdata("userId");
        $camp_id = $this->input->post('camp_id');
        $header = $this->input->post('header');
        $peid = $this->input->post('peid');
        $account = $this->input->post('account');
        $campaign_name = $this->input->post('campaign_name');
        $compose_sms = $this->input->post('compose_sms');
        $sec_date = $this->input->post('schedule_date');
        $template = $this->input->post('template');
        $trackUrlId = $this->input->post('tracking_url');
        $original_url = "";
        $trackDataKey = "";
        if(empty($trackUrlId)){
          $trackUrlId = 0;
        }

        $contactBookId = $this->input->post('contactBookId');
        // if($this->input->post("sec_time")){
        //     $sec_time = $this->input->post("sec_time");
        // }else{
        //     date_default_timezone_set("Asia/Calcutta"); 
        //     $sec_time = date("h:i:s");
        // }

        // Tracking Url Data 
        if($this->input->post('tracking_url')){
            $getTrackingData=$this->composesmss->getTrackUrlDataById($trackUrlId);
            $original_url = $getTrackingData["url"];
            $trackDataKey  = strtolower(str_replace(" ","",trim($getTrackingData["title"])));
        }

         if($this->input->post('msisdn')){
            $msisdn = $this->input->post('msisdn');
            $ContaArr = array_filter(explode("\r\n", $msisdn));
            $i = 0;
            foreach ($ContaArr as $value) {
               $mobileArr[$i] = array(
                        'user_id'=>$this->session->userdata("userId"),
                        // 'groupid' => $this->input->post('groupid'),
                        'contact' => $value,
                        'var1'=>"",
                        'var2'=>"",
                        'var3'=>"",
                        'var4'=>"",
                    );
                    $i++;
            }
        }
        if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])){

              $randString = md5(time()); 
              $fileName = $_FILES["image"]["name"]; 
              $splitName = explode(".", $fileName); 
              $fileExt = end($splitName); 
              $newFileName  = strtolower($randString.'.'.$fileExt); 
              $move=move_uploaded_file( $_FILES['image']['tmp_name'],"images/".$newFileName);
             
              $image = "images/".$newFileName;
              // print_r($image);die;
              if($image){
                $fileData = fileApiLink($image,$fileExt);
                $fileData = json_decode($fileData,true);
                // print_r($fileData);die;
                if($fileData && $fileData["data"] && $fileData["success"]){
                  $data = $fileData["data"];
                  $i = 0;
                  // foreach ($data as $value) {
                  //   $mobileArr[$i] = str_replace("\r","",$value);
                  //   $i++;
                  // }
                   foreach ($data as $value) {
                    // for($i=0;$i<sizeof($data);$i++){
                        // $data = $data[$i];
                        $data = $value;
                        // print_r($data);die;
                        $data = $data;
                        $var1 = "";
                        $var2 = "";
                        $var3 = "";
                        $var4 = "";
                        if(!empty($fileData["var1"][$i])){
                           $var1 = $fileData["var1"][$i];
                        }
                        if(!empty($fileData["var2"][$i])){
                          $var2 = $fileData["var2"][$i];

                        }

                        if(!empty($fileData["var3"][$i])){
                          $var3 = $fileData["var3"][$i];

                        }

                        if(!empty($fileData["var4"][$i])){
                          $var4 = $fileData["var4"][$i];

                        }
                        if(!empty($data) && $data !== "phone"){
                            $mobileArr[$i] = array(
                                'user_id'=>$this->session->userdata("userId"),
                                'contact' => $data,
                                'var1'=>$var1,
                                'var2'=>$var2,
                                'var3'=>$var3,
                                'var4'=>$var4,
                            );
                            $i++;
                        }
                    }
                }else{
                  echo "Exception";
                  print_r($fileData);die;
                  throw new Exception($fileData["message"]);
                }
              }
        }
        // print_r($contactBookId);die;
        if(empty($contactBookId)){
          if(!empty($mobileArr) && count($mobileArr)>0){
             $contactGroupData = array(
                  'groupname'=>$campaign_name,
                  'user_id'=>$user_id
              );
              $getGroupContact=$this->usergroups->saveUserGroupData($contactGroupData);
              // print_r($getGroupContact);die;
              for($i=0;$i<count($mobileArr);$i++){
                $contactData[$i] = array(
                      'contact'=>$mobileArr[$i]["contact"],
                      'user_id'=>$user_id,
                      'groupid'=>$getGroupContact,
                      'var1'=>$mobileArr[$i]["var1"],
                      'var2'=>$mobileArr[$i]["var2"],
                      'var3'=>$mobileArr[$i]["var3"],
                      'var4'=>$mobileArr[$i]["var4"],
                ); 
              }
              // echo "<pre>";
              // print_r($contactData);die;
              $getusers=$this->usergroups->saveUserContctData($contactData);

              $contactBookId = $getGroupContact;
          }
        }

        if(empty($trackUrlId)){$trackUrlId = 0; }
        $dataSaveArr = array(
            'header'=>$header,
            'peid'=>$peid,
            'account'=>$account,
            'campaign_name'=>$campaign_name,
            'compose_sms'=>$compose_sms,
            'schedule_date'=>$sec_date,
            'content_id'=>$template,
            'tracking_url'=>$trackUrlId,
            'tracking_url_key'=>$trackDataKey,
            'contact_group_id'=>$contactBookId,
            'original_url'=>$original_url,
            'user_id'=>$user_id
          );
        // print_r($dataSaveArr);die;
         $getusers=$this->composesmss->savecomposeTempdata($dataSaveArr);
        if($getusers){
            $this->session->set_flashdata('success', 'Template data has been saved successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while saving template data!!!');
        }

        redirect('composesms'); 
      }catch(Exception $error){
        $this->session->set_flashdata('error', $error);
        redirect('composesms'); 
      }
    }

    function get_table(){
      $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        $user_id=$this->session->userdata("userId");
        
        $getusers=$this->composesmss->getScheduleDetail($user_id);
        
        $mem = array();  

        foreach($getusers->result() as $r) {  

        $delete_url= base_url("composesms/deleteUser/".$r->id);

        $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>'; 
          
        $mem[] = array(
            $r->id ,
            $r->header,
            $r->peid,
            $r->content_id,
            $r->original_url,
            $r->campaign_name,
            $r->compose_sms,
            $r->schedule_date,
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

    function getTrackUrlSlug(){
      $track_id = $this->input->post("track_id");
      if($track_id){
        $getTrackingData=$this->composesmss->getTrackUrlDataById($track_id);
        // $trackDataKey  = "{".strtolower(str_replace(" ","",trim($getTrackingData["title"])))."}";
        // $trackDataKey  = strtolower(str_replace(" ","",trim($getTrackingData["title"])));
        $trackDataKey  = str_replace(" ","",trim($getTrackingData["title"]));
        print_r($trackDataKey);
      }else{
        echo "";
      }
    }

    function get_tables_campaign_running(){
      // echo "tset";die;
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length")); 
        
        if(!empty($this->input->post('todate'))){
          $todate = date('Y-m-d',strtotime($this->input->post('todate')));
        }else{
          $todate = date('Y-m-d');
        }

        // $user_id = $this->session->userdata('userChain');
        $user_id = $this->input->post('user_id');
        $campaign = $this->input->post('campaign');

        if(!empty($this->input->post('fromdate'))){
          $fromdate = date('Y-m-d',strtotime($this->input->post('fromdate')));
        }else{
          $fromdate = date('Y-m-d');
        }

        $getusers = $this->composesmss->getSummaryCampaignTemp($campaign,$user_id,$todate,$fromdate);

      
        // print_r($getusers);die;

        $mem = array();  
        $i=1;
        foreach($getusers->result() as $r) {   
            
            $mem[] = array(
                $i,
                $r->header,
                $r->account,
                $r->campaign,
                $r->scheduled_time,
                $r->TotalCount
            ); 
            $i++;
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
}