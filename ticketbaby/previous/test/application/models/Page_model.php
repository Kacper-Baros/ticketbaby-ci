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
			        $query = $this->db->get('cms_master');
			        return $query->result_array();
			}

			$query = $this->db->get_where('cms_master', array('cms_page' => $slug));
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

			if ($slug === FALSE)//EMPTY CONDITION
			{
			        $query = $this->db->get('cms_master');
			         $user=$query->result_array();
					
					return $user;
			}

			$query = $this->db->get_where('cms_master', array('cms_page' => $slug));
			return $query->row_array();
		}

		public function createUpdatePage($data) 
		{
			$cms_id					 =	$data['cms_id'];
			$data['cms_content']		=	$data['details'];
			unset($data['details']);
			if($cms_id){
				$this->db->where('cms_id',$cms_id);
				$r=	$this->db->update('cms_master',$data);
				if($r){
					$array["success"] = true;
					$array["message"] = "CMS has been updated successfully.";
				}
				
			}else{
				$r=	$this->db->insert('cms_master',$data);
				if($r){
					$array["success"] = true;
					$array["message"] = "CMS has been added successfully";
				}
				
			}
			
			
			
			return $array;
			exit;
		}
		
		public function get_pages_footer()
		{
			$this->db->select('cms_title,cms_page');
			$query = $this->db->get_where('cms_master', array('Active' => 'Y'));
			return $query->result_array();
			
		}

}