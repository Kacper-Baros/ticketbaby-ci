<?php
class Ticket extends CI_Controller {

        public function __construct()
        {
                parent::__construct();

                $this->load->library("adminauthex");

                if( ! $this->adminauthex->logged_in())
                {
                    redirect('admin', 'admin/login');
                    exit;
                }

                $this->load->model('ticket_model');              
        }

        public function index()
        {  
                if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
                         #CodeIgniter's input class to get all post values
                        $formValues = $this->input->post(NULL, TRUE);  
                        $RESPONSE   = $this->ticket_model->createTicketClass ($formValues);
                        $this->session->set_flashdata('flash_server_response', $RESPONSE);
                        redirect(base_url() . "index.php/admin/ticket/");
                }

                $data['title'] = 'Categories archive';

                #CodeIgniter's input class to get all post values
                #$formValues = $this->input->post(NULL, TRUE);
                #Returning views as data
                #$string = $this->load->view('myfile', '', true);

                $this->load->library('pagination');
                $config['base_url']     =       base_url() .  ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "")  . '/admin/ticket/';

                $config['total_rows']   =       $this->ticket_model->record_count();
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

                $data['ticket_class_details'] = $this->ticket_model->get_ticket_class(FALSE,$config["per_page"],$page);

                $data['pagination_link'] = $this->pagination->create_links();

                $data['page_start'] = $page;
                
                $data['ticket_section_details'] = $this->ticket_model->get_ticket_section();


                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/ticket/index', $data);
                $this->load->view('templates/admin/footer');
        }

        public function edit()
        {
                $ticket_class_id     = ($this->input->get('id')) ? $this->input->get('id') : 0;
                $page_start = ($this->input->get('page_start')) ? $this->input->get('page_start') : 0;

                if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
                         #CodeIgniter's input class to get all post values
                        $formValues = $this->input->post(NULL, TRUE);  
                        $RESPONSE   = $this->ticket_model->updateTicketClass ($formValues);
                        $this->session->set_flashdata('flash_server_response', $RESPONSE);
                        redirect(base_url() . "index.php/admin/ticket/" . $page_start);
                }

                if ( !isset($ticket_class_id) || $ticket_class_id < 1 ) {
                    redirect(base_url() . "index.php/admin/ticket/");
                }
          
                $data['title']               = 'Edit ticket class';
                $data['ticket_class_id']     = $ticket_class_id;
                $data['page_start']          = $page_start;
                $data['ticket_class_details']    =  $this->ticket_model->get_ticket_class_by_id ($ticket_class_id);

                if ( !isset($data['ticket_class_details']) || sizeof($data['ticket_class_details']) < 1 ) {
                    redirect(base_url() . "index.php/admin/ticket/");
                }

                $data['ticket_section_details'] = $this->ticket_model->get_ticket_section();

                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/ticket/edit', $data);
                $this->load->view('templates/admin/footer');
        }

        public function event() {

                $id                     = ($this->input->get('id')) ? $this->input->get('id') : 0;
                $event_id               = ($this->input->get('event_id')) ? $this->input->get('event_id') : 0;
                $event_page_start       = ($this->input->get('event_page_start')) ? $this->input->get('event_page_start') : 0;
                $per_page               = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

                if ( !isset($event_id) || $event_id < 1 ) {
                    redirect(base_url() . "index.php/admin/event/");
                }

                if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
                         #CodeIgniter's input class to get all post values
                        $formValues = $this->input->post(NULL, TRUE);  
                        $RESPONSE   = $this->ticket_model->createEventSeatTicketClass ($formValues);
                        $this->session->set_flashdata('flash_server_response', $RESPONSE);
                        if ( $RESPONSE["success"] == false ) {
                            $this->session->set_flashdata('flash_client_request', $formValues);
                        }               
                        redirect(base_url() . "index.php/admin/ticket/event?" . "event_id=" . $event_id . "&event_page_start=" . $event_page_start);
                }


                if ( $id > 0 ) {
                    $formValues   = $this->ticket_model->get_ticket_seat_by_id($id);
                    $this->session->set_flashdata('flash_client_request', $formValues);
                }


                $data['title'] = 'Event Tickets';

                #CodeIgniter's input class to get all post values
                #$formValues = $this->input->post(NULL, TRUE);
                #Returning views as data
                #$string = $this->load->view('myfile', '', true);

                $this->load->library('pagination');
                $config['base_url']     =       base_url() .  ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "")  . '/admin/ticket/event' . '?event_id=' . $event_id . '&event_page_start=' .$event_page_start;

                $config['total_rows']   =       $this->ticket_model->event_ticket_record_count($event_id);
                $config['per_page']     =       10;
                $config["uri_segment"]  =       4;     
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

                $data['event_ticket_details'] = $this->ticket_model->get_event_tickets($event_id,$config["per_page"],$per_page);

                $data['pagination_link'] = $this->pagination->create_links();

                $data['per_page'] = $per_page;

                $data['id']                = $id;
                $data['event_id']         = $event_id;
                $data['event_page_start'] = $event_page_start;

                
                $data['ticket_section_details'] = $this->ticket_model->get_ticket_class_section();


                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/ticket/event_index', $data);
                $this->load->view('templates/admin/footer');

        }



        public function event_ticket_delete()
        {
                $id                     = ($this->input->get('id')) ? $this->input->get('id') : 0;
                $event_id               = ($this->input->get('event_id')) ? $this->input->get('event_id') : 0;
                $event_page_start       = ($this->input->get('event_page_start')) ? $this->input->get('event_page_start') : 0;
                $per_page               = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;


                if ( !isset($event_id) || $event_id < 1 ) {
                    redirect(base_url() . "index.php/admin/event/");
                }

                if ( $id > 0 ) {
                    $RESPONSE   = $this->ticket_model->deleteEventSeatTicketClass($id);
                    $this->session->set_flashdata('flash_server_response', $RESPONSE);
                }

                redirect(base_url() . "index.php/admin/ticket/event?" . "event_id=" . $event_id . "&event_page_start=" . $event_page_start);
        }

 
}