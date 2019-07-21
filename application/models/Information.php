<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class Information extends BD_Model{
    function __construct()
    {
        parent::__construct();
        $this->tableName = 'news';
    }

    function getAllNews() {
		return $this->db->get('news')->result_array();
    }
    
    public function create($data)
    {
        return $this->db->insert("news", $data);
    }

    public function get_item_by_id($data)
    {
        return $this->db->get_where($this->news, ['student_id' => $data])->row();
    }

    public function edit($data)
	{
        $data['start_date'] = date('Y-m-d H:i:s');
		// $news_id = $data['news_id'];
		// unset($data['news_id']);
		// $this->db->where('news_id', $news_id);	
        // $result = $this->db->update('news', $data);
        $result = $this->db->replace('news', $data);
		return $result;
	}

    
    function delete_item($news_id)
    {
        $this->db->delete($this->news, ['news_id' => $news_id]);
    }
    
    // function getNewsById($newsId){
	// 	return $this->db->where("news_id", $newsId)->get("news")->row();

	// }
  
    function getNewsById($newsId){
        $query = $this->db->query("select * from news where news_id = '$newsId' ");
        return $query->result_array();
    }

    function getNewsByType1(){
        $query = $this->db->query("SELECT * FROM `news` INNER JOIN staff ON staff.staff_id=news.staff_id WHERE news_type_id = 1 ");
        return $query->result_array();
    }
    function getNewsByType2(){
        $query = $this->db->query("SELECT * FROM `news` INNER JOIN staff ON staff.staff_id=news.staff_id WHERE news_type_id = 2 ");
        return $query->result_array();
    }
    function getNewsByType3(){
        $query = $this->db->query("SELECT * FROM `news` INNER JOIN staff ON staff.staff_id=news.staff_id WHERE news_type_id = 3 ");
        return $query->result_array();
    }

}