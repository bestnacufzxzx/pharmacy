<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Workplace_types extends BD_Model{

        function __construct()
        {
            parent::__construct();
            $this->tableName = 'workplace_type';
        }

		function getAllWorkplace_type() {
			return $this->db->get('workplace_type');
		}

		function getAllWorkplacetype() {
			return $this->db->get('workplace_type')->result_array();
		}

		function getWorkplace_typeById($workplace_type_id){
					return $this->db->where("workplace_type_id", $workplace_type_id)->get("workplace_type")->row();
		}

		function getWorkplace_typeByName($workplace_type_name){
			return $this->db->where("workplace_type_name", $workplace_type_name)->get("workplace_type")->row();
		}
		
		function delete_item($workplace_type_id){
			$this->db->delete($this->workplace_type, ['workplace_type_id' => $workplace_type_id]);
		}

		public function edit($data){
			$workplace_type_id = $data['workplace_type_id'];
			unset($data['workplace_type_id']);
			$this->db->where('workplace_type_id', $workplace_type_id);	
			$result = $this->db->update('workplace_type',$data);
			return $result;
		}
			
		public function create($data){
			return $this->db->insert("workplace_type", $data);
		}

		function getWorkplacetypeByTypename($search){
			$query = $this->db->query("SELECT * FROM `workplace_type` where workplace_type_name like '%".$search."%'");
			return $query->result_array();
		}
}
