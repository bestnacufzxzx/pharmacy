<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class News_types extends CI_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'news_type';
    }

    function getAllNewsTypes() {
		return $this->db->get('news_type')->result_array();
    }

}