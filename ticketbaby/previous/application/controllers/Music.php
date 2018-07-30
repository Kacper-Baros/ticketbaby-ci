<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Music extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
				 
				
                $this->load->model('music_model');
				$this->load->model('event_model');	
				$this->load->model('category_model');	
        }
			
        public function index()
        {
			 echo  redirect(base_url()); // todo
        
		
		}
		
		  
        public function view($slug = 'music')
        {	
			$slug;
			$siteKey                         	= $this->config->item('recaptcha_site_key');
			
			
			
			$data_catge							= $this->category_model->get_categories($slug);
			//print_r($data_catge);die;
			
			
			$this->load->helper('text');
			
			$data['s'] 	='club nite';
			
			$total	=	10;
			$category_all			=	$this->category_model->get_category_search();
			$data['category_all']	=	$category_all;
			$slugs	=	$slug;

			if($slug=='music'){
				$cat_id					=	$this->input->get("category_id");
				$data_catge				=	$this->category_model->get_category_by_id($cat_id);
				$start_date				=	$this->input->get("start_date");
				$end_date				=	$this->input->get("end_date");
				$city					=	$this->input->get("city");
				$slug					=	'';
				$data['start_date']		=	$start_date;
				$data['end_date']		=	$end_date;
				$data['city']			=	$city;
				$slugs					=	'music';
				
			}
		
			
			$per_page              	=   $this->input->get("per_page");//start
			
			if(isset($per_page))
				$start = $per_page;
			else
				$start = 0;
			$url 	=	 base_url() .  ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "")  . "music/{$slugs}?category_id={$cat_id}";
			
			$url	.=	"&start_date={$start_date}";
			$url	.=	"&end_date={$end_date}";
			$url	.=	"&city={$city}";
			$config['base_url']     =    $url;
			$data['url']	=	$url;
			$config['total_rows']   =       $this->music_model->get_event($slug,$cat_id,$start_date,$end_date,$city);

			//$config['total_rows'] 	=	100;
			$config['per_page'] 	= $total;
			$config['uri_segment']  = 3;		
			$config['page_query_string']    =   TRUE;  
			//pagination
			
			$this->load->library('pagination');
			$this->config->load('pagination', TRUE);
			//$config = $this->config->item('pagination');
				
			
			$this->pagination->initialize($config);
			
			$response_detail = $this->music_model->get_event($slug,$cat_id,$start_date,$end_date,$city,$total,$start);
			//print_r($response_detail);die();
			$data['show_left_panel_cart'] 	= 'TRUE';
			$data['current_view'] 			= 'HOME';

			$data['home_page_event_list'] 	= $response_detail;
			$data['cate_url']				=	$cate_url;
			
			 
			$data['data_catge']				=	$data_catge;
			$this->load->model('category_model');
			$category_tree = array();
			$this->category_model->get_category_tree($category_tree, 0, 0);
			$data['category_tree'] 		= 	$category_tree;
			$datas						=	$data['category_tree'];
		
			$this->load->view('templates/header', $data);
			$this->load->view('music/page', $datas);
			$this->load->view('templates/footer', $data);	
				
				
        }
		
		
		// Search event method start
		public function callpage()
		{
			$this->load->model('category_model');
			$this->load->helper('text');
			
			$data['s'] 	='club nite';
			
			$total	=	5;
			$category_all	=	$this->category_model->get_category_search();
			$data['category_all']	=	$category_all;
			
			$cat_id					=	$this->input->get("cat_id");
			$country				=	$this->input->get("country");
			$day					=	$this->input->get("day");
			$data['cat_id']			=	$cat_id;
			$data['day']			=	$day;
			$data['country']		=	$country;
			$per_page              	=   $this->input->get("per_page");//start
			
			if(isset($per_page))
				$start = $per_page;
			else
				$start = 0;
			$cate_url 	=	 base_url() .  ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "")  . "music/callpage?q={$s}&result=Search";
			
			$url 	=	 base_url() .  ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "")  . "music/callpage?q={$s}&result=Search&cat_id={$cat_id}";
			$config['base_url']     =    $url."&day={$day}";
			$data['url']	=	$url;
			$config['total_rows']   =       $this->music_model->search_get_events($cat_id,$country,$day);

			//$config['total_rows'] 	=	100;
			$config['per_page'] 	= $total;
			$config['uri_segment']  = 3;		
			$config['page_query_string']    =   TRUE;  
			//pagination
			
			$this->load->library('pagination');
			$this->config->load('pagination', TRUE);
			//$config = $this->config->item('pagination');
				
			
			$this->pagination->initialize($config);
			
			$response_detail = $this->music_model->search_get_events($cat_id,$country,$day,$total,$start);
			//print_r($response_detail);die('test');	
			$data['show_left_panel_cart'] 	= 'TRUE';
			$data['current_view'] 			= 'HOME';

			$data['home_page_event_list'] 	= $response_detail;
			$data['cate_url']				=	$cate_url;
			
			$this->load->model('category_model');
			$category_tree = array();
			$this->category_model->get_category_tree($category_tree, 0, 0);
			$data['category_tree'] = 	$category_tree;
			$datas				   =	$data['category_tree'];
			
			$this->load->view('templates/header', $data);
			$this->load->view('music/callpage', $datas);
			$this->load->view('templates/footer', $data);	
		}
		
}