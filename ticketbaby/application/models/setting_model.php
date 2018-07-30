<?php

class Setting_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all() { //function to call frontend
        $this->db->where('id',$id);
        return $this->db->get('site_settings')->row_array();
    }
}
?>
