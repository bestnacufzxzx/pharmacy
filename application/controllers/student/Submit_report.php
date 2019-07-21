<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submit_report extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
        // $this->load->view("lib");
        $this->load->model("assessments");
    }

    function index(){
        $user = get_user_session();
        $assessments = $this->assessments->getAllAssessment($user->student_id);
     
        $data['assessments'] = $assessments;

        $this->load->view("layout/head");
        $this->load->view("layout/header");
        $this->load->view("student/layout/left-menu");
        $this->load->view("student/submit_report/content",$data);
        $this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("student/submit_report/script");
    }
    
}