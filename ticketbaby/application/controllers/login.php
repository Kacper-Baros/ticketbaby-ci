<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('text', 'url', 'text');
        $this->load->helper('date');
        $this->load->library('pagination');
    }
    function index(){
      $this->load->view('login');
    }
    
    function login_process(){
        
         $this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
         if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
        
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $query = $this->db->get('tbl_users')->row();
            if (count($query) == 1) {
                $this->session->unset_userdata('user_id');
                $this->session->set_userdata('user_id', $query->id);
                redirect(base_url('profile'));
            } else {
                $this->session->set_flashdata('unsuccess', 'Username or password not matched.');
                redirect(base_url('login'));
            }
    }
    }

   
}

?>