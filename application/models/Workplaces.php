<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Workplaces extends BD_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'workplace';
    }

    function getById($workplace_id){
        return $this->db->where("workplace_id", $workplace_id)->get("workplace")->row();
    }

	public function edit($data)
	{
		$workplace_id = $data['workplace_id'];
		unset($data['workplace_id']);
		$this->db->where('workplace_id', $workplace_id);	
		$result = $this->db->update('workplace',$data);
		return $result;
    }
    
    public function create($data)
    {	
        return $result = $this->db->insert('workplace',$data);
    }

	function createWorkplaceImport($data)
	{
		return $this->db->insert("workplace", $data);
	}


	function delete_item($workplace_id)
    {
        $this->db->delete($this->workplace, ['workplace_id' => $workplace_id]);
    }

    function allworkplace_count()
    {   
        $query = $this
                ->db
                ->get('workplace');
    
        return $query->num_rows();                                                                                                                                                                                             
    }

    function allworkplace($limit,$start,$col,$dir)
    {   
       $query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('workplace');
        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
    
    function workplace_search($limit,$start,$search,$col,$dir,$status)
    {
        $this->db->like('namelec',$search);
        if($status != null){
            $this->db->where("status", $status);
        }
        $query = $this->db->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('workplace');       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function workplace_search_count($search,$status)
    {
        $query = $this
                ->db
                ->like('namcelec',$search)
                ->where('status',$status)
                ->get('workplace');
    
        return $query->num_rows();
    }

    function getByName($search){
        $this->db->like('workplace_name', $search);
        $query = $this->db->get('workplace');
        return $query->result_array();
    }

    public function add($row, $dateCreated = FALSE) {
        $this->db->insert('workplace', $row);
        return $this->db->insert_id();
    }
    public function getAll() {
        if (isset($this->orderby) && $this->orderby != '') {
            $this->db->order_by($this->orderby);
        }
        $query = $this->db->get('workplace');
        return $query->result_array();
    }

    function getWorkplaceById($workplace_id){
        return $this->db->where("workplace_id", $workplace_id)->get("workplace")->row();
    }

    function getAllWork_place() {
		return $this->db->get('workplace')->result_array();
    }
    
    function getJoinWorkplaceType($workplace_id) {
        $this->db->where('workplace_id', $workplace_id);
        $this->db->join('workplace_type' , 'workplace.workplace_type_id = workplace_type.workplace_type_id');
        return $this->db->get('workplace')->result_array();
    }
}