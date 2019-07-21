<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Workplace_subject extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Subject_teachs');
        $this->load->model('workplace_subjects');
    }

    function create_post()
    {
        $this->load->model('years');
        $next_year = $this->years->get_now_year()+1;
        $training_type = $this->input->post('training_type');
        $schedule = $this->input->post('schedule');
        $workplace_id = $this->input->post('workplace_id');
        $course_id = $this->input->post('course_id');
        
        $this->workplace_subjects->deleteWithoutTrainingType($training_type, $next_year, $schedule, $workplace_id, $course_id);
        foreach ($training_type as $type) {
            $unknow = 0;
            $male = 0;
            $female = 0;
            $trainer_id = (int)$this->post('trainer-'.$type);
            $male = (int)$this->input->post('male-'.$type);
            $female = (int)$this->input->post('female-'.$type);
            $unknow = (int)$this->input->post('unknow-'.$type);
            // $unknow = isset($unknow)?$unknow:0;
            if($male+$female+$unknow <= 0){
                $output["message"] = 'กรุณากรอกจำนวนการรับของนักศึกษาประเภทการฝึกที่'.$type;
                $result = false;
                break;
            }
            if($trainer_id == -1){
                $output["message"] = 'กรุณาเลือกพนักงานที่ปรึกษาประเภทการฝึกที่'.$type;
                $result = false;
                break;
            }

            $data = array(
                'receive_male' => $male,
                'receive_female'=> $female,
                'receive_unknow'=> $unknow,
                'training_type_id'=> $type,
                'year'=> $next_year,
                'schedule'=> $schedule,
                'workplace_id' => $workplace_id,
                'trainer_id' => $trainer_id,
                'course_id' => $course_id
            );

            $whereCondition = [
                'training_type_id'=> $type,
                'year'=> $next_year,
                'schedule'=> $schedule,
                'workplace_id' => $workplace_id,
                'course_id' => $course_id
            ];
            $isExist = $this->workplace_subjects->count($whereCondition) > 0;
            if($isExist){
                $result = $this->workplace_subjects->update($whereCondition,$data);
            }else{
                $result = $this->workplace_subjects->create($data);
            }
           
        }

        if($result){
            $output["message"] = 'บันทึกสำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $output["status"] = false;
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
    }

    function workplace_get()
    {
        $output = [];
        $subject_teach_id = $this->get('subject_teach_id');
        $year = $this->get('year');
        $schedule = $this->get('schedule');
        $training_type_id = $this->Subject_teachs->getTrainingType($subject_teach_id)[0];
        $workplace_subject = $this->workplace_subjects->getByAdmin($training_type_id['training_type_id'], $year, $schedule);
        dd($workplace_subject);
        if(isset($workplace_subject)){
            $output['workplace_subject'] = $workplace_subject;
        }else{
            $output = null;
        }
        // $before_year = $this->years->first([
        //     'year'=>$this->get('year')-1
        // ]);
        // if(isset($before_year)){
        //     $output['min_start_date'] = $before_year->end_date;
        // }
        $this->set_response($output, REST_Controller::HTTP_OK);
    }
}