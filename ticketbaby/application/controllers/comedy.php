<?php

class Comedy extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('text', 'url', 'text');
        $this->load->model('Front_model');
        $this->load->library('session');
    }

    function index() {
      $data['club_sliders'] = $this->db->get_where('tbl_events',array('category_id'=>129))->result();
      $this->load->view('comedy',$data);
    }
}

    

?>