<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Assessments extends BD_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'assessment';
    }
    function createAssessments($data){
        return $this->db->insert_batch('assessment', $data); 
    }
   
    function getById($assessment){
        return $this->db->where("assessment_id", $assessment_id)->get("assessment")->row();
	}

    public function add($row, $dateCreated = FALSE) {
        $this->db->insert('assessment', $row);
        return $this->db->insert_id();
    }

    public function edit($data)
	{
		$result = $this->db->insert('assessment', $data);
		return $result;
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

    function assessment_count($search, $year, $trainer_id){
        // $this->db->select("assessment.report, assessment.assessment_id , assessment.score_report , assessment.score_present, enroll.trainer_id, enroll.year");

        $this->db->from("assessment");
        $this->db->join("enroll","assessment.enroll_id = enroll.enroll_id");
        $this->db->join("subject_teach","enroll.subject_teach_id = subject_teach.subject_teach_id");
        $this->db->join("subject","subject.subject_id = subject_teach.subject_id");
        $this->db->join("student","student.student_id = enroll.student_id");
        $this->db->like("student.student_id", $search);
        $this->db->or_like("student.firstname", $search);
        $this->db->or_like("student.lastname", $search);

        $this->db->where("enroll.year", $year);
        $this->db->where("enroll.trainer_id", $trainer_id);

        return $this->db->count_all_results();

    }

    function assessment_search($search, $year, $trainer_id, $perpage, $start, $orderby){
        // $this->db->select("assessment.report, assessment.assessment_id , assessment.score_report , assessment.score_present, enroll.trainer_id, enroll.year");
        $this->db->from("assessment");
        $this->db->join("enroll","assessment.enroll_id = enroll.enroll_id");
        $this->db->join("subject_teach","enroll.subject_teach_id = subject_teach.subject_teach_id");
        $this->db->join("subject","subject.subject_id = subject_teach.subject_id");
        $this->db->join("student","student.student_id = enroll.student_id");
        $this->db->like("student.student_id", $search);
        $this->db->or_like("student.firstname", $search);
        $this->db->or_like("student.lastname", $search);

        $this->db->where("enroll.year", $year);
        $this->db->where("enroll.trainer_id", $trainer_id);
        $this->db->order_by($orderby, "asc");
        $this->db->limit($perpage, $start);

        return $this->db->get()->result_array();
    }

    function getAllAssessment($student_id){
        $this->db->from("assessment");
        $this->db->join("enroll","assessment.enroll_id = enroll.enroll_id");
        $this->db->join("subject_teach","enroll.subject_teach_id = subject_teach.subject_teach_id");
        $this->db->join("subject","subject.subject_id = subject_teach.subject_id");
        // $this->db->join("","");

        return $this->db->get()->result_array();

    }

    function getPercentByAssessmentId($assessment_id){
        $this->db->from("assessment");
        $this->db->join("enroll","assessment.enroll_id = enroll.enroll_id");
        $this->db->join("subject_teach","enroll.subject_teach_id = subject_teach.subject_teach_id");
        $this->db->where("assessment.assessment_id", $assessment_id);
        return $this->db->get()->row();
    }

}