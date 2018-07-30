<?php

#session_start();

class Logout extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library("adminauthex");

        if (!$this->adminauthex->logged_in()) {
            redirect('admin', 'admin/login');
            exit;
        }
    }

    public function index() {
        $this->adminauthex->logout();
        redirect('admin/login', 'refresh');
    }

}