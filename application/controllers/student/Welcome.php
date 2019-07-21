<?php
class Welcome extends CI_Controller {
    function index(){
        header( "location: student/training_detail" );
        // $this->load->view("layout/head");
		// $this->load->view("layout/header");
        // $this->load->view("student/layout/left-menu");
        // $user = get_user_session();
		// echo $user->firstname;
		// $this->load->view("layout/footer");
        // $this->load->view("layout/foot");
        // $this->load->view("admin/training_type/script");
    }
}