<?php
class Business_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

		public function get_business_ads($slug = FALSE,$limit,$start)
		{
			$this->db->limit($limit, $start);

			if ($slug === FALSE)
			{
			        $query = $this->db->get('business_post_master');
			        return $query->result_array();
			}

			$query = $this->db->get_where('business_post_master', array('post_slug' => $slug));
			return $query->row_array();
		}

		public function record_count() {
			return $this->db->count_all("business_post_master");
		}

}