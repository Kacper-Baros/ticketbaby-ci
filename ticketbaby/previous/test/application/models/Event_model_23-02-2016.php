<?php
class Event_model extends CI_Model {

		protected $_table_name = 'event_master';
		
        public function __construct()
        {
                $this->load->database();
				$this->load->model('user_details');
        }

        public function get_all_events()
		{

			$this->db->select('event_master.*'
							   );
			$this->db->from('event_master');

			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_event_list($filter)
		{
			if ( $filter == "home" ) {
				//$this->db->limit($limit, $start);
				$this->db->select('em.title,em.slug,em.thumb1_main_carousel,em.thumb1_recommended_carousel,
								   em.show_main_carousel, em.show_recommended_carousel, em.show_hot_ticket, em.show_just_announced,
								   em.hot_ticket_tootip_title,em.hot_ticket_tootip_details,em.just_announced_tootip_title,em.just_announced_tootip_details,
					               ce.category_id,cm.category_name,
					               count(tsm.id) as ticketseatrows
					              ');
				$this->db->from('event_master em');
				$this->db->where('(em.show_main_carousel = "Y" OR em.show_recommended_carousel = "Y" OR em.show_hot_ticket = "Y" OR em.show_just_announced = "Y")');
				$this->db->where('em.active', 'Y');
				$this->db->join('category_event ce', 'ce.event_id = em.id','left');
				$this->db->join('category_master cm', 'cm.cat_id = ce.category_id','left');
				$this->db->join('ticket_seat_master tsm', 'tsm.event_id = em.id','left');
				$this->db->group_by("em.id"); 
				$query = $this->db->get();
				//echo $this->db->last_query();
		        return $query->result_array();
			}
		}

        public function get_event($slug = FALSE, $id = FALSE)
		{
			if ($slug === FALSE && $id === FALSE )
			{
			    return FLASE;
			}

			$this->db->select('event_master.*,category_event.category_id,category_master.category_slug, 
							   DATE_FORMAT(event_master.start_date,"%b") as start_date_month,
							   DATE_FORMAT(event_master.start_date,"%d") as start_date_date,
							   DATE_FORMAT(event_master.start_date,"%W") as start_date_day,
							   DATE_FORMAT(event_master.start_date,"%b %d %Y %l:%i %p") as start_date_format,
							   DATE_FORMAT(event_master.start_date,"%l:%i %p") as start_time_format'
							   );
			$this->db->from('event_master');
			$this->db->join('category_event', 'category_event.event_id = event_master.id','left');
			$this->db->join('category_master', 'category_master.cat_id = category_event.category_id','left');

			if ($id > 0) {
				$this->db->where('event_master.id', $id);
			}else{
				$this->db->where('event_master.slug', $slug);
			}

			$query = $this->db->get();

			$event_details = $query->row_array();


			$this->db->select('
							   min(ticket_seat_master.unit_price*ticket_seat_master.unit_min_purchase) as min_unit_price, 
							   max(ticket_seat_master.unit_price*ticket_seat_master.unit_min_purchase) as max_unit_price'
							   );
			$this->db->from('event_master');
			$this->db->join('ticket_seat_master', 'ticket_seat_master.event_id = event_master.id','left');
			if ($id > 0)
			{
				$this->db->where('event_master.id', $id);	
			}else{
				$this->db->where('event_master.slug', $slug);	
			}
			$this->db->where('ticket_seat_master.event_ticket', 'Y');
			$query = $this->db->get();

			$ticket_details =  $query->row_array();

			$event_details["min_unit_price"] = $ticket_details["min_unit_price"];
			$event_details["max_unit_price"] = $ticket_details["max_unit_price"];  


			/* Get Additional charges */
			if ($event_details["id"] > 0) {
				$this->db->select('event_additional_charges.*');
				$this->db->from('event_additional_charges');
				$this->db->where('event_additional_charges.event_id', $event_details["id"]);	
				$query = $this->db->get();
				$event_details["event_additional_charges"] = $query->result_array();
			}

			return $event_details;
		}


		public function get_event_seats($event = 0,$ticket_class_id=0)
		{
			if ($event < 1)
			{
			        return FALSE;
			}


			$group_unit_total_sql = "";
			if ( $ticket_class_id < 1 ) {
				$group_unit_total_sql = "sum(ticket_seat_master.unit_total) as group_unit_total,";
			}

			$this->db->select('ticket_seat_master.*,
							   '.$group_unit_total_sql.'
				               ticket_section.id as ticket_section_section_id,
							   ticket_section.section as ticket_section_section,
							   ticket_section.title as ticket_section_title,
							   ticket_class.id as ticket_class_id,
							   ticket_class.class as ticket_class_class,
							   ticket_class.title as ticket_class_title,
							   ticket_class.tool_tip as ticket_class_tool_tip,
							   ticket_class.ticket_selection_type'
							  );
							  
			$this->db->from('ticket_seat_master');
			$this->db->where('ticket_seat_master.event_id', $event);
			if($ticket_class_id>0) { $this->db->where('ticket_seat_master.ticket_class_id', $ticket_class_id); }
			$this->db->join('ticket_class', 'ticket_class.id = ticket_seat_master.ticket_class_id','left');
			$this->db->join('ticket_section', 'ticket_section.id = ticket_class.section_id','left');	
			if ( $ticket_class_id < 1 ) {
			$this->db->group_by("ticket_seat_master.ticket_class_id"); 		
			}
			$this->db->order_by('ticket_seat_master.table_start_number ASC');
			$this->db->order_by('ticket_section.order ASC');
			$this->db->order_by('ticket_class.order ASC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->result_array();
		}

		public function get_event_seats_booked($event = 0, $ticket_class_id = 0)
		{
			if ($event < 1 || $ticket_class_id <1)
			{
			        $query = $this->db->get('order_seat_details');
			        return $query->result_array();
			}
			$this->db->select('order_seat_details.seat_number as occupied_seat_number');
			$this->db->from('order_seat_details');
			$this->db->where('order_seat_details.event_id', $event);
			$this->db->where('order_seat_details.ticket_class_id', $ticket_class_id);
			$query = $this->db->get();
			$array = array();
			$result_array = $query->result_array();
			foreach($result_array  as $row) {
				$array[] = $row['occupied_seat_number'];
			}
			return $array;
		}

		public function get_event_table_booked_details($event = 0, $ticket_class_id = 0)
		{
			if ($event < 1 || $ticket_class_id <1)
			{
			        $query = $this->db->get('order_seat_details');
			        return $query->result_array();
			}
			$this->db->select('COUNT(order_seat_details.seat_number) as occupied_seat_count, order_seat_details.table_number as occupied_table_number');
			$this->db->from('order_seat_details');
			$this->db->where('order_seat_details.event_id', $event);
			$this->db->where('order_seat_details.ticket_class_id', $ticket_class_id);
			$this->db->group_by("order_seat_details.table_number"); 
			$query = $this->db->get();
			$result_array = $query->result_array();
			return $result_array;
		}



		public function get_event_missing_seats($event = 0, $ticket_class_id = 0)
		{
			if ($event < 1 || $ticket_class_id <1)
			{
			        $query = $this->db->get('ticket_missing_seats');
			        return $query->result_array();
			}
			$this->db->select('ticket_missing_seats.seat_number as missing_seat_number');
			$this->db->from('ticket_missing_seats');
			$this->db->where('ticket_missing_seats.event_id', $event);
			$this->db->where('ticket_missing_seats.ticket_class_id', $ticket_class_id);
			$query = $this->db->get();

			$array = array();
			$result_array = $query->result_array();
			foreach($result_array  as $row) {
				$array[] = $row['missing_seat_number'];
			}

			return $array;
		}



		/*
		Backend
		*/

		public function get_additional_charge_by_id($event_id = 0) {
	
			$query		  = $this->db->get_where('event_additional_charges', array('event_id' => $event_id));
		    $result_array = $query->result_array();
		    $array = array();
		    foreach($result_array as $k=>$row) {
				$array[$row['additional_charge_field']] = array(
								"additional_charge_title" => $row['additional_charge_title'],
								"additional_charge_type" => $row['additional_charge_type'],
								"additional_charge" => $row['additional_charge'],
								"views" => $row['views']
								);
			}
			return $array;
		}
		/**FRONT END**/
		public function get_additional_charge($event_id = 0) {
	
			$query		  = $this->db->get_where('event_additional_charges', array('event_id' => $event_id));
		    $result_array = $query->result_array();
		    $array = array();
		    foreach($result_array as $k=>$row) {
				$array[$row['additional_charge_field']] = array(
								"additional_charge_title" => $row['additional_charge_title'],
								"additional_charge_type" => $row['additional_charge_type'],
								"additional_charge" => $row['additional_charge'],
								"views" => $row['views']
								);
			}
			return $array;
		}

		public function get_event_by_id($event_id = 0)
		{
			if ( $event_id > 0 )
			{
		        $this->db->select('em.*,ce.category_id');
				$this->db->from('event_master em');
				$this->db->join('category_event ce', 'ce.event_id = em.id','left');
				$this->db->where('em.id', $event_id);
				$query = $this->db->get();
				
		        return $query->row_array();
			}else{
				return FALSE;
			}	
		}
		public function get_user_by_id($event_id=null)
		{
			if ( $event_id > 0 )
			{
		        $this->db->select('em.*,ce.category_id');
				$this->db->from('event_master em');
				$this->db->join('category_event ce', 'ce.event_id = em.id','left');
				$this->db->where('em.id', $event_id);
				$query = $this->db->get();
		        return $query->row_array();
			}else{
				return FALSE;
			}	
		}

		public function getNextId() {
			$this->db->select('max(id) as latest_id');
			$this->db->from('event_master');
			$query = $this->db->get();
			$row_array = $query->row_array();
			$new_id = intval($row_array["latest_id"]) + 1;
			return $new_id;
		}

		public function updateEventThumb($data) 
		{
			$event_id   = $data["event_id"];

			if ( isset($data['img_extension']) ) {
				$event_data = array(
				'img_extension' 	=> $data['img_extension'],
				'thumb1' => $data['thumb1'],
				'thumb2' => $data['thumb2']
				);
			}elseif ( isset($data['img_extension_main_carousel']) ) {
				$event_data = array(
				'img_extension_main_carousel' 	=> $data['img_extension_main_carousel'],
				'thumb1_main_carousel' => $data['thumb1_main_carousel']
				);
			}elseif( isset($data['img_extension_recommended_carousel'])  ) {
				$event_data = array(
				'img_extension_recommended_carousel' 	=> $data['img_extension_recommended_carousel'],
				'thumb1_recommended_carousel' => $data['thumb1_recommended_carousel']
				);	
			}

			$this->db->where('id', $event_id);
			$this->db->update('event_master', $event_data); 
			return $event_id;
		}

		/********
		ADMIN EVENT CREATER
		***********/

		public function createUpdateEvent($data) 
		{
			$title         			= trim($data['title']);
	        $slug       			= trim($data['slug']);

	        $start_date       		= trim($data['start_date']);
	        $end_date       		= trim($data['end_date']);

	        $summary      			= trim($data['summary']);
	        $details   				= trim($data['details']);
	        $venue   				= trim($data['venue']);
	        $address   				= trim($data['address']);
	        $city   				= trim($data['city']);
	        $country   				= trim($data['country']);
	        $category_id   			= trim($data['category_id']);
	        $active      			= trim($data['active']);

	        $event_id      			= trim($data['event_id']);

	        // Set Visibility
	        $show_main_carousel		= isset($data['show_main_carousel']) && $data['show_main_carousel'] == 'Y'  ? 'Y' : 'N';
	        $show_recommended_carousel	= isset($data['show_recommended_carousel']) && $data['show_recommended_carousel'] == 'Y'  ? 'Y' : 'N';
	        $show_hot_ticket		= isset($data['show_hot_ticket']) && $data['show_hot_ticket'] == 'Y'  ? 'Y' : 'N';
	        $show_just_announced	= isset($data['show_just_announced']) && $data['show_just_announced'] == 'Y'  ? 'Y' : 'N';


	        if ( $title == "" || $slug == "" || $summary == "" || $details == "" || $venue == "" || $address == "" || 
	        	 $city == "" || $country == "" || $start_date =="" || $category_id < 1 
	        	 ) {
	        	$array["success"] = false;
				$array["message"] = "Event mandatory fields should not be empty!";
				return $array;	
	        }

			$this->db->select('id, title, slug');
			$this->db->from('event_master');
			$this->db->where('title', $title);
			$this->db->or_where('slug', $slug); 
			$this->db->limit(1);

			$query = $this->db->get();

			if( ($query->num_rows() == 1) && ($event_id != $query->result_array()[0]["id"]) )
			{	
				$array["success"] = false;
				$array["cat_id"]  = $query->result_array()[0]["id"];
				$array["message"] = "Event name/slug already exist!";
				return $array;
			}
			else
			{ 
				 $event_data = array(
				'title' => $title,
				'slug' => $slug,
				'start_date'=> $start_date,
				'end_date'	=> $end_date,
				'summary'	=> $summary,
				'details'	=> $details,
				'venue'	=> $venue,
				'address'	=> $address,
				'city'	=> $city,
				'country'	=> $country,
				'province'	=> trim($data['province']),
				'additional_charity' => intval($data['additional_charity']) > 0 ? trim($data['additional_charity']) : 0,
				'active' => $active,
				'map_location' => trim($data['map_location']),
				'youtube_url' => trim($data['youtube_url']),
				'show_main_carousel' => $show_main_carousel,
				'show_recommended_carousel' => $show_recommended_carousel,
				'show_hot_ticket' => $show_hot_ticket,
				'show_just_announced' => $show_just_announced,
				'hot_ticket_tootip_title' => trim($data['hot_ticket_tootip_title']),
				'hot_ticket_tootip_details' => trim($data['hot_ticket_tootip_details']),
				'just_announced_tootip_title' => trim($data['just_announced_tootip_title']),
				'just_announced_tootip_details' => trim($data['just_announced_tootip_details']),
				'modified_date' => date("Y-m-d H:i:s")
				);

				if ( $event_id < 1 ) {
					$event_data['id'] =  $this->getNextId();
					$array["created_date"]   = date("Y-m-d H:i:s");
					$this->db->insert('event_master', $event_data); 
					$event_id = $this->db->insert_id();

					$array["success"] = true;
					$array["event_id"]  = $event_id;				
					$array["message"] = "Event has been created successfully";

				}else{
					$this->db->where('id', $event_id);	
					$this->db->update('event_master', $event_data);

					$this->db->delete('category_event', array('event_id' => $event_id)); 
					$this->db->delete('event_additional_charges', array('event_id' => $event_id));

					$array["success"] = true;
					$array["event_id"]  = $event_id;
					$array["message"] = "Event has been updated successfully";
				}


				/* Category event mapping  */
				$category_data = array(
						'category_id' => $category_id,
						'event_id' => $event_id
					);
				$this->db->insert('category_event', $category_data); 


				/* Additional charges */

				if ( intval($data['fulfilment_fee']) > 0 ) {
					$additional_charge_data = array(
						'additional_charge_title' => 'Fulfilment Fees',
						'additional_charge_field' => 'fulfilment_fee',
						'additional_charge_type' => $data['fulfilment_fee_type'],
						'additional_charge' => trim($data['fulfilment_fee']),
						'event_id' => $event_id,
						'views' => 'R,B,P'
					);
					$this->db->insert('event_additional_charges', $additional_charge_data);
				}


				if ( intval($data['postage_fee']) > 0 ) {
					$additional_charge_data = array(
						'additional_charge_title' => 'Postage Fees',
						'additional_charge_field' => 'postage_fee',
						'additional_charge_type' => $data['postage_fee_type'],
						'additional_charge' => trim($data['postage_fee']),
						'event_id' => $event_id,
						'views' => 'R,B,P'
					);
					$this->db->insert('event_additional_charges', $additional_charge_data);
				}

				if ( intval($data['credit_card_fee']) > 0 ) {
					$additional_charge_data = array(
						'additional_charge_title' => 'Credit Card Charges',
						'additional_charge_field' => 'credit_card_fee',
						'additional_charge_type' => $data['credit_card_fee_type'],
						'additional_charge' => trim($data['credit_card_fee']),
						'event_id' => $event_id,
						'views' => 'B,P'
					);
					$this->db->insert('event_additional_charges', $additional_charge_data);
				}



				if ( $event_id > 0 ) {
				
					/* Set Category Main Image */
					$configImage = array();
					
					$configImage['tb_field_name']   =  "img_extension";
					$configImage['img_field_name']  =  "img_extension";
					$configImage['upload_path']     =  FCPATH . 'assets/upload/event/';
					$configImage['allowed_types']   = 'gif|jpg|png';
					$configImage['max_width']       = '0'; // Set to zero for no limit 
					$configImage['max_height']      = '0';
					$configImage['overwrite']       =  TRUE;
					$configImage['file_name']       =  'event_img_' . $event_id; 

					/* Set Category Thumb Image */
					$configImageArr = array(
							"image_library" => "gd2",
							"quality" => "100%",
							"create_thumb" => FALSE,
							"maintain_ratio" => TRUE,
							"new_image_folder" => FCPATH . 'assets/upload/event/thumb/',
							"thumb_configs" => array(
								array(
									"tb_field_name" => "thumb1",
									"file_name" => "thumb1",
									"width" => 350,
									"height" => 400
								),
								array(
									"tb_field_name" => "thumb2",
									"file_name" => "thumb2",
									"width" => 300,
									"height" => 250
								)
							)	
						);

					$RESPONSE = $this->uploadImages ($configImage, $configImageArr);


					if ( $RESPONSE["img_thumb_arr"] && sizeof( $RESPONSE["img_thumb_arr"] ) > 0 ) {
						$RESPONSE["img_thumb_arr"]["event_id"] = $event_id;
						$this->updateEventThumb ( $RESPONSE["img_thumb_arr"] );
					}


					/* Set Category main carousel Image */
					$configImage = array();
					
					$configImage['tb_field_name']   =  "img_extension_main_carousel";
					$configImage['img_field_name']  =  "img_extension_main_carousel";
					$configImage['upload_path']     =  FCPATH . 'assets/upload/event/';
					$configImage['allowed_types']   = 'gif|jpg|png';
					$configImage['max_width']       = '0'; // Set to zero for no limit 
					$configImage['max_height']      = '0';
					$configImage['overwrite']       =  TRUE;
					$configImage['file_name']       =  'event_img_main_carousel_' . $event_id; 

					/* Set Category Thumb Image */
					$configImageArr = array(
							"image_library" => "gd2",
							"quality" => "100%",
							"create_thumb" => FALSE,
							"maintain_ratio" => FALSE,
							"new_image_folder" => FCPATH . 'assets/upload/event/thumb/',
							"thumb_configs" => array(
								array(
									"tb_field_name" => "thumb1_main_carousel",
									"file_name" => "thumb1",
									"width" => 175,
									"height" => 328
								)
							)	
						);


					$RESPONSE = $this->uploadImages ($configImage, $configImageArr);


					if ( $RESPONSE["img_thumb_arr"] && sizeof( $RESPONSE["img_thumb_arr"] ) > 0 ) {
						$RESPONSE["img_thumb_arr"]["event_id"] = $event_id;
						$this->updateEventThumb ( $RESPONSE["img_thumb_arr"] );
					}


					/* Set Category recommended carousel Image */
					$configImage = array();
					
					$configImage['tb_field_name']   =  "img_extension_recommended_carousel";
					$configImage['img_field_name']  =  "img_extension_recommended_carousel";
					$configImage['upload_path']     =  FCPATH . 'assets/upload/event/';
					$configImage['allowed_types']   = 'gif|jpg|png';
					$configImage['max_width']       = '0'; // Set to zero for no limit 
					$configImage['max_height']      = '0';
					$configImage['overwrite']       =  TRUE;
					$configImage['file_name']       =  'event_img_recommended_carousel_' . $event_id; 

					/* Set Category Thumb Image */
					$configImageArr = array(
							"image_library" => "gd2",
							"quality" => "100%",
							"create_thumb" => FALSE,
							"maintain_ratio" => FALSE,
							"new_image_folder" => FCPATH . 'assets/upload/event/thumb/',
							"thumb_configs" => array(
								array(
									"tb_field_name" => "thumb1_recommended_carousel",
									"file_name" => "thumb1",
									"width" => 175,
									"height" => 130
								)
							)	
						);

					$RESPONSE = $this->uploadImages ($configImage, $configImageArr);


					if ( $RESPONSE["img_thumb_arr"] && sizeof( $RESPONSE["img_thumb_arr"] ) > 0 ) {
						$RESPONSE["img_thumb_arr"]["event_id"] = $event_id;
						$this->updateEventThumb ( $RESPONSE["img_thumb_arr"] );
					}

					
					return $array;
				}
				
			}

			$array["success"] = false;
			$array["message"] = "Error!, Try again later";
			return $array;
		}

		
		/********
		USER EVENT CREATER
		***********/

		public function createUserEvent($data) 
		{ 
			$title         			= trim($data['title']);
			$u_id         			= trim($data['user_id']);
			$slug         			= trim($data['slug']);
			$venue      			= trim($data['venue']);
	        $start_date       		= trim($data['start_date']);
	        $start_time      		= trim($data['start_time']);
			$end_date      			= trim($data['end_date']);
			$end_time   	   		= trim($data['end_time']);
	        $detail   				= trim($data['detail']);
			$category   			= trim($data['category']);
			$summary   				= trim($data['summary']);
		
			$organizer_name      	= trim($data['organizer_name']);
			$organizer_description  = trim($data['organizer_description']);
			if ($start_date=="")
			{
			$start_date=date("Y-m-d");
			}
			
			$abs=array(
			'user_id'				=> $u_id,
			'title'         		=> $title,
			'slug'         			=> $slug,
	        'venue'       			=> $venue,
	        'start_date'       		=> $start_date,
	        'start_time'       		=> $start_time,
			'end_date'       		=> $end_date,
			'end_time'       		=> $end_time,
			'details'   			=> $detail,
			'category'   			=> $category,
			'summary'   			=> $summary,
	        'created_date'   		=> date("Y-m-d H:i:s"),
			'organizer_name'      	=> $organizer_name,
			'organizer_description' => $organizer_description);
			$this->db->insert('user_event', $abs); 
			$event_id = $this->db->insert_id();
			$this->session->set_userdata('event_user', serialize($event_id));
				
						if ( $event_id > 0 ) {
				
					/* Set Category Main Image */
					$configImage = array();
					$configImage['tb_field_name']   =  "img_extension";
					$configImage['img_field_name']  =  "img_extension_main_carousel";
					$configImage['upload_path']     =  FCPATH . 'assets/upload/event/';
					$configImage['allowed_types']   = 'gif|jpg|png';
					$configImage['max_width']       = '0'; // Set to zero for no limit 
					$configImage['max_height']      = '0';
					$configImage['overwrite']       =  TRUE;
					$configImage['file_name']       =  'img_extension_main_carousel' . $event_id; 

					/* Set Category Thumb Image */
					$configImageArr = array(
							"image_library" => "gd2",
							"quality" => "100%",
							"create_thumb" => FALSE,
							"maintain_ratio" => TRUE,
							"new_image_folder" => FCPATH . 'assets/upload/event/thumb/',
							"thumb_configs" => array(
								array(
									"tb_field_name" => "thumb1",
									"file_name" => "thumb1",
									"width" => 350,
									"height" => 400
								),
								array(
									"tb_field_name" => "thumb2",
									"file_name" => "thumb2",
									"width" => 350,
									"height" => 400
								)
							)	
						);

					$RESPONSE = $this->uploadImages ($configImage, $configImageArr);


					if ( $RESPONSE["img_thumb_arr"] && sizeof( $RESPONSE["img_thumb_arr"] ) > 0 ) {
						$RESPONSE["img_thumb_arr"]["event_id"] = $event_id;
						$this->updateEventImage ( $RESPONSE["img_thumb_arr"] );
					}


					/* Set Category main carousel Image */
					$configImage = array();
					
					$configImage['tb_field_name']   =  "img_extension_main_carousel";
					$configImage['img_field_name']  =  "img_extension_main_carousel";
					$configImage['upload_path']     =  FCPATH . 'assets/upload/event/';
					$configImage['allowed_types']   = 'gif|jpg|png';
					$configImage['max_width']       = '0'; // Set to zero for no limit 
					$configImage['max_height']      = '0';
					$configImage['max_size']      	= '2097152';
					$configImage['overwrite']       =  TRUE;
					$configImage['file_name']       =  'img_extension_main_carousel' . $event_id; 

					/* Set Category Thumb Image */
					$configImageArr = array(
							"image_library" => "gd2",
							"quality" => "100%",
							"create_thumb" => FALSE,
							"maintain_ratio" => FALSE,
							"new_image_folder" => FCPATH . 'assets/upload/event/thumb/',
							"thumb_configs" => array(
								array(
									"tb_field_name" => "thumb1_main_carousel",
									"file_name" => "thumb1",
									"width" => 350,
									"height" => 400
								)
							)	
						);


					$RESPONSE = $this->uploadImages ($configImage, $configImageArr);


					if ( $RESPONSE["img_thumb_arr"] && sizeof( $RESPONSE["img_thumb_arr"] ) > 0 ) {
						$RESPONSE["img_thumb_arr"]["event_id"] = $event_id;
						$this->updateEventImage ( $RESPONSE["img_thumb_arr"] );
					}


					/* Set Category recommended carousel Image */
					$configImage = array();
					
					$configImage['tb_field_name']   =  "img_extension_recommended_carousel";
					$configImage['img_field_name']  =  "img_extension_main_carousel";
					$configImage['upload_path']     =  FCPATH . 'assets/upload/event/';
					$configImage['allowed_types']   = 'gif|jpg|png';
					$configImage['max_width']       = '0'; // Set to zero for no limit 
					$configImage['max_height']      = '0';
					$configImage['overwrite']       =  TRUE;
					$configImage['file_name']       =  'event_img_main_carousel' . $event_id; 

					/* Set Category Thumb Image */
					$configImageArr = array(
							"image_library" => "gd2",
							"quality" => "100%",
							"create_thumb" => FALSE,
							"maintain_ratio" => FALSE,
							"new_image_folder" => FCPATH . 'assets/upload/event/thumb/',
							"thumb_configs" => array(
								array(
									"tb_field_name" => "thumb1_recommended_carousel",
									"file_name" => "thumb1",
									"width" => 350,
									"height" => 400
								)
							)	
						);

					$RESPONSE = $this->uploadImages ($configImage, $configImageArr);


					if ( $RESPONSE["img_thumb_arr"] && sizeof( $RESPONSE["img_thumb_arr"] ) > 0 ) {
						$RESPONSE["img_thumb_arr"]["event_id"] = $event_id;
						$this->updateEventImage ( $RESPONSE["img_thumb_arr"] );
					}else
					{
						$this->db->where('id', $event_id);
						$this->db->delete("user_event");
					return false ;
					}
					
	
					return $event_id;
				}
					
		}
		
		public function updateEventImage($data) 
		{
			$event_id   = $data["event_id"];

			if ( isset($data['img_extension']) ) {
				$event_data = array(
				'img_extension' 	=> $data['img_extension'],
				'thumb1' => $data['thumb1'],
				'thumb2' => $data['thumb2']
				);
			}elseif ( isset($data['img_extension_main_carousel']) ) {
				$event_data = array(
				'img_extension_main_carousel' 	=> $data['img_extension_main_carousel'],
				'thumb1_main_carousel' => $data['thumb1_main_carousel']
				);
			}elseif( isset($data['img_extension_recommended_carousel'])  ) {
				$event_data = array(
				'img_extension_recommended_carousel' 	=> $data['img_extension_recommended_carousel'],
				'thumb1_recommended_carousel' => $data['thumb1_recommended_carousel']
				);	
			}

			$this->db->where('id', $event_id);
			$this->db->update('user_event', $event_data); 
			return $event_id;
		}

	
		/* Promote event section */	
		public function promote_event_record_count() {			
			$this->db->from('event_promote');
			$count = $this->db->count_all_results();
			//echo $this->db->last_query();
			return $count;
		}

		public function get_promote_events($limit,$start)
		{
			$this->db->limit($limit, $start);

			$this->db->select('ep.*');
			$this->db->from('event_promote ep');
			$this->db->order_by('ep.id DESC');
			$query = $this->db->get();
			return $query->result_array();		
		}

		public function getNextEventPromoteId() {
			$this->db->select('max(id) as latest_id');
			$this->db->from('event_promote');
			$query = $this->db->get();
			$row_array = $query->row_array();
			$new_id = intval($row_array["latest_id"]) + 1;
			return $new_id;
		}

		public function get_promote_event_by_id($id = 0)
		{
			if ( $id > 0 )
			{
		        $query = $this->db->get_where('event_promote', array('id' => $id));
		        return $query->row_array();
			}else{
				return FALSE;
			}	
		}


		public function updatePromoteEventThumb($data) 
		{
			$id   = $data["id"];
			if ( isset($data['img_extension']) ) {
				$promote_event_data = array(
				'img_extension' 	=> $data['img_extension'],
				'thumb1' => $data['thumb1']
				);

				$this->db->where('id', $id);
				$this->db->update('event_promote', $promote_event_data); 
				return $id;
			}
			return false;		
		}



		public function createUpdatePromoteEvent($data) 
		{

			$title   						= trim($data['title']);
			$url_target         			= $data['url_target'];
	        $url       						= trim($data['url']);
	        $active       					= trim($data['active']);
	        $id       						= $data['id'];
	      
	        if( $title == "" ) {
	        	$array["success"] = false;
				$array["message"] = "Title is missing!";
				return $array;
	        }

	      
			$this->db->select('event_promote.*');
			$this->db->from('event_promote');
			$this->db->where('event_promote.title', $title);
			if( $id > 0) {
				$this->db->where('id!=', $id);
			}		
			$this->db->limit(1);
			$query = $this->db->get();

			if($query->num_rows() == 1)
			{	
				$array["success"] = false;
				$array["id"]  = $query->result_array()[0]["id"];
				$array["message"] = "Title already exist!";
				return $array;
			}
			else
			{	
				$event_promote_data = array(
				'title' => $title,
				'url' => $url,
				'url_target' 	=> $url_target,
				'active'	=> $active,
				'modified_date' => date("Y-m-d H:i:s")
				);

				if ( $id > 0 ) {
					$this->db->where('id', $id);	
					$this->db->update('event_promote', $event_promote_data);
					$array["success"] = true;
					$array["message"] = "Promote event has been updated successfully";
				}else{				
					$event_promote_data["id"] = $this->getNextEventPromoteId();	
					$event_promote_data["created_date"] = date("Y-m-d H:i:s");			
					$this->db->insert('event_promote', $event_promote_data); 
					$id = $this->db->insert_id();
					$array["success"] = true;
					$array["message"] = "Promote event has been added successfully";
				}	


				if ( $id > 0 ) {
					/* Set main Image */
					$configImage = array();
					
					$configImage['tb_field_name']   =  "img_extension";
					$configImage['img_field_name']  =  "img_extension";
					$configImage['upload_path']     =  FCPATH . 'assets/upload/event/';
					$configImage['allowed_types']   = 'gif|jpg|png';
					$configImage['max_width']       = '0'; // Set to zero for no limit 
					$configImage['max_height']      = '0';
					$configImage['overwrite']       =  TRUE;
					$configImage['file_name']       =  'promote_event_img_' . $id; 

					/* Set Category Thumb Image */
					$configImageArr = array(
							"image_library" => "gd2",
							"quality" => "100%",
							"create_thumb" => FALSE,
							"maintain_ratio" => FALSE,
							"new_image_folder" => FCPATH . 'assets/upload/event/thumb/',
							"thumb_configs" => array(
								array(
									"tb_field_name" => "thumb1",
									"file_name" => "thumb1",
									"width" => 89,
									"height" => 68
								)
							)	
						);

					$RESPONSE = $this->uploadImages ($configImage, $configImageArr);


					if ( $RESPONSE["img_thumb_arr"] && sizeof( $RESPONSE["img_thumb_arr"] ) > 0 ) {
						$RESPONSE["img_thumb_arr"]["id"] = $id;
						$this->updatePromoteEventThumb ( $RESPONSE["img_thumb_arr"] );
					}
				}

				return $array;
			}

			$array["success"] = false;
			$array["message"] = "Error!, Try again later";
			return $array;
		}



		public function deletePromoteEvent($id = 0) {
			$this->db->delete('event_promote', array('id' => $id)); 
			$array["success"] = true;
			$array["message"] = "Event has been deleted successfully";
			return $array;
		}






		/* Common methods */

		public function uploadImages($configImage, $configImageArr) {

			/* Default response */
			$array["success"] 		= false;		
			$array["message"] 		= "Image uploading Failed!, Try again later"; 
			$array["img_thumb_arr"] = array(); 

            $this->load->library('upload', $configImage);

            /* reset */
			$this->upload->initialize($configImage);

            if ( !$this->upload->do_upload($configImage['img_field_name']))
            {
				$array["success"] = false;
				$array["message"] = $this->upload->display_errors();
				return $array;
            }
            else
            {
            	$array["success"] = true;
				$array["message"] = "Image uploaded successfully";


                $uploadedFileArr   =  $this->upload->data();  


                if(is_file($uploadedFileArr['full_path']))
                {
                    chmod($uploadedFileArr['full_path'], 0777); ## this should change the permissions
                    $array["img_thumb_arr"][$configImage['tb_field_name']] = $uploadedFileArr['file_ext'];
                }

				$configImageLib['image_library']    	= $configImageArr['image_library'];
				$configImageLib['quality']          	= $configImageArr['quality'];
				$configImageLib['maintain_ratio']     	= $configImageArr['maintain_ratio'];
				$configImageLib['source_image']     	= $uploadedFileArr["full_path"];

                $this->load->library('image_lib', $configImageLib);
                
				foreach($configImageArr["thumb_configs"]  as $configImageArrItem) {

					$configImageLib['image_library']    	= $configImageArr['image_library'];
					$configImageLib['quality']          	= $configImageArr['quality'];
					$configImageLib['maintain_ratio']     	= $configImageArr['maintain_ratio'];
					$configImageLib['source_image']     	= $uploadedFileArr["full_path"];
					$configImageLib['width'] 	 			= $configImageArrItem['width'];
					$configImageLib['height'] 	 			= $configImageArrItem['height'];
					$configImageLib['new_image'] 			= $configImageArr['new_image_folder'] . $uploadedFileArr['raw_name'] . "_". $configImageArrItem['file_name'] . $uploadedFileArr['file_ext'];    

					$this->image_lib->initialize($configImageLib);

	                if ( ! $this->image_lib->resize())
	                {
	                    $array["success"] = false;
						$array["message"] = $this->image_lib->display_errors();
						return $array;
	                }else{
	                	
	                    if(is_file($configImageLib['new_image']))
	                    {
	                        chmod($configImageLib['new_image'], 0777); ## this should change the permissions
							$array["success"] = true;
							$array["message"] = "Thumb mage uploaded successfully";
							$array["img_thumb_arr"][$configImageArrItem['tb_field_name']] = $uploadedFileArr['raw_name'] . "_". $configImageArrItem['file_name'] . $uploadedFileArr['file_ext'];
	                    }
	                }              
					$this->image_lib->clear();
				}		       
            }

    		return $array;
		}
		
	/***
	search result
	***/
	public function search_get_events($cat_id=null,$country=null,$day=null,$limit,$start)
	{
		$this->db->limit($limit, $start);
		$filter 			=	$this->input->get('q');
		
				$this->db->select('em.title,em.start_date,em.summary,em.address,em.slug,em.thumb1_main_carousel,em.thumb1_recommended_carousel,
								   em.show_main_carousel, em.show_recommended_carousel, em.show_hot_ticket, em.show_just_announced,
								   em.hot_ticket_tootip_title,em.hot_ticket_tootip_details,em.just_announced_tootip_title,em.just_announced_tootip_details,
					               ce.category_id,cm.category_name,
					               count(tsm.id) as ticketseatrows
					              ');
				
				$this->db->from('event_master em');
				$this->db->where('(em.show_main_carousel = "Y" OR em.show_recommended_carousel = "Y" OR em.show_hot_ticket = "Y" OR em.show_just_announced = "Y") AND (em.venue LIKE "%'.$filter.'%" or em.city LIKE "%'.$filter.'%" or em.address LIKE "%'.$filter.'%" or em.title LIKE "%'.$filter.'%" or cm.category_name LIKE "%'.$filter.'%")');
				$this->db->where('em.active', 'Y');
				if($cat_id)
					$this->db->where('cm.cat_id', $cat_id);
				if($country)
					$this->db->LIKE('em.country', $country,'BOTH');
					if($day){
					$start_Date		=	'';
					$to_Date		=	'';
					if($day == 'today'){
						$start_Date	=	date('Y-m-d');
					}elseif($day == 'tomorrow'){
						$start_Date	=	date('Y-m-d', strtotime("+1 days"));
					}elseif($day == 'this-week'){
						$start_Date	=	date('Y-m-d');
						$to_Date	=	date('Y-m-d', strtotime("+7 days"));
					}elseif($day == 'next-week'){
						$start_Date	=	date('Y-m-d', strtotime("+7 days"));
						$to_Date	=	date('Y-m-d', strtotime("+14 days"));
					}	
					if($start_Date && $to_Date)	
						$this->db->where("em.start_Date >= '{$start_Date}' and em.start_Date <='{$to_Date}'");
					elseif($start_Date)
						$this->db->where("em.start_Date",$start_Date);
				}else{ 
					$start_Date	=	date('Y-m-d');
					//$this->db->where("em.start_Date >= '{$start_Date}'");
				}
					
				$this->db->join('category_event ce', 'ce.event_id = em.id','left');
				//$this->db->join('category_event', 'category_event.category_event_id = em.id', 'left');
				
				$this->db->join('category_master cm', 'cm.cat_id = ce.category_id','left');
				$this->db->join('ticket_seat_master tsm', 'tsm.event_id = em.id','left');
				$this->db->group_by("em.id"); 
				$query = $this->db->get();
				//echo $this->db->last_query();
				if($limit){
					return $query->result_array();
				}else{
					return count($query->result_array());
				}	
			
	}
	public function get_events($limit,$start,$event_name=null)
		{
			$this->db->limit($limit, $start);
			$this->db->select('em.*,ce.category_id,cm.category_name');
			$this->db->from('event_master em');
			$this->db->join('category_event ce', 'ce.event_id = em.id','left');
			$this->db->join('category_master cm', 'cm.cat_id = ce.category_id','left');
			if($event_name)
						$this->db->like('em.title',$event_name,'Both');	
					
					$this->db->group_by("em.id"); 
					$this->db->order_by('em.id DESC');
					$query = $this->db->get();
			
	        return $query->result_array();
		}
		
	public function record_count($event_name=null) {
			//return $this->db->count_all("event_master");
			$this->db->limit($limit, $start);
			$this->db->select('em.*,ce.category_id,cm.category_name');
			$this->db->from('event_master em');
			$this->db->join('category_event ce', 'ce.event_id = em.id','left');
			$this->db->join('category_master cm', 'cm.cat_id = ce.category_id','left');
			if($event_name)
						$this->db->like('em.title',$event_name,'Both');	
					
					$this->db->group_by("em.id"); 
					$this->db->order_by('em.id ASC');
					
					$query = $this->db->get();
					$row	=	$query->result_array();
					
					$total	=	count($row);
					//print_r($total);die;
					return $total;
	       // return $query->result_array();
		}
		
		public function booking_admin($price,$quantity,$data)
		{ 			
				$this->db->insert('order_master', $data);
    			$user_id = $this->db->insert_id();
				
				$event_id	=	$user_id;
				//print_r($data);die;
				 if($event_id){
					 
					
					 $code					 =  time().rand(1000000,100000000);
					 
					 $email           		 =  $data['email'];
					 $admin_session 		 = 	$this->session->userdata('admin_session');
					 $user_ids			     =	$admin_session['id'];
					
					
					$response = $this->user_details->invitation_event(array(
					'code'						=> $code ,
					'event_id'					=> $event_id ,
					'admin_id'					=> $user_ids ,
					'invite_email'				=> $email ,
					'created_date'				=> date('Y-m-d H:i:s')
					 )); 
					$data=array(
				 	'user_id'	=>  $user_id,
					'first_name'   =>	$data['first_name'],);
		
					if($response){
					  $this->load->library('email');
					  $this->email->from('boxer.sprighttech01@gmail.com' , 'Ticket baby');
					  $this->email->to($email); 
					  $this->email->subject("Order confirmation email by ticket baby");
					  
				
					
				  	  $html_email = $this->load->view('admin/event/email_invite', $data, true);	

  					  $this->email->message($html_email);
					 
					  // try send mail ant if not able print debug
					  $this->email->set_mailtype("html");	
					  if ( ! $this->email->send())
					  {
					   $this->session->set_flashdata('error', '<div class="alert alert-warning display-hide"><span>Sorry, Email <strong></strong>Not send  "'.$email.'" please try again </span></div> ');
						echo $data['message'] ="Email not sent \n".$this->email->print_debugger();      
						//$this->load->view('header');
						//$this->load->view('message',$data);
						//$this->load->view('footer');

					  }else{ 
					  $this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Successfully <strong></strong>send order details to your  "'.$email.'"</span></div> ');
						  // echo $data['message'] ="Email was successfully sent to $email";
					 
					  }
				 }
				}
				return $user_id;
		}
	
	
}