<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Accommodation extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('accommodations');
    }

    function create_post()
    {
        if(!is_null($this->post('accommodation_name'))){
            $accommodation = $this->accommodations->first([
                'accommodation_id'=>$this->post('accommodation_id')
            ]);
        }
        $isAccommodation = !is_null($accommodation);
        
        //check dup firstname lastname
        $condition = [
            'accommodation_name' => $this->post("accommodation_name")
        ];
        if($isAccommodation){
            $condition['accommodation_id !='] = $accommodation->accommodation_id;
        }
        $isDuplicate = $this->accommodations->isDuplicate($condition,true);
        if($isDuplicate){
            $this->set_response([
                'status' => FALSE,
                'message' => 'มีข้อมูลทีพักอยู่ในระบบแล้ว'
            ], REST_Controller::HTTP_CONFLICT);
            return;
        }
        //end check dup firstname lastname


        $data = array(
            'accommodation_id'=> $this->post("accommodation_id"),
            'accommodation_name'=> $this->post("accommodation_name"),
            'description'=> $this->post("description"),
            'contact_name'=> $this->post("contact_name"),
            'tel'=> $this->post("tel"),
            'address'=> $this->post("address"),
            'sub_district'=> $this->post("sub_district"),
            'district'=> $this->post("district"),
            'province'=> $this->post("province"),
            'zipcode'=> $this->post("zipcode"),
        );
        if($isAccommodation){
            $result=$this->accommodations->update([
                'accommodation_id' => $accommodation->accommodation_id
            ],$data);
        }else{
            $data['workplace_id'] = $this->post("workplace_id");
            $result=$this->accommodations->create($data);
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
        $this->load->model('accommodations');
        $accommodation_id = $this->post('accommodation_id');
        $accommodation = $this->accommodations->first([
            'accommodation_id'=>$accommodation_id
        ]);
        
        if(!is_null($accommodation)){
            $result = $this->accommodations->delete([
                'accommodation_id' => $accommodation->accommodation_id
            ]);
            if($result){
                $output["message"] = 'ลบสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = 'เกิดข้อผิดพลาดในการลบ';
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }
        }else{
            $output["status"] = false;
            $output["message"] = 'เกิดข้อผิดพลาดในการลบ';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
        
    }


}