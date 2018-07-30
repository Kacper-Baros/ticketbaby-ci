<!-- Page Content -->

<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-datepicker.min.css" />
<script type="text/javascript">
		$(function () {
			$('.datepicker').datepicker();
		});
	</script>
<div id="page-wrapper">
    <div class="container-fluid">
	
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Orders</h1>
				
            </div>
			<div class="col-md-8 col-xs-12 btnVus">
  <div class="" role="group" aria-label="...">
	
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/account_detail">Account Details</a></button>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/change_password">Change Password</a></button>
	</div>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/order_detail">Order Details</a></button>
	</div>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/my_event">My Events</a></button>
	</div>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/logout">Logout</a></button>
	</div>
	
  </div>
        </div>
            <!-- /.col-lg-12 -->
				<form action="<?php echo base_url();?>index.php/user/order_detail" method='get'>		
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-3">
                            <div class="form-group">
                            <label>Date To</label>
							<input type='date' name='to' value="<?php echo $to;?>" class="form-control">
                            <p class="help-block help-block-tip"></p>
                            </div>
						</div>
						<div class="col-lg-3">
                            <div class="form-group">
                            <label>Date From</label>
							<input type='date' name='from' value="<?php echo $from;?>" class="form-control">
                            <p class="help-block help-block-tip"></p>
                            </div>
						</div>
						<div class="col-lg-3">                          
                            <button style="margin-top: 9%;" type="submit" class="btn" name='filter' value='filter'>Filter </button>
                        </div>
					</div>
						
				</form>	
			 <div class="heading col-xs-12">
         
            
        <!-- /.row -->

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <b>Order List</b>
                    </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">             
<?php	
								//print_r($details);
								if (count($details) > 1){?>
                            <div class="row">
                            <div class="col-xs-3">&nbsp;</div>
                            <div class="col-xs-9 text-right"><?php echo $pagination_link; ?></div>
                            </div>
                            
                            <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                  
                                    <!--th>Pay ID</th-->
                                    <th>Event</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Total Amount</th>  
									<th>View Order Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$a= count($orders);
								//$a=$a-1;
								for($i=0;$i<$a;$i++){
								?>
                                <tr class="odd gradeX even gradeC">
                                    <td><?=$page_start + ($i+1);?></td>
                                    <!--td><a target="_blank" href="<?=base_url()?>index.php/user/order_edit?order_id=<?=$details[$i]["id"]?>&page_start=<?=$page_start?>"><?=$details[$i]["pay_id"]?></a></td>
                                     <td><a href="<?=base_url()?>index.php/event/edit?id=<?=$orders[$i]["event_id"]?>"><?=$orders[$i]["event_title"]?></a></td-->
                                     <td><a href="<?php echo base_url();?>index.php/event/<?php echo $orders[$i]['event_slug'];?>"><?=$orders[$i]["event_title"]?></a></td>
                                    
                                    <td><?php echo date('d-M-Y',strtotime($orders[$i]['date']));?></td>
									
                                    <td><?=ucfirst($orders[$i]["first_name"])?>&nbsp;<?=$orders[$i]["last_name"]?></td>
                                    <td><?=$orders[$i]["email"]?></td>
                                    <td>&pound; <?=$orders[$i]["total_amount"]?></td>
									 <td><a  href="<?=base_url()?>index.php/user/order_edit?order_id=<?=$orders[$i]["id"]?>">view</a></td>
                                   
 
                                </tr>
                                <?php } }
								else
								{
								echo "NO order placed";
								}
								?>
                            </tbody>
                            </table>
							<div class="col-lg-12">
								<div style="float:right;">
								<a href="<?=base_url()?>index.php/cart/home/<?php echo isset($page_start) ? $page_start : "";?>"><button type="button" class="btn">Back</button></a>
								<input  type="hidden" name="order_id" value="<?php echo isset($order_id) ? $order_id : "";?>" />
								</div>    
							</div>
                            </div>
                            <div class="row">
                            <div class="col-xs-3">&nbsp;</div>
							
                            <div class="col-xs-9 text-right"><?php echo  $this->pagination->create_links(); ?></div>
                            </div>
							
							
								<!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                </div>
            <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->


        </div>
        <!-- /.row -->   
