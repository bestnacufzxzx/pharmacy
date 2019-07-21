<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Schedule extends BD_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('schedules');
        $this->load->model('years');
    }

    function create_post()
    {
        $year = $this->post("year");
        $yearData = $this->years->first([
            'year' => $year
        ]);
        if($yearData != null){
            $data = [];
            $schedules = $this->post("schedules");
            $start_dates = $this->post("start_dates");
            $end_dates = $this->post("end_dates");
            $years = $this->post("years");
            for ($i=0; $i < sizeof($schedules); $i++) { 
                $tem = [
                    'schedule'=> $schedules[$i],
                    'start_date'=> $start_dates[$i],
                    'end_date'=>$end_dates[$i],
                    'year' =>$years[$i]
                ];
                array_push($data,$tem);
            }
            $result=$this->schedules->createAllSchedule($data);
            $this->schedules->clearNull();
            if($result){
                $output["message"] = 'บันทึกสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
                }else{
                    $output["message"] = 'เกิดข้อผิดพลาดในการบันทึก';
                    $this->set_response($output, REST_Controller::HTTP_CONFLICT);
                }
        }else{
            $this->set_response([
                'status' => FALSE,
                'message' => 'มีประเภทนี้อยู่ในบบเเล้วครับค่ะข้า'
            ], REST_Controller::HTTP_CONFLICT);
        }
    }

    function deleteByYear_post()
    {
        $year = $this->post("year");
        $result = $this->schedules->deleteByYear($year);
        if($result){
            $output["message"] = 'บันทึกสำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $output["message"] = 'เกิดข้อผิดพลาดในการบันทึก';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
    }

    function update_post()
    {
        $data = [];
        $schedules = $this->post("schedule_update");
        $start_dates = $this->post("start_date_update");
        $end_dates = $this->post("end_date_update");
        $years = $this->post("year_update");
        $thisYear = $years[0];
        for ($i=0; $i < sizeof($schedules); $i++) { 
            $tem = [
                'schedule'=> $schedules[$i],
                'start_date'=> $start_dates[$i],
                'end_date'=>$end_dates[$i],
                'year' =>$years[$i]
            ];
            array_push($data,$tem);
        }
        $result=$this->schedules->createAllSchedule($data);
        $this->schedules->clearNull();
        if($result){
        $output["message"] = 'แก้ไขสำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $output["message"] = 'แก้ไขไม่สำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
    }

}