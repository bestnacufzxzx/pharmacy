<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formtrainer extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model("trainers");
    }
    	public function index(){
				$s = $this->input->get('search');
				$trainers = $this->trainers->getTrainerByFirstnameOrLastname($s);
   	    $data['s'] = $s;
        $data['trainers'] = $trainers[0];
				$this->load->view("layout/head");
				$this->load->view("layout/header");
				$this->load->view("trainer/layout/left-menu");
				$this->load->view("trainer/formtrainer/content",$data);
				$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("trainer/formtrainer/script");
		}		

		public function update(){
			$this->load->model("levels");
			$this->load->model("users");
			$levels = $this->levels->get();
			$trainer = $this->trainers->first([
					'trainer_id'=> $this->input->get('id')
			]);
			$user = $this->users->first([
					'id' => $trainer->user_id
			]);
			$data['trainer'] = $trainer;
			$data['user'] = $user;
			$data['isCreate'] = false;
			$this->load->view("layout/head");
			$this->load->view("layout/header");
			$this->load->view("trainer/layout/left-menu");
			$this->load->view("trainer/formtrainer/create/content", $data);
			$this->load->view("layout/footer");
			$this->load->view("layout/foot");
			$this->load->view("trainer/formtrainer/create/script");
	}
			
}