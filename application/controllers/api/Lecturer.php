<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Lecturer extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('lecturers');
    }
    
    function update_post($lecturer_id)
    {
            $data = array(
                'name_title'=> $this->post("name_title"),
                'lecturer_id'=> $this->post("lecturer_id"),
                'firstname'=> $this->post("firstname"),
                'lastname'=> $this->post("lastname"),
                'date_of_birth'=> $this->post("date_of_birth"),
                'email'=> $this->post("email"),
                'department'=> $this->post("department"),
                'phone'=> $this->post("phone"),
                'phone2'=> $this->post("phone2"),
                'address'=> $this->post("address"),
                'sub_district'=> $this->post("sub_district"),
                'district'=> $this->post("district"),
                'province'=> $this->post("province"),
                'zipcode'=> $this->post("zipcode"),
                'role_id'=> $this->post("role_id"),
                'username'=> $this->post("username"),
                'password'=> password_hash($this->post("password"), PASSWORD_BCRYPT),
            );
            // $this->lecturers->update_item($data);
            $result=$this->lecturers->edit($data);  
            if($result){
                $output["message"] = REST_Controller::MSG_SUCCESS;
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = REST_Controller::MSG_NOT_CREATE;
                $this->set_response($output, REST_Controller::HTTP_OK);
            }
    }
    function searchlecturer_post(){
        $column = "namelec";
        $sort = "asc";
        if($this->post('column') == 3){
            $column = "status";
        }else if($this->post('column') == 2){
            $sort = "desc";
        }else{
            $sort = "asc";
        }

        $limit = $this->post('length');
        $start = $this->post('start');
        $order = $column;
        $dir = $sort;
        
        $totalData = $this->lecturers->allLecturer_count();
        $totalFiltered = $totalData; 
        if(empty($this->post('namelec')))
        {            
            $posts = $this->lecturers->alllecturer($limit,$start,$order,$dir);
        }
        else {
            $search = $this->post('namelec');
            $status = 1;
            $posts =  $this->lecturers->lecturer_search($limit,$start,$search,$order,$dir,$status);
            $totalFiltered = $this->lecturers->lecturer_search_count($search,$status);
        }
        $data = array();
        $index = 0;
        $count = 0;
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $nestedData[$count]['name_title'] = $post->name_title;
                $nestedData[$count]['lecturer_id'] = $post->lecturer_id;
                $nestedData[$count]['firstname'] = $post->firstname;
                $nestedData[$count]['lastname'] = $post->lastname;
                $nestedData[$count]['id_card'] = $post->id_card;
                $nestedData[$count]['date_of_birth'] = $post->date_of_birth;
                $nestedData[$count]['email'] = $post->email;
                $nestedData[$count]['department'] = $post->department;
                $nestedData[$count]['phone_lecturer'] = $post->phone_lecturer;
                $nestedData[$count]['phone_lecturer2'] = $post->phone_lecturer2;
                $nestedData[$count]['address_lecturer'] = $post->address_lecturer;
                $nestedData[$count]['sub_district'] = $post->sub_district;
                $nestedData[$count]['district'] = $post->district;
                $nestedData[$count]['province'] = $post->province;
                $nestedData[$count]['zipcode'] = $post->zipcode;
                $data[$index] = $nestedData;
                if($count >= 3){
                    $count = -1;
                    $index++;
                    $nestedData = [];
                }
                
                $count++;
            }
        }
        $json_data = array(
            "draw"            => intval($this->post('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
        $this->set_response($json_data);
    }

    function create_post()
    {
        $this->load->model('users');
        $lecturer = null;
        //check update
        if(!is_null($this->post('lecturer_id'))){
            $lecturer = $this->lecturers->first([
                'lecturer_id'=>$this->post('lecturer_id')
            ]);
        }
        $isLecturer = !is_null($lecturer);
        
        //check dup firstname lastname
        $firstname = $this->post("firstname");
        $lastname = $this->post("lastname");
        $condition = [
            'firstname' => $this->post("firstname"),
            'lastname' => $this->post("lastname")
        ];
        if($isLecturer){
            $condition['lecturer_id !='] = $lecturer->lecturer_id;
        }
       
        $isDuplicate = $this->lecturers->isDuplicate($condition,true);
        if($isDuplicate){
            $this->set_response([
                'status' => FALSE,
                'message' => 'มีข้อมูลผู้ใช้ชื่อ '.$firstname.' '.$lastname.' ในระบบแล้ว'
            ], REST_Controller::HTTP_CONFLICT);
            return;
        }
        //end check dup firstname lastname


        //check dup username
        $username = $this->post("username");
        $condition = [
            'username' => $this->post("username")
        ];
        if($isLecturer){
            $condition['id !='] = $lecturer->user_id;
        }
  
        $isDuplicate = $this->users->isDuplicate($condition,true);
        if($isDuplicate){
            $this->set_response([
            'status' => FALSE,
            'message' => 'มีชื่อผู้ใช้งาน '.$username.' ในระบบแล้ว '
            ], REST_Controller::HTTP_CONFLICT);
            return;
            
        }
        //end check dup username
        if($isLecturer){
            $data = [
                'username'=> $this->post("username"),
                'type'=>'2'
            ];
            if($this->post("password") != ""){
                $data['password'] = password_hash($this->post("password"), PASSWORD_BCRYPT);
            }
            $this->users->update([
                'id' => $lecturer->user_id
            ],$data);
            $user_id = $lecturer->user_id;
        }else{
            $user_id = $this->users->createReturnID([
                'username'=> $this->post("username"),
                'password'=> password_hash($this->post("password"), PASSWORD_BCRYPT),
                'type'=>'2'
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
            'lecturer_id'=> $this->post("lecturer_id"),
            'firstname'=> $this->post("firstname"),
            'lastname'=> $this->post("lastname"),
            'date_of_birth'=> $this->post("date_of_birth"),
            'email'=> $this->post("email"),
            'course_id'=> $this->post("course_id"),
            'phone'=> $this->post("phone"),
            'phone2'=> $this->post("phone2"),
            'address'=> $this->post("address"),
            'sub_district'=> $this->post("sub_district"),
            'district'=> $this->post("district"),
            'province'=> $this->post("province"),
            'zipcode'=> $this->post("zipcode"),
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
            
            
            

        if($isLecturer){
            $result=$this->lecturers->update([
                'lecturer_id' => $lecturer->lecturer_id
            ],$data);
        }else{
            $result=$this->lecturers->create($data);
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

    function updatepass_post($lecturer_id)
    {
            $sessData = now_user();
		    $lecturer_id = $sessData['lecturer_id'];
            $data = array(
                'lecturer_id' => $lecturer_id,
                'password'=> password_hash($this->post("password"), PASSWORD_BCRYPT)
            );
            $result=$this->lecturers->edit($data);
            
            if($result){
                $output["message"] = REST_Controller::MSG_SUCCESS;
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = REST_Controller::MSG_NOT_CREATE;
                $this->set_response($output, REST_Controller::HTTP_OK);
            }
    }

    function delete_post()
    {
        //lecturer_responsible
        
        $this->load->model('users');
        $lecturer_id = $this->post('lecturer_id');
        $lecturer = $this->lecturers->first([
            'lecturer_id'=>$lecturer_id
        ]);
        if(!is_null($lecturer)){
            $result = $this->lecturers->delete([
                'lecturer_id' => $lecturer->lecturer_id
            ]);
            if($result){
                $output["message"] = 'ลบสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = 'ไม่สามารถลบได้เนื่องจากมีการนำไปใช้ที่อื่น';
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }
        }else{
            $output["status"] = false;
            $output["message"] = 'ไม่สามารถลบได้เนื่องจากมีการนำไปใช้ที่อื่น';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
        
    }

    function saveImport_post(){
        $csvData = $this->post('csvData');
        $data = [];
        foreach ($csvData as $key => $row) {
            $data[$key]["user"] = array(
                'username'   =>  !empty($row[5])?$row[5]:'',
                'password'   =>  password_hash(!empty($row[6])?$row[6]:'password', PASSWORD_BCRYPT),
                'type'   =>  2
            );

            $data[$key]["lecturer"] = array(
                'name_title' =>  !empty($row[1])?$row[1]:'',
                'firstname'  =>  !empty($row[2])?$row[2]:'',
                'lastname'  =>  !empty($row[3])?$row[3]:'',
                'email' =>  !empty($row[4])?$row[4]:'',
                'course_id' =>  !empty($row[7])?$row[7]:''
            );
        }

        $result = $this->lecturers->import($data);

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

    function recycle_post(){
        $lecturer_id = $this->post('recycle_id');
        $lecturer = $this->lecturers->first([
            'lecturer_id' => $lecturer_id
        ]);
        if(!is_null($lecturer)){
            $result = $this->lecturers->update([
                'lecturer_id' => $lecturer->lecturer_id
            ],[
                'deleted_at' => null
            ]);
            if($result){
                $output["message"] = 'บันทึกสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = 'ไม่สามารถลบได้เนื่องจากมีการนำข้อมูลไปใช้ที่อื่น';
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }
        }else{
            $output["status"] = false;
            $output["message"] = 'ไม่สามารถลบได้เนื่องจากมีการนำข้อมูลไปใช้ที่อื่น';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
    }

    function saveAssessment_report(){
        
    }


}
