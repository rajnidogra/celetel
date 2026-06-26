<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smsckernallist extends CI_Controller {

   function index(){
       $this->load->view('/smsckernallist');
    } 

    function getsmsckerneldata(){
        
        // $xmlurl = SMSC_DATA_URL();

        // $xmlResponse = XMLtoJSON($xmlurl);
        $xmlResponse = getDATAURL("CHK_SMSC_STATUS");

        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        $mem = array();  

         if($xmlResponse && $xmlResponse["smscs"]["count"]){

            for($i=0;$i<$xmlResponse["smscs"]["count"];$i++){
                $r = $xmlResponse["smscs"]["smsc"][$i];
                $mem[] = array(
                    $r["name"],
                    $r["admin-id"],
                    $r["id"],
                    $r["status"],
                    $r["failed"],
                    $r["queued"],
                    $r["sms"]["received"],
                    $r["sms"]["sent"],
                    $r["sms"]["inbound"],
                    $r["sms"]["outbound"],
                    $r["dlr"]["received"],
                    $r["dlr"]["sent"],
                    $r["dlr"]["inbound"],
                    $r["dlr"]["outbound"],
                );
            }

         }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $xmlResponse["smscs"]["count"],
            "recordsFiltered" => $xmlResponse["smscs"]["count"],
            "data" => $mem,
            "storesize"=>$xmlResponse["sms"]["storesize"]
        );

        echo json_encode($output);
        exit(); 
    }
}