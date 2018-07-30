<?php include('includes/header.php'); ?>

<div class="container">


    <div class="row no-mar main-content">

        <div class="heading col-xs-12">
            <div class="col-md-4 col-xs-12">
                <h1 class="payment_title">ORDER REVIEW</h1>
            </div>
            <div class="col-md-8 col-xs-12 btnVus">
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-headers <?php
                        if ($this->uri->segment('2') == 'booking_post') {
                            echo "active_btn";
                        }
                        ?> ">Review</button>
                    </div>

                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-headers">Billing Details</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-headers">Payment</button>
                    </div>
                </div>
            </div>
        </div>
		<form method="post" action="<?php echo base_url('awards/billing/' .$order_details->event_id) ?>">
            <div class="col-md-4 col-sm-4 left-sidebar">
                <div class="main-thumb">
                    <img class="order_thumb_image" src="<?php echo base_url('uploads/images/medium/' . $order_details->image) ?>" alt="">
                </div>  
            </div>
            <!-- Col-md-8 -->
            <div class="col-md-8 col-sm-8">
                <div class="col-md-6 col-xs-12 movie-video-heading">
                    <h1><?php echo $order_details->name; ?></h1>
                    <h2><?php echo $order_details->venue; ?></h2>
					<?php $dta = explode('/',$order_details->start_date);
						  $d = $dta['0'];
						  $m = $dta['1'];
						  $y = $dta['2'];
						  $nwdta = $y.'-'.$m.'-'.$d;
						  $dt = date_create($nwdta); 
					?>
                    <p><strong><?php echo date_format($dt, 'd M Y').' '.strtoupper($order_details->time); ?></strong><br>
                        <small class="small_heading_texts">
                            <?php echo $order_details->address; ?><br>
                            <?php echo $order_details->city; ?><br>
                            <?php echo $order_details->country; ?> </small>
                    </p>
                </div>
                <div class="col-md-6 col-xs-12" style="padding:0px ">
                    <div class="cus-table no-pad">

                        <?php $sessions = $this->session->userdata('tables');
							  $ses = $this->session->userdata('after_party'); 
							  $tickets = $this->session->userdata('tickets'); 		
						 	 
						if($sessions)
						{
							$t = 0;
							$price = 0;
							foreach ($sessions as $se)
							 {
								if ($se['section'] == 'Tables Only') {
								//if ($se['section'] == 'Tables Only' || $se['section'] == 'Table Tickets') {
									$price = count($se['table']) * $se['table_charge'];
								}
								$t += $price;
							}
							
							
							$sm = 0;
							$price_seats = 0;
							$price = 0;
							foreach ($sessions as $so) {
								if ($so['section'] == 'Table Tickets') {
									$price = count(@$so['table']) * $so['table_charge'];
								//if ($so['section'] == 'Tables Only' || $so['section'] == 'Table Tickets') {
									foreach ($so['seat'] as $key => $val) {
										if ($val != 0) {
											$price_seats = $val * (@$so['seat_charge']);
											$sm += $price_seats;
										}
									}
								}
								$t += $price;
							}
							
						  $total_price = $t + $sm; 
						}
						
						?>
					
                        <div class="table-only qty qtypages" id="myorder">
                            <h1>
                                <ul>
                                    <li class="col-md-1"></li>
                                    <li class="col-md-3 col-xs-4">Section</li>
                                    <li class="col-md-3 col-xs-4">Type</li>
                                    <li class="col-md-3 col-xs-4">Quantity</li>
                                    <li class="col-md-2 col-xs-4">Total</li>
                                    <div class="clearfix"></div>
                                </ul>
                            </h1>
                            <div class="session-cart-list orderullist text-center"> 
                                <?php  
										$z = 1;
									   $tickets_price="";
									   $after_party_price="";
								 if (empty($sessions) and empty($ses) and empty($tickets))
								 { 
										 echo '<div class="emptyclass" style="padding-bottom:10px;">Empty!</div>'; 
								 }
								 
								 if($sessions)
                                 {
                                    foreach ($sessions as $s) {
                                        ?>
                                        <ul>
                                            <li class="col-md-1"><?php //echo $z; ?></li>
                                            <li class="col-md-3 col-xs-3"><?php echo $s['class']; ?></li>
                                            <li class="col-md-3 col-xs-3"><?php echo $s['section']; ?></li>

                                            <?php //if ($se['section'] == 'Tables Only') {
											if ($s['section'] == 'Tables Only' || ($s['section'] == 'Table Tickets' && @$s['table']!='')) { //print_r($s['seat']);
											 ?>
                                                <li class="col-md-3 col-xs-4"><span style="font-weight:100;"></span> (<?php echo count(@$s['table']) ?> * <?php echo $s['table_charge'] ?>)</li>
                                            <?php } else if($s['section'] == 'Table Tickets') { ?>
                                                <li class="col-md-3 col-xs-4"> <span style="font-weight:100;"></span>
                                                        <?php
                                                        $sum_tickets = 0;
                                                        foreach ($s['seat'] as $ss => $val) {
                                                            if ($val != 0) {
                                                                ?>
                                                                <span><?php echo $val ?> * <?php echo $s['seat_charge'] ?></span>
                                                                <?php
                                                                $sum_tickets += $val * $s['seat_charge'];
                                                            }
                                                        }
                                                    }
                                                    ?>
                                            </li>
                                            <li class="col-md-2 col-xs-4">&pound; <?php
                                                $sum = count(@$s['table']) * $s['table_charge'];
												//if ($se['section'] == 'Tables Only') {
                                                if ($s['section'] == 'Tables Only' || ($s['section'] == 'Table Tickets' && @$s['table']!='')) {
                                                    echo $sum;
                                                } else  if($s['section'] == 'Table Tickets'){
                                                    echo $sum_tickets;
                                                }
                                                ?></li>
                                            <div class="clearfix"></div>
                                        </ul>

                                        <?php
                                        $z++;
                                    }
								 }
								 
								 if (!empty($ses)) 
								 { 
							?>
                                        <ul class="aparty">
                                     <?php 
										
									    foreach($ses['after_party'] as $key=>$val)
										{
									?>		
                                            <li class="col-md-1"> <?php //echo $z; ?></li>
                                            <li class="col-md-3 col-xs-3"><?php echo $ses['after_party'][$key]['name']; ?></li>
                                            <li class="col-md-3 col-xs-3">Additional</li>
                                            <li class="col-md-3 col-xs-4"><span style="font-weight:100;"></span> (<?php echo $ses['after_party'][$key]['seat_charge']; ?> * <?php echo $ses['after_party'][$key]['total']; ?>)</li>
                                            <li class="col-md-2 col-xs-3">£ <?php echo  $ses['after_party'][$key]['seat_charge'] * $ses['after_party'][$key]['total']; ?>
                                            								<?php   $after_party_price = $after_party_price + $ses['after_party'][$key]['seat_charge'] * $ses['after_party'][$key]['total']; ?>				
                                            </li>
                                            <div class="clearfix"></div>
                                     <?php 
									 	$z++;
									 } ?>       
                                        </ul>
                                        <?php
                                    }
									
									
								 if (!empty($tickets)) 
								 { 
							   ?>
                                        <ul class="aparty">
                                     <?php 
										
									    foreach($tickets['tickets'] as $key=>$val)
										{
									?>		
                                            <li class="col-md-1"> <?php //echo $z; ?></li>
                                            <li class="col-md-3 col-xs-3"><?php echo $tickets['tickets'][$key]['name']; ?></li>
                                            <li class="col-md-3 col-xs-3">Tickets</li>
                                            <li class="col-md-3 col-xs-4"><span style="font-weight:100;"></span> (<?php echo $tickets['tickets'][$key]['seat_charge']; ?> * <?php echo $tickets['tickets'][$key]['total']; ?>)</li>
                                            <li class="col-md-2 col-xs-3">£ <?php echo  $tickets['tickets'][$key]['seat_charge'] * $tickets['tickets'][$key]['total']; ?>
                                         <?php   $tickets_price = $tickets_price + $tickets['tickets'][$key]['seat_charge'] * $tickets['tickets'][$key]['total']; ?>				
                                            </li>
                                            <div class="clearfix"></div>
                                     <?php 
									 	$z++;
									 } ?>       
                                        </ul>
                                        <?php
                                    }	
								 ?>
                            </div>

                        </div>
                        
                        
                        <table class="table fees_list">
                            <tbody>
                                <tr>
                                    <td></td>
                                    <?php if ($order_details->fulfillment_status == 0) { ?>
                                        <td>
                                            Fulfillment Fees (+)  &pound; <?php echo $order_details->fulfillment_fee ?>
                                        </td>
                                    <?php } else { ?>
                                        <td>Fulfillment Fees (+)  <?php echo $order_details->fulfillment_fee ?> % </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <?php if ($order_details->postage_status == 0) { ?>
                                        <td>
                                            Postage Fees (+) &pound; <?php echo $order_details->postage_fee; ?>
                                        </td>
                                    <?php } else { ?>
                                        <td>
                                            Postage Fees (+) <?php echo $order_details->postage_fee; ?> %
                                        </td>
                                    <?php } ?>
                                </tr>


                                <?php if ($this->session->userdata('coupen_value') != '') { ?>
                                    <?php
                                    if ($this->session->userdata('coupen_type') == '2') {
                                        $discount = $this->session->userdata('coupen_value');
                                    } elseif ($this->session->userdata('coupen_type') == '1') {
                                        $discount = ($this->session->userdata('coupen_value') / 100) * $total_price;
                                    } else {
                                        $discount = @$total_price;
                                    }
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td>
                                            Coupon Discount (-) &pound; <?php echo $discount; ?>
                                        </td>

                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td></td>
                                    <td><span><strong><a class="seating_chart" title="Seating Plan" data-toggle="modal" data-target="#seatModalOrder">Seating Chart</a></strong></span></td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <?php
                    if ($order_details->fulfillment_status == 0) {

                        @$fulfillment_price = $order_details->fulfillment_fee;
                    } else {
                        @$fulfillment_price = ($order_details->fulfillment_fee / 100) * $total_price;
                    }
                    ?>

                    <?php
                    if ($order_details->postage_status == 0) {
                        @$postage_price = $order_details->postage_fee;
                    } else {
                        @$postage_price = ($order_details->postage_fee / 100) * $total_price;
                    }
                    ?>


                    <!--<div class="col-xs-12 text-center bgWhite allBorders borderdiv">
                        <h4>Ticket</h4>
                        <h4>Price - £ <?php //echo @sprintf('%.2f', $total_price); ?></h4>
                    </div>-->
                    
                    <div class="col-xs-12 text-center bgWhite noBorders">
                        <?php
                        if ($this->session->userdata('coupen_value') != '') {
                            if ($this->session->userdata('coupen_type') == 3) {
                                $subtotal = 0;
                            } else {
                                @$subtotal = ($total_price + $after_party_price + $tickets_price + $fulfillment_price + $postage_price) - $discount;
                            }
                        } else {
							
                           @$subtotal = $total_price + $after_party_price  + $tickets_price + $fulfillment_price + $postage_price;
                        }
                        ?>

                        <h4>SUBTOTAL - £ 
                            <span id="subTotalSpan"><?php echo @sprintf('%.2f', $subtotal); ?></span></h4>  
                        <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>" id="subTotalPass">
                    </div>

                    <div class="col-xs-12 text-center bgWhite allBorders borderdiv">
                        <h5 class="textRed">** Excluding CC charges</h5>
                    </div>

                </div>
            </div>



            <div class="col-xs-12">&nbsp;</div>
            <div class="col-xs-12">&nbsp;</div>
            <div class="col-xs-12 bgGray"><br>
                <div class="col-md-6 col-xs-12">
                    <p>
                        Please ensure you review your order all sales are final in the
                        unlikely event of a refund there will be an admin charge.<br><br>
                        You may delete any item before you complete your order.<br><br>
                        All orders are subject of account approval and billing address verification.
                    </p>
                </div>
                <div class="col-md-6 col-xs-12 text-center">
                    <div class="col-md-6 col-xs-12 text-center hasRightBorder" style="visibility:hidden;">
                        <button class="btn btn-default btn-gray btn-lg">Submit Order</button><br>
                        <h5>We will save your ticket selections in your basket, but we cannot hold actual tickets.</h5>
                    </div>

                    <div class="col-md-6 col-xs-12 text-center">
                        <button type="submit" class="btn btn-danger btn-red btn-lg">Confirm Order</button><br>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="seatModalOrder" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">SEATING PLAN</h4>
            </div>
            <div class="modal-body">
                <img class="seat_modal_img" src="<?php echo theme_img('seats.fw.png') ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<?php include('includes/footer.php') ?>