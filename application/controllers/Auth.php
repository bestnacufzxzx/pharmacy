<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    function login(){
        $this->load->model("Information");
		$news1 = $this->Information->getNewsByType1();
		$news2 = $this->Information->getNewsByType2();
		$news3 = $this->Information->getNewsByType3();
		$data['newss1'] = $news1;
		$data['newss2'] = $news2;
        $data['newss3'] = $news3;
        $this->load->view("auth/login", $data);

    }

    function logout(){
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    function shownews(){

        $newsid = $_GET['newsid'];
        $this->load->model("Information");
		$newsTypeId = 1;
		$newsdetail = $this->Information->getNewsById($newsid);
		$data['newsdetails'] = $newsdetail;
        $this->load->view("auth/shownews/content",$data);


    }

    


}