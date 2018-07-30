<?php
class Advertisement_video_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

       
		public function changeAdvertisementVideo($data) 
		{
			
			//echo "<pre>";print_r($data);exit;
			
			$field =	$data['field'];
			
			$dataSave['video'] = $data['video_url'];				
			$dataSave['is_active'] = '1';	
			$dataSave['modified'] = date('Y-m-d H:i:s');		
					
			
			if(!empty($data)){
				$this->db->where('field',$field);
				$result = $this->db->update('ticketbaby_advertisement_video',$dataSave);
			 	$this->db->affected_rows();
				if($this->db->affected_rows()==1){
					$array["success"] = true;
					$array["message"] = "Advertisement Video has been changed successfully.";
				}else{
					$array["success"] = false;
					$array["message"] = "Advertisement Video change is unsuccessful.";
				}
				
			}
			return $array;
			exit;
		}
		
		public function get_advertisement_video($field)
		{
			if ( $field == "advertisement_video" ) {
				$this->db->select('video');
				$this->db->from('ticketbaby_advertisement_video em');
				$this->db->where('field',$field);
				$query = $this->db->get();
				//echo $this->db->last_query();die;
		        return $query->result_array();
			}
		}
		

}