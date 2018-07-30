<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
		protected $_table_name = 'user_details';
		protected $_table_names = 'user_master';
		protected $_table_order = 'order_master';
		
        public function __construct()
        {
                parent::__construct();
				
				$this->load->model('order_model');
		        $this->load->model('user_details');
		        $this->load->model('event_model');
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
			 $first_name  		= $this->input->post('first_name'); 
			 $email  			= $this->input->post('email'); 
			 $password		 	= $this->input->post('password');
				
				$data=array(
				'first_name'  		=> $first_name, 
				'email'  			=> $email, 
				'password' 			=> $password
				);
				//print_r($data);die('test');
			$this->user_details->loggedin() == FALSE || redirect("cart/home");
			$this->load->view('templates/header', $data);
			$this->load->view('user/registration', $data);
			$this->load->view('templates/footer', $data);
		}
		
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
						redirect("user/login");			
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
			$query = $this->db->get($this->_table_name);
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
			$query = $this->db->get($this->_table_name);
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
					$this->session->set_flashdata('error', '<div class="alert alert-warning display-hide"><span>Password not match.</span></div> ');				
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
		
			$data['orders'] = $this->order_model->get_orders_detail($user_email);
			$data['details']       =  $this->order_model->get_order_by_email($user_ids,$user_email);
						//print_r($data['details']);die;

			if ( !isset($data['details']) || sizeof($data['details']) < 1 ) {
				   redirect(base_url() . "index.php/user/order_detail/");
			}
		
			$this->load->view('templates/header', $data);
			$this->load->view('user/order_detail', $data);
			$this->load->view('templates/footer', $data);

		}
		
		/***USER ORDERS DDETAILS **/
		
		public function order_edit($id)
		{
			
			$user_order= $this->session->userdata('user_cart');
			$user_order_details = unserialize($user_order);
				
			$user_ids=$user_order_details['id'];
			$user_email=$user_order_details['email'];
			
			//$data['orders'] = $this->order_model->get_orders_detail($user_ids);
		
			$order_id         = ($this->input->get('order_id')) ? $this->input->get('order_id') : 0;
			
			$page_start       = ($this->input->get('page_start')) ? $this->input->get('page_start') : 0;
			$data['title']      = 'Order Details'; 
			$data['order_id']   = $order_id;   
			$data['page_start'] = $page_start;
			
			$data['orders'] 		  = $this->order_model->get_orders_detail($user_email);
			$data['order_edit']       =  $this->order_model->get_order_edit_id($order_id);
			//print_r($data['order_edit']);die;
			
			if ( !isset($data['order_edit']) || sizeof($data['order_edit']) < 1 ) {
				   redirect(base_url() . "index.php/user/order_detail/");
			}
			//print_r( $data['order_edit']);die;
			$this->load->view('templates/header', $data);
			$this->load->view('user/order_edit', $data);
			$this->load->view('templates/footer', $data);

		}
		
		/***USER EVENT DDETAILS OF ORDERS**
		
		public function event_edit()
		{
			
			 $event_id     = ($this->input->get('id')) ? $this->input->get('id') : 0;
                $page_start   = ($this->input->get('page_start')) ? $this->input->get('page_start') : 0;


                if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
                         #CodeIgniter's input class to get all post values
                        $formValues = $this->input->post(NULL, TRUE);  
                        $RESPONSE   = $this->event_model->createUpdateEvent ($formValues);
                        $this->session->set_flashdata('flash_server_response', $RESPONSE);
                        redirect(base_url() . "index.php/admin/event/" . $page_start);
                }


                if ( !isset($event_id) || $event_id < 1 ) {
                        $data['title']      = 'Add Event';
                }else{
                        $data['title']      = 'Edit Event'; 
                        $data['event_id']   = $event_id;  
                        $data['page_start'] = $page_start;

                        $data['event_details']              =  $this->event_model->get_event_by_id ($event_id);
						//print_r($data['event_details'] ); die('test');
                        $data['event_additional_charge']    =  $this->event_model->get_additional_charge_by_id ($event_id);

                        if ( !isset($data['event_details']) || sizeof($data['event_details']) < 1 ) {
                                redirect(base_url() . "index.php/admin/event/");
                        }
                }


                $this->load->model('category_model');
                $category_tree = array();
                $this->category_model->get_category_tree($category_tree, 0, 0);
                $data['category_tree'] = $category_tree;
          

                
			$this->load->view('templates/header', $data);
			$this->load->view('user/event_edit', $data);
			$this->load->view('templates/footer', $data);

		}*/
		
		// My event
		public function my_event($event_id=null){
			$this->check_login();
			$data['event_id']		= $event_id;
			$user_order				= $this->session->userdata('user_cart');
			$user_order_details 	= unserialize($user_order);
			$user_id            	= $user_order_details['id'];
			$total	                = 5;
			$per_page              	= $this->input->get("per_page");//start
			
			if(isset($per_page))
			$start = $per_page;
		
     		else
			$start = 0;
			$url 	        				=	 base_url() .  ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "")  . "user/my_event";
			$config['base_url']             =    $url;
			$data['url']					=	 $url;
			$config['total_rows']		    =    $this->user_details->user_all_event($user_id);
			$config['per_page'] 		 	=	 $total;
			$config['uri_segment']  		= 	 3;		
			$config['page_query_string']    =    TRUE;  
			//pagination
			
			$this->load->library('pagination');
			$this->config->load('pagination', TRUE);
			
			$this->pagination->initialize($config);
			
			$all_event = $this->user_details->user_all_event($user_id,$total,$start);
			$data['all_event']	=	$all_event;
			
			$this->load->view('templates/header', $data);
			$this->load->view('user/my_event', $order);
			$this->load->view('templates/footer', $data);
		}
		// My event
		public function invitation(){
		//die;
			$this->check_login();
			$user_order= $this->session->userdata('user_cart');
			$user_order_details = unserialize($user_order);
			
			
			if($this->input->post('send')){
				 $event_id	=	$this->input->post('event_id');
				 if($event_id){
					 $event_details	=	$this->user_details->get_user_event($event_id);	
					//print_r($event_details);die;
					 $code					 = time().rand(1000000,100000000);
					 
					 $email           	 = $this->input->post('email');
					 $user_id            = $user_order_details['id'];
					
					$response = $this->user_details->invitation_event(array(
					'code'						=> $code ,
					'event_id'					=> $event_id ,
					'user_id'					=> $user_id ,
					'invite_email'				=> $email ,
					'created_date'				=> date('Y-m-d H:i:s')
					 ));
					$start_date	=	date('M d, Y',strtotime($event_details['start_date']));
					$end_date	=	date('M d, Y',strtotime($event_details['end_date']));
					$title	=	ucwords($event_details['title']);
					$href	=	base_url()."index.php/user/attend/";
					$href	.=  base64_encode($email)."/";
					$href	.=  base64_encode($code)."/";
					$href	.=  base64_encode($event_id)."/";
					$href	.=  base64_encode($user_id)."/";
				
				if($response){
					  $this->load->library('email');
					  $this->email->from('boxer.sprighttech01@gmail.com' , 'Ticket baby');
					  $this->email->to($email); 
					  $this->email->subject("You're invited to {$title} ({$start_date} - {$end_date}) ");
					  
					  
					  $data['href']				=	$href;
					  $data['event_details']	=	$event_details;
					  

					  $html_email = $this->load->view('user/email_invite', $data, true);	
					  
					 
					 
						$this->email->message($html_email);
					 
					  // try send mail ant if not able print debug
					  $this->email->set_mailtype("html");	
					  if ( ! $this->email->send())
					  {
					   $this->session->set_flashdata('error', '<div class="alert alert-warning display-hide"><span>Email <strong></strong>Not send to your email "'.$email.'" please try again </span></div> ');
						echo $data['message'] ="Email not sent \n".$this->email->print_debugger();      
						//$this->load->view('header');
						//$this->load->view('message',$data);
						//$this->load->view('footer');

					  }else{ 
					  $this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Successfully <strong></strong>send your email to "'.$email.'"</span></div> ');
						  // echo $data['message'] ="Email was successfully sent to $email";
					  redirect("user/my_event/{$event_id}");
					  }
				 }
				}else{
					redirect("user/my_event");	
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
		
		//
		public function attend($email,$code,$event_id,$user_id){
			$email				=	base64_decode($email);
			$code				=	base64_decode($code);
			$event_id			=	base64_decode($event_id);
			$user_id			=	base64_decode($user_id);
			$data['email']		=	$email;
			$data['code']		=	$code;
			$data['event_id']	=	$event_id;
			$data['user_id']	=	$user_id;
			
			$get_url_attend_event	=	$this->user_details->get_url_attend_event($data);
			if($get_url_attend_event){
				$res	=	$this->user_details->attend_event($data);
				$event_details	=	$this->user_details->get_user_event($event_id);	
				$data['event_details']		=	$event_details;	
				if($res){
					$data['yes']		=	1;
					 $this->session->set_flashdata('success', "<div class='alert alert-success display-hide'><span>You're going to this event!</span></div> ");
				}else{
					 $this->session->set_flashdata('error', '<div class="alert alert-warning display-hide"><span>Wrong path</span></div> ');
						
				}
			}else{	$data['yes']	=	0;
					 $this->session->set_flashdata('error', '<div class="alert alert-warning display-hide"><span>This event is currently unavailable. </span></div> ');
						
				}
			
			$this->load->view('templates/header', $data);
			$this->load->view('user/attend', $data);
			$this->load->view('templates/footer', $data);
		}
		
		// My event
		public function accept($event_id=null){
			
			$this->check_login();
			$data['event_id']	=	$event_id;
			$user_order= $this->session->userdata('user_cart');
			$user_order_details 	= unserialize($user_order);
			$user_id            	= $user_order_details['id'];
			//
			$total	=	10;
			$per_page              	= $this->input->get("per_page");//start
			
			if(isset($per_page))
				$start = $per_page;
			else
				$start = 0;
			$url 					=	 base_url() .  ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "")  . "user/accept";
			$config['base_url']     =    $url."/{$event_id}";
			$data['url']			=	 $url;
			$config['total_rows']   =    $this->user_details->accept_request($user_id,$event_id);
			$config['per_page'] 	= 	 $total;
			$config['uri_segment']  = 	 3;		
			$config['page_query_string']    =   TRUE;  
			//pagination
			
			$this->load->library('pagination');
			$this->config->load('pagination', TRUE);
			
			$this->pagination->initialize($config);
			$all_event = $this->user_details->accept_request($user_id,$event_id,$total,$start);
			$data['all_event']	=	$all_event;
			
			//
			
			
				
			
			$this->load->view('templates/header', $data);
			$this->load->view('user/accept', $order);
			$this->load->view('templates/footer', $data);
		}
		
}