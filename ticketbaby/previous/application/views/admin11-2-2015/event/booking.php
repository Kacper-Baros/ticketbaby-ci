<div id="page-wrapper">
    <div class="container-fluid">
	
	<?php if($this->session->flashdata('error')) { ?>                    
                        <p style="color:red">
                            <?php echo $this->session->flashdata('error');?>
                        </p>                   
                    <?php } 
					 elseif($this->session->flashdata('success')) { ?>                    
                        <p style="color:green">
                            <?php echo $this->session->flashdata('success');?>
                        </p>                   
                    <?php }?> <?php 
						
						foreach ($event_seats as $events_item): if($events_item['ticket_section_section'] == "ticket") { 
                            $avaialble_ticket =  ($events_item['group_unit_total']-sizeof($events_item['occupied_seat_numbers'])) / $events_item['unit_min_purchase'];
                        
						
						?>    
									<div class="col-md-0 col-xs-12 table-responsive cm-table-box cus-selectx cus-ick">
					<form action='<?php echo base_url();?>index.php/admin/event/booking/<?php echo  $events_item['event_id'] ;?>' method="post" name="form">
					<table class="table cm-table">
					
						<tbody><tr>
							<th>Ticket Type</th>
							<th>Price</th>
							<th>Available</th>
							<th>Quantity</th>
							<th>Promo code</th>
						</tr>
						
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
                            <td><strong>&pound; <?php echo $events_item['unit_price'] * $events_item['unit_min_purchase']; ?></strong></td>
                            <td><?php echo $avaialble_ticket;  ?></td>
							<td><input type="text" value="<?php if($events_item['ticket_class_id'] == $array_store_cart[$events_item['ticket_class_id']]['ticket_class_id_s']){ echo $array_store_cart[$events_item['ticket_class_id']]['seat_quantity'];}?>" name='quantity[]' min="1" max="<?php echo $avaialble_ticket;  ?>" class='quantity_class' on='onblur_add_session(this.value,"<?php echo $events_item['event_id'] ?>","<?php echo $events_item['ticket_class_id'] ?>");'></td>
                        </tr>
                        <?php } } endforeach ?>
						
					</tbody>
					</table>
					 <input type="text" name="id" value="<?php echo  $events_item['event_id'] ;?>"/>

					<div class="col-xs-12 text-right">
						<input type="submit" name="confirm" value="Confirm"/>
					
					</div></form>
				</div>	
				</div>	
				</div>	
				