<div class="container-fluid content-bg">
	<div class="container content">
        <div class="row no-mar main-content leftPad">
			<div class="col-md-6 col-xs-12">
				<h2 class="text-orange">Dashboard - My Orders</h2>
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
						<a href="" data-toggle="dropdown" class="dropdown-toggle"><i class="glyphicon glyphicon-cog"></i> <?php echo ucfirst($user['user_name']);?><b class="caret"></b></a>
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
				  <li class="active">My Orders</li>
				</ol>
			</div>
			<div class="col-xs-12">
			<form action="<?php echo base_url();?>index.php/user/order_detail" method='get'>		
				
				<div class="col-md-4 col-xs-12 cus-form4">
					<div class='input-group date datepicker'>
						<input type='text' class="form-control"  name='to' value="<?php echo $to;?>" placeholder="Date To"/>
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
				<div class="col-md-4 col-xs-12 cus-form4">
					<div class='input-group date datepicker'>
						<input type='text' class="form-control"  name='from' value="<?php echo $from;?>" placeholder="Date From"/>
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
			                         
                            
				<div class="col-md-4 col-xs-12 cus-form4">
					<input type="submit" class="btn btn-warning btn-block" value="Filter" name='filter' style="margin-top:4px;"/>
					    
				</div><br/><br/><br/>
				</form>
			</div>
			<div class="col-xs-12 table-responsive">
			<?php	
								//print_r($details);
								if (count($details) > 1){?>
				<table class="table table-bordered table-hover table-striped">
					<tr>
						<th class="text-center">&nbsp;<i class="glyphicon glyphicon-asterisk"></i></th>
						<th class="text-center"><i class=" glyphicon glyphicon-pushpin"></i> Event</th>
						<th class="text-center"><i class="glyphicon glyphicon-calendar"></i> Date</th>
						<th class="text-center"><i class="glyphicon glyphicon-user"></i> Name</th>
						<th class="text-center"><i class="glyphicon glyphicon-envelope"></i> Email</th>
						<th class="text-center"><i class="glyphicon glyphicon-euro"></i> Total Ammount</th>
						<th class="text-center"><i class="glyphicon glyphicon-eye-open"></i> View ORder Details</th>
					</tr>
					
							
                                <?php 
								$a= count($orders);
								//$a=$a-1;
								for($i=0;$i<$a;$i++){
								?>
                                <tr class="odd gradeX even gradeC">
                                    <td><?=$page_start + ($i+1);?></td>
                                    <!--td><a target="_blank" href="<?=base_url()?>index.php/user/order_edit?order_id=<?=$details[$i]["id"]?>&page_start=<?=$page_start?>"><?=$details[$i]["pay_id"]?></a></td>
                                     <td><a href="<?=base_url()?>index.php/event/edit?id=<?=$orders[$i]["event_id"]?>"><?=$orders[$i]["event_title"]?></a></td-->
                                     <td><a href="<?php echo base_url();?>index.php/event/<?php echo $orders[$i]['event_slug'];?>"><?=$orders[$i]["event_title"]?></a></td>
                                    
                                    <td><?php echo date('d-M-Y',strtotime($orders[$i]['date']));?></td>
									
                                    <td><?=ucfirst($orders[$i]["first_name"])?>&nbsp;<?=$orders[$i]["last_name"]?></td>
                                    <td><?=$orders[$i]["email"]?></td>
                                    <td><center>&pound; <?=$orders[$i]["total_amount"]?></center></td>
									 <td><a  href="<?=base_url()?>index.php/user/order_edit?order_id=<?=$orders[$i]["id"]?>">view</a></td>
                                   
 
                                </tr>
                                <?php } }
								else
								{
								echo "NO order placed";
								}
								?>
				
				</table>
			</div>
			<div class="col-xs-12">
				<center>
			<div class="col-xs-9 text-right"><?php echo  $this->pagination->create_links(); ?></div>
             	</center>
			</div>
        </div>
    </div>
</div>		

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
