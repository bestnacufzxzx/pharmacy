<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Years extends BD_Model{

	function __construct()
    {
        parent::__construct();
        $this->tableName = 'year';
	}
	
	function get_now_year()
	{
		$this->db->where('set_now', 1);
		return $this->db->get($this->tableName)->row()->year;
	}

	public function create($data)
    {
        return $this->db->insert("year", $data);
	}

	public function whereFirst($year)
	{
		$this->db->where('year',$year);
		$query = $this->db->get('year');
		return $query->row();
	}

	function getMaxYear(){
		$query = $this->db->query("SELECT MAX(year) as year FROM year");
		return $query->result_array();
	}

	function resetSetNow(){
		$this->db->set('set_now', 0);
		$this->db->update($this->tableName);
	}

}