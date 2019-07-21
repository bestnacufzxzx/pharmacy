<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Admin extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    function updateAdminPassword_post()
    {
        $this->load->model('users');

        //check update
        if(!is_null($this->post('username'))){
            $user = $this->users->first([
                'username'=>$this->post('username')
            ]);
        }
        $isUser = !is_null($user);

        if($isUser){
            $data = [
                'username'=> $this->post("username")
            ];
            if($this->post("password") != ""){
                $data['password'] = password_hash($this->post("password"), PASSWORD_BCRYPT);
            }
            $result = $this->users->update([
                'id' => $user->id
            ],$data);
        }

        if($result){
            $output["message"] = 'บันทึกสำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $output["status"] = false;
            $output["message"] = 'เกิดข้อผิดพลาดในการบันทึก';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }

    }


}
