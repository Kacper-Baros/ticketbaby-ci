 
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
        <h2>price - &pound; <?php echo $event["min_unit_price"]; ?> - &pound; <?php echo $event["max_unit_price"]; ?> </h2>
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
        <img src="<?=base_url()?>assets/images/latour.jpg" />
    </div>

     <div class="seating-text">
        <p>
        Attending the awards? Why not make a weekend of it, reserve your room at our accommodation partner Hotel Latour and enjoy 5* luxury of one of the city’s most luxurious hotels just quote Ref: MVSA for discounts valid only with an awards ticket condition apply Call Today - 0121 718 3000
        </p>
    </div>
            </div>
        </div>
    </div>

      

</div>   
