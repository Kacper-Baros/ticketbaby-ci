<?php
class Order_model extends CI_Model {

        public function __construct()
        {		
			
            $this->load->database();
			parent::__construct();
        }

		/****
		fronend
		****/

		public function get_order_edit_id($id)
		{
		
			if ( $id > 0 )
			{

				$this->db->select(
					                '
					                om.*,
					              em.id as event_id,em.title as event_title
					                '
					             );
				$this->db->from('order_master om');
				$this->db->join('order_event_details oed', 'oed.order_id =om.id');
				$this->db->join('event_master em', 'em.id = oed.event_id'); //, 'left'
				$this->db->group_by("om.id"); 
				$this->db->where('om.id', $id);
				$query = $this->db->get('order_master');  
				//echo $this->db->last_query();
				$order_details =  $query->result_array();
				//print_r($order_details);die;
				// Seat details
				$this->db->select(
					                '
					                osd.ticket_class_id,osd.table_number,GROUP_CONCAT(osd.seat_number) as seat_numbers,
					                tc.title as ticket_class_title,
					                ts.section as ticket_section,ts.title as ticket_section_title
					                '
					             );
				$this->db->from('order_seat_details osd');
				$this->db->join('ticket_class tc', 'tc.id = osd.ticket_class_id');
				$this->db->join('ticket_section ts', 'ts.id = tc.section_id');		
				$this->db->where('osd.order_id', $id);
				$this->db->group_by("osd.table_number"); 
				$this->db->order_by('osd.table_number ASC');
				$query = $this->db->get();
				//echo $this->db->last_query();
				$order_details["seat_details"] = $query->result_array();
				//print_r($order_details["seat_details"]);die;
				return $order_details;
				
			}else{
				return FALSE;
			}	
		}
		/*
		fronend
		*/

		public function get_order_by_email($id,$email)
		{
		 
			if ( $id > 0 )
			{

				$this->db->select(
					                '
					                om.*,
					              em.id as event_id,em.title as event_title,em.slug as event_slug
					                '
					             );
				$this->db->from('order_master om');
				$this->db->join('order_event_details oed', 'oed.order_id =om.id');
				$this->db->join('event_master em', 'em.id = oed.event_id'); //, 'left'
				$this->db->group_by("om.id"); 
				$this->db->where('om.email', $email);
				$query = $this->db->get('order_master');  
				//echo $this->db->last_query();
				$order_details =  $query->result_array();
				//print_r($order_details);die;
				// Seat details
				$this->db->select(
					                '
					                osd.ticket_class_id,osd.table_number,GROUP_CONCAT(osd.seat_number) as seat_numbers,
					                tc.title as ticket_class_title,
					                ts.section as ticket_section,ts.title as ticket_section_title
					                '
					             );
				$this->db->from('order_seat_details osd');
				$this->db->join('ticket_class tc', 'tc.id = osd.ticket_class_id');
				$this->db->join('ticket_section ts', 'ts.id = tc.section_id');		
				$this->db->where('osd.order_id', $id);
				$this->db->group_by("osd.table_number"); 
				$this->db->order_by('osd.table_number ASC');
				$query = $this->db->get('order_seat_details');
				//echo $this->db->last_query();
				$order_details["seat_details"] = $query->result_array();

				return $order_details;
			}else{
				return FALSE;
			}	
		}
		
		/*
		Backend
		*/

		public function get_order_by_id($order_id = 0)
		{
			if ( $order_id > 0 )
			{

				$this->db->select(
					                '
					                om.*,
					                em.id as event_id,em.title as event_title
					                '
					             );
				$this->db->from('order_master om');
				$this->db->join('order_event_details oed', 'oed.order_id = om.id');
				$this->db->join('event_master em', 'em.id = oed.event_id'); //, 'left'
				$this->db->group_by("om.id"); 
				$this->db->where('om.id', $order_id);
				$query = $this->db->get();
				
				//echo $this->db->last_query();
				$order_details =  $query->row_array();
				//print_r($order_details);die;
				// Seat details
				$this->db->select(
					                '
					                osd.ticket_class_id,osd.table_number,GROUP_CONCAT(osd.seat_number) as seat_numbers,
					                tc.title,
					                ts.section as ticket_section,ts.title as ticket_section_title
					                '
					             );
				$this->db->from('order_seat_details osd');
				$this->db->join('ticket_class tc', 'tc.id = osd.ticket_class_id');
				$this->db->join('ticket_section ts', 'ts.id = tc.section_id');		
				$this->db->where('osd.order_id', $order_id);
				$this->db->group_by("tc.title"); 
				//$this->db->order_by('osd.table_number ASC');
				$query = $this->db->get();
				//echo $this->db->last_query();
				$order_details["seat_details"] = $query->result_array();

				return $order_details;
			}else{
				return FALSE;
			}	
		}
		
		
		public function get_recentmost_order_created_time()
		{		
			$this->db->select('date');
			$this->db->order_by('id','desc');
			$this->db->limit(1);
			$query = $this->db->get('order_master');
			//echo $this->db->last_query();
			return $query->row_array();
		}

