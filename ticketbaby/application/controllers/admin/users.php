<?php

class Users extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Admin_model');
        $this->load->model('Front_model');
        $this->load->library('form_validation');
    }

    function index() {
        $this->list_users();
    }

    function list_users() {
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['users_list'] = $this->db->get_where('tbl_users', array('user_type' => 0))->result();
        $data['title'] = 'Users';
        $data['main'] = 'users/list';
        $this->load->view('admin/index', $data);
    }

    function add() {
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['title'] = "Add User";
        $data['main'] = 'users/list';
        $this->load->view('admin/index', $data);
    }

    function edit($id){
        $data['logo'] = $this->db->get('site_settings')->row();
		$data['users_list'] = $this->db->get_where('tbl_users', array('user_type' => 0))->result();
		$data['users'] = $this->db->get_where('tbl_users', array('id' => $id))->row();
        $data['title'] = "Edit";
        $data['main'] = 'users/list';
        $this->load->view('admin/index', $data);
    }
	
	function save() {
        $this->form_validation->set_rules('username', 'User Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone_no', 'Phone No', 'trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required||valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('re_password', 'Confirm Password', 'required|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data['username'] = $this->input->post('username');
            $data['fullname'] = $this->input->post('fullname');
            $data['phone_no'] = $this->input->post('phone_no');
			$data['address'] = $this->input->post('address');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['created'] = time();
            $this->db->insert('tbl_users', $data);
            $this->session->set_flashdata('success', 'Congratulations, New user has registered.');
            redirect(admin_url('users'));
        }
    }

	function update() {
		$id = $this->input->post('id');
        if ($this->input->post('password') != "" && $this->input->post('password') != $this->input->post('re_password')) {
            $this->session->set_flashdata(
                    'message', 'New password should match to repeat password to change password');
            redirect(admin_url('users/edit/' . $id));
        }
		$this->form_validation->set_rules('username', 'User Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone_no', 'Phone No', 'trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required||valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('re_password', 'Confirm Password', 'required|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
            return false;
        }

        if ($this->input->post('password') != "") {
            $password = $this->input->post('password');
            $data['password'] = $password;
        }
        $data['username'] = $this->input->post('username');
		$data['fullname'] = $this->input->post('fullname');
		$data['phone_no'] = $this->input->post('phone_no');
		$data['address'] = $this->input->post('address');
		$data['email'] = $this->input->post('email');
        $this->db->where('id', $id);
        $this->db->update('tbl_users', $data);
        $this->session->set_flashdata('message', 'User details updated successfully!');
        redirect(admin_url('users'));
    }
	
	function delete($id) {
		 $this->db->where('id', $id);
		 $this->db->delete('tbl_users');
		 redirect(admin_url('users'));
    }
}

?>