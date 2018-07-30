<?php

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('text', 'url', 'text');
        $this->load->helper('date');
        $this->load->library('pagination');
    }
    function index(){
        $id = $this->session->userdata('user_id');
        if(!empty($id)) {
			$data['details'] = $this->db->get_where('tbl_users',array('id'=>$id))->row();
			$data['listevent'] = $this->db->get_where('tbl_saved_events', array('user_id' => $id))->result();
			$this->load->view('profile',$data);
        }else{
            redirect(base_url('login'));
        }
    }
    function edit_profile(){
         $id = $this->session->userdata('user_id');
         
         if(!empty($id)){
			$data['details'] = $this->db->get_where('tbl_users',array('id'=>$id))->row();
			$this->load->view('edit_profile',$data);
         }else{
             redirect(base_url('login'));
         }
    }
    
    function update_profile(){
        $id = $this->session->userdata('user_id');
        $config['upload_path'] = 'uploads/images/full';
        $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG';
        $config['max_size'] = '200000';
        $config['max_width'] = '1024000';
        $config['max_height'] = '768000';
        $config['encrypt_name'] = true;
        $config['remove_spaces'] = true;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('user_picture')) {
            $upload_data = $this->upload->data();
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/full/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();
            $data['user_picture'] = $upload_data['file_name'];
        }
        $this->form_validation->set_rules('username', 'User Name', 'required]');
        $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone_no', 'Phone No', 'trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required||valid_email');
        
        if ($this->form_validation->run() == FALSE) {
            $this->edit_profile();
        } else {
            $data['username'] = $this->input->post('username');
            $data['fullname'] = $this->input->post('fullname');
            $data['phone_no'] = $this->input->post('phone_no');
            $data['email'] = $this->input->post('email');
			$data['address'] = $this->input->post('address');
			$data['area'] = $this->input->post('area');
			$data['city'] = $this->input->post('city');
			$data['postcode'] = $this->input->post('postcode');
			$data['country'] = $this->input->post('country');
            
            if($this->input->post('password') != '') {
				$data['password'] = $this->input->post('password');
            }
            $this->db->where('id',$id);
            $this->db->update('tbl_users', $data);
            $this->session->set_flashdata('success', 'Your profile has been updated.');
            redirect(base_url('profile/edit_profile'));
        }
    }
    function logout(){
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}

?>