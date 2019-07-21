<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Training_types extends BD_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'training_type';
    }

    // function create($data){
    //     $this->db->insert('training_type', $data);
    //     return ($this->db->affected_rows() != 1) ? false : true;
    // }

    // function delete($trainingTypeId, $courseId){
    //     $this->db->where('training_type_id', $trainingTypeId);
    //     $this->db->where('course_id', $courseId);
    //     return $this->db->delete('training_type');  
    // }

    // function update($data){
    //     return $this->db->replace('training_type', $data);
    // }

    // function isDuplicate($courseId, $name){
    //     $this->db->where('training_type_name',$name);
    //     $this->db->where('course_id',$courseId);
    //     $data = $this->db->get('training_type')->result_array();
    //     return $data != null;
    // }

    public function getNextId($courseId)
    {
        $this->db->where('course_id',$courseId);
        $this->db->order_by('training_type_id','desc');
        $data = $this->db->get('training_type')->row();
        if(is_null($data)){
            return 1;
        }else{
            return $data->training_type_id+1;
        }
    }
}