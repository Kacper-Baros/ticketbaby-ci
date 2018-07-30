<?php include 'includes/header.php'; ?>
<link href="<?php echo theme_css('jquery.lineProgressbar.css') ?>" rel="stylesheet">
<div class="container-fluid content-bg">
    <div class="container content">
        <div class="row no-mar main-content leftPad">
            <div class="col-md-6 col-xs-12">
                <h2 class="text-orange">Dashboard - Edit Profile</h2>
            </div>

            <div class="col-md-6 col-xs-12 text-right"><br>
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
                    <div class="collapse navbar-collapse menu-collapse" id="subNav">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo base_url('profile/edit_profile') ?>"><i class="glyphicon glyphicon-list-alt"></i> Account Details</a></li>
                            <li><a href="<?php echo base_url('placed_orders'); ?>"><i class="glyphicon glyphicon-tasks"></i> My Orders</a></li>
                            <li><a href="<?php echo base_url('client_orders'); ?>"><i class="glyphicon glyphicon-calendar"></i> My Events</a></li>
							<li><a href="<?php echo base_url('my_guests'); ?>"><i class="glyphicon glyphicon-calendar"></i> My Guest list</a></li>
							<li><a href="<?php echo base_url('my_sales_report'); ?>"><i class="glyphicon glyphicon-calendar"></i> My Sales Report</a></li>
                        </ul>                                                                   
                        <ul class="nav navbar-nav navbar-right navbar-right-profile">
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown" class="dropdown-toggle"><i class="glyphicon glyphicon-cog"></i>&nbsp;<?php echo $details->username; ?><b class="caret"></b></a>
                                <ul class="dropdown-menu"> 
                                    <li><a href="<?php echo base_url('profile/logout') ?>"><i class="glyphicon glyphicon-log-in"></i> Logout</a></li>
                                    <li><a href="<?php echo base_url('profile/edit_profile') ?>"><i class="glyphicon glyphicon-pencil"></i> Edit Profile</a></li>
                                </ul>
                            </li> 
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-xs-12"><hr></div>
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url('profile'); ?>">Dashboard</a></li>
                    <li class="active">Account Details</li>
                </ol>
				<i>Profile Completion</i>
				<div id="jq"></div>
				<br>
            </div>
			<!-- Process bar percentage -->
			<?php
				$id = $this->session->userdata('user_id');
				$query = $this->db->query("SELECT fullname, email, phone_no, address, area, city, postcode, country, user_picture FROM tbl_users WHERE id=$id");
				$row = $query->row();
				$cnt=10;
				if(isset($row)){
						if($row->fullname!=''){
							$cnt+=10;
						} 
						if($row->email!=''){
							$cnt+=10;
						}
						if($row->phone_no!=''){
							$cnt+=10;
						}
						if($row->address!=''){
							$cnt+=10;
						}
						if($row->area!=''){
							$cnt+=10;
						}
						if($row->city!=''){
							$cnt+=10;
						}
						if($row->postcode!=''){
							$cnt+=10;
						}
						if($row->country!=''){
							$cnt+=10;
						}
						if($row->user_picture!=''){
							$cnt+=10;
						}
				}
			?>
			<input type="hidden" id="process_per" value="<?php echo $cnt; ?>">
            <div class="col-lg-12">
				<form method="post" action="<?php echo base_url('profile/update_profile') ?>" enctype="multipart/form-data">
				<div class="col-md-12">
						<div class="form-group">
							<label class="col-md-2">Profile Photo</label>
							<div class="col-md-4">
								<?php if ($details->user_picture!='') { ?>
									<img class="featured_img" alt="No Image Found" src="<?php echo base_url('uploads/images/full/' . $details->user_picture) ?>" style="max-width: 140px; border-radius: 50%;">  
								<?php }else{ ?>
									<img class="featured_img" alt="No Image Found" src="<?php echo base_url('assets/images/') ?>/user-icon.png" style="max-width: 140px; border-radius: 50%;">
								<?php } ?>
								<input type="file" class="styled form-control" id="report-screenshot" name="user_picture">
							</div>
						</div>
				</div>
				<div class="col-md-12">
				<br>
						<div class="form-group">
							<label class="col-md-2">Username</label>
							<div class="col-md-4">
								<input type="text" class="form-control" value="<?php
								if ($details->username != '') {
									echo $details->username;
								}
								?>" placeholder="anaszaman" name="username" readonly>
							</div>
							<label class="col-md-2">City</label>
							<div class="col-md-4">
								<input type="text" class="form-control" placeholder="" name="city" value="<?php
								if ($details->city != '') {
									echo $details->city;
								}
								?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2">Full Name</label>
							<div class="col-md-4">
								<input type="text" name="fullname" class="form-control" placeholder="Anas Zaman" value="<?php
								if ($details->fullname != '') {
									echo $details->fullname;
								}
								?>">
							</div>
							<label class="col-md-2">Post Code</label>
							<div class="col-md-4">
								<input type="text" class="form-control" placeholder="" name="postcode" value="<?php
								if ($details->postcode != '') {
									echo $details->postcode;
								}
								?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2">Mobile Number</label>
							<div class="col-md-4">
								<input type="text" class="form-control" placeholder="9999999999" value="<?php
								if ($details->phone_no != '') {
									echo $details->phone_no;
								}
								?>" name="phone_no">
							</div>
							<label class="col-md-2">Email</label>
							<div class="col-md-4">
								<input type="email" class="form-control" placeholder="emailid@example.com" value="<?php
								if ($details->email != '') {
									echo $details->email;
								}
								?>" name="email">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2">Address</label>
							<div class="col-md-4">
								<input type="text" class="form-control" placeholder="" name="address" value="<?php
								if ($details->address != '') {
									echo $details->address;
								}
								?>">
							</div>
							<label class="col-md-2">Area</label>
							<div class="col-md-4">
								<input type="text" class="form-control" placeholder="" name="area" value="<?php
								if ($details->area != '') {
									echo $details->area;
								}
								?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="col-md-2">Country</label>
							<div class="col-md-4">
								<input type="text" class="form-control" placeholder="" name="country" value="<?php
								if ($details->country != '') {
									echo $details->country;
								}
								?>">
							</div>
							<label class="col-md-2"></label>
							<center>
								<div class="col-md-2">
									<input type="Submit" name="update" class="btn btn-warning btn-block" value="Update">
								</div>
							</center>
						</div>
					</div>
				</form>
            </div>
            <div class="col-xs-12">
                <center>
                    <div class="col-xs-9"></div>
                </center>
            </div>
        </div>
    </div>
</div>		
<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
	var perct = $("#process_per").val();
	$('#jq').LineProgressbar({
	  percentage: perct,
	  fillBackgroundColor: '#3498db',
	  backgroundColor: '#EEEEEE',
	  radius: '0px',
	  height: '10px',
	  width: '100%',
	  ShowProgressCount: true
	});
});
</script>