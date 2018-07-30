<div>
    <div>
        <h3>Hello <?php echo $cart_user_session["billing_details"]["first_name"]. " " . $cart_user_session["billing_details"]["last_name"];?>,</h3>
    </div>
    <div>
        Your order has been placed successfully. Thank you.
    </div>
</div>

<div style="background: #ccc none repeat scroll 0 0;height: 1px;margin: 15px auto;"></div>


<div style="width:100%">

<div style="float:left;width:width: 33.3333%;">
    <div style="margin-bottom: 20px;">
        <img src="<?=base_url()?><?php echo $event["pic1"]; ?>" />
    </div>  

     <div  style="margin-bottom: 20px;">
<div style="padding-bottom:10px;"><strong>Billing Information:</strong></div>
<div> Name : <?php echo $cart_user_session["billing_details"]["first_name"]. " " . $cart_user_session["billing_details"]["last_name"];?>  </div>
<div> Email : <?php echo $cart_user_session["billing_details"]["email"] ?> </div>
<div> Address : <?php echo $cart_user_session["billing_details"]["address"] ?> </div>
<div> Area : <?php echo $cart_user_session["billing_details"]["area"] ?> </div>
<div> City : <?php echo $cart_user_session["billing_details"]["city"] ?> </div>
<div> Post Code : <?php echo $cart_user_session["billing_details"]["post_code"] ?> </div>
<div> Contact Number : <?php echo $cart_user_session["billing_details"]["contact_number"] ?> </div>
</div>
    
</div>
<!-- Col-md-8 -->
<div style="float:left;width:width: 66.6667%;">
    <div style="float:left;width:40%;min-height: 1px;padding-left: 15px;padding-right: 15px;position: relative;">
        <h1 sryle="border: medium none;color: #000;font-family: "AlternateGothicNo2BT-Regular";font-size: 33px;padding: 0;"><?php echo $event["title"]; ?></h1>
        <h2 style="border: medium none;color: #e15b00;font-family: "AlternateGothicNo2BT-Regular";font-size: 22px;margin: 0;padding: 0;text-transform: uppercase;"><?php echo $event["venue"]; ?></h2>
        <p style="border: medium none;color: #515151;font-size: 13px;font-weight: 600;margin: 0;padding: 0;"><strong style="font-size: 15px;"><?php echo $event["start_date_format"]; ?></strong><br/>
        <small>
            <?php echo $event["address"]; ?><br/>
            <?php echo $event["city"]; ?><br/>
            <?php echo $event["country"]; ?>
        </small>
        </p>
    </div>
    <div style="float:left;width:50%;min-height: 1px;padding-left: 15px;padding-right: 15px;position: relative;">
        <div>
        <div style="background: #fff none repeat scroll 0 0;border: 5px solid #efefef;padding-top: 15px;">

        <table style="margin-bottom: 20px;max-width: 100%;width: 100%;">
        <tr>
            <td style="border: 0 none;padding-bottom: 2px;padding-top: 2px;">&nbsp;</td> 
            <td style="border: 0 none;padding-bottom: 2px;padding-top: 2px;"><strong>Section</strong></td> 
            <td style="border: 0 none;padding-bottom: 2px;padding-top: 2px;"><strong>Type</strong></td> 
            <td style="border: 0 none;padding-bottom: 2px;padding-top: 2px;"><strong>Quantity</strong></td> 
            <td style="border: 0 none;padding-bottom: 2px;padding-top: 2px;"><strong>Total</strong></td> 
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
            <td style="border: 0 none;padding-bottom: 2px;padding-top: 2px;"><?=$NUM;?></td> 
            <td style="border: 0 none;padding-bottom: 2px;padding-top: 2px;"><?php echo $cart_session_item["ticket_class_title"]; ?></td> 
            <td style="border: 0 none;padding-bottom: 2px;padding-top: 2px;"><?php echo $cart_session_item["ticket_section_name"]; ?></td> 
            <td style="border: 0 none;padding-bottom: 2px;padding-top: 2px;">
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
            <td style="border: 0 none;padding-bottom: 2px;padding-top: 2px;">&pound; <?php echo $unit_price; ?></td> 
        </tr>
        <?php $total_price = $total_price + $unit_price;$NUM++; } endforeach;  ?>
        </table>


                 <table style="margin-bottom: 20px;max-width: 100%;width: 100%;">
                <?php 

                ?>
                <?php if ( isset($cart_additional_session)  ) {  ?>
                <tr>
                    <td style="border: 0 none;padding-bottom: 2px;padding-top: 2px;">Additionals</td>
                    <td>After Party Ticket</td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php echo $cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"]; ?>  * &pound; 10 = (+) &pound;  <?php echo $cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"] * 10  ?> </td> 
                </tr>
                <?php } ?>



                <?php 
                    $event_additional_charges = $event["event_additional_charges"]; 
                    $event_additional_charge_total = 0;
                    $additional_percentage_arr = array();
                    for ($I=0; $I<sizeof($event_additional_charges); $I++ ) { 
                        $views_array = explode(",", $event_additional_charges[$I]["views"]);
                        
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
                <?php  } ?>



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

            </table>

            <div style="clear:both;"></div>
            </div>
            <div style="border: 5px solid #efefef;background: #fff none repeat scroll 0 0;margin-top: 0;">
                <h4>Ticket Price - &pound; <?php echo number_format($total_price,2); ?></h4>
            </div>
            <div style="border: 5px solid #efefef;">
                <h4 style="font-size:20px;">SUBTOTAL - &pound; <?php echo number_format(($total_price + $percentage_charge_total +  $event_additional_charge_total + $additonal_details_charity_amount + ($cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"] * 10) ),2); ?></h4>
            </div>
        </div>
    </div>
</div>

</div>

<div style="clear:both;"></div>
<div>
    <div>
        Regards<br/><?php echo $this->config->item('site_admin_title'); ?>
    </div>
</div>





