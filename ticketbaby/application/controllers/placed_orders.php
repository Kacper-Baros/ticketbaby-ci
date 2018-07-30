<?php
class Placed_orders extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('text', 'url', 'text');
        $this->load->helper('date');
        $this->load->library('pagination');
		$this->load->model('Admin_model');
        $this->load->model('Front_model');
    }
    function index() {
		$id = $this->session->userdata('user_id');
        if(!empty($id)){ 
			$data['details'] = $this->db->get_where('tbl_users',array('id'=>$id))->row();
			if(($_POST)){
			  $data['orders'] = $this->Admin_model->filter_order($_POST);
			}else{
				$data['orders'] = $this->db->order_by('id', 'DESC')->get_where('tbl_orders',array('user_id'=>$id))->result();
			}
			$data['title'] = 'Placed Orders';
			$this->load->view('placed_orders', $data);
        }else{
            redirect(base_url('login'));
        }
    }
}
?>