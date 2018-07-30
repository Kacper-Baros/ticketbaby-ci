<?php
class My_sales_report extends CI_Controller {

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
				$oquery = $this->db->query("SELECT * FROM `tbl_orders` WHERE `event_id` IN (SELECT `id` FROM `tbl_events` WHERE `user_id`='".$id."') ORDER BY `id` DESC");
				$data['orders'] = $oquery->result();
			}
			$data['title'] = 'My Sales Report';
			$this->load->view('my_sales_report', $data);
        }else{
            redirect(base_url('login'));
        }
    }	
	
}
?>