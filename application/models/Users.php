<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Users extends BD_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'user';
    }
}