<?php

class Coupon extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    function index() {
        $this->list_coupen();
    }

    function list_coupen() {
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['coupens'] = $this->db->get_where('tbl_coupen', array('delete_status' => 0))->result();
        //  $data['ticket_list'] = $this->db->get('tbl_ticket_class')->result();
        $data['title'] = 'Coupen';
        $data['main'] = 'coupen/list';
        $this->load->view('admin/index', $data);
    }

    function add() {
        $this->form_validation->set_rules('coupen_code', 'Coupen', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->list_coupen();
        } else {
            $data['coupen_code'] = $this->input->post('coupen_code');
            $data['coupen_type'] = $this->input->post('coupen_type');
            $data['coupen_value'] = $this->input->post('coupen_value');
            $data['status'] = $this->input->post('status');
            $this->db->insert('tbl_coupen', $data);
            $this->list_coupen();
        }
    }

    function delete($id) {
		//Make Deleted as True
		$data['delete_status'] = 1;
        $this->db->where('id', $id);
        $this->db->update('tbl_coupen', $data);
        redirect(base_url() . 'admin/coupon');
    }

    function edit($id) {
        $data['coupens'] = $this->db->get_where('tbl_coupen')->result();
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['title'] = "Edit";
        $data['coupen'] = $this->db->get_where('tbl_coupen', array('id' => $id))->row();
        $data['main'] = 'coupen/list';
        $this->load->view('admin/index', $data);
    }

    function update() {
        $id = $_POST['id'];

        $this->form_validation->set_rules('coupen_code', 'Coupen', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {

            $data['coupen_code'] = $this->input->post('coupen_code');
            $data['coupen_type'] = $this->input->post('coupen_type');
            $data['coupen_value'] = $this->input->post('coupen_value');
            $data['status'] = $this->input->post('status');
            $this->db->where('id', $id);
            $this->db->update('tbl_coupen', $data);
            $this->list_coupen();
        }
    }

}

?>