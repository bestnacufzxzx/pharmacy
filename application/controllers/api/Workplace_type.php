<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Workplace_Type extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('workplace_types');
        $this->load->model('workplaces');
    }
    
    // function create_post()
    // {
    //     $workplacetypeName = $this->post("workplace_type_name");
    //     $workplacetypeData = $this->Workplace_types->getWorkplace_typeByName($workplacetypeName);
    //     if($workplacetypeData == null){
    //         $data = array(
    //             'workplace_type_id'=> $this->post("workplace_type_id"),
    //             'workplace_type_name'=> $this->post("workplace_type_name")
    //         );
    //         $result = $this->Workplace_types->create($data);
    //         if($result){
    //             $output["message"] = REST_Controller::MSG_SUCCESS;
    //             $this->set_response($output, REST_Controller::HTTP_OK);
    //         }else{
    //             $output["status"] = false;
    //             $output["message"] = REST_Controller::MSG_NOT_CREATE;
    //             $this->set_response($output, REST_Controller::HTTP_OK);
    //         }
    //     }else{
    //         $output["message"] = REST_Controller::MSG_CREATE_DUPLICATE;
    //         $this->set_response($output, REST_Controller::HTTP_OK);
    //     }
    // }

    
    // function update_post($workplacetypeId)
    // {
    //     $workplacetypeName = $this->post("workplace_type_name");
    //     $workplacetypeData = $this->Workplace_types->getWorkplace_typeByName($workplacetypeName);
    //     if($workplacetypeData == null){
    //         $data = array(
    //             'workplace_type_id'=> $this->post("workplace_type_id"),
    //             'workplace_type_name'=> $this->post("workplace_type_name")
    //         );
    //         $result = $this->Workplace_types->edit($data);
    //         if($result){
    //             $output["message"] = REST_Controller::MSG_SUCCESS;
    //             $this->set_response($output, REST_Controller::HTTP_OK);
    //         }else{
    //             $output["status"] = false;
    //             $output["message"] = REST_Controller::MSG_NOT_CREATE;
    //             $this->set_response($output, REST_Controller::HTTP_OK);
    //         }
    //     }else{
    //         $output["message"] = REST_Controller::MSG_CREATE_DUPLICATE;
    //         $this->set_response($output, REST_Controller::HTTP_OK);
    //     }
    // }



    function create_post()
    {
        $workplaceType = null;
        //check update
        if(!is_null($this->post('workplace_type_id'))){
            $workplaceType = $this->Workplace_types->first([
                'workplace_type_id'=>$this->post('workplace_type_id')
            ]);
        }
        $isWorkplaceType = !is_null($workplaceType);

        $condition = [
            'workplace_type_name' => $this->post("workplace_type_name")
        ];
        if($isWorkplaceType){
            $condition['workplace_type_name !='] = $workplaceType->workplace_type_name;
        }
        $isDuplicate = $this->workplace_types->isDuplicate($condition,true);
        if($isDuplicate){
            $this->set_response([
                'status' => FALSE,
                'message' => 'ประเภทแหล่งฝึกนี้มีอยู่ในระบบแล้ว!'
            ], REST_Controller::HTTP_CONFLICT);
            return;
        }

        $data = array(
            'workplace_type_id'=> $this->post("workplace_type_id"),
            'workplace_type_name'=> $this->post("workplace_type_name")
        );
        if($isWorkplaceType){
            $result=$this->workplace_types->update([
                'workplace_type_id' => $workplaceType->workplace_type_id
            ],$data);
        }else{
            $result=$this->workplace_types->create($data);
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
        $workplacetype_id = $this->post('workplaceTypeId');
        $workplacetype = $this->workplaces->first([
            'workplace_type_id'=>$workplacetype_id
        ]);
        if(is_null($workplacetype)){
            $result = $this->Workplace_types->delete([
                'workplace_type_id' => $workplacetype->workplace_type_id
            ]);
            if($result){
                $output["message"] = 'ลบสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = 'ประเภทแหล่งฝึกนี้ถูกใช้งานอยู่';
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }
        }else{
            $output["status"] = false;
            $output["message"] = 'ประเภทแหล่งฝึกนี้ถูกใช้งานอยู่';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        } 
    }

    


}
