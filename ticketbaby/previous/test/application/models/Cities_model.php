<?php
class Cities_model extends CI_Model {

		protected $_table_name = 'ticketbaby_cities';
		
        public function __construct()
        {
                $this->load->database();
        }

        public function get_cities_by_state_id($stateId)
		{

			$this->db->select('ticketbaby_cities.*');
			$this->db->where('ticketbaby_cities.state_id',$stateId);
			$this->db->from('ticketbaby_cities');

			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_all_cities()
		{

			$this->db->select('ticketbaby_cities.*');
			$this->db->from('ticketbaby_cities');

			$query = $this->db->get();
			return $query->result_array();
		}
	
}