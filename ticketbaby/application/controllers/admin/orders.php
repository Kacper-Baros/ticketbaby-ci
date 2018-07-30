<?php
class Orders extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Admin_model');
        $this->load->model('Front_model');
        $this->load->library('form_validation');
		$this->load->helper('mpdf');
    }

    function index() {
        $this->list_orders();
    }

    function list_orders() {
        
        if(($_POST)){
          $data['orders'] = $this->Admin_model->filter_order($_POST);
       
        }else{
			$data['orders'] = $this->db->order_by('id', 'DESC')->get_where('tbl_orders')->result();
         //$data['orders'] = $this->db->get_where('tbl_orders')->result();
		 
        }
        
        $data['logo'] = $this->db->get('site_settings')->row();
   
        $data['title'] = 'Orders';
        $data['main'] = 'orders/list';
        $this->load->view('admin/index', $data);
    }
	
	function ConfirmPassword($id){
		$Userpassword = $this->input->post('user_password_'.$id);
		$username = $this->session->userdata('admin_username');
		$database_password=$this->Admin_model->get_password_username($username);
		if(strcmp($Userpassword,$database_password)==0){
			echo json_encode("Confirmed");
		}
		else{
			echo json_encode( "NotValid");
		}
	}
    function export_orders(){ 
		$fields = "";
		$excelHeader = "";
		print_r($_REQUEST);
		foreach($_REQUEST as $key=>$value){
			$key = $value;
			echo $key;
			echo $value;
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
			if($fld==='user_id'){
				$excelHeader .= "User Name";
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
				if($fld==='user_id'){
					$userName = $this->db->get_where('tbl_users', array('id' => @$val[$fld]))->row();
					$cellValue ='"' . @$userName->username. '",';
				}
				if($fld==='created'){
					$cellValue ='"' . date('m/d/Y H:i:s', @$val[$fld]). '",';
				}
				$output .=@$cellValue;
			}
			$output .="\r\n";
		} 
		/*$q="select * from `tbl_orders`";
		$res = $this->db->query($q);
		$row = $res->result_array();
		
		 $output .='First Name , Last Name, Area, City, Post Code, Table Type, TBNo, QTY, Price, Additionals, Fulfillment Fee, Postage, Total, Telephone, Email, Address';
		 $output .="\r\n";
		foreach($row as $val)
		{
			 @$table=explode('&',$val['table']);
			 @$qty=sizeof(',',$table[0]);
			
			 $output .='"' . @$val['customer_first_name']. '",';
			 $output .='"' . @$val['customer_last_name']. '",';
			 $output .='"' . @$val['cardholder_area'] . '",';
			 $output .='"' . @$val['cardholder_city'] . '",';
			 $output .='"' . @$val['cardholder_post_code'] . '",';
			 $output .='"' . @rtrim($table[1],','). '",';
			 $output .='"' . @rtrim($table[0],','). '",';
			 $output .='"' . @$qty . '",';
			 $output .='"' . @$val['subtotal'] . '",';
			 $output .='"0",';
			 $output .='"0",';
			 $output .='"0",';
			 $output .='"' . @$val['subtotal'] . '",';
			 $output .='"' . @$val['cardholder_contact_number'] . '",';
			 $output .='"' . @$val['cardholder_email'] . '",'; 
			 $output .='"' . @$val['cardholder_address'] . '",'; 
			 $output .="\r\n";
		/*}
		 			  
        $data = $this->db->get_where('tbl_orders')->result();
        $query = $this->db->last_query();
        //debug($data);exit;
        $sql = mysql_query($query);
        $columns_total = mysql_num_fields($sql);
        // Get The Field Name
        for ($i = 0; $i < $columns_total; $i++) {
            $heading = mysql_field_name($sql, $i);
            $output .= '"' . $heading . '",';
        }
        $output .="\r\n";

        foreach ($data as $k => $v) {
            $output .='"' . $v->id . '",';
            $output .='"' . $v->event_id . '",';
            $output .='"' . $v->customer_first_name . '",';
            $output .='"' . $v->customer_last_name . '",';
            $output .='"' . $v->customer_email . '",';
            $output .='"' . $v->customer_phone . '",';
            $output .='"' . $v->cardholder_first_name . '",';
            $output .='"' . $v->cardholder_last_name . '",';
            $output .='"' . $v->cardholder_email . '",';
            $output .='"' . $v->cardholder_address . '",';
            $output .='"' . $v->cardholder_area . '",';
            $output .='"' . $v->cardholder_city . '",';
            $output .='"' . $v->cardholder_country . '",';
            $output .='"' . $v->cardholder_post_code . '",';
            $output .='"' . $v->cardholder_contact_number . '",';
            $output .='"' . $v->cardholder_mobile_number . '",';
            $output .='"' . $v->subtotal . '",';
			$output .='"' . $v->payment_status. '",';
			$output .='"' . $v->cart_id. '",';
			$output .='"' . $v->verified . '",';
			$output .='"' . $v->created. '",';
			$output .='"' . $v->table . '",';
			$output .='"' . $v->ticket . '",';
			$output .='"' . $v->addtional . '",';
            $output .="\r\n";
        }
		*/
		
        $filename = "Orders.csv";
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);

        echo $output;
        exit;
    }
	
	function export_order_new(){
        $data = $this->db->get_where('tbl_orders')->result();
        foreach ($data as $k => $v) {
            $output .='"' . $v->id . '",';
            $output .='"' . $v->event_id . '",';
            $output .='"' . $v->customer_first_name . '",';
            $output .='"' . $v->customer_last_name . '",';
            $output .='"' . $v->customer_email . '",';
            $output .='"' . $v->customer_phone . '",';
            $output .='"' . $v->cardholder_first_name . '",';
            $output .='"' . $v->cardholder_last_name . '",';
            $output .='"' . $v->cardholder_email . '",';
            $output .='"' . $v->cardholder_address . '",';
            $output .='"' . $v->cardholder_area . '",';
            $output .='"' . $v->cardholder_city . '",';
            $output .='"' . $v->cardholder_country . '",';
            $output .='"' . $v->cardholder_post_code . '",';
            $output .='"' . $v->cardholder_contact_number . '",';
            $output .='"' . $v->cardholder_mobile_number . '",';
            $output .='"' . $v->subtotal . '",';
			$output .='"' . $v->payment_status. '",';
			$output .='"' . $v->cart_id. '",';
			$output .='"' . $v->verified . '",';
			$output .='"' . $v->created. '",';
			$output .='"' . $v->table . '",';			
			$output .='"' . $v->addtional . '",';
            $output .="\r\n";
        }
		
		$filename = "Orders.csv";
        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        echo $output;
    }

    function make_verify($id) {
        $data['verified'] = 1;
        $this->db->where('id', $id);
        $this->db->update('tbl_orders', $data);
        redirect(base_url('admin/orders'));
    }

    function make_unverify($id) {
        $data['verified'] = 0;
        $this->db->where('id', $id);
        $this->db->update('tbl_orders', $data);
        redirect(base_url('admin/orders'));
    }

    function view_order_detail($id) {
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['detail'] = $this->db->get_where('tbl_orders', array('id' => $id))->row();
        $data['title'] = 'Order Detail';
        $data['main'] = 'orders/detail_list';
        $this->load->view('admin/index', $data);
    }
               
    function booking($id){
        $data['id'] = $id;
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['title'] = 'Booking';
        $data['main'] = 'booking/form';
        $this->load->view('admin/index', $data);
        
    }

}

?>