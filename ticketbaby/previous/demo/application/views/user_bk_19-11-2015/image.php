<div class="image_preview">
<?php 
$close = base_url().'index.php/user/my_event';
echo '<a href="'.$close.'">Close Preview</a>';
?>
</div>
<?php

if($all_event){
		
		foreach($all_event as $_row_event){ 
	
				$avatar		=	$_row_event['thumb1'];
			
				if(!empty($avatar)){
					
					$url 		= 	 base_url();
					$path		=	$_SERVER['DOCUMENT_ROOT'] . "/demo/assets/upload/event/thumb/{$avatar}";
				
					if(file_exists($path)){
					
					 $img_path = $path;
				     $img_path 	=	$url. "assets/upload/event/thumb/{$avatar}";
					echo  '<img src="'.$img_path.'" style="height:60%; width:65%; margin-left:200px; margin-top:50px;">';
					}
				}



		}
		
}

?>
<div class="image_preview">
<?php 
	echo "<br/>";	echo "<br/>";
echo $_row_event['title'];
	echo "<br/>";	echo "<br/>";
echo $_row_event['start_date'];
$close 		= 	 base_url()."index.php/user/my_event";	
?>
</div>

<style>
.image_preview{

height:50px;
width:300px;
margin-left:550px;
}
</style>