<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject_responsible extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
		$this->load->model('lecturer_responsibles');
		$this->load->model('years');
		$this->load->model('enrolls');
    }

    function index(){
        $user = get_user_session();
        $lecturer_id = $user->lecturer_id;
        $this_year = $this->years->get_now_year();
        $years = $this->years->get([
            'year <=' => $this_year
        ],[
            'year' => 'DESC'
        ]);
        $year_select = $this->input->get('select_year');
        if($year_select == null){
            $year_select = $this_year;
        }
        $subject_responsibles = $this->lecturer_responsibles->getSubjectTeach($lecturer_id, $year_select);
        foreach($subject_responsibles as $key => $subject_responsible){
            $count = $this->enrolls->count([
                'subject_teach_id' => $subject_responsible['subject_teach_id'],
                'year' => $subject_responsible['year']
            ]);
            $subject_responsibles[$key] += [ "count_enroll" => $count ];
        }
        $data['year_select'] = $year_select;
        $data['years'] = $years;
        $data['subject_responsibles'] = $subject_responsibles;
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("lecturer/layout/left-menu");
		$this->load->view("lecturer/subject_responsible/content", $data);
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("lecturer/subject_responsible/script");
    }

    function enroll_detail(){
        $year = $this->input->get('year');
        $subject_teach_id = $this->input->get('subject_teach_id');
        
        $students = $this->enrolls->getJoinStudentForcheckReport($subject_teach_id, $year);

        $data['students'] = $students;
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("lecturer/layout/left-menu");
		$this->load->view("lecturer/subject_responsible/enroll_detail/content", $data);
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("lecturer/subject_responsible/enroll_detail/script");
    }

}