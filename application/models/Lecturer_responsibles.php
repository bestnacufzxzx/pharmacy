<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Lecturer_responsibles extends BD_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'lecturer_responsible';
    }
    
    function createLecturerResponsible($data){
      return $this->db->insert_batch($this->tableName, $data); 
    }
    
    function getLecturerId($subject_teach_id){
      $this->db->select('lecturer_id');
      $this->db->where('subject_teach_id', $subject_teach_id);
      $result = $this->db->get($this->tableName);
      return $result->result_array();
    }

    function getJoinLecturer($subject_teach_id)
    {
        $this->db->where('subject_teach_id', $subject_teach_id);
        $this->db->join('lecturer', 'lecturer.lecturer_id = lecturer_responsible.lecturer_id');
        $results = $this->db->get($this->tableName)->result_array();
        return $results;
    }

    function getSubjectTeach($lecturer_id, $year_select){
      $this->db->where('lecturer_id', $lecturer_id);
      $this->db->where('subject_teach.year', $year_select);
      $this->db->join('subject_teach', 'subject_teach.subject_teach_id = lecturer_responsible.subject_teach_id');
      $this->db->join('subject', 'subject.subject_id = subject_teach.subject_id');
      return $this->db->get($this->tableName)->result_array();
    }

    
}