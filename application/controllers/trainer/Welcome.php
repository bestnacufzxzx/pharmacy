<?php
class Welcome extends CI_Controller {
    function index(){
        redirect('/trainer/formtrainer', 'refresh');
    }
}