<?php
class Countries_model extends CI_Model {

		protected $_table_name = 'ticketbaby_countries';
		
        public function __construct()
        {
                $this->load->database();
        }

        public function get_all_countries()
		{

			$this->db->select('ticketbaby_countries.*'
							   );
			$this->db->from('ticketbaby_countries');

			$query = $this->db->get();
			return $query->result_array();
		}

		
	
}