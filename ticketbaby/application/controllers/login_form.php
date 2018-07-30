<?php
class Login_form extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('Ip_model');
		$this->load->helper('admin_helper');
    }
	
	function index(){
		$IP=$_SERVER['REMOTE_ADDR'];
		$data['logo'] = $this->db->get('site_settings')->row();
        $data['ipcheck'] = $this->Ip_model->ip_exists($IP);
        $data['title'] = "Login Form";
        $data['main'] = 'login_form';
        $this->load->view('admin/login_form', $data);
    }
}
?>