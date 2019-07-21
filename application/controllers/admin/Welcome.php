<?php
class Welcome extends CI_Controller {
    function index(){
        redirect('/admin/edit_year', 'refresh');
    }
}