<?php
class Event extends CI_Controller {

        public function __construct()
        {
                parent::__construct();

                $this->load->library("adminauthex");

                if( ! $this->adminauthex->logged_in())
                {
                    redirect('admin', 'admin/login');
                    exit;
                }

                $this->load->model('event_model');
        }

        public function index()
        {   

                $data['title'] = 'Event archive';

                #CodeIgniter's input class to get all post values
                #$formValues = $this->input->post(NULL, TRUE);
                #Returning views as data
                #$string = $this->load->view('myfile', '', true);

                $this->load->library('pagination');
                $config['base_url']     =       base_url() .  ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "")  . '/admin/event/';

                $config['total_rows']   =       $this->event_model->record_count();
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

                $data['events'] = $this->event_model->get_events($config["per_page"],$page);

                $data['pagination_link'] = $this->pagination->create_links();

                $data['page_start'] = $page;

                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/event/index', $data);
                $this->load->view('templates/admin/footer');
        }

        public function edit()
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
                        $data['event_additional_charge']    =  $this->event_model->get_additional_charge_by_id ($event_id);

                        if ( !isset($data['event_details']) || sizeof($data['event_details']) < 1 ) {
                                redirect(base_url() . "index.php/admin/event/");
                        }
                }


                $this->load->model('category_model');
                $category_tree = array();
                $this->category_model->get_category_tree($category_tree, 0, 0);
                $data['category_tree'] = $category_tree;
          

                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/event/edit', $data);
                $this->load->view('templates/admin/footer');
        }


        public function promote() {

                $id               = ($this->input->get('id')) ? $this->input->get('id') : 0;
                $per_page         = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

              
                if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
                         #CodeIgniter's input class to get all post values
                        $formValues = $this->input->post(NULL, TRUE);  
                        $RESPONSE   = $this->event_model->createUpdatePromoteEvent ($formValues);
                        $this->session->set_flashdata('flash_server_response', $RESPONSE);
                        if ( $RESPONSE["success"] == false ) {
                            $this->session->set_flashdata('flash_client_request', $formValues);
                        }               
                        redirect(base_url() . "index.php/admin/event/promote?" . "per_page=" . $per_page);
                }


                if ( $id > 0 ) {
                    $formValues   = $this->event_model->get_promote_event_by_id($id);
                    $this->session->set_flashdata('flash_client_request', $formValues);
                }

                $data['title'] = 'Promote event';

                #CodeIgniter's input class to get all post values
                #$formValues = $this->input->post(NULL, TRUE);
                #Returning views as data
                #$string = $this->load->view('myfile', '', true);

                $this->load->library('pagination');
                $config['base_url']     =       base_url() .  ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "")  . '/admin/event/promote';

                $config['total_rows']   =       $this->event_model->promote_event_record_count();
                $config['per_page']     =       10;
                $config["uri_segment"]  =       3;     
                $config['page_query_string'] = TRUE;        

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

                $data['promote_event_lists'] = $this->event_model->get_promote_events($config["per_page"],$per_page);

                $data['pagination_link'] = $this->pagination->create_links();


                $data['id']               = $id;
                $data['per_page']         = $per_page;



                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/event/promote', $data);
                $this->load->view('templates/admin/footer');

        }



        public function promote_delete()
        {
                $id                     = ($this->input->get('id')) ? $this->input->get('id') : 0;
                $per_page               = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

                if ( $id > 0 ) {
                    $RESPONSE   = $this->event_model->deletePromoteEvent($id);
                    $this->session->set_flashdata('flash_server_response', $RESPONSE);
                }

                redirect(base_url() . "index.php/admin/event/promote");
        }

}