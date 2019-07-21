<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Lecturers extends BD_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'lecturer';
    }
    function delete($fields,$isOr=false)
    {
        return $this->update($fields,['deleted_at'=>'2020-01-01'],$isOr);
    }

	function getById($lecturer_id){
        return $this->db->where("lecturer_id", $lecturer_id)->get("lecturer")->row();
	}

	function createLecturerImport($data)
	{
		return $this->db->insert("lecturer", $data);
    }
    
	public function edit($data)
	{
		$lecturer_id = $data['lecturer_id'];
		unset($data['lecturer_id']);
		$this->db->where('lecturer_id', $lecturer_id);	
		$result = $this->db->update('lecturer', $data);
		return $result;
	}

	function delete_item($lecturer_id)
    {
        $this->db->delete($this->lecturer, ['lecturer_id' => $lecturer_id]);
	}

	function allLecturer_count()
    {   
        $query = $this
                ->db
                ->get('lecturer');
    
        return $query->num_rows();  
                                                                                                                                                                                                
	}
	
	function alllecturer($limit,$start,$col,$dir)
    {   
       $query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('lecturer');
        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
	}
	
	function lecturer_search($limit,$start,$search,$col,$dir,$status)
    {
        $this->db->like('namelec',$search);
        if($status != null){
            $this->db->where("status", $status);
        }
        $query = $this->db->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('lecturer');       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }
    function lecturer_search_count($search,$status)
    {
        $query = $this
                ->db
                ->like('namcelec',$search)
                ->where('status',$status)
                ->get('lecturer');
    
        return $query->num_rows();
    } 

    function getByFirstnameOrLastname($search){
        $query = $this->db->query("SELECT * FROM `lecturer` where firstname like '%".$search."%' OR lastname LIKE '%".$search."%'");
        return $query->result_array();
    }
    
    public function add($row, $dateCreated = FALSE) {
        $this->db->insert('lecturer', $row);
        return $this->db->insert_id();
    }
    public function getAll() {
        if (isset($this->orderby) && $this->orderby != '') {
            $this->db->order_by($this->orderby);
        }
        $query = $this->db->get('lecturer');
        return $query->result_array();
    }

    function isImportDuplicate($username){
        $this->db->from("user");
        $this->db->where("username", $username);
        $query = $this->db->get()->row();
        return $query != null;
    }

    function import($data){
        $this->db->trans_begin();
        $result['duplicateData'] = [];
        $result['successData'] = [];
        foreach ($data as $key => $row) {

            $duplicateArr = array(
                "username" => $row["user"]["username"]
            );

            $isDuplicate = $this->isImportDuplicate($row["user"]["username"]);
            if(!$isDuplicate){
                $this->db->insert('user', $row["user"]);
                $userId = $this->db->insert_id();

                $row["lecturer"]["user_id"] = $userId;
                $this->db->insert('lecturer', $row["lecturer"]);
                $result['successData'][] = array(
                    "username" => $row["user"]["username"],
                    "firstname" => $row["lecturer"]["firstname"],
                    "lastname" => $row["lecturer"]["lastname"]
                );
            }else{
                $result['duplicateData'][] = array(
                    "username" => $row["user"]["username"],
                    "firstname" => $row["lecturer"]["firstname"],
                    "lastname" => $row["lecturer"]["lastname"]
                );
            }

        }
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return $result;
        }
    }   

    function assessment_count($search, $year, $lecturer_id){
        $this->db->select();
        $this->db->from("student");
        $this->db->join("enroll","student.student_id = enroll.student_id");
        $this->db->like("student.student_id", $search);
        $this->db->or_like("student.firstname", $search);
        $this->db->or_like("student.lastname", $search);

        $this->db->where("enroll.year", $year);
        $this->db->where("lecturer_id", $lecturer_id);

        return $this->db->count_all_results();
    }

    function getAllLecturer() {
		return $this->db->get('lecturer')->result_array();
    }

    function assessment_search($search, $year, $lecturer_id, $perpage, $start, $orderby){
        $this->db->select();
        $this->db->from("student");
        $this->db->join("enroll","student.student_id = enroll.student_id");
        $this->db->like("student.student_id", $search);
        $this->db->or_like("student.firstname", $search);
        $this->db->or_like("student.lastname", $search);

        $this->db->where("enroll.year", $year);
        $this->db->where("lecturer_id", $lecturer_id);
        $this->db->order_by($orderby, "asc");
        $this->db->limit($perpage, $start);

        return $this->db->get()->result_array();
    }
    
}