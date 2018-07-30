<?php
	function get_category_name($categoryId)
	{
		$CI =& get_instance();
		$sql = "select * from category_master where `cat_id` = '$categoryId'";
		$query = $CI->db->query($sql);
		return $query->result();
	}
	
	function get_country_name($countryId)
	{
		$CI =& get_instance();
		$sql = "select * from ticketbaby_countries where `id` = '$countryId'";
		$query = $CI->db->query($sql);
		return $query->result();
	}
	
	function get_state_name($stateId)
	{
		$CI =& get_instance();
		$sql = "select * from ticketbaby_states where `id` = '$stateId'";
		$query = $CI->db->query($sql);
		return $query->result();
	}
	
	function get_states_by_country_id($countryId)
	{
		$CI =& get_instance();
	echo	$sql = "select * from ticketbaby_states where `country_id` = '$countryId'";
		$query = $CI->db->query($sql);
		return $query->result();
	}
	
	function get_cities_by_country_id($stateId)
	{
		$CI =& get_instance();
		$sql = "select * from ticketbaby_cities where `state_id` = '$stateId'";
		$query = $CI->db->query($sql);
		return $query->result();
	}
	
	function get_city_name($cityId)
	{
		$CI =& get_instance();
		$sql = "select * from ticketbaby_cities where `id` = '$cityId'";
		$query = $CI->db->query($sql);
		return $query->result();
	}
	
	function get_event_by_id($eventId)
	{
		$CI =& get_instance();
		$sql = "select * from event_master where `id` = '$eventId'";
		$query = $CI->db->query($sql);
		return $query->result();
	}
	
	
	function get_cms_page_by_id($cmsId)
	{
		$CI =& get_instance();
		$sql = "select * from cms_master where `category` = '$cmsId'";
		$query = $CI->db->query($sql);
		return $query->result();
	}
	
	
	 function getCmsCategories(){
		$CI =& get_instance();
		$sql = "select id,category_name from ticketbaby_cms_category";
		$query = $CI->db->query($sql);
		return $query->result();
		
	  }
		
		
	/*function getOrganizationDetails($event_id){
		$CI =& get_instance();
		$sql = "select id,category_name from ticketbaby_cms_category";
		$query = $CI->db->query($sql);
		return $query->result();
		
	  }	*/
							
?>