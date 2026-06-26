
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissionuser extends CI_Controller {

        function __construct() {
        parent::__construct();
        is_login();
        $this->load->model('permissionsuser');
    }

    function index(){
        $data = array();
        $data["userTypes"] = $this->permissionsuser->getUsersTypeList();
        $this->load->view('permission_user',$data);
    }



    function getUserByType(){
        $userType = $this->input->post('user_type');
        // print_r($userType);die;
        $getuser = $this->permissionsuser->getUsersByTypes($userType);
        echo '<option value="">Select User</option>';
        foreach ($getuser as $value) {
                echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
        }
        // print_r($getuser);
    }

    function get_tables(){
        $user_type = $this->input->post('user_type');
        $user_id = $this->input->post('user_id');


        $draw = intval($this->input->get("draw"));
                $start = intval($this->input->get("start"));
                $length = intval($this->input->get("length"));

                $getusers=$this->permissionsuser->getMenuList();
                $mem = array();
                $i=1;
                $permission = array();

                $getPermission = $this->permissionsuser->getPermissionByUser($user_id);

                if(!isset($getPermission)){
                        $getPermission = $this->permissionsuser->getPermissionByUserType($user_type);
                }


                if(isset($getPermission)){
                        $permission = json_decode($getPermission["text"],true);
                }


                foreach($getusers->result() as $r) {
                        $permission_name = $r->permission_name;
                        $name = $r->name;
                        // print_r($permission);
                        // print_r($permission[$permission_name]);

            $checkbox = '<input type="checkbox" name="selceRow" id="select'.$i.'" onclick="onClickCheck('.$i.')">';

                        if(array_key_exists($permission_name,$permission) && $permission[$permission_name]["read"]==1){
                                $read = '<input type="checkbox" name="read[]" id="read'.$i.'" class="js-switch js-switch-1" data-color="#e69a2a" checked value="'.$permission_name.'">';
                $checkbox = '<input type="checkbox" name="selceRow" id="select'.$i.'" onclick="onClickCheck('.$i.')" checked="checked" />';
                        }else{
                                $read = '<input type="checkbox" name="read[]" id="read'.$i.'" class="js-switch js-switch-1" data-color="#e69a2a" value="'.$permission_name.'">';
                        }

                        if(array_key_exists($permission_name,$permission) && $permission[$permission_name]["write"]==1){
                                $write = '<input type="checkbox" name="write[]" id="read"'.$i.'" class="js-switch js-switch-1" data-color="#e69a2a" checked value="'.$permission_name.'">';
                $checkbox = '<input type="checkbox" name="selceRow" id="select'.$i.'" onclick="onClickCheck('.$i.')"> checked="checked" />';
                        }else{
                                $write = '<input type="checkbox" name="write[]" id="read"'.$i.'" class="js-switch js-switch-1" data-color="#e69a2a" value="'.$permission_name.'">';
                        }

                        if(array_key_exists($permission_name,$permission) && $permission[$permission_name]["delete"]==1){
                                $delete = '<input type="checkbox" name="delete[]" id="read"'.$i.'" class="js-switch js-switch-1" data-color="#e69a2a" checked value="'.$permission_name.'">';
                $checkbox = '<input type="checkbox" name="selceRow" id="select'.$i.'" onclick="onClickCheck('.$i.')"> checked="checked" />';
                        }else{
                                $delete = '<input type="checkbox" name="delete[]" id="read"'.$i.'" class="js-switch js-switch-1" data-color="#e69a2a" value="'.$permission_name.'">';
                        }

                        if($r->parent_id==0){
                                $name = "<strong>".$r->name."</strong>";
                                // $read = "";
                                // $write = "";
                                // $delete = "";
                        }

                        $mem[] = array(
                                    $r->id,//.$checkbox,
                                    $name,
                                    $read,
                                    $write,
                                    $delete
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
    }

    function saveData(){
        // print_r($_POST);die;
        $permission = json_encode($this->getMenuObject($_POST));
        $user_id = $this->input->post('user_id');

        $data = array(
                'user_id'=>$user_id,
                'text'=>$permission,
        );


        $getPermission = $this->permissionsuser->getPermissionByUser($user_id);
        // print_r($getPermission);die;
                if($getPermission){
                        $getusers=$this->permissionsuser->updatePermission($user_id,$data);
                }else{
                $getusers=$this->permissionsuser->savePermission($data);
                }

        if($getusers){
            $this->session->set_flashdata('success', 'Permissions have been saved successfully.');
        }else{
            $this->session->set_flashdata('error', 'Error occured while saving the permissions!!!');
        }

        redirect(base_url('permissionuser'));

    }


    function getMenuObject($data){
        $getusers=$this->permissionsuser->getMenuList();
        // $resultMenus = $getusers->result_array();
        $result = array();
        // print_r($data);die;
        foreach ($getusers->result_array() as $value) {
                $per_name = $value["permission_name"];
                $result[$per_name]["read"] = (in_array($per_name,$data["read"])) ? 1 : 0;
                $result[$per_name]["write"] = (in_array($per_name,$data["write"])) ? 1 : 0;
                $result[$per_name]["delete"] = (in_array($per_name,$data["delete"])) ? 1 : 0;

                // $result[$per_name]["read"] = 0;
                // $result[$per_name]["write"] = 0;
                // $result[$per_name]["delete"] = 0;

                // if(in_array($per_name,$data["read"])){

                // }

                // if(in_array($per_name,$data["write"])){
                //      $result[$per_name]["write"] = 1;
                // }

                // if(in_array($per_name,$data["delete"])){
                //      $result[$per_name]["delete"] = 1;
                // }

        }
        return $result;
        print_r($result);
    }
}
