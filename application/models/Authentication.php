<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Authentication extends CI_Model{
    public function getByUsername($username)
    {
        $user =  $this->getUserOtherTable('staff',$username);
        if(!is_null($user)){
            return  $user;
        }
        $user =  $this->getUserOtherTable('student',$username);
        if(!is_null($user)){
            return  $user;
        }
        
    }
    public function getUserOtherTable($table_name,$username)
    {
		$this->db->where('username', $username);
		$user = $this->db->get($table_name)->row();
		if(!is_null($user)){
            $user->type = $table_name;
			return $user;
        }else{
            return null;
        }
    }
}