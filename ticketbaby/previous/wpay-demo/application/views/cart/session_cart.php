<?php
//$session_cart;
//print_r($cart_session);
?>
<?php if (isset($cart_session) && sizeof($cart_session) > 0) { ?>
    <?php foreach ($cart_session as $k => $cart_session_item): ?>
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
        <ul>
            <li class="col-md-2 col-xs-2"><p data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="session_cart_delete glyphicon glyphicon-remove" style="cursor:pointer;"  data-key="<?= $k; ?>">DEL</span></p></li>
            <li class="col-md-3 col-xs-3"><p><?php echo $cart_session_item["ticket_class_title"]; ?></p></li>
            <li class="col-md-4 col-xs-4"><p>&pound <?php echo $unit_price; ?></p></li>
            <li class="col-md-3 col-xs-3"><input type="text" value="&pound <?php echo $unit_price; ?>" disabled /></li>
            <div class="clearfix"></div>
        </ul>
        <ul style="padding-bottom:10px;">
            <li class="col-md-2 col-xs-2">&nbsp;</li>
            <li class="col-md-3 col-xs-3">&nbsp;</li>
            <li class="col-md-4 col-xs-4" style="font-weight:normal;">[
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
                ]</li>
            <li class="col-md-3 col-xs-3">&nbsp;</li>
            <div class="clearfix"></div>
        </ul>
    <?php endforeach ?>
<?php } else { ?>
    <div style="padding-bottom:10px;">Empty!</div>
<?php } ?>