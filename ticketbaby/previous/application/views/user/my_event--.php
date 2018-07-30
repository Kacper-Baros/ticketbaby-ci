

<?php if($event_id){?>
<form class="form-horizontal" name="form" id="" method="POST" action="<?php echo base_url();?>index.php/user/invitation">   
      
        <div class="row no-mar main-content">
          
                  <div class="col-md-6 col-xs-8 text-right">
                  <h1>Invite People</h1>
            </div>
			
			<div class="col-xs-12 bgGray"><br/>
              <?php if($this->session->flashdata('error')) { ?>                    
                        <p style="color:red">
                            <?php echo $this->session->flashdata('error');?>
                        </p>                   
                    <?php } 
					 elseif($this->session->flashdata('success')) { ?>                    
                        <p style="color:green">
                            <?php echo $this->session->flashdata('success');?>
                        </p>                   
                    <?php }?>          
                       
		<div class="billing-details"> 
		<div class="form-group cus-form">	
		<input type="hidden" name="event_id" value="<?php echo $event_id;?>">
		
	
		
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Send a test invitation to:</label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input autocomplete="off" type="email" required='true' class="form-control-register" value="<?php echo $email;?>" name="email" />
		  </div><br/><Br/>
	</div>
	
            
	<div class="col-xs-12">
		
		
		 	  <div class="col-md-0 col-xs-12 ">
		  </br>
		 <input class="btn btn-danger btn-red btn-lg" type='Submit' name='send' value="Send">
		 <a href="<?php echo base_url();?>index.php/user/my_event"><input class="btn btn-danger btn-red btn-lg" value="Back"></a><br/>
		
		
		  </div>
		 
		  
		  <br/><br/>
	</div>
                             </div>
                      </div>
                  </div>
               
                
        </div>
        
</form>
<?php }
	?>

<div class="container-fluid content-bg">
	<div class="container content">
        <div class="row no-mar main-content leftPad">
			<div class="col-md-6 col-xs-12">
				<h2 class="text-orange">Dashboard - My Events</h2>
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
						<a href="" data-toggle="dropdown" class="dropdown-toggle"><i class="glyphicon glyphicon-cog"></i>&nbsp;<?php echo ($user['user_name']);?><b class="caret"></b></a>
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
				  <li class="active">My Events</li>
				</ol>
			</div>
			<div class="col-xs-12 table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<tr>
						<th><i class=" glyphicon glyphicon-pushpin"></i> Event Title</th>
						<th><i class="glyphicon glyphicon-calendar"></i> Start Date</th>
						<th><i class="glyphicon glyphicon-calendar"></i> End Date</th>
						<th><i class="glyphicon glyphicon-bullhorn"></i> Invite</th>
						<th><i class="glyphicon glyphicon-ok"></i> Accepted</th>
						<th><i class="glyphicon glyphicon-eye-open"></i> Preview</th>
					</tr>
				
					<?php
	
	if($all_event){
		
		foreach($all_event as $_row_event){
		
		
		if ($_row_event['start_date']=="")
		{
		$start_date="-";
		}else{
			$start_date		=	date("M d, Y",strtotime($_row_event['start_date']));}
			
			if ($_row_event['end_date']=="")
		{
		$end_date="-";
		}else{
			
			$end_date		=	date("M d, Y",strtotime($_row_event['end_date']));}
			//$edit_url		=	base_url()."index.php/event/add_event/{$_row_event['id']}";
			//$edit			=	"<a href='{$edit_url}' title='Edit Event'>Edit</a>";
			$invite_url		=	base_url()."index.php/user/invitePeople/{$_row_event['id']}";
			$invite			=	"<a href='{$invite_url}' title='Invite'>Invite</a>";
			
			$accept_url		=	base_url()."index.php/user/accept/{$_row_event['id']}";
			
			$preview_url1	=   base_url()."index.php/user/image_preview/{$_row_event['id']}";
			$accept			=	"<a href='{$accept_url}' title='Accept'>Accept</a>";
			//$preview		=	"<a class='image_preview' href='{$preview_url}' target='_blank' title='Preview'>Preview</a>";
			$preview		=	"<a href='{$preview_url1}' target='_blank' title='Preview'>Preview</a>";
			$back_url		=	base_url()."index.php/cart/home/";
			$title			=	ucwords($_row_event['title']);
			//echo $preview_url;die();
			echo "<tr>";
			echo "<td>{$title}</td>";
			echo "<td>{$start_date}</td>";
			echo "<td>{$end_date}</td>";
			echo "<td>{$edit} {$invite}</td>";
			echo "<td>{$edit} {$accept}</td>";
			echo "<td>{$preview}</td>";
			echo "</tr>";
			?>

			<?php 
		
		}
	}else{
		echo "<tr><td colspan='6'>No Event </td></tr>";
	}
	?>
					
				
				</table>
			</div>
			<div class="col-xs-12">
				<center>
					<tr><td colspan='6'><?php echo $this->pagination->create_links();  ?></td></tr>

				</center>
			</div>
        </div>
    </div>
</div>
