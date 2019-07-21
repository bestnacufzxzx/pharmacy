<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Training_type extends BD_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('training_types');
        $this->load->model('subjects');

    }

    function create_post()
    {

        $training_type_id = $this->post('training_type_id');
        $course_id = $this->post('course_id'); // wait gen form login staff
        $fields = array(
            'course_id' => $course_id,
            'training_type_name' => $this->post("trainingType")
        );
        $isDuplicate = $this->training_types->isDuplicate($fields, true);
        if(!$isDuplicate){
            if($training_type_id ==="null"){
                $nextId = $this->training_types->getNextId($course_id);
                $data = array(
                    'training_type_id' => $nextId,
                    'training_type_name'=> $this->post("trainingType"),
                    'course_id'=> $course_id
                );
                $result = $this->training_types->create($data);
            }else{
                $data = array(
                    'training_type_name'=> $this->post("trainingType"),
                );
                $result = $this->training_types->update([
                    'training_type_id'=> $training_type_id,
                    'course_id' => $course_id
            ], $data);
            }
            if($result){
                $output["message"] = 'บันทึกสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = 'เกิดข้อผิดพลาดในการบันทึก';
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }
        }
        else{
            $this->set_response([
                'status' => FALSE,
                'message' => 'มีประเภทการฝึกนี้อยู่ในระบบเรียบร้อยเเล้ว'
            ], REST_Controller::HTTP_CONFLICT);
        }
    }
        
        
        

    function delete_post()
    {
        $trainingTypeId = $this->post("trainingTypeId");
        $course_id = $this->post("course_id");
        $checkData = $this->subjects->first([
            'course_id' => $course_id,
            'training_type_id' => $trainingTypeId
        ]);
        // dd(!isset($checkData));
        if(!isset($checkData)){
            $fields = array(
                'training_type_id' => $trainingTypeId,
                'course_id' => $course_id
            );
            $result=$this->training_types->delete($fields);
            if($result){
                $output["message"] = 'ลบประเภทการฝึกสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = 'ประเภทการฝึกนี้ถูกใช้งานอยู่';
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }
        }else{
            $this->set_response([
                'status' => FALSE,
                'message' => 'ประเภทการฝึกนี้ถูกใช้งานอยู่'
            ], REST_Controller::HTTP_CONFLICT);
        }
    }

}