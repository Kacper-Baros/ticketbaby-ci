<?php
class Login extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model(array('admin_model','user_model','event_model','order_model','user_details'));
                $this->load->library("adminauthex");
        }

        public function index()
		{		
			$admin_session = $this->session->userdata('admin_session');
			$data['total_users'] = $this->user_details->get_total_user_count();
			$data['total_events'] = $this->event_model->record_count();
			$data['total_orders'] = $this->order_model->record_count();
			$data['get_recent_user_created_time'] = $this->user_details->get_recentmost_user_created_time();
			$data['get_recent_event_created_time'] = $this->event_model->get_recentmost_event_created_time();
			$data['get_recent_order_created_time'] = $this->order_model->get_recentmost_order_created_time();
			/*echo "<pre>";
			print_r($data['get_recent_order_created_time']);
			
			die;*/
			
			if( isset($admin_session) && !empty($admin_session) )	{ 
				$admin_session = $this->session->userdata('admin_session');	

				if( isset($admin_session) && !empty($admin_session) )	{ 

					$data['title']    = 'Dashboard';
			        $data['username'] = $admin_session['username'];

			        $this->load->view('templates/admin/header', $data);
			        $this->load->view('admin/dashboard', $data);
			        $this->load->view('templates/admin/footer');
				} else {
					redirect('admin', 'admin/login');
				}	
			} else {

				$this->load->helper(array('form'));

				//This method will have the credentials validation
				$this->load->library('form_validation');
						
				$this->form_validation->set_rules('username', 'User Name', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

				$data['title'] = 'Ticket Baby - Administrator Panel Login';

				if ($this->form_validation->run() === FALSE) {
					 //Field validation failed.  User redirected to login page
					$this->load->view('admin/login', $data);
				} else {
					redirect('admin/', 'refresh');
				}
			}	
		}

		public function check_database($password)
		{
			//Field validation succeeded.  Validate against database
			$username = $this->input->post('username');

			if ( $this->adminauthex->login($username, $password) ) {
				//
			}else{
				$this->form_validation->set_message('check_database', 'Invalid username or password');
			}
		}

}