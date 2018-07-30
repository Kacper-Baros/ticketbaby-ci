
<div class="container-fluid content-bg">
	<div class="container content">
        <div class="row no-mar main-content leftPad">
			<div class="col-md-6 col-xs-12">
				<h2 class="text-orange">Dashboard - Event Preview</h2>
			</div>
			<div class="col-md-6 col-xs-12 text-right"><br/>
				<!-- <button class="btn btn-success btn-lg">Profile Settings</button> -->
			</div>
			<div class="col-xs-12">
				<nav class="navbar navbar-default subNav">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#subNav">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                    </div>
                    <div class="collapse navbar-collapse" id="subNav">
                      <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url();?>index.php/user/editProfile"><i class="glyphicon glyphicon-list-alt"></i> Account Details</a></li>
						<li><a href="<?php echo base_url();?>index.php/user/order_detail"><i class="glyphicon glyphicon-tasks"></i> Order Details</a></li>
						<li><a href="<?php echo base_url();?>index.php/user/my_event"><i class="glyphicon glyphicon-calendar"></i> My Events</a></li>
                       </ul>                                                                   
					  <ul class="nav navbar-nav navbar-right">
					  <li class="dropdown">
							<a href="" data-toggle="dropdown" class="dropdown-toggle"><i class="glyphicon glyphicon-cog"></i>&nbsp;<?php echo ucfirst($user['user_name']);?><b class="caret"></b></a>
					<ul class="dropdown-menu"> 
							<li><a href="<?php echo base_url();?>index.php/user/logout"><i class="glyphicon glyphicon-log-in"></i> Logout</a></li>
							<li><a href="<?php echo base_url();?>index.php/user/editProfile"><i class="glyphicon glyphicon-pencil"></i> Edit Profile</a></li>
						</ul>
					  </li> 
					  </ul>
                    </div>
                </nav>
			</div>
			<div class="col-xs-12"><hr/></div>
			<div class="col-xs-12">
				<ol class="breadcrumb">
				   <li><a href="<?php echo base_url();?>index.php/cart/home">Home</a></li>
				   <li><a href="<?php echo base_url();?>index.php/cart/home">Dashboard</a></li>
				   <li><a href="<?php echo base_url();?>index.php/user/my_event">My Events</a></li>
				   <li class="active">Event Preview</li>
				</ol>
			</div>
			<div class="col-xs-12">
				<div class="col-md-6 col-xs-12">
				
<?php

if($all_event){
		
		foreach($all_event as $_row_event){ 
	
				$avatar		=	$_row_event['thumb1'];
			
				if(!empty($avatar)){
					
					$url 		= 	 base_url();
					$path		=	base_url() . "assets/upload/event/thumb/{$avatar}";
				
					 // exit;
					if($avatar != null){
					
					 $img_path = $path;
					 
				     $img_path 	= $url. "assets/upload/event/thumb/{$avatar}";
					
					
					//echo  '<img src="'.$img_path.'" style="height:60%; width:65%; margin-left:200px; margin-top:50px;">';
					}
					
		
					
					}}}





?>
					<img src="<?php echo $img_path; ?>" title="<?php echo $_row_event['title']; ?>" alt="<?php echo $_row_event['title']; ?>"class="img-responsive img-thumbnail"/>
					<br/><br/>
 				</div>
				<div class="col-md-6 col-xs-12">
					<div class="col-xs-12 wellz">

						<p><strong>Event Name:- </strong><?php echo $_row_event['title']; ?></p>
						<p><strong>Event Date:- </strong><?php echo date("d F Y",strtotime($_row_event['start_date'])) ?></p>
						<p><strong>Category:- </strong><?php echo $_row_event['category']; ?></p>
						<p><strong>Location:- </strong><?php echo $_row_event['venue'];?></p>
						<p><strong>Event Description:- </strong><?php echo $_row_event['details'];?></p>
						<p><strong>Organizer Name:- </strong><?php echo $_row_event['organizer_name'];?></p>
						
						<p><strong>Organizer Description:- </strong><?php echo $_row_event['organizer_description'];?></p>
						
					</div>
				</div>
			</div>
        </div>
    </div>
</div>