<?php

class Menu extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }

    function index() {
        $this->list_menu();
    }



    function list_menu() {
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['result'] = $this->db->order_by('id','desc')->get_where('tbl_post', array('remark'=>'1'))->result();
        $data['title'] = 'Menus';
        $data['main'] = 'menu/menu';
        $this->load->view('admin/index', $data);
    }

    function organize($id){
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['id'] = $id;
        $data['post'] = $this->db->get_where('tbl_post', array('id'=>$id))->row();
        $data['all_posts'] = $this->db->order_by('id','desc')->get_where('tbl_post', array('remark'=>'3','status'=>'1'))->result();
        $data['categories'] = $this->db->order_by('id','desc')->get_where('tbl_post', array('remark'=>'6','status'=>'1'))->result();
        $data['pages'] = $this->db->order_by('id','desc')->get_where('tbl_post', array('remark'=>'5','status'=>'1'))->result();
        $data['result'] = $this->html_ordered_menu($id);
        $data['posts'] = $this->db->query('select tbl_post.id as id, tbl_menu.post_id as post_id, tbl_menu.menu_id as menu_id, tbl_menu.parent_id as menuparentid, tbl_menu.id as mid, tbl_post.title as title
FROM tbl_post JOIN tbl_menu
ON tbl_post.id=tbl_menu.post_id where tbl_menu.menu_id = '.$id.' order by tbl_menu.order_id asc')->result();
        $data['title'] = 'Menus';
        $data['main'] = 'menu/list';
        $this->load->view('admin/index', $data);        
    }

    function organize_menu($id){

        $post = array();
        if(isset($_POST['post_id']))
        {
             foreach($_POST['post_id'] as $rescheck)
             {
                 $post_log = $this->db->get_where('tbl_post', array('id'=>$rescheck))->row();
                 $post['post_id'] = $rescheck;
                 $post['menu_id'] = $id;
                 $post['menu_title'] = $post_log->title;
                 $this->db->insert('tbl_menu', $post); 
             }
        }
        $this->session->set_flashdata('msg','Menu item added sucessfully !');     
        redirect(admin_url('menu/organize/'.$id));
    }

    function save(){
        $data['title'] = $this->input->post('title');
        $data['remark'] = '1';
        $this->db->insert('tbl_post',$data);
        $this->session->set_flashdata('msg','Menu added sucessfully !');
        redirect(admin_url('menu'));        
    }

    function addmenu(){

      $menu_id = $this->input->post('menu_id');
      $post['remark'] = '7';
      $post['title'] = $this->input->post('menu_title');
      $this->db->insert('tbl_post',$post);
      $post_id = $this->db->insert_id();

      $data['menu_title'] = $this->input->post('menu_title');
      $data['post_id'] = $post_id;
      $data['menu_id'] = $this->input->post('menu_id');
      $data['order_id'] = '0';
      $data['url'] = $this->input->post('url');
      $this->db->insert('tbl_menu', $data);
      $this->session->flashdata('msg','Menu item added sucessfully !');
      redirect(admin_url('menu/organize/'.$menu_id));
    }

    function update(){
        $id = $_POST['menu_id'];
        $data['title'] = $this->input->post('menu_title');
        $this->db->where('id', $id);
        $this->db->update('tbl_post', $data);
        $this->session->set_flashdata('msg','Menu updated sucessfully !');
        redirect(admin_url('menu'));
    }

    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('tbl_post');
        $this->session->set_flashdata('msg','Menu deleted sucessfully !');
        redirect(base_url() . 'admin/menu');        
    }

    function update_menu_item($id){
      $data['menu_title'] = $this->input->post('menu_title');
      $data['url'] = $this->input->post('url');
      $menuid = $this->input->post('menu_id');
      $this->db->where('id', $id);
      $this->db->update('tbl_menu', $data);
      $this->session->set_flashdata('msg','Menu updated sucessfully !');
      redirect(admin_url('menu/organize/'.$menuid));
    }

    function deletemenu($id, $menuid){
      $this->db->where('id',$id);
      $this->db->delete('tbl_menu');
      $this->session->set_flashdata('msg','Menu deleted sucessfully !');
      redirect(admin_url('menu/organize/'.$menuid));
    }


function html_ordered_menu($id, $array=0, $parent_id = 0)
    {

      $array =   $this->db->query('select tbl_post.id as id, tbl_menu.post_id as post_id, tbl_menu.menu_id as menu_id, tbl_menu.parent_id as menuparentid, tbl_menu.id as mid, tbl_menu.menu_title as menu_title, tbl_menu.url as url, tbl_post.title as title
FROM tbl_post JOIN tbl_menu
ON tbl_post.id=tbl_menu.post_id where tbl_menu.menu_id = '.$id.' order by tbl_menu.order_id asc')->result_array();

      $menu_html = '<ol class="dd-list">';
      foreach($array as $element)
      {
        //debug($array);
        if($element['menuparentid']==$parent_id)
        {
            $menu_html .= '<li class="dd-item" data-id="'.$element['mid'].'" >';
            $menu_html .= '<div class="dd-handle">'.$element['menu_title'].'</div>';
            $menu_html .= '<div class="actions">';
            $menu_html .= '<a class="button-edit btn btn-default btn-xs pull-right" href="javascript:void(0)" id="'.$element['mid'].'" data-id="'.$element['id'].'" data-menuid="'.$element['menu_id'].'" data-parentid="'.$element['menuparentid'].'" data-title="'.$element['menu_title'].'" data-url="'.$element['url'].'" onclick="edit(this)"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
            $menu_html .= '</div>';
            
            $menu_html .= $this->html_ordered_menu($id,$array,$element['mid']);
            $menu_html .= '</li>';
        }
      }
      $menu_html .= '</ol>';
      return $menu_html;
    }


    function manage_order(){

        $this->saveList($_POST['list']); 

    }



    function saveList($list, $parent_id=0) {
            foreach($list as $key => $l){
               $id = $l['id'];
               $data['order_id'] = $key;
               $data['parent_id'] = $parent_id;
               $this->db->where('id',$id);
               $this->db->update('tbl_menu',$data);

                if (array_key_exists("children", $l)) {
                    $this->saveList($l["children"], $l["id"]);
                }
               
            }
    }

    function saveChildren($list, $parent_id){
        foreach($list as $key => $l){

               $id = $l['id'];
               //$data['order_id'] = $key;
               $data['parent_id'] = $parent_id;
               $this->db->where('id',$id);
               $this->db->update('tbl_menu',$data);

        }
    }




}

?>