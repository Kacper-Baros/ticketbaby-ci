<?php
class Cms_category_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

       public function getCmsCategories(){
		$this->db->select('id,category_name');
		$this->db->from('ticketbaby_cms_category');

		$query = $this->db->get();
		$result_array = $query->result_array();
		//echo $this->db->last_query();die;
		return $result_array;
		
	  }
	

}