<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
	        parent::__construct();
	        $this->load->model('music_model');
	}

	public function index()
	{
		$data['event'] 				= $this->event_model->get_event("movie-video-and-screen-awards");
		//$data['event'] 				= $this->music_model->get_event("movie-video-and-screen-awards");
		$data['event_seats'] 		= $this->event_model->get_event_seats($data['event']['id']);
	//	$data['event_seats'] 		= $this->music_model->get_event_seats($data['event']['id']);
		$data['current_view'] 		= 'HOME';

		$array = array();
		foreach($data['event_seats']  as $k=>$row) {
			$occupied_seat_numbers = $this->event_model->get_event_seats_booked ($row['event_id'], $row['ticket_class_id']);
		//	$occupied_seat_numbers = $this->music_model->get_event_seats_booked ($row['event_id'], $row['ticket_class_id']);
			$data['event_seats'][$k]['occupied_seat_numbers'] = $occupied_seat_numbers;
			$missing_seat_numbers  = $this->event_model->get_event_missing_seats($row['event_id'], $row['ticket_class_id']);
			//$missing_seat_numbers  = $this->music_model->get_event_missing_seats($row['event_id'], $row['ticket_class_id']);
			$data['event_seats'][$k]['missing_seat_numbers']  = $missing_seat_numbers;
		}
		$this->load->view('templates/header', $data);
		$this->load->view('welcome_message', $data);
		$this->load->view('templates/footer', $data);
	}
}
