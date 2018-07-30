<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('event_model');
    }

    public function index() {
        redirect(base_url()); // todo
    }

    public function view($slug = 'Event', $main = '') {
        $siteKey = $this->config->item('recaptcha_site_key');
        $data['event'] = $this->event_model->get_event($slug);
        $category_slug = $data['event']['category_slug'];
        //print_r($data['event']);die('test');

        $cart_session = $this->session->userdata('cart_session');
        $cart_event = $this->session->userdata('cart_event');
        $array_store_cart = array();

        foreach ($cart_session as $_cart_session) {
            $selected_tables = $_cart_session['selected_tables'];
            $array_store_cart[$_cart_session['ticket_class_id']]['ticket_class_id_s'] = $_cart_session['ticket_class_id'];
            $array_store_cart[$_cart_session['ticket_class_id']]['seat_quantity'] = $selected_tables[0]['seat_quantity'];
        }
        $data['array_store_cart'] = $array_store_cart;

        //print_r($array_store_cart);die('test');

        if (!isset($data['event']) || !isset($data['event']['id'])) {
            redirect(base_url());
        }

        $data['event_seats'] = $this->event_model->get_event_seats($data['event']['id']);
       // echo "<pre>";
        //print_r($data['event_seats']);die('test');
        $data['show_left_panel_cart'] = 'TRUE';
        $data['siteKey'] = $siteKey;
        $data["cart_captcha_session"] = $this->session->userdata('cart_captcha_session');
        $data['current_view'] = 'EVENTDETAIL';


        /* Update session cart */
        $cart_event = $this->session->userdata('cart_event');
        if ($cart_event["id"] != $data['event']["id"]) {
            $this->session->unset_userdata('cart_session');
            $this->session->unset_userdata('cart_additional_session');
            $this->session->unset_userdata('cart_captcha_session');
            $this->session->unset_userdata('cart_user_session');
        }
        $this->session->set_userdata('cart_event', $data['event']);


        $array = array();
        foreach ($data['event_seats'] as $k => $row) {
            $occupied_seat_numbers = $this->event_model->get_event_seats_booked($row['event_id'], $row['ticket_class_id']);
            $data['event_seats'][$k]['occupied_seat_numbers'] = $occupied_seat_numbers;
            $missing_seat_numbers = $this->event_model->get_event_missing_seats($row['event_id'], $row['ticket_class_id']);
            $data['event_seats'][$k]['missing_seat_numbers'] = $missing_seat_numbers;
        }
        $this->load->view('templates/header-event', $data);

        if (intval($data['event']['category_id']) <= 1) {
            if ($slug == 'movie-video-and-screen-awards') {
                $this->load->view('event/event_detail', $data);
            }

            if ($slug == 'club-nite') {
                $this->load->view('event/event_detail_club_nite', $data);
            }
            if ($slug == 'southport-family-day-trip') {
                $this->load->view('event/event_detail_family_trips', $data);
            }
        } else {
            if ($main == 'music') {
                if ($slug == 'movie-video-and-screen-awards') {
                    $this->load->view('event/event_detail', $data);
                } elseif ($category_slug == 'clubnites') {
                    $this->load->view('event/clubnite_detail_page', $data);
                }
                /* elseif ($category_slug=='concerts'){
                  $this->load->view('event/clubnite_detail_page', $data);
                  } */ else {
                    $this->load->view('event/event_detail_club_nite', $data);
                }
                //$this->load->view('event/event_detail_club_nite', $data);
            } else {
                $view = 'event_detail_' . $data['event']['category_slug'];
                if (file_exists(APPPATH . "views/event/$view.php")) {
                    $this->load->view('event/event_detail_' . $data['event']['category_slug'], $data);
                } else {
                    if ($slug == 'movie-video-and-screen-awards') {
                        $this->load->view('event/event_detail', $data);
                    } else {
                        $this->load->view('event/event_detail_club_nite', $data);
                    }
                }
                //$this->load->view('event/event_detail_' . $data['event']['category_slug'], $data);
            }
        }

        $this->load->view('templates/footer-event', $data);
    }

    // Search event method start
    public function search_event() {
        $this->load->model('category_model');
        $this->load->helper('text');

        $data['q'] = $this->input->get('q');

        $total = 5;
        $category_all = $this->category_model->get_category_search();
        $data['category_all'] = $category_all;

        $cat_id = $this->input->get("cat_id");
        $country = $this->input->get("country");
        $day = $this->input->get("day");
        $data['cat_id'] = $cat_id;
        $data['day'] = $day;
        $data['country'] = $country;
        $per_page = $this->input->get("per_page"); //start

        if (isset($per_page))
            $start = $per_page;
        else
            $start = 0;
        $cate_url = base_url() . ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "") . "event/search?q={$q}&result=Search";

        $url = base_url() . ($this->config->item('index_page') ? $this->config->item('index_page') . "/" : "") . "event/search?q={$q}&result=Search&cat_id={$cat_id}";
        $config['base_url'] = $url . "&day={$day}";
        $data['url'] = $url;
        $config['total_rows'] = $this->event_model->search_get_events($cat_id, $country, $day);
        //print_r($config['total_rows']);die;
        //$config['total_rows'] 	=	100;
        $config['per_page'] = $total;
        $config['uri_segment'] = 3;
        $config['page_query_string'] = TRUE;
        //pagination

        $this->load->library('pagination');
        $this->config->load('pagination', TRUE);
        //$config = $this->config->item('pagination');


        $this->pagination->initialize($config);

        $response_detail = $this->event_model->search_get_events($cat_id, $country, $day, $total, $start);
        //print_r($response_detail);die('test');	
        $data['show_left_panel_cart'] = 'TRUE';
        $data['current_view'] = 'HOME';

        $data['home_page_event_list'] = $response_detail;
        $data['cate_url'] = $cate_url;
        $this->load->view('templates/header', $data);
        $this->load->view('event/search', $data);
        $this->load->view('templates/footer', $data);
    }

    /*     * **
      Create event page
     * ** */

    public function Create() {

        $user_session = $this->session->userdata('user_cart');
        $user_session_details = unserialize($user_session);
        $data['user_detail'] = $user_session_details;
        //print_r($data['user_detail']);die;
        $this->load->view('templates/header', $data);
        $this->load->view('event/create_event', $data);
        $this->load->view('templates/footer', $data);
    }

    /*     * *
      Create and event
     * ** */

    public function add_event() {
        $this->load->model('user_details');
        if ($this->user_details->loggedin() == FALSE) {
            redirect("cart/home");
        }
        $user_order = $this->session->userdata('user_cart');
        $user_order_details = unserialize($user_order);
        $user_id = $user_order_details['id'];

        if ($this->input->post('Save')) {
            $user_id = $user_order_details['id'];
            $make_live = $this->input->post('make_live');
            $title = $this->input->post('title');
            $slug = $this->input->post('slug');
            $category = $this->input->post('category');
            $venue = $this->input->post('venue');
            $start_date = $this->input->post('start_date');
            $start_time = $this->input->post('start_time');
            $end_date = $this->input->post('end_date');
            $end_time = $this->input->post('end_time');
            $detail = $this->input->post('detail');
            $image = $this->input->post('image');
            $summary = $this->input->post('summary');
            $organizer_name = $this->input->post('organizer_name');
            $organizer_description = $this->input->post('organizer_description');



            $response = $this->event_model->createUserEvent(array(
                'user_id' => $user_id,
                'title' => $title,
                'slug' => $slug,
                'category' => $category,
                'venue' => $venue,
                'start_time' => $start_time,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'end_time' => $end_time,
                'detail' => $detail,
                'image' => $image,
                'summary' => $summary,
                'organizer_name' => $organizer_name,
                'organizer_description' => $organizer_description));


            if ($response) {
                $this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Successfully <strong></strong>created your event.</span></div> ');

                redirect("user/my_event");
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-warning display-hide"><span>Something gets wrong,  Please try again .</span></div> ');
                redirect("event/add_event");
            }
        } elseif ($this->input->post('make_live')) {
            $user_id = $user_order_details['id'];
            $make_live = $this->input->post('make_live');
            $title = $this->input->post('title');
            $slug = $this->input->post('slug');
            $category = $this->input->post('category');
            $venue = $this->input->post('venue');
            $start_date = $this->input->post('start_date');
            $start_time = $this->input->post('start_time');
            $end_date = $this->input->post('end_date');
            $end_time = $this->input->post('end_time');
            $detail = $this->input->post('detail');
            $image = $this->input->post('image');
            $summary = $this->input->post('summary');
            $organizer_name = $this->input->post('organizer_name');
            $organizer_description = $this->input->post('organizer_description');
            $user_order = $this->session->userdata('user_cart');
            $user_order_details = unserialize($user_order);
            $user_id = $user_order_details['id'];

            $response = $this->event_model->createUserEvent(array(
                'user_id' => $user_id,
                'title' => $title,
                'slug' => $slug,
                'category' => $category,
                'venue' => $venue,
                'start_time' => $start_time,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'end_time' => $end_time,
                'detail' => $detail,
                'image' => $image,
                'summary' => $summary,
                'organizer_name' => $organizer_name,
                'organizer_description' => $organizer_description));


            if ($response) {
                $this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Successfully <strong></strong>created your event.</span></div> ');
                if ($make_live)
                    redirect("user/my_event/{$response}");
                else
                    redirect("user/my_event");
            }
            else {
                $this->session->set_flashdata('error', '<div class="alert alert-warning display-hide"><span>Something gets wrong,  Please try again .</span></div> ');
                redirect("event/add_event");
            }
        } else {
            $this->Create();
        }
    }

}