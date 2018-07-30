<?php
class Pageslider extends Admin_Controller{
    function __construct() {
        parent::__construct();
    }
    function index(){
		$data['logo'] = $this->db->get('site_settings')->row();
        $data['profile'] = $this->db->get('site_profile')->row();
        $this->load->view('admin/pageslider',$data);
    }
	
	function add()
	{
			
		 	$config['upload_path'] = 'uploads/images/pageslider';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG|GIF';
            $config['max_size'] = '200000';
            $config['max_width'] = '1024000';
            $config['max_height'] = '768000';
            $config['encrypt_name'] = true;
            $config['remove_spaces'] = true;

       	    $this->load->library('upload', $config);
        
        if ( $this->upload->do_upload('image'))
        {
            $upload_data    = $this->upload->data();
            $this->load->library('image_lib');
		/*
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/full/'.$upload_data['file_name'];
            $config['new_image']    = 'uploads/images/medium/'.$upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();*/
		}
			
			$data['caption'] = $this->input->post('caption');
            $data['image'] = $upload_data['file_name'];
            $this->db->insert('tbl_slider', $data);
			redirect(base_url() . 'admin/pageslider');
			
	}
	
	function update()
	{
			
		if($_FILES['image']['tmp_name']!="")	
		{
			
		 	$config['upload_path'] = 'uploads/images/pageslider';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG|GIF';
            $config['max_size'] = '200000';
            $config['max_width'] = '1024000';
            $config['max_height'] = '768000';
            $config['encrypt_name'] = true;
            $config['remove_spaces'] = true;
       	    $this->load->library('upload', $config);
			if ( $this->upload->do_upload('image'))
			{
				$upload_data    = $this->upload->data();
				$this->load->library('image_lib');
			}
			
			 $data['image'] = $upload_data['file_name'];
             $this->db->where('id', $_POST['id']);
             $this->db->update('tbl_slider', $data);
		}
		
			$data['caption'] = $this->input->post('caption');
            $this->db->where('id', $_POST['id']);
            $this->db->update('tbl_slider', $data);
			redirect(base_url() . 'admin/pageslider');
			
	}
}

?>