<?php
#defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('event_model');
                $this->load->model('music_model');
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
                $data['event_seats']  = $this->music_model->get_event_seats($event_id,$ticket_class_id);
                $array = array();

                $occupied_table_booked_details = $this->event_model->get_event_table_booked_details ($event_id, $ticket_class_id);
                $occupied_table_booked_details = $this->music_model->get_event_table_booked_details ($event_id, $ticket_class_id);
                $data['event_unavailable_seats']['occupied_table_booked_details'] = $occupied_table_booked_details;
                $missing_seat_numbers  = $this->event_model->get_event_missing_seats($event_id, $ticket_class_id);
                $missing_seat_numbers  = $this->music_model->get_event_missing_seats($event_id, $ticket_class_id);
                $data['event_unavailable_seats']['missing_seat_numbers']  = $missing_seat_numbers;      

                echo $this->load->view('event/select_seat', $data, true);
                exit;
        }

        public function setSessionCart() {

                $session_id = $this->session->userdata('session_id');
                $cart_session = $this->session->userdata('cart_session');

                if ( $this->input->server('REQUEST_METHOD') != 'POST' ) {
                        echo 'No direct script access allowed';
                        exit; 
                }

                $table_numbers          = $this->input->post('choose-table-number');
                $ticket_section_name    = $this->input->post('ticket_section_name');
                $event_id    = $this->input->post('event_id');
                $ticket_class_id    = $this->input->post('ticket_class_id');
                $ticket_section_section_id    = $this->input->post('ticket_section_section_id');
                $ticket_class_title    = $this->input->post('ticket_class_title');
                $unit_price    = $this->input->post('unit_price');
                $unit_min_purchase    = $this->input->post('unit_min_purchase');
                $ticket_class_class    = $this->input->post('ticket_class_class');
                $table_price    = $this->input->post('table_price');
                $table_seat_count    = $this->input->post('table_seat_count');
                $event_ticket    = $this->input->post('event_ticket');
                
                $unique_session_array_key = $ticket_class_class . "_" . $event_id .  "_" . $ticket_class_id; 

                
                $array = array("{$unique_session_array_key}" => array(
                                'event_id' => $event_id,
                                'ticket_class_id'=> $ticket_class_id,
                                'ticket_section_section_id' => $ticket_section_section_id,
                                'ticket_class_title' => $ticket_class_title,
                                'unit_price' => $unit_price,
                                'unit_min_purchase' => $unit_min_purchase,
                                'ticket_class_class' => $ticket_class_class,
                                'ticket_section_name' => $ticket_section_name,
                                'table_price' => $table_price,
                                'table_seat_count' => $table_seat_count,
                                'event_ticket' => $event_ticket
                              )
                         );

                $selected_tables = array();
                foreach($table_numbers as $key=>$table_selected){

                        if ( $ticket_section_name == "table") {
                                $selected_tables[$key]["table_number"]  = $table_selected;        
                        }else{
                                $seat_qty = intval($this->input->post('choose-ticket-quantity-' . $table_selected));
                                if ( $seat_qty > 0 ) {
                                        $selected_tables[$key]["table_number"]  = $table_selected; 
                                        $selected_tables[$key]["seat_quantity"] = $seat_qty;       
                                }
                                        
                        }

                }

                $array["{$unique_session_array_key}"]["selected_tables"] = $selected_tables;

                $existing_data = $this->session->userdata('cart_session');  
                $existing_data["{$unique_session_array_key}"] = $array["{$unique_session_array_key}"];  
                $this->session->set_userdata('cart_session', $existing_data);

                /* Set Additonal Ticket Session ( for display purpose only ) */
                if ( $ticket_class_class == "after-party" ) {
                    $cart_additional_session = $this->session->userdata('cart_additional_session'); 
                    $cart_additional_session["after_party_ticket"] =  $array["{$unique_session_array_key}"];
                    $this->session->set_userdata('cart_additional_session', $cart_additional_session);
                }
               
                exit;
        }

        public function removeSessionCart() {

                if ( $this->input->server('REQUEST_METHOD') != 'POST' ) {
                        echo 'No direct script access allowed';
                        exit; 
                }

                $data_key          = $this->input->post('data_key');
                $existing_data = $this->session->userdata('cart_session');

                /* Remove Additonal Ticket Session  */
                if ( $existing_data["{$data_key}"]["ticket_class_class"] == "after-party" ) {
                    $this->session->unset_userdata('cart_additional_session');      
                }

                unset($existing_data["{$data_key}"]);
                $this->session->set_userdata('cart_session',$existing_data);

                if ( sizeof($existing_data) < 1 ) {
                    $this->session->unset_userdata('cart_captcha_session');      
                }

                exit;
        }

        public function getSessionCart() {   
            $data["cart_session"] = $this->session->userdata('cart_session');   
            echo json_encode( array("cart_session" => $this->load->view('cart/session_cart', $data, true)) );
            exit;
        }

        public function getSessionCartObjects() {   
            $data["cart_session"] = $this->session->userdata('cart_session');   
            echo json_encode($data["cart_session"]) . '[!!!]' .  $this->load->view('cart/session_cart', $data, true);
            exit;
        }


        public function setSessionCaptcha() {
			
					$cart_session            = $this->session->userdata('cart_session');
                    $cart_additional_session = $this->session->userdata('cart_additional_session');
                    if ( sizeof($cart_session ) > sizeof($cart_additional_session) ) {
                        $cart_captcha_session = $this->session->userdata('cart_captcha_session');  
                        $cart_captcha_session["g-recaptcha-response"]  = "TRUE";  
                        $cart_captcha_session["g-recaptcha-date-time"] = date("Y-m-d H:i:s");
                       // $cart_captcha_session["event_customer_details"]["customer_promo_code"] = $this->input->post('customer_promo_code');
					//	echo "<pre>";		print_r($this->input->post());die;
                        $this->session->set_userdata('cart_captcha_session', $cart_captcha_session);
                        echo json_encode( array("success" => "TRUE","message" => "Captcha has been set") );
                        exit; 
                    }else{
                        echo json_encode( array("success" => "FALSE","message" => "Please select any ticket") );
                        exit; 
                    }  
           /* $secret  = $this->config->item('recaptcha_secret_key');
            if ( isset($_POST['g-recaptcha-response']) ) {
                require(FCPATH . 'assets/recaptcha/autoload.php');
                $recaptcha = new \ReCaptcha\ReCaptcha($secret);
                $resp = $recaptcha->verify( $this->input->post('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);
                if ( $resp->isSuccess() ) {
                    $cart_session            = $this->session->userdata('cart_session');
                    $cart_additional_session = $this->session->userdata('cart_additional_session');
                    if ( sizeof($cart_session ) > sizeof($cart_additional_session) ) {
                        $cart_captcha_session = $this->session->userdata('cart_captcha_session');  
                        $cart_captcha_session["g-recaptcha-response"]  = "TRUE";  
                        $cart_captcha_session["g-recaptcha-date-time"] = date("Y-m-d H:i:s");
                        $cart_captcha_session["event_customer_details"]["customer_promo_code"] = $this->input->post('customer_promo_code');
                        $this->session->set_userdata('cart_captcha_session', $cart_captcha_session);
                        //print_r($this->input->post());
						echo json_encode( array("success" => "TRUE","message" => "Captcha has been set") );
                        exit; 
                    }else{
                        echo json_encode( array("success" => "FALSE","message" => "Please select any ticket") );
                        exit; 
                    }     
                }else{
                    echo json_encode( array("success" => "FALSE","message" => "You can't leave Captcha Code empty!") );
                    exit;
                }
            }
            echo json_encode( array("success" => "FALSE","message" => "You can't leave Captcha Code empty!") );
            exit;*/
        }
		
		
		public function add_event_promo_code_in_session(){
			$cart_captcha_session =  $this->session->userdata('cart_user_session');
			$cart_captcha_session["event_customer_details"]["customer_promo_code"] = $this->input->post('event_promo_code');
			$cart_captcha_session["event_customer_details"]["postage_details"] = $this->input->post('postage_type');
			$this->session->set_userdata('cart_captcha_session', $cart_captcha_session);
			$cart_user_session =  $this->session->userdata('cart_user_session');
			
			//echo "<pre>";print_r($cart_user_session);		
			return $cart_user_session;	
		}
		


        public function timeOutCart() {
            if ( $this->input->server('REQUEST_METHOD') != 'POST' ) {
                    echo 'No direct script access allowed';
                    exit; 
            }

            $cart_captcha_session = $this->session->userdata('cart_captcha_session'); 

            $cart_captcha_time_difference = strtotime(date("Y-m-d H:i:s")) - strtotime($cart_captcha_session['g-recaptcha-date-time']);
            $cart_captcha_time_remaining  = $this->config->item('cart_time_out') - $cart_captcha_time_difference;

            if ( intval( $cart_captcha_time_remaining ) < 1 ) {
                $this->session->unset_userdata('cart_session');
                $this->session->unset_userdata('cart_additional_session');
                $this->session->unset_userdata('cart_captcha_session');
                $this->session->unset_userdata('cart_user_session');
                echo "TRUE";
            }else{
                echo "FALSE";
            }
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
	
	
      /*  public function registerCustomerNew() {
            if ( $this->input->server('REQUEST_METHOD') != 'POST' ) {
                    echo 'No direct script access allowed';
                    
					exit; 
            }
if(isset($_POST['Submits']))
{
            $first_name            = $this->input->post('first_name');
            $last_name      	   = $this->input->post('last_name');
            $email      		   = $this->input->post('email');
            $address      		   = $this->input->post('address');
            $area      		       = $this->input->post('area');
            $city      		       = $this->input->post('city');
            $post_code      	   = $this->input->post('post_code');
            $country      		   = $this->input->post('country');
            $mobile_number         = $this->input->post('mobile_number');
            $password        	   = $this->input->post('password');
            $confirm_password      = $this->input->post('confirm_password');
			

            $this->load->model('Music_model');
 
            $arrays = $this->Music_model->registerUserNew(array("first_name" => $first_name, "last_name" => $last_name, "email" => $email,"address" => $address, "area" => $area ,"city" => $city ,"post_code" => $post_code,"country" => $country,"phone" => $phone, "password" => $password", confirm_password" => $confirm_password));

			print_r ($arrays);
            exit;
      }  }*/
		
	/*
	** New Session set 14-Oct-2015
	*/
	   public function setSessionCartNew() {
						
                $session_id 	= $this->session->userdata('session_id');
                $cart_session 	= $this->session->userdata('cart_session');
			
                if ( $this->input->server('REQUEST_METHOD') != 'POST' ) {
                        echo 'No direct script access allowed';
                        exit; 
                }
			
				$count	=	count($this->input->post('ticket_section_name'));
				
				
				for($i=0; $i<$count; $i++ ){
					$table_numbers_ar          	= 	$this->input->post('choose-table-number');
					$table_numbers				=	$table_numbers_ar[$i];
					$ticket_section_name_ar	   	= 	$this->input->post('ticket_section_name');
					$ticket_section_name		=	$ticket_section_name_ar[$i];
					$event_id    				= 	$this->input->post('event_id');
					$event_id					=	$event_id[$i];
					$ticket_class_id    		= 	$this->input->post('ticket_class_id');
					$ticket_class_id			=	$ticket_class_id[$i];
					$ticket_section_section_id  = 	$this->input->post('ticket_section_section_id');
					$ticket_section_section_id	=	$ticket_section_section_id[$i];
					$ticket_class_title   		= 	$this->input->post('ticket_class_title');
					$ticket_class_title			=	$ticket_class_title[$i];
					$unit_price    				= 	$this->input->post('unit_price');
					$unit_price					=	$unit_price[$i];
					$unit_min_purchase    		= 	$this->input->post('unit_min_purchase');
					$unit_min_purchase			=	$unit_min_purchase[$i];
					$ticket_class_class    		= 	$this->input->post('ticket_class_class');
					$ticket_class_class			=	$ticket_class_class[$i];
					$table_price    			= 	$this->input->post('table_price');
					$table_price				=	$table_price[$i];
					$table_seat_count    		= 	$this->input->post('table_seat_count');
					$table_seat_count			=	$table_seat_count[$i];
					$event_ticket   			= 	$this->input->post('event_ticket');
					$event_ticket				=	$event_ticket[$i];
					$quantity		   			= 	$this->input->post('quantity');
				
					$quantity					=	$quantity[$i];
					if($quantity >0 && $quantity < $table_seat_count){
						  $unique_session_array_key = $ticket_class_class . "_" . $event_id .  "_" . $ticket_class_id; 
				
						if($quantity <= $table_seat_count){
						
							$array = array("{$unique_session_array_key}" => array(
											'event_id' => $event_id,
											'ticket_class_id'=> $ticket_class_id,
											'ticket_section_section_id' => $ticket_section_section_id,
											'ticket_class_title' => $ticket_class_title,
											'unit_price' => $unit_price,
											'unit_min_purchase' => $unit_min_purchase,
											'ticket_class_class' => $ticket_class_class,
											'ticket_section_name' => $ticket_section_name,
											'table_price' => $table_price,
											'table_seat_count' => $table_seat_count,
											'event_ticket' => $event_ticket
										  )
									 );

							$selected_tables = array();
							$selected_tables[0]["table_number"]		=	1;
							$selected_tables[0]["seat_quantity"]	=	$quantity;
							$array["{$unique_session_array_key}"]["selected_tables"] = $selected_tables;

							$existing_data = $this->session->userdata('cart_session');  
							$existing_data["{$unique_session_array_key}"] = $array["{$unique_session_array_key}"];  
							$this->session->set_userdata('cart_session', $existing_data);

							/* Set Additonal Ticket Session ( for display purpose only ) */
							if ( $ticket_class_class == "after-party" ) {
								$cart_additional_session = $this->session->userdata('cart_additional_session'); 
								$cart_additional_session["after_party_ticket"] =  $array["{$unique_session_array_key}"];
								$this->session->set_userdata('cart_additional_session', $cart_additional_session);
							}
					}
					
					
				}
				}
                
               
				   /* foreach($table_numbers as $key=>$table_selected){

							if ( $ticket_section_name == "table") {
									$selected_tables[$key]["table_number"]  = $table_selected;        
							}else{
									$seat_qty = intval($this->input->post('choose-ticket-quantity-' . $table_selected));
									if ( $seat_qty > 0 ) {
											$selected_tables[$key]["table_number"]  = $table_selected; 
											$selected_tables[$key]["seat_quantity"] = $seat_qty;       
									}
											
							}

					}*/

					
               
                exit;
        }
}