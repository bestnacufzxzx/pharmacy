<?php
class Welcome extends CI_Controller {
    function index(){
        redirect('/lecturer/subject_responsible', 'refresh');
    }
}