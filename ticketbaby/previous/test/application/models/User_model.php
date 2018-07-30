<?php
class User_model extends CI_Model {
protected $_table_names = 'user_master';
        public function __construct()
        {
                $this->load->database();
        }

        public function get_user_by_username($username = FALSE)
		{
			if ($username === FALSE)
			{
			        $query = $this->db->get('user_master');
			        return $query->result_array();
			}

			$query = $this->db->get_where('user_master', array('username' => $username));
			return $query->row_array();
		}

		public function registerUser($data) 
		{

			$first_name         = trim($data['first_name']);
            $email        	 	= trim($data['email']);
            $password      		= trim($data['password']);

            if ( $first_name == "" || $email == "" || $password == "") {
            	$array["success"] = false;
				$array["message"] = "All field are mandatory";
				return $array;	
            }

			$this->db->select('id, username, email');
			$this->db->from('user_master');
			$this->db->where('email', $email);
			$this->db->limit(1);

			$query = $this->db->get();

			if($query->num_rows() == 1)
			{	
				$array["success"] = false;
				$array["message"] = "Email already exist!";
				return $array;
			}
			else
			{ 
				$user_data = array(
				'username' => $email,
				'password' => MD5($password),
				'first_name' => $first_name,
				'email' => $email,
				'active' => 'Y',
				'created' => date("Y-m-d H:i:s")
				);

				$this->db->insert('user_master', $user_data); 
				$user_id = $this->db->insert_id();

				if ( $user_id > 0 ) {
					$array["success"] = true;
					$array["message"] = "Success";
					return $array;
				}
				
			}

			$array["success"] = false;
			$array["message"] = "Error!, Try again later";
			return $array;

		}



		/*
		Backend
		*/

		public function get_user_by_id($user_id = 0)
		{
			if ( $user_id > 0 )
			{
		        $query = $this->db->get_where('user_master', array('id' => $user_id));
		        return $query->row_array();
			}else{
				return FALSE;
			}	
		}

		public function record_count($q=null) {
			$this->db->select('count(DISTINCT id) as total');
			if($q){
				$this->db->like("email" , $q,'both');
				$this->db->or_like("first_name" , $q,'both');
			}
			$query = $this->db->get('user_master');
			$row	=	$query->result_array();
			
			$total	=	($row[0]['total']);
			return $total;		
			//return $this->db->count_all("user_master");
		}

		public function get_users($username = FALSE,$limit,$start,$q=null)
		{
			$this->db->limit($limit, $start);
			if ($username === FALSE)
			{
					
					$this->db->where('user_master.id_admin', '0');
					if($q){
						$this->db->like("email" , $q,'both');
						$this->db->or_like("first_name" , $q,'both');
					}
						
			        $query = $this->db->get('user_master');       
			        return $query->result_array();
			}
			
			$query = $this->db->get_where('user_master', array('username' => $username));
			return $query->row_array();
		}

		
	
	
		public function createUpdateUser() 
		{	
				$id					   = $this->input->post('id');
				$email            = $this->input->post('email');
				$password      	   = trim($this->input->post('password'));
				$first_name    		   = $this->input->post('first_name');
				$last_name      		   = $this->input->post('last_name');
				$address      		   	   = $this->input->post('address');
				$city      		       = $this->input->post('city');
				$state      		   = $this->input->post('state');
				$country      		   = $this->input->post('country');
				$zip			   = trim($this->input->post('zip'));
				$active				=$this->input->post('active');
			//echo $active;die;
			$user_detail = array(
		    'first_name'           =>  trim($first_name),
		    'last_name'            =>  trim($last_name),
		    'email'      		   =>  trim($email),
            'address'      		   =>  trim($address),
            'zip'     		   	   =>  trim($zip),
            'city'      		   =>  trim($city),
            'country'      		   =>  trim($country),
            'active'      		   =>  $active,
			
            'state'      		   =>  trim($state)
			
            );
			//	print_r($user_detail);die;
	
		$this->db->where('id',$id);
		$this->db->update('user_master', $user_detail); 
		$query			 = $this->db->get('user_master');
		$userDetail 	 =	$query->row_array();
		
			if(count($userDetail)){
			
			$data = array(
				
				'first_name' 	=> $userDetail['first_name'],
				'last_name' 	=> $userDetail['last_name'],
				'email'			=> $userDetail['email'],
				'address'		=> $userDetail['address'],
				'state'		    => $userDetail['state'],
				'city'		    => $userDetail['city'],
				'zip'		    => $userDetail['zip'],
				
				'country'		=> $userDetail['country'],
				'loggedin' 		=> TRUE,
				'active' 		=> $userDetail['active'],
				'loggedin_time'	=> time()
				);
				//print_r($data);die;
			//$this->session->set_userdata('user_cart', serialize($data));
			return true;
			
		}
		//die('test');
		}
		
		
		
		public function exportuserData($data){
			
			//echo "<pre>";print_r($data);
			$fileds = '';
			$list = array();
			$listArrData = array();
			
			
			$headings = array();
			if(!empty($data['fields'])){
				$listArrData[] = 'Sl No.';
				foreach($data['fields'] as $field){
					$fileds.='user_master.'.$field.',';
					
					$listArrData[]=$field;				
				}
			}
			
			$fileds = rtrim($fileds,',');
			
			$this->db->select($fileds);
			$this->db->from('user_master');
			$query = $this->db->get();			
			$find_all_data	=	 $query->result_array();
			
			$list[]			= 	$listArrData;
			
			header('Content-Type: text/csv/; charset=utf-8');
			header('Content-Disposition: attachment; filename=CSV-'.date('d-M-Y').'_'.rand(1,999).'.csv');
			$file = fopen('php://output', 'w');
			$i = 1;
			foreach ($find_all_data as $_row) {
				$listArrDataValue = array();
				$listArrDataValue[] = $i;
				foreach($listArrData as $heading){ 
					
					$listArrDataValue[] = $_row[$heading];
					
				}
				unset($listArrDataValue[1]);
					
				$i++;
				$list[] = $listArrDataValue;
			}
			
			
			foreach ($list as $dataVal) {
				fputcsv($file, $dataVal);
			}
			
			exit;
			fclose($file);
			
			$array["success"] = true;
			return $array;
		}

}