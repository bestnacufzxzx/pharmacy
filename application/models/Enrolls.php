<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Enrolls extends BD_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'enroll';
    }
    function getJoinSubject($student_id,$year,$schedule=null)
    {
        $this->db->select('subject.subject_id as subject_id ,enroll.schedule as schedule,subject.subject_code as subject_code,workplace.workplace_name as workplace_name, subject.training_type_id as training_type_id, enroll.enroll_id as enroll_id');
        $this->db->where('enroll.student_id',$student_id);
        $this->db->where('enroll.year',$year);

        if(!is_null($schedule)){
            $this->db->where('enroll.schedule',$schedule);
        }

        $this->db->join('subject_teach', 'subject_teach.subject_teach_id = enroll.subject_teach_id');
        $this->db->join('subject', 'subject.subject_id = subject_teach.subject_id');
        $this->db->join('workplace_subject', 'workplace_subject.workplace_subject_id = enroll.workplace_subject_id', 'left');
        $this->db->join('workplace', 'workplace_subject.workplace_id = workplace.workplace_id','left');
        return $this->db->get($this->tableName)->result_array();
    }

    function getStudentInEnroll($subject_teach_id){
        $this->db->select('enroll.student_id as student_id, student.firstname as firstname, student.lastname as lastname, enroll.year as year');
        $this->db->where('enroll.subject_teach_id', $subject_teach_id);
        $this->db->join('student', 'student.student_id = enroll.student_id');
        $enrolls = $this->db->get('enroll')->result_array();
        $students = [];
        foreach($enrolls as $enroll){
            $students[$enroll['student_id']] = [
                'student_id' => $enroll['student_id'],
                'firstname' => $enroll['firstname'],
                'lastname' => $enroll['lastname'],
                'year' => $enroll['year']
            ];
        }
        return $students;
    }

    function getStudentEnroll($next_year, $course_id){
        $this->db->select('enroll.student_id as student_id, student.name_title as name_title, student.firstname as firstname, student.lastname as lastname, enroll.year as year');
        $this->db->where('enroll.year', $next_year);
        $this->db->where('subject.course_id', $course_id);
        $this->db->join('student', 'student.student_id = enroll.student_id');
        $this->db->join('subject_teach', 'subject_teach.subject_teach_id = enroll.subject_teach_id');
        $this->db->join('subject', 'subject.subject_id = subject_teach.subject_id');
        $enrolls = $this->db->get('enroll')->result_array();
        $students = [];
        foreach($enrolls as $enroll){
            $students[$enroll['student_id']] = [
                'student_id' => $enroll['student_id'],
                'name_title' => $enroll['name_title'],
                'firstname' => $enroll['firstname'],
                'lastname' => $enroll['lastname'],
                'year' => $enroll['year']
            ];
        }
        return $students;
    }

    function getNameTitleFromStudent($subject_teach_id, $schedule, $year){
        $this->db->select('student.name_title as name_title');
        $this->db->where('enroll.subject_teach_id', $subject_teach_id);
        $this->db->where('enroll.schedule', $schedule);
        $this->db->where('enroll.year', $year);
        $this->db->join('student', 'student.student_id = enroll.student_id');
        $results = $this->db->get($this->tableName)->result_array();
        $name_titles = [];
        foreach($results as $result){
            array_push($name_titles,$result['name_title']);
        }
        return $name_titles;
    }

    function getJoinStudent($year, $subject_teach_id, $schedule){
        $this->db->select('enroll.enroll_id as enroll_id, student.student_id as student_id, student.firstname as firstname, student.lastname as lastname, student.name_title as name_title, enroll.workplace_subject_id as workplace_subject_id');
        $this->db->where('enroll.year', $year);
        $this->db->where('enroll.subject_teach_id', $subject_teach_id);
        $this->db->where('enroll.schedule', $schedule);
        $this->db->join('student', 'student.student_id = enroll.student_id');
        $result = $this->db->get($this->tableName)->result_array();
        return $result;
    }

    function getNameTitleToWorkplaceSubject($workplace_subject_id, $schedule){
        $this->db->select('student.name_title as name_title');
        $this->db->where('enroll.workplace_subject_id', $workplace_subject_id);
        $this->db->where('enroll.schedule', $schedule);
        $this->db->join('student', 'student.student_id = enroll.student_id');
        $results = $this->db->get($this->tableName)->result_array();
        $name_titles = [];
        foreach($results as $result){
            array_push($name_titles,$result['name_title']);
        }
        return $name_titles;
    }


    function getForTrainingDetail($student_id){
        $this->db->select('workplace.workplace_name as workplace_name, enroll.schedule as schedule, subject.subject_code as subject_code, subject.subject_name as subject_name, enroll.year as year');
        $this->db->where('enroll.student_id', $student_id);
        $this->db->join('subject_teach','subject_teach.subject_teach_id = enroll.subject_teach_id', 'left');
        $this->db->join('subject','subject.subject_id = subject_teach.subject_id', 'left');
        $this->db->join('workplace_subject','workplace_subject.workplace_subject_id = enroll.workplace_subject_id', 'left');
        $this->db->join('workplace','workplace_subject.workplace_id = workplace.workplace_id', 'left');
        $this->db->order_by("schedule", "asc");
        $result = $this->db->get($this->tableName);
        return $result->result_array();
    }
    
    function getJoinStudentForcheckReport($subject_teach_id, $year){
        $this->db->where('enroll.subject_teach_id', $subject_teach_id);
        $this->db->where('enroll.year', $year);
        $this->db->join('student', 'student.student_id = enroll.student_id');
        $results = $this->db->get($this->tableName)->result_array();
        return $results;
    }

    function getJoinStudentForTraining($year){
        $this->db->select('student.student_id as student_id, student.name_title as name_title, student.firstname as firstname, student.lastname as lastname');
        $this->db->group_by('student.student_id'); 
        $this->db->where('enroll.year', $year);
        $this->db->join('student', 'student.student_id = enroll.student_id');
        $result = $this->db->get($this->tableName)->result_array();
        return $result;
    }
}