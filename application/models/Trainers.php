<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Trainers extends BD_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'trainer';
    }

	function getTrainerById($trainer_id){
        return $this->db->where("trainer_id", $trainer_id)->get("trainer")->row();
	}
	
	function getTrainerBy($trainer_id){
		return $this->db->where("trainer_id", $trainer_id)->get("trainer")->row();
	}

	function createTrainerImport($data)
	{
		return $this->db->insert("trainer", $data);
	}
	

	public function get_item_by_id($trainer_id)
    {
        return $this->db->get_where($this->trainer, ['trainer_id' => $trainer_id])->row();
    }


	function create_item($value)
    {
        $this->db->set('created', 'now()', false);
        $this->db->set('updated', 'now()', false);
        $this->db->insert($this->trainer, $value);
    }
	
	
	function getTrainerByFirstnameOrLastname($search){
        $query = $this->db->query("SELECT * FROM `trainer` where firstname like '%".$search."%' OR lastname LIKE '%".$search."%'");
        return $query->result_array();
    }
	
	

  
}