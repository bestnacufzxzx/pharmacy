<?php
class Set_receive_detail extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("workplaces");
        $this->load->model('years');
        $this->load->model('workplace_subjects');
    }

    function index(){
        
        $s = $this->input->get('search');
        $workplaces = $this->workplaces->getByName($s);
        $data['s'] = $s;
        $data['workplaces'] = $workplaces;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/set_receive_detail/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/set_receive_detail/script");
    }

    function receive_detail(){
        $this->load->model('schedules');
        $this->load->model('training_types');
        $this->load->model('trainers');

        $workplace_id = $this->input->get('workplace_id');
        $schedule = $this->input->get('schedule');
        $course_id = $this->input->get('course_id');


        $next_year = $this->years->get_now_year()+1;
        $schedules = $this->schedules->get([
            'year' => $next_year
        ]);
        $schedule_count = count($schedules);
        $training_types = $this->training_types->get([
            'course_id' => $course_id
        ]);
        $trainers = $this->trainers->getWithOutTrash([
            'workplace_id' => $workplace_id
        ]);
        $workplace = $this->workplaces->first(['workplace_id'=>$workplace_id]);
        
        $workplace_subjects = $this->workplace_subjects->get([
            'workplace_id' => $workplace->workplace_id,
            'schedule' => $schedule,
            'year' => $next_year,
            'course_id' => $course_id
        ]);
        $trainer_type_count = [];
        foreach($workplace_subjects as $workplace_subject){
            $temp = [];
            $temp['unknow'] = $workplace_subject['receive_unknow'];
            $temp['male'] = $workplace_subject['receive_male'];
            $temp['female'] = $workplace_subject['receive_female']; 
            $temp['trainer_id'] = $workplace_subject['trainer_id'];
            $trainer_type_count[$workplace_subject['training_type_id']] = $temp ;
        }
        $training_size = sizeof($training_types);
        $data['training_size'] = $training_size;
        $data['course_id'] = $course_id;
        $data['workplace_subject'] = $trainer_type_count;
        $data['trainers'] = $trainers;
        $data['next_year'] = $this->years->get_now_year()+1;
        $data['workplace_id'] = $workplace->workplace_id;
        $data['workplace_name'] = $workplace->workplace_name;
        $data['schedules'] = $schedules;
        $data['training_types'] = $training_types;
        $data['schedule_cont'] = $schedule_count;
        $data['schedule'] = $schedule;

        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/set_receive_detail/receive_detail/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/set_receive_detail/receive_detail/script", $data);
    }
}