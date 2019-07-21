<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Set_workplace_to_student extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
        // $this->load->view("lib");
        $this->load->model("schedules");
        $this->load->model("subject_teachs");
        $this->load->model("enrolls");
        $this->load->model('years');
        $this->load->model('workplace_subjects');
    }

    function index(){

        $course_id = $this->input->get('course_id');

        $year = $this->years->get_now_year();
        $next_year = $year + 1;
        $isCheckAll = $this->enrolls->count([
            'year' => $next_year,
            'schedule IS NULL' => null
        ]) == 0;
        $subject_teachs = $this->subject_teachs->getJoinSubject($next_year, $course_id);

        $schedules = $this->schedules->get([
            'year' => $next_year
        ]);

        $map_data = [];
        foreach($subject_teachs as $subject_teach){
            $subject_teach_id = $subject_teach['subject_teach_id'];
            foreach($schedules as $schedule){
                $schedule_time = $schedule['schedule'];
                $count_enrolls_student = $this->enrolls->count([
                    'subject_teach_id' => $subject_teach['subject_teach_id'],
                    'year' => $next_year,
                    'schedule' => $schedule['schedule'],
                    'workplace_subject_id IS NULL' => null
                ]);
                $count_enroll = $this->enrolls->count([
                    'subject_teach_id' => $subject_teach['subject_teach_id'],
                    'year' => $next_year,
                    'schedule' => $schedule['schedule']
                ]);

                $is_over_workplace = false;
                $workplaces = $this->workplace_subjects->getWorkplaceToStudent($subject_teach['training_type_id'], $next_year, $schedule_time, $course_id);
                // dd($workplaces);
                foreach($workplaces as $key => $workplace){
                    $male_received = 0;
                    $female_received = 0;
                    $unknow_received = 0;
                    
                    $name_titles = $this->enrolls->getNameTitleToWorkplaceSubject($workplace['workplace_subject_id'], $schedule_time);
                    foreach ($name_titles as $name_title) {
                        if($name_title == 'นาย'){
                            if($unknow_received >= $workplaces[$key]['receive_unknow'] || $male_received + 1 <= $workplaces[$key]['receive_male'] ){                         
                                $male_received++;
                            }else{
                                $unknow_received++;
                            }
                        }else{
                            if($unknow_received >= $workplaces[$key]['receive_unknow'] || $female_received + 1 <= $workplaces[$key]['receive_female'] ){                         
                                $female_received++;
                            }else{
                                $unknow_received++;
                            }
                        }
                    }
                    if($male_received > $workplaces[$key]['receive_male'] || $female_received > $workplaces[$key]['receive_female'])
                    {
                        // var_dump($male_received > $workplaces[$key]['receive_male'] || $female_received > $workplaces[$key]['receive_female']);
                        $is_over_workplace = true;
                        break;
                    }
                    // echo '.................................<br>';
                    // echo $subject_teach_id.'|ผลัดที่'.$schedule_time.'-'.$workplace['workplace_name'].'||ช'.$male_received.'/'.$workplaces[$key]['receive_male'].'||ญ'.$female_received.'/'.$workplaces[$key]['receive_female'];      
                    // echo '<br>.................................<br>';  

                    $workplaces[$key]['receive_male'] = [
                        $male_received,$workplaces[$key]['receive_male']
                    ];
                    $workplaces[$key]['receive_female'] = [
                        $female_received,$workplaces[$key]['receive_female']
                    ];
                    $workplaces[$key]['receive_unknow'] = [
                        $unknow_received,$workplaces[$key]['receive_unknow']
                    ];
                    
                }
                        
                $map_data[$subject_teach_id][$schedule_time] = [
                    // 'debug_count_student' => $count_student[$training_type_id][$schedule_now],
                    'count_student' => $count_enrolls_student,
                    'count_enroll' => $count_enroll,
                    'is_over_workplace' => $is_over_workplace
                ];
            }
        }
        $data['course_id'] = $course_id;
        $data['map_data'] = $map_data;
        $data['subject_teachs'] = $subject_teachs;
        $data['next_year'] = $next_year;
        $data['schedules'] = $schedules;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
        $this->load->view("admin/layout/header");
        if($isCheckAll){
            $this->load->view("admin/set_workplace_to_student/content", $data);
        }else{
            $this->load->view("admin/set_workplace_to_student/content2", $data);
        }
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/workplace/script");
    }


    function select(){
        $course_id = $this->input->get('course_id');
        $this->load->model('workplace_subjects');
        $year = $this->years->get_now_year()+1;
        $subject_teach_id = $this->input->get('subject_teach_id');
        $schedule = $this->input->get('schedule');
        $training_type_id = $this->input->get('training_type_id');
        
        $students = $this->enrolls->getJoinStudent($year, $subject_teach_id, $schedule);
        $workplaces = $this->workplace_subjects->getWorkplaceToStudent($training_type_id, $year, $schedule, $course_id);

        foreach($workplaces as $key => $workplace){
            $male_received = 0;
            $female_received = 0;
            $unknow_received = 0;
            
            $name_titles = $this->enrolls->getNameTitleToWorkplaceSubject($workplace['workplace_subject_id'], $schedule);
            foreach ($name_titles as $name_title) {
                if($name_title == 'นาย'){
                    if($unknow_received >= $workplaces[$key]['receive_unknow'] || $male_received + 1 <= $workplaces[$key]['receive_male'] ){                         
                        $male_received++;
                    }else{
                        $unknow_received++;
                    }
                }else{
                    if($unknow_received >= $workplaces[$key]['receive_unknow'] || $female_received + 1 <= $workplaces[$key]['receive_female'] ){                         
                        $female_received++;
                    }else{
                        $unknow_received++;
                    }
                }
            }
            $workplaces[$key]['receive_male'] = [
                $male_received,$workplaces[$key]['receive_male']
            ];
            $workplaces[$key]['receive_female'] = [
                $female_received,$workplaces[$key]['receive_female']
            ];
            $workplaces[$key]['receive_unknow'] = [
                $unknow_received,$workplaces[$key]['receive_unknow']
            ];

        }
        // dd($workplaces);
        $data['course_id'] = $course_id;
        $data['students'] = $students;
        $data['schedule'] = $schedule;
        $data['workplaces'] = $workplaces;
        $data['subject_teach_id'] = $subject_teach_id;
        $data['training_type_id'] = $training_type_id;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/set_workplace_to_student/select/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/set_workplace_to_student/select/script", $data);
    }
}