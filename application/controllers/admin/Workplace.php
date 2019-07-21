<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workplace extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
        // $this->load->view("lib");
        $this->load->model("workplaces");
        $this->load->model("workplace_types");
    }

    function index(){
        $search = $this->input->get('search');
        $search_str = '';
        $conditonWhere = [];
        if(isset($search)){
            $conditonWhere['workplace_name'] = $search;
            // $conditonWhere['lastname'] = $search;
            $search_str = '?search='. $search;
        }

        $this->load->library('pagination');
        $config = config_pagination();
        $config['base_url'] = base_url('admin/workplace').$search_str;
        $config['total_rows'] = $this->workplaces->count($conditonWhere,true,true);
        $data['total_rows'] = $config['total_rows'];
        $data['links'] = $this->pagination->create_links();
        $config['per_page'] = 999;
        $this->pagination->initialize($config);
        $page = ($this->input->get('per_page') ) ? $this->input->get('per_page')  : 0;

        $workplaces = $this->workplaces->get($conditonWhere,[],$config['per_page'],$page,true,true);


        $data['search'] = $search;
        $data['workplaces'] = $workplaces;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/workplace/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/workplace/script");
    }

    public function create(){
        $this->load->model("workplace_types");
        $workplace_types = $this->workplace_types->get();
        $data['workplace_types'] = $workplace_types;
        $data['isCreate'] = true;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/workplace/create/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/workplace/create/script");
    }

    public function update(){
        $this->load->model("workplace_types");
        $workplace_types = $this->workplace_types->get();
        $workplace = $this->workplaces->first([
            'workplace_id'=> $this->input->get('id')
        ]);
        $user = $this->workplaces->first([
            'workplace_id' => $workplace->workplace_type_id
        ]);
        $data['workplace'] = $workplace;
        $data['workplace_types'] = $workplace_types;
        $data['isCreate'] = false;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/workplace/create/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/workplace/create/script");
    }

    public function import(){
        $data['workplaces'] = $this->workplaces->getAll();
        $this->load->view("admin/layout/head");
        $this->load->view("admin/layout/header");
        $this->load->view("admin/layout/left-menu");
        $this->load->view("admin/workplace/import/content", $data);
        $this->load->view("admin/layout/footer");
        $this->load->view("admin/layout/foot");
        $this->load->view("admin/workplace/import/script");

    }
    public function WorkplaceType(){
        $this->load->model("Workplace_types");
        $s = $this->input->get('search');
        $workplace_types = $this->workplace_types->getWorkplacetypeByTypename($s);
        $data['s'] = $s;
        $data['workplace_types'] = $workplace_types;
        // $data["workplace_type"] = $this->Workplace_types->getWorkplace_typeById($workplace_typeId);
        
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/workplace/workplaceType/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/workplace/workplaceType/script");

    }

    
}