<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Set_inspector extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
        $this->load->model('subject_teachs');
        $this->load->model('years');
        $this->load->model('enrolls');
        $this->load->model('lecturer_responsibles');
        $this->load->model('assessments');
        $this->load->model('subjects');
    }

    function index(){
        $this_year = $this->years->get_now_year();
        $subjects = $this->subject_teachs->getJoinSubject($this_year,$this->input->get('course_id'));
        $data['subjects'] = $subjects;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/set_inspector/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/set_inspector/script");
    }

    function select_lecturer(){
        $subject_id = $this->input->get('subject_id');
        $subject_teach_id = $this->input->get('subject_teach_id');
        $lecturers = $this->lecturer_responsibles->getJoinLecturer($subject_teach_id);
        $subject = $this->subjects->first([
            'subject_id' => $subject_id
        ]);
        $all_enroll_student = $this->enrolls->count([
            'subject_teach_id' => $subject_teach_id
        ]);
        
        $check_in_enrolls = $this->enrolls->get([
            'subject_teach_id' => $subject_teach_id
        ]);
        $have_inspector = 0;
        foreach($check_in_enrolls as $check_in_enroll){
            $check_in_assessment = $this->assessments->first([
                'enroll_id' => $check_in_enroll['enroll_id']
            ]);
            if($check_in_assessment){
                $have_inspector ++;
            }
        }
        $residue = $all_enroll_student - $have_inspector;
        $lecturer_responsible = $this->lecturer_responsibles->get();
        foreach($lecturers as $key => $lecturer){
            $responsible = $this->assessments->count([
                'lecturer_responsible_id' => $lecturer['lecturer_responsible_id']
            ]);
            $lecturers[$key] += [ "responsible" => $responsible ];
        }
        $data['residue'] = $residue;
        $data['subject'] = $subject;
        $data['subject_teach_id'] = $subject_teach_id;
        $data['lecturers'] = $lecturers;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/set_inspector/select_lecturer/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/set_inspector/select_lecturer/script");
    }

    function choose_student_lecturer(){
        $subject_teach_id = $this->input->get('subject_teach_id');
        $subject_id = $this->input->get('subject_id');
        $lecturer_responsible_id = $this->input->get('lecturer_responsible_id');
        $this_year = $this->years->get_now_year();
        $students = $this->enrolls->getJoinStudentForcheckReport($subject_teach_id, $this_year);
        foreach($students as $key => $student){
           $check_this = $this->assessments->first([
               'enroll_id' => $student['enroll_id']
           ]);
           if($check_this){
               unset($students[$key]);
           }
        }
        $data['lecturer_responsible_id'] = $lecturer_responsible_id;
        $data['subject_id'] = $subject_id;
        $data['subject_teach_id'] = $subject_teach_id;
        $data['students'] = $students;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/set_inspector/choose_student_lecturer/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/set_inspector/choose_student_lecturer/script", $data);
    }

}