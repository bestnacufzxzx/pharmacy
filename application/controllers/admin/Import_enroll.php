<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_enroll extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
    }

    function index(){
        $this->load->model('enrolls');
        $subject_teach_id = 1;
        $enroll_students = $this->enrolls->getStudentInEnroll($subject_teach_id);
        $data['enroll_students'] = $enroll_students;

        // สำหรับม็อค data
        $this->load->model('students');
        $students = $this->students->get();
        $data['students'] = $students;
        $this->load->model('subjects');
        $subjects = $this->subjects->get();
        $data['subjects'] = $subjects;
        //
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/import_enroll/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/import_enroll/script");

    }

    public function import(){
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/import_enroll/import/content");
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/import_enroll/import/script");

    }
}