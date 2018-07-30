<?php
class Coupon extends CI_Controller {

        public function __construct()
        {
                parent::__construct();

                $this->load->library("adminauthex");

                if( ! $this->adminauthex->logged_in())
                {
                    redirect('admin', 'admin/login');
                    exit;
                }

                $this->load->model('coupon_model');              
        }



        public function index() {

                $id               = ($this->input->get('id')) ? $this->input->get('id') : 0;
                $per_page               = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

              
                if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
                         #CodeIgniter's input class to get all post values
                        $formValues = $this->input->post(NULL, TRUE);  
                        $RESPONSE   = $this->coupon_model->createUpdateCoupon ($formValues);
                        $this->session->set_flashdata('flash_server_response', $RESPONSE);
                        if ( $RESPONSE["success"] == false ) {
                            $this->session->set_flashdata('flash_client_request', $formValues);
                        }               
                        redirect(base_url() . "index.php/admin/coupon?" . "per_page=" . $per_page);
                }


                if ( $id > 0 ) {
                    $formValues   = $this->coupon_model->get_coupon_by_id($id);
                    $this->session->set_flashdata('flash_client_request', $formValues);
                }

                $data['title'] = 'Coupon';

                #CodeIgniter's input class to get all post values
                #$formValues = $this->input->post(NULL, TRUE);
                #Returning views as data
                #$string = $this->load->view('myfile', '', true);

                $this->load->library('pagination');
                $config['base_url']     =       base_url() .  ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "")  . '/admin/coupon';

                $config['total_rows']   =       $this->coupon_model->coupon_record_count();
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

                $data['coupon_lists'] = $this->coupon_model->get_coupons($config["per_page"],$per_page);

                $data['pagination_link'] = $this->pagination->create_links();


                $data['id']               = $id;
                $data['per_page']         = $per_page;



                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/coupon/coupon', $data);
                $this->load->view('templates/admin/footer');

        }



        public function delete()
        {
                $id                     = ($this->input->get('id')) ? $this->input->get('id') : 0;
                $per_page               = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;


                if ( $id > 0 ) {
                    $RESPONSE   = $this->coupon_model->deleteCoupon($id);
                    $this->session->set_flashdata('flash_server_response', $RESPONSE);
                }

                redirect(base_url() . "index.php/admin/coupon");
        }

 
}