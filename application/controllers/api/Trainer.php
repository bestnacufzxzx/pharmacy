<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Trainer extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('trainers');
    }

    function delete_post()
    {
        $this->load->model('users');
        $trainer_id = $this->post('trainer_id');
        $trainer = $this->trainers->first([
            'trainer_id'=>$trainer_id
        ]);
        if(!is_null($trainer)){
            $result = $this->users->delete([
                'id' => $trainer->user_id
            ]);
            if($result){
                $output["message"] = 'ลบสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = 'ไม่สามารถลบข้อมูลได้เนื่องจากมีการใช้งานอยู่';
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }
        }else{
            $output["status"] = false;
            $output["message"] = 'ไม่สามารถลบข้อมูลได้เนื่องจากมีการใช้งานอยู่';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
        
    }


    function create_post()
    {
        $this->load->model('users');
        $trainer = null;
        //check update
        if(!is_null($this->post('trainer_id'))){
            $trainer = $this->trainers->first([
                'trainer_id'=>$this->post('trainer_id')
            ]);
        }
        $isTrainer = !is_null($trainer);
        
        //check dup firstname lastname
        $condition = [
            'firstname' => $this->post("firstname"),
            'lastname' => $this->post("lastname")
        ];
        if($isTrainer){
            $condition['trainer_id !='] = $trainer->trainer_id;
        }
        $isDuplicate = $this->trainers->isDuplicate($condition,true);
        if($isDuplicate){
            $this->set_response([
                'status' => FALSE,
                'message' => 'ข้อมูลซ้ำจ้า'
            ], REST_Controller::HTTP_CONFLICT);
            return;
        }
        //end check dup firstname lastname


        //check dup username
        $condition = [
            'username' => $this->post("username")
        ];
        if($isTrainer){
            $condition['id !='] = $trainer->user_id;
        }
        $isDuplicate = $this->users->isDuplicate($condition,true);
        if($isDuplicate){
            $this->set_response([
            'status' => FALSE,
            'message' => 'Username ซ้ำจ้า'
            ], REST_Controller::HTTP_CONFLICT);
            return;
        }
        //end check dup username
        if($isTrainer){
            $data = [
                'username'=> $this->post("username")
            ];
            if($this->post("password") != ""){
                $data['password'] = password_hash($this->post("password"), PASSWORD_BCRYPT);
            }
            $this->users->update([
                'id' => $trainer->user_id
            ],$data);
            $user_id = $trainer->user_id;
        }else{
            $user_id = $this->users->createReturnID([
                'username'=> $this->post("username"),
                'password'=> password_hash($this->post("password"), PASSWORD_BCRYPT),
                'type'=>'4'
            ]);
        }
        
        if(!isset($user_id)){
            $this->set_response([
                'status' => FALSE,
                'message' => 'เกิดข้อผิดพลาดไม่สามารถเพิ่มผู้ใช้งานได้'
            ], REST_Controller::HTTP_CONFLICT);
            return;
        }

        $data = array(
            'user_id' => $user_id,
            'name_title'=> $this->post("name_title"),
            'firstname'=> $this->post("firstname"),
            'lastname'=> $this->post("lastname"),
            'job_position'=> $this->post("job_position"),
            'phone'=> $this->post("phone"),
            'email'=> $this->post("email"),
            'trainer_type'=> $this->post("trainer_type"),
            'workplace_id'=> $this->post("workplace_id")
            // 'picture'=> $file,
            
        );

        if($isTrainer){
            $result=$this->trainers->update([
                'trainer_id' => $trainer->trainer_id
            ],$data);
        }else{
            $result=$this->trainers->create($data);
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

    function updateTrainerPassword_post()
    {
        $this->load->model('users');

        //check update
        if(!is_null($this->post('username'))){
            $user = $this->users->first([
                'username'=>$this->post('username')
            ]);
        }
        $isUser = !is_null($user);

        if($isUser){
            $data = [
                'username'=> $this->post("username")
            ];
            if($this->post("password") != ""){
                $data['password'] = password_hash($this->post("password"), PASSWORD_BCRYPT);
            }
            $result = $this->users->update([
                'id' => $user->id
            ],$data);
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

    function setDeleted_post(){
        $this_date = date("Y/m/d");
        $trainer_id = $this->post('trainer_id');
        $trainer = $this->trainers->first([
            'trainer_id'=>$trainer_id
        ]);
        if(!is_null($trainer)){
            $isOr=false;
            $result = $this->trainers->update([
                'trainer_id' => $trainer_id
            ],[
                'deleted_at' => $this_date
            ],$isOr);
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

    function recycle_post(){
        $trainer_id = $this->post('recycle_id');
        $trainer = $this->trainers->first([
            'trainer_id' => $trainer_id
        ]);
        if(!is_null($trainer)){
            $result = $this->trainers->update([
                'trainer_id' => $trainer->trainer_id
            ],[
                'deleted_at' => null
            ]);
            if($result){
                $output["message"] = 'บันทึกสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = 'เกิดข้อผิดพลาดในการแก้ไข';
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }
        }else{
            $output["status"] = false;
            $output["message"] = 'เกิดข้อผิดพลาดในการแก้ไข';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
    }
 


}
