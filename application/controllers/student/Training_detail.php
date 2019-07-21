<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Training_detail extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
		$this->load->model('enrolls');
		$this->load->model('years');
		$this->load->model('schedules');
    }

    function index(){
        $user = get_user_session();
        $enroll_details = $this->enrolls->getForTrainingDetail($user->student_id);
        if(sizeof($enroll_details) != 0){
            $th_year = $enroll_details[0]['year']+543;
        }else{
            $th_year = $this->years->get_now_year()+543;
        }
        $schedules = $this->schedules->get([
            'year' => $th_year-543
        ]);
        foreach($enroll_details as $key => $enroll_detail){
            foreach($schedules as $schedule){
                if($enroll_detail['schedule'] == $enroll_detail['schedule']){
                    $enroll_details[$key] += [ "start_date" => $schedule['start_date'] ];
                    $enroll_details[$key] += [ "end_date" => $schedule['end_date'] ];
                }
            }
        }
        $data['th_year'] = $th_year;
        $data['enroll_details'] = $enroll_details;
        $this->load->view("layout/head");
		$this->load->view("layout/header");
		$this->load->view("student/layout/left-menu");
		$this->load->view("student/training_detail/content", $data);
		$this->load->view("layout/footer");
        $this->load->view("layout/foot");
        $this->load->view("student/training_detail/script");
    }

}