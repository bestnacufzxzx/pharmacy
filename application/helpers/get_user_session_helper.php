<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('get_user_session'))
{
	function get_user_session()
	{
        $CI =& get_instance();
        $CI->load->model('users');
        $user_id = $CI->session->userdata['user']['user'];
        $user = $CI->users->first([
            'id' => $user_id
        ]);
        switch ($user->type) {
            case '1':
                $CI->load->model('staffs');
                $staff = $CI->staffs->first([
                    'user_id' => $user_id
                ]);
                return $staff;
                break;
            case '2':
                $CI->load->model('lecturers');
                $lecturer = $CI->lecturers->first([
                    'user_id' => $user_id
                ]);
                return $lecturer;
                break;
            case '3':
                $CI->load->model('students');
                $student = $CI->students->first([
                    'user_id' => $user_id
                ]);
                return $student;
                break;
            case '4':
                $CI->load->model('trainers');
                $trainer = $CI->trainers->first([
                    'user_id' => $user_id
                ]);
                return $trainer;
                break;
            default:
                # code...
                break;
        }
		// return $user_id;
	}
}
