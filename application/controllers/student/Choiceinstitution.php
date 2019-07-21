<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Choiceinstitution extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
        $this->load->model('years');
        $this->load->model('enrolls');

    }

    function index(){

        $student_id = "51848885";
        $student_year = '2013';
        $now_year = $this->years->get_now_year();
        
        $enrolls = $this->enrolls->getJoinSubject($student_id,$now_year);

        // dd($enrolls);
        $data['student_year'] = $student_year;
        $data['enrolls'] = $enrolls;
        // dd($enrolls);
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("student/layout/left-menu");
		$this->load->view("student/choiceinstitution/content",$data);
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("student/choiceinstitution/script");
    }

    function choiceinstitution_type(){
        $this->load->model('workplace_subjects');
        $student_id = "51848885";
        $student_year = '2013';
        $now_year = $this->years->get_now_year();
        $schedule = $this->input->get('schedule_id');

        $enrolls = $this->enrolls->getJoinSubject($student_id,$now_year,$schedule)[0];
        
        $workplace_types = $this->workplace_subjects->getJoinWorkplaceTypeArray(
            $enrolls['training_type_id'], $now_year , $schedule);
        // dd($workplace_types);
        $data['workplace_types'] = $workplace_types;
        $data['schedule'] = $schedule;
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("student/layout/left-menu");
		$this->load->view("student/choiceinstitution/choiceinstitution_type/content", $data);
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("student/choiceinstitution/choiceinstitution_type/script");
    }

    function chooseworkplace(){
        $this->load->model('workplace_subjects');
        $schedule = $this->input->get('schedule');
        $workplace_type_id = $this->input->get('workplace_type_id');
        $student_id = "51848885";
        $student_year = '2013';
        $now_year = $this->years->get_now_year();
        $enrolls = $this->enrolls->getJoinSubject($student_id,$now_year,$schedule)[0];
        $workplaces = $this->workplace_subjects->getJoinWorkplace($enrolls['training_type_id'], $now_year , $schedule, $workplace_type_id);
        $data['student_id'] = $student_id;
        $data['workplaces'] = $workplaces;
        // dd($workplaces);
        $data['enroll_id'] = $enrolls['enroll_id'];
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("student/layout/left-menu");
		$this->load->view("student/choiceinstitution/chooseworkplace/content",$data);
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("student/choiceinstitution/chooseworkplace/script");
    }


}