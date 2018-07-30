<?php

class Events extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Admin_model');
        $this->load->model('Front_model');
        $this->load->library('form_validation');
    }

    function index() {
        $this->list_events();
    }

    function list_events() {
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['events'] = $this->db->order_by('id', 'DESC')->get_where('tbl_events', array('event_type' => 0))->result();
        $data['title'] = 'Events';
        $data['main'] = 'event/list';
        $this->load->view('admin/index', $data);
    }

    function add() {
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['categories'] = $this->db->get_where('tbl_post', array('parent_id' => '0', 'remark' => '6'))->result();
		$data['userslist'] = $this->db->get_where('tbl_users', array('user_type' => '0'))->result();
		$data['coupons'] = $this->db->get_where('tbl_coupen', array('status' => '1', 'delete_status' => '0'))->result();
        $data['title'] = 'Add';
        $data['main'] = 'event/form';
        $this->load->view('admin/index', $data);
    }
	
    function save() {
		
		//print_r($_REQUEST); die;
	
        $config['upload_path'] = 'uploads/images/full';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG|GIF';
        $config['max_size'] = '200000';
        $config['max_width'] = '1024000';
        $config['max_height'] = '768000';
        $config['encrypt_name'] = true;
        $config['remove_spaces'] = true;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/full/' . $upload_data['file_name'];
            $config['new_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            //small image
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
            $config['new_image'] = 'uploads/images/small/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 235;
            $config['height'] = 235;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            //cropped thumbnail
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/small/' . $upload_data['file_name'];
            $config['new_image'] = 'uploads/images/thumbnails/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 150;
            $config['height'] = 150;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();
            $data['image'] = $upload_data['file_name'];
        }


        if ($this->upload->do_upload('image2')) {
            $upload_data = $this->upload->data();
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/full/' . $upload_data['file_name'];
            $config['new_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            //small image
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
            $config['new_image'] = 'uploads/images/small/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 235;
            $config['height'] = 235;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            //cropped thumbnail
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/small/' . $upload_data['file_name'];
            $config['new_image'] = 'uploads/images/thumbnails/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 150;
            $config['height'] = 150;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();
            $data['image2'] = $upload_data['file_name'];
        }

		if ($this->upload->do_upload('seat')) {
            $upload_data = $this->upload->data();
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/full/' . $upload_data['file_name'];
            $config['new_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

          
            $data['seat'] = $upload_data['file_name'];
        }
		
        $data['event_type'] = 0;
        $data['name'] = $this->input->post('name');
        $data['start_date'] = $this->input->post('start_date');
		$data['price'] = $this->input->post('price');
        $data['time'] = $this->input->post('time');
		$data['end_date'] = $this->input->post('end_date');
        $data['end_time'] = $this->input->post('end_time');
        $data['summary'] = $this->input->post('summary');
        $data['details'] = $this->input->post('details');
        $data['venue'] = $this->input->post('venue');
        $data['address'] = $this->input->post('address');
        $data['country'] = $this->input->post('country');
        $data['city'] = trim($this->input->post('city'));
        $data['category_id'] = $this->input->post('category_id');
        $data['status'] = $this->input->post('status');
		//User ID for event
		$data['user_id'] = $this->input->post('user_id');
        $s = $this->db->get_where('tbl_route', array('slug' => $this->input->post('slug')))->row();
        if (!empty($s) > 0) {
            $data['slug'] = $this->input->post('slug') . '1';
        } else {
            $data['slug'] = $this->input->post('slug');
        }

        if (isset($_POST['main_carousel'])) {
            $data['main_carousel'] = 1;
        } else {
            $data['main_carousel'] = 0;
        }

        if (isset($_POST['recommended_carousel'])) {
            $data['recommended_carousel'] = 1;
        } else {
            $data['recommended_carousel'] = 0;
        }

        if (isset($_POST['hot_ticket'])) {
            $data['hot_ticket'] = 1;
        } else {
            $data['hot_ticket'] = 0;
        }


        if (isset($_POST['just_announced'])) {
            $data['just_announced'] = 1;
        } else {
            $data['just_announced'] = 0;
        }

        $this->db->insert('tbl_events', $data);
        $order_id = $this->db->insert_id();

        $data_add['fulfillment_status'] = $this->input->post('fulfillment_status');
        $data_add['postage_status'] = $this->input->post('postage_status');
        $data_add['creditcard_status'] = $this->input->post('creditcard_status');
        $data_add['charity_fee'] = $this->input->post('charity_fee');
        $data_add['fulfillment_fee'] = $this->input->post('fulfillment_fee');
        $data_add['postage_fee'] = $this->input->post('postage_fee');
        $data_add['creditcard_fee'] = $this->input->post('creditcard_fee');
        $data_add['google_map'] = $this->input->post('google_map');
        $data_add['youtube_url'] = $this->input->post('youtube_url');
        $data_add['event_id'] = $order_id;
		$data_add['facebook'] = $this->input->post('facebook');
        $data_add['tweeter'] = $this->input->post('tweeter');
		
		//Organizer Details
		$data_add['organizerName'] = $this->input->post('organiser_name');
		$data_add['organizerContact'] = $this->input->post('organizer_contact');
		$data_add['organizerEmail'] = $this->input->post('organizer_email');
		$data_add['organizerWebsite'] = $this->input->post('organizer_website');
		
        $this->db->insert('additional_event_detail', $data_add);

        $route['slug'] = $data['slug'];
        $route['route'] = 'awards/award_detail/' . $order_id;
		
		// TICKET INFORMATION START
		$total_ticketInfo = $this->input->post('total_ticketInfo');
		for($i=1;$i<$total_ticketInfo;$i++){
			
			$info_image_n = "info_image_".+$i;
			$info_image = $this->input->post($info_image_n);
			if ($this->upload->do_upload($info_image)) {
				$upload_data = $this->upload->data();
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/images/full/' . $upload_data['file_name'];
				$config['new_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 600;
				$config['height'] = 500;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			  
				$ticketinfo['info_image'] = $upload_data['file_name'];
			}
			
			$ticket_id_n = "ticket_id_".+$i;
			$ticket_id = $this->input->post($ticket_id_n);
			
			$description_n = "description_".+$i; 
			$description = $this->input->post($description_n);
			
			$ticketinfo['ticket_id'] = $ticket_id;
			$ticketinfo['event_id'] = $order_id;
			$ticketinfo['description'] = $description;
			
			$this->db->insert('tbl_ticket_info', $ticketinfo);
		}
		// TICKET INFORMATION END
		
		// ETICKET INFO START
			$eticket['event_id'] = $order_id;
			$eticket['celebrities'] = $this->input->post('celebrities');
			/*$eticket['vip_guest_name'] = $this->input->post('vip_guest_name');*/
			$eticket['door_open'] = $this->input->post('door_open');
			$eticket['door_close'] = $this->input->post('door_close');
			$eticket['dress_code_policy'] = $this->input->post('dress_code_policy');
			$eticket['alcohol_for_sale'] = $this->input->post('alcohol_for_sale');
			$eticket['minimum_age_restricted'] = $this->input->post('minimum_age_restricted');
			
			$this->db->insert('tbl_eticket_info', $eticket);
		// ETICKET INFO END
		
		// $route['route'] = 'events/' . $order_id;
        $this->db->insert('tbl_route', $route);
        $route_id = $this->db->insert_id();

        redirect(base_url() . 'admin/events');
    }

    function delete($id) {

        $category = $this->db->get_where('tbl_post', array('id' => $id))->row();
        $this->db->where('id', $category->route_id);
        $this->db->delete('tbl_route');

        $this->db->where('post_id', $id);
        $this->db->delete('tbl_menu');

        $this->db->where('id', $id);
        $this->db->delete('tbl_post');
        redirect(base_url() . 'admin/category');
    }



    function edit($id) {
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['title'] = "Edit";
        $data['categories'] = $this->db->get_where('tbl_post', array('parent_id' => '0', 'remark' => '6'))->result();
		$data['userslist'] = $this->db->get_where('tbl_users', array('user_type' => '0'))->result();
		$data['coupons'] = $this->db->get_where('tbl_coupen', array('status' => '1', 'delete_status' => '0'))->result();
        $data['events'] = $this->db->get_where('tbl_events', array('id' => $id))->row();
        $data['additional_event'] = $this->db->get_where('additional_event_detail', array('event_id' => $id))->row();
		$data['ticket_info'] = $this->db->get_where('tbl_ticket_info', array('event_id' => $id))->result();
		$data['eticket_info'] = $this->db->get_where('tbl_eticket_info', array('event_id' => $id))->row();
        $data['main'] = 'event/form';
        $this->load->view('admin/index', $data);
    }

    function update() {
        $id = $this->input->post('id');

        $config['upload_path'] = 'uploads/images/full';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG|GIF';
        $config['max_size'] = '200000';
        $config['max_width'] = '1024000';
        $config['max_height'] = '768000';
        $config['encrypt_name'] = true;
        $config['remove_spaces'] = true;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/full/' . $upload_data['file_name'];
            $config['new_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            //small image
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
            $config['new_image'] = 'uploads/images/small/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 235;
            $config['height'] = 235;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            //cropped thumbnail
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/small/' . $upload_data['file_name'];
            $config['new_image'] = 'uploads/images/thumbnails/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 150;
            $config['height'] = 150;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();
            $data['image'] = $upload_data['file_name'];
        }

        if ($this->upload->do_upload('image2')) {
            $upload_data = $this->upload->data();
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/full/' . $upload_data['file_name'];
            $config['new_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            //small image
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
            $config['new_image'] = 'uploads/images/small/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 235;
            $config['height'] = 235;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            //cropped thumbnail
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/small/' . $upload_data['file_name'];
            $config['new_image'] = 'uploads/images/thumbnails/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 150;
            $config['height'] = 150;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();
            $data['image2'] = $upload_data['file_name'];
        }
		
		 if ($this->upload->do_upload('seat')) {
            $upload_data = $this->upload->data();
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'uploads/images/full/' . $upload_data['file_name'];
            $config['new_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 600;
            $config['height'] = 500;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();

            $data['seat'] = $upload_data['file_name'];
        }
		
        $data['event_type'] = 0;
        $data['name'] = $this->input->post('name');
        $data['start_date'] = $this->input->post('start_date');
        $data['time'] = $this->input->post('time');
		$data['end_date'] = $this->input->post('end_date');
        $data['end_time'] = $this->input->post('end_time');
		$data['price'] = $this->input->post('price');
        $data['summary'] = $this->input->post('summary');
        $data['details'] = $this->input->post('details');
        $data['venue'] = $this->input->post('venue');
        $data['address'] = $this->input->post('address');
        $data['country'] = $this->input->post('country');
        $data['city'] = trim($this->input->post('city'));
        $data['category_id'] = $this->input->post('category_id');
        $data['status'] = $this->input->post('status');
		//User ID for event
		$data['user_id'] = $this->input->post('user_id');
        $s = $this->db->get_where('tbl_route', array('slug' => $this->input->post('slug')))->row();
	
        if (!empty($s) > 0) {
			
            $data['slug'] = $this->input->post('slug');
        } else {
            $data['slug'] = $this->input->post('slug');
        }
		echo $data['slug'];
		
		
        if (isset($_POST['main_carousel'])) {
            $data['main_carousel'] = 1;
        } else {
            $data['main_carousel'] = 0;
        }

        if (isset($_POST['recommended_carousel'])) {
            $data['recommended_carousel'] = 1;
        } else {
            $data['recommended_carousel'] = 0;
        }

        if (isset($_POST['hot_ticket'])) {
            $data['hot_ticket'] = 1;
        } else {
            $data['hot_ticket'] = 0;
        }

        if (isset($_POST['just_announced'])) {
            $data['just_announced'] = 1;
        } else {
            $data['just_announced'] = 0;
        }

        $this->db->where('id', $id);
        $this->db->update('tbl_events', $data);
		
		$mydata['slug']=$this->input->post('slug');
		$this->db->where('route',"awards/award_detail/".$id);
        $this->db->update('tbl_route', $mydata);
		
        $data_add['postage_status'] = $this->input->post('postage_status');
        $data_add['creditcard_status'] = $this->input->post('creditcard_status');
        $data_add['fulfillment_status'] = $this->input->post('fulfillment_status');
        $data_add['fulfillment_fee'] = $this->input->post('fulfillment_fee');
        $data_add['postage_fee'] = $this->input->post('postage_fee');
        $data_add['creditcard_fee'] = $this->input->post('creditcard_fee');
        $data_add['google_map'] = $this->input->post('google_map');
        $data_add['youtube_url'] = $this->input->post('youtube_url');
		$data_add['facebook'] = $this->input->post('facebook');
        $data_add['tweeter'] = $this->input->post('tweeter');
		
		//Organizer Details
		$data_add['organizerName'] = $this->input->post('organiser_name');
		$data_add['organizerContact'] = $this->input->post('organizer_contact');
		$data_add['organizerEmail'] = $this->input->post('organizer_email');
		$data_add['organizerWebsite'] = $this->input->post('organizer_website');
		
        $this->db->where('event_id', $id);
        $this->db->update('additional_event_detail', $data_add);
		
		// TICKET INFORMATION START
		$total_ticketInfo = $this->input->post('total_ticketInfo');
		for($i=1;$i<$total_ticketInfo;$i++){
			
			$info_image_n = "info_image_".+$i;
			$info_image = $this->input->post($info_image_n);
			if ($this->upload->do_upload($info_image)) {
				$upload_data = $this->upload->data();
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/images/full/' . $upload_data['file_name'];
				$config['new_image'] = 'uploads/images/medium/' . $upload_data['file_name'];
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 600;
				$config['height'] = 500;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			  
				$ticketinfo['info_image'] = $upload_data['file_name'];
			}
			
			$ticket_id_n = "ticket_id_".+$i;
			$ticket_id = $this->input->post($ticket_id_n);
			
			$description_n = "description_".+$i; 
			$description = $this->input->post($description_n);
			
			$ticketinfo['description'] = $description;
			
			$this->db->where('ticket_id', $ticket_id);
			$this->db->where('event_id', $id);
			$this->db->update('tbl_ticket_info', $ticketinfo);
		}
		// TICKET INFORMATION END
		
		
		// ETICKET INFO START
			$eticket['celebrities'] = $this->input->post('celebrities');
			/*$eticket['vip_guest_name'] = $this->input->post('vip_guest_name');*/
			$eticket['door_open'] = $this->input->post('door_open');
			$eticket['door_close'] = $this->input->post('door_close');
			$eticket['dress_code_policy'] = $this->input->post('dress_code_policy');
			$eticket['alcohol_for_sale'] = $this->input->post('alcohol_for_sale');
			$eticket['minimum_age_restricted'] = $this->input->post('minimum_age_restricted');
			
			$this->db->where('event_id', $id);
			$this->db->update('tbl_eticket_info', $eticket);
		// ETICKET INFO END
		
        redirect(base_url() . 'admin/events');
    }

    function seats($id) {
        $data['ticket_class'] = $this->Admin_model->ticket_class();
        $data['seats_list'] = $this->db->get_where('tbl_event_seats', array('event_id' => $id))->result();
		$data['coupons'] = $this->db->get_where('tbl_coupen', array('status' => '1', 'delete_status' => '0'))->result();
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['title'] = 'Ticket Seat Setting';
        $data['main'] = 'seats/list_event';
        $data['id'] = $id;
        $this->load->view('admin/index', $data);
    }

    function add_seats() { //print_r($_REQUEST); die;
        $id = $_POST['id'];
		
		/*if($_POST['ticket_class']=="30")
		{
			$_POST['ticket_class_id']=31;
		}*/
		
        if ($this->input->post('ticket_class_id') == 0) {
            $this->form_validation->set_rules('ticket_class_id', 'Ticket Class', 'callback_check_ticket');
        } else {
            $this->form_validation->set_rules('ticket_class_id', 'Ticket Class');
        }

        if ($this->form_validation->run() == FALSE)
		{
            
			$this->seats($id);
        } 
		else
		 {
			
            $data_list['ticket_class_id'] = $this->input->post('ticket_class_id');
            $data_list['event_id'] = $id;
			
			if($_POST['ticket_class']=="12" || $_POST['ticket_class']=="13")
			{
				$data_list['table_start'] = $this->input->post('table_start');
				$data_list['table_end'] = $this->input->post('table_end');
				$data_list['seat_charge'] = $this->input->post('seat_charge');
				$data_list['table_charge'] = $this->input->post('table_charge');
				$data_list['coupon_id'] = $this->input->post('coupon_id');
				$data_list['e_ticket_status'] = $this->input->post('e_ticket_status');
				
				$this->db->insert('tbl_event_seats', $data_list);
            	$first_insert_id = $this->db->insert_id();
				 for ($i = $data_list['table_start']; $i <= $data_list['table_end']; $i++) {
                $data_table['event_id'] = $id;
                $data_table['event_seat_id'] = $first_insert_id;
                $data_table['table_no'] = $i;
                $data_table['status'] = 0;
                $this->db->insert('tbl_event_tables', $data_table);
                $second_insert_id = $this->db->insert_id();

                for ($j = 1; $j <= 10; $j++) {
                    $data_chair['event_id'] = $id;
                    $data_chair['table_no'] = $i;
                    $data_chair['table_id'] = $second_insert_id;
                    $data_chair['event_seat_id'] = $first_insert_id;
                    $data_chair['status'] = 0;
                    $this->db->insert('tbl_event_chairs', $data_chair);
                }
              }
			}
			
			/*else if($_POST['ticket_class']=="13")
			{
				$data_list['table_start'] = $this->input->post('table_start');
				$data_list['table_end'] = $this->input->post('table_end');
				$data_list['seat_charge'] = $this->input->post('seat_charge');
				$data_list['table_charge'] = $this->input->post('table_charge');
				
				$this->db->insert('tbl_event_seats', $data_list);
            	$first_insert_id = $this->db->insert_id();
				 for ($i = $data_list['table_start']; $i <= $data_list['table_end']; $i++) {
                $data_table['event_id'] = $id;
                $data_table['event_seat_id'] = $first_insert_id;
                $data_table['table_no'] = $i;
                $data_table['status'] = 0;
                $this->db->insert('tbl_event_tables', $data_table);
                $second_insert_id = $this->db->insert_id();

                for ($j = 1; $j <= 10; $j++) {
                    $data_chair['event_id'] = $id;
                    $data_chair['table_no'] = $i;
                    $data_chair['table_id'] = $second_insert_id;
                    $data_chair['event_seat_id'] = $first_insert_id;
                    $data_chair['status'] = 0;
                    $this->db->insert('tbl_event_chairs', $data_chair);
                }
              }
            	/*$data_list['table_start'] ='1';
				$data_list['table_end'] = $this->input->post('ticket_no');
				$data_list['seat_charge'] = $this->input->post('ticket_charge');
				$this->db->insert('tbl_event_seats', $data_list);
            	$first_insert_id = $this->db->insert_id();
				
				 for ($i = 1; $i <= $data_list['table_end']; $i++)
				 {
               		 $data_table['event_id'] = $id;
                	 $data_table['event_seat_id'] = $first_insert_id;
                	 $data_table['table_no'] = $i;
                	 $data_table['status'] = 0;
                	 $this->db->insert('tbl_event_tables', $data_table);
                	 $second_insert_id = $this->db->insert_id();
                 }
			
			}*/
			
			else if($_POST['ticket_class']=="27")
			{
				
            	$data_list['table_start'] ='1';
				$data_list['seat_charge'] = $this->input->post('price');
				$data_list['table_end'] = $this->input->post('addtinal_end');
				$data_list['coupon_id'] = $this->input->post('coupon_id');
				$data_list['e_ticket_status'] = $this->input->post('e_ticket_status');
				$this->db->insert('tbl_event_seats', $data_list);
            	$first_insert_id = $this->db->insert_id();
			}
			else if($_POST['ticket_class']=="30")
			{
				
            	$data_list['table_start'] ='1';
				$data_list['ticket_class_id'] = $this->input->post('ticket_class_id');
				$data_list['seat_charge'] = $this->input->post('Tickts_price');
				$data_list['table_end'] = $this->input->post('number_of_tickts');
				$data_list['coupon_id'] = $this->input->post('coupon_id');
				$data_list['e_ticket_status'] = $this->input->post('e_ticket_status');
				$this->db->insert('tbl_event_seats', $data_list);
            	$first_insert_id = $this->db->insert_id();
			}
			
            $check_id = $this->db->get_where('tbl_events', array('id' => $id))->row();

          redirect(admin_url('events/seats/' . $id));
        }
    }
	
	function ticket() 
	{
		$result = $this->db->get_where('tbl_ticket_class', array('parent_id'=>$_POST['id']))->result(); 
		foreach ($result as $tc) { ?>
           <option value="<?php echo $tc->id; ?>"  ><?php  echo $tc->class; ?></option>
       <?php } 
	}
		
    function edit_seats($seat_id, $event_id) {
        $data['ticket_class'] = $this->Admin_model->ticket_class();
        $data['seats_list'] = $this->db->get_where('tbl_event_seats', array('event_id' => $event_id))->result();
        $data['seats'] = $this->db->get_where('tbl_event_seats', array('id' => $seat_id))->row();
		$data['coupons'] = $this->db->get_where('tbl_coupen')->result();
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['title'] = 'Edit Ticket Seats';
        $data['main'] = 'seats/list_event';
        $data['id'] = $event_id;

        $this->load->view('admin/index', $data);
    }
	
	function view_seats_event($seat_id, $event_id) {
        $data['ticket_class'] = $this->Admin_model->ticket_class();
        $data['seats_list'] = $this->db->get_where('tbl_event_seats', array('event_id' => $event_id))->result();
        $data['seats'] = $this->db->get_where('tbl_event_seats', array('id' => $seat_id))->row();
		$data['coupons'] = $this->db->get_where('tbl_coupen')->result();
        $data['logo'] = $this->db->get('site_settings')->row();
        $data['title'] = 'Edit Ticket Seats';
        $data['main'] = 'seats/view_list_event';
        $data['id'] = $event_id;

        $this->load->view('admin/index', $data);
    }

    function update_seats() { //print_r($_REQUEST); die;
        $event_id = $_POST['id'];
        $seat_id = $_POST['seat_id'];

        if ($this->input->post('ticket_class_id') == 0) {
            $this->form_validation->set_rules('ticket_class_id', 'Ticket Class', 'callback_check_ticket');
        } else {
            $this->form_validation->set_rules('ticket_class_id', 'Ticket Class');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->edit_seats($seat_id, $event_id);
        } else {

			
			if($_POST['ticket_class']=="12" || $_POST['ticket_class']=="13")
			{
				
				$data_list['ticket_class_id'] = $this->input->post('ticket_class_id');
				$data_list['event_id'] = $event_id;
				$data_list['table_start'] = $this->input->post('table_start');
				$data_list['table_end'] = $this->input->post('table_end');
				$data_list['seat_charge'] = $this->input->post('seat_charge');
				$data_list['table_charge'] = $this->input->post('table_charge');
				$data_list['coupon_id'] = $this->input->post('coupon_id');
				$data_list['e_ticket_status'] = $this->input->post('e_ticket_status');
	
				$this->db->where('id', $seat_id);
				$this->db->update('tbl_event_seats', $data_list);
	
				$this->db->where('event_seat_id', $seat_id);
				$this->db->delete('tbl_event_tables');
	
				$this->db->where('event_seat_id', $seat_id);
				$this->db->delete('tbl_event_chairs');
	
				for ($i = $data_list['table_start']; $i <= $data_list['table_end']; $i++) {
					$data_table['event_id'] = $event_id;
					$data_table['event_seat_id'] = $seat_id;
					$data_table['table_no'] = $i;
					$data_table['status'] = 0;
					$this->db->insert('tbl_event_tables', $data_table);
					$second_insert_id = $this->db->insert_id();

					for ($j = 1; $j <= 10; $j++) {
						$data_chair['event_id'] = $event_id;
						$data_chair['table_no'] = $i;
						$data_chair['table_id'] = $second_insert_id;
						$data_chair['event_seat_id'] = $seat_id;
						$data_chair['status'] = 0;
						$this->db->insert('tbl_event_chairs', $data_chair);
					}
				}
			}
			
			/*else if($_POST['ticket_class']=="13")
			{
				
				$data_list['ticket_class_id'] = $this->input->post('ticket_class_id');
				$data_list['event_id'] = $event_id;
				$data_list['table_start'] = $this->input->post('table_start');
				$data_list['table_end'] = $this->input->post('table_end');
				$data_list['seat_charge'] = $this->input->post('seat_charge');
				$data_list['table_charge'] = $this->input->post('table_charge');
	
				$this->db->where('id', $seat_id);
				$this->db->update('tbl_event_seats', $data_list);
	
				$this->db->where('event_seat_id', $seat_id);
				$this->db->delete('tbl_event_tables');
	
				$this->db->where('event_seat_id', $seat_id);
				$this->db->delete('tbl_event_chairs');
	
				for ($i = $data_list['table_start']; $i <= $data_list['table_end']; $i++) {
					$data_table['event_id'] = $event_id;
					$data_table['event_seat_id'] = $seat_id;
					$data_table['table_no'] = $i;
					$data_table['status'] = 0;
					$this->db->insert('tbl_event_tables', $data_table);
					$second_insert_id = $this->db->insert_id();

					for ($j = 1; $j <= 10; $j++) {
						$data_chair['event_id'] = $event_id;
						$data_chair['table_no'] = $i;
						$data_chair['table_id'] = $second_insert_id;
						$data_chair['event_seat_id'] = $seat_id;
						$data_chair['status'] = 0;
						$this->db->insert('tbl_event_chairs', $data_chair);
					}
				}
				
				/*$data_list['ticket_class_id'] = $this->input->post('ticket_class_id');
				$data_list['event_id'] = $event_id;
				$data_list['table_start'] =1;
				$data_list['table_end'] = $this->input->post('ticket_no');
				$data_list['seat_charge'] = $this->input->post('ticket_charge');
				
				$this->db->where('id', $seat_id);
				$this->db->update('tbl_event_seats', $data_list);
	
				$this->db->where('event_seat_id', $seat_id);
				$this->db->delete('tbl_event_tables');
	
			
	
			 for ($i = $data_list['table_start']; $i <= $data_list['table_end']; $i++)
			 {
                $data_table['event_id'] = $event_id;
                $data_table['event_seat_id'] = $seat_id;
                $data_table['table_no'] = $i;
                $data_table['status'] = 0;
                $this->db->insert('tbl_event_tables', $data_table);
                $second_insert_id = $this->db->insert_id();
             }
			
			}*/
			
			else if($_POST['ticket_class']=="27")
			{
				$data_list['ticket_class_id'] = $this->input->post('ticket_class_id');
				$data_list['seat_charge'] = $this->input->post('price');
				$data_list['table_end'] = $this->input->post('addtinal_end');
				$data_list['coupon_id'] = $this->input->post('coupon_id');
				$data_list['e_ticket_status'] = $this->input->post('e_ticket_status');
				$this->db->where('id', $seat_id);
				$this->db->update('tbl_event_seats', $data_list);		
			}
			
			else if($_POST['ticket_class']=="30")
			{
				
            	$data_list['table_start'] ='1';
				$data_list['ticket_class_id'] = $this->input->post('ticket_class_id');
				$data_list['seat_charge'] = $this->input->post('Tickts_price');
				$data_list['table_end'] = $this->input->post('number_of_tickts');
				$data_list['coupon_id'] = $this->input->post('coupon_id');
				$data_list['e_ticket_status'] = $this->input->post('e_ticket_status');
				$this->db->where('id', $seat_id);
				$this->db->update('tbl_event_seats', $data_list);	
			}
			
            redirect(admin_url('events/seats/' . $event_id));
        }
    }

    function delete_seats($id, $eid) {


        $this->db->where('event_seat_id', $id);
        $this->db->delete('tbl_event_chairs');

        $this->db->where('event_seat_id', $id);
        $this->db->delete('tbl_event_tables');

        $this->db->where('id', $id);
        $this->db->delete('tbl_event_seats');

        redirect(admin_url('events/seats/' . $eid));
    }

    function check_ticket($str) {
        if ($str == 0) {
            $this->form_validation->set_message('check_ticket', 'Please Select the ticket class');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}

?>