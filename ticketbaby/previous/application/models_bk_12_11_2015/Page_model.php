<?php
class Page_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_page_by_slug($slug = FALSE)
		{
			if ($slug === FALSE)
			{
			        $query = $this->db->get('user_master');
			        return $query->result_array();
			}

			$query = $this->db->get_where('user_master', array('slug' => $slug));
			return $query->row_array();
		}



		/*
		Backend
		*/

		public function get_page_by_id($cms_id = 0)
		{
			if ( $cms_id > 0 )
			{
		        $query = $this->db->get_where('cms_master', array('cms_id' => $cms_id));
		        return $query->row_array();
			}else{
				return FALSE;
			}	
		}

		public function record_count() {
			return $this->db->count_all("cms_master");
		}

		public function get_pages($slug = FALSE,$limit,$start)
		{
			$this->db->limit($limit, $start);

			if ($slug === FALSE)
			{
			        $query = $this->db->get('cms_master');
			        return $query->result_array();
			}

			$query = $this->db->get_where('cms_master', array('cms_page' => $slug));
			return $query->row_array();
		}

		public function createUpdatePage($data) 
		{

			print_r($data);
			exit;
		}

}