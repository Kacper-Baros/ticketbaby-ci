<?php
class States_model extends CI_Model {

		protected $_table_name = 'ticketbaby_states';
		
        public function __construct()
        {
                $this->load->database();
        }

        public function get_states_by_country_id($countryId)
		{

			$this->db->select('ticketbaby_states.*');
			$this->db->where('ticketbaby_states.country_id',$countryId);
			$this->db->from('ticketbaby_states');

			$query = $this->db->get();
			return $query->result_array();
		}
		
		 public function get_all_states()
		{

			$this->db->select('ticketbaby_states.*');
			$this->db->from('ticketbaby_states');

			$query = $this->db->get();
			return $query->result_array();
		}

		
	
}