<style>
.billing-details{

}
</style>
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
                    <?php }?>
						<table class="table cm-table">
					<?php 
						if ($event_seats){ ?>
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
									<div class="col-md-0 col-xs-12 table-responsive cm-table-box cus-selectx cus-ick">
					<form action='<?php echo base_url();?>index.php/admin/event/booking/<?php echo  $events_item['event_id'] ;?>' method="post" id="add_cart_form"  name="form">
					
						<!--form action='JavaScript:void(0);' id="add_cart_form"-->
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
							<td><input type="text" name='quantity[]' min="1" max="<?php echo $avaialble_ticket;  ?>" class='quantity_class' on='onblur_add_session(this.value,"<?php echo $events_item['event_id'] ?>","<?php echo $events_item['ticket_class_id'] ?>");'></td>
							
                        </tr>
                        <?php } } endforeach ?>
						
					</tbody>
					</table>
					 <input type="hidden" name="id" value="<?php echo  $events_item['event_id'] ;?>"/>
					
					
					
					   
                           <div class="billing-details"> 
                              <div class="form-group cus-form">
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">First Name<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="text" class="form-control" name="first_name" value="<?php echo isset($billing_details) ? $billing_details['first_name'] : ''?>" required />     
                                          </div><br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Last Name<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="text" class="form-control" name="last_name" value="<?php echo isset($billing_details) ? $billing_details['last_name'] : ''?>"required />
                                          </div><br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Email<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="email" class="form-control" name="email" value="<?php echo isset($billing_details) ? $billing_details['email'] : ''?>"required />
                                          </div><br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Address<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="text" class="form-control" name="address" value="<?php echo isset($billing_details) ? $billing_details['address'] : ''?>" required />
                                          </div><br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Area<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                            <input autocomplete="off" type="text" class="form-control" name="area" value="<?php echo isset($billing_details) ? $billing_details['area'] : ''?>" required />
                                          </div><br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">City<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                            <input autocomplete="off" type="text" class="form-control" name="city" value="<?php echo isset($billing_details) ? $billing_details['city'] : ''?>" required />
                        
                                          </div><br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Postcode<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="text" class="form-control" name="post_code" value="<?php echo isset($billing_details) ? $billing_details['post_code'] : ''?>"required  />
                                          </div><br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Country<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="text" class="form-control" required />
                                          </div>
                                        
                                        
                                    </div>
                                  
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Mobile Phone</label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="text" class="form-control" name="mobile_number" required value="<?php echo isset($billing_details) ? $billing_details['mobile_number'] : ''?>" />
                        
                                          </div>
                                       
                                          <br/><Br/>
                                    </div>
                                    
                              </div>
                      </div>
                  
					
					<div class="col-xs-12 text-right">
					<input type="submit" name="confirm" class="btn btn-primary btn-lg set_Btn button-add-to-cart-new" value="Submit"><br>
						<!--input type="submit" name="confirm" value="Confirm"/>
						<input type="submit" class="button-add-to-cart-new" value="Confirm"/-->
					
					</div>
					
					</form>
					<?php }else{echo "No seats available";}?>
				</div>	
				</div>	
				</div>	
			