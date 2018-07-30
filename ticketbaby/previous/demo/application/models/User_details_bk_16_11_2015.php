<?php
class User_details extends CI_Model {
	protected $_table_name = 'user_details';
	protected $_table_names = 'user_master';
	protected $_table_order = 'order_master';
	
        public function __construct()
        {
                $this->load->database();
        }
	
	
   /*
	** change password
	*/  
	public function confirm_password()
	{	$id					   = $this->input->post('user_ids');
		$email 			=	$this->input->post('email');
		$old_password 	=	md5($this->input->post('old_password'));
		$password		=	md5($this->input->post('password'));
		$conf_password	=	md5($this->input->post('con_password'));
		
		$change_data=array
		(
		'password' => $conf_password
		);
	
	if ($password==$conf_password)
	{
		$this->db->where(" password = '{$old_password}' and id = '{$id}'");
		$this->db->update('user_details', $change_data); 
		$query = $this->db->get($this->_table_name);
		$user	=	$query->row_array();

	}	
		if(count($user)){
			//get existing user detail
			$data = array(
				'first_name' 	=> $user['first_name'],
				'last_name' 	=> $user['last_name'],
				'id' 			=> $user['id'],
				'loggedin' 		=> TRUE,
				'status' 		=> $user['status'],
				'email'			=> $user['email'],
				'loggedin_time'	=> time()
				);
			//$this->session->set_userdata('user_cart', serialize($data));
			return true;
		}
	}
	
	/*
	** Check  login 
	*/
	public function login()
	{	
		echo $password	=	md5($this->input->post('password'));
	echo 	$email 		=	$this->input->post('email');
		
		$this->db->where("email = '{$email}' and password = '{$password}' and status = '1'");
		$query = $this->db->get($this->_table_name);
		$user	=	$query->row_array();
		
		if(count($user)){
			//User Exists Logg in detail
			$login_data = array(
				'id' 			=> $user['id'],
				'first_name' 	=> $user['first_name'],
				'user_name' 	=> $user['user_name'],
				'email'			=> $user['email'],
				'address'		=> $user['address'],
				'state'		    => $user['state'],
				'city'		    => $user['city'],
				'country'		=> $user['country'],
				'zip'			=> $user['zip'],
				'loggedin' 		=> TRUE,
				'loggedin_time'	=> time()
				
				);
			
			$this->session->set_userdata('user_cart', serialize($login_data));
			return true;
		}
	}
		
		/***
		user order details
		****/
		public function order_detail() 
		{
		
			$id					   = $this->input->post('user_ids');
			//die('test');
			$this->db->where('id',$id);
			$this->db->select('*'); 
			$query = $this->db->get($this->_table_order);
			$user	=	$query->row_array();
		
			if(count($userDetail)){
			
			$data = array(
				
				'pay_id' 		=> $userDetail['pay_id'],
				'first_name' 	=> $userDetail['first_name'],
				'last_name' 	=> $userDetail['last_name'],
				'email'			=> $userDetail['email'],
				'address'		=> $userDetail['address'],
				'area'		    => $userDetail['area'],
				'city'		    => $userDetail['city'],
				'post_code'		=> $userDetail['post_code'],
				'country'		=> $userDetail['country'],
				'phone'		    => $userDetail['mobile_number'],
				'total_amount'	=> $userDetail['total_amount'],
				'loggedin' 		=> TRUE,
				'status' 		=> $userDetail['status'],
				'loggedin_time'	=> time()
				);
			$this->session->set_userdata('user_order', serialize($data));
			return true;
		}
		}
				
		/***
		update user details
		****/
		public function updateUser() 
		{		
				$id					   = $this->input->post('user_ids');
				$first_name            = $this->input->post('first_name');
				$user_name      	   = $this->input->post('user_name');
				$email      		   = $this->input->post('email');
				$address      		   = $this->input->post('address');
				$area      		   	   = $this->input->post('area');
				$city      		       = $this->input->post('city');
				$phone      		   = $this->input->post('phone');
				$country      		   = $this->input->post('country');
				
			$user_detail = array(
		    'first_name'           =>  trim($first_name),
			'user_name'      	   =>  trim($user_name),
            'email'      		   =>  trim($email),
            'address'      		   =>  trim($address),
            'area'     		   	   =>  trim($area),
            'city'      		   =>  trim($city),
            
            'country'      		   =>  trim($country),
            'phone'      		   =>  trim($phone)
            );
			
		
		$this->db->where('id',$id);
		$this->db->update('user_details', $user_detail); 
		$query			 = $this->db->get($this->_table_name);
		$userDetail 	 =	$query->row_array();
		
			if(count($userDetail)){
			
			$data = array(
				
				'first_name' 	=> $userDetail['first_name'],
				'user_name' 	=> $userDetail['user_name'],
				'email'			=> $userDetail['email'],
				'address'		=> $userDetail['address'],
				'area'		    => $userDetail['area'],
				'city'		    => $userDetail['city'],
				
				'country'		=> $userDetail['country'],
				'loggedin' 		=> TRUE,
				'status' 		=> $userDetail['status'],
				'loggedin_time'	=> time()
				);
			//$this->session->set_userdata('user_cart', serialize($data));
			return true;
		}
		}
			
