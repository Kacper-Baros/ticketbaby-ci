<?php
class User extends CI_Controller {

        public function __construct()
        {
                parent::__construct();

                $this->load->library("adminauthex");

                if( ! $this->adminauthex->logged_in())
                {
                    redirect('admin', 'admin/login');
                    exit;
                }

                
                $this->load->model('user_model');
        }

        public function index()
        {   

                $data['title'] = 'User archive';

                #CodeIgniter's input class to get all post values
                #$formValues = $this->input->post(NULL, TRUE);
                #Returning views as data
                #$string = $this->load->view('myfile', '', true);
				
				
				
					
				$q			=	$this->input->get('q');
				$data['q']	=	$q;
                $this->load->library('pagination');
				
				if ($this->uri->segment(3) !="") {
					$config['per_page'] = $this->uri->segment(3);
				} else {
					$config['per_page']     =       10;
				}
                $url					=	 base_url() .  ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "")  . '/admin/user';
				$url					.=    '/'.$config['per_page']."/?q={$q}";
				$config['base_url']     =       $url;
				$config['page_query_string']    =   TRUE;  
                $config['total_rows']   =       $this->user_model->record_count($q);
					
					
                $config["uri_segment"]  =       3;             

                $config['full_tag_open'] = "<ul class='pagination'>";
                $config['full_tag_close'] ="</ul>";
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
                $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
                $config['next_tag_open'] = "<li>";
                $config['next_tagl_close'] = "</li>";
                $config['prev_tag_open'] = "<li>";
                $config['prev_tagl_close'] = "</li>";
                $config['first_tag_open'] = "<li>";
                $config['first_tagl_close'] = "</li>";
                $config['last_tag_open'] = "<li>";
                $config['last_tagl_close'] = "</li>";

                $this->pagination->initialize($config);

                //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				$per_page              	=   $this->input->get("per_page");//start
			
				if(isset($per_page))
					$page = $per_page;
				else
					$page = 0;
					
					
				
					
                $data['users'] = $this->user_model->get_users(FALSE,$config["per_page"],$page,$q);

                $data['pagination_link'] = $this->pagination->create_links();

                $data['page_start'] = $page;

                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/user/index', $data);
                $this->load->view('templates/admin/footer');
        }
		
		
		// Download USER DETAILS Csv
		public function export(){
			$formValues = $this->input->post(NULL, TRUE); 			
			$RESPONSE   = $this->user_model->exportuserData($formValues);
			
			
			
		}

        public function edit()
        {
                $user_id        = ($this->input->get('id')) ? $this->input->get('id') : 0;
                $page_start     = ($this->input->get('page_start')) ? $this->input->get('page_start') : 0;

                if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
                         #CodeIgniter's input class to get all post values
                        $RESPONSE   = $this->user_model->createUpdateUser ();
                        $this->session->set_flashdata('flash_server_response', $RESPONSE);
                        redirect(base_url() . "index.php/admin/user/" . $page_start);
                }

                if ( !isset($user_id) || $user_id < 1 ) {
                        $data['title']      = 'Add User';
                }else{
                        $data['title']      = 'Edit User'; 
                        $data['user_id']    = $user_id;   
                        $data['page_start'] = $page_start;

                        $data['user_details']       =  $this->user_model->get_user_by_id ($user_id);

                        if ( !isset($data['user_details']) || sizeof($data['user_details']) < 1 ) {die('test');
                                redirect(base_url() . "index.php/admin/user/");
                        }
                }       

                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/user/edit', $data);
                $this->load->view('templates/admin/footer');
        }

}