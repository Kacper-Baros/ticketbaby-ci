
<div class="container-fluid content-bg">
	<div class="container content">
        <div class="row no-mar main-content leftPad">
			<div class="col-md-6 col-xs-12">
				<h2 class="text-orange">Dashboard - Invitations</h2>
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
				   <li><a href="<?php echo base_url();?>index.php/user/my_event">My Events</a></li>
				  <li class="active">Invitations</li>
				</ol>
			</div>
			<div class="col-xs-12 table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<tr>
						<th><i class=" glyphicon glyphicon-envelope"></i> Email</th>
						<th><i class="glyphicon glyphicon-calendar"></i> Invite Date</th>
						<th><i class="glyphicon glyphicon-bell"></i> Accept</th>
					</tr>
						<?php
	if($all_event){
		
		foreach($all_event as $_row_event){
			$start_date	=	date("M d, Y",strtotime($_row_event['created_date']));
			if($_row_event['attend_user']==1)
				$attend_user	=	"Yes";
			else
				$attend_user	=	"No";
				
			echo "<tr>";
			echo "<td>{$_row_event['invite_email']}</td>";
			echo "<td>{$start_date}</td>";
			echo "<td>{$attend_user}</td>";
			echo "</tr>";
		}
	}else{
		echo "<tr><td colspan='4'>People not Invited for this Event </td></tr>";
	}
	?>
				</table>
			</div>
			<div class="col-xs-12">
				<center>
				<tr><td colspan='4'><?php echo $this->pagination->create_links();  ?></td></tr>
			<input  type="hidden" name="order_id" value="<?php echo isset($order_id) ? $order_id : "";?>" />
							
				</center>
			</div>
        </div>
    </div>
</div>