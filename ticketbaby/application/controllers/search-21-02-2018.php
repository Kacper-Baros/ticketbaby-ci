<?php

class Search extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('text', 'url', 'text');
        $this->load->helper('date');
        $this->load->library('pagination');
        $this->load->helper("url");
        $this->load->library('form_validation');
        $this->load->helper('captcha');
         $this->load->helper('file');
        $this->load->helper('string');
        $this->load->library('session');
        $this->load->helper('captcha');
         $this->load->library('upload');
    }

  function index($limit = 0){
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
        } else {
            $keyword = '';
            $_GET['keyword'] = '';
        }
        
        if(isset($_GET['_id'])){
            $cat = $_GET['cat_id'];
        }else{
            $cat = '';
            $_GET['cat_id'] = '';
        }
        
        $this->db->select('*');
        $this->db->from('tbl_events');
        $this->db->join('tbl_post as p', 'p.id = tbl_events.category_id');
        $this->db->where('p.parent_id', 0);
        $this->db->where('p.remark', 6);
        $this->db->like('name',$keyword);
        
        if($cat != ''){
            $this->db->where('category_id',$cat);
        }
        
		$event = $this->db->get()->result();
        $total_result = count($event);
        $app = '?keyword=' . $keyword . '&cat_id=' .$cat;
        $config['total_rows'] = $total_result;
        $config['base_url'] = base_url().'search/index';
        $config['per_page'] = 4;
        $config['uri_segment'] = 3;
        $config['suffix'] = $app;
        $config['first_url'] = base_url() . 'search/index' . $app;
        $this->pagination->initialize($config);
        
        
        $this->db->select('*');
        $this->db->from('tbl_events');
        $this->db->join('tbl_post as p', 'p.id = tbl_events.category_id');
        $this->db->where('p.parent_id', 0);
        $this->db->where('p.remark', 6);
        $this->db->like('name',$keyword);
        
           if($cat != ''){
            $this->db->where('category_id',$cat);
        }
        
        $this->db->limit(4, $limit);
        
       $data['results'] = $this->db->get()->result();
       
        $this->load->view('search_result', $data);
    }
}