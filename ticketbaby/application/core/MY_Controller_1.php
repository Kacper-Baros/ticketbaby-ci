<?php

/**
 * The base controller which is used by the Front and the Admin controllers
 */
class Base_Controller extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
}

class Front_Controller extends Base_Controller
{
    var $data;
    function __construct() {
        parent::__construct();
      
       
        $config['appId']=config_item('app_id');
        $config['secret']=config_item('app_secret');
        $this->load->library('facebook',$config);
        
        $user_id=$this->facebook->getUser();
//        $user_id=false;
       if($this->session->userdata('facebook_user_id')==""){
        if ($user_id) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $data['user_profile'] = $this->facebook->api('/me');
             echo   $accessToken = $this->facebook->getAccessToken();
             echo "<br/>";;exit;
//                 $this->facebook->setExtendedAccessToken($accessToken);
                $this->facebook->setAccessToken($accessToken);
            } catch (FacebookApiException $e) {
                error_log($e);
                $user_id = null;
            }
        }
//      debug($data['user_profile']);
        if ($user_id) {
            $facebook_user_id=   $this->User_model->user_exists($user_id);
         if(!$facebook_user_id){
            $facebook_user_id= $this->User_model->register_user($data['user_profile']);
         }
            $this->session->set_userdata('facebook_user_id',$facebook_user_id);
            $data['user_login']=true;
            $data['logoutUrl'] = $this->facebook->getLogoutUrl();
        } else {
            $data['user_login']=false;
            $data['loginUrl'] = $this->facebook->getLoginUrl(array(
        'scope' => config_item('scopes'),
        'redirect_uri' => current_url()
    ));
        }
      
    }else{
         $data['user_login']=true;
         $data['logoutUrl'] = $this->facebook->getLogoutUrl(array('next'=>site_url('logout/logout_me/')));
         $data['user_profile']=$this->User_model->getUserProfile($this->session->userdata('facebook_user_id'));
    }
      $this->data=$data;
    }
}

class Admin_Controller extends Base_Controller 
{
	function __construct()
	{
               
		parent::__construct();
                $this->load->helper('admin');
                $admin_id=$this->session->userdata('admin_user_id');
		 if(!$admin_id || empty($admin_id)){
                    redirect(admin_url('login'));
                }
	}
}