<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_year extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
    }

    function index(){
        $user = get_user_session();
        // dd($user);
        $this->load->model("years");
        $this->load->library('pagination');
        $config = config_pagination();
        $config['base_url'] = base_url('admin/edit_year');
        $config['total_rows'] = $this->years->count();
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        $page = ($this->input->get('per_page') ) ? $this->input->get('per_page')  : 0;

        $search = $this->input->get('search');
        $years = $this->years->get([],['year'=>'DESC'],$config['per_page'],$page);
        // dd($years);
        $data['all_years'] = $this->years->get([],['year'=>'DESC']);
        $data['now_year'] = $this->years->get_now_year();
        $data['countYear'] = $this->years->count();
        $data['last_year'] = $years[0];
        $data['years'] = $years;
        $data['search'] = $search;
        $data['page'] = $page;
        $data['links'] = $this->pagination->create_links();
        
        $this->load->view("theme/head");
        $this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/year/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/year/script",$data);
    }
}