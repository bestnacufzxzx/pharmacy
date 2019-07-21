<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subject extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('subjects');
    }

    // function select_get(){
    //     $result = $this->Years->getAllYear();
    //     $output["data"] = $result;
    // }

    function create_post()
    {

        $subject_id = $this->post('subject_id');
        if($subject_id == ""){
            $isSubject = !is_null($subject_id);
            $condition = [
                'subject_code' => $this->post("subject_code")
            ];
            // if($isSubject){
            //     $condition['subject !='] = $subject->subject_id;
            // }
            $isDuplicate = $this->subjects->isDuplicate($condition,true);
            if($isDuplicate){
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'มีรายวิชานี้อยู่ในระบบแล้ว'
                ], REST_Controller::HTTP_CONFLICT);
                return;
            }
            $data = array(
                'subject_code'=> $this->post("subject_code"),
                'subject_name'=> $this->post("subject_name"),
                'course_id'=> $this->post("course_id"),
                'training_type_id'=> $this->post("training_type_id")
            );
            $result = $this->subjects->create($data);
        }else{
            $condition = [
            'subject_code' => $this->post("subject_code")
            ];
            $isDuplicate = $this->subjects->isDuplicate($condition,true);
            if($isDuplicate){
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'มีรายวิชานี้อยู่ในระบบแล้ว'
                ], REST_Controller::HTTP_CONFLICT);
                return;
            }
            $data = array(
                'subject_id'=> $this->post("subject_id"),
                'subject_code'=> $this->post("subject_code"),
                'subject_name'=> $this->post("subject_name"),
                'course_id'=> $this->post("course_id"),
                'training_type_id'=> $this->post("training_type_id")
            );
            $result = $this->subjects->update([
                'subject_id' => $subject_id
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

    function delete_post()
    {
        $this->load->model('subjects');
        $this->load->model('subject_teachs');

        $subject_id = $this->post("subject_id");
        $subject = $this->subject_teachs->first([
            'subject_id'=>$subject_id
        ]);
        if(is_null($subject)){
        $result = $this->subjects->delete([
            'subject_id' => $subject->subject_id
        ]);
        if($result){
            $output["message"] = 'ลบรายวิชาสำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $output["status"] = false;
            $output["message"] = 'เกิดข้อผิดพลาดในการลบ';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
        }else{
            $this->set_response([
                'status' => FALSE,
                'message' => 'รายวิชาถูกใช้งานอยู่'
            ], REST_Controller::HTTP_CONFLICT);
        }
    }
  
     

}