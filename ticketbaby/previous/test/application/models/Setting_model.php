<?php
class Setting_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_settings($slug = FALSE)
		{
			if ($slug === FALSE)
			{
			        $query = $this->db->get('user_master');
			        return $query->result_array();
			}

			$query = $this->db->get_where('user_master', array('slug' => $slug));
			return $query->row_array();
		}
}