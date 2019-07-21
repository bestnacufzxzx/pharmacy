<?php
class BD_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->tableName = null;
    }
    function count($condition=[],$isOr=false,$isLike=false)
    {
        // $this->db->group_start();
        foreach($condition as $k => $v){
            if($isOr){
                if($isLike){
                    $this->db->or_like($k,$v);
                }else{
                    $this->db->or_where($k,$v);
                }
            }else{
                if($isLike){
                    $this->db->like($k,$v);
                }else{
                    $this->db->where($k,$v);
                }
            }
        }
        // $this->db->group_end();
        return $this->db->count_all_results($this->tableName);
    }
    function first($condition=[],$conditionOrder=[],$isOr=false)
    {
        foreach($conditionOrder as $k => $v){
            $this->db->order_by($k, $v);
        }
        foreach($condition as $k => $v){
            if($isOr){
                $this->db->or_where($k,$v);
            }else{
                $this->db->where($k,$v);
            }
        }
        return $this->db->get($this->tableName)->row();
    }
    function get($condition=[],$conditionOrder=[],$limit=null, $start=null,$isOr=false,$isLike=false) {
        foreach($conditionOrder as $k => $v){
            $this->db->order_by($k, $v);
        }
        
        if(sizeof($condition) > 0 ){
            $this->db->group_start();
            foreach($condition as $k => $v){
                if($isOr){
                    if($isLike){
                        $this->db->or_like($k,$v);
                    }else{
                        $this->db->or_where($k,$v);
                    }
                }else{
                    if($isLike){
                        $this->db->like($k,$v);
                    }else{
                        $this->db->where($k,$v);
                    }
                }
            }
            $this->db->group_end();
        }
        if(!is_null($limit)&&!is_null($start)){
            $this->db->limit($limit, $start);
        }
        // dd($this->db->last_query());
        return $this->db->get($this->tableName)->result_array();
	}
    function create($data){
        $this->db->insert($this->tableName, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    
    function createReturnID($data)
    {
        $this->db->insert($this->tableName, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    function isDuplicate($fields,$isAnd=false)
    {
        //default OR
        foreach($fields as $k => $v){
            if($isAnd){
                $this->db->where($k,$v);
            }else{
                $this->db->or_where($k,$v);
            }
        }
        $data = $this->db->get($this->tableName)->result_array();
        return $data != null;
    }

    function delete($fields,$isOr=false)
    {
        //default AND
        foreach($fields as $k => $v){
            if($isOr){
                $this->db->or_where($k,$v);
            }else{
                $this->db->where($k,$v);
            }
        }
        return $this->db->delete($this->tableName);
    }

    function update($fields,$data,$isOr=false){
        //default AND
        foreach($fields as $k => $v){
            if($isOr){
                $this->db->or_where($k,$v);
            }else{
                $this->db->where($k,$v);
            }
        }
        $this->db->set($data);
        return $this->db->update($this->tableName);
    }
    function countWithOutTrash($condition=[],$isOr=false,$isLike=false){
        $this->db->where('deleted_at IS NULL',null);
        return $this->count($condition,$isOr=false,$isLike=false);
    }
    function getWithOutTrash($condition=[],$conditionOrder=[],$limit=null, $start=null,$isOr=false,$isLike=false)
    {
        $this->db->where('deleted_at IS NULL',null);
        return $this->get($condition,$conditionOrder,$limit, $start,$isOr,$isLike);
        
    }

    function countInTrash($condition=[],$isOr=false,$isLike=false){
        $this->db->where('deleted_at IS NOT NULL',null);
        return $this->count($condition=[],$isOr=false,$isLike=false);
    }

    function getInTrash($condition=[],$conditionOrder=[],$limit=null, $start=null,$isOr=false,$isLike=false)
    {
        $this->db->where('deleted_at IS NOT NULL',null);
        return $this->get($condition,$conditionOrder,$limit, $start,$isOr,$isLike);
    }
    

}