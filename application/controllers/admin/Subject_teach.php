<?php
class Subject_teach extends CI_Controller {

    function __construct()
    {
		parent::__construct();
        $this->load->model("lecturers");
        $this->load->model("years");
        $this->load->model("lecturer_responsibles");
        $this->load->model("subjects");
        $this->load->model("subject_teachs");
    }


    function index(){
        // ข้อมูลสำหรับม็อคหน้าเว็บ
        $course_id = $this->input->get('course_id');
        $next_year = $this->years->get_now_year()+1;
        $this->load->model('subject_teachs');
        $subject_teachs = $this->subject_teachs->getJoinSubject($next_year, $course_id);  

        $data['course_id'] = $course_id;
        $data['subject_teachs'] = $subject_teachs;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/subject_teach/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/subject_teach/script", $data);
    }

    public function add(){

        $course_id = $this->input->get('course_id');
        $lecturers = $this->lecturers->get([
            'course_id' => $course_id
        ]);
        $subjects = $this->subjects->get([
            'course_id' => $course_id
        ]);
        $data['course_id'] = $course_id;
        $data['subjects'] = $subjects;
        $data['lecturers'] = $lecturers;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/subject_teach/add/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/subject_teach/add/script", $data);
    }


    public function update(){
        
        $this->load->model("subjects");
        $this->load->model("subject_teachs");
        $subject_teach_id = $this->input->get('subject_teach_id');
        $subject_id = $this->input->get('subject_id');
        $course_id = $this->input->get('course_id');
        $lecturers = $this->lecturers->get([
            'course_id' => $course_id
        ]);
        $subjects = $this->subjects->get();
        $subject_teachs = $this->subject_teachs->getSubjectTeachById($subject_teach_id);
        $subject_for_update = $this->subjects->first([
            'subject_id' => $subject_id
        ]);
        
        $lecurer_responsibles = $this->lecturer_responsibles->getLecturerId($subject_teach_id);
        
        $data['course_id'] = $course_id;
        $data['subject_for_update'] = $subject_for_update;
        $data['subjects'] = $subjects;
        $data['lecturers'] = $lecturers;
        $data['subject_teachs'] = $subject_teachs;
        $data['lecurer_responsibles'] = $lecurer_responsibles;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/subject_teach/update/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/subject_teach/update/script", $data);
    }
}