<?php
class Ticket_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        /* Ticket Class */

        public function get_ticket_section(){ 
			$this->db->select('ticket_section.*');
			$this->db->from('ticket_section');
			$query = $this->db->get();
		    $result_array = $query->result_array();
		    return $result_array;
		}

        public function get_ticket_class_by_id($id = 0)
		{
			if ( $id > 0 )
			{
		        $query = $this->db->get_where('ticket_class', array('id' => $id));
		        return $query->row_array();
			}else{
				return FALSE;
			}	
		}


        public function get_ticket_seat_by_id($id = 0)
		{
			if ( $id > 0 )
			{
		        $query = $this->db->get_where('ticket_seat_master', array('id' => $id));
		        return $query->row_array();
			}else{
				return FALSE;
			}	
		}

        public function get_ticket_class($slug = FALSE,$limit,$start)
		{
			$this->db->limit($limit, $start);

			if ($slug === FALSE)
			{
				$this->db->select('tc.*,ts.title as section_title');
				$this->db->from('ticket_class tc');
				$this->db->join('ticket_section ts', 'ts.id = tc.section_id','left');
				$this->db->order_by('tc.section_id ASC');
				$this->db->order_by('tc.order ASC');
				$query = $this->db->get();
				return $query->result_array();
			}
			return;
		}

		public function record_count() {
			return $this->db->count_all("ticket_class");
		}

		public function getNextId() {
			$this->db->select('max(id) as latest_id');
			$this->db->from('ticket_class');
			$query = $this->db->get();
			$row_array = $query->row_array();
			$new_id = intval($row_array["latest_id"]) + 1;
			return $new_id;
		}

		public function getNextSeatId() {
			$this->db->select('max(id) as latest_id');
			$this->db->from('ticket_seat_master');
			$query = $this->db->get();
			$row_array = $query->row_array();
			$new_id = intval($row_array["latest_id"]) + 1;
			return $new_id;
		}

		public function createTicketClass($data) 
		{

			$title         			= trim($data['title']);
	        $slug       			= trim($data['class']);

	        if ( $title == "" || $slug == "" ) {
	        	$array["success"] = false;
				$array["message"] = "Ticket class title and slug fields are mandatory";
				return $array;	
	        }

			$this->db->select('id, title');
			$this->db->from('ticket_class');
			$this->db->where('class', $slug);
			$this->db->limit(1);

			$query = $this->db->get();

			if($query->num_rows() == 1)
			{	
				$array["success"] = false;
				$array["id"]  = $query->result_array()[0]["id"];
				$array["message"] = "Ticket class slug already exist!";
				return $array;
			}
			else
			{ 
				$ticket_class_data = array(
				'id'		=> $this->getNextId(),
				'title' => $title,
				'class' => $slug,
				'section_id' 	=> $data['section_id'],
				'tool_tip'	=> trim($data['tool_tip']),
				'ticket_selection_type' => $data['ticket_selection_type'],
				'order'	=> trim($data['order'])
				);

				$this->db->insert('ticket_class', $ticket_class_data); 
				$id = $this->db->insert_id();

				$array["success"] = true;
				$array["message"] = "Ticket class has been created successfully";
				return $array;
			}

			$array["success"] = false;
			$array["message"] = "Error!, Try again later";
			return $array;
		}

		public function updateTicketClass($data) 
		{

			$title         			= trim($data['title']);
	        $slug       			= trim($data['class']);
	        $class_id       		= trim($data['id']);
	        $section_id       		= $data['section_id'];


	        if ( $title == "" || $slug == "" ) {
	        	$array["success"] = false;
				$array["message"] = "Ticket class title and slug fields are mandatory";
				return $array;	
	        }

	        // Check duplicate
	        $this->db->select('id, title');
			$this->db->from('ticket_class');
			$where = "id!='$class_id' AND class='$slug' AND section_id='$section_id'";
			$this->db->where($where);
			$this->db->limit(1);
			$query = $this->db->get();


			if($query->num_rows() == 1)
			{	
				$array["success"] = false;
				$array["id"]  = $query->result_array()[0]["id"];
				$array["message"] = "Ticket class slug already exist!";
				return $array;
			}
			// Check duplicate


			$ticket_class_data = array(
				'title' => $title,
				'class' => $slug,
				'section_id' 	=> $data['section_id'],
				'tool_tip'	=> trim($data['tool_tip']),
				'ticket_selection_type' => $data['ticket_selection_type'],
				'order'	=> trim($data['order'])
			);


	        $this->db->where('id', $class_id);	
			$this->db->update('ticket_class', $ticket_class_data); 

			$array["success"] = true;
			$array["message"] = "Ticket class has been updated successfully";
			return $array;

		}



		/* Event Seat */


        public function get_ticket_class_section(){ 
			$this->db->select('ticket_section.*');
			$this->db->from('ticket_section');
			$query = $this->db->get();
		    $result_array = $query->result_array();

			foreach($result_array as $k=>$row) {

				$this->db->select('ticket_class.*');
				$this->db->from('ticket_class');
				$this->db->where('section_id', $row['id']);	
				$query = $this->db->get();
				$result_array[$k]["ticket_class_details"] = $query->result_array();
			}

		    return $result_array;
		}

		public function event_ticket_record_count($event_id) {
			if ( $event_id > 0 ) {
				$this->db->from('ticket_seat_master tsm');
				$this->db->where('tsm.event_id', $event_id);
				$count = $this->db->count_all_results();
				//echo $this->db->last_query();
	 			return $count;
			}
			return 0;
		}

		public function get_event_ticket_by_id($id = 0)
		{
			if ( $id > 0 )
			{
		        $query = $this->db->get_where('ticket_class', array('id' => $id));
		        return $query->row_array();
			}else{
				return FALSE;
			}	
		}

		public function get_event_tickets($event_id = 0,$limit,$start)
		{
			$this->db->limit($limit, $start);

			if ($event_id  > 0 )
			{
				$this->db->select('tsm.*,ts.title as section_title,tc.title as class_title');
				$this->db->from('ticket_seat_master tsm');
				$this->db->join('ticket_class tc', 'tc.id = tsm.ticket_class_id','left');
				$this->db->join('ticket_section ts', 'ts.id = tc.section_id','left');
				$this->db->order_by('ts.id ASC');
				$this->db->order_by('tc.id ASC');
				$this->db->order_by('tsm.table_start_number ASC');
				$this->db->where('tsm.event_id', $event_id);	
				$query = $this->db->get();
				return $query->result_array();
			}
			return;
		}


		public function createEventSeatTicketClass($data) 
		{

			$ticket_class_id   					= $data['ticket_class_id'];
			$table_start_number         		= trim($data['table_start_number']);
	        $table_end_number       			= trim($data['table_end_number']);
	        $unit_price       					= trim($data['unit_price']);
	        $table_price       					= trim($data['table_price']);
	        $ticket_group       				= $data['ticket_group'];
	        $event_id       					= $data['event_id'];
	        $id       							= $data['id'];

	        // Get Ticket class details
			$classDetails = $this->get_ticket_class_by_id ( $ticket_class_id );


	        if( $event_id < 1 ) {
	        	$array["success"] = false;
				$array["message"] = "Event Id is missing!";
				return $array;
	        }

	        if ( $table_start_number < 1 || $table_end_number < 1  ) {
				$array["success"] = false;
				$array["message"] = "Table start and end numbers are mandatory";
				return $array;	
			}

			if ( $classDetails["section_id"] == "1" ) {
				if ( $table_price > 0 ) {
					//
				}else{
					$array["success"] = false;
					$array["message"] = "Table price mandatory";
					return $array;	
				}
			}else if ( $classDetails["section_id"] == "2" ) {
				if ( $unit_price > 0 ) {
					//
				}else{
					$array["success"] = false;
					$array["message"] = "Unit price mandatory";
					return $array;	
				}
			}

			/*$this->db->select('ticket_seat_master.*');
			$this->db->from('ticket_seat_master');
			$this->db->where("table_start_number BETWEEN $table_start_number AND $table_end_number");
			$this->db->where('event_id', $event_id);
			$this->db->limit(1);

			$query = $this->db->get();

			if($query->num_rows() == 1)
			{	
				$array["success"] = false;
				$array["id"]  = $query->result_array()[0]["id"];
				$array["message"] = "Ticket seat already exist!";
				return $array;
			}
			else
			{*/
				$table_seat_count   = $data['table_seat_count'];
				$unit_min_purchase 	= ( $classDetails["section_id"] == "1" ) ? $table_seat_count : 1;
				$unit_total 		=  ( ($table_end_number - $table_start_number) + 1 ) * $table_seat_count;
				

				$ticket_seat_data = array(
				'event_id' => $event_id,
				'ticket_class_id' => $ticket_class_id,
				'unit_price' 	=> $unit_price,
				'unit_total'	=> $unit_total,
				'unit_min_purchase' => $unit_min_purchase,			
				'table_start_number' => $table_start_number,
				'table_end_number' => $table_end_number,
				'table_seat_count' => $table_seat_count,
				'table_price' => $table_price,
				'ticket_group' => $ticket_group
				);

				if ( $id > 0 ) {
					$this->db->where('id', $id);	
					$this->db->update('ticket_seat_master', $ticket_seat_data);
					$array["success"] = true;
					$array["message"] = "Ticket seat has been updated successfully";
					return $array; 
				}else{
					$ticket_seat_data["id"] = $this->getNextSeatId();
					$this->db->insert('ticket_seat_master', $ticket_seat_data); 
					$id = $this->db->insert_id();
					$array["success"] = true;
					$array["message"] = "Ticket seat has been added successfully";
					return $array;
				}


				
			/*}*/

			//$array["success"] = false;
			//$array["message"] = "Error!, Try again later";
			//return $array;
		}

		public function deleteEventSeatTicketClass($id = 0) {
			$this->db->delete('ticket_seat_master', array('id' => $id)); 
			$array["success"] = true;
			$array["message"] = "Ticket seat has been deleted successfully";
			return $array;
		}



}