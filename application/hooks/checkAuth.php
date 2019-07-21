<?php
class CheckAuth {
    function isAuth()
    {
        if(!isset($_SESSION['user'])){
            return null;
        }
        $s_user = $_SESSION['user'];
        $ci =&get_instance();
        $ci->load->model('users');
        $user = $ci->users->first([
            'id' => $s_user['user'],
            'key' => $s_user['key']
        ]);
        if(!is_null($user)){
            return $user->type;
        }else{
            return null;
        }
    }
    function allowPage($p1,$p2=null,$p3=null)
    {
        if($p1 == 'api' && $p2 == 'auth'){
            return true;
        }
        return false;
    }
    function allowWhenLogin($p1,$p2=null,$p3=null)
    {
        if($p1 == 'auth' && $p2 == 'logout'){
            return true;
        }
        if($p1 == 'api'){
            return true;
        }
        return false;
    }
    function check_user(){
        $uri =& load_class('URI');
        $p1 = $uri->segment(1);
        $p2 = $uri->segment(2);
        $p3 = $uri->segment(3);
        
        if($this->allowPage($p1,$p2,$p3)){
            return;
        }
       
        $auth_type = $this->isAuth();
        $isLogin = !is_null($auth_type);
        if($isLogin){
            if($this->allowWhenLogin($p1,$p2,$p3)){
                return;
            }
            $auth_path = type_to_path($auth_type);
            if($p1 != $auth_path){
                redirect($auth_path."/welcome");
            }
            // dd();
        }else{
            if($p1 != 'auth'){
                redirect("auth/login");
            }
        }
    }
}