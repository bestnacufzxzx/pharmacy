<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);
ini_set('display_errors', 1);
class Pdf extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model("Lecturers");
        $this->load->model("Students");
        $this->load->model("Years");
    }

    function index(){
        $data = [];
        if($this->input->post('submit') != NULL ){
            $postData = $this->input->post();  
            $student_id  =$postData['studentId'];
            $data["lecturer"] = $this->Lecturers->getAllLecturer();
            $data["student"] = $this->Students->getStudentById($postData['studentId']);
        
        }
        // echo $this->input->get($student_id);
        $id = $this->input->get('id');
        $this->load->library('m_mpdf');
        $html ='<div style="position:absolute;top:50px;left:580px;"><img src="'.base_url().$data["student"]->picture .'" width="120px" height="150px"></div>';
        $html .='<div style="position:absolute;top:305px;left:150px;">'.$data["student"]->name_title .' '. $data["student"]->firstname .' '. $data["student"]->lastname .'</div>';
        $html .='<div style="width:150px;position:absolute;top:305px;left:550px;">'.$data["student"]->nickname .'</div>';
        $html .='<div style="position:absolute;top:340px;left:180px;">'.$data["student"]->student_id .'</div>';
        $html .='<div style="position:absolute;top:340px;left:430px;">'.$data["student"]->phone .'</div>';
        $html .='<div style="position:absolute;top:370px;left:180px;">'.$data["student"]->address .' ตำบล '.$data["student"]->sub_district .' อำเภอ '.$data["student"]->district .' จังหวัด '.$data["student"]->province .' รหัสไปรษณีย์ '.$data["student"]->zipcode .'</div>';
        $html .='<div style="position:absolute;top:400px;left:150px;">'.$data["student"]->father_name .'</div>';
        $html .='<div style="position:absolute;top:400px;left:455px;">'.$data["student"]->father_job .'</div>';
        $html .='<div style="position:absolute;top:400px;left:620px;">'.$data["student"]->phone_father .'</div>';
        $html .='<div style="position:absolute;top:435px;left:155px;">'.$data["student"]->mother_name .'</div>';
        $html .='<div style="position:absolute;top:435px;left:455px;">'.$data["student"]->mother_job .'</div>';
        $html .='<div style="position:absolute;top:435px;left:620px;">'.$data["student"]->phone_mother .'</div>';
        $html .='<div style="position:absolute;top:470px;left:320px;">'.$data["student"]->address_emergency .'</div>';
        $html .='<div style="position:absolute;top:500px;left:130px;">'.' ตำบล '.$data["student"]->sub_district_emergency .' อำเภอ '.$data["student"]->district_emergency .' จังหวัด '.$data["student"]->province_emergency .' รหัสไปรษณีย์ '.$data["student"]->zipcode_emergency .'</div>';
        $html .='<div style="position:absolute;top:535px;left:200px;">'.$data["student"]->date_of_birth .'</div>';
        $html .='<div style="position:absolute;top:535px;left:445px;">'.$data["student"]->member_in_family .'</div>';
        $html .='<div style="position:absolute;top:535px;left:640px;">'.$data["student"]->member_all_family .'</div>';
        $html .='<div style="width:150px;position:absolute;top:565px;left:190px;">'.$data["student"]->congenital_disease .'</div>';
        $html .='<div style="width:150px;position:absolute;top:595px;left:195px;">'.$data["student"]->allergy_history .'</div>';
        $html .='<div style="position:absolute;top:660px;left:95px;">ประสบการณ์ทำงาน</div>';
        $html .='<div style="width:150px;position:absolute;top:695px;left:155px;">'.$data["student"]->hobbies .'</div>';
        $html .='<div style="width:150px;position:absolute;top:725px;left:205px;">'.$data["student"]->talent .'</div>';
        $html .='<div style="width:150px;position:absolute;top:790px;left:95px;">'.$data["student"]->talent .'</div>';
       

        $this->m_mpdf->mpdf->SetImportUse();
        $this->m_mpdf->mpdf->SetDocTemplate('pdf/personal.pdf',true);


        $this->m_mpdf->mpdf->WriteHTML($html);
        $this->m_mpdf->mpdf->Output();
    }

}