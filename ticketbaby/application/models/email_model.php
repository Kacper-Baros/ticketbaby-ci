<?php
class Email_model extends CI_Model {

    function __construct() {
        parent::__construct();
   $config = Array(
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
   
//   $config = Array(
//            'protocol' => 'smtp',
//            'smtp_host' => 'smtp.sendgrid.net',
//            'smtp_port' => 2525,
//            'smtp_user' => 'developersnepal',
//            'smtp_pass' => 'krishna@123',
//            'mailtype' => 'html',
//            'charset' => 'iso-8859-1'
//        );
//   
   
   
        $this->load->library('email', $config);
        $this->load->library('form_validation');
        $this->load->helper('file');
    }

    function send_email() {
        $data['session'] = $this->session->userdata('client');
        $session = $this->session->userdata('client');
        $this->email->from('noreply@ticketbaby.co.uk', 'Ticket Baby');
        $this->email->to($session['cardholder_email']);
        $this->email->bcc('sales@ticketbaby.co.uk, dean@vtelevision.co.uk');
        $this->email->reply_to('sales@ticketbaby.co.uk');
        $this->email->subject("Payment Detail");
        $msg = $this->load->view('email/payment_success',$data,TRUE);
        $this->email->message($msg);
        $this->email->send();
        $this->email->print_debugger();
        return true;
    }

function send_email_to($data) {
        

        $this->email->from('noreply@ticketbaby.co.uk', 'Ticket Baby');
        $this->email->to($data['tomail']);
        $this->email->bcc('sales@ticketbaby.co.uk, dean@vtelevision.co.uk');
        $this->email->reply_to('sales@ticketbaby.co.uk');
        $this->email->subject($data['subject']);
        
        $this->email->message($data['message']);
        $this->email->send();
        $this->email->print_debugger();
        return true;
    }  
   

}
