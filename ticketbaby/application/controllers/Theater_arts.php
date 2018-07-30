<?php

class Theater_arts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('text', 'url', 'text');
        $this->load->model('Front_model');
        $this->load->library('session');
    }

    function index() {
	$this->load->library('email');
		
$config['protocol'] = "smtp";
$config['smtp_host'] = "ssl://smtp.gmail.com";
$config['smtp_port'] = "465";
$config['smtp_user'] = "jdjalodara@gmail.com";
$config['smtp_pass'] = "jayesh909090";
$config['charset'] = "utf-8";
$config['mailtype'] = "html";
$config['newline'] = "\r\n";

$this->email->initialize($config);

$this->email->from('jdjalodara@gmail.com');
$this->email->to('jalodarajayeshd@gmail.com');
$this->email->subject('This is an email test');
$this->email->message('Lorem ipsum...');
echo $this->email->send(); 

   $data['club_sliders'] = $this->db->get_where('tbl_events',array('category_id'=>130,'recommended_carousel'=>'1'))->result();
	  $data['resulte'] = $this->db->get_where('tbl_events',array('category_id'=>130))->result();
  	  $data['categories'] = $this->db->get_where('tbl_post', array('parent_id' => '0', 'remark' => '6'))->result();
      $this->load->view('theater_arts',$data);
    }
	
	
	public function singleview()
	 {
      $id= $this->uri->segment(3);
	  $data['resulte'] = $this->db->get_where('tbl_events',array('id'=>$id))->result();
	  $data['additional'] = $this->db->get_where('additional_event_detail',array('event_id'=>$id))->result();
      $this->load->view('singleview',$data);
    }
}

    

?>