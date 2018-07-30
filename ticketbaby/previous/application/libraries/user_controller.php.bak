<?php 
class User_controller extends CI_Controller{
    public $user = array();
	
	
	public function __construct(){
        parent::__construct();
		
		die('test');
        $this->load->library('session'); // loading session class
		$this->load->helper('form');
		$this->load->library('form_validation');		
		$this->load->model('user_details');
		$exception_uris  = array('login');
		$this->load->helper('url');
		
		$arr_url = explode('/',uri_string());
		
		
		
		if(!(in_array('login',$arr_url))){
			if(in_array(uri_string(), $exception_uris) == FALSE) {	//die('test');
				if($this->admin_login_model->loggedin() == FALSE)
					redirect('user/login');
			}
		}
		
		
		
	
	}
	
	public function login_name(){
		$sess = $this->session->userdata('admin');
		$ar = unserialize($sess);
		if(!empty($ar)){
			return $ar;
		}
	}
	/*
	** Layout method
	*/
	public function layout($view,$data){
		
		$ar = $this->login_name();
		$data['first_name'] = $ar['first_name'];
		$data['last_name'] = $ar['last_name'];
		
		$this->load->view('admin/templates/header',$data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view("admin/{$view}",$data); 
		$this->load->view('admin/templates/footer');	
	}
}