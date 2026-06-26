<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smsc extends CI_Controller {

	function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('smscs');
        // $this->load->helper('config_helper');
    }


    function index(){
    	$data =  array();
        $user_id=$this->session->userdata("userId");
        $data['getsmscids'] = $this->smscs->getgroupsmscids();
    	$this->load->view('smsclist',$data);
    }

    function kernel_edit($id){
        $data =  array();
        $data["contentData"] = $this->smscs->getKernelDetailById($id);
        // print_r($data);die;
        // for($j=1;$j<=intval($data["contentData"]["instances"]);$j++){
        //     $smsc_admin_id = $data["contentData"]["smsc-id"]."_".$j;
        //     $url = SMSC_REMOVE_URL()."&smsc=".$smsc_admin_id; //remove old smsc connection
        //     // $xmlResponse = XMLtoJSON($url);
        // }
        // print_r($data);die;
        $this->load->view('smsclist',$data);
    }

    function kernel_delete($id){
        $data =  array();
        $data["contentData"] = $this->smscs->getKernelDetailById($id);
        $res = $this->smscs->deleteKernelDetail($id);

        if($res){
            for($j=1;$j<=intval($data["contentData"]["instances"]);$j++){
                $smsc_admin_id = $data["contentData"]["smsc-id"]."_".$j;
                $url = getDATAURL("REMOVE_SMSC_LINK","&smsc=".$smsc_admin_id); //remove old smsc connection
                // $xmlResponse = XMLtoJSON($url);
            }
            $this->session->set_flashdata('success', 'SMSC Group has been deleted successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while deleting smsc group data!!!');
        }
        redirect(base_url('smsc')); 
    }
    
    function get_tables_smsckernel(){
    	$draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

    	$getusers=$this->smscs->getkernalDetail();
    	// print_r($getusers->result() );die;
        $mem = array();  
        $i=1;
        foreach($getusers->result_array() as $r) { 

             $edit_url= base_url("smsc/kernel_edit/".$r["id"]);
             $delete_url= base_url("smsc/kernel_delete/".$r["id"]);

            $edit = '<a href="'.$edit_url.'" data-toggle="tooltip" title="Edit" class="fa fa-edit" style="padding-right:5px;"></a> ';
            $delete = '<a href="'.$delete_url.'" data-toggle="tooltip" title="Delete"  class="fa fa-trash" onclick="return confirm(\'Are you sure to delete?\')"  style="padding-right:5px;" ></a>'; 
        	
        	 $mem[] = array(
        	 	$r["smsc-id"],
                $r["alt-charset"],
                $r["transceiver-mode"],
                $r["host"],
                $r["port"],
                $r["smsc-username"],
                $r["smsc-password"],
                $r["system-type"],
                $r["source-addr-ton"],
                $r["source-addr-npi"],
                $r["dest-addr-ton"],
                $r["dest-addr-npi"],
                $r["throughput"],
                $r["instances"],
                $r["smsc-type"],
                $edit. $delete

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

    
    function get_tables()
    {
         // $xmlurl = base_url('assets/sample.xml');
         $xmlurl = SMSC_URL();

        $xmlResponse = XMLtoJSON($xmlurl);
        // print_r($xmlResponse["esme"]);
        // die;


        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        // $getusers=$this->routing_model->getDetail();
        $mem = array();  

         if($xmlResponse && count($xmlResponse["esme"])){

            for($i=0;$i<count($xmlResponse["esme"]);$i++){
                $r = $xmlResponse["esme"][$i];
                $mem[] = array(
                    $r["system-id"],
                    $r["bind-count"],
                    $r["max-binds"],
                    $r["inbound-load"],
                    $r["max-inbound-load"],
                    $r["outbound-load"],
                    $r["mt"],
                    $r["mo"],
                    $r["dlr"],
                    $r["errors"]  
                );
            }

         }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($xmlResponse["esme"]),
            "recordsFiltered" => count($xmlResponse["esme"]),
            "data" => $mem
        );

        echo json_encode($output);
        exit(); 

    }

    function addsmsc(){
         $data =  array();
        $user_id=$this->session->userdata("userId");
        $data["user_id"] = $user_id;
        //echo "tset";die;

        $this->load->view('/addSmsc',$data);
    }

    function savekernelsmsc(){
	    $instances = $this->input->post("instances");
	    $throughput = $this->input->post("throughput");
	    $dest_addr_npi = $this->input->post("dest_addr_npi");
	    $dest_addr_ton   = $this->input->post("dest_addr_ton");
	    $source_addr_npi = $this->input->post("source_addr_npi");
	    $source_addr_ton   = $this->input->post("source_addr_ton");
	    $alt_charset   = $this->input->post("alt_charset");
	    $smsc_id   = $this->input->post("smsc_id");
        $smsc_id_old   = $this->input->post("smsc_id_old");
	    $transceiver_mode   = $this->input->post("transceiver_mode");
	    $host = $this->input->post("host");
	    $port = $this->input->post("port");
	    $smsc_username = $this->input->post("smsc_username");
	    $smsc_password = $this->input->post("smsc_password");
	    $system_type = $this->input->post("system_type");
	    $smsc_type   = $this->input->post("smsc_type");


	    $data = array(
			    'throughput' => $throughput,
			    'dest-addr-npi' => $dest_addr_npi,
			    'dest-addr-ton' => $dest_addr_ton,
			    'source-addr-ton' => $source_addr_ton,
			    'source-addr-npi' => $source_addr_npi,
			    'alt-charset' => $alt_charset,
			    'smsc-id' => $smsc_id,
			    'host' => $host,
			    'port' => $port,
			    'smsc-username' => $smsc_username,
			    'smsc-password' => $smsc_password,
			    'system-type' => $system_type,
			    'instances'=> $instances,
			    'transceiver-mode'=>$transceiver_mode,
			    'smsc-type' => $smsc_type
			 );

            if(!empty($_POST["eid"])){
                for($j=1;$j<=intval($instances);$j++){
                    $smsc_admin_id = $smsc_id_old."_".$j;
                    $url = getDATAURL("REMOVE_SMSC_LINK","&smsc=".$smsc_admin_id); //remove old smsc connection
                    // $xmlResponse = XMLtoJSON($url);
                }
            // getDATAURL("REMOVE_SMSC_LINK","&smsc=".$smsc_id);
            $response = $this->smscs->updateSMPPUser($data,$_POST["eid"]);
    
            }else{
                $response = $this->smscs->insertSMPPUser($data);
    
            }
	    if($response){
		    $this->session->set_flashdata('success', 'Data has been saved successfully.');
	    }else{
		    $this->session->set_flashdata('error', 'Error occured while saving data!!!');
	    }
	    $this->exportConfFile();
        for($j=1;$j<=intval($instances);$j++){
            $smsc_admin_id = $smsc_id."_".$j;
            $url = getDATAURL("ADD_SMSC_LINK","&smsc=".$smsc_admin_id);
            // $xmlResponse = XMLtoJSON($url);
        }
	    redirect('smsc'); 

    }

    function exportConfFile(){
        $response = $this->smscs->getSmppConfDetail();

        $url = filePathForWriteSMSCData();

        $myfile = fopen($url, "w") or die("Unable to open file!");
        $saveData = "";
    	for($i=0;$i<sizeof($response);$i++){
    		for($j=1;$j<=intval($response[$i]["instances"]);$j++){
    			$code = $response[$i]["transceiver-mode"];
    			if ($code == "RX"){
    				$port = "receive-port = ".$response[$i]["port"]."\n";
    			} else {
    				$port = "port = ".$response[$i]["port"]."\n";
    			}
    			if (($code == "RX")||($code == "TX")){
    				 $transceiver_mode = "transceiver-mode = 0\n";
    			}
    			if ($code == "TRX"){
    				 $transceiver_mode = "transceiver-mode = 1\n";
    			}
    			$fixed = "group = "."smsc"."\n"."smsc = "."smpp"."\n";
    			$smsc = "smsc-id = ".$response[$i]["smsc-id"]."\n";
                if($response[$i]["alt-charset"]!=='DEFAULT'){
                    $alt_charset = "alt-charset = ".$response[$i]["alt-charset"]."\n";
                }else{
                    $alt_charset = "";
                }
    			$smsc_admin_id = "smsc-admin-id = ".$response[$i]["smsc-id"]."_".$j."\n";
    			$host = "host = ".$response[$i]["host"]."\n";
    			$smsc_username = "smsc-username = ".$response[$i]["smsc-username"]."\n";
    			$smsc_password = "smsc-password = ".$response[$i]["smsc-password"]."\n";
    			$system_type = "system-type = ".$response[$i]["system-type"]."\n";
    			$source_addr_ton = "source-addr-ton = ".$response[$i]["source-addr-ton"]."\n";
    			$dest_addr_ton = "dest-addr-ton = ".$response[$i]["dest-addr-ton"]."\n";
    			$source_addr_npi = "source-addr-npi = ".$response[$i]["source-addr-npi"]."\n";
    			$dest_addr_npi = "dest-addr-npi = ".$response[$i]["dest-addr-npi"]."\n";
    			$throughput = "throughput = ".$response[$i]["throughput"]."\n";
    			$allowed_smsc_id = "allowed-smsc-id = ".$response[$i]["smsc-id"]."\n";


    			$save = $fixed.$smsc.$alt_charset.$smsc_admin_id.$transceiver_mode.$host.$port.$smsc_username.$smsc_password.$system_type.$source_addr_npi.$source_addr_ton.$dest_addr_npi.$dest_addr_ton.$throughput.$allowed_smsc_id.$smsc_type;

    			$saveData .= $save.PHP_EOL;
    		}
    	}
        		$response = fwrite($myfile, $saveData);

       
        fclose($myfile);
        
        if($response){
            $this->session->set_flashdata('success', 'Data has been update successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while updating data!!!');
        }

        //redirect('smsc/addsmsckernel'); 
        //die;
    }

    // function savekernelsmscOld()
    // {
    //     $SMSC= ""; 
    //     $SMSC_ID= ""; 
    //     $alt_charset= ""; 
    //     $host= ""; 
    //     $Port= ""; 
    //     $smsc_username= ""; 
    //     $smsc_password= ""; 
    //     $system_type= ""; 
    //     $source_addr_ton= ""; 
    //     $source_addr_npi= ""; 
    //     $allowed_smsc_id= ""; 
    //     $transreceiver_mode= ""; 
    //     $throughput= "";

    //     if($this->input->post("SMSC")){ $SMSC = "smsc = ".$this->input->post("SMSC")."\n"; }
    //     if($this->input->post("SMSC_ID")){ $SMSC_ID = "smsc-id = ".$this->input->post("SMSC_ID")."\n"; }
    //     if($this->input->post("alt_charset")){ $alt_charset = "alt-charset = ".$this->input->post("alt_charset")."\n"; }
    //     if($this->input->post("host")){ $host = "host = ".$this->input->post("host")."\n"; }
    //     if($this->input->post("Port")){ $Port = "port = ".$this->input->post("Port")."\n"; }
    //     if($this->input->post("smsc_username")){ $smsc_username = "smsc-username = ".$this->input->post("smsc_username")."\n"; }
    //     if($this->input->post("smsc_password")){ $smsc_password = "smsc-password = ".$this->input->post("smsc_password")."\n"; }
    //     if($this->input->post("system_type")){ $system_type = "system-type = ".$this->input->post("system_type")."\n"; }
    //     if($this->input->post("source_addr_ton")){ $source_addr_ton = "source-addr-ton = ".$this->input->post("source_addr_ton")."\n"; }
    //     if($this->input->post("source_addr_npi")){ $source_addr_npi = "source-addr-npi = ".$this->input->post("source_addr_npi")."\n"; }
    //     if($this->input->post("allowed_smsc_id")){ $allowed_smsc_id = "allowed-smsc-id = ".$this->input->post("allowed_smsc_id")."\n"; }
    //     if($this->input->post("transreceiver_mode")){ $transreceiver_mode = "transceiver-mode = ".$this->input->post("transreceiver_mode")."\n"; }
    //     if($this->input->post("throughput")){ $throughput = "throughput = ".$this->input->post("throughput")."\n"; }


    //     // $url = base_url('assets/sample.conf');
    //     $url = filePathForWriteSMSCData();

    //     $myfile = fopen($url, "w") or die("Unable to open file!");
    //     // $txt = "John Doe\n";

    //     $save = $SMSC.$SMSC_ID.$alt_charset.$host.$Port. $smsc_username.$smsc_password.$system_type.$source_addr_ton.$source_addr_npi.$allowed_smsc_id.$transreceiver_mode.$throughput;
    //     $response = fwrite($myfile, $save);
    //     // $txt = "Jane Doe\n";
    //     // fwrite($myfile, $txt);
    //     fclose($myfile);


    //     if($response){
    //         $this->session->set_flashdata('success', 'Data has been saved successfully.');
    //     }else{
    //         $this->session->set_flashdata('error', 'Error occured while saving data!!!');
    //     }

    //     redirect('smsc/addsmsckernel'); 

    // }

    function smsckernellist(){
        $data =  array();
        $user_id=$this->session->userdata("userId");
        $data["user_id"] = $user_id;
        // echo "tset";die;

        $this->load->view('/smsclist',$data);
    } 

    function getsmsckerneldata(){
        

        $xmlurl = SMSC_DATA_URL();

        // $data = file_get_contents($xmlurl);


        $xmlResponse = XMLtoJSON($xmlurl);


        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        // $getusers=$this->routing_model->getDetail();
        $mem = array();  

         if($xmlResponse && $xmlResponse["smscs"]["count"]){

            // print_r($xmlResponse["sms"]["storesize"]);die;

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

    function serverStatus(){
        $data =  array();
        $user_id=$this->session->userdata("userId");
        $data["user_id"] = $user_id;
        // echo "tset";die;

        $this->load->view('/serverStatus',$data);
    }

    function serverStatusTables(){

        // $xmlurl = SERVER_STATUS_URL();
        $header = "username:admin\r\n".
                    "password:monit\r\n";
        // $xmlResponse = XMLtoJSON($xmlurl,$header);

        // print_r($xmlResponse);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, SERVER_STATUS_URL());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

            curl_setopt($ch, CURLOPT_USERPWD, 'admin' . ':' . 'monit');

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);


        $fileContents = str_replace(array("\n", "\r", "\t"), '', $result);

        $fileContents = trim(str_replace('"', "'", $fileContents));

        $simpleXml = simplexml_load_string($fileContents);

        $json = json_encode($simpleXml);

        $arr = json_decode($json, true);
        // echo "<pre>";
            // print_r($arr["service"][0]["@attributes"]["type"]);
        

        // die;
         $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   

        // $getusers=$this->routing_model->getDetail();
        $mem = array();  
        $mem5 = array();  
        $count = 1;
         if($arr && $arr["service"]){

            for($i=0;$i<count($arr["service"]);$i++){
                $r = $arr["service"][$i];

                if($r["@attributes"]["type"]==3){
                // echo $attribute = $r["@attributes"];
                    $mem[] = array(
                        $r["name"],
                        $r["collected_sec"],
                        $r["collected_usec"],
                        $r["status"],
                        $r["status_hint"],
                        $r["monitor"],
                        $r["monitormode"],
                        $r["onreboot"],
                        $r["pendingaction"],
                    );
                    $count++;
                }else{
                    $mem5 = array($r);
                }
            }

         }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $mem,
            "type5"=>$mem5
        );

        echo json_encode($output);
        exit(); 
    }

    function updatesmscId(){
        $smscId = $this->input->post('smscId');
        $newsmsc = $this->input->post('newsmsc');
  
        $data= array('smsc-id'=>$newsmsc);
  
        if($smscId!='all'){
          $res = $this->smscs->updateSMPPUserId($smscId,$data);
        }else{
          $res = $this->smscs->updateSMPPUserAllId($data);
        }
  
          if($res){
              $this->session->set_flashdata('success', 'User has been deleted successfully.');
          }else{
              $this->session->set_flashdata('error', 'Error occured while deleting user data!!!');
          }
          // redirect('smsckernel'); 
      }
}
