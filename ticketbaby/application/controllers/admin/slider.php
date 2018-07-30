<?php

class Slider extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $path = '../../../js/ckfinder';
        $width = '1000px';
        $this->editor($path, $width);
    }

    function editor($path,$width) {
        //Loading Library For Ckeditor
        $this->load->library('ckeditor');
        $this->load->library('ckFinder');
        //configure base path of ckeditor folder 
        $this->ckeditor->basePath = base_url().'js/ckeditor/';
        $this->ckeditor-> config['toolbar'] = 'Full';
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor-> config['width'] = $width;
        //configure ckfinder with ckeditor config 
        $this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
    }



    function index() {
        $this->list_slider();
    }

    function list_slider() {
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['res'] = $this->html_ordered_menu();
        $data['title'] = 'Slider';
        $data['main'] = 'slider/list';
        $this->load->view('admin/index', $data);
    }

    function slider_form() {
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['title'] = 'Add slider';
        $data['main'] = 'slider/form';
        $this->load->view('admin/index', $data);
    }

    function add_slider() {
            $config['upload_path'] = 'uploads/images/full';
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

            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/full/'.$upload_data['file_name'];
            $config['new_image']    = 'uploads/images/medium/'.$upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            //small image
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/medium/'.$upload_data['file_name'];
            $config['new_image']    = 'uploads/images/small/'.$upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 235;
            $config['height'] = 235;
            $this->image_lib->initialize($config); 
            $this->image_lib->resize();
            $this->image_lib->clear();

            //cropped thumbnail
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/small/'.$upload_data['file_name'];
            $config['new_image']    = 'uploads/images/thumbnails/'.$upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 150;
            $config['height'] = 150;
            $this->image_lib->initialize($config);  
            $this->image_lib->resize(); 
            $this->image_lib->clear();

            $data['image'] = $upload_data['file_name'];
        }else{
            echo "Error ! please select valid image type.";
        }

            $data['remark'] = '2';
            $data['order_id'] = $this->input->post('order_id');
            $data['title'] = $_POST['caption'];
            $data['description'] = $_POST['description'];
            $data['url'] = $_POST['url'];
            $this->db->insert('tbl_post', $data);
                
            redirect(base_url() . 'admin/slider');

    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('tbl_post');
        redirect(base_url() . 'admin/slider');
    }

    function edit($id) {
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['title'] = "Edit";
        $data['result'] = $this->db->get_where('tbl_post', array('id'=>$id))->row_array();
        $data['main'] = 'slider/form';
        $this->load->view('admin/index', $data);
    }

    function update_slider($id) {
        $id = $_POST['id'];

            $config['upload_path'] = 'uploads/images/full';
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

            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/full/'.$upload_data['file_name'];
            $config['new_image']    = 'uploads/images/medium/'.$upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            //small image
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/medium/'.$upload_data['file_name'];
            $config['new_image']    = 'uploads/images/small/'.$upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 235;
            $config['height'] = 235;
            $this->image_lib->initialize($config); 
            $this->image_lib->resize();
            $this->image_lib->clear();

            //cropped thumbnail
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/small/'.$upload_data['file_name'];
            $config['new_image']    = 'uploads/images/thumbnails/'.$upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 150;
            $config['height'] = 150;
            $this->image_lib->initialize($config);  
            $this->image_lib->resize(); 
            $this->image_lib->clear();

            $data['image'] = $upload_data['file_name'];
        }  
            $data['order_id'] = $_POST['order_id'];
            $data['title'] = $_POST['caption'];
            $data['description'] = $_POST['description'];
            $data['url'] = $_POST['url'];
            $this->db->where('id', $id);
            $this->db->update('tbl_post', $data);

            redirect(base_url() . 'admin/slider');
    }
    
    
    


    function enable($id){
        $data['status'] = '1';
        $this->db->where('id',$id);
        $this->db->update('tbl_post',$data);
        redirect(admin_url('slider'));
    }


    function disable($id){
        $data['status'] = '0';
        $this->db->where('id',$id);
        $this->db->update('tbl_post',$data);
        redirect(admin_url('slider'));
    }
   

    function manage_order(){
        //debug($_POST);
        $i = 0;
       
        foreach ($_POST['item'] as $value) {
            $data['order_id'] = $i;
            $this->db->where('id', $value);
            $this->db->update('tbl_post', $data);
            $i++;
        }
        echo "successfully updated";
    }



function html_ordered_menu($array=0, $parent_id = 0)
    {
      $array =   $this->db->order_by('order_id','asc')->get_where('tbl_post', array('remark'=>'2'))->result_array();

      $menu_html = '<ul class="message-list droptrue" id="sortable">';
      foreach($array as $element)
      {
        if($element['parent_id']==$parent_id)
        {
            $menu_html .= '<li id="item-'.$element['id'].'">';
            $menu_html .= '<div class="clearfix">';
            $menu_html .= '<div class="chat-member">';

            $menu_html .= '<a href="#">';
            $menu_html .= '<img src="'.base_url('uploads/images/thumbnails/'.$element['image']).'" alt="">';
            $menu_html .= '</a>';
            $menu_html .= '<h6>'.$element['title'].'</h6>';
            $menu_html .= '</div>';

            $menu_html .= '<div class="status">';
            $menu_html .= '<h6>';
            if($element['status'] == '0'){
            $menu_html .=   '<a href="'.admin_url('slider/enable/'.$element['id']).'" class="btn btn-danger">Unpublished</button></a>';
            }if($element['status'] == '1'){
            $menu_html .=   '<a href="'.admin_url('slider/disable/'.$element['id']).'" class="btn btn-success">Published</button></a>';
            }
            $menu_html .= '</h6>';
            $menu_html .= '</div>';



            $menu_html .= '<div class="chat-actions">';            
            $menu_html .= '<a title="Edit" href="'.admin_url('slider/edit/'.$element['id']).'" class="btn btn-link btn-icon btn-xs"><i class="icon-pen"></i></a>';
            $menu_html .= '<a title="Remove" href="'.admin_url('slider/delete/'.$element['id']).'" class="btn btn-link btn-icon btn-xs" onclick="return confirm(\'Are you sure ?\');"><i class="icon-remove"></i></a>';
            $menu_html .= '</div>';
            $menu_html .= '</div>';
            $menu_html .= $this->html_ordered_menu($array,$element['id']);
            $menu_html .= '</li>';
        }
      }
      $menu_html .= '</ul>';
      return $menu_html;
    }




}

?>