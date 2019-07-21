<?php
class Training_type extends CI_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model("training_types");
    }

    function index(){
        $course_id = $this->input->get('course_id');
        
        $trainingTypes = $this->training_types->get([
            'course_id' => $course_id
        ]);
        $data['course_id'] = $course_id;
        $data['trainingTypes'] = $trainingTypes;

        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/training_type/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/training_type/script", $data);

    }
}