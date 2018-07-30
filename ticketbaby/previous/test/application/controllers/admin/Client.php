<?php
class Client extends CI_Controller {

        public function __construct()
        {
                parent::__construct();

                $this->load->library("adminauthex");
				
                if( ! $this->adminauthex->logged_in())
                {
                    redirect('admin', 'admin/login');
                    exit;
                }
	
                
                $this->load->model('user_details');
        }

        public function index()
        {  

                $data['title'] = 'Client archive';
				$data['active']	=	'active';
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
				
                $url					=	 base_url() .  ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "")  . '/admin/client';
				$url					.=    '/'.$config['per_page']."/?q={$q}";
				$config['base_url']     =       $url;
				$config['page_query_string']    =   TRUE;  
                $config['total_rows']   =       $this->user_details->record_count($q);
               // $config['per_page']     =       10;
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
                $data['users'] = $this->user_details->get_users(FALSE,$config["per_page"],$page,$q);

                $data['pagination_link'] = $this->pagination->create_links();

                $data['page_start'] = $page;

                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/client/index', $data);
                $this->load->view('templates/admin/footer');
        }

        public function edit()
        {
                $user_id        = ($this->input->get('id')) ? $this->input->get('id') : 0;
                $page_start     = ($this->input->get('page_start')) ? $this->input->get('page_start') : 0;
				
                if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
                         #CodeIgniter's input class to get all post values
                        $formValues = $this->input->post(NULL, TRUE);  
                        $email	=	$formValues['email'];
						
						$res	=	$this->user_details->check_email_available($email,$user_id);
						if($res){
							$array["error"] = true;
							$array["message"] = "Email already exists! Please choose another email.";	
							
							$this->session->set_flashdata('flash_server_response', $array);
							if($user_id)
								redirect(base_url() . "index.php/admin/client/edit?id={$user_id}&page_start=" . $page_start);
							else
								redirect(base_url() . "index.php/admin/client/edit?&page_start=" . $page_start);
						
						}else{
							$RESPONSE   = $this->user_details->createUpdateUser ($formValues);
							$this->session->set_flashdata('flash_server_response', $RESPONSE);
						   
							redirect(base_url() . "index.php/admin/client/" . $page_start);
						}
							
						
                }

                if ( !isset($user_id) || $user_id < 1 ) {
                        $data['title']      = 'Add Client';
                }else{
                        $data['title']      = 'Edit Client'; 
                        $data['user_id']    = $user_id;   
                        $data['page_start'] = $page_start;

                        $data['user_details']       =  $this->user_details->get_user_by_id ($user_id);

                        if ( !isset($data['user_details']) || sizeof($data['user_details']) < 1 ) {
                                redirect(base_url() . "index.php/admin/client/");
                        }
                }       

                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/client/edit', $data);
                $this->load->view('templates/admin/footer');
        }
		// Download Csv
		public function download_csv(){
			$formValues = $this->input->post(NULL, TRUE); 			
			$RESPONSE   = $this->user_details->export_data($formValues);
			redirect(base_url() . "index.php/admin/client/");
			
		}
		// Import Csv
		public function import_csv(){
			$response	=	$this->user_details->import_csv_data();
			$this->session->set_flashdata('flash_server_response', $response);
			redirect(base_url() . "index.php/admin/client/" . $page_start);
		}
		
		public function invite()
		{
			 $user_id        = ($this->input->get('id')) ? $this->input->get('id') : 0;
             $page_start     = ($this->input->get('page_start')) ? $this->input->get('page_start') : 0;
             $name    		 = 'invite';
			if($name){
					 $user_id	=	$user_id;
					 $event_id  =   0 ;
				 if($user_id){
					 $event_details	=	$this->user_details->get_user_detail($user_id);	
					print_r($event_details);die;
					 $code					 = time().rand(1000000,100000000);
					 
				 	 $email           	 = $event_details['email'];
					 $user_id            = $user_id;
					
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
					}else{ 
					  $this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Successfully <strong></strong>send your email to "'.$email.'"</span></div> ');
						  // echo $data['message'] ="Email was successfully sent to $email";
					  redirect("admin/client/");
					  }
				 }
				}else{
					redirect("admin/client/");
				} 
			}else{
				redirect("admin/client/");	
			}
				$this->load->view('templates/admin/header', $data);
                $this->load->view('admin/client/invite', $data);
                $this->load->view('templates/admin/footer');
		}
		

}