		/*
		** Function for Checking a User is logged in or Not
		*/
		
		public function loggedin()
		{
			$sess = $this->session->userdata('user_cart');
			$ar = unserialize($sess);
			return (bool) $ar['loggedin'];
		}
		
		public function get_user_by_username($username = FALSE)
		{
				if ($username === FALSE)
				{
						$query = $this->db->get('user_details');
						return $query->result_array();
				}

				$query = $this->db->get_where('user_details', array('username' => $username));
				return $query->row_array();
		}
			
		public function registerUserNew($data) 
		{
				$user_name	     	   =  trim($data['user_name']);
				$first_name            =  trim($data['first_name']);
				$email      		   =  trim($data['email']);
				$mobile_number         =  trim($data['mobile_number']);
				$password        	   =  trim($data['password']);
				$re_password      	   =  trim($data['re_password']);
				
			if ($password==$re_password)
			{			
				$new_user_data = array(
					
					'user_name'		 => $user_name,
					'first_name'	 => $first_name,
					'email'			 => $email,
					'phone' 		 => $mobile_number,
					'status' 		 => '1',
					
					'password'		 => MD5($password)
					);
			
					
					
					$this->db->insert($this->_table_name, $new_user_data); 
					return $user_id = $this->db->insert_id();
			}
			else
			{
			$this->session->set_flashdata('error', '<div class="alert alert-warning display-hide"><span>Your registration is not save! Please try again.</span></div> ');				
					redirect("user/registration");	
			}
		}	
		public function check_email_available($data,$user_id=null)
		{	
			if($user_id)
				$this->db->where("email ='{$data}' AND id !='{$user_id}'");
			else
				$this->db->where('email', $data);
			
			$rest = $this->db->count_all_results('user_details');
			return $rest;
			
		}
		public function check_username_available($data)
		{	
			$this->db->where('user_name', $data);
			$rest = $this->db->count_all_results('user_details');
			return $rest;
			
		}	
		/*
		Backend
		*/
		public function get_user_by_id($user_id = 0)
		{
				if ( $user_id > 0 )
				{
					$query = $this->db->get_where('user_details', array('id' => $user_id));
					return $query->row_array();
				}else{
					return FALSE;
				}	
		}

		public function record_count() 
		{
			$this->db->select('count(DISTINCT id) as total');
			if($q){
				$this->db->like("email" , $q,'both');
				$this->db->or_like("first_name" , $q,'both');
			}
			$query = $this->db->get($this->_table_name);
			$row	=	$query->result_array();
			
			$total	=	($row[0]['total']);
			return $total;		
		}

		public function get_users($username = FALSE,$limit,$start,$q=null)
		{
				$this->db->limit($limit, $start);
				if ($username === FALSE)
				{
						//$this->db->where('user_details.id_admin', '0');
						if($q){
							$this->db->like("email" , $q,'both');
							$this->db->or_like("first_name" , $q,'both');
						}
						$query = $this->db->get($this->_table_name);       
						return $query->result_array();
				}
				$query = $this->db->get_where($this->_table_name, array('username' => $username));
				return $query->row_array();
		}

		
		public function invitation_event($data) 
		{
				
				
			if ($data)
			{	
					$this->db->insert('invite_user_event', $data);
					return $user_id = $this->db->insert_id();
			}
			else
			{
				return false;
			}
		}
		// Get User Event Details
		public function get_user_event($event_id){
			$query = $this->db->get_where('user_event', array('id' => $event_id));
			return $query->row_array();
		}
		// Get User  Details
		public function get_user_detail($event_id){
			$query = $this->db->get_where('user_details', array('id' => $event_id));
			return $query->row_array();
		}
		public function user_all_event($user_id,$limit,$start)
		{
				if($limit)
					$this->db->limit($limit, $start);
				
				if ($user_id)
				{
						$this->db->where('user_event.user_id', $user_id);
						$query = $this->db->get('user_event');       
						if($limit){
							return $query->result_array();
						}else{
							return count($query->result_array());
						}
				}
				
		}
		// Attend event
		public function get_url_attend_event($data){
			$user_id					=	(int)$data['user_id'];
			$email						=	$data['email'];
			$code						=	(int)$data['code'];	
			$query = $this->db->get_where('invite_user_event', array('user_id' => $user_id,'code' => $code));
			return $query->row_array();
		}
		// Attend event
		public function attend_event($data){
			$user_id					=	(int)$data['user_id'];
			$email						=	$data['email'];
			$code						=	(int)$data['code'];	
			$datas['attend_user']		=	1;
			$this->db->where("user_id = '{$user_id}' and code = '{$code}'");
			
			if($this->db->update("invite_user_event",$datas))
				return true;
			else
				return false;
		}
		
