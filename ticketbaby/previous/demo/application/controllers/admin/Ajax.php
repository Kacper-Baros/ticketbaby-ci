<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

        public function __construct()
        {
                parent::__construct();

                $this->load->library("adminauthex");

                if( ! $this->adminauthex->logged_in())
                {
                    redirect('admin', 'admin/login');
                    exit;
                }         
        }

        public function index() {
                echo 'No direct script access allowed';
                exit;
        }



        public function getSeatAvailability() {
                if ( $this->input->server('REQUEST_METHOD') != 'POST' ) {
                        echo 'No direct script access allowed';
                        exit; 
                }
                $event_id        = $this->input->post('event_id');
                $ticket_class_id = $this->input->post('ticket_class_id');
                $ticket_section  = $this->input->post('section');

                $data['post_var']     = array('event_id' => $event_id, 'ticket_class_id'=> $ticket_class_id, 'ticket_section' => $ticket_section);
                $data['event_seats']  = $this->event_model->get_event_seats($event_id,$ticket_class_id);
                $array = array();

                $occupied_table_booked_details = $this->event_model->get_event_table_booked_details ($event_id, $ticket_class_id);
                $data['event_unavailable_seats']['occupied_table_booked_details'] = $occupied_table_booked_details;
                $missing_seat_numbers  = $this->event_model->get_event_missing_seats($event_id, $ticket_class_id);
                $data['event_unavailable_seats']['missing_seat_numbers']  = $missing_seat_numbers;      

                echo $this->load->view('event/select_seat', $data, true);
                //echo json_encode($data["cart_session"]) . '[!!!]' .  $this->load->view('cart/session_cart', $data, true);
                //echo json_encode( array("success" => "TRUE","message" => "Captcha has been set") );
                exit;
        }




        public function registerCustomer() {
            if ( $this->input->server('REQUEST_METHOD') != 'POST' ) {
                    echo 'No direct script access allowed';
                    exit; 
            }

            $customer_name          = $this->input->post('customer_name');
            $customer_email         = $this->input->post('customer_email');
            $customer_password      = $this->input->post('customer_password');

            $this->load->model('user_model');

            $array = $this->user_model->registerUser(array("email" => $customer_email, "first_name" => $customer_name, "password" => $customer_password));

            echo json_encode($array);
            exit;
        }


}