<?php
/**
 * @author   Natan Felles <natanfelles@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('type_to_path'))
{
	function type_to_path($type)
	{

        switch ($type) {
            case 1: 
                return 'admin';
                break;
            case 2:
                return 'lecturer';
                break;
            case 3:
                return 'student';
                break;
            case 4:
                return 'trainer';
                break;
            default:
                return 'auth/login';
                break;
        }
	}
}
