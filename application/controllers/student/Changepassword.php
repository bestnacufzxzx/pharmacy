<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Changepassword extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
		// $this->load->view("lib");
		$this->load->model("students");
		$this->load->model("users");
    }

	function index(){
		$user = get_user_session();
		$user_id = $user->user_id;
        $user = $this->users->first([
            'id' => $user_id
        ]);
		$data['user'] = $user;
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("student/layout/left-menu");
		$this->load->view("student/changepassword/content",$data);
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("student/changepassword/script");
	}
}