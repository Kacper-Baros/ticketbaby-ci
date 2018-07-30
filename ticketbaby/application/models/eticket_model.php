<?php
class Eticket_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function order_details($orderId) {
        $data = $this->db->get_where('tbl_orders', array('id' => $orderId))->result();
		return $data;
    }
	function event_details($orderId) {
        $eventId = $this->db->get_where('tbl_orders', array('id' => $orderId))->row();
		$data = $this->db->get_where('tbl_events', array('id' => $eventId->event_id))->result();
		return $data;
    }
	function event_additionals($orderId) {
        $eventId = $this->db->get_where('tbl_orders', array('id' => $orderId))->row();
		$data = $this->db->get_where('additional_event_detail', array('event_id' => $eventId->event_id))->result();
		return $data;
    }
	function etickets_settings($orderId) {
        $eventId = $this->db->get_where('tbl_orders', array('id' => $orderId))->row();
		$data = $this->db->get_where('tbl_eticket_info', array('event_id' => $eventId->event_id))->result();
		return $data;
    }
}
?>