		public function accept_request($user_id,$event_id,$limit,$start)
		{
				if($limit)
					$this->db->limit($limit, $start);
				
				if ($user_id && $event_id)
				{
						$this->db->where("invite_user_event.user_id= '{$user_id}' AND invite_user_event.event_id='{$event_id}' ");
						$query = $this->db->get('invite_user_event');  
							
						if($limit){
							return $query->result_array();
						}else{
							return count($query->result_array());
						}
				}
				
		}
		/*************/
		public function createUpdateUser($data) 
		{
			$id						=	$data['id'];
			$password				=	$data['password'];
			if($password == 'password_boxer')
				unset($data['password']);
			else
				$data['password']	=	md5($data['password']);
			
			if($id){
				$data['modified_date']	=	date('Y-m-d H:i:s');
				$this->db->where('id',$id);
				$r=	$this->db->update($this->_table_name,$data);
				if($r){
					$array["success"] = true;
					$array["message"] = "Client has been updated successfully.";
				}
				
			}else{
				$data['password']	=	md5($data['password']);
				$data['created_date']	=	date('Y-m-d H:i:s');
				$r=	$this->db->insert($this->_table_name,$data);
				if($r){
					$array["success"] = true;
					$array["message"] = "Client has been added successfully";
				}
				
			}
			
			
			
			return $array;
			exit;
		}

		
		// Export Data
		public function export_data(){
			$query 			= $this->db->get($this->_table_name);
			$find_all_data	=	 $query->result_array();
			//print_r($find_all_data);die('test');
			$list[]			= 	array("Sr.","Username","Fullname","Email","Phone");
			header('Content-Type: text/csv/; charset=utf-8');
			header('Content-Disposition: attachment; filename=CSV-'.date('d-M-Y').'_'.rand(1,999).'.csv');
			$file = fopen('php://output', 'w');
			$i = 1;
			foreach ($find_all_data as $_row) {
				$list[]=array($i,$_row['user_name'],$_row['first_name'],$_row['email'],$_row['phone']);
				$i++;
			}
			foreach ($list as $fields) {
				fputcsv($file, $fields);
			}
			
			exit;
			fclose($file);	
		}
		
		// Import Csv Data
		public function import_csv_data(){
			 if($_FILES["file"]["size"] > 0)
			 {
				$filename=$_FILES["file"]["tmp_name"];
				$file = fopen($filename, "r");
				$k	=	0;
				while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
				{
					
					if($emapData[0] !='Sr.' && !empty($emapData[1]) && $emapData[2] && $emapData[3] && $emapData[4]){
						//print_r($emapData);die('test');
						$data['user_name']		=	$emapData[1];
						$data['first_name']		=	$emapData[2];
						$data['email']			=	$emapData[3];
						$data['phone']			=	$emapData[4];
						$data['status']			=	1;
						if($this->check_email_available($data['email'])){
							$array["error"] = true;
							$array["message"] = "Email already exits '{$data['email']}'! Please change email.";
							return $array;
						}else{
							$r=	$this->db->insert($this->_table_name,$data);
							if($r){
								$k++;
							}
						}
						
						
						
					}	
					
				 }
				 fclose($file);
				 $array["success"] = true;
				 $array["message"] = "Csv file has been uploaded successfully";
				 if($k > 0){
					 return $array;
				 }else{
					$array["error"] = true;
					$array["message"] = "Csv file is not uploaded";
					return $array;
				 }
				 
			 }	 
		}
		
		
		
		
		
}