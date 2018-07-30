<?php
class Coupon_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }


        public function coupon_record_count() {			
			$this->db->from('coupon_master');
			$count = $this->db->count_all_results();
			//echo $this->db->last_query();
			return $count;
		}


		public function get_coupons($limit,$start)
		{
			$this->db->limit($limit, $start);

			$this->db->select('cpm.*');
			$this->db->from('coupon_master cpm');
			$this->db->order_by('cpm.id DESC');
			$query = $this->db->get();
			return $query->result_array();	
			
		}

		public function getNextCouponId() {
			$this->db->select('max(id) as latest_id');
			$this->db->from('coupon_master');
			$query = $this->db->get();
			$row_array = $query->row_array();
			$new_id = intval($row_array["latest_id"]) + 1;
			return $new_id;
		}


		public function createUpdateCoupon($data) 
		{

			$coupon_code   					= trim($data['coupon_code']);
			$coupon_type         			= $data['coupon_type'];
	        $coupon_value       			= trim($data['coupon_value']);
	        $active       					= trim($data['active']);
	        $id       						= $data['id'];
	      
	        if( $coupon_code == "" ) {
	        	$array["success"] = false;
				$array["message"] = "Coupon code is missing!";
				return $array;
	        }

	      

			$this->db->select('coupon_master.*');
			$this->db->from('coupon_master');
			$this->db->where('coupon_master.coupon_code', $coupon_code);
			if( $id > 0) {
				$this->db->where('id!=', $id);
			}		
			$this->db->limit(1);
			$query = $this->db->get();

			if($query->num_rows() == 1)
			{	
				$array["success"] = false;
				$array["id"]  = $query->result_array()[0]["id"];
				$array["message"] = "Coupon code already exist!";
				return $array;
			}
			else
			{	

				$coupon_data = array(
				'coupon_code' => $coupon_code,
				'coupon_type' => $coupon_type,
				'coupon_value' 	=> $coupon_value,
				'active'	=> $active
				);

				if ( $id > 0 ) {
					$this->db->where('id', $id);	
					$this->db->update('coupon_master', $coupon_data);
					$array["success"] = true;
					$array["message"] = "Coupon has been updated successfully";
					return $array; 
				}else{
					$coupon_data["id"] = $this->getNextCouponId();
					$this->db->insert('coupon_master', $coupon_data); 
					$id = $this->db->insert_id();
					$array["success"] = true;
					$array["message"] = "Coupon has been added successfully";
					return $array;
				}	
			}

			$array["success"] = false;
			$array["message"] = "Error!, Try again later";
			return $array;
		}

		public function deleteCoupon($id = 0) {
			$this->db->delete('coupon_master', array('id' => $id)); 
			$array["success"] = true;
			$array["message"] = "Coupon has been deleted successfully";
			return $array;
		}



		public function get_coupon_by_id($id = 0)
		{
			if ( $id > 0 )
			{
		        $query = $this->db->get_where('coupon_master', array('id' => $id));
		        return $query->row_array();
			}else{
				return FALSE;
			}	
		}

		public function get_coupon_by_code($coupon_code = "")
		{
			if ( $coupon_code != "" )
			{
		        $this->db->select('coupon_master.*');
		        $this->db->from('coupon_master');
		        $this->db->where('coupon_code', $coupon_code);
		        $this->db->where('active', "Y");
		        $query = $this->db->get();
		        return $query->row_array();
			}else{
				return FALSE;
			}	
		}



}