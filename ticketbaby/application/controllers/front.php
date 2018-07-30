<?php
class Front extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('text', 'url', 'text');
        $this->load->helper('date');
        $this->load->library('pagination');
		$this->load->model('Eticket_model');
		$this->load->helper('mpdf');
    }

    function show_msg() {
        $setting = $this->db->get('site_settings')->row();
        $data['setting'] = $setting;
        $this->load->view('temp', $data);
    }

    function index() {
        $this->home();
    }

    function home() {
        $data['sliders'] = $this->db->get_where('tbl_post',array('remark'=>2))->result();
        $data['main_carousel'] = $this->db->order_by('id','DESC')->get_where('tbl_events',array('main_carousel'=>1,'status'=>1))->result();
		
		/*$q="SELECT * FROM `tbl_events` WHERE 'main_carousel'=1,'status'=1 ORDER BY STR_TO_DATE(`start_date`, '%d/%m/%Y') DESC ";
		$res = $this->db->query($q);
		*/
		
        $data['recommended_carousel'] = $this->db->get_where('tbl_events',array('recommended_carousel'=>1,'status'=>1))->result();
        $data['hot_ticket'] = $this->db->get_where('tbl_events',array('hot_ticket'=>1,'status'=>1))->result();
        $data['just_announced'] = $this->db->get_where('tbl_events',array('just_announced'=>1,'status'=>1))->result();
        $data['promote_events'] = $this->db->get_where('tbl_promote_events')->result();
        $this->load->view('index',$data);
    }
	function SaveEvent(){
		$data['event_id'] = $this->input->post('event_id');
		$data['user_id'] = $this->input->post('user_id');
		$query = $this->db->insert('tbl_saved_events', $data);
		if($query){
			echo json_encode("Confirmed");
		}
		else{
			echo json_encode( "NotValid");
		}
	}
	function RemoveEvent(){
		$save_id = $this->input->post('save_id');
		$this->db->where('save_id', $save_id);
        $query = $this->db->delete('tbl_saved_events');
		if($query){
			echo json_encode("Confirmed");
		}
		else{
			echo json_encode( "NotValid");
		}
	}
    function about() {
        $data['seo'] = $this->db->get('site_settings')->row();
        $data['profile'] = $this->db->get('site_profile')->row();
        $data['setting'] = $this->db->get('site_settings')->row();
        $data['top_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '40', 'parent_id' => '0'))->result();
        $data['company_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '106', 'parent_id' => '0'))->result();
        $data['footer_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '39', 'parent_id' => '0'))->result();
        $data['about'] = $this->db->get_where('tbl_post', array('id' => '102'))->row();
        $data['who_we_are'] = $this->db->get_where('tbl_post', array('id' => '45'))->row();
        $data['our_team'] = $this->db->get('tbl_post')->result();

        $data['team'] = $this->db->query('select tc.category_id as category_id, tp.id as post_id, tp.order_id as order_id, tp.status as status, tp.title as title, tp.excerpt as excerpt, tp.description as description, tp.image as image from tbl_post tp join tbl_category tc on(tc.post_id = tp.id) where category_id=54 and status = 1 order by order_id asc;')->result();
        //debug($data['team']); exit;

        $this->load->view('about', $data);
    }

    function post($id) {
        $data['seo'] = $this->db->get_where('tbl_post', array('id' => $id))->row();
        $data['profile'] = $this->db->get('site_profile')->row();
        $data['setting'] = $this->db->get('site_settings')->row();
        $data['top_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '40', 'parent_id' => '0'))->result();
        $data['company_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '106', 'parent_id' => '0'))->result();
        $data['footer_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '39', 'parent_id' => '0'))->result();
        $data['post'] = $this->db->get_where('tbl_post', array('id' => $id))->row();
        $parent = $this->db->get_where('tbl_post', array('parent_id' => $id))->result();
        if (!empty($parent)) {
            $data['posts'] = $this->db->get_where('tbl_post', array('parent_id' => $id))->result();
            $this->load->view('category', $data);
        } else {
            $this->load->view('post', $data);
        }
    }

    function page($id) {
        $data['seo'] = $this->db->get_where('tbl_post', array('id' => $id))->row();
        $data['profile'] = $this->db->get('site_profile')->row();
        $data['setting'] = $this->db->get('site_settings')->row();
        $data['top_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '40', 'parent_id' => '0'))->result();
        $data['company_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '106', 'parent_id' => '0'))->result();
        $data['footer_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '39', 'parent_id' => '0'))->result();
        $data['post'] = $this->db->get_where('tbl_post', array('id' => $id))->row();
        $parent = $this->db->get_where('tbl_post', array('parent_id' => $id))->result();
        if (!empty($parent)) {
            $data['posts'] = $this->db->get_where('tbl_post', array('parent_id' => $id))->result();
            $this->load->view('category', $data);
        } else {
            $this->load->view('post', $data);
        }
    }

    function category($id) {
        $data['seo'] = $this->db->get_where('tbl_post', array('id' => $id))->row();
        $data['profile'] = $this->db->get('site_profile')->row();
        $data['setting'] = $this->db->get('site_settings')->row();
        $data['top_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '40', 'parent_id' => '0'))->result();
        $data['company_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '106', 'parent_id' => '0'))->result();
        $data['footer_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '39', 'parent_id' => '0'))->result();
        $data['posts'] = $this->db->get('tbl_post')->row();
        $this->load->view('category', $data);
    }

    function blog() {
        $data['seo'] = $this->db->get_where('tbl_post', array('id' => '105'))->row();
        $data['profile'] = $this->db->get('site_profile')->row();
        $data['setting'] = $this->db->get('site_settings')->row();
        $data['top_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '40', 'parent_id' => '0'))->result();
        $data['company_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '106', 'parent_id' => '0'))->result();
        $data['footer_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '39', 'parent_id' => '0'))->result();
        $data['post'] = $this->db->get_where('tbl_post', array('id' => '105'))->row();
        $data['posts'] = $this->db->query('select tc.category_id as category_id, tp.id as post_id, tp.slug as slug, tp.order_id as order_id, tp.status as status, tp.title as title, tp.excerpt as excerpt, tp.description as description, tp.image as image from tbl_post tp join tbl_category tc on(tc.post_id = tp.id) where category_id=105 and status = 1 order by order_id asc;')->result();
        $this->load->view('blog', $data);
    }

    function gallery() {
        $data['seo'] = $this->db->get('site_settings')->row();
        $data['profile'] = $this->db->get('site_profile')->row();
        $data['setting'] = $this->db->get('site_settings')->row();
        $data['top_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '40', 'parent_id' => '0'))->result();
        $data['company_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '106', 'parent_id' => '0'))->result();
        $data['footer_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '39', 'parent_id' => '0'))->result();

        $data['gallery'] = $this->db->get_where('tbl_gallary', array('status' => '1'))->result();
        $this->load->view('gallery', $data);
    }

    function gallery_img($id) {
        $data['seo'] = $this->db->get_where('tbl_gallary', array('id' => $id))->row();
        $data['profile'] = $this->db->get('site_profile')->row();
        $data['setting'] = $this->db->get('site_settings')->row();
        $data['top_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '40', 'parent_id' => '0'))->result();
        $data['company_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '106', 'parent_id' => '0'))->result();
        $data['footer_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '39', 'parent_id' => '0'))->result();
        $data['gallery'] = $this->db->get_where('tbl_gallary', array('id' => $id))->row();
        $data['posts'] = $this->db->get_where('tbl_gallery_img', array('gallary_id' => $id))->result();
        $this->load->view('gallery_detail', $data);
    }

    function services() {
        $data['seo'] = $this->db->get('site_settings')->row();
        $data['profile'] = $this->db->get('site_profile')->row();
        $data['setting'] = $this->db->get('site_settings')->row();
        $data['top_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '40', 'parent_id' => '0'))->result();
        $data['company_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '106', 'parent_id' => '0'))->result();
        $data['footer_menu'] = $this->db->order_by('order_id', 'asc')->get_where('tbl_menu', array('menu_id' => '39', 'parent_id' => '0'))->result();
        $this->load->view('services', $data);
    }

    function contact() {
        $this->load->view('contact_us');
    }
	function emailtest(){
		$this->load->view('email/confirmation_email');
	}
	
	//E-Ticket Function
	function eticket($id){
		
		$data['order_details'] = $this->Eticket_model->order_details($id);
		$data['event_details'] = $this->Eticket_model->event_details($id);
		$data['event_additionals'] = $this->Eticket_model->event_additionals($id);
		$data['etickets_settings'] = $this->Eticket_model->etickets_settings($id);
		
        $this->load->view('etickets/eticket', $data);
	}
    
	//Pdf Function
	function pdf($id){
		
		$data['order_details'] = $this->Eticket_model->order_details($id);
		$data['event_details'] = $this->Eticket_model->event_details($id);
		$data['event_additionals'] = $this->Eticket_model->event_additionals($id);
		$data['etickets_settings'] = $this->Eticket_model->etickets_settings($id);
		$this->load->view('etickets/pdf', $data);
        $html = $this->load->view('etickets/pdf', $data,true);
		//pdf_create($html, "pdf.pdf",TRUE);
    	$pdfFilePath = "pdf_{$id}.pdf";
		 
		//load mPDF library
		$this->load->library('m_pdf');
		//$this->m_pdf->pdf->use_kwt = true;  
		//$this->m_pdf->pdf->debug = true;
		//$this->m_pdf->pdf->showImageErrors = true;		
		//generate the PDF from the given html	
        $this->m_pdf->pdf->SetDisplayMode('fullwidth');		
		$this->m_pdf->pdf->WriteHTML($html);
		 
		//download it.
		$this->m_pdf->pdf->Output($pdfFilePath, "D");		
	}
    
    function contact_message() {
        $site_settings = $this->db->get_where('site_settings', array('id' => '1'))->row();

        $fname = $this->input->post('f_name');
        $lname = $this->input->post('l_name');
        $name = $fname . ' ' . $lname;
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
        $site_mail = $site_settings->site_email;

        $msg.= "Name : " . $name . "<br/>";
        $msg.= "Email : " . $email . "<br/>";
        $msg.= "Phone : " . $phone . "<br/>";
        $msg.= "Subject :" . $subject . "<br/>";
        $msg.= "Message :" . $message . "<br/>";

        $this->load->library('email');

        $config['mailtype'] = 'html';

        $this->email->initialize($config);

        $this->email->from($email, $name);
        $this->email->to($site_mail);
        $this->email->subject('Decor Roofing Contact Message');
        $this->email->message($msg);
        $this->email->send();
        $this->session->set_flashdata('msg', 'Thanks for contact us, We will contact you as soon as possible.');
        redirect(site_url('contact-us'));
    }

    function sendmail(){
        $site_settings = $this->db->get_where('site_settings', array('id' => '1'))->row();

        $name = $this->input->post('name');
        $ename= $this->input->post('ename');
        $email = $this->input->post('email');
        $date = $this->input->post('date');
		
          $message="<pre>Hello<br>"
          . "Thank you for your enquiry.<br>"
          . "Someone from our team will contact with your soon.<br>"
          . "<br>"
          . "Regards<br>"
          . "Admin</pre>";
		  
  		$subject="Your Enquiry Has been received";
  
 		  $message2="Hello<br>"
          . "Bellow inquiery has been submitted.<br>"
          . "Name: $name<br>"
          . "Email: $email<br>"
          . "Date: $date<br/>"
          . "Event Name: $ename";
  $subject2="New Enquiry regarding Ticket ";
        
        $site_mail = $site_settings->site_email;
	   
   /*     $this->load->library('email');
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from($site_mail);
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
       echo $this->email->send();
         $this->email->print_debugger();*/
		 
		 ######### Send user ##########
		
	   
				  
		$header = "From: ".$site_mail.""; 
		$header.= "MIME-Version: 1.0\r\n"; 
		$header.= "Content-Type: text/plain; charset=utf-8\r\n"; 
		$header.= "X-Priority: 1\r\n"; 

			
		$headers1 = "From: ".$email.""; 
		$headers1.= "MIME-Version: 1.0\r\n"; 
		$headers1.= "Content-Type: text/plain; charset=utf-8\r\n"; 
		$headers1.= "X-Priority: 1\r\n"; 
			
		mail($email,$subject,$message,$headers);
		mail($site_mail,$subject1,$message1,$headers1);
		
		$data['name']  = $name;
		$data['email'] = $email;
		$data['event_name'] = $ename;
		$data['date']  = $date;
		$this->db->insert('tbl_Enquiry', $data);
			
		
		
        /*$this->email->from($email);
        $this->email->to($site_mail);
        $this->email->subject($subject2);
        $this->email->message($message2);
        $this->email->send();
        $this->email->print_debugger();*/
		
        //$this->session->set_flashdata('msg', 'Thanks for contact us, We will contact you as soon as possible.');
       
	    redirect( $this->home());      
    }
}

?>