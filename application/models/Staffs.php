<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Staffs extends BD_Model{

	function __construct()
    {
        parent::__construct();
        $this->tableName = 'staff';
	}
}