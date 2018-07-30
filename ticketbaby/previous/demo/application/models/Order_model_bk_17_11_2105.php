<?php
class Order_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
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
					              em.id as event_id,em.title as event_title
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

		public function record_count($category_id=null,$to_date=null,$from_date=null,$event_name=null) {
					$this->db->select('count(DISTINCT om.id) as total');
					$this->db->from('order_master om');
					$this->db->join('order_event_details oed', 'oed.order_id = om.id');
					$this->db->join('event_master em', 'em.id = oed.event_id');
					$this->db->join('category_event ce', 'ce.event_id = em.id','LEFT');
					if($category_id)
						$this->db->where('ce.category_id',$category_id);
					if($to_date && $from_date){
						$to_date	=	 date('Y-m-d',strtotime($to_date));
						$from_date	=	 date('Y-m-d',strtotime($from_date));
						$this->db->where("om.date >= '{$to_date}' AND om.date <= '{$from_date}'");
					}elseif($to_date){
						$to_date	=	 date('Y-m-d',strtotime($to_date));
						$this->db->where("om.date >= '{$to_date}'");
					}elseif($from_date){
						$from_date	=	 date('Y-m-d',strtotime($from_date));
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
						$to_date	=	 date('Y-m-d',strtotime($to_date));
						$from_date	=	 date('Y-m-d',strtotime($from_date));
						$this->db->where("om.date >= '{$to_date}' AND om.date <= '{$from_date}'");
					}elseif($to_date){
						$to_date	=	 date('Y-m-d',strtotime($to_date));
						$this->db->where("om.date >= '{$to_date}'");
					}elseif($from_date){
						$from_date	=	 date('Y-m-d',strtotime($from_date));
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
		public function get_orders_detail($email)
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
		}


}