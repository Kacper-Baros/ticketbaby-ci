<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminauthex2{

     function Adminauthex2()
     {
         $CI =& get_instance();

         //load libraries
         $CI->load->database();
         $CI->load->library("session");

         $CI->load->model('admin_model2');
     }

     function get_userdata()
     {
         $CI =& get_instance();

         if( ! $CI->logged_in())
         {
             return false;
         }
         else
         {
              return $CI->admin_model2->get_userdata();
         }
     }

     function logged_in()
     {
         $CI =& get_instance();
         return ($CI->session->userdata("admin_session")) ? true : false;
     }

     function login($username, $password)
     {
        $CI =& get_instance();

        if ($result = $CI->admin_model2->authenticateAdmin2($username, $password)) {
            $CI->session->set_userdata(array("admin_session"=>$result));
            return true;
        }else{
            return false;   
        }
     }
	 
  
     function logout()
     {
         $CI =& get_instance();
         $CI->session->unset_userdata('admin_session');
         
		 
		 
         #session_destroy();
     }

     function register($email, $password)
     {
         $CI =& get_instance();

         //ensure the email is unique
         if($CI->admin_model2->createUser($email, $password))
         {
            
             return true;
         }

         return false;
     }

     function get_config() {
         $CI =& get_instance();
         return $CI->admin_model2->get_config();
     }

     function set_config($data) {
         $CI =& get_instance();
         return $CI->admin_model2->set_config($data);
     }


}