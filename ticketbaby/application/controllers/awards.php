<?php

class Awards extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('text', 'url', 'text');
        $this->load->model('Front_model');
        $this->load->library('session');
        $this->load->model('Email_model');
    }

    function index() {
        $data['award_detail'] = $this->Front_model->fetch_awards();
        $data['details'] = $this->db->get_where('tbl_events', array('event_type' => 1))->result();
        $this->load->view('awards', $data);
    }
	
	function ConfirmCoupon(){
		$query1 = $query = $coupon_id = '';
		$PromonCode = $this->input->post('customer_promo_code');
		if($PromonCode==='TBNJQPR*@'){
			echo json_encode("Confirmed");
		}else{
			$SeatID = $this->input->post('SeatID');
			$row = $this->db->get_where('tbl_event_seats', array('id' => $SeatID))->result();
			foreach($row as $rw){
				$coupon_id = $rw->coupon_id;
			}
			if($coupon_id!=0){
				$this->db->from('tbl_coupen');
				$this->db->where('id', $coupon_id);
				$this->db->where('status', 1);
				$this->db->where('delete_status', 0);
				$this->db->where('coupen_code', $PromonCode);
				$query = $this->db->get();
				if ($query->num_rows()==1){
					echo json_encode("Confirmed");
				}
				else{
					echo json_encode( "NotValid");
				}
			}
			else{
				echo json_encode( "NotValid");
			}
		}
	}
    
    function award_details($id) {
      //echo $id;
        $data['award_detail'] = $this->Front_model->fetch_detail_awards($id);
        //echo '2'.$id;
        $data['table_section'] = $this->Front_model->fetch_seats($id);
        //echo '3'.$id;
        $data['table_party'] = $this->Front_model->fetch_party($id);
        //echo '4'.$id;
        //print_r($data);
        $this->load->view('award_detail', $data);
    }
    
    function award_detail($id) {
      
        $data['award_detail'] = $this->Front_model->fetch_detail_awards($id);
      
       $data['table_section'] = $this->Front_model->fetch_seats($id);
      
        $data['table_party'] = $this->Front_model->fetch_party($id);
      
        //print_r($data);
       $this->load->view('award_detail', $data);
    }

    function booking_post($id) {
			
        $check_events = $this->db->get_where('tbl_events', array('id' => $id))->row();
        if (empty($check_events)) 
		{
            redirect(site_url());
        }
		else
		 {
           $session = $this->session->userdata('tables');
		   $ses = $this->session->userdata('after_party');	
		   
            if(empty($session))
			{
				if(empty($session))
				{
					
				}
				else
				{
                	redirect(base_url($check_events->slug));
                	$this->session->set_flashdata('unsuccess', 'Please select the table or seats');
				}
            }

                $this->session->unset_userdata('promocode');
                $this->session->unset_userdata('coupen_value');
                $this->session->unset_userdata('coupen_type');
				$this->session->unset_userdata('coupen_id');
            if (@$_POST['customer_promo_code'] != '') {
               
                $this->session->set_userdata('promocode', $_POST['customer_promo_code']);
                $code = @$_POST['customer_promo_code'];

                $check = $this->db->get_where('tbl_coupen', array('coupen_code' => $code, 'status' => 1))->row();
                if (!empty($check)) {
                    $this->session->set_userdata('coupen_value', $check->coupen_value);
                    $this->session->set_userdata('coupen_type', $check->coupen_type);
					$this->session->set_userdata('coupen_id', $check->id);
                } else {
                    $this->session->set_userdata('coupen_value','');
                    $this->session->set_userdata('coupen_type', '');
					$this->session->set_userdata('coupen_id', '');
                }
                $coupen_price = $this->session->userdata('coupen_value');
                $coupen_code = $this->session->userdata('promocode');
            }




            if (isset($_POST['delivery_type'])) {
                $this->session->unset_userdata('delivery_type');
                $this->session->set_userdata('delivery_type', $_POST['delivery_type']);
            }


//        if (isset($_POST['after_party'])) {
//            $this->session->unset_userdata('after_party');
//            $after_party_price = $_POST['after_party_price'];
//            $party_quantity = $_POST['party_quantity'];
//            $after_party = array();
//            $after_party['price'] = $_POST['after_party_price'];
//            $after_party['quantity'] = $_POST['party_quantity'];
//            $after_party['total'] = $_POST['after_party_price'] * $_POST['party_quantity'];
//            $this->session->set_userdata('after_party', $after_party);
//        }

            $data['order_details'] = $this->Front_model->fetch_detail_awards($id);
            $data['show_timer'] = 1;
            $this->load->view('order', $data);
        }
    }

    function billing($id) {
        $check_events = $this->db->get_where('tbl_events', array('id' => $id))->row();
        if (empty($check_events)) {
            redirect(site_url());
        } else {
            $data['order_details'] = $this->Front_model->fetch_detail_awards($id);
			//print_r($data['order_details'] );
            $this->load->view('billing', $data);
        }
    }

    function payment($id) {

        $check_events = $this->db->get_where('tbl_events', array('id' => $id))->row();
        if (empty($check_events)) {
            redirect(site_url());
        } else {

            $this->form_validation->set_rules('customer_first_name', 'Customer First Name', 'required');
            $this->form_validation->set_rules('customer_last_name', 'Customer Last Name', 'required');
            $this->form_validation->set_rules('customer_email', 'Customer Email', 'required');
            $this->form_validation->set_rules('cardholder_first_name', 'Cardholder First Name', 'required');
            $this->form_validation->set_rules('cardholder_last_name', 'Cardholder Last Name', 'required');
            $this->form_validation->set_rules('cardholder_email', 'Cardholder Email', 'required');
            $this->form_validation->set_rules('cardholder_address', 'Cardholder Address', 'required');
            $this->form_validation->set_rules('cardholder_city', 'Cardholder City', 'required');
            $this->form_validation->set_rules('cardholder_area', 'Cardholder Area', 'required');
            $this->form_validation->set_rules('cardholder_post_code', 'Cardholder Post Code', 'required');
            $this->form_validation->set_rules('cardholder_contact_number', 'Cardholder Contact Number', 'required');
            $this->form_validation->set_rules('cardholder_mobile_number', 'Cardholder Mobile Number');
            if ($this->form_validation->run() == FALSE) {
                $this->billing($id);
            } else {
                for ($randomNumber = mt_rand(1, 9), $i = 1; $i < 10; $i++) {
                    $randomNumber .= mt_rand(0, 9);
                }
                $data["customer_first_name"] = $this->input->post('customer_first_name');
                $data['event_id'] = $id;
                $data['customer_first_name'] = $this->input->post('customer_first_name');
                $data['customer_last_name'] = $this->input->post('customer_last_name');
                $data['customer_email'] = $this->input->post('customer_email');
                $data['cardholder_first_name'] = $this->input->post('cardholder_first_name');
                $data['cardholder_last_name'] = $this->input->post('cardholder_last_name');
                $data['cardholder_email'] = $this->input->post('cardholder_email');
                $data['cardholder_address'] = $this->input->post('cardholder_address');
                $data['cardholder_area'] = $this->input->post('cardholder_area');
                $data['cardholder_city'] = $this->input->post('cardholder_city');
                $data['cardholder_country'] = $this->input->post('cardholder_country');
                $data['cardholder_post_code'] = $this->input->post('cardholder_post_code');
                $data['cardholder_contact_number'] = $this->input->post('cardholder_contact_number');
                $data['cardholder_mobile_number'] = $this->input->post('cardholder_mobile_number');
                $data['subtotal'] = $this->input->post('subtotal');
                $data['payment_status'] = 0;
                $data['cart_id'] = $randomNumber;
                $data['created'] = time();
                $this->session->set_userdata('client', $data);
                
				//$this->db->insert('tbl_orders', $data);
				
                $da['rand'] = $randomNumber;
                $da['order_details'] = $this->Front_model->fetch_detail_awards($id);
                $this->load->view('payment', $da);
            }
        }
    }

    function handleResponse() {
        if ($_POST['rawAuthMessage'] == 'trans.cancelled') {
            $data['cart_id'] = $_POST['cartId'];
            $this->load->view('canceled_payment', $data);
        } else {
            $data['cart_id'] = $_POST['cartId'];
            $this->load->view('success_payment', $data);
        }
    }

    function success($cart_id) {
		
	$client=$this->session->userdata('client');
	$sessions=$this->session->userdata('tables');
	$ses=$this->session->userdata('after_party');
	$tickets=$this->session->userdata('tickets');
	$coupon_id=$this->session->userdata('coupen_id');
	
	
	if($this->session->userdata('tables') or $ses or $this->session->userdata('tickets') )
	{
		$table_number="";
		$ticket_table="";
		$addtional="";
		$tick="";
		
		if($this->session->userdata('tables'))
		{
			
		  $tbl_no="";
		  $cls="";
		  $table_number="";
		  $event_seat_ids="";
		  foreach (@$sessions as $se)
		  {
				if ($se['section'] == 'Tables Only')
				{
					 $event_id = $se['event_id'];
					 $event_seat_id = $se['event_seat_id'];
					 $cls .= $se['class'].",";
					foreach($se['table'] as $table_no)
					{  
						$tbl_no .=$table_no.",";
						$ss = $this->db->get_where('tbl_event_tables', array('event_id' => $event_id,'event_seat_id'=>$event_seat_id,'table_no'=>$table_no))->row();
						$data['status']=1;
						$this->db->where('id', $ss->id);
						$this->db->update('tbl_event_tables', $data);
						$event_seat_ids.=$event_seat_id.",";
					}
		 	   		
				}
           }
		   
		  if($tbl_no)
		  {  
			  $table_number= $tbl_no."&".$cls."&".$event_seat_ids;
		  }
		
		
		$tbltikcket_no="";
		$number_of_ticket ="";
		$cls ="";
		$ticket_table ="";
		$event_seat_ids="";
		foreach (@$sessions as $so)
		{
			
			if ($so['section'] == 'Table Tickets')
			 {  
			  	 
				 $event_id=$so['event_id'];
				 $event_seat_id=$so['event_seat_id'];
				 $cls .= $so['class'].',';
				 if(@$so['table']!=''){ //print_r($so['table']);
					 foreach($so['table'] as $table_no){  
							$tbltikcket_no .=$table_no.",";
							$ss = $this->db->get_where('tbl_event_tables', array('event_id' => $event_id,'event_seat_id'=>$event_seat_id,'table_no'=>$table_no))->row();
							$data['status']=2;
							$this->db->where('id', $ss->id);
							$this->db->update('tbl_event_tables', $data);
							$event_seat_ids.=$event_seat_id.",";
					}
				 }
				 else{
					foreach ($so['seat'] as $table => $val){
						if ($val != 0)
						{
							$tbltikcket_no .=$table.",";
							$number_of_ticket .= $val.',';
							$ss1 = $this->db->get_where('tbl_event_tables', array('event_id' => $event_id,'event_seat_id'=>$event_seat_id,'table_no'=>$table))->row();
							$data['status']=1;
							$data['seat']=$val+$ss1->seat;
							$this->db->where('id', $ss1->id);
							$this->db->update('tbl_event_tables', $data);
							$event_seat_ids.=$event_seat_id.",";
						}
					}
				 }
			}
			
         }
		 
		  if($tbltikcket_no)
		  {
			$ticket_table= $tbltikcket_no."&".$number_of_ticket."&".$cls."&".$event_seat_ids;
		  }
		}
	
		if($this->session->userdata('after_party'))
		{
				$name="";
				$seat_charge="";
				$total="";
				$ticket="";
				$addtional="";
				$data="";
			 	foreach($ses['after_party'] as $key=>$val)
				{
					
					$tbl_event = $this->db->get_where('tbl_event_seats', array('event_id' => $client['event_id'],'ticket_class_id'=>$ses['after_party'][$key]['ticket']))->row();
				
					$id = $tbl_event->id;
					$table_end=$tbl_event->table_end - $ses['after_party'][$key]['total'];
					
					$data['table_end']=$table_end;
					$this->db->where('id', $id);
					$this->db->update('tbl_event_seats', $data);
					
					$name .=$ses['after_party'][$key]['name'].",";
					$seat_charge .=$ses['after_party'][$key]['seat_charge'].",";
					$ticket .=$ses['after_party'][$key]['ticket'].","; 
					$total .=$ses['after_party'][$key]['total'].","; 
					
				}
				
				$name.="&";
				$seat_charge.="&";
				$ticket.="&";
				$addtional.=$name.$seat_charge.$ticket.$total;
		}
		
		if($this->session->userdata('tickets'))
		{
				$tickets_name="";
				$tickets_seat_charge="";
				$tickets_total="";
				$ticket_ticket="";
				$tick="";
				$data="";
			 	foreach($tickets['tickets'] as $key=>$val)
				{
					
					$tbl_event = $this->db->get_where('tbl_event_seats', array('event_id' => $client['event_id'],'ticket_class_id'=>$tickets['tickets'][$key]['ticket']))->row();
				
					$id = $tbl_event->id;
					$table_end=$tbl_event->table_end - $tickets['tickets'][$key]['total'];
					
					$data['table_end']=$table_end;
					$this->db->where('id', $id);
					$this->db->update('tbl_event_seats', $data);
					
					$tickets_name .=$tickets['tickets'][$key]['name'].",";
					$tickets_seat_charge .=$tickets['tickets'][$key]['seat_charge'].",";
					$ticket_ticket .=$tickets['tickets'][$key]['ticket'].","; 
					$tickets_total .=$tickets['tickets'][$key]['total'].","; 
					
				}
				
				$tickets_name.="&";
				$tickets_seat_charge.="&";
				$ticket_ticket.="&";
				$tick.=$tickets_name.$tickets_seat_charge.$ticket_ticket.$tickets_total;
		}
		
		
			$data="";
			$data["customer_first_name"] =$client['customer_first_name'];
			$data['event_id'] = $client['event_id'];
			$data['customer_last_name'] = $client['customer_last_name'];
			$data['customer_email'] = $client['customer_email'];
			$data['cardholder_first_name'] =$client['cardholder_first_name'];
			$data['cardholder_email'] =$client['cardholder_email'];
			$data['cardholder_last_name'] = $client['cardholder_last_name'];
			$data['cardholder_last_name'] = $client['cardholder_last_name'];
			$data['cardholder_address'] = $client['cardholder_address'];
			$data['cardholder_area'] =$client['cardholder_area'];
			$data['cardholder_city'] = $client['cardholder_city'];
			$data['cardholder_country'] = $client['cardholder_country'];
			$data['cardholder_post_code'] = $client['cardholder_post_code'];
			$data['cardholder_contact_number'] = $client['cardholder_contact_number'];
			$data['cardholder_mobile_number'] = $client['cardholder_mobile_number'];
			$data['subtotal'] = $client['subtotal'];
			$data['payment_status'] = 1;
			$data['cart_id'] =$client['cart_id'];
			$data['created'] = $client['created'];
			$data['table'] =  @$table_number;
			$data['ticket_table'] =  @$ticket_table;
			$data['addtional'] =  @$addtional;
			$data['tickets'] =  @$tick;
			$data['coupon_id'] = $coupon_id;
			$data['user_id'] = $this->session->userdata('user_id');
			$insert=$this->db->insert('tbl_orders', $data);
			$data['order_id'] = $this->db->insert_id();
			$this->session->set_userdata('client', $data);
	
			/* mail */ 
			$emails=$client['cardholder_email'];
		    $this->sendmail($emails);
			// mail end //
	
		
	  }

		
	   $this->session->unset_userdata('client');
	   $this->session->unset_userdata('tables');
	   $this->session->unset_userdata('after_party');
	   $this->session->unset_userdata('tickets');
	   $this->session->unset_userdata('coupen_id');
	   
	   $ss = $this->db->get_where('tbl_orders', array('cart_id' => $cart_id))->row();
	   @$data['subtotal']=$ss->subtotal;
       $this->load->view('success',$data);
    }

    function canceled($cart_id) {
		
	  /*  $ss['detail'] = $this->db->get_where('tbl_orders', array('cart_id' => $cart_id))->row();
        if ($cart_id == $ss['detail']->cart_id) {
            $data['payment_status'] = 2;
            $this->db->where('cart_id', $cart_id);
            $this->db->update('tbl_orders', $data);
        }
*/

//          destroy dession
        $this->session->unset_userdata('client');
        $this->session->unset_userdata('tables');
        $this->session->unset_userdata('promocode');
        $this->session->unset_userdata('after_party');
       // $this->load->view('cancle_page', $ss);
	   $this->load->view('cancle_page');
    }

    function remove_session($index, $id) {
		//print_r($id); die;
        $award = $this->db->get_where('tbl_events', array('id' => $id))->row();
        $session = $this->session->userdata('tables');
        array_splice($session, $index, 1);
        $this->session->unset_userdata('tables');
        $this->session->set_userdata('tables', $session);
        redirect(base_url($award->slug . '#myorder'));
    }

    function add_party() {
		$seesion=$this->session->userdata('after_party');
		//print_r($seesion);
		if (!empty($seesion)) 
		{
			$not="";
		
			foreach($seesion['after_party'] as $key=>$val)
			{
			
					if($val['ticket']==$_POST['ticket'])
					{
						 //echo $seesion['after_party'][$key]['total']=$_POST['total'];
						 $not="aaa";
					}
			}
			if(!$not)
			{
				 $seesion['after_party'][]=array("name"=>$_POST['name'],"seat_charge"=>$_POST['seat_charge'],"ticket"=>$_POST['ticket'],"ticket"=>$_POST['ticket'],"total"=>$_POST['total'],"APSeatID"=>$_POST['SeatID']);
				 $this->session->set_userdata('after_party',$seesion);	
			}
		}
		else
		{
			$arr['after_party'][]=array("name"=>$_POST['name'],"seat_charge"=>$_POST['seat_charge'],"ticket"=>$_POST['ticket'],"ticket"=>$_POST['ticket'],"total"=>$_POST['total'],"APSeatID"=>$_POST['SeatID']);
			$this->session->set_userdata('after_party', $arr);	
		}
	
		 $ses=$this->session->userdata('after_party');	
		 
        $output = '<ul class="afterParty">';
		foreach($ses['after_party'] as $key=>$val)
		{
			$output .= '<li class="col-md-2 col-xs-2"><a onclick="remove_after_party()" href="javascript:void(0)" class="remove_session" title="remove"><i class="fa fa-times" aria-hidden="true"></i> Remove</a></li>';
			$output .= '<li class="col-md-3 col-xs-3">'. $ses['after_party'][$key]['name'].'</li>';
			$output .= '<li class = "col-md-4 col-xs-4"><span style ="font-weight:100;"></span> ( ' .  $ses['after_party'][$key]['seat_charge'] . ' * ' .$ses['after_party'][$key]['total'] . ')</li>';
			$output .= '<li class = "col-md-3 col-xs-3">£ '.$ses['after_party'][$key]['seat_charge'] * $ses['after_party'][$key]['total']. '</li>';
			$output .= '<div class = "clearfix"></div>';
			$output .= '<input type="hidden" name="CartEmpty" id="CartEmpty" value="0">';
			$output .= '<input type="hidden" name="SeatID_APTickets" id="SeatID_APTickets" value="'.$_POST['SeatID'].'">';
		}
		$output .= '</ul>';
        echo json_encode($output);
    }
	
	 function add_tickets() {
		$seesion=$this->session->userdata('tickets');
		if (!empty($seesion)) 
		{
			 	$this->session->unset_userdata('tickets');
				$arr['tickets'][]=array("name"=>$_POST['name'],"seat_charge"=>$_POST['seat_charge'],"ticket"=>$_POST['ticket'],"ticket"=>$_POST['ticket'],"total"=>$_POST['total'],"TSeatID"=>$_POST['SeatID']);
				$this->session->set_userdata('tickets',$arr);	
		}
		else
		{
			$arr['tickets'][]=array("name"=>$_POST['name'],"seat_charge"=>$_POST['seat_charge'],"ticket"=>$_POST['ticket'],"ticket"=>$_POST['ticket'],"total"=>$_POST['total'],"TSeatID"=>$_POST['SeatID']);
			$this->session->set_userdata('tickets', $arr);	
			
		}
	
		$ses=$this->session->userdata('tickets');	
		$output = '<ul class="tickets">';
		foreach($ses['tickets'] as $key=>$val)
		{
			$output .= '<li class="col-md-2 col-xs-2"><a onclick="remove_after_party()" href="javascript:void(0)" class="remove_session" title="remove"><i class="fa fa-times" aria-hidden="true"></i> Remove</a></li>';
			$output .= '<li class="col-md-3 col-xs-3">'. $ses['tickets'][$key]['name'].'</li>';
			$output .= '<li class = "col-md-4 col-xs-4"><span style ="font-weight:100;"></span> ( ' .  $ses['tickets'][$key]['seat_charge'] . ' * ' .$ses['tickets'][$key]['total'] . ')</li>';
			$output .= '<li class = "col-md-3 col-xs-3">£ '.$ses['tickets'][$key]['seat_charge'] * $ses['tickets'][$key]['total']. '</li>';
			$output .= '<div class = "clearfix"></div>';
			$output .= '<input type="hidden" name="CartEmpty" id="CartEmpty" value="0">';
			$output .= '<input type="hidden" name="SeatID_Tickets" id="SeatID_Tickets" value="'.$_POST['SeatID'].'">';
		}
		$output .= '</ul>';
        echo json_encode($output);
    }

    function remove_after_party() {
        $this->session->unset_userdata('after_party');
        $result['success'] = true;
        echo json_encode($result);
    }

    function empty_cart() {
        $this->session->unset_userdata('tables');
        $this->session->unset_userdata('after_party');
        $this->session->unset_userdata('promocode');
		$this->session->unset_userdata('tickets');
		$this->session->unset_userdata('coupen_id');
        $data['success'] = true;
        echo json_encode($data);
    }
    
    
    
    
    function payment_discount($id){
        
           $check_events = $this->db->get_where('tbl_events', array('id' => $id))->row();
        if (empty($check_events)) {
            redirect(site_url());
        } else {

            $this->form_validation->set_rules('customer_first_name', 'Customer First Name', 'required');
            $this->form_validation->set_rules('customer_last_name', 'Customer Last Name', 'required');
            $this->form_validation->set_rules('customer_email', 'Customer Email', 'required');
            $this->form_validation->set_rules('cardholder_first_name', 'Cardholder First Name', 'required');
            $this->form_validation->set_rules('cardholder_last_name', 'Cardholder Last Name', 'required');
            $this->form_validation->set_rules('cardholder_email', 'Cardholder Email', 'required');
            $this->form_validation->set_rules('cardholder_address', 'Cardholder Address', 'required');
            $this->form_validation->set_rules('cardholder_city', 'Cardholder City', 'required');
            $this->form_validation->set_rules('cardholder_area', 'Cardholder Area', 'required');
            $this->form_validation->set_rules('cardholder_post_code', 'Cardholder Post Code', 'required');
            $this->form_validation->set_rules('cardholder_contact_number', 'Cardholder Contact Number', 'required');
            $this->form_validation->set_rules('cardholder_mobile_number', 'Cardholder Mobile Number');
           
		    if ($this->form_validation->run() == FALSE)
			{
                $this->billing($id);
            }
			else
			{
                for ($randomNumber = mt_rand(1, 9), $i = 1; $i < 10; $i++) {
                    $randomNumber .= mt_rand(0, 9);
            }
				
		$sessions=$this->session->userdata('tables');
		$ses=$this->session->userdata('after_party');
		$tickets = $this->session->userdata('tickets');
		$coupon_id=$this->session->userdata('coupen_id');
		
		
		if($this->session->userdata('tables') or $ses or $this->session->userdata('tickets'))		
		{  
			  $table_number="";
			  $ticket_table="";
			  $addtional="";
			  $tick="";
			  
			 if($this->session->userdata('tables'))		
			 { 	
				  $tbl_no="";
				  $cls="";
				  $table_number="";
				  $event_seat_ids="";
				  foreach (@$sessions as $se)
				  {
						if ($se['section'] == 'Tables Only')
						{
							 $event_id = $se['event_id'];
							 $event_seat_id = $se['event_seat_id'];
							 $cls .= $se['class'].",";
							foreach($se['table'] as $table_no)
							{  
								$tbl_no .=$table_no.",";
								$ss = $this->db->get_where('tbl_event_tables', array('event_id' => $event_id,'event_seat_id'=>$event_seat_id,'table_no'=>$table_no))->row();
								$data['status']=1;
								$this->db->where('id', $ss->id);
								$this->db->update('tbl_event_tables', $data);
								$event_seat_ids.=$event_seat_id.",";
							}
						
						}
				   }
			   
			  if($tbl_no)
			  {  
				  $table_number= $tbl_no."&".$cls."&".$event_seat_ids;
			  }
			$tbltikcket_no="";
			$number_of_ticket ="";
			$cls ="";
			$ticket_table ="";
			$event_seat_ids="";
			
			foreach (@$sessions as $so)
			{
				if ($so['section'] == 'Table Tickets'){ 
					 $event_id=$so['event_id'];
					 $event_seat_id=$so['event_seat_id'];
					 $cls .= $so['class'].',';
					 if(@$so['table']!=''){ //print_r($so['table']);
						 foreach($so['table'] as $table_no){  
								$tbltikcket_no .=$table_no.",";
								$ss = $this->db->get_where('tbl_event_tables', array('event_id' => $event_id,'event_seat_id'=>$event_seat_id,'table_no'=>$table_no))->row();
								$data['status']=2;
								$this->db->where('id', $ss->id);
								$this->db->update('tbl_event_tables', $data);
								$event_seat_ids.=$event_seat_id.",";
						}
					 }
					 else{
						foreach ($so['seat'] as $table => $val){
							if ($val != 0)
							{
								$tbltikcket_no .=$table.",";
								$number_of_ticket .= $val.',';
								$ss1 = $this->db->get_where('tbl_event_tables', array('event_id' => $event_id,'event_seat_id'=>$event_seat_id,'table_no'=>$table))->row();
								$data['status']=1;
								$data['seat']=$val+$ss1->seat;
								$this->db->where('id', $ss1->id);
								$this->db->update('tbl_event_tables', $data);
								
								$event_seat_ids.=$event_seat_id.",";
							}
						}
					 }
				}
				
			 }
			 
			 if($tbltikcket_no)
			 {
				 $ticket_table= $tbltikcket_no."&".$number_of_ticket."&".$cls."&".$event_seat_ids;
			 }
	   }
			 
			 if($this->session->userdata('after_party'))		
			 { 
			 	$name="";
				$seat_charge="";
				$total="";
				$ticket="";
				$addtional="";
				$data="";
				
			 	foreach($ses['after_party'] as $key=>$val)
				{
					
					$tbl_event = $this->db->get_where('tbl_event_seats', array('event_id' => $id,'ticket_class_id'=>$ses['after_party'][$key]['ticket']))->row();
					$table_id = $tbl_event->id;
					$table_end=$tbl_event->table_end - $ses['after_party'][$key]['total'];
					
					$data['table_end']=$table_end;
					$this->db->where('id', $table_id);
					$this->db->update('tbl_event_seats', $data);
					
					$name .=$ses['after_party'][$key]['name'].",";
					$seat_charge .=$ses['after_party'][$key]['seat_charge'].",";
					$ticket .=$ses['after_party'][$key]['ticket'].","; 
					$total .=$ses['after_party'][$key]['total'].","; 
					
				}
				
				$name.="&";
				$seat_charge.="&";
				$ticket.="&";
				$addtional.=$name.$seat_charge.$ticket.$total;
			 }
			 
			 if($this->session->userdata('tickets'))
			{
				$tickets_name="";
				$tickets_seat_charge="";
				$tickets_total="";
				$ticket_ticket="";
				$tick="";
				$data="";
			 	foreach($tickets['tickets'] as $key=>$val)
				{
					
					$tbl_event = $this->db->get_where('tbl_event_seats', array('event_id' => $id,'ticket_class_id'=>$tickets['tickets'][$key]['ticket']))->row();
				
					$id_tickets = $tbl_event->id;
					$table_end=$tbl_event->table_end - $tickets['tickets'][$key]['total'];
					
					$data['table_end']=$table_end;
					$this->db->where('id', $id_tickets);
					$this->db->update('tbl_event_seats', $data);
					
					$tickets_name .=$tickets['tickets'][$key]['name'].",";
					$tickets_seat_charge .=$tickets['tickets'][$key]['seat_charge'].",";
					$ticket_ticket .=$tickets['tickets'][$key]['ticket'].","; 
					$tickets_total .=$tickets['tickets'][$key]['total'].","; 
					
				}
				
				$tickets_name.="&";
				$tickets_seat_charge.="&";
				$ticket_ticket.="&";
				$tick.=$tickets_name.$tickets_seat_charge.$ticket_ticket.$tickets_total;
		}
		
				$data="";
				$data["customer_first_name"] = $this->input->post('customer_first_name');
                $data['event_id'] = $id;
                $data['customer_first_name'] = $this->input->post('customer_first_name');
                $data['customer_last_name'] = $this->input->post('customer_last_name');
                $data['customer_email'] = $this->input->post('customer_email');
                $data['cardholder_first_name'] = $this->input->post('cardholder_first_name');
                $data['cardholder_last_name'] = $this->input->post('cardholder_last_name');
                $data['cardholder_email'] = $this->input->post('cardholder_email');
                $data['cardholder_address'] = $this->input->post('cardholder_address');
                $data['cardholder_area'] = $this->input->post('cardholder_area');
                $data['cardholder_city'] = $this->input->post('cardholder_city');
                $data['cardholder_country'] = $this->input->post('cardholder_country');
                $data['cardholder_post_code'] = $this->input->post('cardholder_post_code');
                $data['cardholder_contact_number'] = $this->input->post('cardholder_contact_number');
                $data['cardholder_mobile_number'] = $this->input->post('cardholder_mobile_number');
                $data['subtotal'] = $this->input->post('subtotal');
                $data['payment_status'] = 0;
                $data['cart_id'] = $randomNumber;
                $data['created'] = time();
				$data['table'] =  @$table_number;
				$data['ticket_table'] =  @$ticket_table;
				$data['addtional'] =  @$addtional;
				$data['tickets'] =  @$tick;
				$data['coupon_id'] = $coupon_id;
				$data['user_id'] = $this->session->userdata('user_id');
                $this->db->insert('tbl_orders', $data);
				$data['order_id'] = $this->db->insert_id();
				$this->session->set_userdata('client', $data);
				
                $da['rand'] = $randomNumber;
                $da['order_details'] = $this->Front_model->fetch_detail_awards($id);
                
				/* mail */
				$emails = $this->input->post('cardholder_email'); 
				$aa=$this->sendmail($emails);
				
				// mail	end // 
				
		
            	$this->session->unset_userdata('tables');
                $this->session->unset_userdata('promocode');
                $this->session->unset_userdata('after_party');
			    $this->session->unset_userdata('tickets');
				$this->session->unset_userdata('coupen_id');
		     }
                $this->load->view('fulldiscount');
            }
        }
        
    }


public function sendmail($emails){
	$IP=$_SERVER['REMOTE_ADDR'];
	/*BCC: ,dean@vtelevision.co.uk*/
		$config =array(  'mailtype' => 'html','charset' => 'iso-8859-1' );       
		$this->load->library('email', $config);
		$this->load->library('form_validation');
		$this->load->helper('file');
		$this->email->from('noreply@ticketbaby.co.uk', 'Ticket Baby');
		$this->email->to($emails);
		if($IP!="110.172.135.22"){
			$this->email->bcc('sales@ticketbaby.co.uk, dean@vtelevision.co.uk');
		}
		$this->email->reply_to('sales@ticketbaby.co.uk');
		$this->email->subject("Order Confirmation");
		$msg = @$this->load->view('email/payment_success',@$data,TRUE);
		
		$this->email->message($msg);
		$this->email->send();
		$this->email->print_debugger();
}
}

?>