<?php

class Concert extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('text', 'url', 'text');
        $this->load->model('Front_model');
        $this->load->library('session');
    }

    function index() {
		$data['club_sliders'] = $this->db->get_where('tbl_events',array('category_id'=>168,'recommended_carousel'=>'1'))->result();
	  $data['resulte'] = $this->db->get_where('tbl_events',array('category_id'=>168))->result();
	  $data['categories'] = $this->db->get_where('tbl_post', array('parent_id' => '0', 'remark' => '6'))->result();
      $this->load->view('concert',$data);
    }
	
	public function singleview()
	 {
      $id= $this->uri->segment(3);
	  $data['resulte'] = $this->db->get_where('tbl_events',array('id'=>$id))->result();
	  $data['additional'] = $this->db->get_where('additional_event_detail',array('event_id'=>$id))->result();
      $this->load->view('singleview',$data);
    }
	
}

    

?>