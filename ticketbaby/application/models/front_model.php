<?php

class Front_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_categories($parent = 0, $spacing = '', $user_tree_array = '') {
        if (!is_array($user_tree_array))
            $user_tree_array = array();
        $sql = "SELECT `id`, `title`, `parent_id` FROM `tbl_post` WHERE `parent_id` = $parent ORDER BY title ASC";
        $query = mysql_query($sql);
        if (mysql_num_rows($query) > 0) {
            while ($row = mysql_fetch_object($query)) {
                $user_tree_array[] = array("id" => $row->id, "title" => $spacing . $row->title, 'parent_id' => $row->parent_id);
                $user_tree_array = $this->get_categories($row->id, $spacing . '&nbsp;&nbsp; - &nbsp;', $user_tree_array);
            }
        }
        return $user_tree_array;
    }

    function fetch_awards() {
        $detail = $this->db->get_where('tbl_events', array('event_type' => 1))->row();
        return $detail;
    }
    
    function fetch_events($id) {
        $detail = $this->db->get_where('tbl_events', array('id' => $id))->row();
        return $detail;
    }

    function fetch_detail_awards($id) {
        $this->db->select('*');
        $this->db->from('tbl_events');
        $this->db->join('additional_event_detail', 'tbl_events.id = additional_event_detail.event_id');
        $this->db->where('tbl_events.id', $id);
        $query = $this->db->get('')->row();
        return $query;
    }

    function fetch_seats($id) {
        $this->db->where('event_id',$id);
        $details = $this->db->get('tbl_event_seats')->result();
    
           $detail_result = $this->db->query("select se.id as seat_id, event_id, ti.id as tid,ti.parent_id as ticket_parent_id,table_start,ti.class as ticket_class, table_end, seat_charge, table_charge from tbl_event_seats se join tbl_ticket_class ti  on (se.ticket_class_id = ti.id) where se.event_id = $id and ti.parent_id != 0 ORDER BY ti.id ASC" )->result();
           foreach($detail_result as $key=>$val){
               $detail_result[$key]->table = $this->db->get_where('tbl_event_tables',array('event_seat_id'=>$val->seat_id))->result();
                 $tables = $this->db->get_where('tbl_event_tables', array('event_seat_id' => $val->seat_id))->result();
                 foreach ($tables as $key1 => $val2) {
                $detail_result[$key]->available_table = count($this->db->get_where('tbl_event_tables', array('event_seat_id' => $val->seat_id, 'status' => 0))->result());
            }
           }
           return $detail_result;
           
           }
           
    function fetch_party($id) {
        $this->db->where('event_id',$id);
        $details = $this->db->get('tbl_event_seats')->result();
    
           $detail_result = $this->db->query("select se.id as seat_id, event_id, ti.id as tid,ti.parent_id as ticket_parent_id,table_start,ti.class as ticket_class, table_end, seat_charge, table_charge from tbl_event_seats se join tbl_ticket_class ti  on(se.ticket_class_id = ti.id) where se.event_id = $id  ORDER BY ti.id ASC" )->result();
           foreach($detail_result as $key=>$val){
               $detail_result[$key]->table = $this->db->get_where('tbl_event_tables',array('event_seat_id'=>$val->seat_id))->result();
                 $tables = $this->db->get_where('tbl_event_tables', array('event_seat_id' => $val->seat_id))->result();
                 foreach ($tables as $key1 => $val2) {
                $detail_result[$key]->available_table = count($this->db->get_where('tbl_event_tables', array('event_seat_id' => $val->seat_id, 'status' => 0))->result());
            }
           }
           return $detail_result;
           
           }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
