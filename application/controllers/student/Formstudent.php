<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formstudent extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model("students");
		
    }
    	public function index(){
				$s = $this->input->get('search');
				$data['s'] = $s;
				$students = $this->students->getStudentByFirstnameOrLastname($s);
				$user = get_user_session();
				$data['students'] = $user;
				$this->load->view("layout/head");
				$this->load->view("layout/header");
				$this->load->view("student/layout/left-menu");
				$this->load->view("student/formstudent/content",$data);
				$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("student/formstudent/script");
		}		
			public function update(){
				$this->load->model("users");
				$student = $this->students->first([
						'student_id'=> $this->input->get('id')
				]);
				$user = $this->users->first([
						'id' => $student->user_id
				]);
				$data['student'] = $student;
				$data['user'] = $user;
				$data['isCreate'] = false;
				$this->load->view("layout/head");
				$this->load->view("layout/header");
				$this->load->view("student/layout/left-menu");
				$this->load->view("student/formstudent/create/content", $data);
				$this->load->view("layout/footer");
				$this->load->view("layout/foot");
				$this->load->view("student/formstudent/create/script");
		}
}