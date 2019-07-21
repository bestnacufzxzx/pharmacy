<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workplace_information extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
		// $this->load->view("lib");
    }

    function index(){
        $this->load->model("workplaces");
        $s = $this->input->get('search');
        $workplaces = $this->workplaces->getByName($s);
        $data['s'] = $s;
        $data['workplaces'] = $workplaces;
        $this->load->view("layout/head");
        $this->load->view("layout/header");
        $this->load->view("student/layout/left-menu");
        $this->load->view("student/workplace_information/content", $data);
        $this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("student/workplace_information/script");
    }

    function information(){
        $workplace_id = $this->input->get('workplaceIds');
        $this->load->model("workplaces");
        $workplace_information = $this->workplaces->getJoinWorkplaceType($workplace_id);
        $data['workplace_information'] = $workplace_information[0];
        $this->load->view("layout/head");
        $this->load->view("layout/header");
        $this->load->view("student/layout/left-menu");
        $this->load->view("student/workplace_information/information/content", $data);
        $this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("student/workplace_information/information/script");
    }

}