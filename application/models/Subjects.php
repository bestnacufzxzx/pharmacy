<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Subjects extends BD_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'subject';
    }

    function getJoinTrainingCourse($course_id){
        $this->db->select('*, subject.course_id as course_id');
        $this->db->where('subject.course_id', $course_id);
        $this->db->join('training_type', 'training_type.training_type_id = subject.training_type_id and training_type.course_id = subject.course_id' );
        return $this->db->get($this->tableName)->result_array();
    }


    // function create($data){
    //     $this->db->insert('subject', $data);
    //     return ($this->db->affected_rows() != 1) ? false : true;
    // }


}
    