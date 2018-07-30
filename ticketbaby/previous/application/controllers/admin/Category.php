<?php
class Category extends CI_Controller {

        public function __construct()
        {
                parent::__construct();

                $this->load->library("adminauthex");

                if( ! $this->adminauthex->logged_in())
                {
                    redirect('admin', 'admin/login');
                    exit;
                }

                $this->load->model('category_model');              
        }

        public function index()
        {  
                if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
                         #CodeIgniter's input class to get all post values
                        $formValues = $this->input->post(NULL, TRUE);  
                        $RESPONSE   = $this->category_model->createCategory ($formValues);
                        $this->session->set_flashdata('flash_server_response', $RESPONSE);
                        redirect(base_url() . "index.php/admin/category/");
                }

                $data['title'] = 'Categories archive';

                #CodeIgniter's input class to get all post values
                #$formValues = $this->input->post(NULL, TRUE);
                #Returning views as data
                #$string = $this->load->view('myfile', '', true);

                $this->load->library('pagination');
                $config['base_url']     =       base_url() .  ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "")  . '/admin/category/';

                $config['total_rows']   =       $this->category_model->record_count();
                $config['per_page']     =       10;
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

                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

                $data['categories'] = $this->category_model->get_categories(FALSE,$config["per_page"],$page);

                $data['pagination_link'] = $this->pagination->create_links();

                $data['page_start'] = $page;

                $category_tree = array();
                $this->category_model->get_category_tree($category_tree, 0, 0);
                $data['category_tree'] = $category_tree;


                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/category/index', $data);
                $this->load->view('templates/admin/footer');
        }

        public function edit()
        {
                $cat_id     = ($this->input->get('cat_id')) ? $this->input->get('cat_id') : 0;
                $page_start = ($this->input->get('page_start')) ? $this->input->get('page_start') : 0;

                if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
                         #CodeIgniter's input class to get all post values
                        $formValues = $this->input->post(NULL, TRUE);  
                        $RESPONSE   = $this->category_model->updateCategory ($formValues);
                        $this->session->set_flashdata('flash_server_response', $RESPONSE);
                        redirect(base_url() . "index.php/admin/category/" . $page_start);
                }

                if ( !isset($cat_id) || $cat_id < 1 ) {
                    redirect(base_url() . "index.php/admin/category/");
                }
          
                $data['title']      = 'Edit Category';
                $data['cat_id']     = $cat_id;
                $data['page_start'] = $page_start;
                $data['category_details']       =  $this->category_model->get_category_by_id ($cat_id);

                if ( !isset($data['category_details']) || sizeof($data['category_details']) < 1 ) {
                    redirect(base_url() . "index.php/admin/category/");
                }

                $category_tree = array();
                $this->category_model->get_category_tree($category_tree, 0, 0);
                $data['category_tree'] = $category_tree;

                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/category/edit', $data);
                $this->load->view('templates/admin/footer');
        }

 
}