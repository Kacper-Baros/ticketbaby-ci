<?php

class Events extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('text', 'url', 'text');
        $this->load->model('Front_model');
        $this->load->library('session');
    }

    function event($id) {
        $data['event_detail'] = $this->db->get_where('tbl_events', array('id' => $id))->row();
        $this->load->view('events', $data);
    }
    function pevent($id) {
        $data['event_detail'] = $this->db->get_where('tbl_promote_events', array('id' => $id))->row();
        $this->load->view('promote-events', $data);
    }
    
    function peventlist() {
        $data['event_detail'] = $this->db->get_where('tbl_promote_events')->result();
        $this->load->view('promote-events-list', $data);
    }

    function events_detail($id) {
        $data['event_detail'] = $this->Front_model->fetch_detail_awards($id);
        $data['table_section'] = $this->Front_model->fetch_seats($id);
        $this->load->view('event_detail', $data);
    }

    function reserve_seats($id) {
        $values[] = $_POST;
		//print_r($values);
        $event_seat = $this->db->get_where('tbl_event_seats', array('id' => $id))->row();
        $val = $this->db->get_where('tbl_ticket_class', array('id' => $event_seat->ticket_class_id))->row();
        $parent = $this->db->get_where('tbl_ticket_class', array('id' => $val->parent_id))->row();

        if ($parent->class == 'Table Tickets') {
           $valas['seat_charge'] = $event_seat->seat_charge;
        }

        $valas['table_charge'] = $event_seat->table_charge;
        $valas['section'] = $parent->class;
        $valas['class'] = $val->class;
        $values['info'] = $valas;
        $merged_array[] = array_merge($valas, $_POST);

        $session = array();
        $session = $this->session->userdata('tables');
        if (!empty($session)) {
            $arr = array_merge($merged_array, $session);
            $this->session->set_userdata('tables', $arr);
            $data['results'] = $arr;
			$co=sizeof($arr)-1;
        } else {
			$co=0;
            $this->session->set_userdata('tables', $merged_array);
            $data['results'] = $merged_array;
        }

        $table_count = count(@$values[0]['table']);
        $output = '<ul class="ajaxul">';
        $output .= '<li class = "col-md-2 col-xs-2"><a href = "http://ticketbaby.co.uk/awards/remove_session/0/'.$_POST['event_id'].'" class = "remove_session" title = "remove"><i class = "fa fa-times" aria-hidden = "true"></i> Remove</a></li>';
        $output .= '<li class = "col-md-3 col-xs-3">' . $valas['class'] . '</li>';


        if ($parent->class == 'Table Tickets') {
				if (!empty($values[0]['table'])) {
					$disValue = $valas['table_charge'];
					$output .= '<li class = "col-md-4 col-xs-4"><span style= "font-weight:100;">' . $valas['section'] . '<span> / £ ' . $disValue . '</span></li>';
				}
				else{
					$disValue = $valas['seat_charge'];
					foreach ($values[0]['seat'] as $key => $val) {
						if ($val != 0) {
							$seatscount = $val;
						}
					}
					$output .= '<li class = "col-md-4 col-xs-4"><span style= "font-weight:100;">' . $valas['section'] . '<span> '.$seatscount.' / £ ' . $disValue . '</span></li>';
				}
			
			//$output .= '<li class = "col-md-4 col-xs-4"><span style = "font-weight:100;">' . $valas['section'] . '(<span>' . $table_count . ' * ' . $valas['table_charge'] . '</span>)</li>';
            //$output .= '<li class = "col-md-4 col-xs-4"><span style = "font-weight:100;">' . $valas['section'];
			$output .= '<input type="hidden" name="SeatID_TTickes" id="SeatID_TTickes" value="'.$id.'">';
            $sum_tickets = 0;
			$sum_tickets += $table_count * $valas['table_charge'];
            foreach ($values[0]['seat'] as $key => $val) {
                if ($val != 0) {
                    //$output .= '<span>(' . $val . '*' . $valas['seat_charge'] . ')</span>';
                    $sum_tickets += $val * $valas['seat_charge'];
                }
            }
            $output .= '</li>';
        } else {

            $output .= '<li class = "col-md-4 col-xs-4"><span style = "font-weight:100;">' . $valas['section'] . '(<span>' . $table_count . ' * ' . $valas['table_charge'] . '</span>)</li>';
			$output .= '<input type="hidden" name="SeatID_Table" id="SeatID_Table" value="'.$id.'">';
        }


        if ($parent->class != 'Table Tickets') {
            $output .= '<li class = "col-md-3 col-xs-3">£ ' . $table_count * $valas['table_charge'] . ' </li>';
        } else {
            $output .= '<li class = "col-md-3 col-xs-3">£ ' . $sum_tickets . ' </li>';
        }
        $output .= '<div class = "clearfix"></div>';
		$output .= '<input type="hidden" name="CartEmpty" id="CartEmpty" value="0">';
        $output .= '</ul>';
        echo json_encode($output);
    }

    function test() {
         $output = '<a href="javascript:void(0)" class="empty_cart" onclick="empty_cart()"><i class="fa fa-times" aria-hidden="true"></i> Remove all</a>';
        $output .= '<ul>';
        $output .= '<li class = "col-md-2 col-xs-2"><a href="#" class = "remove_session" title = "remove"><i class = "fa fa-times" aria-hidden = "true"></i> Remove</a></li>';
        $output .= '<li class = "col-md-3 col-xs-3"> ' . $s['class'] . '</li>';
        if ($s['section'] == 'Tables Only') {
            $output .= '<li class = "col-md-4 col-xs-4"><span style = "font-weight:100;">' . $s['section'] . '</span> (' . count($s["table"]) . ' * ' . $s["table_charge"] . ')</li>';
        } else {
            $output .= '<li class = "col-md-4 col-xs-4"><span style = "font-weight:100;">' . $s['section'] . '</span>';
            $sum_tickets = 0;
            foreach ($s['seat'] as $ss => $val) {
                if ($val != 0) {
                    ?>
                    <span> (<?php echo $val ?> *  <?php echo $s['seat_charge'] ?>)</span>;
                    <?php
                }
                $sum_tickets += $val * $s['seat_charge'];
            }
            $output .= '</li>';
        }
        $output .= '<li class = "col-md-3 col-xs-3">';
        $sum = count($s['table']) * $s['table_charge'];
        if ($s['section'] == 'Tables Only') {
            echo $sum;
        } else {
            echo $sum_tickets;
        }
        $output .= '</li>';
        $output .= '<div class = "clearfix"></div>';
        $output .= '</ul>';

        echo json_encode($output);
    }

    function expires() {
        $this->session->unset_userdata('tables');
        $this->session->unset_userdata('promo_code');
        $this->session->unset_userdata('after_party');
        redirect(base_url());
    }
    
    
    function cancle_order(){
          $this->session->unset_userdata('tables');
        $this->session->unset_userdata('promo_code');
        $this->session->unset_userdata('after_party');
		$this->session->unset_userdata('tickets');
        $this->load->view('cancle_page');
    }

}
?>