		public function record_count($category_id=null,$to_date=null,$from_date=null,$event_name=null) {
					$this->db->select('count(DISTINCT om.id) as total');
					$this->db->from('order_master om');
					$this->db->join('order_event_details oed', 'oed.order_id = om.id');
					$this->db->join('event_master em', 'em.id = oed.event_id');
					$this->db->join('category_event ce', 'ce.event_id = em.id','LEFT');
					if($category_id)
						$this->db->where('ce.category_id',$category_id);
					if($to_date && $from_date){
						$to_date	=	 date('Y-m-d',strtotime($to_date))." 00:00:00";
						$from_date	=	 date('Y-m-d',strtotime($from_date))." 23:59:59";
						$this->db->where("om.date >= '{$to_date}' AND om.date <= '{$from_date}'");
					}elseif($to_date){
						$to_date	=	 date('Y-m-d',strtotime($to_date))." 00:00:00";
						$this->db->where("om.date >= '{$to_date}'");
					}elseif($from_date){
						$from_date	=	 date('Y-m-d',strtotime($from_date))." 23:59:59";
						$this->db->where("om.date <= '{$from_date}'");
					}
					if($event_name)
						$this->db->like('em.title',$event_name,'Both');	
					
					$this->db->group_by("om.id"); 
					
					$query = $this->db->get();
					$row	=	$query->result_array();
					$total	=	count($row);
					return $total;
					
					//return $this->db->count_all();
					
			//return $this->db->count_all("order_master");
		}

		public function get_orders($pay_id = FALSE,$limit,$start,$category_id=null,$to_date=null,$from_date=null,$event_name=null,$admin_id=null)
		{
			$this->db->limit($limit, $start);
				
			if ($pay_id === FALSE)
			{
					$this->db->select('om.*,
									   em.id as event_id,em.title as event_title,oed.event_id as o_d_id
									'
									 );
					$this->db->from('order_master om');
					$this->db->join('order_event_details oed', 'oed.order_id = om.id');
					$this->db->join('event_master em', 'em.id = oed.event_id');
					$this->db->join('category_event ce', 'ce.event_id = em.id','LEFT');
					
					//$this->db->join('user_master um', "um.id =om.admin_id ",'LEFT');
					if($category_id)
						$this->db->where('ce.category_id',$category_id);
					if($to_date && $from_date){
						$to_date	=	 date('Y-m-d',strtotime($to_date))." 00:00:00";
						$from_date	=	 date('Y-m-d',strtotime($from_date))." 23:59:59";
						$this->db->where("om.date >= '{$to_date}' AND om.date <= '{$from_date}'");
					}elseif($to_date){
						$to_date	=	 date('Y-m-d',strtotime($to_date))." 00:00:00";
						$this->db->where("om.date >= '{$to_date}'");
					}elseif($from_date){
						$from_date	=	 date('Y-m-d',strtotime($from_date))." 23:59:59";
						$this->db->where("om.date <= '{$from_date}'");
					}
					if($event_name)
						$this->db->like('em.title',$event_name,'Both');	
						
						
					
					$this->db->group_by("om.id"); 
					$this->db->order_by('om.id DESC');
					$query = $this->db->get();
					//echo $this->db->last_query();
					//print_r($query->result_array());die('test');
					return $query->result_array();
			}
			
			$query = $this->db->get_where('order_master', array('pay_id' => $pay_id));
			return $query->row_array();
		}
	/*	public function get_orders_detail($email)
		{
			

			if ($email)
			{
					$this->db->select('om.*,
									   em.id as event_id,em.title as event_title
									   '
									 );
					$this->db->from('order_master om');
					$this->db->join('order_event_details oed', 'oed.order_id = om.id');
					$this->db->join('event_master em', 'em.id = oed.event_id');
					$this->db->group_by("om.id"); 
					$this->db->order_by('om.id DESC');
					$this->db->where('email',$email );
					$query = $this->db->get();
					
					//echo $this->db->last_query();
					return $query->result_array();
			}
			$query = $this->db->get_where('order_master',$email );//print_r($query);die;
			return $query->row_array();
		}*/
		
