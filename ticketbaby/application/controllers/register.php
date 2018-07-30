<?php

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('text', 'url', 'text');
        $this->load->helper('date');
        $this->load->library('pagination');
    }

    function index() {
        $this->load->view('register');
    }

    function register_user() {
        $this->form_validation->set_rules('username', 'User Name', 'trim|required|xss_clean|is_unique[tbl_users.username]');
        $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone_no', 'Phone No', 'trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required||valid_email|is_unique[tbl_users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('re-password', 'Confirm Password', 'required|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data['username'] = $this->input->post('username');
            $data['fullname'] = $this->input->post('fullname');
            $data['phone_no'] = $this->input->post('phone_no');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['created'] = time();
            $this->db->insert('tbl_users', $data);
            $this->session->set_flashdata('success', 'Congratulations, your account has been registered.');
            redirect(base_url('login'));
        }
    }
}

?>