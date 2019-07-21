<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_training extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
        $this->load->model('years');
        $this->load->model('students');
        $this->load->model('enrolls');
    }

    function index(){
        $this_year = $this->years->get_now_year();
        $select_year = $this->input->get('select_year');
        $years = $this->years->get([
            'year <=' => $this_year+1
        ],[
            'year' => 'DESC'
        ]);
        if(is_null($select_year)){
            $select_year = $this_year;
        }
        
        $students = $this->enrolls->getJoinStudentForTraining($select_year);
        $data['select_year'] = $select_year;
        $data['students'] = $students;
        $data['years'] = $years;
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("lecturer/layout/left-menu");
		$this->load->view("lecturer/student_training/content", $data);
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("lecturer/student_training/script");
    }

    function student_training_detail(){
        $year = $this->input->get('year');
        $student_id = $this->input->get('student_id');
        $enrolls =$this->enrolls->getForTrainingDetail($student_id);
        $data['enrolls'] = $enrolls;
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("lecturer/layout/left-menu");
		$this->load->view("lecturer/student_training/student_training_detail/content", $data);
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("lecturer/student_training/student_training_detail/script");
    }

}