<?php

class Admin_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function username_exists($username) {
        $this->db->from('admin');
        $this->db->where('username', $username);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row()->id;
        }
    }

    function get_password_username($username) {
        return $this->db->get_where('admin', array('username' => $username))->row()->password;
    }
	
	function update_last_login($userid) {
		$data['last_login'] = date('Y-m-d H:i:s');
		$this->db->where('id', $userid);
		$query = $this->db->update('admin', $data);
		if($query){
			return true;
		}
    }

    function get_user_id($username, $password) {
        $this->db->from('admin');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row();
        }
    }

    function ticket_class($parent = 0, $spacing = '', $user_tree_array = '') {
        if (!is_array($user_tree_array))
            $user_tree_array = array();

        $sql = "SELECT `id`, `class`, `parent_id` FROM `tbl_ticket_class` WHERE `parent_id` = $parent ORDER BY class ASC";
        $query = mysql_query($sql);
        if (mysql_num_rows($query) > 0) {
            while ($row = mysql_fetch_object($query)) {
                $user_tree_array[] = array("id" => $row->id, "class" => $spacing . $row->class, 'parent_id' => $row->parent_id);
               // $user_tree_array = $this->ticket_class($row->id, $spacing . '&nbsp;&nbsp; - &nbsp;', $user_tree_array);
            }
        }
        return $user_tree_array;
    }

    function filter_order($post) {
        $from = strtotime($post['from']);
        $to = strtotime($post['to']);
        if ($post['from'] == '' && $post['to'] == '') {
            $ss = $this->db->get_where('tbl_orders')->result();
            return $ss;
        } else if ($post['from'] != '' && $post['to'] == '') {
            $this->db->where('created >=', $from);
            $ss = $this->db->get('tbl_orders')->result();
            return $ss;
        } else if ($post['from'] != '' && $post['to'] != '') {
            $this->db->where('created >=', $from);
            $this->db->where('created <=', $to);
            $ss = $this->db->get('tbl_orders')->result();
            return $ss;
        } else {
            $ss = $this->db->get_where('tbl_orders')->result();
            return $ss;
        }
    }

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
