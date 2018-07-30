<?php

class Singleview extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('text', 'url', 'text');
        $this->load->model('Front_model');
        $this->load->library('session');
    }

    function index() {
		$id= $this->uri->segment(2);
	  $data['resulte'] = $this->db->get_where('tbl_events',array('id'=>$id))->result();
      $this->load->view('singleview',$data);
    }
}

    

?>