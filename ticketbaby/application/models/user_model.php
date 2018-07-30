<?php

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function user_exists($facebook_user_id) {
        $this->db->from('users');
        $this->db->where('facebook_id', $facebook_user_id);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
             return $query->row()->facebook_id;
        }
    }

    function register_user($user_data) {
        if(empty($user_data['email'])){
            $user_data['email']="";
        }
        if(empty($user_data['birthday'])){
            $user_data['birthday']="";
        }
        if(empty($user_data['hometown']['name'])){
           $user_data['hometown']['name']="";
        }
        if(empty($user_data['location']['name'])){
           $user_data['location']['name']="";
        }
        $data['facebook_id'] = $user_data['id'];
        $data['name'] = $user_data['name'];
        $data['email'] = $user_data['email'];
        $data['birthday'] = $user_data['birthday'];
        $data['gender'] = $user_data['gender'];
        $data['hometown'] = $user_data['hometown']['name'];
        $data['location'] = $user_data['location']['name'];
        $data['activated'] = 1;
        $data['userdata']=json_encode($user_data);
        $this->db->insert('users',$data);
        return  $data['facebook_id'];
    }
    function getUserProfile($facebook_id){
      $userdata=  $this->db->select('userdata')->from('users')->where('facebook_id',$facebook_id)->get()->row()->userdata;
      $data=json_decode($userdata,true);
     return $data;
    }
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
