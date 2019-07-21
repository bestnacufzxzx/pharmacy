<?php
class Subject extends CI_Controller {
    function index(){
        $course_id = $this->input->get('course_id');
        $this->load->model("subjects");
        $this->load->model("courses");
        $this->load->model("training_types");
        $subjects = $this->subjects->getJoinTrainingCourse($course_id);
        $courses = $this->courses->get();
        $training_types = $this->training_types->get([
            'course_id' => $course_id
        ]);
        $data['training_types'] = $training_types;
        $data['course_id'] = $course_id;
        $data['subjects'] = $subjects;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/subject/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/subject/script", $data);
    }
}