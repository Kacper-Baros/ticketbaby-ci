<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

        public function __construct()
        {
                parent::__construct();

                $this->load->library("adminauthex");

                if( ! $this->adminauthex->logged_in())
                {
                    redirect('admin', 'admin/login');
                    exit;
                }
                
                //$this->load->model('events_model');
        }

        public function index()
        {
               //
        }

        public function orderConfirmation() {
        	ini_set("SMTP","mail.yourservergoeshere.com");
			ini_set("smtp_port","25");
			//add the recipient's address here
			$myemail = 'youremail@host.com';

			//grab named inputs from html then post to #thanks
			if (isset($_POST['name'])) {
			$name = strip_tags($_POST['name']);
			$email = strip_tags($_POST['email']);
			$message = strip_tags($_POST['message']);
			echo "<span class=\"alert alert-success\" >Your message has been received. Thanks! Here is what you submitted:</span><br><br>";
			echo "<stong>Name:</strong> ".$name."<br>";   
			echo "<stong>Email:</strong> ".$email."<br>"; 
			echo "<stong>Message:</strong> ".$message."<br>";

			//generate email and send!
			$to = $myemail;
			$email_subject = "Contact form submission: $name";
			$email_body = "You have received a new message. ".
			" Here are the details:\n Name: $name \n ".
			"Email: $email\n Message \n $message";
			$headers = "From: $myemail\n";
			$headers .= "Reply-To: $email";
			mail($to,$email_subject,$email_body,$headers);
        }

        
}