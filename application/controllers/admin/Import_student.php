<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_student extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model("students");
    }

    function index(){
        $search = $this->input->get('search');

        $search_str = '';
        $conditonWhere = [];
        if(isset($search)){
            $conditonWhere['firstname'] = $search;
            $conditonWhere['lastname'] = $search;
            $search_str = '?search='. $search;
        }
        $this->load->library('pagination');
        $config = config_pagination();
        $config['base_url'] = base_url('admin/import_student').$search_str;
        $config['total_rows'] = $this->students->count($conditonWhere,true,true);
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $page = ($this->input->get('per_page') ) ? $this->input->get('per_page')  : 0;

        $students = $this->students->get($conditonWhere,[],$config['per_page'],$page,true,true);

        $data['search'] = $search;
        $data['students'] = $students;
        $data['total_rows'] = $config['total_rows'];
        $data['links'] = $this->pagination->create_links();

        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/import_student/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/import_student/script");
    }

    public function create(){
        $data['isCreate'] = true;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/import_student/create/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/import_student/create/script");
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
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/import_student/create/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/import_student/create/script");
    }

    public function import(){
        $data['students'] = $this->students->getAll();
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/import_student/import/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/import_student/import/script");
    }

}