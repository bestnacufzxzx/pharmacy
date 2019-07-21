<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check_student_report extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
    }

    function index(){
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("lecturer/layout/left-menu");
		$this->load->view("lecturer/check_student_report/content");
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("lecturer/check_student_report/script");
    }
    function show_student_list(){
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("lecturer/layout/left-menu");
		$this->load->view("lecturer/check_student_report/show_student_list/content");
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("lecturer/check_student_report/show_student_list/script");
    }
}