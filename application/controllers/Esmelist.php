<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Esmelist extends CI_Controller {

	function index(){
        $this->load->view('/esmelist');
    }

    function getBindsData(){
        $position = $this->input->post('position');
        // $xmlurl = base_url('assets/sample.xml');
        //  $xmlurl = SMSC_URL();
        // $data = "";
        // $xmlResponse = XMLtoJSON($xmlurl);

         $xmlResponse = getDATAURL("CONNECTED_ESME");

        if(isset($position)){
            $r = $xmlResponse["esme"][$position]['bind'];
        }else{
            $r = $xmlResponse["esme"]['bind'];
        }

        if(isset($r[0])){
            for($i=0;$i<count($r);$i++){
                $data .= '<tr><td>'.$r[$i]["bind-id"].'</td><td>'.$r[$i]["ip"].'</td><td>'.$r[$i]["uptime"].'</td><td>'.$r[$i]["bind-type"].'</td></tr>';
            }
        }else{
            $data .= '<tr><td>'.$r["bind-id"].'</td><td>'.$r["ip"].'</td><td>'.$r["uptime"].'</td><td>'.$r["bind-type"].'</td></tr>';
        }
        echo $data;
    }

    function get_tables()
    {
        // $xmlurl = SMSC_URL();
        
        // $xmlResponse = XMLtoJSON($xmlurl);//11
        $xmlResponse = getDATAURL("CONNECTED_ESME");
        // print_r($xmlResponse);die;
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));   
        $mem = array();  
         if($xmlResponse && count($xmlResponse["esme"])){
            // print_r($xmlResponse["esme"]);die;
            // for($i=0;$i<count($xmlResponse["esme"]);$i++){
            //     $r = $xmlResponse["esme"][$i];
            //     $mem[] = array(
            //         $r["system-id"],
            //         $r["bind-count"],
            //         $r["max-binds"],
            //         $r["inbound-load"],
            //         $r["max-inbound-load"],
            //         $r["outbound-load"],
            //         $r["mt"],
            //         $r["mo"],
            //         $r["dlr"],
            //         $r["errors"]  
            //     );
            // }

            if(isset($xmlResponse["esme"][0])){
                for($i=0;$i<count($xmlResponse["esme"]);$i++){
                    $r = $xmlResponse["esme"][$i];
                    $mem[] = array(
                        $r["system-id"],
                        // '<a href="JavaScript:;" data-bs-toggle="modal" data-target="#exampleModal1" class="btn btn-light" onclick="showBindData('.$i.')">'.$r["bind-count"].'</a>',
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
            }else{
                $r = $xmlResponse["esme"];
                // $binds = json_encode($r["bind"]);
                $mem[] = array(
                    $r["system-id"],
                    // '<a href="JavaScript:;" data-bs-toggle="modal" data-target="#exampleModal1" class="btn btn-light" onclick="showBindData()">'.$r["bind-count"].'</a>',
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
}