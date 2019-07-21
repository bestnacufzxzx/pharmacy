<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formlecturer extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
		$this->load->model("lecturers");
    }

    function index(){
		$s = $this->input->get('search');
		$lecturers = $this->lecturers->getByFirstnameOrLastname($s);
   		$data['s'] = $s;
        // $data['lecturers'] = $lecturers[0];
        $user = get_user_session();
        $data['lecturers'] = $user;
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("lecturer/layout/left-menu");
		$this->load->view("lecturer/formlecturer/content",$data);
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("lecturer/formlecturer/script");
    }

   
    public function update(){
        $this->load->model("courses");
        $this->load->model("users");
        $courses = $this->courses->get();
        $lecturer = $this->lecturers->first([
            'lecturer_id'=> $this->input->get('id')
        ]);
        $user = $this->users->first([
            'id' => $lecturer->user_id
        ]);
        $data['lecturer'] = $lecturer;
        $data['user'] = $user;
        $data['courses'] = $courses;
        $data['isCreate'] = false;
        $this->load->view("layout/head");
        $this->load->view("layout/header");
        $this->load->view("lecturer/layout/left-menu");
        $this->load->view("lecturer/formlecturer/create/content", $data);
        $this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("lecturer/formlecturer/create/script");
    }
	
}