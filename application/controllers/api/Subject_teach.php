<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Subject_teach extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('subject_teachs');
        $this->load->model('lecturer_responsibles');
        $this->load->model('lecturers');
        $this->load->model('years');
    }

    function create_post()
    {
        $subject_teach = null;
        if(!is_null($this->post('subject_teach_id'))){
            $subject_teach = $this->subject_teachs->first([
                'subject_teach_id'=>$this->post('subject_teach_id')
            ]);
        }

        $isSubject_teach = !is_null($subject_teach);
        $year = $this->years->get_now_year();
        $next_year = $year + 1;
        $lecturer_res_data = [];
        $data = array(
            'subject_id'=> $this->post("subject_id"),
            'year'=> $next_year,
            'percent_trainer'=> $this->post("percent_trainer"),
            'percent_report'=> $this->post("percent_report"),
            'percent_present'=> $this->post("percent_present")
        );
        $lecturer_id = $this->post('lecturer');
        if(!is_null($lecturer_id)){
            if($isSubject_teach){
                $this->lecturer_responsibles->delete([
                    'subject_teach_id'=>$subject_teach->subject_teach_id
                ]);
                $result = $this->subject_teachs->update([
                    'subject_teach_id' => $subject_teach->subject_teach_id
                ],$data);
                $subject_teach_id = $subject_teach->subject_teach_id;
            }else{
                $result=$this->subject_teachs->create($data);
                $subject_teach_id = $this->subject_teachs->first([],[
                    'subject_teach_id' => 'DESC'
                ])->subject_teach_id;
                
            }
            for ($i=0; $i < sizeof($lecturer_id); $i++) { 
                $tem_lec = [
                    'lecturer_id'=> $lecturer_id[$i],
                    'subject_teach_id'=> $subject_teach_id
                ];
                array_push($lecturer_res_data,$tem_lec);
            }
            $result = $this->lecturer_responsibles->createLecturerResponsible($lecturer_res_data);
            if($result){
                $output["message"] = 'บันทึกสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }
        }else{
            $output["message"] = 'กรุณาเลือกอาจารย์ผู้รับผิดชอบ';
            $output["status"] = false;
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
    }

    function delete_post()
    {
        $this->load->model('subject_teachs');
        $subject_name = $this->post("subject_name");
        $subject_teach_id = $this->post('id');
        $subject_teach = $this->subject_teachs->first([
            'subject_teach_id'=>$subject_teach_id
        ]);
        
        if(!is_null($subject_teach)){
            $result = $this->lecturer_responsibles->delete([
                'subject_teach_id' => $subject_teach_id
            ]);
            $result = $this->subject_teachs->delete([
                'subject_teach_id' => $subject_teach->subject_teach_id
            ]);
            if($result){
                $output["message"] = 'ลบสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = 'เกิดข้อผิดพลาดในการลบเนื่องจากรายวิชามีการใช้งานอยู่';
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }
        }else{
            $output["status"] = false;
            $output["message"] = 'เกิดข้อผิดพลาดในการลบเนื่องจากรายวิชามีการใช้งานอยู่';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
        
    }


}