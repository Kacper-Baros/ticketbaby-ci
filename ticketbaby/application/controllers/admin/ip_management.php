<?php

class IP_management extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }
	
	function index() {
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['title'] = "IP List";
        $data['ip_list'] = $this->db->get('tbl_ipaddresses')->result();
        $data['main'] = 'iplist/list';
        $this->load->view('admin/index', $data);
    }
    
	function edit($id) {
        $data['logo'] = $this->db->get('site_settings')->row();
		$data['ip_list'] = $this->db->get('tbl_ipaddresses')->result();
        $data['ipedit'] = $this->db->get_where('tbl_ipaddresses', array('address_id' => $id))->row();
        $data['title'] = "Edit IP";
        $data['main'] = 'iplist/list';
        $this->load->view('admin/index', $data);
    }
	function add() {
        $data['ip_address'] = $this->input->post('ip_address');
		$data['ip_user'] = $this->input->post('ip_user');
		$data['ip_location'] = $this->input->post('ip_location');
		$this->db->insert('tbl_ipaddresses', $data);
		redirect(admin_url('ip_management'));
    }
	function update() {
        $id = $_POST['id'];
		$data['ip_address'] = $this->input->post('ip_address');
		$data['ip_user'] = $this->input->post('ip_user');
		$data['ip_location'] = $this->input->post('ip_location');
		$this->db->where('address_id', $id);
		$this->db->update('tbl_ipaddresses', $data);
		redirect(admin_url('ip_management'));
    }
	function delete($id) {
		 $this->db->where('address_id', $id);
		 $this->db->delete('tbl_ipaddresses');
		 redirect(admin_url('ip_management'));
    }
}
?>