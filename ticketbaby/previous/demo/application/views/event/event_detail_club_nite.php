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
                    <h1><?php echo $event["title"]; ?></h1>
                    <?php 
            if($event["min_unit_price"] == $event["max_unit_price"]){
            ?>
            
        <h2>price - &pound; <?php echo $event["min_unit_price"]; ?></h2>
            
            <?php
            }else{
                ?>
                
        <h2>price - &pound; <?php echo $event["min_unit_price"]; ?> -  &pound; <?php echo $event["max_unit_price"]; ?> </h2>
                
                <?php
            }
        ?>
                    <!--
                    <p style="display:inline-block"><img src="images/stars.png"/></p>&nbsp;&nbsp;&nbsp;&nbsp;
                    <p style="display:inline-block"><img src="images/img0f.png"/></p><br/>
                    -->
                    <br/>
                </div>
                <div class="seating-text">
                    <p><?php echo $event["details"]; ?></p>
                 </div>
            </div>
      
		 <div class="col-xs-12">
			
				<div class="event-info col-xs-12 ">
                	<h1 class="dark">Event Information</h1>
						<div class="col-md-0 col-lg-6 col-sm-6 col-xs-12"><br/>
						<div class="col-xs-4 orang-bk text-center">
							<strong><?php echo strtoupper($event["start_date_month"]); ?><br/><?php echo $event["start_date_date"]; ?></strong><br/><?php echo strtoupper(substr($event["start_date_day"],0,3)); ?>
							
						</div>
						  <div class="event-info">
								
								<div class="p-no">
								<p>Venue : <?php echo $event["venue"]; ?></p>
								<p>Address : <?php echo $event["address"]; ?></p>
								<p>City : <?php echo $event["city"]; ?></p>
								<p>Country : <?php echo $event["country"]; ?></p>
								</div><br/><br/><br/><br/>
								
									<div class="col-md-0 col-xs-12 table-responsive cm-table-box cus-selectx cus-ick" style="border:0;overflow-y:hidden">
					<form action='JavaScript:void(0);' id="add_cart_form" class='add_cart_form'>
				<table class="table cm-table table-responsive">
				<tbody style="border:1px solid #CCCCCC"><tr>
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
                            
							<td><strong id="eventTitle"><?php echo $events_item['ticket_class_title']; ?></strong></td>
                            <td><strong>&pound; <b id="orgCost"><?php echo $events_item['unit_price'] * $events_item['unit_min_purchase']; ?></b></strong></td>
                            <td><?php echo $avaialble_ticket;  ?></td>
							<td>
							<select id="sendQty" class='quantity_class' name='quantity[]'on='onblur_add_session(this.value,"<?php echo $events_item['event_id'] ?>","<?php echo $events_item['ticket_class_id'] ?>");'>
							<?php for($i=0;$i<=10;$i++){?>
							<option value="<?php echo $i;?>"><?php echo $i; ?></option>
							<?php }?>
							</select>
							<!--input type="text" value="<?php if($events_item['ticket_class_id'] == $array_store_cart[$events_item['ticket_class_id']]['ticket_class_id_s']){ echo $array_store_cart[$events_item['ticket_class_id']]['seat_quantity'];}?>" name='quantity[]' min="1" max="<?php echo $avaialble_ticket;  ?>" class='quantity_class' on='onblur_add_session(this.value,"<?php echo $events_item['event_id'] ?>","<?php echo $events_item['ticket_class_id'] ?>");'-->
							
							</td>
                        </tr>
                        <?php } } endforeach ?>
					</tbody>
					</table>
					<br/>
					<div class="table-only outer-additional" style="border:1px solid #CCCCCC">
                    <h1>Additionals</h1>
                    <ul>         
                        <li class="row" style="padding:10px;">
							<strong>None</strong>
						</li>
                    </ul>
					</div>
					<br/>
					<div class="table-only outer-additional" style="border:1px solid #CCCCCC">
                    <h1>Promo Code</h1>
                    <ul>         
                        <li class="row text-center">
                        <input type="text" name="customer_promo_code" id="customer_promo_code_id" class="event-promo-code" value="<?php echo ($cart_captcha_session && $cart_captcha_session["event_customer_details"]) ? $cart_captcha_session["event_customer_details"]["customer_promo_code"] : ""; ?>" placeholder="Promo Code" autocomplete="off" />
						</li>
                    </ul>
					</div>
					<br/>
					<div class="table-only qty" style="border:1px solid #CCCCCC">
						<h1>
							<ul>
								<li class="col-md-3 col-xs-3">QTY</li>
								<li class="col-md-3 col-xs-3">Ticket Type</li>
								<li class="col-md-3 col-xs-3">Unit Price</li>
								<li class="col-md-3 col-xs-3">Total</li>
								<div class="clearfix"></div>
							</ul>
						</h1>
						<ul>
								<li class="col-md-3 col-xs-3"><p style="background:#fff;border:0;color:#000" id="getQty"></p></li>
								<li class="col-md-3 col-xs-3"><p style="background:#fff;border:0;color:#000"><strong id="getName"></strong></p></li>
								<li class="col-md-3 col-xs-3"><p style="background:#fff;border:0;color:#000"><strong><b id="cost"></b></strong></p></li>
								<li class="col-md-3 col-xs-3"><p style="background:#fff;border:0;color:#000" id="totalPrice"></p></li>
								<div class="clearfix"></div>
						</ul>
						<script>
							$(document).ready(function(){
								$('#getQty').text("");
								$('#totalPrice').text("");
								$('#cost').text("");
								$('#getName').text("");
								$('#sendQty').on('change',function(){
									var sendQty = $(this).find(":selected").val();
									$('#getQty').text(sendQty);
									$('#totalPrice').text('£'+sendQty*$('#orgCost').text());
									$('#cost').text('£'+$('#orgCost').text());
									$('#getName').text($('#eventTitle').text());
									if($('#getQty').text()==0 || $('#totalPrice').text()==0){
										$('#getQty').text("");
										$('#totalPrice').text("");
										$('#cost').text("");
										$('#getName').text("");
									}
								}); 
							});
						</script>
					</div>
					<br/>
					<div class="note">
						<div class="row no-mar">
							<div class="col-md-2 col-sm-4 col-xs-3 ii" style="margin-top:15px">
								<p style="padding-top:0;">i</p>
							</div>
							<div class="col-md-10 col-sm-8 col-xs-9 ii-text">
								<p style="background:#fff;border:0;color:#000">Your order may be subject to a fulfilment fee or postage fee it will be added to your shopping basket</p>
							</div>
						</div>
					</div>
					
					<style>
					    .set_Btn{
							background: -moz-linear-gradient(89deg, #DE5B00 0%, #FA6805 100%); /* ff3.6+ */
							background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FA6805), color-stop(100%, #DE5B00)); /* safari4+,chrome */
							background: -webkit-linear-gradient(89deg, #DE5B00 0%, #FA6805 100%); /* safari5.1+,chrome10+ */
							background: -o-linear-gradient(89deg, #DE5B00 0%, #FA6805 100%); /* opera 11.10+ */
							background: -ms-linear-gradient(89deg, #DE5B00 0%, #FA6805 100%); /* ie10+ */
							background: linear-gradient(1deg, #DE5B00 0%, #FA6805 100%); /* w3c */
							filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FA6805', endColorstr='#DE5B00',GradientType=0 ); /* ie6-9 */
							color:#fff;border:0;border-radius:3px;font-family:HelveticaLTStd-Bold;text-transform:uppercase;
												border: 1px solid transparent;
							border-radius: 4px;
							font-family: "AlternateGothicNo2BT-Regular";
							font-size: 20px;
							padding: 6px 16px;
						}
						.set_Btn:hover{color:#fff;}
						.set_Btn:focus{
							background: -moz-linear-gradient(89deg, #DE5B00 0%, #FA6805 100%); /* ff3.6+ */
							background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FA6805), color-stop(100%, #DE5B00)); /* safari4+,chrome */
							background: -webkit-linear-gradient(89deg, #DE5B00 0%, #FA6805 100%); /* safari5.1+,chrome10+ */
							background: -o-linear-gradient(89deg, #DE5B00 0%, #FA6805 100%); /* opera 11.10+ */
							background: -ms-linear-gradient(89deg, #DE5B00 0%, #FA6805 100%); /* ie10+ */
							background: linear-gradient(1deg, #DE5B00 0%, #FA6805 100%); /* w3c */
							filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#FA6805', endColorstr='#DE5B00',GradientType=0 ); /* ie6-9 */
							color:#fff;border:0;border-radius:3px;font-family:HelveticaLTStd-Bold;text-transform:uppercase;
												border: 1px solid transparent;
							border-radius: 4px;
							font-family: "AlternateGothicNo2BT-Regular";
							font-size: 20px;
							padding: 6px 16px;
							
						}
					</style>
					<br/>
					<div class="col-xs-12 text-center">
						<input type="submit" class="btn btn-lg set_Btn button-add-to-cart-new" value="ADD TO BASKET"><br>
					</div>
					</form>
						
				</div>	
								
							</div>
						<br/><br/><br/></div>
					
				<div class="col-md-6 col-xs-12"><br/><br/><br/><br/><br/><br/><br/>
				<div class="col-md-8 col-md-offset-4 col-xs-12 bgG2">
				<div class="col-xs-12 bgGG">
					<div class="col-xs-12 orng">
						<h4>Location</h4>
					</div>
					<div class="col-xs-12" style="height:255px;"><br/>
					<iframe src="<?php echo $event["map_location"];?>" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
					<div class="col-xs-12">&nbsp;</div>
					<p><strong><?php echo $event["city"];?></strong><br/>
					<?php echo $event["address"];?><br/>
					<?php echo $event["venue"];?>
					</p>
				</div>
				<div class="col-xs-12">&nbsp;</div>
				<div class="col-xs-12 bgGG" style="height:230px;">
					<div class="col-xs-12 orng">
						<h4 style="color:#fff;">Organiser Details</h4>
					</div>
					<div class="col-xs-12 hasBorderBottom" style="text-transform:uppercase;color:#5A5A5C;font-weight:600;">
						<h4>The Brothers</h4>
					</div>
					<div class="col-xs-12"><br/>
						<button class="btn btn-default btn-grad" style="font-size:12px;font-weight:600;color:#5A5A5C;" data-toggle="modal" data-target="#contactOrg"><img src="<?=base_url()?>/images/icon1.png"/> Contact the Organiser</button>
					</div>
					<p class="hasBorderBottom" style="line-height:30px;" >
					<a href="http://facebook.com/thebrotherspromotions" style="padding-left:22px;">View Organiser Profile</a><br/>
					<img src="<?=base_url()?>/images/icon2.png"/><a href="http://facebook.com/thebrotherspromotions"> facebook.com/thebrotherspromotions</a><br/>
					<img src="<?=base_url()?>/images/icon3.png"/><a href="http://twitter.com/mrdeanalexander"> @mrdeanalexander</a>
					</p>
					
				</div>
				<div class="col-xs-12">&nbsp;</div>
				<script>$(function () {$('[data-toggle="tooltip"]').tooltip();})</script>
				
				<div class="col-xs-12 bgGG" style="height:80px;margin-top:20px;">
					<div class="col-xs-12 text-center"><br/>
						<button class="btn btn-default btn-grad btn-lg btn-borgn"  data-toggle="tooltip" data-placement="top" title="Feature is coming soon!!!"><img src="<?=base_url()?>/images/icon4.png"/> Save This Event</button><br/><br/>
					</div>
				</div>
				</div>
			</div>
					
                </div> 
		
				 
			</div>	
                <!--   
                <div class="table-only">
                    <h1>Select Quantity</h1>
                    <ul>
                        <li class="row">
                        <div class="form-group col-md-4 col-xs-10">
                            <select class="selectpicker show-tick form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                            </select>
                        </div>
                        <p class="col-md-8 col-sm-8 toppad">Adult Type &pound;26.50 (&pound;25.00 ticket price + &pound; 1.50 fees)</p>
                        </li>
                    </ul>
                </div>   
                -->
            <!--div class="col-xs-12">
			<br/>
			<div class="col-md-0 col-xs-6 table-responsive cus-selectx cus-ick">
                <div class="table-only outer-additional">
                    <h1>Additionals</h1>
                    <ul>
                        <li class="row">
                            <p class="col-xs-12">None</p>
                        </li>
                    </ul>
                </div>
                
                <div class="table-only qty">
                    <h1>
                        <ul>
                            <li class="col-md-2 col-xs-2">&nbsp;</li>
                            <li class="col-md-3 col-xs-3">Table Type</li>
                            <li class="col-md-4 col-xs-4">Unit/Price</li>
                            <li class="col-md-3 col-xs-3">Total</li>
                            <div class="clearfix"></div>
                        </ul>
                    </h1>
                    <div class="session-cart-list text-center">
                    Empty!
                    </div>

                </div>
                
                <div class="note">
                    <div class="row no-mar">
                        <div class="col-md-2 col-sm-4 col-xs-3 ii">
                            <p>i</p>
                        </div>
                        <div class="col-md-10 col-sm-8 col-xs-9 ii-text">
                            <p>Your order may be subject to a fulfilment fee or postage fee it will be added to your shopping basket</p>
                        </div>
                    </div>
                </div>
                
                <div class="row no-mar"><br/>
                    <div class="col-md-4 col-xs-2"></div>
                    <div class="col-md-4 col-sm-12 col-xs-8 btn btn-danger btn-orang button-add-to-cart">
                       Add to basket
                    </div>
                    <div class="col-md-3 col-xs-2"></div>
                </div>
                
            </div>
			
		
          

            </div-->
        </div>
    </div>


</div>
 <div class="container line"></div>
     <div class="container no-pad intrest">
     	<h1>Related to your interest</h1>
     <ul id="flexiselDemo1"> 
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                           
    <li class="intrest-pic"><img src="<?=base_url()?>assets/upload/event/thumb/intrest1.png?>" />
            <p>Cowboy3 <img src="<?=base_url()?>assets/upload/event/thumb/star2.png" /></p>
     </li>
                                                        
</ul>


     </div>

<div class="modal fade" id="contactOrg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Contact the Organiser</h4>
      </div>
	  <form action="http://ticketbaby.co.uk/index.php/index/contactOrganiser" method="post">
      <div class="modal-body cus-form3">
        <div class="form-group">
			<input type="text" class="form-control" placeholder="Name" name="name" required/>
		</div>
		 <div class="form-group">
			<input type="email" class="form-control" placeholder="Email" name="email" required/>
		</div>
		 <div class="form-group">
			<textarea class="form-control" placeholder="Message" name="message" required></textarea>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send</button>
      </div>
	  </form>
    </div>
  </div>
</div>