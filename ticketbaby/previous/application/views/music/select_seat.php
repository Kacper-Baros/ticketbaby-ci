<?php
  $event_seat = $event_seats[0];
?>
<div class="alert alert-warning alert-error-seat-select" style="display: none;">
<strong>Error!</strong> Please select a table/ticket to proceed.
</div>

<div class="container-fluid">
  <div class="row text-center">
    <input type="hidden" name="ticket_section_name" value="<?=$post_var['ticket_section']?>" /> 
    <input type="hidden" name="event_id" value="<?=$event_seat['event_id']?>" /> 
    <input type="hidden" name="ticket_class_id" value="<?=$event_seat['ticket_class_id']?>" /> 
    <input type="hidden" name="ticket_section_section_id" value="<?=$event_seat['ticket_section_section_id']?>" /> 
    <input type="hidden" name="ticket_class_title" value="<?=$event_seat['ticket_class_title']?>" /> 
    <input type="hidden" name="unit_price" value="<?=$event_seat['unit_price']?>" /> 
    <input type="hidden" name="unit_min_purchase" value="<?=$event_seat['unit_min_purchase']?>" /> 
    <input type="hidden" name="ticket_class_class" value="<?=$event_seat['ticket_class_class']?>" />
    <input type="hidden" name="table_price" value="<?=$event_seat['table_price']?>" />
    <input type="hidden" name="table_seat_count" value="<?=$event_seat['table_seat_count']?>" />
    <input type="hidden" name="event_ticket" value="<?=$event_seat['event_ticket']?>" />
    <input type="hidden" name="ticket_selection_type" value="<?=$event_seat['ticket_selection_type']?>" />
    

    <?php

    foreach ($event_seats as $k=>$event_seat) { 
    for ($I=$event_seat["table_start_number"]; $I<=$event_seat["table_end_number"]; $I++ ) { 
        if ( !in_array($I,$event_unavailable_seats["missing_seat_numbers"]) ) {
            $occupied_seat_count = sizeof($event_unavailable_seats["occupied_table_booked_details"]);

            $booked_seat_count  = 0;
            for ( $K=0; $K<$occupied_seat_count; $K++ ) {
                  if ( $event_unavailable_seats["occupied_table_booked_details"][$K]["occupied_table_number"] == $I ) {
                    $booked_seat_count = $event_unavailable_seats["occupied_table_booked_details"][$K]["occupied_seat_count"];
                    break;
                  }
            }
            $available_seat_count = $event_seat["table_seat_count"] - $booked_seat_count;

    ?>
    <div class="col-md-3 seat-selection-row">  
        <!-- 
        <?php //if (in_array($I,$event_seat["occupied_seat_numbers"])) { ?>  
          <span><img src="<?=base_url()?>assets/images/occupied.png" /></span>
        <?php //} else { ?> 
          <span><img src="<?=base_url()?>assets/images/available.png" /></span>
        <?php //} ?>
        -->
        <div class="row">
        <?php  if ( $event_seat['ticket_class_class'] == "after-party" || $event_seat['ticket_class_class'] == "adult" || $event_seat['ticket_class_class'] == "child" || $event_seat['ticket_class_class'] == "dinner-and-dance" || $event_seat['ticket_class_class'] == "dance" || $event_seat['ticket_selection_type'] == "2" ) { ?>
        <?php echo $event_seat['ticket_class_title']; ?>
        <?php } else { ?>
        Table <?=$I;?>
        <?php } ?>
        </div> 
        <div class="row">   
            <input required type="checkbox" value="<?=$I;?>" name="choose-table-number[]" <?php if ($available_seat_count < 1) { ?>disabled<?php } ?>  />
        </div>
        <div class="row seat-booked-info">
          <?php if ( $post_var['ticket_section'] == "table") { ?>
            <?php if ($available_seat_count < 1) { ?> <span class="occupied">Sold </span> <?php } else { ?> <span class="available">  Available </span>  <?php } ?>
          <?php } else if ( $event_seat['ticket_class_class'] == "after-party" || $event_seat['ticket_class_class'] == "adult" || $event_seat['ticket_class_class'] == "child" || $event_seat['ticket_class_class'] == "dinner-and-dance" || $event_seat['ticket_class_class'] == "dance" || $event_seat['ticket_selection_type'] == "2") { ?>
            <span class="available"> <?=$available_seat_count;?> Available </span>
          <?php } else { ?>
            <span class="occupied"><?=$booked_seat_count;?> Sold </span> / <span class="available"> <?=$available_seat_count;?> Available </span>
          <?php } ?>
        </div> 
        <?php if ( $post_var['ticket_section'] == "ticket") { ?>
        <div class="row">
          <?php if ( $event_seat['ticket_class_class'] == "after-party" || $event_seat['ticket_class_class'] == "adult" || $event_seat['ticket_class_class'] == "child" || $event_seat['ticket_class_class'] == "dinner-and-dance" || $event_seat['ticket_class_class'] == "dance" || $event_seat['ticket_selection_type'] == "2") { ?>
            <input type="text"  name="choose-ticket-quantity-<?=$I;?>" min="1" max="<?=$available_seat_count;?>" data-bind="value:replyNumber" class="form-control-popup" placeholder="Quantity">         
          <?php } else { ?>  
            <select min="1" max="<?=$available_seat_count;?>" name="choose-ticket-quantity-<?=$I;?>">
                <option value="">-Select-</option>
                <?php 
                for ( $K=1; $K<=$available_seat_count; $K++ ) {
                    $ticket_qty_label = $event_seat["table_seat_count"] == $K ? 'Table' : $K;
                    echo '<option value="'.$K.'">'. $ticket_qty_label.'</option>';     
                }
                ?>
            </select>
          <?php } ?>
        </div>
        <?php } ?>
    </div>
    <?php 
        }
    } 
  }
    ?>
  </div>

  <?php if( $event_seat["ticket_class_tool_tip"] ) { ?>
  <div class="row ticket-select-warning">
    <?php echo $event_seat["ticket_class_tool_tip"];  ?>
  </div>
  <?php } ?>
</div>
