<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Workplace_subjects extends BD_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'workplace_subject';
    }

    function getJoinWorkplaceTypeArray($training_type_id, $year, $schedule){
        $this->db->where('workplace_subject.training_type_id', $training_type_id);
        $this->db->where('workplace_subject.year', $year);
        $this->db->where('workplace_subject.schedule', $schedule);
        $this->db->join('workplace', 'workplace_subject.workplace_id = workplace.workplace_id');
        $this->db->join('workplace_type', 'workplace.workplace_type_id = workplace_type.workplace_type_id');
        $workplace_types =  $this->db->get($this->tableName)->result_array();
        $workplace_types_array = [];
        foreach ($workplace_types as $workt) {
            $workplace_types_array[$workt['workplace_type_id']] = $workt['workplace_type_name'];
        }
        return $workplace_types_array;
    }

    function getJoinWorkplace($training_type_id, $year, $schedule, $workplace_type_id=null){
        $this->db->where('workplace_subject.training_type_id', $training_type_id);
        $this->db->where('workplace_subject.year', $year);
        $this->db->where('workplace_subject.schedule', $schedule);
        $this->db->where('workplace.workplace_type_id', $workplace_type_id);
        $this->db->join('workplace', 'workplace_subject.workplace_id = workplace.workplace_id');
        return $this->db->get($this->tableName)->result_array();
    }

    function getByAdmin($training_type_id, $year, $schedule){
        $this->db->select('workplace_subject.workplace_subject_id as workplace_subject_id, workplace.workplace_name as workplace_names');
        $this->db->where('workplace_subject.training_type_id', $training_type_id);
        $this->db->where('workplace_subject.year', $year);
        $this->db->where('workplace_subject.schedule', $schedule);
        $this->db->join('workplace', 'workplace_subject.workplace_id = workplace.workplace_id');
        return $this->db->get($this->tableName)->result_array();
    }
    
    function deleteWithoutTrainingType($training_type, $year, $schedule, $workplace_id, $course_id){
        $this->db->where('year', $year);
        $this->db->where('schedule', $schedule);
        $this->db->where('workplace_id', $workplace_id);
        $this->db->where('course_id', $course_id);
        $this->db->where_not_in('training_type_id', $training_type);
        return $this->db->delete($this->tableName); 
    }
    function receiveCountBySubject($year,$training_type_id,$schedule, $course_id)
    {
        $this->db->select_sum('receive_male');
        $this->db->select_sum('receive_female');
        $this->db->select_sum('receive_unknow');
        $this->db->where('training_type_id', $training_type_id);
        $this->db->where('year', $year);
        $this->db->where('schedule', $schedule);
        $this->db->where('workplace_subject.course_id', $course_id);
        return $this->db->get($this->tableName)->row();
    }

    function getWorkplaceToStudent($training_type_id, $year, $schedule, $course_id){
        $this->db->select('workplace.workplace_id as workplace_id, workplace.workplace_name as workplace_name, workplace_subject.workplace_subject_id as workplace_subject_id, workplace_subject.receive_male as receive_male, workplace_subject.receive_female as receive_female, workplace_subject.receive_unknow as receive_unknow');
        $this->db->where('workplace_subject.training_type_id', $training_type_id);
        $this->db->where('workplace_subject.year', $year);
        $this->db->where('workplace_subject.schedule', $schedule);
        $this->db->where('workplace_subject.course_id', $course_id);
        $this->db->join('workplace', 'workplace.workplace_id = workplace_subject.workplace_id');
        return $this->db->get($this->tableName)->result_array();
    }


}