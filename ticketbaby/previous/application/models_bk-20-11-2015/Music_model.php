<?php 
class Music_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_all_events()
		{

			$this->db->select('music_master.*'
							   );
			$this->db->from('music_master');

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
				$this->db->from('music_master em');
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

        public function get_event($slug = FALSE,$cat_id=null,$start_date=null,$end_date=null,$city=null,$limit,$start)
		{
			
				$this->db->limit($limit, $start);
				
		
				$this->db->select('em.title,em.start_date,em.summary,em.address,em.slug,em.thumb1_main_carousel,em.thumb1_recommended_carousel,
								   em.show_main_carousel, em.show_recommended_carousel, em.show_hot_ticket, em.show_just_announced,
								   em.hot_ticket_tootip_title,em.hot_ticket_tootip_details,em.just_announced_tootip_title,em.just_announced_tootip_details,
					               ce.category_id,cm.category_name,
					               count(tsm.id) as ticketseatrows
					              ');
				
				$this->db->from('event_master em');
				$this->db->join('category_event ce', 'ce.event_id = em.id','left');
				//$this->db->join('category_event', 'category_event.category_event_id = em.id', 'left');
				
				$this->db->join('category_master cm', 'cm.cat_id = ce.category_id','left');
				$this->db->join('ticket_seat_master tsm', 'tsm.event_id = em.id','left');
				
				//$this->db->where('(em.show_main_carousel = "Y" OR em.show_recommended_carousel = "Y" OR em.show_hot_ticket = "Y" OR em.show_just_announced = "Y") AND (em.venue LIKE "%'.$filter.'%" or em.title LIKE "%'.$filter.'%" or cm.category_name LIKE "%'.$filter.'%")');
				if($cat_id)
				
					$this->db->where('cm.cat_id', $cat_id);
				if($slug)	
			
					$this->db->where('cm.category_slug', $slug);
				if($city)
				
					$this->db->like('em.city', $city,'Both');
				
				if($start_date && $end_date){
				
					$start_date	=	date('Y-m-d',strtotime($start_date));
					$end_date	=	date('Y-m-d',strtotime($end_date));
					$this->db->where("em.start_Date >= '{$start_Date}' and em.start_Date <='{$end_date}'");
				}elseif($start_Date){
					$start_date	=	date('Y-m-d',strtotime($start_date));
					$this->db->where("em.start_Date",$start_Date);
				}
				
				
				$this->db->where('em.active', 'Y');
				
					
				
				
				$this->db->group_by("em.id"); 
				$query = $this->db->get();
				//echo $this->db->last_query();
				
				if($limit){
					 $query->result_array();
					 return $row =  $query->result_array();
  
					//print_r($row);die('test');
					
				}else{
					return count($query->result_array());
				}	
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

		public function get_event_by_id($event_id = 0)
		{
			if ( $event_id > 0 )
			{
		        $this->db->select('em.*,ce.category_id');
				$this->db->from('music_master em');
				$this->db->join('category_event ce', 'ce.event_id = em.id','left');
				$this->db->where('em.id', $event_id);
				$query = $this->db->get();
		        return $query->row_array();
			}else{
				return FALSE;
			}	
		}

		public function record_count() {
			return $this->db->count_all("music_master");
		}

		public function get_events($limit,$start)
		{
			$this->db->limit($limit, $start);
			$this->db->select('em.*,ce.category_id,cm.category_name');
			$this->db->from('music_master em');
			$this->db->join('category_event ce', 'ce.event_id = em.id','left');
			$this->db->join('category_master cm', 'cm.cat_id = ce.category_id','left');
			$query = $this->db->get();
	        return $query->result_array();
		}


		public function getNextId() {
			$this->db->select('max(id) as latest_id');
			$this->db->from('music_master');
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
			$this->db->update('music_master', $event_data); 
			return $event_id;
		}



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
			$this->db->from('music_master');
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
					$this->db->insert('music_master', $event_data); 
					$event_id = $this->db->insert_id();

					$array["success"] = true;
					$array["event_id"]  = $event_id;				
					$array["message"] = "Event has been created successfully";

				}else{
					$this->db->where('id', $event_id);	
					$this->db->update('music_master', $event_data);

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
			
			public function registerUserNew($data) 
		{

		 	$first_name            =  trim($data['first_name']);
			$last_name      	   =  trim($data['last_name']);
            $email      		   =  trim($data['email']);
            $address      		   =  trim($data['address']);
            $area      		       =  trim($data['area']);
            $city      		       =  trim($data['city']);
            $post_code      	   =  trim($data['post_code']);
            $country      		   =  trim($data['country']);
            $mobile_number         =  trim($data['mobile_number']);
            $password        	   =  trim($data['password']);
           
		 $count=strlen($mobile_number);
		
		if ($first_name==""&&$last_name==""&&$email==""&&$address==""&&$area==""&&$city==""&&$post_code==""&&$country==""&&$mobile_number==""&&$password=="")
		{
		
		}
		else
		{
				$new_user_data = array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'email' => $email,
				'address' => $address,
				'area' => $area,
				'city' => $city,
				'postcode' => $post_code,
				'country' => $country,
				'phone' => $mobile_number,
				'password' => MD5($password),
				'active' => 'Y'
				
				);

				$this->db->insert('registration', $new_user_data); 
				$user_id = $this->db->insert_id();

			  
				}
			}


			public function change($data) 
		{

            $email_chang     		   =  trim($data['email_chang']);         
            $password_chang        	   =  trim($data['password_chang']);
            $confirm_password_chang    =  trim($data['confirm_password_chang']);
		
		if ($email_chang==""&&$confirm_password_chang==""&&$password_chang=="")
		{
		
		}
		else{
				
		if ($password_chang = $confirm_password_chang)

		{  $email_chang ;
				$change_data = array(
				
				
				'password' => MD5($confirm_password_chang),
				'active' => 'Y'
				
				);
				$this->db->where('email', $email_chang);
				//$this->db->where('password', $passwordc);
				$this->db->update('registration', $change_data); 
				
 $msg="<b><span style='color:green;font-size: 20px;'>password Change successfully.</span>";
				echo $msg;
			
				}
						else
						{
						 $msg="<b><span style='color:red;font-size: 20px;'>password not match.</span>";
				echo $msg;
						echo "password not match.";
						}}
			}
				
			public function login($data) 
		{

				 $username            =  trim($data['username']);
			 $password      	   =  md5(trim($data['password']));
		echo  $this->session->set_userdata("username");
if ($username!=="")
{
			$this->db->select('*');
			$this->db->from('registration');
			$this->db->where('email', $username);
			$this->db->where('password', $password);


			$query = $this->db->get();
		
 
        $row = $query->row_array();

     if(count($row)){
	$this->session->set_userdata($data);

if ($_SESSION['username']!=="")
{
	redirect('music/Welcome-login');
	}
	else
	{
	redirect('music/login');
	}
}	

else
	{
	Echo "Incorrect username and password";
	}
		
}		//die('test');
 

//$this->load->view('music/music_detail');
		
		}
				
	/***
	search result
	***/
	public function search_get_events($cat_id=null,$country=null,$day=null,$limit,$start)
	{
		$this->db->limit($limit, $start);
		$filter 			=	'Club Nite';
		
				$this->db->select('em.title,em.start_date,em.summary,em.address,em.slug,em.thumb1_main_carousel,em.thumb1_recommended_carousel,
								   em.show_main_carousel, em.show_recommended_carousel, em.show_hot_ticket, em.show_just_announced,
								   em.hot_ticket_tootip_title,em.hot_ticket_tootip_details,em.just_announced_tootip_title,em.just_announced_tootip_details,
					               ce.category_id,cm.category_name,
					               count(tsm.id) as ticketseatrows
					              ');
				
				$this->db->from('event_master em');
				$this->db->where('(em.show_main_carousel = "Y" OR em.show_recommended_carousel = "Y" OR em.show_hot_ticket = "Y" OR em.show_just_announced = "Y") AND (em.venue LIKE "%'.$filter.'%" or em.title LIKE "%'.$filter.'%" or cm.category_name LIKE "%'.$filter.'%")');
				$this->db->where('em.active', 'Y');
				if($cat_id)
					$this->db->where('cm.cat_id', $cat_id);
				if($country)
					$this->db->where('em.country', $country);
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

		
		



}