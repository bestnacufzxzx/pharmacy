<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Subject_teachs extends BD_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'subject_teach';
    }

    function getJoinSubject($year, $course_id){
        $this->db->where('subject_teach.year', $year);
        $this->db->where('subject.course_id', $course_id);
        $this->db->join('subject', 'subject_teach.subject_id = subject.subject_id');
        return $this->db->get($this->tableName)->result_array();
    }

    function getTrainingType($subject_teach_id){
        $this->db->select('subject.training_type_id as training_type_id');
        $this->db->where('subject_teach.subject_teach_id', $subject_teach_id);
        $this->db->join('subject', 'subject.subject_id = subject_teach.subject_id');
        // $this->db->join('training_type', 'training_type.training_type_id = subject.training_type_id');
        // $this->db->join('workplace_subject', 'workplace_subject.training_type_id = training_type.training_type_id');
        // $this->db->join('workplace', 'workplace.workplace_id = workplace_subject.workplace_id');
        return $this->db->get($this->tableName)->result_array();
    }


    function getSubjectTeachById($subject_teach_id){
        return $this->db->where("subject_teach_id", $subject_teach_id)->get("subject_teach")->row();
    }

    function getSubjectName($subject_teach_id){
        $this->db->select('subject.subject_name as subject_name, subject.subject_code as subject_code');
        $this->db->where('subject_teach.subject_teach_id', $subject_teach_id);
        $this->db->join('subject', 'subject.subject_id = subject_teach.subject_id');
        return $this->db->get($this->tableName)->row();
    }
}