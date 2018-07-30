<?php
class Promote_events extends Admin_Controller{
    function __construct() {
        parent::__construct();
           $this->load->library('form_validation');
    }
    function index(){

        $this->promote_list();
    }
    
    function promote_list(){
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['promote_details'] = $this->db->get_where('tbl_promote_events')->result();
        $data['title'] = 'Promote Events';
        $data['main'] = 'promote_events/list';
        $this->load->view('admin/index', $data);
    }
    
    function add(){
    
           $this->form_validation->set_rules('title', 'Title', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->promote_list();
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

            $data['title'] = $this->input->post('title');
            $data['sdate'] = $this->input->post('sdate');
            $data['edate'] = $this->input->post('edate');
            $data['time'] = $this->input->post('time');
            $data['venue'] = $this->input->post('venue');
            $data['address'] = $this->input->post('address');
            $data['city'] = $this->input->post('city');
            $data['country'] = $this->input->post('country');
            $data['url'] = $this->input->post('url');
            $data['details'] = $this->input->post('details');
            $data['url_target'] = $this->input->post('url_target');
            $data['status'] = $this->input->post('active');
            $this->db->insert('tbl_promote_events', $data);
            $this->promote_list();
        }
    }
    
    
    function edit($id){
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['promote_details'] = $this->db->get_where('tbl_promote_events')->result();
        $data['promote'] = $this->db->get_where('tbl_promote_events',array('id'=>$id))->row();
        $data['title'] = ' Edit Promote Events';
        $data['main'] = 'promote_events/list';
        $this->load->view('admin/index', $data);
    }
    
    function update(){
           $id = $_POST['id'];

        $this->form_validation->set_rules('title', 'Title', 'required');
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
            
            $data['title'] = $this->input->post('title');
            $data['sdate'] = $this->input->post('sdate');
            $data['edate'] = $this->input->post('edate');
            $data['time'] = $this->input->post('time');
            $data['venue'] = $this->input->post('venue');
            $data['address'] = $this->input->post('address');
            $data['city'] = $this->input->post('city');
            $data['country'] = $this->input->post('country');
            $data['url'] = $this->input->post('url');
            $data['details'] = $this->input->post('details');
            $data['url_target'] = $this->input->post('url_target');
            $data['status'] = $this->input->post('active');
            $this->db->where('id', $id);
            $this->db->update('tbl_promote_events', $data);
            $this->promote_list();
        }
   
    }
 




}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>