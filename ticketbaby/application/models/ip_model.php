<?php

class Ip_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function ip_exists($IP) {
        $this->db->from('tbl_ipaddresses');
        $this->db->where('ip_address', $IP);
		$query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row();
        }
    }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
