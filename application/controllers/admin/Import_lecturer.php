<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_lecturer extends CI_Controller {

	function __construct()
    {
        // Construct the parent class
		parent::__construct();
        // $this->load->view("lib");
        $this->load->model("lecturers");
        // Load form validation library
        $this->load->library('form_validation');
        
        // Load file helper
        $this->load->helper('file');
    }

    function index(){
        $search = $this->input->get('search');
        $search_str = '';
        $conditonWhere = [];
        if(isset($search)){
            $conditonWhere['firstname'] = $search;
            $conditonWhere['lastname'] = $search;
            $search_str = '?search='. $search;
        }

        $this->load->library('pagination');
        $config = config_pagination();
        $config['base_url'] = base_url('admin/import_lecturer').$search_str;
        $config['total_rows'] = $this->lecturers->countWithOutTrash($conditonWhere,true,true);
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $page = ($this->input->get('per_page') ) ? $this->input->get('per_page')  : 0;

        
        $lecturers = $this->lecturers->getWithOutTrash($conditonWhere,[],$config['per_page'],$page,true,true);

        $data['search'] = $search;
        $data['lecturers'] = $lecturers;
        $data['total_rows'] = $config['total_rows'];
        $data['links'] = $this->pagination->create_links();

        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/import_lecturer/content",$data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/import_lecturer/script", $data);
    }

    public function create(){
        $this->load->model("courses");
        $courses = $this->courses->get();
        $data['courses'] = $courses;
        $data['isCreate'] = true;
        $data['lecturer'] = null;

        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/import_lecturer/add/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/import_lecturer/add/script");
    }

    public function update(){
        $this->load->model("courses");
        $this->load->model("users");
        $courses = $this->courses->get();
        $lecturer = $this->lecturers->first([
            'lecturer_id'=> $this->input->get('id')
        ]);
        $user = $this->users->first([
            'id' => $lecturer->user_id
        ]);
        $data['lecturer'] = $lecturer;
        $data['user'] = $user;
        $data['courses'] = $courses;
        $data['isCreate'] = false;

        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/import_lecturer/add/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/import_lecturer/add/script");
    }


    
    public function import(){
        $data['lecturers'] = $this->lecturers->getAll();

        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/import_lecturer/import/content", $data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/import_lecturer/import/script");
    }

    public function saveimport()
    {
        if(!$this->input->is_ajax_request()){
            show_404();
        }
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        $this->form_validation->set_rules('file','File','callback_notEmpty');
        
        $response= false;
        if(!$this->form_validation->run()){
            $response['status']    = 'form-incomplete';
            $response['errors']    =    array(
                array(
                    'field'    => 'input[name="file"]',
                    'error'    => form_error('file')
                )
            );
        }
        else{
            try{
                
                $filename = $_FILES["file"]["tmp_name"];
                if($_FILES['file']['size'] > 0)
                {
                    $file = fopen($filename,"r");
                    $is_header_removed = FALSE;
                    while(($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
                    {
                        if(!$is_header_removed){
                            $is_header_removed = TRUE;
                            continue;
                        }
                        $row = array(
                            'user_id'       =>  !empty($importdata[0])?$importdata[0]:'',
                            'name_title'    =>  !empty($importdata[1])?$importdata[1]:'',
                            'firstname'     =>  !empty($importdata[2])?$importdata[2]:'',
                            'lastname'      =>  !empty($importdata[3])?$importdata[3]:'',
                            'email'         =>  !empty($importdata[4])?$importdata[4]:'',
                            'username'      =>  !empty($importdata[5])?$importdata[5]:'',
                            'password'      =>  !empty($importdata[6])?$importdata[6]:'',
                            'course_id'     =>  !empty($importdata[7])?$importdata[8]:'',
                            // 'gender'        =>  !empty($importdata[3])?$importdata[3]:'',
                            // 'address'       =>  !empty($importdata[4])?$importdata[4]:''
                        );
                        $this->db->trans_begin();
                        $this->lecturers->add($row);
                        if(!$this->db->trans_status()){
                            $this->db->trans_rollback();
                            $response['status']='error';
                            $response['message']='Something went wrong while saving your data';
                            break;
                        }else{
                            $this->db->trans_commit();
                            $response['status']='success';
                            $response['message']='Successfully added new record.';
                        }
                    }
                    fclose($file);
                }
               
            }
            catch(Exception $e){
                $this->db->trans_rollback();
                $response['status']='error';
                $response['message']='Something went wrong while trying to communicate with the server.';
            }
        }
        echo json_encode($response);
    }
    public function notEmpty(){
        if(!empty($_FILES['file']['name'])){
            return TRUE;
        }
        else{
            $this->form_validation->set_message('notEmpty','The {field} field can not be empty.');
            return FALSE;
        }
    }

    function deleted(){
        $search = $this->input->get('search');
        $search_str = '';
        $conditonWhere = [];
        if(isset($search)){
            $conditonWhere['firstname'] = $search;
            $conditonWhere['lastname'] = $search;
            $search_str = '?search='. $search;
        }

        $this->load->library('pagination');
        $config = config_pagination();
        $config['base_url'] = base_url('admin/import_lecturer').$search_str;
        $config['total_rows'] = $this->lecturers->countInTrash($conditonWhere,true,true);
        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $page = ($this->input->get('per_page') ) ? $this->input->get('per_page')  : 0;

        
        $lecturers = $this->lecturers->getInTrash($conditonWhere,[],$config['per_page'],$page,true,true);
        
        $data['search'] = $search;
        $data['lecturers'] = $lecturers;
        $data['total_rows'] = $config['total_rows'];
        $data['links'] = $this->pagination->create_links();

        $this->load->view("theme/head");
		$this->load->view("admin/layout/left-menu");
		$this->load->view("admin/layout/header");
		$this->load->view("admin/import_lecturer/deleted/content",$data);
		$this->load->view("theme/footer");
        $this->load->view("theme/foot");
        $this->load->view("admin/import_lecturer/deleted/script", $data);
    }


}