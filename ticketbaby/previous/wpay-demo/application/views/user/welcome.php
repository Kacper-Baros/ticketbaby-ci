<?php $this->load->helper('url');?>
<div class="container-fluid content-bg">
  <div class="container content">
<br/>
			
<form class="form-horizontal" name="form"  method="POST" action="">   
      <?php 
		//echo $length=count($user_detail);
	  if ($user_detail){
for($i=0;$i<=$length;$i++){
	  ?>
   			<div class="col-md-6 col-xs-12">
				<h2 class="text-orange"><?php echo ucfirst($user_detail[$i]['first_name']);?> - Dashboard</h2>
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
						<a href="" data-toggle="dropdown" class="dropdown-toggle"><i class="glyphicon glyphicon-cog"></i>&nbsp;<?php echo ($user_detail[$i]['user_name']);?> <b class="caret"></b></a>
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
				  <li class="active">Account Details</li>
				</ol>
			</div>
			<div class="col-xs-12 table-responsive">
				<table class="table table-bordered table-hover">
					<tr>
						<td>Username</td>
						<td><?php echo ($user_detail[$i]['user_name']);?></td>
					</tr>
					<tr>
						<td>Full Name</td>
						<td><?php echo ucfirst($user_detail[$i]['first_name'])." ".@ucfirst($user_detail[$i]['last_name']);?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $user_detail[$i]['email'];?></td>
					</tr>
					<tr>
						<td>Phone Number</td>
						<td><?php echo ucfirst($user_detail[$i]['phone']);?></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><?php echo 'Changed on '.date("d F Y",strtotime($user_detail[$i]['modified_date']));?></td>
					</tr>
				</table>
			</div>
       


 <?php } }?> 
        </form>
		
    </div> <!-- container ends -->
	
</div> <!-- Main div ends -->
