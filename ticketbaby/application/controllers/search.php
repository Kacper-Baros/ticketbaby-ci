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
		$Category_id = '';
		$keywords = '';
		$City_Town = '';
		$from_date = '';
		$to_date = '';
		foreach($_REQUEST as $keys=>$values){
			$$keys = $values;
		}
		if($Category_id){
			$Category_id = $Category_id;
		}
		if($keywords){
			$keywords = $keywords;
		}
		if($City_Town){
			$City_Town = $City_Town;
		}
		if($from_date){
			$from_date = $from_date;
		}
		if($to_date){
			$to_date = $to_date;
		}
		
		if($Category_id!=0 && $keywords=='' && $City_Town==0 && $from_date=='' && $to_date==''){
			$this->db->select('*');
			$this->db->from('tbl_events');
			$this->db->where('category_id', $Category_id);
		}
		else if($Category_id==0 && $keywords!='' && $City_Town==0 && $from_date=='' && $to_date==''){
			$this->db->select('*');
			$this->db->from('tbl_events');
			$this->db->like('name',$keywords);
		}
		else if($Category_id==0 && $keywords=='' && $City_Town!=0 && $from_date=='' && $to_date==''){
			$this->db->select('*');
			$this->db->from('tbl_events');
			$this->db->like('city',$City_Town);
		}
		else if($Category_id==0 && $keywords=='' && $City_Town==0 && $from_date!='' && $to_date==''){
			$this->db->select('*');
			$this->db->from('tbl_events');
			$this->db->like('start_date',$from_date);
		}
		else if($Category_id==0 && $keywords=='' && $City_Town==0 && $from_date=='' && $to_date!=''){
			$this->db->select('*');
			$this->db->from('tbl_events');
			$this->db->like('end_date',$to_date);
		}
		else if($Category_id!=0 && $keywords!='' && $City_Town!=0 && $from_date!='' && $to_date!=''){
			$this->db->select('*');
			$this->db->from('tbl_events');
			$this->db->where('category_id', $Category_id);
			$this->db->like('name',$keywords);
			$this->db->like('city',$City_Town);
			$this->db->like('start_date',$from_date);
			$this->db->like('end_date',$to_date);
		}
		else{
			$this->db->select('*');
			$this->db->from('tbl_events');
		}

		$event = $this->db->get()->result();
		
		$total_result = count($event);
		$app = '?keywords=' . $keywords . '&Category_id=' .$Category_id . '&City_Town=' .$City_Town . '&from_date=' .$from_date . '&to_date=' .$to_date;
		$config['total_rows'] = $total_result;
		$config['base_url'] = base_url().'search/index';
		$config['per_page'] = 4;
		$config['uri_segment'] = 3;
		$config['suffix'] = $app;
		$config['first_url'] = base_url() . 'search/index' . $app;
		$this->pagination->initialize($config);
		if($Category_id!=0 && $keywords=='' && $City_Town==0 && $from_date=='' && $to_date==''){
			$this->db->select('*');
			$this->db->from('tbl_events');
			$this->db->where('category_id', $Category_id);
		}
		else if($Category_id==0 && $keywords!='' && $City_Town==0 && $from_date=='' && $to_date==''){
			$this->db->select('*');
			$this->db->from('tbl_events');
			$this->db->like('name',$keywords);
		}
		else if($Category_id==0 && $keywords=='' && $City_Town!=0 && $from_date=='' && $to_date==''){
			$this->db->select('*');
			$this->db->from('tbl_events');
			$this->db->like('city',$City_Town);
		}
		else if($Category_id==0 && $keywords=='' && $City_Town==0 && $from_date!='' && $to_date==''){
			$this->db->select('*');
			$this->db->from('tbl_events');
			$this->db->like('start_date',$from_date);
		}
		else if($Category_id==0 && $keywords=='' && $City_Town==0 && $from_date=='' && $to_date!=''){
			$this->db->select('*');
			$this->db->from('tbl_events');
			$this->db->like('end_date',$to_date);
		}
		else if($Category_id!=0 && $keywords!='' && $City_Town!=0 && $from_date!='' && $to_date!=''){
			$this->db->select('*');
			$this->db->from('tbl_events');
			$this->db->where('category_id', $Category_id);
			$this->db->like('name',$keywords);
			$this->db->like('city',$City_Town);
			$this->db->like('start_date',$from_date);
			$this->db->like('end_date',$to_date);
		}
		else{
			$this->db->select('*');
			$this->db->from('tbl_events');
		}
		
		$this->db->limit(4, $limit);
		
		$data['results'] = $this->db->get()->result();
	   
		$this->load->view('search_result', $data);
	}
}