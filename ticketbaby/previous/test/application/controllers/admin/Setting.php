<?php
class Setting extends CI_Controller {

        public function __construct()
        {
                parent::__construct();

                $this->load->library("adminauthex");

                if( ! $this->adminauthex->logged_in())
                {
                    redirect('admin', 'admin/login');
                    exit;
                }             
        }

        public function index()
        {
                if ( $this->input->server('REQUEST_METHOD') == 'POST' ) {
                     #CodeIgniter's input class to get all post values
                    $formValues = $this->input->post(NULL, TRUE);  
                    $RESPONSE   = $this->adminauthex->set_config ($formValues);
                    $this->session->set_flashdata('flash_server_response', $RESPONSE);
                    redirect(base_url() . "index.php/admin/setting");
                }

                $data['settings'] = $this->adminauthex->get_config();
                $data['title'] = 'Settings';

                $this->load->view('templates/admin/header', $data);
                $this->load->view('admin/setting', $data);
                $this->load->view('templates/admin/footer');
        }
}