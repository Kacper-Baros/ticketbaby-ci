<?php
class Order extends CI_Controller {

        public function __construct()
        {
                parent::__construct();

                $this->load->library("adminauthex");

                if( ! $this->adminauthex->logged_in())
                {
                    redirect('admin', 'admin/login');
                    exit;
                }
                
                $this->load->model('order_model');
        }

        public function index()
        {   

                $data['title'] = 'Order archive';

                #CodeIgniter's input class to get all post values
                #$formValues = $this->input->post(NULL, TRUE);
                #Returning views as data
                #$string = $this->load->view('myfile', '', true);
				$category_id	=	$this->input->get('category_id');
				$to_date		=	$this->input->get('to');
				$from_date		=	$this->input->get('from');
				$event_name		=	$this->input->get('event_name');
				$data['category_id']	=	$category_id;
				$data['to']				=	$to_date;
				$data['from']			=	$from_date;
				$data['event_name']		=	$event_name;
				$this->load->library('pagination');
                $url					=	 base_url() .  ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "")  . '/admin/order';
				$url					.=    "?category_id={$category_id}";
				$url					.=    "&to={$to_date}";
				$url					.=    "&from={$from_date}";
				$url					.=    "&event_name={$event_name}";
				$config['base_url']     =      $url;

                $config['total_rows']   =       $this->order_model->record_count($category_id,$to_date,$from_date,$event_name);
                $config['per_page']     =       10;
                $config["uri_segment"]  =       3;             
				$config['page_query_string']    =   TRUE;  
				//print_r($this->input->get());//die('test');
				
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
				$per_page              	=   $this->input->get("per_page");//start
			
				if(isset($per_page))
					$page = $per_page;
				else
					$page = 0;
                //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				//admin name 
				$admin_session 	= 	$this->session->userdata('admin_session');
				$admin_id		=	$admin_session['id'];
				
                $data['orders'] = $this->order_model->get_orders(FALSE,$config["per_page"],$page,$category_id,$to_date,$from_date,$event_name,$admin_id);
			//	print_r($data['orders']);die('test');
                $data['pagination_link'] = $this->pagination->create_links();

                $data['page_start'] = $page;
					
				//
				 $this->load->model('category_model');
                $category_tree = array();
                $this->category_model->get_category_tree($category_tree, 0, 0);
                $data['category_tree'] = $category_tree;
				//$data=$data['category_tree'];
				
                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/order/index', $category_tree);
                $this->load->view('templates/admin/footer');
        }
		

        public function edit()
        {
                $order_id         = ($this->input->get('order_id')) ? $this->input->get('order_id') : 0;
                $page_start       = ($this->input->get('page_start')) ? $this->input->get('page_start') : 0;


                
                $data['title']      = 'Order Details'; 
                $data['order_id']   = $order_id;   
                $data['page_start'] = $page_start;

                $data['order_details']       =  $this->order_model->get_order_by_id ($order_id);
				//print_r($data['order_details']);die;
                if ( !isset($data['order_details']) || sizeof($data['order_details']) < 1 ) {
                        redirect(base_url() . "index.php/admin/order/");
                }
                

                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/order/edit', $data);
                $this->load->view('templates/admin/footer');
        }
		
		
		// Download ORDER DETAILS Csv
		public function export(){		
			$RESPONSE   = $this->order_model->exportOrderData();
			echo $RESPONSE;die;
			
		}

}