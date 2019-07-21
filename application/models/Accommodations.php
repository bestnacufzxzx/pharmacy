<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Accommodations extends BD_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'accommodation';
    }

    function getAllAccommodation() {
		return $this->db->get('accommodation')->result_array();
	}

	function getAccommodationById($accommodation_id){
        return $this->db->where("accommodation_id", $accommodation_id)->get("accommodation")->row();
    }
    
    function getAccommodationByWorkplaceId($workplace_id){
        return $this->db->where("workplace_id", $workplace_id)->get("accommodation")->result_array();
	}

	function getAccommodationByName($accommodation_name){
        return $this->db->where("accommodation_name", $accommodation_name)->get("accommodation")->row();
	}



	public function edit($data)
	{
		$accommodation_id = $data['accommodation_id'];
		unset($data['accommodation_id']);
		$this->db->where('accommodation_id', $accommodation_id);	
		$result = $this->db->update('accommodation',$data);
		return $result;
    }
    
    public function create($data)
    {
        return $this->db->insert("accommodation", $data);
    }

	function createWorkplaceImport($data)
	{
		return $this->db->insert("accommodation", $data);
	}


	function delete_item($accommodation_id)
    {
        $this->db->delete($this->accommodation, ['accommodation_id' => $accommodation_id]);
    }


    function getAccommodationByAccommodationName($search,$id){
    
        $query = $this->db->query("SELECT * FROM `accommodation` WHERE workplace_id like $id  AND accommodation_name like '%".$search."%'");
        return $query->result_array();
    }
}