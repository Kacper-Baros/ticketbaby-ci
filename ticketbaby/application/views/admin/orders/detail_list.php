<!-- Media datatable --> 
<?php $event_name = $this->db->get_where('tbl_events',array('id'=>$detail->event_id))->row();
?>

<a href="<?php echo admin_url('orders'); ?>"><i class="fa fa-arrow-left leftarrow" aria-hidden="true">Back</i></a>
<div class="panel panel-default"> 
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-users"></i>Order Detail</h6>
    </div> 
    
    
     <div class="row customerrow">
        <div class="col-md-12">
            <h4 style="text-decoration: underline;">Detail</h4>
            <div class="row">
                <div class="col-md-4">
                    <p>Event: <?php echo $event_name->name; ?></p>
                </div>
                <div class="col-md-4">
                    <p>Date: <?= date('m/d/Y H:i:s', $detail->created); ?></p>
                </div>
                <div class="col-md-4">
                    <p>Total Amount: <?php echo $detail->subtotal; ?></p>
                </div>
            </div>
        </div>

    </div>
    
    
    <div class="row customerrow">
        <div class="col-md-12">
            <h4 style="text-decoration: underline;">Customer Detail</h4>
            <div class="row">
                <div class="col-md-4">
                    <p>Name: <?php echo $detail->customer_first_name . ' ' . $detail->customer_last_name; ?></p>
                </div>
                <div class="col-md-4">
                    <p>Email: <?php echo $detail->customer_email; ?></p>
                </div>
                <div class="col-md-4">
                    <p>Phone No: <?php echo $detail->customer_phone; ?></p>
                </div>
            </div>
        </div>

    </div>

    <div class="row cardholderrow">

        <div class="col-md-12">
            <h4 style="text-decoration: underline;">Card Holder Detail</h4>
        </div>
        <div class="col-md-4">
            <p>Name: <?php echo $detail->cardholder_first_name . ' ' . $detail->cardholder_last_name; ?></p>
        </div>
        <div class="col-md-4">
            <p>Email: <?php echo $detail->cardholder_email; ?></p>
        </div>
        <div class="col-md-4">
            <p>Address: <?php echo $detail->cardholder_address; ?></p>
        </div>
        <div class="col-md-4">
            <p>Post Code: <?php echo $detail->cardholder_post_code; ?></p>
        </div>
        <div class="col-md-4">
             <p>Area: <?php echo $detail->cardholder_area; ?></p>
        </div>
        <div class="col-md-4">
             <p>City: <?php echo $detail->cardholder_city; ?></p>
        </div>
        <div class="col-md-4">
             <p>Phone No: <?php echo $detail->cardholder_contact_number; ?></p>
        </div>
        <div class="col-md-4">
             <p>Mobile No: <?php echo $detail->cardholder_mobile_number; ?></p>
        </div>
    </div>
	<div class="row cardholderrow">
        <div class="col-md-12">
            <h4 style="text-decoration: underline;">Promo Code Details:</h4>
        </div>
		<?php
			$CouponCode = '';
			$CouponType = '';
			$CouponValue = '';
			if($detail->coupon_id!=0){
				$coupanD = $this->db->get_where('tbl_coupen', array('id' => $detail->coupon_id))->row();
				
				$CouponCode = $coupanD->coupen_code;
				
				if($coupanD->coupen_type==1){
				$CouponType = 'Percentage';
				}
				if($coupanD->coupen_type==2){
					$CouponType = 'Flat';
				}
				if($coupanD->coupen_type==3){
					$CouponType = 'Free';
				}
				
				$CouponValue = $coupanD->coupen_value;
				
			}
			
		?>
        <div class="col-md-4">
            <p>Coupon Code: <?php echo $CouponCode; ?></p>
        </div>
        <div class="col-md-4">
            <p>Coupon Type: <?php echo $CouponType; ?></p>
        </div>
        <div class="col-md-4">
            <p>Coupon Value: <?php echo $CouponValue; ?></p>
        </div>
    </div>
     <div class="row cardholderrow">
    
      <h4 style="text-decoration: underline;">Table/ Seat detail</h4>
    
   
        <table class="table table-bordered table-striped"> 
            <thead> 
                <tr> 
                    <th>Type</th>  
                    <th>Class</th>
                    <th>Table No</th>
                    <th>Quantity</th>
                
                </tr> 
            </thead> 
            <tbody> 
               		<?php if($detail->table) { ?>
                    <tr>  
                        <td>Table</td> 
                        <td><?php $table=(explode('&',$detail->table)); echo rtrim($table[1],',');  ?></td>
                        <td><?php echo rtrim($table[0],','); ?></td>
                        <td><?php echo rtrim(count(explode(',',$table[0]))-1,','); ?></td>
                    </tr> 
                    <?php } ?>
                    
                    <?php if($detail->ticket_table) { ?>
                    <tr>  
                        <td>Ticket Table</td> 
                        <td><?php $ticket=(explode('&',$detail->ticket_table)); echo rtrim($ticket[2],',');  ?></td>
                        <td><?php echo  trim($ticket[0],','); ?></td>
                        <td><?php echo trim($ticket[1],','); ?></td>
                    </tr> 
                    <?php } ?>
                    
                     <?php if($detail->addtional) { ?>
                    <tr>  
                        <td>Additional</td> 
                        <td><?php $addtional=(explode('&',$detail->addtional)); echo rtrim($addtional[0],',');  ?></td>
                        <td><?php echo  trim($addtional[2],','); ?></td>
                        <td><?php echo trim($addtional[3],','); ?></td>
                    </tr> 
                    <?php } ?>
                    
                     <?php if($detail->tickets) { ?>
                    <tr>  
                        <td>Tickets</td> 
                        <td><?php $tickets=(explode('&',$detail->tickets)); echo rtrim($tickets[0],',');  ?></td>
                        <td><?php echo  trim($tickets[2],','); ?></td>
                        <td><?php echo trim($tickets[3],','); ?></td>
                    </tr> 
                    <?php } ?>
            </tbody> 
        </table> 
</div> 

</div>


