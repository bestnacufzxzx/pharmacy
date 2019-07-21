<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Student extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('students');
    }

    function delete_post()
    {
        $this->load->model('users');
        $student_id = $this->post('student_id');
        $student = $this->students->first([
            'student_id'=>$student_id
        ]);
        if(!is_null($student)){
            $result = $this->users->delete([
                'id' => $student->user_id
            ]);
            if($result){
                $output["message"] = 'ลบสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = 'ไม่สามารลบได้เนื่องจากมีการนำข้อมูลไปใช้';
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }
        }else{
            $output["status"] = false;
            $output["message"] = 'ไม่สามารลบได้เนื่องจากมีการนำข้อมูลไปใช้';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
        
    }


    function create_post()
    {
        $this->load->model('users');
        $lecturer = null;
        //check update
        if(!is_null($this->post('student_id'))){
            $student = $this->students->first([
                'student_id'=>$this->post('student_id')
            ]);
        }
        $isStudent = !is_null($student);
        
        //check dup firstname lastname
        $condition = [
            'firstname' => $this->post("firstname"),
            'lastname' => $this->post("lastname")
        ];
        if($isStudent){
            $condition['student_id !='] = $student->student_id;
        }
        $isDuplicate = $this->students->isDuplicate($condition,true);
        if($isDuplicate){
            $this->set_response([
                'status' => FALSE,
                'message' => 'ข้อมูลซ้ำ'
            ], REST_Controller::HTTP_CONFLICT);
            return;
        }
        //end check dup firstname lastname


        //check dup username
        $condition = [
            'username' => $this->post("username")
        ];
        if($isStudent){
            $condition['id !='] = $student->user_id;
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
        if($isStudent){
            $data = [
                'username'=> $this->post("username")
            ];
            if($this->post("password") != ""){
                $data['password'] = password_hash($this->post("password"), PASSWORD_BCRYPT);
            }
            $this->users->update([
                'id' => $student->user_id
            ],$data);
            $user_id = $student->user_id;
        }else{
            $user_id = $this->users->createReturnID([
                'username'=> $this->post("username"),
                'password'=> password_hash($this->post("password"), PASSWORD_BCRYPT),
                'type'=>'3'
            ]);
        }
        
        if(!isset($user_id)){
            $this->set_response([
                'status' => FALSE,
                'message' => 'เกิดข้อผิดพลาดไม่สามารถเพิ่มผู้ใช้งานได้'
            ], REST_Controller::HTTP_CONFLICT);
            return;
        }

        $student_id = $this->post("student_id");
        $year = $this->students->student_id_to_year($student_id);

        $data = array(
            'user_id' => $user_id,
            'year' => $year,
            'name_title'=> $this->post("name_title"),
            'firstname'=> $this->post("firstname"),
            'lastname'=> $this->post("lastname"),
            'nickname'=> $this->post("nickname"),
            'student_id'=> $student_id,
            'id_card'=> $this->post("id_card"),
            'date_of_birth'=> $this->post("date_of_birth"),
            'member_in_family'=> $this->post("member_in_family"),
            'member_all_family'=> $this->post("member_all_family"),
            'congenital_disease'=> $this->post("congenital_disease"),
            'allergy_history'=> $this->post("allergy_history"),
            'hobbies'=> $this->post("hobbies"),
            'talent'=> $this->post("talent"),
            'trait'=> $this->post("trait"),
            'address'=> $this->post("address"),
            'phone'=> $this->post("phone"),
            'email'=> $this->post("email"),
            'address_emergency'=> $this->post("address_emergency"),
            'father_name'=> $this->post("father_name"),
            'mother_name'=> $this->post("mother_name"),
            'father_job'=> $this->post("father_job"),
            'mother_job'=> $this->post("mother_job"),
            'address_parent'=> $this->post("address_parent"),
            'phone_father'=> $this->post("phone_father"),
            'phone_mother'=> $this->post("phone_mother"),
            'sub_district'=> $this->post("sub_district"),
            'district'=> $this->post("district"),
            'province'=> $this->post("province"),
            'zipcode'=> $this->post("zipcode"),
            'sub_district_emergency'=> $this->post("sub_district_emergency"),
            'district_emergency'=> $this->post("district_emergency"),
            'province_emergency'=> $this->post("province_emergency"),
            'zipcode_emergency'=> $this->post("zipcode_emergency"),
            'sub_district_parent'=> $this->post("sub_district_parent"),
            'district_parent'=> $this->post("district_parent"),
            'province_parent'=> $this->post("province_parent"),
            'zipcode_parent'=> $this->post("zipcode_parent")
        );
        if(!is_null($this->post("picture"))){
            $img = $this->post("picture");
            if (strpos($img, 'data:image/png;') !== false) {
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $bese64data = base64_decode($img);
                $imageName = uniqid().'.png';
            }else if(strpos($img, 'data:image/jpeg;') !== false) {
                $img = str_replace('data:image/jpeg;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $bese64data = base64_decode($img);
                $imageName = uniqid().'.jpg';
            }
            
            $file_name = 'public/images/profile/'. $imageName;
            $success = file_put_contents($file_name, $bese64data); // อัพรูป
            if($success){
                $data['picture'] = $file_name;
            }
        }

        if($isStudent){
            $result=$this->students->update([
                'student_id' => $student->student_id
            ],$data);
        }else{
            $result=$this->students->create($data);
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
    function updateStudentPassword_post()
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


    function saveImport_post(){
        $csvData = $this->post('csvData');
        $data = [];
        foreach ($csvData as $key => $row) {
            $data[$key]["user"] = array(
                'username'      =>  !empty($row[5])?$row[5]:'',
                'password'     =>  password_hash(!empty($row[6])?$row[6]:'password', PASSWORD_BCRYPT),
                'type'     =>  3
            );

            $data[$key]["student"] = array(
                'student_id'    =>  !empty($row[1])?$row[1]:'',
                'name_title'     =>  !empty($row[2])?$row[2]:'',
                'firstname'      =>  !empty($row[3])?$row[3]:'',
                'lastname'         =>  !empty($row[4])?$row[4]:'',
                'year'     =>  !empty($row[7])?$row[7]:'',
                
            );
        }

        $result = $this->students->import($data);

        if(is_array($result)){
            $output["message"] = 'บันทึกสำเร็จ';
            $output["result"] = $result;
            $this->set_response($output, REST_Controller::HTTP_OK);
        }else{
            $output["status"] = false;
            $output["message"] = 'เกิดข้อผิดพลาดในการบันทึก';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
    }


}
