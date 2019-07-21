<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lecturer extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
		// $this->load->view("lib");
    }

    function index(){
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("lecturer/layout/left-menu");
		$this->load->view("layout/footer");
		$this->load->view("layout/foot");
    }

}