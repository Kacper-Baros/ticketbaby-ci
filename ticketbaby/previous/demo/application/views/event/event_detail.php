 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/t-baby.min.js" />
 <div class="container-fluid content-bg">
    <div class="container content">
        <div class="heading">
            <h1>Events</h1>
        </div>
        <div class="row no-mar main-content">
            <form class="form-event-details">
            <div class="col-md-4 col-sm-4 left-sidebar">
                <div class="main-thumb">
                    <img src="<?=base_url()?>assets/upload/event/thumb/<?php echo $event["thumb1"]; ?>" />
                </div>  
                <div class="event-info">
                    <h1>Event Information</h1>
                    <ul>
                        <li class="row"><span class="col-md-4 col-sm-3 col-xs-4">Date</span><em class="col-md-8 col-sm-9 col-xs-8">: <?php echo $event["start_date_format"]; ?></em></li>
                        <li class="row"><span class="col-md-4 col-sm-3 col-xs-4">Venue</span><em class="col-md-8 col-sm-9 col-xs-8">: <?php echo $event["venue"]; ?></em></li>
                        <li class="row"><span class="col-md-4 col-sm-3 col-xs-4">Address</span><em class="col-md-8 col-sm-9 col-xs-8">: <?php echo $event["address"]; ?></em></li>
                        <li class="row"><span class="col-md-4 col-sm-3 col-xs-4">City</span><em class="col-md-8 col-sm-9 col-xs-8">: <?php echo $event["city"]; ?></em></li>
                        <li class="row"><span class="col-md-4 col-sm-3 col-xs-4">Country</span><em class="col-md-8 col-sm-9 col-xs-8">: <?php echo $event["country"]; ?></em></li>
                    </ul>
                    <p><?php echo $event["summary"]; ?></p>                    
                </div>  

                <div class="table-only">
                    <h1>table only - choose your Section</h1>
                    <ul>
                        <li class="row"> 
                        <label class="col-md-12 col-sm-12 col-xs-12"> 
                            <strong class="col-md-3 col-sm-3 col-xs-3 text-right">Type</strong>
                            <strong class="col-md-5 col-sm-5 col-xs-5 text-right" >Price</strong>
                            <strong class="col-md-4 col-sm-4 col-xs-4 text-right">Available</strong>
                        </label>
                        </li>
                        <?php foreach ($event_seats as $events_item): if($events_item['ticket_section_section'] == "table" && $events_item['ticket_group'] == "default") {
                            $avaialble_table =  ($events_item['group_unit_total']-sizeof($events_item['occupied_seat_numbers'])) / $events_item['unit_min_purchase'];
                        ?>
                        <li class="row">
                        <input class="col-md-1 col-sm-1 col-xs-1" type="radio" data-event="<?php echo $events_item['event_id'] ?>" data-ticket-class="<?php echo $events_item['ticket_class_id'] ?>"  name="seat_table" <?php if (intval($avaialble_table) < 1){ echo "disabled";} ?>/>
                        <label class="col-md-11 col-sm-11 col-xs-10"> 
                        <strong><?php echo $events_item['ticket_class_title']; ?></strong>
                        <span class="ticket-class-tooltip" data-event="<?php echo $events_item['event_id'] ?>" data-ticket-class="<?php echo $events_item['ticket_class_id'] ?>" data-ticket-class-slug="<?php echo $events_item['ticket_class_class'] ?>" >?</span>
                        <em>&pound; <?php echo $events_item['unit_price'] * $events_item['unit_min_purchase']; ?>
                        </em><?php echo $avaialble_table;  ?></label>
                        </li>
                        <?php } endforeach ?>
                    </ul>
                </div>  
                
                <div class="table-only">
                    <h1>TICKETS - choose your section</h1>
                    <ul>
                        <li class="row"> 
                        <label class="col-md-12 col-sm-12 col-xs-12"> 
                            <strong class="col-md-3 col-sm-3 col-xs-3 text-right">Type</strong>
                            <strong class="col-md-5 col-sm-5 col-xs-5 text-right" >Price</strong>
                            <strong class="col-md-4 col-sm-4 col-xs-4 text-right">Available</strong>
                        </label>
                        </li>
                        <?php foreach ($event_seats as $events_item): if($events_item['ticket_section_section'] == "ticket" && $events_item['ticket_group'] == "default") { 
                            $avaialble_ticket =  ($events_item['group_unit_total']-sizeof($events_item['occupied_seat_numbers'])) / $events_item['unit_min_purchase'];
                        ?>
                        <li class="row">
                        <input class="col-md-1 col-sm-1 col-xs-1" type="radio" data-event="<?php echo $events_item['event_id'] ?>" data-ticket-class="<?php echo $events_item['ticket_class_id'] ?>" name="seat_ticket" <?php if (intval($avaialble_ticket) < 1){ echo "disabled";} ?> />
                        <label class="col-md-11  col-sm-11 col-xs-10"> 
                        <strong><?php echo $events_item['ticket_class_title']; ?></strong>
                        <span class="ticket-class-tooltip" data-event="<?php echo $events_item['event_id'] ?>" data-ticket-class="<?php echo $events_item['ticket_class_id'] ?>" data-ticket-class-slug="<?php echo $events_item['ticket_class_class'] ?>" >?</span>
                        <em>&pound; <?php echo $events_item['unit_price'] * $events_item['unit_min_purchase']; ?>
                        </em><?php echo $avaialble_ticket;  ?></label>
                        </li>
                        <?php } endforeach ?>
                    </ul>
                </div>  



                <div class="table-only outer-additional">
                    <h1>TICKETS - Additionals</h1>

                    <ul>
                        <li class="row"> 
                        <label class="col-md-12 col-sm-12 col-xs-12"> 
                            <strong class="col-md-3 col-sm-3 col-xs-3 text-right">Type</strong>
                            <strong class="col-md-5 col-sm-5 col-xs-5 text-right" >Price</strong>
                            <strong class="col-md-4 col-sm-4 col-xs-4 text-right">Available</strong>
                        </label>
                        </li>
                        <?php foreach ($event_seats as $events_item): if($events_item['ticket_group'] == "additional") { 
                            $avaialble_ticket =  ($events_item['group_unit_total']-sizeof($events_item['occupied_seat_numbers'])) / $events_item['unit_min_purchase'];
                        ?>
                        <li class="row">
                        <input class="col-md-1 col-sm-1 col-xs-1" type="radio" data-event="<?php echo $events_item['event_id'] ?>" data-ticket-class="<?php echo $events_item['ticket_class_id'] ?>" name="after_party_ticket_select" <?php if (intval($avaialble_ticket) < 1){ echo "disabled";} ?> />
                        <label class="col-md-11  col-sm-11 col-xs-10"> 
                        <strong><?php echo $events_item['ticket_class_title']; ?></strong>
                        <span class="ticket-class-tooltip" data-event="<?php echo $events_item['event_id'] ?>" data-ticket-class="<?php echo $events_item['ticket_class_id'] ?>" data-ticket-class-slug="<?php echo $events_item['ticket_class_class'] ?>" >?</span>
                        <em>&pound; <?php echo $events_item['unit_price'] * $events_item['unit_min_purchase']; ?>
                        </em><?php echo $avaialble_ticket;  ?></label>
                        </li>
                        <?php } endforeach ?>
                    </ul>

        
                </div>



                <div class="table-only outer-additional">
                    <h1>Promo Code</h1>

                    <ul>         
                        <li class="row text-center">
                        <input type="text" name="customer_promo_code" class="event-promo-code" value="<?php echo ($cart_captcha_session && $cart_captcha_session["event_customer_details"]) ? $cart_captcha_session["event_customer_details"]["customer_promo_code"] : ""; ?>" placeholder="Promo Code" autocomplete="off" />
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
                
                <div class="row no-mar">
                    <div class="col-md-3 col-xs-2"></div>
                    <div class="col-md-6 col-sm-12 col-xs-8 add-to-basket">
                        <a href="javascript:void(0);" class="button-add-to-cart">Add to Cart</a>
                    </div>
                    <div class="col-md-3 col-xs-2"></div>
                </div>
      
            </div>
            </form>

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
        <p>Time - <?php echo $event["start_time_format"]; ?></p>
        <!--<h3><?php //echo $event["title"]; ?></h3>-->
    </div>
    <div class="seating-plan">
        <h1>Seating Plan</h1>
    </div>
    <div class="seating-plan-image">
        <img src="<?=base_url()?>assets/images/setting-plan.png" />
    </div>
    <div class="seating-text">
        <p><?php echo $event["details"]; ?></p>
    </div>


    <div class="row no-mar need-room">
    </div>

     <div class="seating-text">
        <p>
        Attending the awards? Why not make a weekend of it, reserve your room at our accommodation partner Hotel Latour and enjoy 5* luxury of one of the city’s most luxurious hotels just quote Ref: MVSA for discounts valid only with an awards ticket condition apply Call Today - 0121 718 3000
        </p>
    </div>
	
	<div class="col-xs-12 bgG2">
				<div class="col-xs-12 bgGG">
					<div class="col-xs-12 orng">
						<h4>Location</h4>
					</div>
					<div class="col-xs-12" style="height:255px;"><br/>
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2428.350473520599!2d-1.8866605841929493!3d52.5089961798121!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2suk!4v1447001424738" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
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
					<a href="http://facebook.com/thebrotherspromotions" target="_blank" style="padding-left:22px;">View Organiser Profile</a><br/>
					<img src="<?=base_url()?>images/icon2.png"/><a href="http://facebook.com/thebrotherspromotions" target="_blank"> facebook.com/thebrotherspromotions</a><br/>
					<img src="<?=base_url()?>images/icon3.png"/><a href="http://twitter.com/mrdeanalexander" target="_blank"> @mrdeanalexander</a>
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

      

</div>   
