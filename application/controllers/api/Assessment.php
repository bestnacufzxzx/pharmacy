<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Assessment extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('assessments');
        $this->load->model('trainers');
        $this->load->model('students');
        $this->load->model('enrolls');
    }
    
    function create_post()
    {
        $data = [];
        $enroll_data = $this->post("enroll_id");
        for ($i=0; $i < sizeof($enroll_data); $i++) { 
            $item = [
                'enroll_id' => $enroll_data[$i],
                'lecturer_responsible_id' => $this->post("lecturer_responsible_id")
            ];
            array_push($data, $item);
        }
        $result = $this->assessments->createAssessments($data);
        if($result){
            $output["message"] = 'บันทึกสำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $output["status"] = false;
            $output["message"] = 'เกิดข้อผิดพลาดในการบันทึก';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
    }

    function upload_post(){
        $assessment_id = $this->post("assessment_id");
        $year = $this->post("year");
        $subject_code = $this->post("subject_code");
        $user = get_user_session();
        $student_id = $user->student_id;
        $file = $_FILES['file']['name'];
        $isUpload = false;
        $filename = "";

        if($file != null){
            $config['upload_path'] = 'public/upload/report/';
            $config['allowed_types'] = 'pdf';
            $filename = $year.'_'.$student_id.'_'.$subject_code.'.pdf';
            $config['file_name'] = $filename;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("file")){
                $isUpload = true;
            }else{
                $output["message"] = $this->upload->display_errors();
            }
        }

        if($isUpload){
            $field = array('assessment_id' => $assessment_id);
            $data = array(
                'assessment_id' => $assessment_id,
                'report'=> $filename
            );

            $result = $this->assessments->update($field, $data);

            if($result){
                $output["message"] = 'บันทึกสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = 'เกิดข้อผิดพลาดในการบันทึก';
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }       
        }else{
            $output["status"] = false;
            // $output["message"] = 'เกิดข้อผิดพลาดในการบันทึก';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }

    }

    function updateScoreReport_post(){

        $assessment_id = $this->post("assessment_id");
        $score = $this->post("score");

        $percent = $this->assessments->getPercentByAssessmentId($assessment_id);
        $score = $score*$percent->score_report/100;

        $field = array('assessment_id' => $assessment_id);
        $data = array(
            'assessment_id' => $assessment_id,
            'score_report'=> $score
        );

        $result = $this->assessments->update($field, $data);

        if($result){
            $output["message"] = 'บันทึกสำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $output["status"] = false;
            $output["message"] = 'เกิดข้อผิดพลาดในการบันทึก';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
    }

    function updateScorePresent_post(){
        $assessment_id = $this->post("assessment_id");
        $score1 = $this->post("score1");
        $score2 = $this->post("score2");
        $score3 = $this->post("score3");
        $percent = $this->assessments->getPercentByAssessmentId($assessment_id);

        $score = (((float)$score1 + (float)$score2 + (float)$score3)/3)*$percent->percent_present/100;

        $field = array('assessment_id' => $assessment_id);
        $data = array(
            'assessment_id' => $assessment_id,
            'score_present'=> $score
        );

        $result = $this->assessments->update($field, $data);
        $output["score"] = $score;

        if($result){
            $output["message"] = 'บันทึกสำเร็จ';
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $output["status"] = false;
            $output["message"] = 'เกิดข้อผิดพลาดในการบันทึก';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
    }


}