		public function exportOrderData(){
						
			
			$query 			= $this->db->select('om.id, om.pay_id, om.first_name, om.last_name, om.email, om.contact_number, om.address, om.date, om.area, om.city, om.post_code,om.amount, em.title as event_title');
			
			
			$this->db->from('order_master om');
			$this->db->join('order_event_details oed', 'oed.order_id =om.id');
			$this->db->join('event_master em', 'em.id = oed.event_id'); 
			$this->db->group_by("om.id");			
			$query = $this->db->get();	
			$find_all_data	=	 $query->result_array();
			//echo "<pre>";print_r($find_all_data);die;
			$list[]			= 	array("Pay ID","First Name","Last Name","Email","Phone","Address","Date","Area","City","Post Code",
			"Amount","Event","Class", "Table", "Ticket Section", "Seat Numbers");
			header('Content-Type: text/csv/; charset=utf-8');
			header('Content-Disposition: attachment; filename=CSV-'.date('d-M-Y').'_'.rand(1,999).'.csv');
			$file = fopen('php://output', 'w');
			$i = 1;
			foreach ($find_all_data as $_row) {
				
				$this->db->select('osd.table_number,osd.order_id');								 
				$this->db->from('order_seat_details osd');
				$this->db->group_by("osd.table_number");	
				$this->db->where('osd.order_id', $_row['id']);
				$this->db->order_by("osd.id", "asc");
				$query = $this->db->get();
				$order_details["only_table_number"] = $query->result_array();
				//echo "<pre>";print_r($order_details["only_table_number"]);//die;
				
				$new_seat_details_arr = array();
				
				if(!empty($order_details["only_table_number"])){ 
					
					foreach($order_details["only_table_number"] as $singleTable){  
						$this->db->select(
					                '
					                osd.id, osd.ticket_class_id,osd.seat_number as seat_numbers,
					                tc.title as ticket_class_title,
				                ts.section as ticket_section,ts.title as ticket_section_title
					                '
					             );
								 
						$this->db->from('order_seat_details osd');
						$this->db->join('ticket_class tc', 'tc.id = osd.ticket_class_id');
						$this->db->join('ticket_section ts', 'ts.id = tc.section_id');	
						$this->db->where('osd.table_number', $singleTable['table_number']);
						$this->db->where('osd.order_id', $singleTable['order_id']);
						$query = $this->db->get();
						$order_details["seat_details"][$singleTable['table_number']] = $query->result_array();	
						//$order_details["seat_details"] = array();
						
					
					}	
					
				}
				
				//echo "<pre>";print_r($order_details["seat_details"]);
				
				$extra_seat_details = '';
						if(!empty($order_details["seat_details"])){
							$loopCount = 0;
							$seatNumbers = '';
							foreach($order_details["seat_details"] as $key=>$seatDetails){
								$loopCount++;
								
								if($loopCount==1){
									if(!empty($seatDetails)){
										foreach($seatDetails as $seat){
											$row['ticket_section_title'] = $seat['ticket_section_title'];
											$row['ticket_class_title'] = $seat['ticket_class_title'];
											$row['ticket_class_title_count'] = count($seatDetails);
											$seatNumbers.=$seat['seat_numbers'].',';
										}
									}
									
									$row['ticket_table_number'] = $key;
									$seatNumbers = rtrim($seatNumbers,',');
									
									if($seatNumbers=='1,2,3,4,5,6,7,8,9,10')
										$row['ticket_seat_numbers'] = 'Table';
									else
										$row['ticket_seat_numbers'] = $seatNumbers;	
								
								//TABLE + After Party Tickets - 8 (Table Number - 1  , Seat Numbers - 41,42,43,44,45,46,47,48)
								
								}else{
									if(!empty($seatDetails)){
										$seatNumbers = '';
										foreach($seatDetails as $seat){
											
											$row['extra_ticket_class_title'] = $seat['ticket_class_title'];
											$row['extra_ticket_class_title_count'] = count($seatDetails);
											$seatNumbers.=$seat['seat_numbers'].',';
										}
									}
									
									$row['extra_ticket_table_number'] = $key;	
									$row['extra_ticket_seat_numbers'] = rtrim($seatNumbers,',');
									
									$extra_seat_details.=$row['extra_ticket_class_title'].' - '.$row['extra_ticket_class_title_count'].' ( Table Number - '.
									$row['extra_ticket_table_number'].', Seat Numbers - '.$row['extra_ticket_seat_numbers'].')###';
								}
								
							}
							
							
						}
						
						
				$order_details["seat_details"] = array();
				
				if(rtrim($extra_seat_details,'###')!='')
					$final_seat_numbers = $row['ticket_seat_numbers'].' + '.rtrim($extra_seat_details,'###');
				else
					$final_seat_numbers = $row['ticket_seat_numbers'];	
				
				
				$list[]=array($_row['pay_id'],$_row['first_name'],$_row['last_name'],$_row['email'], $_row['contact_number'], $_row['address']
				, $_row['date'], $_row['area'], $_row['city'], $_row['post_code'], $_row['amount'], $_row['event_title'],
				$row['ticket_class_title'],$row['ticket_table_number'],$row['ticket_section_title'],$final_seat_numbers);
				
				$i++;
			}
			//echo "<pre>";print_r($list);die;
			foreach ($list as $fields) {
				fputcsv($file, $fields);
			}
			
			exit;
			fclose($file);		 
		}


}