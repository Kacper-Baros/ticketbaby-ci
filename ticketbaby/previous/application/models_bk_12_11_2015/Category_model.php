<?php
class Category_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_category_tree(&$array, $parent_id = 0, $level = 0){ //Recursive php function
			$query		  = $this->db->get_where('category_master', array('parent_id' => $parent_id));
		    $result_array = $query->result_array();

		    foreach($result_array as $k=>$row) {
				$array['cat_id'][] 			= $row['cat_id'];
				$array['category_name'][] 	= str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $level). ucwords($row['category_name']);
				$this->get_category_tree($array, $row['cat_id'], $level+1);
			}
		}


        public function get_category_by_id($cat_id = 0)
		{
			if ( $cat_id > 0 )
			{
		        $query = $this->db->get_where('category_master', array('cat_id' => $cat_id));
		        return $query->row_array();
			}else{
				return FALSE;
			}	
		}

        public function get_categories($slug = FALSE,$limit,$start)
		{
			$this->db->limit($limit, $start);

			if ($slug === FALSE)
			{
				$this->db->select('cm1.*,cm2.category_name as parent_category');
				$this->db->from('category_master cm1');
				$this->db->join('category_master cm2', 'cm2.cat_id = cm1.parent_id','left');
				$query = $this->db->get();
				return $query->result_array();
			}

			$query = $this->db->get_where('category_master', array('category_slug' => $slug));
			
			return $query->row_array();
		}

		public function record_count() {
			return $this->db->count_all("category_master");
		}

		public function getNextId() {
			$this->db->select('max(cat_id) as latest_cat_id');
			$this->db->from('category_master');
			$query = $this->db->get();
			$row_array = $query->row_array();
			$new_cat_id = intval($row_array["latest_cat_id"]) + 1;
			return $new_cat_id;
		}

		public function createCategory($data) 
		{
			$category_name         	= trim($data['category_name']);
	        $category_slug       	= trim($data['category_slug']);
	        $parent_id      		= trim($data['parent_id']);
	        $category_description   = trim($data['category_description']);
	        $active      			= trim($data['active']);

	        if ( $category_name == "" || $category_slug == "" ) {
	        	$array["success"] = false;
				$array["message"] = "Category name and slug fields are mandatory";
				return $array;	
	        }

			$this->db->select('cat_id, category_name');
			$this->db->from('category_master');
			$this->db->where('category_name', $category_name);
			$this->db->limit(1);

			$query = $this->db->get();

			if($query->num_rows() == 1)
			{	
				$array["success"] = false;
				$array["cat_id"]  = $query->result_array()[0]["cat_id"];
				$array["message"] = "Category name already exist!";
				return $array;
			}
			else
			{ 
				$category_data = array(
				'cat_id'		=> $this->getNextId(),
				'category_name' => $category_name,
				'category_slug' => $category_slug,
				'parent_id' 	=> $parent_id,
				'category_description'	=> $category_description,
				'created_date' => date("Y-m-d H:i:s"),
				'modified_date'=> date("Y-m-d H:i:s"),
				'active' => $active
				);

				$this->db->insert('category_master', $category_data); 
				$category_id = $this->db->insert_id();

				if ( $category_id > 0 ) {

					/* Set Category Main Image */
					$configImage = array();
					
					$configImage['tb_field_name']   =  "img_extension";
					$configImage['img_field_name']  =  "img_extension";
					$configImage['upload_path']     =  FCPATH . 'assets/upload/category/';
					$configImage['allowed_types']   = 'gif|jpg|png';
					$configImage['max_width']       = '0'; // Set to zero for no limit 
					$configImage['max_height']      = '0';
					$configImage['overwrite']       =  TRUE;
					$configImage['file_name']       =  'cat_img_' . $category_id; 

					/* Set Category Thumb Image */
					$configImageArr = array(
							"image_library" => "gd2",
							"quality" => "100%",
							"create_thumb" => FALSE,
							"maintain_ratio" => TRUE,
							"new_image_folder" => FCPATH . 'assets/upload/category/thumb/',
							"thumb_configs" => array(
								array(
									"tb_field_name" => "thumb1",
									"width" => 500,
									"height" => 500
								),
								array(
									"tb_field_name" => "thumb2",
									"width" => 300,
									"height" => 250
								)
							)	
						);

					$RESPONSE = $this->uploadImages ($configImage, $configImageArr);


					if ( $RESPONSE["img_thumb_arr"] && sizeof( $RESPONSE["img_thumb_arr"] ) > 0 ) {
						$RESPONSE["img_thumb_arr"]["cat_id"] = $category_id;
						$this->updateCategoryThumb ( $RESPONSE["img_thumb_arr"] );
					}

					$array["success"] = true;
					$array["cat_id"]  = $category_id;
					$array["message"] = "Category has been created successfully";
					return $array;
				}
				
			}

			$array["success"] = false;
			$array["message"] = "Error!, Try again later";
			return $array;
		}


		public function updateCategory($data) 
		{
			$category_id        	= trim($data['cat_id']);
			$category_name         	= trim($data['category_name']);
	        $category_slug       	= trim($data['category_slug']);
	        $parent_id      		= trim($data['parent_id']);
	        $category_description   = trim($data['category_description']);
	        $active      			= trim($data['active']);

	        if ( $category_name == "" || $category_slug == "" ) {
	        	$array["success"] = false;
				$array["message"] = "Category name and slug fields are mandatory";
				return $array;	
	        }

	        // Check duplicate
	        $this->db->select('cat_id, category_name');
			$this->db->from('category_master');
			$where = "cat_id!='$category_id' AND (category_name='$category_name' OR category_slug='$category_slug')";
			$this->db->where($where);
			$this->db->limit(1);
			$query = $this->db->get();
			if($query->num_rows() == 1)
			{	
				$array["success"] = false;
				$array["cat_id"]  = $query->result_array()[0]["cat_id"];
				$array["message"] = "Category name/slug already exist!";
				return $array;
			}
			// Check duplicate



	        $category_data = array(
				'category_name' => $category_name,
				'category_slug' => $category_slug,
				'parent_id' 	=> ($parent_id == $category_id) ? 0 : $parent_id,
				'category_description'	=> $category_description,
				'modified_date'=> date("Y-m-d H:i:s"),
				'active' => $active
				);

	        $this->db->where('cat_id', $category_id);	
			$this->db->update('category_master', $category_data); 

			$array["success"] = true;
			$array["message"] = "Category updated successfully";


			if ( $category_id > 0 ) {

				/* Set Category Main Image */
				$configImage = array();

				$configImage['tb_field_name']   =  "img_extension";
				$configImage['img_field_name']  =  "img_extension";
				$configImage['upload_path']     =  FCPATH . 'assets/upload/category/';
				$configImage['allowed_types']   = 'gif|jpg|png';
				$configImage['max_width']       = '0'; // Set to zero for no limit 
				$configImage['max_height']      = '0';
				$configImage['overwrite']       =  TRUE;
				$configImage['file_name']       =  'cat_img_' . $category_id; 

				/* Set Category Thumb Image */
				$configImageArr = array(
				"image_library" => "gd2",
				"quality" => "100%",
				"create_thumb" => FALSE,
				"maintain_ratio" => TRUE,
				"new_image_folder" => FCPATH . 'assets/upload/category/thumb/',
				"thumb_configs" => array(
				array(
					"tb_field_name" => "thumb1",
					"width" => 500,
					"height" => 500
				),
				array(
					"tb_field_name" => "thumb2",
					"width" => 300,
					"height" => 250
				)
				)	
				);

				$RESPONSE = $this->uploadImages ($configImage, $configImageArr);


				if ( $RESPONSE["img_thumb_arr"] && sizeof( $RESPONSE["img_thumb_arr"] ) > 0 ) {
					$RESPONSE["img_thumb_arr"]["cat_id"] = $category_id;
					$this->updateCategoryThumb ( $RESPONSE["img_thumb_arr"] );
				}

				$array["success"] = true;
				$array["cat_id"]  = $category_id;
				$array["message"] = "Category updated successfully";
				return $array;
			}

			$array["success"] = false;
			$array["message"] = "Error!, Try again later";
			return $array;

		}


		public function updateCategoryThumb($data) 
		{
			$cat_id   = $data["cat_id"];
			$category_data = array(
			'img_extension' 	=> $data['img_extension'],
			'thumb1' => $data['thumb1'],
			'thumb2' => $data['thumb2']
			);
			$this->db->where('cat_id', $cat_id);
			$this->db->update('category_master', $category_data); 
			return $cat_id;
		}


		public function uploadImages($configImage, $configImageArr) {

			/* Default response */
			$array["success"] 		= false;		
			$array["message"] 		= "Image uploading Failed!, Try again later"; 
			$array["img_thumb_arr"] = array(); 


            $this->load->library('upload', $configImage);

            if ( !$this->upload->do_upload($configImage['img_field_name']))
            {
				$array["success"] = false;
				$array["message"] = $this->upload->display_errors();
				return $array;
            }
            else
            {
            	$array["success"] = true;
				$array["message"] = "Image uploaded successfully";


                $uploadedFileArr   =  $this->upload->data();  
                if(is_file($uploadedFileArr['full_path']))
                {
                    chmod($uploadedFileArr['full_path'], 0777); ## this should change the permissions
                    $array["img_thumb_arr"][$configImage['tb_field_name']] = $uploadedFileArr['file_ext'];
                }

				$configImageLib['image_library']    	= $configImageArr['image_library'];
				$configImageLib['quality']          	= $configImageArr['quality'];
				$configImageLib['maintain_ratio']     	= $configImageArr['maintain_ratio'];
				$configImageLib['source_image']     	= $uploadedFileArr["full_path"];

                $this->load->library('image_lib', $configImageLib);
                
				foreach($configImageArr["thumb_configs"]  as $configImageArrItem) {

					$configImageLib['image_library']    	= $configImageArr['image_library'];
					$configImageLib['quality']          	= $configImageArr['quality'];
					$configImageLib['maintain_ratio']     	= $configImageArr['maintain_ratio'];
					$configImageLib['source_image']     	= $uploadedFileArr["full_path"];
					$configImageLib['width'] 	 			= $configImageArrItem['width'];
					$configImageLib['height'] 	 			= $configImageArrItem['height'];
					$configImageLib['new_image'] 			= $configImageArr['new_image_folder'] . $uploadedFileArr['raw_name'] . "_". $configImageArrItem['tb_field_name'] . $uploadedFileArr['file_ext'];    

					$this->image_lib->initialize($configImageLib);

	                if ( ! $this->image_lib->resize())
	                {
	                    $array["success"] = false;
						$array["message"] = $this->image_lib->display_errors();
						return $array;
	                }else{
	                	
	                    if(is_file($configImageLib['new_image']))
	                    {
	                        chmod($configImageLib['new_image'], 0777); ## this should change the permissions
							$array["success"] = true;
							$array["message"] = "Thumb mage uploaded successfully";
							$array["img_thumb_arr"][$configImageArrItem['tb_field_name']] = $uploadedFileArr['raw_name'] . "_". $configImageArrItem['tb_field_name'] . $uploadedFileArr['file_ext'];
	                    }
	                }              
					$this->image_lib->clear();
				}		       
            }

    		return $array;
		}



}