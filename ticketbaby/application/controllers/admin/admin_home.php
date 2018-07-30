<?php
class Admin_home extends Admin_Controller{
    function __construct() {
        parent::__construct();
    }
    function index(){
    	$data['logo'] = $this->db->get('site_settings')->row();
    
        $data['profile'] = $this->db->get('site_profile')->row();
    	$data['main'] = 'dashboard';
        $this->load->view('admin/index', $data);
    }
 
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>