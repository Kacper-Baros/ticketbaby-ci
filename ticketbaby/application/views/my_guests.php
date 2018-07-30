<?php include 'includes/header.php'; ?>
<style>
	.panel {
		border-radius: 2px;
		margin-bottom: 35px;
		box-shadow: none;
	}
	.panel-default > .panel-heading {
		background-color: #fafafa;
	}
	.filter_by_date {
		position: absolute;
		z-index: 99;
		left: 32%;
		top: 18px;
	}
	.panel-default > .panel-heading {
		color: #333;
		background-color: #f5f5f5;
		border-color: #ddd;
	}
	.panel .dataTables_length {
		padding: 16px 14px;
	}
	.dataTables_length {
		float: right;
		padding: 0 0 20px;
		display: block;
	}
	.panel .dataTables_filter {
		padding: 16px 14px;
	}
	.dataTables_filter {
		padding: 0 0 20px;
		position: relative;
		display: block;
		float: left;
	}
	.panel .dataTables_paginate {
		margin: 14px;
	}
	.dataTables_paginate {
		float: right;
		margin: 17px 0 0;
	}
	.next{
		margin-left:10px;
	}
</style>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <div class="container-fluid content-bg">
        <div class="container content">
            <div class="row no-mar main-content leftPad">
                <div class="col-md-6 col-xs-12">
                    <h2 class="text-orange">Dashboard</h2>
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
                                <li><a href="<?php echo base_url('placed_orders'); ?>"><i class="glyphicon glyphicon-tasks"></i> My Orders </a></li>
                                <li><a href="<?php echo base_url('client_orders'); ?>"><i class="glyphicon glyphicon-calendar"></i> My Events</a></li>
								<li><a href="<?php echo base_url('my_guests'); ?>"><i class="glyphicon glyphicon-calendar"></i> My Guestlist</a></li>
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
                        <li class="active">My Guestlist</li>
                    </ol>
                </div>
                <div class="col-lg-12">
					<div class="panel panel-default order-table"> 						
						<div class="datatable"> 
							<table class="table table-bordered table-striped" id="orderTable"> 
								<thead> 
									<tr> 
										<th>Order ID</th>
					                    <th>Full Name</th>
                                        <th>Event Name</th>
					                    <th>City</th>
                                        <th>Email ID</th>
                                        <th>Mobile Number</th>
									</tr> 
								</thead> 
								<tbody> 
									<?php foreach ($orders as $s) { ?>
										<tr>  
											<td><?php echo $s->id; ?></td>
                                            <td><?php echo $s->customer_first_name.' '.$s->customer_last_name; ?></td>
											<td>
											<?php
												 $q="SELECT `name` FROM `tbl_events` WHERE `id`=".$s->event_id;
												  $res = $this->db->query($q);
												  $row = $res->result_array();
												  echo $row[0]['name'];
											 ?>
											 <?php  $table=""; if($s->table){  $table=(explode('&',$s->table)); } ?>
										    </td>											
											<td><?php echo $s->cardholder_city;?></td>
											<td><?php echo $s->cardholder_email;?></td>
											<td><?php echo $s->cardholder_contact_number;?></td>
										</tr>
									<?php } ?>
								</tbody> 
							</table> 
						</div> 
					</div>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/interface/datatables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	//SORTING ORDERS : NEWEST FIRST
    $('#orderTable').DataTable( {
		destroy: true,
		"order": [[ 0, "desc" ]]
	});
});
</script>