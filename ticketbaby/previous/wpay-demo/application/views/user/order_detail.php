<!-- Page Content -->

<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-datepicker.min.css" />
<script type="text/javascript">
		$(function () {
			$('.datepicker').datepicker();
		});
	</script>
			 <div class="heading col-xs-12">
       
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
				  <li class="active">My Orders</li>
				</ol>
			</div>
			<div class="col-xs-12">
			<form action="<?php echo base_url();?>index.php/user/order_detail" method='get'>		
				
				<div class="col-md-4 col-xs-12 cus-form4">
					<div class='input-group date datepicker'>
						<input type='text' class="form-control"  name='to' value="<?php echo $to;?>" placeholder="Date From"/>
						  
						<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
						</span>
						
					</div>
						<!--button type="reset" name="reset" style="margin-left: 270px;margin-top: -34px; z-index: 999999999; position: inherit;" />X</button-->
					
				</div>
				<div class="col-md-4 col-xs-12 cus-form4">
					<div class='input-group date datepicker'>
						<input type='text' class="form-control"  name='from' value="<?php echo $from;?>" placeholder="Date To"/>
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
					<!--button type="reset" name="reset" style="margin-left: 270px;margin-top: -34px; z-index: 999999999; position: inherit;" />X</button-->
					
				</div>
			                         
                            
				<div class="col-md-4 col-xs-12 cus-form4">
					<input type="submit" class="btn btn-warning btn-block" value="Filter" name='filter' style="margin-top:4px; height: 32px; border-radius: 4px 4px 4px 4px;"/>
					    
				</div><br/><br/><br/>
				</form>
			</div>
			<div class="col-xs-12 table-responsive">
			<?php	
								//print_r($details);
								if (count($details) > 1){?>
				<table class="table table-bordered table-hover table-striped" >
					
					<tr>
						<th class="text-center">&nbsp;<i class="glyphicon glyphicon-asterisk"></i></th>
						<th class="text-center"><i class=" glyphicon glyphicon-pushpin"></i> Pay Id</th>
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
                                    <!--td><a target="_blank" href="<?=base_url()?>index.php/user/order_edit?order_id=<?=$details[$i]["id"]?>&page_start=<?=$page_start?>"><?=$details[$i]["pay_id"]?></a></td-->
                                     <td><center><?php if ($orders[$i]["pay_id"]){echo $orders[$i]["pay_id"];}else{ echo "-";}?></center></td>
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
			<div class="col-xs-9"><?php echo  $this->pagination->create_links(); ?></div>
             	</center>
			</div>
        </div>
    </div>
</div>		

    </div>
	
