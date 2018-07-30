<?php

class Seats extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Admin_model');
    }

    function index() {
        echo 'jldskfjsdlfkjds';
    }

    function list_ticket_seats( $id = null) {
        
     
        $data['ticket_class'] = $this->Admin_model->ticket_class();
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['title'] = 'Ticket Seat Setting';
        $data['main'] = 'seats/list';
        $this->load->view('admin/index', $data);
    }

    function add() {
     
        
    
    }

    function delete($id) {

        $category = $this->db->get_where('tbl_post', array('id' => $id))->row();
        $this->db->where('id', $category->route_id);
        $this->db->delete('tbl_route');

        $this->db->where('post_id', $id);
        $this->db->delete('tbl_menu');

        $this->db->where('id', $id);
        $this->db->delete('tbl_post');
        redirect(base_url() . 'admin/category');
    }

    function edit($id) {
        $data['tickets'] = $this->db->get_where('tbl_ticket_class', array('parent_id' => 0))->result();
        $data['ticket_list'] = $this->db->get('tbl_ticket_class')->result();
        
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['title'] = "Edit";
        $data['ticket'] = $this->db->get_where('tbl_ticket_class', array('id' => $id))->row();
        $data['main'] = 'ticket/list';
        $this->load->view('admin/index', $data);
    }

    function update() {
        $id = $_POST['id'];

           $this->form_validation->set_rules('class', 'Class', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data['class'] = $this->input->post('class');
            $data['parent_id'] = $this->input->post('parent_id');
            $this->db->where('id',$id);
            $this->db->update('tbl_ticket_class', $data);
            $this->list_tickets();
        }
       
    }

}

?>