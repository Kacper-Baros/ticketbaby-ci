<?php
class Settings extends Admin_Controller{
    function __construct() {
        parent::__construct();
    }
    function index(){
        $data['title'] = "Site Settings";
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['setting']=$this->db->get('site_settings')->row();
        $data['main']= 'settings/form';
        $this->load->view('admin/index',$data);
    }

    function save(){
        $config['upload_path'] = './uploads/logo';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '20000';
        $config['max_width'] = '102400';
        $config['max_height'] = '76800';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
             $data['site_title'] = $_POST['site_title'];
             $data['site_email'] = $_POST['site_email'];
             $data['offline'] = $_POST['offline'];
             $data['offline_message'] = $_POST['offline_message'];

             $data['seotitle'] = $_POST['seotitle'];
             $data['seokeyword'] = $_POST['seokeyword'];
             $data['seodescription'] = $_POST['seodescription'];
             $data['last_access'] = time();

            $this->db->where('id', '1');
            $this->db->update('site_settings', $data);
            $this->session->set_flashdata('message','Settings Updated successfully');
            redirect(base_url() . 'admin/settings');

        } else {
            $upload_data = $this->upload->data();
            $data['image'] = $upload_data['file_name'];
             $data['site_title'] = $_POST['site_title'];
             $data['site_email'] = $_POST['site_email'];
             $data['offline'] = $_POST['offline'];
             $data['offline_message'] = $_POST['offline_message'];

             $data['seotitle'] = $_POST['seotitle'];
             $data['seokeyword'] = $_POST['seokeyword'];
             $data['seodescription'] = $_POST['seodescription'];
             $data['last_access'] = time();             

            $this->db->where('id', '1');
            $this->db->update('site_settings', $data);
            $this->session->set_flashdata('message','Settings Updated successfully');
            redirect(base_url() . 'admin/settings');
        }
    }

    function profile(){
        $data['title'] = "Company Profile";
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['profile']=$this->db->get('site_profile')->row();
        $data['main']= 'settings/profile';
        $this->load->view('admin/index',$data);
    }


    function update_profile(){
     // debug($_POST); exit;
      $data['company_name'] = $this->input->post('company_name');
      $data['address1'] = $this->input->post('address1');
      $data['address2'] = $this->input->post('address2');
      $data['phone'] = $this->input->post('phone');
      $data['phone1'] = $this->input->post('phone1');
      $data['email'] = $this->input->post('email');
      $data['fax'] = $this->input->post('fax');
      $data['company_detail'] = $this->input->post('company_detail');
      $data['lat'] = $this->input->post('lat');
      $data['lang'] = $this->input->post('lng');
      
      $data['facebook'] = $this->input->post('facebook');
      $data['linkedin'] = $this->input->post('linkedin');
      $data['googleplus'] = $this->input->post('googleplus');
      $data['twitter'] = $this->input->post('twitter');
      $data['youtube'] = $this->input->post('youtube');
      $data['digg'] = $this->input->post('digg');
      $data['skype'] = $this->input->post('skype');
      $data['pinterest'] = $this->input->post('pinterest');
      $data['last_access'] = time(); 
           
      $this->db->where('id', '1');
      $this->db->update('site_profile', $data);
      $this->session->set_flashdata('message','Company Profile Updated successfully');
      redirect(base_url() . 'admin/settings/profile');

    }




}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>