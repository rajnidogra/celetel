<?php 
ini_set("display_errors",0);
date_default_timezone_set("Asia/Kolkata");
function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
function is_login(){ 
	if(isset($_SESSION['isUserLoggedIn'])){
		return true;
	}else{
	redirect( base_url().'login', 'refresh');
	}
}
function node_url(){
	// return 'http://219.90.67.152:3004/';
	return 'https://console.celetel.com:9890/';
}

function setting_css($keys = ""){
	// $result = array();
	$result = "";
	if(count($keys)>0){
		for($i=0;$i<count($keys);$i++){
			$result .= '<link rel="stylesheet" type="text/css" href="'.base_url().'assets/'.$keys[$i].'">';
		}
	}
	print_r($result);
}

function setting_js($keys = ""){
	// $result = array();
	$result = "";
	if(count($keys)>0){
		for($i=0;$i<count($keys);$i++){
			$result .= '<script src="'.base_url().'assets/'.$keys[$i].'"></script>';
		}
	}
	print_r($result);
}

function setting_menu()
{  
	$CI = get_instance();		
	$CI->db->select('*');
	$CI->db->from('menu');
	$CI->db->where('status' , '1');
	$CI->db->where('parent_id' , 0);
	$query = $CI->db->get();
	return $result = $query->result_array();
}

function setting_menu_child($parent_id)
{  
	$CI = get_instance();		
	$CI->db->select('*');
	$CI->db->from('menu');
	$CI->db->where('status' , '1');
	$CI->db->where('parent_id' , $parent_id);
	$query = $CI->db->get();
	return $result = $query->result_array();
}

function setting_all($keys='')
{  
	$CI = get_instance();
	$url = $_SERVER['HTTP_HOST'];
	$CI->db->select('user_id');
	$CI->db->from('setting');
	$CI->db->where('value' , $url);
	$querya = $CI->db->get();
	$resulta = $querya->row_array();		
	$userid = $resulta['user_id'];
	// echo "tes;".$url;
	// print_r($resulta);die;
	if(!empty($keys)){
		$CI->db->select('*');
		$CI->db->from('setting');
		$CI->db->where('keys' , $keys);
		$CI->db->where('user_id' , $userid);
		$query = $CI->db->get();
		$result = $query->row();
		if(!empty($result)){
				$result = $result->value;
			// print_r($result);die;

			return $result;
		}
		else
		{
			// echo "test";die;
			return false;
		}
	}
	else{
		$CI->load->model('user');
		$setting= $CI->setting->get_setting();
		return $setting;
	}
	
}

function settingsuserid()
{ 
	$CI = get_instance();
	$url = $_SERVER['HTTP_HOST'];

	$CI->db->select('user_id');
	$CI->db->from('setting');
	$CI->db->where('value' , $url);

	$querya = $CI->db->get();
	$resulta = $querya->row_array(); 
	return $userid = $resulta['user_id'];
} 

function filePathForWriteSMSCData(){
	return "/usr/local/kannel2/sbin/kannel_smsc.conf";
}

function getUserInfo($user_id){
	$CI = get_instance();		
	$queryString = "select usr.*,bill_type.value as bill_type_name,role.name as rolename from users as usr left join billing_types as bill_type on usr.billing_type = bill_type.id left join usertypes as role on usr.user_type =role.id where usr.id='$user_id'";
	$query=$CI->db->query($queryString);
	return $result = $query->row_array();
}

function XMLtoJSON($url,$header=""){

	if($header){
		$opts = [
		    "http" => [
		        "method" => "GET",
		        "header" => "Accept-language: en\r\n" .
		            "Cookie: foo=bar\r\n".$header
		            
		    ]
		];

		$context = stream_context_create($opts);
		$fileContents = file_get_contents($url, false, $context);
	}else{
		$fileContents = file_get_contents($url);
	}
	// $fileContents = file_get_contents($url);
	// print_r(gettype($fileContents));die;
	

	$fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);

	$fileContents = trim(str_replace('"', "'", $fileContents));
	$simpleXml = simplexml_load_string($fileContents,'SimpleXMLElement', LIBXML_NOWARNING | LIBXML_NOERROR);

	$json = json_encode($simpleXml);

	$arr = json_decode($json, true);

	return $arr;
}

function getDATAURL($name,$parms=""){
	if($name!=""){
		$CI = get_instance();
		$CI->db->select('value');
		$CI->db->from('useful_links');
		$CI->db->where('name' , $name);
		$CI->db->where('status' , 1);

		$querya = $CI->db->get();
		$res =  $querya->row_array();
		// print_r($res["value"].$parms);die; 
		return XMLtoJSON($res["value"].$parms);
	}else{
		return "";
	}
}
function SERVER_STATUS_URL(){
	return "https://smpp.celetel.com/monit/";
}
?>
