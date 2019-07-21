<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Workplace extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('workplaces');
    }
    
    function update_post($workplace_id)
    {
            $data = array(
                'workplace_id'=> $this->post("workplace_id"),
                'workplace_name'=> $this->post("workplace_name"),
                'address'=> $this->post("address"),
                'phone'=> $this->post("phone"),
                'fax'=> $this->post("fax"),
                'email'=> $this->post("email"),
                'sub_district'=> $this->post("sub_district"),
                'district'=> $this->post("district"),
                'province'=> $this->post("province"),
                'zipcode'=> $this->post("zipcode"),
                'website'=> $this->post("website"),
                'latitude'=> $this->post("latitude"),
                'longitude'=> $this->post("longitude"),
                'picture'=> $this->post("picture"),
                'manager_name'=> $this->post("manager_name"),
                'job_position'=> $this->post("job_position"),
                'type_of_factory'=> $this->post("type_of_factory"),
                'workplace_type_id'=> $this->post("workplace_type_id")
            );
            // $this->workplaces->update_item($data);
            $result=$this->workplaces->edit($data);  
            if($result){
                $output["message"] = REST_Controller::MSG_SUCCESS;
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = REST_Controller::MSG_NOT_CREATE;
                $this->set_response($output, REST_Controller::HTTP_OK);
            }
    }
    function searchworkplace_post(){
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
        
        $totalData = $this->workplaces->allworkplace_count();
        $totalFiltered = $totalData; 
        if(empty($this->post('namelec')))
        {            
            $posts = $this->workplaces->allworkplace($limit,$start,$order,$dir);
        }
        else {
            $search = $this->post('namelec');
            $status = 1;
            $posts =  $this->workplaces->workplace_search($limit,$start,$search,$order,$dir,$status);
            $totalFiltered = $this->workplaces->workplace_search_count($search,$status);
        }
        $data = array();
        $index = 0;
        $count = 0;
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $nestedData[$count]['workplace_id'] = $post->workplace_id;
                $nestedData[$count]['workplace_name'] = $post->workplace_name;
                $nestedData[$count]['address'] = $post->address;
                $nestedData[$count]['phone'] = $post->phone;
                $nestedData[$count]['fax'] = $post->fax;
                $nestedData[$count]['email'] = $post->email;
                $nestedData[$count]['sub_district'] = $post->sub_district;
                $nestedData[$count]['district'] = $post->district;
                $nestedData[$count]['province'] = $post->province;
                $nestedData[$count]['zipcode'] = $post->zipcode;
                $nestedData[$count]['latitude'] = $post->latitude;
                $nestedData[$count]['longitude'] = $post->longitude;
                $nestedData[$count]['picture'] = $post->picture;
                $nestedData[$count]['manager_name'] = $post->manager_name;
                $nestedData[$count]['job_position'] = $post->job_position;
                $nestedData[$count]['type_of_factory'] = $post->type_of_factory;
                $nestedData[$count]['workplace_type_id'] = $post->workplace_type_id;
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
        $workplace = null;
        //check update
        if(!is_null($this->post('workplace_id'))){
            $workplace = $this->workplaces->first([
                'workplace_id'=>$this->post('workplace_id')
            ]);
        }
        $isWorkplace = !is_null($workplace);

        $condition = [
            'workplace_name' => $this->post("workplace_name")
        ];
        if($isWorkplace){
            $condition['workplace_id !='] = $workplace->workplace_id;
        }
        $isDuplicate = $this->workplaces->isDuplicate($condition,true);
        if($isDuplicate){
            $this->set_response([
                'status' => FALSE,
                'message' => 'มีข้อมูลแหล่งฝึกอยู่ในระบบแล้ว'
            ], REST_Controller::HTTP_CONFLICT);
            return;
        }

        $data = array(
            'workplace_id'=> $this->post("workplace_id"),
            'workplace_name'=> $this->post("workplace_name"),
            'address'=> $this->post("address"),
            'phone'=> $this->post("phone"),
            'fax'=> $this->post("fax"),
            'email'=> $this->post("email"),
            'sub_district'=> $this->post("sub_district"),
            'district'=> $this->post("district"),
            'province'=> $this->post("province"),
            'zipcode'=> $this->post("zipcode"),
            'website'=> $this->post("website"),
            'latitude'=> $this->post("latitude"),
            'longitude'=> $this->post("longitude"),
            'manager_name'=> $this->post("manager_name"),
            'job_position'=> $this->post("job_position"),
            'type_of_factory'=> $this->post("type_of_factory"),
            'workplace_type_id'=> $this->post("workplace_type_id")
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
            
            $file_name = 'public/images/workplace/'. $imageName;
            $success = file_put_contents($file_name, $bese64data); // อัพรูป
            if($success){
                $data['picture'] = $file_name;
            }
        }

        
        if($isWorkplace){
            $result=$this->workplaces->update([
                'workplace_id' => $workplace->workplace_id
            ],$data);
        }else{
            $result=$this->workplaces->create($data);
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
        //workplace_responsible
        
        $this->load->model('users');
        $workplace_id = $this->post('workplace_id');
        $workplace = $this->workplaces->first([
            'workplace_id'=>$workplace_id
        ]);
        if(!is_null($workplace)){
            $result = $this->workplaces->delete([
                'workplace_id' => $workplace->workplace_id
            ]);
            if($result){
                $output["message"] = 'ลบสำเร็จ';
                $this->set_response($output, REST_Controller::HTTP_OK);
            }else{
                $output["status"] = false;
                $output["message"] = 'แหล่งฝึกนี้ถูกใช้งานอยู่';
                $this->set_response($output, REST_Controller::HTTP_CONFLICT);
            }
        }else{
            $output["status"] = false;
            $output["message"] = 'แหล่งฝึกนี้ถูกใช้งานอยู่';
            $this->set_response($output, REST_Controller::HTTP_CONFLICT);
        }
        
    }

    function saveImport_post(){
        $csvData = $this->post('csvData');
        $data = [];
        foreach ($csvData as $row) {
            $data[] = array(
                'workplace_name'    =>  !empty($row[0])?$row[0]:'',
                'address'     =>  !empty($row[1])?$row[1]:'',
                'phone'      =>  !empty($row[2])?$row[2]:'',
                'fax'         =>  !empty($row[3])?$row[3]:'',
                'email'      =>  !empty($row[4])?$row[4]:'',
                'sub_district'     =>  !empty($row[5])?$row[5]:'',
                'district'     =>  !empty($row[6])?$row[6]:'',
                'province'     =>  !empty($row[7])?$row[7]:'',
                'zipcode'     =>  !empty($row[8])?$row[8]:'',
                'website'     =>  !empty($row[9])?$row[9]:'',
                'manager_name'     =>  !empty($row[10])?$row[10]:'',
                'job_position'     =>  !empty($row[11])?$row[11]:'',
                'type_of_factory'     =>  !empty($row[12])?$row[12]:'',
                'workplace_type_id'     =>  !empty($row[13])?$row[13]:''

            );
        }
        $this->set_response($data, REST_Controller::HTTP_OK);
    }


}
