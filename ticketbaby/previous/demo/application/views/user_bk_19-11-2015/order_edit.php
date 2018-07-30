<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
				
                <h1 class="page-header"><?=$title;?></h1>
				
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
        </div>
        <!-- /.row -->


        <div class="row">

            <div class="col-lg-12">
            <div class="panel">
            <div class="panel-body">
            <form role="form" method="post" class="form-admin-order-creation"  action="<?=base_url()?>index.php/admin/order/edit?order_id=<?php echo isset($order_id) ? $order_id : "";?>&page_start=<?php echo isset($page_start) ? $page_start : "";?>">
                   <?php
					 $a=count($order_edit);
					 $a=$a-1;

					for($j=0; $j < $a ; $j++)
					{
			?>
                    <div class="col-lg-12">
                    <h4>Details</h4>
                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Pay ID</label>
                            <p><?php echo $order_edit[$j]["pay_id"];?></p>
                            <p class="help-block help-block-tip"></p>
                            </div>
                        </div>  

						<div class="col-lg-3">
                            <div class="form-group">
                            <label>Order ID</label>
                            <p><?php echo $order_edit[$j]["id"];?></p>
                            <p class="help-block help-block-tip"></p>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Event</label>
						<p><?php echo $order_edit[$j]["event_title"];?></p>
                            <p class="help-block help-block-tip"></p>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Date</label>
                            <p><?php echo $order_edit[$j]["date"];?></p>
                            <p class="help-block help-block-tip"></p>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Total Amount</label>
                            <p>&pound; <?php echo $order_edit[$j]["total_amount"];?></p>
                            <p class="help-block help-block-tip"></p>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Promo/Coupon code</label>
                            <p><?php if ($order_edit[$j]["customer_promo_code"]){echo $order_edit[$j]["customer_promo_code"];}else{echo '-';}?></p>
                            <p class="help-block help-block-tip"></p>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Donation</label>
                            <p><?php echo $order_edit[$j]["customer_add_donation"];?></p>
                            <p class="help-block help-block-tip"></p>
                            </div>
                        </div>

                    </div>


                    <div class="col-lg-12">
                    <h4>Billing Details</h4>
                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>First Name</label>
                            <p><?php echo $order_edit[$j]["first_name"];?></p>                          
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Last Name</label>
                            <p><?php echo $order_edit[$j]["last_name"];?></p>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Email</label>
                            <p><?php echo $order_edit[$j]["email"];?></p>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Contact Number</label>
                            <p><?php echo $order_edit[$j]["contact_number"];?></p>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Address</label>
                            <p><?php echo $order_edit[$j]["address"];?></p>
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Area</label>
                            <p><?php echo $order_edit[$j]["area"];?></p>
                            </div> 
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>City</label>
                            <p><?php echo $order_edit[$j]["city"];?></p>
                            </div> 
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Post code</label>
                            <p><?php echo $order_edit[$j]["post_code"];?></p>
                            </div> 
                        </div>
                       
                    </div>

                    <div class="col-lg-12">
                    <h4>Customer Details</h4>
                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Customer First name</label>
                            <p><?php echo $order_edit[$j]["customer_first_name"];?></p>
                            </div> 
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Customer Last name</label>
                            <p><?php echo $order_edit[$j]["customer_last_name"];?></p>
                            </div> 
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Customer email</label>
                            <p><?php echo $order_edit[$j]["customer_email"];?></p>
                            </div> 
                        </div>
                    </div>


					
                    <div class="col-lg-12">
                    <h4>Table/Seat Details</h4>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-2">
                            <div class="form-group">
                            <label>#</label>
                            </div> 
                        </div>                   
                        <div class="col-lg-2">
                            <div class="form-group">
                            <label>Type</label>
                            </div> 
                        </div>               
                        <div class="col-lg-2">
                            <div class="form-group">
                            <label>Class</label>
                            </div> 
                        </div>               
                        <div class="col-lg-2">
                            <div class="form-group">
                            <label>Table Number</label>
                            </div> 
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                            <label>Seat Numbers</label>
                            </div> 
                        </div>
                    </div>
                    <?php
					//print_r($order_edit);die;
                     if( isset($order_edit) && isset($order_edit['seat_details']) ) { foreach ($order_edit['seat_details'] as $k=>$seat_detail) {
                    ?>
                    <div class="col-lg-12">
                        <div class="col-lg-2">
                            <div class="form-group">
                            <p><?php echo $k+1; ?></p>
                            </div> 
                        </div>                   
                        <div class="col-lg-2">
                            <div class="form-group">
                            <p><?php echo $seat_detail['ticket_section_title']; ?></p>
                            </div> 
                        </div>               
                        <div class="col-lg-2">
                            <div class="form-group">
                             <p><?php echo $seat_detail['ticket_class_title']; ?></p>
                            </div> 
                        </div>               
                        <div class="col-lg-2">
                            <div class="form-group">
                            <p><?php echo $seat_detail['table_number']; ?></p>
                            </div> 
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">        
                            <p>
                            <?php 
                                 if ( $seat_detail['ticket_section'] == "ticket" ) {
                                    $seat_number_arr = explode( "," , $seat_detail['seat_numbers']);
                                    //echo sort($seat_number_arr,SORT_NUMERIC);
                                    echo implode(", " , $seat_number_arr) . " [Qty -<strong>" . sizeof($seat_number_arr) . "</strong>]"; 
                                 }
								 else{
                                    echo "NA";
                                 }
                                 
                            ?>
                            </p>
                            </div> 
                        </div>
                    </div>
                    <?php
                    }}
                    ?>

                  
					<?php }?>
                      

                  
                    <div class="col-lg-12">
                        <div style="float:right;">
                        <a href="<?=base_url()?>index.php/user/order_detail/<?php echo isset($page_start) ? $page_start : "";?>"><button type="button" class="btn">Back Button</button></a>
                        <input  type="hidden" name="order_id" value="<?php echo isset($order_id) ? $order_id : "";?>" />
                        </div>    
                    </div>
                    
            </form>
            </div>
            </div>
            </div>
            <!-- /.col-lg-5 -->



        </div>
        <!-- /.row -->    

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->