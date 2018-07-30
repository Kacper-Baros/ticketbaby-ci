<?php
class Client_orders extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('text', 'url', 'text');
        $this->load->helper('date');
        $this->load->library('pagination');
		$this->load->model('Admin_model');
        $this->load->model('Front_model');
    }
    function index() {
		$id = $this->session->userdata('user_id');
        if(!empty($id)){
			$data['details'] = $this->db->get_where('tbl_users',array('id'=>$id))->row();
			if(($_POST)){
			  $data['orders'] = $this->Admin_model->filter_order($_POST);
			}else{
				$oquery = $this->db->query("SELECT * FROM `tbl_events` WHERE `user_id`='".$id."'");
				$data['orders'] = $oquery->result();
			}
			$data['title'] = 'Client Orders';
			$this->load->view('client_orders', $data);
        }else{
            redirect(base_url('login'));
        }
    }
	function make_verify($id) {
        $data['verified'] = 1;
        $this->db->where('id', $id);
        $this->db->update('tbl_orders', $data);
        redirect(base_url('client_orders'));
    }

    function make_unverify($id) {
        $data['verified'] = 0;
        $this->db->where('id', $id);
        $this->db->update('tbl_orders', $data);
        redirect(base_url('client_orders'));
    }
	
	function view_details(){
		$id = $this->session->userdata('user_id');
        $data['details'] = $this->db->get_where('tbl_users',array('id'=>$id))->row();		
        $this->load->view('view_details', $data);
    }
	
	function export_orders(){
		$fields = "";
		$excelHeader = "";
		foreach($_REQUEST as $key=>$value){
			$$key = $value;
		}
		$totlvals = count($value);
		$i=1;
		foreach($value as $fld){
			$fields .= "`".$fld."`";
			if($fld==='id'){
				$excelHeader .= "Order ID";
			}
			if($fld==='event_id'){
				$excelHeader .= "Event Name";
			}
			if($fld==='customer_first_name'){
				$excelHeader .= "First Name";
			}
			if($fld==='customer_last_name'){
				$excelHeader .= "Last Name";
			}
			if($fld==='customer_email'){
				$excelHeader .= "Email ID";
			}
			if($fld==='customer_phone'){
				$excelHeader .= "Phone Number";
			}
			if($fld==='cardholder_first_name'){
				$excelHeader .= "Card Holder First Name";
			}
			if($fld==='cardholder_last_name'){
				$excelHeader .= "Card Holder Last Name";
			}
			if($fld==='cardholder_email'){
				$excelHeader .= "Card Holder Email ID";
			}
			if($fld==='cardholder_address'){
				$excelHeader .= "Address";
			}
			if($fld==='cardholder_area'){
				$excelHeader .= "Area";
			}
			if($fld==='cardholder_city'){
				$excelHeader .= "City";
			}
			if($fld==='cardholder_country'){
				$excelHeader .= "Country";
			}
			if($fld==='cardholder_post_code'){
				$excelHeader .= "Post Code";
			}
			if($fld==='cardholder_contact_number'){
				$excelHeader .= "Contact Number";
			}
			if($fld==='cardholder_mobile_number'){
				$excelHeader .= "Mobile Number";
			}
			if($fld==='subtotal'){
				$excelHeader .= "Total";
			}
			if($fld==='payment_status'){
				$excelHeader .= "Payment Status";
			}
			if($fld==='cart_id'){
				$excelHeader .= "Cart ID";
			}
			if($fld==='verified'){
				$excelHeader .= "Verified";
			}
			if($fld==='created'){
				$excelHeader .= "Date";
			}
			if($fld==='table'){
				$excelHeader .= "Table";
			}
			if($fld==='ticket_table'){
				$excelHeader .= "Table Tickets";
			}
			if($fld==='addtional'){
				$excelHeader .= "Additionals";
			}
			if($fld==='tickets'){
				$excelHeader .= "Tickets Only";
			}
			if($fld==='coupon_id'){
				$excelHeader .= "Coupon ID";
			}
			if($i!=$totlvals){
				$fields .=",";
				$excelHeader .= ",";
			}
			$i++;
		}
        $output = "";
		if($selectedEvent_id!=''){
			$qry = "SELECT $fields FROM `tbl_orders` WHERE `event_id`='".$selectedEvent_id."'";
		}
		else{
			$qry = "SELECT $fields FROM `tbl_orders`";
		}
		$res = $this->db->query($qry);
		$row = $res->result_array();
		
		$output .= $excelHeader;
		$output .="\r\n";
		
		foreach($row as $val){
			foreach($value as $fld){
				$cellValue = '"' . @$val[$fld]. '",';
				if($fld==='table'){
					if($val[$fld]!=''){
						@$table=explode('&',$val[$fld]);
						@$qty=(count(explode(',',$table[0]))-1);
						$cellValue ='"Ticket Type: ' . @rtrim($table[1],','). '"';
						$cellValue .='"Table No.: ' . @rtrim($table[0],','). '"';
						$cellValue .='"Qty.: ' . @$qty. '",';
					}
					else{
						$cellValue = '"' .@$val[$fld]. '",';
					}
				}
				if($fld==='ticket_table'){
					if($val[$fld]!=''){
						@$table=explode('&',$val[$fld]);
						@$qty=rtrim($table[1],',');
						$cellValue ='"Ticket Type: ' . @rtrim($table[2],','). '"';
						$cellValue .='"Table No.: ' . @rtrim($table[0],','). '"';
						$cellValue .='"Seats Qty.: ' . @$qty. '",';
					}
					else{
						$cellValue = '"' .@$val[$fld]. '",';
					}
				}
				if($fld==='addtional'){
					if($val[$fld]!=''){
						@$table=explode('&',$val[$fld]);
						$cellValue ='"Ticket Type: ' . @rtrim($table[0],','). '"';
						$cellValue .='"Qty.: ' . @rtrim($table[3],','). '",';
					}
					else{
						$cellValue = '"' .@$val[$fld]. '",';
					}
				}
				if($fld==='tickets'){
					if($val[$fld]!=''){
						@$table=explode('&',$val[$fld]);
						$cellValue ='"Ticket Type: ' . @rtrim($table[0],','). '"';
						$cellValue .='"Qty.: ' . @rtrim($table[3],','). '",';
					}
					else{
						$cellValue = '"' .@$val[$fld]. '",';
					}
				}
				if($fld==='event_id'){
					$eventname = $this->db->get_where('tbl_events', array('id' => @$val[$fld]))->row();
					$cellValue ='"' . @$eventname->name. '",';
				}
				if($fld==='coupon_id'){
					$couponcode = $this->db->get_where('tbl_coupen', array('id' => @$val[$fld]))->row();
					$cellValue ='"' . @$couponcode->coupen_code. '",';
				}
				if($fld==='created'){
					$cellValue ='"' . date('m/d/Y H:i:s', @$val[$fld]). '",';
				}
				$output .=@$cellValue;
			}
			$output .="\r\n";
		} 
		
        $filename = "Orders.csv";
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);

        echo $output;
        exit;
    }
}

?>