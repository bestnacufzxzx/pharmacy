<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accommodation extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
        $this->CI = & get_instance();
    }

    function index(){
        $this->load->model("accommodations");
        $this->load->model("workplaces");
        $s = $this->input->post('search');
        $data['s'] = $s;
        $getData = $this->input->get();
        $workplace_id = $getData['workplace_id'];
        if(isset($s)){
            $accommodations = $this->accommodations->getAccommodationByAccommodationName($s,$workplace_id);
        }else{
            $accommodations = $this->accommodations->getAccommodationByWorkplaceId($workplace_id);
        }
        $workplaces = $this->workplaces->getWorkplaceById($workplace_id);     
        $data['workplace'] = $workplaces;
        $data['accommodations'] = $accommodations;

        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/accommodation/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/accommodation/script");
    }  
    public function add(){
        $data = [];
        $this->load->model("accommodations");
        $this->load->model("workplaces");
        $getData = $this->input->get();
        $workplace_id = $getData['workplace_id'];
        $data['workplace_id'] = $workplace_id;
        $data["accommodations"] = $this->accommodations->getAllAccommodation();
        $data["workplaces"] = $this->workplaces->getAllWork_place();

        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/accommodation/add/content",$data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/accommodation/add/script",$data);
    }


    public function update(){
        if($this->input->post('submit') != NULL ){
            $postData = $this->input->post();
            // echo "<b>workplace id :</b> ".$postData['workplaceId']."<br/>";
            $postData = $this->input->post();
                $this->load->model("accommodations");
                $this->load->model("workplaces");
                $accommodationId = $postData['accommodationId'];
                $data["accommodations"] = $this->accommodations->getAllAccommodation();
                $data["accommodations"] = $this->accommodations->getAccommodationById($postData['accommodationId']);
                $data["workplaces"] = $this->workplaces->getAllWork_place();

                $this->load->view("theme/head");
                $this->load->view("admin/layout/left-menu");
                $this->load->view("admin/layout/header");
                $this->load->view("admin/accommodation/update/content",$data);
                $this->load->view("theme/footer");
                $this->load->view("theme/foot");
                $this->load->view("admin/accommodation/update/script",$data);
        }
    }

   
}