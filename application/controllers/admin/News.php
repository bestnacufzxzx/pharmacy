<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
    }

    function index(){
        $this->load->model("Information");
        $newss = $this->Information->getAllNews();
        $data['newss'] = $newss;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/news/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/news/script");
    }

    public function add(){
        $this->load->model("Information");
        $this->load->model("News_types");
        $newsId = $this->input->post('newsId');;
        $newss = $this->Information->getNewsById($newsId);
        $newstypes = $this->News_types->getAllNewsTypes();
        $data['newss'] = $newss;
        $data['newstypes'] = $newstypes;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/news/add/content",$data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/news/add/script");
    }

    public function update(){
        $this->load->model("Information");
        $this->load->model("News_types");
        $newsId = $this->input->post('newsId');;
        $newss = $this->Information->getNewsById($newsId);
        $newstypes = $this->News_types->getAllNewsTypes();
        $data['newss'] = $newss;
        $data['newstypes'] = $newstypes;
        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/news/update/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/news/update/script");
    }
    
    function deleteNewss(){
        if($this->input->post('newsIds') != NULL ){
            $postData = $this->input->post();
            var_dump($newsIds);
            // echo "<b>newsIds id :</b> ".$postData['newsIds']."<br/>";
            $this->load->model("Newss");
            $this->db->where('news_id', $postData['newsIds']);
            $this->db->delete('news');
            header("Location: http://localhost/pharmacy/admin/news", true, 301);
        }
    }
    
}