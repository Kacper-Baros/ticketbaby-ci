<?php

class Cart_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_item($id = 0) {

        $this->db->select('cart_master.*');
        $this->db->from('cart_master');

        if ($id > 0) {
            $this->db->where('cart_master.id', $id);
        } else {
            $this->db->where('cart_master.session_id', session_id());
        }

        $query = $this->db->get();
        $cart_items = $query->row_array();


        $this->db->select('COUNT(*) as item_count');
        $this->db->from('cart_master');
        if ($id > 0) {
            $this->db->where('cart_master.id', $id);
        } else {
            $this->db->where('cart_master.session_id', session_id());
        }
        $query = $this->db->get();
        $count_details = $query->row_array();

        if ($count_details && $count_details["item_count"]) {
            $cart_items["item_count"] = $count_details["item_count"];
        } else {
            $cart_items["item_count"] = 0;
        }

        return $cart_items;
    }

    public function delete_item($session_id = "") {
        if (trim($session_id) == "") {
            return FLASE;
        }
        $this->db->delete('cart_master', array('session_id' => session_id()));
    }

    public function add_item($cart_data = array()) {
        if (!is_Array($cart_data) || sizeof($cart_data) < 1) {
            return FLASE;
        }
        $cart_data = array(
            'session_id' => session_id(),
            'cart_session' => $cart_data['cart_session'],
            'cart_additional_session' => $cart_data['cart_additional_session'],
            'cart_user_session' => $cart_data['cart_user_session'],
            'price' => $cart_data['price'],
            'total_price' => $cart_data['total_price'],
            'created_date' => date("Y-m-d H:i:s")
        );

        $this->db->insert('cart_master', $cart_data);
        $cart_id = $this->db->insert_id();
        return $cart_id;
    }

    public function update_item($cart_data = array()) {
        if (!is_Array($cart_data) || sizeof($cart_data) < 1) {
            return FLASE;
        }
        $cart_id = $cart_data["id"];
        $cart_data = array(
            'cart_session' => $cart_data['cart_session'],
            'cart_additional_session' => $cart_data['cart_additional_session'],
            'cart_user_session' => $cart_data['cart_user_session'],
            'price' => $cart_data['price'],
            'total_price' => $cart_data['total_price'],
            'created_date' => date("Y-m-d H:i:s")
        );
        $this->db->where('session_id', session_id());
        $this->db->where('id', $cart_id);
        $this->db->update('cart_master', $cart_data);
        return $cart_id;
    }

    public function checkDuplicateNotification($pay_id, $cartRef) {
        $this->db->select('COUNT(*) as item_count');
        $this->db->from('test_notify');
        $this->db->where('test_notify.pay_id', $pay_id);
        $this->db->where('test_notify.order_id', $cartRef);
        $query = $this->db->get();
        $count_details = $query->row_array();

        if ($count_details && $count_details["item_count"]) {
            return $count_details["item_count"];
        } else {
            return 0;
        }
    }

}