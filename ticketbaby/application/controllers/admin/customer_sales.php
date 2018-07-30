<?php
class Customer_sales extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Admin_model');
        $this->load->model('Front_model');
        $this->load->library('form_validation');
    }

    function index() {
        $this->list_orders();
    }

    function list_orders() {
        
        if(($_POST)){
          $data['orders'] = $this->Admin_model->filter_order($_POST);
       
        }else{
			$data['orders'] = $this->db->order_by('id', 'DESC')->get_where('tbl_orders')->result();
			//$data['orders'] = $this->db->order_by('id', 'DESC')->get_where('tbl_orders', array('user_id !='=>0))->result();
        }
        
        $data['logo'] = $this->db->get('site_settings')->row();
   
        $data['title'] = 'Customer Sales';
        $data['main'] = 'orders/customer_sales';
        $this->load->view('admin/index', $data);
    }
}
?>