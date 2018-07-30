<div class="col-md-4 col-sm-4 left-sidebar">
    <div class="main-thumb">
        <img src="<?= base_url() ?>assets/upload/event/thumb/<?php echo $event["thumb1"]; ?>" />
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
    <div class="col-md-6 col-xs-12" style="padding:0px ">
            <div class="cus-table no-pad">

                <table class="table">
                    <tr>
                        <td class="text-left">&nbsp;</td> 
                        <td class="text-left"><strong>Section</strong></td> 
                        <td class="text-left"><strong>Type</strong></td> 
                        <td class="text-left"><strong>Quantity</strong></td> 
                        <td class="text-left"><strong>Total</strong></td> 
                    </tr>
                    <?php
                    $NUM = 1;
                    $total_price = 0;
                    foreach ($cart_session as $k => $cart_session_item): if ($cart_session_item["ticket_class_class"] != "after-party") {
                            ?>
                            <?php
                            $selected_tables = sizeof($cart_session_item["selected_tables"]);
                            $table_count = 0;
                            $seat_count = 0;
                            $unit_price = 0;

                            if ($cart_session_item["ticket_section_name"] == "table") {
                                $table_count = $selected_tables;
                            } else {
                                for ($I = 0; $I < $selected_tables; $I++) {
                                    if ($cart_session_item["selected_tables"][$I]["seat_quantity"] == $cart_session_item["table_seat_count"] && $cart_session_item["event_ticket"] == "Y") {
                                        $table_count = $table_count + 1;
                                    } else {
                                        $seat_count = $seat_count + intval($cart_session_item["selected_tables"][$I]["seat_quantity"]);
                                    }
                                }
                            }

                            if ($table_count > 0) {
                                $unit_price = $table_count * ($cart_session_item["table_price"]);
                            }
                            if ($seat_count > 0) {
                                $unit_price = $unit_price + ($seat_count * ($cart_session_item["unit_min_purchase"] * $cart_session_item["unit_price"]));
                            }
                            ?>
                            <tr>
                                <td class="text-left"><?= $NUM; ?></td> 
                                <td class="text-left"><?php echo $cart_session_item["ticket_class_title"]; ?></td> 
                                <td class="text-left"><?php echo $cart_session_item["ticket_section_name"]; ?></td> 
                                <td class="text-left">
                                    <?php
                                    if ($table_count > 0) {
                                        echo $table_count . " " . 'Table';
                                        ?> * <?php
                                        echo 1 * $cart_session_item["table_price"];
                                    }

                                    if ($table_count > 0 && $seat_count > 0) {
                                        echo "<br/>";
                                    }

                                    if ($seat_count > 0) {
                                        echo $seat_count . " " . $cart_session_item["ticket_section_name"];
                                        ?> * <?php
                                        echo $cart_session_item["unit_price"] * $cart_session_item["unit_min_purchase"];
                                    }
                                    ?>
                                </td> 
                                <td class="text-left">&pound; <?php echo $unit_price; ?></td> 
                            </tr>
                            <?php
                            $total_price = $total_price + $unit_price;
                            $NUM++;
                        } endforeach;
                    ?>
                </table>


                <table class="table">
                    <?php ?>
                    <?php if (isset($cart_additional_session)) { ?>
                        <tr>
                            <td class="text-right">Additionals</td>
                            <td>After Party Ticket</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><?php echo $cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"]; ?>  * &pound; 10 = (+) &pound; <?php echo $cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"] * 10 ?> </td> 
                        </tr>
                    <?php } ?>


                    <?php
                    $event_additional_charges = $event["event_additional_charges"];
                    $event_additional_charge_total = 0;
                    $additional_percentage_arr = array();
                    $method = $this->router->fetch_method();
                    for ($I = 0; $I < sizeof($event_additional_charges); $I++) {
                        $views_array = explode(",", $event_additional_charges[$I]["views"]);
                        if (!isset($additional_charges_view) || in_array($additional_charges_view, $views_array)) {
                            ?>
                            <tr>
                                <td></td>
                                <td>
                                    <?php
                                    if ($event_additional_charges[$I]["additional_charge_type"] == 'F') {
                                        echo $event_additional_charges[$I]["additional_charge_title"];
                                    }
                                    ?>
                                    <?php
                                    if ($event_additional_charges[$I]["additional_charge_type"] == 'P') {
                                        $additional_percentage_arr[sizeof($additional_percentage_arr)] = $event_additional_charges[$I];
                                    } else {
                                        echo "(+) &pound; " . $event_additional_charges[$I]["additional_charge"];

                                        if (($event_additional_charges[$I]["additional_charge_field"] == 'registered_postage_fee') || ($event_additional_charges[$I]["additional_charge_field"] == 'special_postage_fee')) {
                                            echo "<span class='lftInput'>
									<input type='radio' class='postage_type' onclick='addPostageFees()' name='postage_type' value='registered_postage_fee' ";
                                            if ($method == 'viewcart') {
                                                if ($cart_captcha_session['event_customer_details']['postage_details'] == 'standard')
                                                    echo "checked='checked'";
                                            }

                                            if ($postage_type == 'registered_postage_fee') {
                                                echo "checked='checked'";
                                            }
                                            if ($method == 'order') {
                                                echo 'disabled';
                                            }
                                            echo " />";
                                            echo "<input type='hidden' id='registered_postage_fee_text_val' name='registered_postage_fee_text_val' value='" . $event_additional_charges[$I]["additional_charge"] . "' />";
                                            echo "</span>";
                                        }


                                        if (($event_additional_charges[$I]["additional_charge_field"] != 'registered_postage_fee') && ($event_additional_charges[$I]["additional_charge_field"] != 'special_postage_fee')) {

                                            $event_additional_charge_total = $event_additional_charge_total + $event_additional_charges[$I]["additional_charge"];
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>


                    <?php
                    $additonal_details_charity_amount = 0;
                    if (isset($cart_user_session) && isset($cart_user_session["additonal_details"])) {
                        $additonal_details_charity_amount = $cart_user_session["additonal_details"]["charity_amount"];
                        ?>
                        <tr>
                            <td></td>
                            <td>Donation (+) &pound; <?php echo $additonal_details_charity_amount; ?></td>   
                        </tr>
                        <?php
                    } else {
                        $additonal_details_charity_amount = 0;
                    }
                    ?>


                    <?php
                    $percentage_charge_total = 0;
                    for ($I = 0; $I < sizeof($additional_percentage_arr); $I++) {
                        ?>
                        <tr>
                            <td></td>
                            <td><?php echo $additional_percentage_arr[$I]["additional_charge_title"]; ?> 
                                (+) &pound; <?php
                                $sub_total = ($total_price + $event_additional_charge_total + $additonal_details_charity_amount + ($cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"] * 10) );
                                $percentage_charges = round(($sub_total * $additional_percentage_arr[$I]["additional_charge"]) / 100, 2);
                                echo $percentage_charges;



                                if (($additional_percentage_arr[$I]["additional_charge_field"] == 'registered_postage_fee') || ($additional_percentage_arr[$I]["additional_charge_field"] == 'special_postage_fee')) {

                                    echo "<span class='lftInput'>
									<input type='radio' class='postage_type' onclick='addPostageFees()' name='postage_type' value='special_postage_fee' ";
                                    if ($method == 'viewcart') {
                                        if ($cart_captcha_session['event_customer_details']['postage_details'] == 'special')
                                            echo "checked='checked'";
                                    }

                                    if ($postage_type == 'special_postage_fee') {
                                        echo "checked='checked'";
                                    }
                                    if ($method == 'order') {
                                        echo 'disabled';
                                    }
                                    echo " />";
                                    echo "<input type='hidden' id='special_postage_fee_text_val' name='special_postage_fee_text_val' value='" . $percentage_charges . "' />";
                                    echo "</span>";
                                }

                                if (($additional_percentage_arr[$I]["additional_charge_field"] != 'registered_postage_fee') && ($additional_percentage_arr[$I]["additional_charge_field"] != 'special_postage_fee'))
                                    $percentage_charge_total = $percentage_charge_total + $percentage_charges;
                                ?></td>   
                        </tr>
                        <?php
                    }
                    ?>

                    <?php if ($cart_delivery_type != '') { ?>
                        <tr>
                            <td></td>
                            <td>
                                <span class="seating-chart-popup"><strong>Delivery</strong></span> (+) &pound; 
                                <?php
                                    $delivery_amount_val = $$cart_delivery_type;
                                    echo $delivery_amount = $delivery_amount_val[0]['value'];
                                ?>
                            </td> 
                        </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td><span class="seating-chart-popup"><strong>Seating Chart</strong></span></td> 
                    </tr>
                </table>


            </div>
            <div class="col-xs-12 text-center bgWhite allBorders">
                <h4>Ticket</h4>
                <h4>Price - &pound; <?php echo number_format($total_price, 2); ?></h4>
            </div>
            <div class="col-xs-12 text-center bgWhite noBorders">
                <h4>SUBTOTAL - &pound; 

                    <?php
                    $subTotal = number_format(($total_price + $percentage_charge_total + $event_additional_charge_total + $additonal_details_charity_amount + $delivery_amount + ($cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"] * 10)), 2);



                    $subTotal = str_replace(',', '', $subTotal);

                    if ($subTotalPass != '') {
                        $subTotalPass = $subTotal + $postage_charge;
                        $subTotalPass = number_format($subTotalPass, 2);
                    } else {
                        $subTotalPass = $subTotal;
                    }


                    echo '<span id="subTotalSpan">' . $subTotalPass . '</span></h4>';


                    $subTotalPass = str_replace(',', '', $subTotalPass);
                    $discount = '';

                    if ($coupon_details["coupon_type"] == "F") {
                        $discount = number_format($coupon_details['coupon_value'], 2);
                        echo "Discount : &pound;" . $discount;
                        $subTotalPass = ($subTotalPass - $coupon_details['coupon_value']);
                    }

                    if ($coupon_details["coupon_type"] == "P") {
                        $discount = number_format(($subTotalPass * $coupon_details['coupon_value']) / 100, 2);
                        echo "Discount : &pound;" . $discount;
                        $subTotalPass = $subTotalPass - ($subTotalPass * $coupon_details['coupon_value']) / 100;
                    }
                    ?>
                    <input type="hidden" name="subTotalHidden" value="<?php echo $subTotal; ?>" id="subTotalHidden"  />
                    <input type="hidden" name="subTotalPass" value="<?php echo $subTotalPass; ?>" id="subTotalPass"  />

                    <?php
                    $subTotalPass = number_format($subTotalPass, 2);
                    if ($discount != '')
                        echo "<h4>TOTAL : &pound;" . $subTotalPass;
                    ?>



                </h4>
            </div>

            <?php if (isset($coupon_details)) { ?>
                <div class="col-xs-12 text-center bgWhite noBorders">
                    <?php if ($coupon_details["coupon_type"] == "FREE") { ?>
                        <h4>TOTAL -  &pound; 0.00 </h4>
                        <p style="color:green;">[ Coupon applied : <?= $coupon_details["coupon_code"]; ?> ]</p>
                    <?php } ?>
                    <?php if ($coupon_details["coupon_type"] == "F" && $seat_count > 0) { ?>
                        <h4>TOTAL -  &pound; <?php echo number_format((($total_price - $coupon_details["coupon_value"]) + $percentage_charge_total + $event_additional_charge_total + $additonal_details_charity_amount + ($cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"] * 10)), 2); ?> </h4>
                        <p style="color:green;">[ Coupon applied : <?= $coupon_details["coupon_code"]; ?> ]</p>
                    <?php } ?>
                    <?php
                    if ($coupon_details["coupon_type"] == "P" && $seat_count > 0) {
                        $after_disscount = $total_price / $coupon_details["coupon_value"];
                        ?>
                        <h4>TOTAL -  &pound; <?php echo number_format((($total_price - $after_disscount) + $percentage_charge_total + $event_additional_charge_total + $additonal_details_charity_amount + ($cart_additional_session["after_party_ticket"]["selected_tables"][0]["seat_quantity"] * 10)), 2); ?> </h4>
                        <p style="color:green;">[ Coupon applied : <?= $coupon_details["coupon_code"]; ?> ]</p>
                    <?php } ?>
                </div>
            <?php } ?>

            <?php if ($additional_charges_view == "R") { ?>
                <div class="col-xs-12 text-center bgWhite allBorders">
                    <h5 class="textRed">** excluding cc charges</h5>
                </div>
            <?php } ?>

        </div>
</div>

<!--
<div class="count-down-container">
    The session will expire in : <span class="count-down-timer" ></span>
</div>
-->
<div class="col-xs-12 timer text-center">
    <p><strong>Time left to complete page</strong></p>
    <span id="time" class="count-down-timer"></span>
</div>

<!--
<div class="col-xs-12">
    <p><strong>If you don't want these tickets, give them up and <a href="<?= base_url() ?>">search again >></a>.</strong></p>
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
                <div style="background:#fafafa;text-align:center;"><img src="<?= base_url() ?>assets/images/setting-plan.png" /></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        if ($("input[type=radio][name='postage_type']:checked").val() != '') {
            addPostageFees();
        }

    });

    function addPostageFees() {

        var postage_type = $("input[type=radio][name='postage_type']:checked").val();
        var postage_type_val = $('#' + postage_type + '_text_val').val();
        var subTotalHidden = $('#subTotalHidden').val();
        subTotalHidden = subTotalHidden.replace(/,/g, "");
        //alert(subTotalHidden);
        //alert(postage_type_val);
        //alert((parseFloat(this.value)+parseFloat(subTotalHidden)).toFixed(2));

        var final_number = ((postage_type_val != undefined ? parseFloat(postage_type_val) : 0) + parseFloat(subTotalHidden)).toFixed(2);
        final_number = final_number.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        //alert(final_number);
        $('#subTotalSpan').html('');
        $('#subTotalSpan').html(final_number);
        $('#subTotalPass').val('');
        $('#subTotalPass').val(final_number);

    }
</script>