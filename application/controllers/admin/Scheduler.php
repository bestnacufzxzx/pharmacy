<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scheduler extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
    }

    function index(){

        $this->load->model("schedules");
        $this->load->model("years");
        $this_year = $this->years->get_now_year();
        $search = $this->input->get("search");
        if($search == null){
            $search = $this->years->first([],[
                'year' => 'DESC'
            ])->year;
        }
        $schedules = $this->schedules->get([
            'year' => $search
        ]);
        $years = $this->years->get([],[
            'year' => 'DESC'
        ]);
        $data['search'] = $search;
        $data['schedules'] = $schedules;
        $data['years'] = $years;
        if($schedules == null){
            $checkData = 0;
        }else{
            $checkData = 1;
        }
        $data['checkData'] = $checkData;
        $year = $this->years->whereFirst($search);
        $data['this_year'] = $this_year; 
        $data['min_date'] = $year->start_date;
        $data['max_date'] = $year->end_date;

        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/scheduler/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/scheduler/script", $data);
    }
}