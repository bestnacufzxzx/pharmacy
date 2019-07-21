<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Students extends BD_Model{

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'student';
    }

    function student_id_to_year($student_id)
    {
        $year = "25".$student_id[0].$student_id[1];
        return $year-543;
    }

	function getStudentById($student_id){
        return $this->db->where("student_id", $student_id)->get("student")->row();
	}
	
	function getStudentBy($student_id){
		return $this->db->where("student_id", $student_id)->get("student")->row();
	}

	function createStudentImport($data)
	{
		return $this->db->insert("student", $data);
	}
	

	public function get_item_by_id($student_id)
    {
        return $this->db->get_where($this->student, ['student_id' => $student_id])->row();
    }


	function create_item($value)
    {
        $this->db->set('created', 'now()', false);
        $this->db->set('updated', 'now()', false);
        $this->db->insert($this->student, $value);
    }
	
	
	function getStudentByFirstnameOrLastname($search){
        $query = $this->db->query("SELECT * FROM `student` where firstname like '%".$search."%' OR lastname LIKE '%".$search."%'");
        return $query->result_array();
    }


    public function add($row, $dateCreated = FALSE) {
        $this->db->insert('student', $row);
        return $this->db->insert_id();
    }
    public function getAll() {
        if (isset($this->orderby) && $this->orderby != '') {
            $this->db->order_by($this->orderby);
        }
        $query = $this->db->get('student');
        return $query->result_array();
    }

    function isImportDuplicate($student_id, $username){
        $this->db->from("user");
        $this->db->join("student","user.id = student.user_id");
        $this->db->where("user.username", $username);
        $this->db->where("student.student_id", $student_id);
        $query = $this->db->get()->row();
        return $query != null;
    }

    function import($data){
        $this->db->trans_begin();
        $result["successData"] = [];
        $result["duplicateData"] = [];

        foreach ($data as $key => $row) {

            $isDuplicate = $this->isImportDuplicate($row["student"]["student_id"], $row["user"]["username"]);
            if(!$isDuplicate){
                $this->db->insert('user', $row["user"]);
                $userId = $this->db->insert_id();

                $row["student"]["user_id"] = $userId;
                $this->db->insert('student', $row["student"]);

                $result["successData"][] = array(
                    "username" => $row["user"]["username"],
                    "firstname" => $row["student"]["firstname"],
                    "lastname" => $row["student"]["lastname"],
                    "student_id" => $row["student"]["student_id"]
                );
            }else{
                $result["duplicateData"][] = array(
                    "username" => $row["user"]["username"],
                    "firstname" => $row["student"]["firstname"],
                    "lastname" => $row["student"]["lastname"],
                    "student_id" => $row["student"]["student_id"]
                    
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
	
  
}