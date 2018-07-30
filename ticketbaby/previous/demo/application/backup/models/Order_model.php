<?php
class Order_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
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
				$this->db->where('osd.order_id', $order_id);
				$this->db->group_by("osd.table_number"); 
				$this->db->order_by('osd.table_number ASC');
				$query = $this->db->get();
				//echo $this->db->last_query();
				$order_details["seat_details"] = $query->result_array();

				return $order_details;
			}else{
				return FALSE;
			}	
		}

		public function record_count() {
			return $this->db->count_all("order_master");
		}

		public function get_orders($pay_id = FALSE,$limit,$start)
		{
			$this->db->limit($limit, $start);

			if ($pay_id === FALSE)
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
					$query = $this->db->get();
					//echo $this->db->last_query();
					return $query->result_array();
			}
			$query = $this->db->get_where('order_master', array('pay_id' => $pay_id));
			return $query->row_array();
		}

}