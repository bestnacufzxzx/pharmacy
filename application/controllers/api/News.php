<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class News extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Information');
    }
    
    function create_post()
    {
        $news = null;
        if(!is_null($this->post('news_id'))){
            $news = $this->Information->first([
                'news_id'=>$this->post('news_id')
            ]);
        }
        $isNews = !is_null($news);
        $data = array(
            'news_id' => $this->post("news_id"),
            'news_type_id' => $this->post("news_type_id"),
            'news_title' => $this->post("news_title"),
            'news_detail' => $this->post("news_detail"),
            'file_parth' => $this->post("file_parth"),
            'end_date' => $this->post("end_date"),
            'staff_id' => $this->post("staff_id")
        );
        if($isNews){
            $result=$this->Information->update([
                'news_id' => $news->news_id
            ],$data);
        }else{
            $data['news_id'] = $this->post("news_id");
            $result=$this->Information->create($data);
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
        $this->load->model('Information');
        $news_id = $this->post('news_id');
        $informations = $this->Information->first([
            'news_id'=>$news_id
        ]);
        
        if(!is_null($informations)){
            $result = $this->Information->delete([
                'news_id' => $informations->news_id
            ]);
            if($result){
                $output["message"] = 'ลบสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = 'ไม่สามารถลบได้เนื่องจากมีการนำข้อมูลไปใช้';
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }
        }else{
            $output["status"] = false;
            $output["message"] = 'ไม่สามารถลบได้เนื่องจากมีการนำข้อมูลไปใช้';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
        
    }

    

}
