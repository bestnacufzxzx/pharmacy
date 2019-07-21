<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trainer extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
        // $this->load->view("lib");
        $this->load->model("trainers");
        $this->load->model("workplaces");
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
        $config['per_page'] = 20;
        $this->pagination->initialize($config);
        $page = ($this->input->get('per_page') ) ? $this->input->get('per_page')  : 0;

        $workplaces = $this->workplaces->get($conditonWhere,[],$config['per_page'],$page,true,true);


        $data['search'] = $search;
        $data['workplaces'] = $workplaces;

        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/trainer/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/trainer/script");
    }

    public function create(){
        $data['isCreate'] = true;
        $workplace_id = $this->input->get('workplace_id');
        $conditonWhere = ['workplace_id'=>$workplace_id];
        $data['workplace_id'] = $workplace_id;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/trainer/create/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/trainer/create/script", $data);
    }

    public function info_trainer(){
        $search = $this->input->get('search');
        $workplace_id = $this->input->get('workplace_id');
        $search_str = '';
        $conditonWhere = [];
        $conditonWhere['workplace_id'] = $workplace_id;
        if(isset($search)){
            $conditonWhere['firstname'] = $search;
            $conditonWhere['lastname'] = $search;
            $search_str = '?search='. $search;
        }
        $this->load->library('pagination');
        $config = config_pagination();
        $config['base_url'] = base_url('admin/trainer/info_trainer?workplace_id='.$workplace_id).$search_str;
        $config['total_rows'] = $this->trainers->countWithOutTrash($conditonWhere,true,true);
        $data['total_rows'] = $config['total_rows'];
        $data['links'] = $this->pagination->create_links();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $page = ($this->input->get('per_page') ) ? $this->input->get('per_page')  : 0;
        $trainers = $this->trainers->getWithOutTrash($conditonWhere,[],$config['per_page'],$page,true);

        $data['search'] = $search;
        $data['workplace_id'] = $workplace_id;
        $data['trainers'] = $trainers;
        // $data['trainer'] = $trainer; 
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/trainer/info_trainer/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/trainer/info_trainer/script");


    }

    public function update(){
        $this->load->model("users");
        $id = $this->input->get('id');
        
        // $data['workplace_id'] = $this->input->get('id');
        $workplaces = $this->workplaces->get();
        $trainer = $this->trainers->first([
            'trainer_id'=> $this->input->get('id')
        ]);
        $user = $this->users->first([
            'id' => $trainer->user_id
        ]);
        $data['id'] = $id;
        $data['trainer'] = $trainer;
        $data['user'] = $user;
        $data['workplaces'] = $workplaces;
        $data['workplace_id'] = $trainer->workplace_id;
        $data['isCreate'] = false;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/trainer/create/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/trainer/create/script", $data);
    }

    function deleted(){
        $search = $this->input->get('search');
        $workplace_id = $this->input->get('workplace_id');
        $search_str = '';
        $conditonWhere = [];
        $conditonWhere['workplace_id'] = $workplace_id;
        if(isset($search)){
            $conditonWhere['firstname'] = $search;
            $conditonWhere['lastname'] = $search;
            $search_str = '?search='. $search;
        }
        $this->load->library('pagination');
        $config = config_pagination();
        $config['base_url'] = base_url('admin/trainer/info_trainer?workplace_id='.$workplace_id).$search_str;
        $config['total_rows'] = $this->trainers->countInTrash($conditonWhere,true,true);
        $data['total_rows'] = $config['total_rows'];
        $data['links'] = $this->pagination->create_links();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $page = ($this->input->get('per_page') ) ? $this->input->get('per_page')  : 0;
        $trainers = $this->trainers->getInTrash($conditonWhere,[],$config['per_page'],$page,true);

        $data['search'] = $search;
        $data['workplace_id'] = $workplace_id;
        $data['trainers'] = $trainers;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/trainer/deleted/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/trainer/deleted/script", $data);
    }

}