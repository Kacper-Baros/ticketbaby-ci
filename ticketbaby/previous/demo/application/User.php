<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
		protected $_table_name = 'user_details';
		protected $_table_names = 'user_master';
		protected $_table_order = 'order_master';
		
        public function __construct()
        {
                parent::__construct();
		        $this->load->model('user_details');
				 $this->load->helper('url');
        }
	
        public function index()
        {
			 echo  redirect(base_url()); // todo
        }
		
		/****
		NEW REGISTRATION
		****/
		public function registration()
		{
			$this->user_details->loggedin() == FALSE || redirect("cart/home");
			$this->load->view('templates/header', $data);
			$this->load->view('user/registration', $data);
			$this->load->view('templates/footer', $data);
		}
		/*
		public function search()
		{
			
			$user_detail= $this->session->userdata('detail');
			$userss = unserialize($user_detail);
			$this->load->view('templates/header', $data);
			$this->load->view('user/search_result', $userss);
			$this->load->view('templates/footer', $data);
		}
		*/
			
		
		/****
		INPUT REGISTRATION
		****/
		
		public function save_registration() {
			
			if($this->input->post('submit')){
			
				$this->user_details->loggedin() == FALSE || redirect("user/home");
				$user_name      	   = $this->input->post('user_name');
				$first_name            = $this->input->post('first_name');
				$email      		   = $this->input->post('email');
				$mobile_number         = $this->input->post('contact_number');
				$password        	   = $this->input->post('password');
				$re_password      	   = $this->input->post('re_password');
				
				$rspn1 = $this->user_details->check_email_available($email);
				$rspn	=	0;
				if($rspn1==0)
				{
					$rspn = $this->user_details->check_username_available($user_name);
				}else{
					$this->session->set_flashdata('error', '<div class="alert alert-warning display-hide"><span>Email name already exits</span></div> ');				
					redirect("user/registration");		
					}
				
				//print_r($rspn);
			//die('trest');
				if($rspn==0)
				{
					$response = $this->user_details->registerUserNew(array( "user_name" => $user_name,"first_name" => $first_name, "email" => $email, "mobile_number" => $mobile_number, "password" => $password, "re_password" => $re_password));
					if($response){
						$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Your are registered  Successfully, Please Login. </span></div> ');			
						redirect("user/registration");			
					}else{
						$this->session->set_flashdata('error', '<div class="alert alert-warning display-hide"><span>Your registration is not save! Please try again.</span></div> ');				
						redirect("user/registration");			
					}
				}
				else{
				$this->session->set_flashdata('error', '<div class="alert alert-warning display-hide"><span>User name already exits</span></div> ');				
					redirect("user/registration");		
					}
			}else{
				redirect("user/registration");		
			}
		
        }
		
		/****
		UPDATE REGISTRATION
		****/
		public function edit_user_detail()
		{
				if($this->input->post('update')){
				$response = $this->user_details->updateUser();
				
				if($response)
				{
					$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Successfully <strong></strong>Chnaged.</span></div> ');				
					redirect("user/account_detail");			
				}
				else
				{
					$this->session->set_flashdata('error', '<div class="alert alert-error display-hide"><span>Password not match.</span></div> ');				
					redirect("user/account_detail");			
				}
			}
			else
			{
				$this->login();
			}
		
        }
		/****
		LOGIN
		****/
		
		public function login()
		{
			$this->user_details->loggedin() == FALSE || redirect("cart/home");
			$this->load->view('templates/header', $data);
			$this->load->view('user/login', $data);
			$this->load->view('templates/footer', $data);

		}
		/****
		LOGIN  CHECK
		****/
        public function authentication(){
			//print_r($this->input->post());die('test');
			if($this->input->post('login')){
				$response = $this->user_details->login();
				if(!$response){
					$this->session->set_flashdata('error', '<div class="alert alert-warning display-hide"><span>Invalid email and/or Password.</span></div> ');				
					
					//$this->session->set_flashdata('error', '<div class="alert alert-error display-hide"><span>Invalid email and/or Password.</span></div> ');				
					redirect("user/login");	
				}else{
								
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Successfully <strong></strong>has been logout.</span></div> ');				
					redirect("user/login");	}
			}else{
				$this->login();
			}
			
		}
		/****
		EDIT REGISTRATION/ACCOUNT DETAIL
		****/
		public function account_detail()
		{	
			$user_session = $this->session->userdata('user_cart');
			$user_session_details = unserialize($user_session);
			$user_ids=$user_session_details['id'];
		
			$this->db->where('id',$user_ids);
			$this->db->select('*'); 
			$query = $this->db->get($this->_table_names);
			$user	=	$query->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('user/account_detail', $user);
			$this->load->view('templates/footer', $data);

		}
		
		/****
		CHANGE PASSWORD
		****/
		public function change_password()
		{
			$this->user_details->loggedin() == true || redirect("user/change_password");
			$user_session = $this->session->userdata('user_cart');
			$user_session_details = unserialize($user_session);
			
			$user_ids=$user_session_details['id'];
			$this->db->where('id',$user_ids);
			$this->db->select('*'); 
			$query = $this->db->get($this->_table_names);
			$user	=	$query->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('user/change_password', $user);
			$this->load->view('templates/footer', $data);

		}
		
		
		/****
		CONFIRM PASSWORD
		****/
		public function confirm(){
			
			if($this->input->post('confirm_password')){
				$response = $this->user_details->confirm_password();
				if($response){
					$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Successfully <strong></strong>Chnaged.</span></div> ');				
					redirect("user/change_password");			
				}else{
					$this->session->set_flashdata('error', '<div class="alert alert-error display-hide"><span>Password not match.</span></div> ');				
					redirect("user/change_password");			
				}
			}else{
				$this->login();
			}
			
		}
		/****
		LOGOUT
		****/
        public function logout() {
			$this->session->unset_userdata('user_cart');
	
			if($this->user_details->loggedin()) {
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Successfully <strong></strong>has been logout.</span></div> ');				
				redirect("user/login");		
				
			}else{
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Successfully <strong></strong>has been logout.</span></div> ');				
				redirect("user/login");		
			}
		
		
		}
		
		/****
		ORDER DETAIL
		****/
			public function order_detail()
		{
		
			$user_order= $this->session->userdata('user_cart');
			$user_order_details = unserialize($user_order);
			
			$user_ids=$user_order_details['id'];
			$user_email=$user_order_details['email'];
			
			$this->db->join('order_event_details', 'order_event_details.order_id = "'.$user_ids.'"');
			$this->db->join('event_master', 'event_master.id = order_event_details.event_id');
			
			$this->db->where('email',$user_email);
			$this->db->select('*'); 
			$query = $this->db->get($this->_table_order);
			$order	=	$query->row_array();
			
			
			$this->load->view('templates/header', $data);
			$this->load->view('user/order_detail', $order);
			$this->load->view('templates/footer', $data);

		}
		// My event
		public function my_event($event_id=null){
			$this->check_login();
			$data['event_id']	=	$event_id;
			$this->load->view('templates/header', $data);
			$this->load->view('user/my_event', $order);
			$this->load->view('templates/footer', $data);
		}
		// My event
		public function invitation(){
			$this->check_login();
			$user_order= $this->session->userdata('user_cart');
			$user_order_details = unserialize($user_order);
			//print_r($this->input->post());die('test');
			if($this->input->post('send')){
				$code					 = rand(1000000,100000000);
				$event_id				 = $this->input->post('event_id');
				$email           		 = $this->input->post('email');
				$user_id           		 = $user_order_details['id'];
				$response = $this->user_details->invitation_event(array(
				'code'					=> $code ,
				'event_id'					=> $event_id ,
				'user_id'				=> $user_id ,
				'invite_email'				=> $email ,
				'created_date'					=> date('Y-m-d H:i:s')
				 ));
				
				 if($response){
					 $this->load->helper('email');
					//load email library
					$this->load->library('email');
						$this->email->from($email , 'Namesmile');
					  $this->email->to($email); 
					  $this->email->subject('Runnable CodeIgniter Email Example');
					  $this->email->message('Hello from Runnable CodeIgniter Email Example App!');  
					  // print_r($this->email->send());die('test');
					  // try send mail ant if not able print debug
					  if ( ! $this->email->send())
					  {
						echo $data['message'] ="Email not sent \n".$this->email->print_debugger();      
						//$this->load->view('header');
						//$this->load->view('message',$data);
						//$this->load->view('footer');

					  }else{
						   echo $data['message'] ="Email was successfully sent to $email";
					  }
				 }
			}else{
				redirect("user/my_event");	
			}
		}
		
		// Check login
		
		public function check_login(){
			$arr_url = explode('/',uri_string());
			$exception_uris  = array('login'); 
			
			if(!(in_array('login',$arr_url))){
					if(in_array(uri_string(), $exception_uris) == FALSE) {	//die('test');
						if($this->user_details->loggedin() == FALSE)
							redirect('user/login');
					}
				}
		} 
		
		
}