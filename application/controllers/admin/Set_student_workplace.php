<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Set_student_workplace extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
        // $this->load->view("lib");
        $this->load->model("schedules");
        $this->load->model("subject_teachs");
        $this->load->model("enrolls");

    }

    function index(){
        $this->load->model('years');
        $this->load->model('workplace_subjects');
        
        $course_id = $this->input->get('course_id');
        $next_year = $this->years->get_now_year()+1;
        $subject_teachs = $this->subject_teachs->getJoinSubject($next_year, $course_id);
        
        $data['subject_teachs'] = $subject_teachs;
        $schedules = $this->schedules->get([
            'year' => $next_year
        ]);
        $student_enrolls = $this->enrolls->getStudentEnroll($next_year, $course_id);
        
        $count_student = [];
        foreach($subject_teachs as $subject_teach){

            $training_type_id = $subject_teach['training_type_id'];
            foreach ($schedules as $schedule) {

                $schedule_now = $schedule['schedule'];
                if(isset($count_student[$training_type_id][$schedule_now]['receive_male'])){
                    $received_male = $count_student[$training_type_id][$schedule_now]['receive_male'][0];
                    $received_female = $count_student[$training_type_id][$schedule_now]['receive_female'][0];
                    $received_unknow = $count_student[$training_type_id][$schedule_now]['receive_unknow'][0];

                }else{
                    $received_male = 0;
                    $received_female = 0;
                    $received_unknow = 0;
                }
                $count = $this->workplace_subjects->receiveCountBySubject($next_year, $training_type_id, $schedule_now, $course_id);
                $receive_male = (int)$count->receive_male;
                $receive_female = (int)$count->receive_female;
                $receive_unknow = (int)$count->receive_unknow;

                //             ['นาย','นางสาว']
                $name_titles = $this->enrolls->getNameTitleFromStudent($subject_teach['subject_teach_id'],$schedule_now,$next_year);
                
                //      ['นาย','นางสาว']
                foreach($name_titles as $name_title){
                    //   นาย
                    if($name_title == 'นาย'){
                        // check not limit male 0/5 == true  , 5/5 == false
                        if($received_unknow >= $receive_unknow || $received_male + 1 <= $receive_male ){                         
                            $received_male++;
                        }else{
                            $received_unknow++;
                        }
                    }else{
                        if($received_unknow >= $receive_unknow || $received_female + 1 <= $receive_female ){                         
                            $received_female++;
                        }else{
                            $received_unknow++;
                        }
                    }
                }
                

                $count_student[$training_type_id][$schedule_now]['receive_male'] = [$received_male,$receive_male];
                $count_student[$training_type_id][$schedule_now]['receive_female'] = [$received_female,$receive_female];
                $count_student[$training_type_id][$schedule_now]['receive_unknow'] = [$received_unknow,$receive_unknow];
            }
        }
        $selected_subject = [];
        foreach ($student_enrolls as $student_enroll) {
            $selected_subject[$student_enroll['student_id']] = [];
            $selected_subject[$student_enroll['student_id']]['selected'] = [];
            foreach ($schedules as $schedule) {
                $enroll = $this->enrolls->first([
                    'student_id' => $student_enroll['student_id'],
                    'schedule' => $schedule['schedule'],
                    'year' => $next_year
                ]);
                if(isset($enroll->subject_teach_id)){
                    $selected_subject[$student_enroll['student_id']][$schedule['schedule']] = $enroll->subject_teach_id;
                    array_push($selected_subject[$student_enroll['student_id']]['selected'],$enroll->subject_teach_id);
                }else{
                    $selected_subject[$student_enroll['student_id']][$schedule['schedule']] = null;
                }
            }
        }
        // dd($subject_teachs);
        $data['course_id'] = $course_id;
        $data['selected_subject'] = $selected_subject;
        $schedule_size = sizeof($schedules);
        $data['count_student'] = $count_student;
        $data['schedules'] = $schedules;
        $data['student_enrolls'] = $student_enrolls;
        $data['schedule_size'] = $schedule_size;
        $data['year'] = $next_year;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/set_student_workplace/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/set_student_workplace/script", $data);
    }
}