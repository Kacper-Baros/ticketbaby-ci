
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo base_url();?>csss/bootstrap.min.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>csss/bootstrap-select.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>csss/style.css"/>
<!-- jQuery library -->
<script type="text/javascript" src="<?php echo base_url();?>jss/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="<?php echo base_url();?>jss/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>jss/jquery.flexisel.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $("#flexiselDemo1").flexisel();
});
</script>
<script src="<?php echo base_url();?>jss/bootstrap-select.js"></script>

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/new/style.css" />

<div class="container-fluid content-bg">
	<div class="container content">
        <div class="row no-mar main-content">
        	<div class="col-md-4 col-sm-4 left-sidebar">
            	<div class="main-thumb">
                	   <img src="<?=base_url()?>assets/upload/event/thumb/<?php echo $event["thumb1"]; ?>" />
                </div>  
            </div>
            <div class="col-md-8 col-sm-8">
            	<div class="movie-video-heading">
                	<h1>Special Request Dancehall Edition</h1>
                    <h2>price - &pound; <?php echo $event["min_unit_price"]; ?> - &pound; <?php echo $event["max_unit_price"]; ?> </h2>
                    <p style="display:inline-block"><img src="<?=base_url()?>assets/images/stars.png"/></p>&nbsp;&nbsp;&nbsp;&nbsp;
                    <p style="display:inline-block"><img src="<?=base_url()?>assets/images/nimg13.png"/></p><br/><br/>
                 </div>
             
                	 <div class="seating-text">
                    <p><?php echo $event["details"]; ?></p>
                 </div>
				
            </div>
			 <div class="col-xs-12">
			
				<div class="event-info col-xs-12 ">
                	<h1 class="dark">Event Information</h1>
					<div class="col-md-0 col-xs-6"><br/>
						<div class="col-xs-4 orang-bk text-center">
							<strong><?php echo strtoupper($event["start_date_month"]); ?><br/><?php echo $event["start_date_date"]; ?></strong><br/><?php echo strtoupper(substr($event["start_date_day"],0,3)); ?>
							
						</div>
						  <div class="event-info">
								
								<div class="p-no">
								<p>Venue : <?php echo $event["venue"]; ?></p>
								<p>Address : <?php echo $event["address"]; ?></p>
								<p>City : <?php echo $event["city"]; ?></p>
								<p>Country : <?php echo $event["country"]; ?></p>
								</div><br/><br/><br/>
							</div>
						
						
						
					<div class="col-md-0 col-xs-12 table-responsive cus-selectx cus-ick">
					<form action='JavaScript:void(0);' id="add_cart_form">
					<table class="table">
						<tbody><tr>
							<th>Ticket Type</th>
							<th>Price</th>
							<th>Available</th>
							<th>Quantity</th>
						</tr>
						<?php 
						
						foreach ($event_seats as $events_item): if($events_item['ticket_section_section'] == "ticket") { 
                            $avaialble_ticket =  ($events_item['group_unit_total']-sizeof($events_item['occupied_seat_numbers'])) / $events_item['unit_min_purchase'];
                        
						
						?>
						 <?php if (intval($avaialble_ticket) > 0){ ?>
						
							<input type="hidden" data-event="<?php echo $events_item['event_id'] ?>" value='<?php echo $events_item['event_id'] ?>' data-ticket-class="<?php echo $events_item['ticket_class_id'] ?>" name="choose-table-number[]" class="seat_ticket_new"/>
							<input type="hidden" name="ticket_section_name[]" value="ticket"> 
							<input type="hidden" name="event_id[]" value="<?php echo $events_item['event_id'] ?>"> 
							<input type="hidden" name="ticket_class_id[]" value="<?php echo $events_item['ticket_class_id'] ?>"> 
							<input type="hidden" name="ticket_section_section_id[]" value="<?php echo $events_item['event_id'] ?>"> 
							<input type="hidden" name="ticket_class_title[]>" value="<?php echo $events_item['ticket_class_title'];  ?>"> 
							<input type="hidden" name="unit_price[]" value="<?php echo $events_item['unit_price'];  ?>"> 
							<input type="hidden" name="unit_min_purchase[]" value="1"> 
							<input type="hidden" name="ticket_class_class[]" value="<?php echo $events_item['ticket_class_title'];  ?>">
							<input type="hidden" name="table_price[]" value="<?php echo $avaialble_ticket*$events_item['unit_price'];  ?>">
							<input type="hidden" name="table_seat_count[]" value="<?php echo $avaialble_ticket;  ?>">
							<input type="hidden" name="event_ticket[]" value="Y">
							<input type="hidden" name="ticket_selection_type[]" value="1">
							
						
						<tr>
                            
							<td><strong><?php echo $events_item['ticket_class_title']; ?></strong></td>
                            <td>&pound; <?php echo $events_item['unit_price'] * $events_item['unit_min_purchase']; ?></td>
                            <td><?php echo $avaialble_ticket;  ?></td>
							<td><input type="text" value="<?php if($events_item['ticket_class_id'] == $array_store_cart[$events_item['ticket_class_id']]['ticket_class_id_s']){ echo $array_store_cart[$events_item['ticket_class_id']]['seat_quantity'];}?>" name='quantity[]' min="1" max="<?php echo $avaialble_ticket;  ?>" class='quantity_class' on='onblur_add_session(this.value,"<?php echo $events_item['event_id'] ?>","<?php echo $events_item['ticket_class_id'] ?>");'></td>
                        </tr>
                        <?php } } endforeach ?>
						
					</tbody>
					</table>
					</form>
					<div class="col-xs-12 text-right">
						<button class="btn btn-danger btn-pink button-add-to-cart-new">BUY TICKETS</button><br>
						<small>Tickets will be reserved for 10 minutes</small>
					</div>
				</div>
						
						
						</div>
					
				<div class="col-md-6 col-xs-12"><br/><br/><br/><br/><br/><br/><br/>
				<div class="col-md-8 col-md-offset-4 col-xs-12 bgG2">
				<div class="col-xs-12 bgGG">
					<div class="col-xs-12 orng">
						<h4>Location</h4>
					</div>
					<div class="col-xs-12"><br/>
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4860.411686685395!2d-1.9138237!3d52.4754086!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870bcf638654fa7%3A0x1684de4c80951199!2sSugar+Suite!5e0!3m2!1sen!2s!4v1440236054041" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
					<div class="col-xs-12">&nbsp;</div>
					<p><strong>200 Broad ST</strong><br/>
					Fice Ways Bimingham B15 1SU<br/>
					United Kingdom
					</p>
				</div>
				<div class="col-xs-12">&nbsp;</div>
				</div>
			</div>
					
                </div> 
	
				 
			</div>	
        </div>
    </div>
</div>
