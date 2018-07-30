

<div class="container-fluid content-bg">
	<div class="container content">
        <div class="row no-mar main-content leftPad">
			<div  class="col-md-6 col-xs-12 thanks ">
			<?php if($yes==1){
				echo "<h4>Thanks for accepting invitation.</h4>";
		}?>
		</div>
		
			<div class="col-md-6 col-xs-12 text-right"><br/>
				<!-- <button class="btn btn-success btn-lg">Profile Settings</button> -->
			</div>
			<div class="col-xs-12">
				<div class="col-md-6 col-xs-12">
				
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
					
					
					//echo  '<img src="'.$img_path.'" style="height:60%; width:65%; margin-left:200px; margin-top:50px;">';
					}
					
		
					
					}}}

?>
					<img src="<?php echo $img_path; ?>" style="width:50%;"title="<?php echo $_row_event['title']; ?>" alt="<?php echo $_row_event['title']; ?>"class="img-responsive img-thumbnail"/>
					<br/><br/>
 				</div>
				<div class="col-md-6 col-xs-12">
					<div class="col-xs-12 back">

					
						<p><strong>Event Name </strong><?php echo $_row_event['title']; ?></p>
						<p><strong>Event Start Date </strong><?php echo date("d F Y",strtotime($_row_event['start_date'])); ?></p>
						<p><strong>Organizer Name </strong><?php echo $_row_event['organizer_name']; ?></p>
						<p><strong>Venue </strong><?php echo $_row_event['venue'];?></p>
						<p><strong>City </strong><?php echo $_row_event['city']; ?></p>
						<p><strong>Country </strong><?php echo $_row_event['country']; ?></p>
						

					</div>	
			
				</div>
	
		</div>
        </div>
    </div>
</div>
	<style>
	.thanks{
	color: green;
  
	}
	.back{
	 height:210px;
  padding-left: 20px;

  background-color: #f5f5f5;
  border: 1px solid #e3e3e3;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
	}
	</style>