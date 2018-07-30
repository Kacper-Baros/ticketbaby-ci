<?php
class Category_event_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
		
	public function getEventIdsByCategoryId($categoryId = NULL){
		$this->db->select('event_id');
		$this->db->from('category_event');
		$this->db->where('category_id', $categoryId);

		$query = $this->db->get();
		$result_array = $query->result_array();
	//echo $this->db->last_query();die;

		return $result_array;
	}
}