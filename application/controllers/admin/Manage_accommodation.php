<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_accommodation extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
    }
    
        function index(){
        $this->load->model("workplaces");
        $s = $this->input->get('search');
        $workplaces = $this->workplaces->getByName($s);
        $data['s'] = $s;
        $data['workplaces'] = $workplaces;

        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/manage_accommodation/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/manage_accommodation/script");

    }
    
    // function index(){
    //     $this->load->model("accommodations");
    //     $accommodations = $this->accommodations->get([
    //         'workplace_id' => $this->input->get('workplace_id')
    //     ]);
    //     $data['accommodations'] = $accommodations;

    //     // $search_str = '';
    //     // $conditonWhere = [];
    //     // if(isset($search)){
    //     //     $conditonWhere['firstname'] = $search;
    //     //     $search_str = '?search='. $search;
    //     // }

    //     // $this->load->library('pagination');
    //     // $config = config_pagination();
    //     // $config['base_url'] = base_url('admin/import_lecturer').$search_str;
    //     // $config['total_rows'] = $this->lecturers->count($conditonWhere,true,true);
    //     // $config['per_page'] = 10;
    //     // $this->pagination->initialize($config);
    //     // $page = ($this->input->get('per_page') ) ? $this->input->get('per_page')  : 0;

        
    //     // $lecturers = $this->lecturers->get($conditonWhere,[],$config['per_page'],$page,true,true);

    //     // $data['search'] = $search;
    //     // $data['lecturers'] = $lecturers;
    //     // $data['total_rows'] = $config['total_rows'];
    //     // $data['links'] = $this->pagination->create_links();
    //     $data['workplace_id'] = $this->input->get('workplace_id');

    //     $this->load->view("layout/head");
	// 	$this->load->view("layout/header");
	// 	$this->load->view("admin/layout/left-menu");
	// 	$this->load->view("admin/manage_accommodation/content", $data);
	// 	$this->load->view("layout/footer");
    //     $this->load->view("layout/foot");
    //     $this->load->view("admin/manage_accommodation/script");
    // }

    function create(){
        // $workplace_id = $this->input->get('workplace_id');
        // dd($workplace_id);
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/manage_accommodation/create/content");
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("admin/manage_accommodation/create/script");
    }

}