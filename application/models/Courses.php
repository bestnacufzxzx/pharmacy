<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Courses extends CI_Model{

	function get() {
		$query = $this->db->get('course');
		return $query->result_array();
    }
}