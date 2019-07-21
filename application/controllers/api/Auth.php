<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends BD_Controller {

    function __construct()
    {
        // // Construct the parent class
        parent::__construct();

        // // Configure limits on our controller methods
        // // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        // $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        // $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        // $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('users');
        
    }
    
    public function login_post()
    {
        $username = $this->post('username'); //Username Posted
        $password = $this->post('password'); //Pasword Posted
        $user = $this->users->first(['username' => $username]);
        if(!is_null($user) && password_verify($password,$user->password)){
            $key = md5(uniqid());
            $this->users->update([
                'id'=>$user->id
            ],[
                'key'=>$key
            ]);
            $this->session->set_userdata('user', [
                'user'=>$user->id,
                'key'=>$key
            ]);
            $output["url"] = base_url(type_to_path($user->type));
            $this->set_response($output, REST_Controller::HTTP_OK);    
        }else{
            $output["status"] = false;
            $output["message"] = 'เข้าสู่ระบบไม่สำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);    
        }
        
    }

}
