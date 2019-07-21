<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Enroll extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('enrolls');
    }

    function choose_post()
    {
        $enroll_id = $this->post("enroll_id");
        $workplace_subject_id = $this->post("workplace_subject_id");
        if(isset($enroll_id) && isset($workplace_subject_id)){
            $result=$this->enrolls->update([
                'enroll_id' => $enroll_id
            ],['workplace_subject_id' => $workplace_subject_id]);
            if($result){
                $output["message"] = 'เลือกแหล่งฝึกสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = 'เกิดข้อผิดพลาดในเลือกแหล่งฝึก';
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }
        }else{
            $this->set_response([
                'status' => FALSE,
                'message' => 'ไม่มีแหล่งฝึกที่เลือก'
            ], REST_Controller::HTTP_CONFLICT);
        }
        
    }

    function setWorkplaceToStudent_post()
    {
        $subject_teach_id = $this->post('subject_teach_id');
        $student_id = $this->post('student_id');
        $schedule = $this->post('schedule');
        $year = $this->post('year');
        $result = $this->enrolls->update([
            'year' => $year,
            'student_id' => $student_id,
            'schedule' => $schedule
        ], ['schedule' => null]);
        if($subject_teach_id != '-1'){
             $result = $this->enrolls->update([
                'subject_teach_id' => $subject_teach_id,
                'student_id' => $student_id,
                'year' => $year
            ], ['schedule' => $schedule]);
        }
        if($result){
            $output["message"] = 'เลือกแหล่งฝึกสำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                'status' => FALSE,
                'message' => 'ไม่มีแหล่งฝึกที่เลือก'
            ], REST_Controller::HTTP_CONFLICT);
        }
    }

    function selectWorkplace_post()
    {
        $enroll_id = $this->post('enroll_id');
        $workplace_subject_id = $this->post('workplace_subject_id');
        $result = $this->enrolls->update([
            'enroll_id' => $enroll_id
        ],['workplace_subject_id' => null]);
        if($workplace_subject_id != '-1'){
             $result = $this->enrolls->update([
                'enroll_id' => $enroll_id
            ], ['workplace_subject_id' => $workplace_subject_id]);
        }
        if($result){
            $output["message"] = 'เลือกแหล่งฝึกสำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                'status' => FALSE,
                'message' => 'ไม่มีแหล่งฝึกที่เลือก'
            ], REST_Controller::HTTP_CONFLICT);
        }
    }
}