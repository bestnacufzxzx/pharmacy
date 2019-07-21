<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assessment_result extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model("students");
        $this->load->model("assessments");
		// $this->load->view("lib");
    }

	function index(){
        $user = get_user_session();
        $assessments = $this->assessments->getAllAssessment($user->student_id);
        // var_dump($assessments);
        // exit();
        $data['students'] = $user;
        $data['assessments'] = $assessments;

        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("student/layout/left-menu");
		$this->load->view("student/assessment_result/content", $data);
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("student/assessment_result/script");
	}
}