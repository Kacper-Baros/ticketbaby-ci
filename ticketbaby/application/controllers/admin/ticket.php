<?php

class Ticket extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    function index() {
        $this->list_tickets();
    }

    function list_tickets() {
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['tickets'] = $this->db->get_where('tbl_ticket_class', array('parent_id' => 0))->result();
        $data['ticket_list'] = $this->db->get('tbl_ticket_class')->result();
        $data['title'] = 'Tickets';
        $data['main'] = 'ticket/list';
        $this->load->view('admin/index', $data);
    }

    function add() {
        $this->form_validation->set_rules('class', 'Class', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->list_tickets();
        } else {
            $config['upload_path'] = 'uploads/images/full';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG|GIF';
            $config['max_size'] = '200000';
            $config['max_width'] = '1024000';
            $config['max_height'] = '768000';
            $config['encrypt_name'] = true;
            $config['remove_spaces'] = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config ['source_image'] = 'uploads/images/full/' . $upload_data['file_name'];
                $config['new_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();

                //small image
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
                $config['new_image'] = 'uploads/images/small/' . $upload_data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 235;
                $config['height'] = 235;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();

                //cropped thumbnail
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'uploads/images/small/' . $upload_data['file_name'];
                $config['new_image'] = 'uploads/images/thumbnails/' . $upload_data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 150;
                $config['height'] = 150;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
                $data['image'] = $upload_data['file_name'];
            }

            $data['class'] = $this->input->post('class');
            $data['info'] = $this->input->post('info');
            $data['parent_id'] = $this->input->post('parent_id');
            $this->db->insert('tbl_ticket_class', $data);
            $this->list_tickets();
        }
    }

    function delete($id) {
         $this->db->where('id', $id);
         $this->db->delete('tbl_ticket_class');
        redirect(admin_url('ticket'));
    }

    function edit($id) {

        $data['tickets'] = $this->db->get_where('tbl_ticket_class', array('parent_id' => 0))->result();
        $data['ticket_list'] = $this->db->get('tbl_ticket_class')->result();

        $data['logo'] = $this->db->get('site_settings')->row();
        $data['title'] = "Edit";
        $data['ticket'] = $this->db->get_where(
                        'tbl_ticket_class', array('id' => $id))->row();
        $data['main'] = 'ticket/list';
        $this->load->view('admin/index', $data);
    }

    function update() {
        $id = $_POST['id'];

        $this->form_validation->set_rules('class', 'Class', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
               $config['upload_path'] = 'uploads/images/full';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG|GIF';
            $config['max_size'] = '200000';
            $config['max_width'] = '1024000';
            $config['max_height'] = '768000';
            $config['encrypt_name'] = true;
            $config['remove_spaces'] = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config ['source_image'] = 'uploads/images/full/' . $upload_data['file_name'];
                $config['new_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 600;
                $config['height'] = 500;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();

                //small image
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
                $config['new_image'] = 'uploads/images/small/' . $upload_data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 235;
                $config['height'] = 235;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();

                //cropped thumbnail
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'uploads/images/small/' . $upload_data['file_name'];
                $config['new_image'] = 'uploads/images/thumbnails/' . $upload_data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 150;
                $config['height'] = 150;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
                $data['image'] = $upload_data['file_name'];
            }
            
            $data['class'] = $this->input->post('class');
            $data['info'] = $this->input->post('info');
            $data['parent_id'] = $this->input->post('parent_id');
            $this->db->where('id', $id);
            $this->db->update('tbl_ticket_class', $data);
            $this->list_tickets();
        }
    }

}

?>