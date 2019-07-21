<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assessment_present extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
        $this->load->model("students");
        $this->load->model("assessments");
        $this->load->model("lecturers");
        $this->load->model("subject_teachs");
    }

    function index(){
        $search = $this->input->get('search');
        $user = get_user_session();
        $lecturer_id = $user->lecturer_id;
        $year = date("Y");
        $search_str = '';
        $conditonWhere = [];
        if(isset($search)){
            $conditonWhere['student_id'] = $search;
            $conditonWhere['firstname'] = $search;
            $conditonWhere['lastname'] = $search;
            $search_str = '?search='. $search;
        }
        
        $this->load->library('pagination');
        $config = config_pagination();
        $config['base_url'] = base_url('lecturer/assessment').$search_str;
        $config['total_rows'] = $this->assessments->assessment_count($search, $year, $lecturer_id);
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $page = ($this->input->get('per_page') ) ? $this->input->get('per_page')  : 0;

        $orderby = "student.firstname";
        $students = $this->assessments->assessment_search($search, $year, $lecturer_id, $config['per_page'], $page, $orderby);

        $data['search'] = $search;
        $data['students'] = $students;        
        $data['total_rows'] = $config['total_rows'];
        $data['links'] = $this->pagination->create_links();
        // dd($data);
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("lecturer/layout/left-menu");
		$this->load->view("lecturer/assessment_present/content", $data);
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("lecturer/assessment_present/script");
    }

}