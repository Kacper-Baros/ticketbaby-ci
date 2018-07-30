<div class="container-fluid content-bg">
    <div class="col-xs-12">
    <center>
        <img src="<?=base_url()?>assets/images/cubeNite.png" class="img-responsive"/>
    </center>
    </div>
</div>

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
                    <h2>
                    <?php if( $event["min_unit_price"] == $event["max_unit_price"] ) { ?>
                    price - &pound; <?php echo $event["min_unit_price"]; ?>
                    <?php } else {  ?>
                    price - &pound; <?php echo $event["min_unit_price"]; ?> - &pound; <?php echo $event["max_unit_price"]; ?> 
                    <?php } ?>
                    </h2>
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
                    <!--
                    <div class="col-md-12 col-xs-12"><br/>
                        <div class="col-xs-4 orang-bk text-center">
                            <strong><?php echo strtoupper($event["start_date_month"]); ?><br/><?php echo $event["start_date_date"]; ?></strong><br/><?php echo strtoupper(substr($event["start_date_day"],0,3)); ?>
                        </div>
                        <div class="p-no">
                           <p>Venue : <?php echo $event["venue"]; ?></p>
                            <p>Address : <?php echo $event["address"]; ?></p>
                            <p>City : <?php echo $event["city"]; ?></p>
                            <p>Country : <?php echo $event["country"]; ?></p>
                        </div>
                        <br/><br/><br/>
                    </div>
                    -->
                    <br/>
                </div>  
                <div class="col-md-6 col-xs-12">

                <div class="event-info">
                        <div class="col-xs-4 orang-bk text-center">
                            <strong><?php echo strtoupper($event["start_date_month"]); ?><br/><?php echo $event["start_date_date"]; ?></strong><br/><?php echo strtoupper(substr($event["start_date_day"],0,3)); ?>
                        </div>
                        <div class="p-no">
 
                            <p><?php echo trim($event["venue"]) ? "Venue : " . $event["venue"] : "&nbsp;"; ?></p> 
                            <p><?php echo trim($event["address"]) ? "Address : " . $event["address"] : "&nbsp;"; ?></p>
                            <p><?php echo trim($event["city"]) ? "City : " . $event["city"] : "&nbsp;"; ?></p>
                            <p><?php echo trim($event["country"]) ? "Country : " . $event["country"] : "&nbsp;"; ?></p>
                        </div>
                        <br/><br/>
                </div>       

                <div class="table-only">
                    <h1>TICKETS - choose your section</h1>
                    <ul>
                        <li class="row"> 
                        <label class="col-md-12 col-sm-12 col-xs-12"> 
                            <strong class="col-md-3 col-sm-3 col-xs-3 text-center">Type</strong>
                            <strong class="col-md-5 col-sm-5 col-xs-5 text-center" >Price</strong>
                            <strong class="col-md-4 col-sm-4 col-xs-4 text-center">Available</strong>
                        </label>
                        </li>
                        <?php foreach ($event_seats as $events_item): if($events_item['ticket_section_section'] == "ticket") { 
                            $avaialble_ticket =  ($events_item['group_unit_total']-sizeof($events_item['occupied_seat_numbers'])) / $events_item['unit_min_purchase'];
                        ?>
                        <li class="row">
                            <input class="col-md-1 col-sm-1 col-xs-1" type="radio" data-event="<?php echo $events_item['event_id'] ?>" data-ticket-class="<?php echo $events_item['ticket_class_id'] ?>" name="seat_ticket" <?php if (intval($avaialble_ticket) < 1){ echo "disabled";} ?> />
                            <label class="col-md-4 col-xs-10"><strong><?php echo $events_item['ticket_class_title']; ?></strong></label>
                            <label class="col-md-4"><em>&pound; <?php echo $events_item['unit_price'] * $events_item['unit_min_purchase']; ?></em></label>
                            <label class="col-md-3 text-center"><?php echo $avaialble_ticket;  ?></label>
                        </li>
                        <?php } endforeach ?>
                    </ul>
                </div> 

                <!--
                <div class="table-only">
                    <h1>Select Quantity</h1>
                    <ul>
                        <li class="row">
                        <div class="form-group col-md-4 col-xs-10">
                            <select class="selectpicker show-tick form-control">
                                <option>Select</option>
                                <option>Select</option>
                                <option>Select</option>
                                <option>Select</option>
                            </select>
                        </div>
                        <p class="col-md-8 col-sm-8 toppad">DINNER &euro;26.50 (&eoru;25.00 ticket price + 1.50 fees)</p>
                        </li>
                    </ul>
                </div>  
                --> 
                
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
                            <li class="col-md-3 col-xs-3">Ticket Type</li>
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
                    <div class="col-md-4 col-sm-12 col-xs-8 btn btn-primary btn-orang button-add-to-cart">
                       Add to basket
                    </div>
                    <div class="col-md-3 col-xs-2"></div>
                </div>
                
            </div>

            <!--
            <div class="col-md-6 col-xs-12">
                <div class="col-md-8 col-md-offset-4 col-xs-12 bgG2">
                <div class="col-xs-12 bgGG">
                    <div class="col-xs-12 orng">
                        <h4>Location</h4>
                    </div>
                    <div class="col-xs-12"><br/>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.805394215012!2d-0.19167989999999246!3d51.49843857908681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x53895c357f70187f!2sKensington+Close+Hotel!5e0!3m2!1sen!2s!4v1435911077833" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                    <div class="col-xs-12">&nbsp;</div>
                    <p><strong>Kensington Close Hotel</strong><br/>
                    Wrights Lane<br/>
                    W8 5SP Kensington<br/>
                    United Kingdom
                    </p>
                </div>
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-12 bgGG">
                    <div class="col-xs-12 orng">
                        <h4 style="color:#fff;">Organiser Details</h4>
                    </div>
                    <div class="col-xs-12 hasBorderBottom">
                        <h4>LONDON ELITE</h4>
                    </div>
                    <div class="col-xs-12"><br/>
                        <button class="btn btn-default btn-grad"><img src="<?=base_url()?>assets/images/icon1.png"/> Contact the Organiser</button>
                    </div>
                    <p class="hasBorderBottom" style="line-height:30px;" ><a href="#">View organiser profile</a><br/>
                    <img src="<?=base_url()?>assets/images/icon2.png"/><a href="#"> facebook.com/thelondonelite</a><br/>
                    <img src="<?=base_url()?>assets/images/icon3.png"/><a href="#"> TheLondonElite</a>
                    </p>
                </div>
                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-12 bgGG">
                    <div class="col-xs-12 text-center"><br/>
                        <button class="btn btn-default btn-grad btn-lg btn-borgn"><img src="<?=base_url()?>assets/images/icon4.png"/> Save This Event</button><br/><br/>
                    </div>
                </div>
                </div>
            </div>
            -->

            <div class="col-md-6 col-xs-12">
                <div class="col-md-8 col-md-offset-4 col-xs-12 bgG2">
                <div class="col-xs-12 bgGG">
                    <div class="col-xs-12 orng">
                        <h4>Location</h4>
                    </div>

                    <?php if( trim($event["map_location"]) ) { ?>
                    <div class="col-xs-12"><br/>
                    <iframe src="<?=$event["map_location"];?>" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                    <div class="col-xs-12">&nbsp;</div>
                    <?php } ?>

                    <p>
                    <strong><?php echo trim($event["venue"]) ?  $event["venue"] : "&nbsp;"; ?></strong><br/> 
                    <?php echo trim($event["address"]) ?  $event["address"] : "&nbsp;"; ?><br/>
                    <?php echo trim($event["city"]) ?  $event["city"] : "&nbsp;"; ?><br/>
                    <?php echo trim($event["country"]) ?  $event["country"] : "&nbsp;"; ?><br/>
                    </p>
                </div>
                <div class="col-xs-12">&nbsp;</div>
                <!--
                <div class="col-xs-12 bgGG">
                    <div class="col-xs-12 text-center"><br/>
                        <button class="btn btn-default btn-grad btn-lg btn-borgn"><img src="<?=base_url()?>assets/images/icon4.png"/> Save This Event</button><br/><br/>
                    </div>
                </div>
                -->
                </div>
            </div>



            

            </div>
        </div>
    </div>
</div>
