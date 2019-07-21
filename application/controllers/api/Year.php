<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Year extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('years');
        $this->load->model('schedules');
    }
    function minmax_get()
    {
        $output = [];

        $next_year =  $this->years->first([
            'year'=>$this->get('year')+1
        ]);
        if(isset($next_year)){
            $output['max_end_date'] = $next_year->start_date;
        }

        $before_year = $this->years->first([
            'year'=>$this->get('year')-1
        ]);
        if(isset($before_year)){
            $output['min_start_date'] = $before_year->end_date;
        }
        $this->set_response($output, REST_Controller::HTTP_OK);
    }
    function create_post()
    {
        $year = null;
        if(!is_null($this->post('year'))){
            $year = $this->years->first([
                'year'=>$this->post('year')
            ]);
        }
        $isUpdate = !is_null($year);
        
        $data = array(
            'start_date' => $this->post("startDate"),
            'end_date'=> $this->post("endDate"),
        );

        if($isUpdate){
            $result=$this->years->update([
                'year' => $this->post('year')
            ],$data);
        }else{
            $last_year = $this->years->first([],[
                'year'=>"DESC"
            ])->year;
            $next_year = $last_year+1;
            $data['year'] = $next_year;
            $result=$this->years->create($data);
        }
        if($result){
            $output["message"] = 'บันทึกสำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $output["message"] = 'เกิดข้อผิดพลาดในการบันทึก';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
    }
    function delete_post()
    {
        $this->load->model('subject_teachs');
        $year = $this->years->first([],[
            'year'=>'DESC'
        ]);
        
        $isNotUseInSubject = !is_null($this->subject_teachs->first([
            'year' => $year->year
        ]));
        if($isNotUseInSubject){
            $output["message"] = 'มีการใช้ปีการศึกษานี้อยู่ในรายวิชาที่เปิดสอน';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            return;
        }
        $isNotUseInSchedule = !is_null($this->schedules->first([
            'year' => $year->year
        ]));
        if($isNotUseInSchedule){
            $output["message"] = 'มีการใช้ปีการศึกษานี้อยู่ในผลัด';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            return;
        }

        $countYear = $this->years->count();
        if($countYear <= 1){
            $output["message"] = 'ไม่สามารถลบปีการศึกษาสุดท้ายได้';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            return;
        }
        $result = $this->years->delete([
            'year' => $year->year
        ]);
        if($result){
            $output["message"] = 'ลบสำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
        
            $output["message"] = 'ปีการศึกษานี้ถูกใช้งานอยู่';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
        
    }

    function setNow_post()
    {
        $year = $this->post('set_now');
        $this->years->resetSetNow();
        $result = $this->years->update([
            'year' => $year
        ],[
            'set_now' => 1
        ]);
        if($result){
            $output["message"] = 'บันทึกสำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $output["message"] = 'เกิดข้อผิดพลาดในการบันทึก';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
    }

}
