<div class="col-md-4 col-sm-4 left-sidebar">
    <div class="main-thumb">
      <img src="<?=base_url()?>assets/upload/event/thumb/<?php echo $event["thumb1"]; ?>" />
    </div>  
    
</div>
<!-- Col-md-8 -->
<div class="col-md-8 col-sm-8">
    <div class="movie-video-heading col-md-6 col-xs-12">
        <h1><?php echo $event["title"]; ?></h1>
        <h2><?php echo $event["venue"]; ?></h2>
        <p><strong><?php echo $event["start_date_format"]; ?></strong><br/>
        <small>
            <?php echo $event["address"]; ?><br/>
            <?php echo $event["city"]; ?><br/>
            <?php echo $event["country"]; ?>
        </small>
        </p>
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="col-xs-12">
        <div class="table-responsive cus-table no-pad">

        <table class="table">
        <tr>
            <td class="text-left">&nbsp;</td> 
            <td class="text-left"><strong>Section</strong></td> 
            <td class="text-left"><strong>Type</strong></td> 
            <td class="text-left"><strong>Quantity</strong></td> 
            <td class="text-left"><strong>Total</strong></td> 
        </tr>
        <?php $NUM=1;$total_price = 0; foreach ($cart_session as $k=>$cart_session_item): if ( $cart_session_item["ticket_class_class"] != "after-party") { ?>
        <?php

        $selected_tables = sizeof($cart_session_item["selected_tables"]);
        $table_count = 0;
        $seat_count  = 0;
        $unit_price  = 0;

        if ( $cart_session_item["ticket_section_name"] == "table" ) {
            $table_count = $selected_tables;
        }else{
            for ($I=0; $I<$selected_tables; $I++ ) {
                if ( $cart_session_item["selected_tables"][$I]["seat_quantity"] == $cart_session_item["table_seat_count"] && $cart_session_item["event_ticket"] == "Y"  ) {
                    $table_count = $table_count + 1;
                }else{
                    $seat_count = $seat_count + intval( $cart_session_item["selected_tables"][$I]["seat_quantity"] );
                }   
            }
        }
        
        if ( $table_count > 0) {
            $unit_price = $table_count * ($cart_session_item["table_price"]);   
        }
        if ( $seat_count > 0) {
            $unit_price = $unit_price + ($seat_count * ($cart_session_item["unit_min_purchase"] * $cart_session_item["unit_price"]));   
        }

        ?>
        <tr>
            <td class="text-left"><?=$NUM;?></td> 
            <td class="text-left"><?php echo $cart_session_item["ticket_class_title"]; ?></td> 
            <td class="text-left"><?php echo $cart_session_item["ticket_section_name"]; ?></td> 
            <td class="text-left">
            <?php 
            if ( $table_count > 0) {
                echo $table_count . " " . 'Table'; ?> * <?php echo 1 * $cart_session_item["table_price"];   
            }

            if ( $table_count > 0 && $seat_count > 0) {
                echo "<br/>";
            }

            if ( $seat_count > 0) {
                echo $seat_count . " " . $cart_session_item["ticket_section_name"]; ?> * <?php echo $cart_session_item["unit_price"] * $cart_session_item["unit_min_purchase"] ;    
            }    
            ?>
            </td> 
            <td class="text-left">&pound; <?php echo $unit_price; ?></td> 
        </tr>
        <?php $total_price = $total_price + $unit_price;$NUM++; } endforeach;  ?>
        </table>


                 <table class="table">
                <?php 

                ?>
                <?php if ( isset($cart_additional_session)  ) {  ?>
                <tr>
                    <td class="text-right">Additionals</td>
                    <td>After Party Ticket</td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php echo $cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"]; ?>  * &pound; 10 = (+) &pound; <?php echo $cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"] * 10  ?> </td> 
                </tr>
                <?php } ?>


                <?php 
                    $event_additional_charges = $event["event_additional_charges"]; 
                    $event_additional_charge_total = 0;
                    $additional_percentage_arr = array();
                    for ($I=0; $I<sizeof($event_additional_charges); $I++ ) { 
                        $views_array = explode(",", $event_additional_charges[$I]["views"]);
                        if ( !isset($additional_charges_view) || in_array($additional_charges_view, $views_array) ) {
                    ?>
                <tr>
                    <td></td>
                    <td>
                        <?php if ( $event_additional_charges[$I]["additional_charge_type"] == 'F' ) { 
                            echo $event_additional_charges[$I]["additional_charge_title"]; 
                            }?>
                        <?php 
                            if ( $event_additional_charges[$I]["additional_charge_type"] == 'P' ) {
                                $additional_percentage_arr[sizeof($additional_percentage_arr)] = $event_additional_charges[$I];
                            }else{
                                echo "(+) &pound; " . $event_additional_charges[$I]["additional_charge"];  
                                $event_additional_charge_total =  $event_additional_charge_total + $event_additional_charges[$I]["additional_charge"];   
                            }
                            
                        ?>
                    </td>
                </tr>
                <?php  }} ?>


                <?php $additonal_details_charity_amount = 0; if( isset($cart_user_session) && isset($cart_user_session["additonal_details"]) ) { 
                    $additonal_details_charity_amount = $cart_user_session["additonal_details"]["charity_amount"];
                ?>
                     <tr>
                                <td></td>
                                    <td>Donation (+) &pound; <?php echo $additonal_details_charity_amount; ?></td>   
                                </tr>
                <?php }else{ 
                    $additonal_details_charity_amount = 0;
                } ?>


                <?php
                    $percentage_charge_total = 0;
                    for ($I=0; $I<sizeof($additional_percentage_arr); $I++ ) { 
                    ?>
                    <tr>
                                <td></td>
                                    <td><?php echo $additional_percentage_arr[$I]["additional_charge_title"]; ?> 
                                    (+) &pound; <?php 
                                    $sub_total = ($total_price + $event_additional_charge_total + $additonal_details_charity_amount + ($cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"] * 10) );
                                    $percentage_charges = round(($sub_total * $additional_percentage_arr[$I]["additional_charge"]) / 100,2);
                                    echo $percentage_charges;
                                    $percentage_charge_total = $percentage_charge_total + $percentage_charges;
                                    ?></td>   
                                </tr>
                    <?php   
                    }
                ?>


                <tr>
                <td></td>
                    <td><span class="seating-chart-popup"><strong>Seating Chart</strong></span></td> 
                </tr>
            </table>


            </div>
            <div class="col-xs-12 text-center bgWhite allBorders">
                <h4>Ticket</h4>
                <h4>Price - &pound; <?php echo number_format($total_price,2); ?></h4>
            </div>
            <div class="col-xs-12 text-center bgWhite noBorders">
                <h4>SUBTOTAL - &pound; <?php echo number_format(($total_price + $percentage_charge_total +  $event_additional_charge_total + $additonal_details_charity_amount + ($cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"] * 10) ),2); ?></h4>
            </div>

            <?php  if ( isset($coupon_details) ) { ?>
            <div class="col-xs-12 text-center bgWhite noBorders">
                <?php if ( $coupon_details["coupon_type"] == "FREE" ) { ?>
                <h4>TOTAL -  &pound; 0.00 </h4>
                <p style="color:green;">[ Coupon applied : <?=$coupon_details["coupon_code"];?> ]</p>
                <?php } ?>
				<?php if ( $coupon_details["coupon_type"] == "F"  && $seat_count >0 ) {  ?>
                <h4>TOTAL -  &pound; <?php echo number_format((($total_price-$coupon_details["coupon_value"]) + $percentage_charge_total +  $event_additional_charge_total + $additonal_details_charity_amount + ($cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"] * 10) ),2); ?> </h4>
                <p style="color:green;">[ Coupon applied : <?=$coupon_details["coupon_code"];?> ]</p>
                <?php } ?>
				<?php if ( $coupon_details["coupon_type"] == "P"  && $seat_count >0 ) {  
			 	$after_disscount	=	$total_price/$coupon_details["coupon_value"];
				?>
                <h4>TOTAL -  &pound; <?php echo number_format((($total_price-$after_disscount) + $percentage_charge_total +  $event_additional_charge_total + $additonal_details_charity_amount + ($cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"] * 10) ),2); ?> </h4>
                <p style="color:green;">[ Coupon applied : <?=$coupon_details["coupon_code"];?> ]</p>
                <?php } ?>
            </div>
            <?php } ?>

            <?php if ( $additional_charges_view == "R") {  ?>
            <div class="col-xs-12 text-center bgWhite allBorders">
                <h5 class="textRed">** excluding cc charges</h5>
            </div>
            <?php } ?>

        </div>
    </div>
</div>

<!--
<div class="count-down-container">
    The session will expire in : <span class="count-down-timer" ></span>
</div>
-->
<div class="col-xs-12 timer text-center" style="height:100px;">
    <p><strong>Time left to complete page</strong></p>
    <span id="time" class="count-down-timer"></span>
</div>

<!--
<div class="col-xs-12">
    <p><strong>If you don't want these tickets, give them up and <a href="<?=base_url()?>">search again >></a>.</strong></p>
</div>
-->


 <!-- Vip Platinum Table infomation   -->
<div class="modal fade" id="seatingChartPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Seating Plan:</h4>
      </div>
      <div class="modal-body">
        <div style="background:#fafafa;text-align:center;"><img src="<?=base_url()?>assets/images/setting-plan.png" /></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>