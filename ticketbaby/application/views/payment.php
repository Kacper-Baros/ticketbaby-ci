<?php include('includes/header.php') ?>

<div class="container">


    <div class="row no-mar main-content">
        <div class="row">
            <div class="heading col-xs-12">
                <div class="col-md-4 col-xs-12">
                    <h1 class="payment_title">PAYMENT</h1>
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
                            <button type="button" class="btn btn-headers <?php
                            if ($this->uri->segment('2') == 'billing') {
                                echo "active_btn";
                            }
                            ?> ">Billing Details</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-headers  <?php
                            if ($this->uri->segment('2') == 'payment') {
                                echo "active_btn";
                            }
                            ?>">Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-4 col-sm-4 left-sidebar">
            <div class="main-thumb">
                <img class="order_thumb_image" src="<?php echo base_url('uploads/images/medium/' . $order_details->image) ?>" alt="">
            </div>  
        </div>
        <!-- Col-md-8 -->
        <div class="col-md-8 col-sm-8">
            <div class="movie-video-heading col-md-6 col-xs-12">
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
                    <small>
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
						foreach ($sessions as $se) {
							if ($se['section'] == 'Tables Only') {
								$price = count($se['table']) * $se['table_charge'];
							}
							$t += $price;
						}
						
						$sm = 0;
						$t = 0;
						$price_seats = 0;
						foreach ($sessions as $so) {
							if ($so['section'] == 'Table Tickets') {
								$price = count(@$se['table']) * $se['table_charge'];
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
							   
								 if (!empty($sessions))
								 {
                                  foreach ($sessions as $s) {
                                    ?>
                                    <ul>
                                        <li class="col-md-1"><?php //echo $z; ?></li>
                                        <li class="col-md-3 col-xs-3"><?php echo $s['class']; ?></li>
                                        <li class="col-md-3 col-xs-3"><?php echo $s['section']; ?></li>

                                        <?php if ($s['section'] == 'Tables Only' || ($s['section'] == 'Table Tickets' && @$s['table']!='')) { ?>
                                            <li class="col-md-3 col-xs-4"><span style="font-weight:100;"></span> (<?php echo count($s['table']) ?> * <?php echo $s['table_charge'] ?>)</li>
                                        <?php } else if($s['section'] == 'Table Tickets'){ ?>
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
                                            if ($s['section'] == 'Tables Only' || ($s['section'] == 'Table Tickets' && @$s['table']!='')) {
                                                echo $sum;
                                            } else if($s['section'] == 'Table Tickets'){
                                                echo $sum_tickets;
                                            }
                                            ?></li>
                                        <div class="clearfix"></div>
                                    </ul>

                                    <?php
                                    $z++;
                                }
                           		 }
							
                          		if (!empty($ses)) { 
									?>
                                        <ul class="aparty">
                                     <?php 
										$after_party_price="";
									    foreach($ses['after_party'] as $key=>$val)
										{
									?>		
                                            <li class="col-md-1"> <?php // echo $key; ?></li>
                                            <li class="col-md-3 col-xs-3"><?php echo $ses['after_party'][$key]['name']; ?></li>
                                            <li class="col-md-3 col-xs-3">Additional</li>
                                            <li class="col-md-3 col-xs-4"><span style="font-weight:100;"></span> (<?php echo $ses['after_party'][$key]['seat_charge']; ?> * <?php echo $ses['after_party'][$key]['total']; ?>)</li>
                                            <li class="col-md-2 col-xs-3">£ <?php echo  $ses['after_party'][$key]['seat_charge'] * $ses['after_party'][$key]['total']; ?>
                                            								<?php   $after_party_price = $after_party_price + $ses['after_party'][$key]['seat_charge'] * $ses['after_party'][$key]['total']; ?>				
                                            </li>
                                            <div class="clearfix"></div>
                                     <?php } ?>       
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
                                        $discount = $total_price;
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
                                     <?php if ($order_details->creditcard_status == 0) { ?>
                                    <td>
                                        Credit card Charges (+) &pound; <?php echo $order_details->creditcard_fee; ?> 
                                    </td>
                                     <?php }else{ ?>
                                      <td>
                                           Credit Card Charges (+) <?php echo $order_details->creditcard_fee; ?> %
                                        </td>
                                  <?php   } ?>
                                    
                                    
                                    
                                </tr>
                            </tbody>
                    </table>

                </div>


                
                
                    <?php if($order_details->fulfillment_status == 0){
                        
                        $fulfillment_price = $order_details->fulfillment_fee;
                    }else{
                        @$fulfillment_price = ($order_details->fulfillment_fee/100) * $total_price;
                    } ?>
                    
                    <?php if($order_details->postage_status == 0){
                       @ $postage_price = $order_details->postage_fee;
                    }else{
                        @$postage_price = ($order_details->postage_fee/100) * $total_price;
                    } ?>
                   
                    <?php /*if($order_details->creditcard_status == 0){
                       @ $creditcard_price = $order_details->creditcard_fee;
                    }else{
                        @$creditcard_price = ($order_details->creditcard_fee/100) * $total_price;
                    }*/ ?>
                   
                
                

               <?php /*?> <div class="col-xs-12 text-center bgWhite allBorders borderdiv">
                    <!--<h4>Ticket</h4>-->
                    <h4>Price - £ <?php echo @sprintf('%.2f',$total_price); ?></h4>
                </div><?php */?>
                
                <div class="col-xs-12 text-center bgWhite noBorders">
                    
                         <?php
								$subtotal = '';
								$subtotal1 = '';
                        if ($this->session->userdata('coupen_value') != '') {
                            if ($this->session->userdata('coupen_type') == 3) {
                                $subtotal = 0;
								$subtotal1 = 0;
                            } else {
                                //@$subtotal = ($total_price + $after_party_price + $tickets_price + $fulfillment_price + $postage_price + $creditcard_price) - $discount;
								@$subtotal = ($total_price + $after_party_price + $tickets_price + $fulfillment_price + $postage_price) - $discount;
								@$subtotal1 = ($total_price + $after_party_price + $tickets_price) - $discount;
                            }
                        } else {
                            //@$subtotal = $total_price + $after_party_price + $tickets_price + $fulfillment_price + $creditcard_price + $postage_price;
							@$subtotal = $total_price + $after_party_price + $tickets_price + $fulfillment_price + $postage_price;
							@$subtotal1 = $total_price + $after_party_price + $tickets_price;
                        }
                        ?>
						<?php
							if ($order_details->creditcard_status == 0) {
								@$creditcard_price = $order_details->creditcard_fee;
							} else {
								@$creditcard_price = ($order_details->creditcard_fee / 100) * $subtotal1;
							}
							
							//Final Total:
							@$subtotal = $subtotal + $creditcard_price;
						?>
                    <h4>SUBTOTAL - £ 
                        <span id="subTotalSpan"><?php echo @sprintf('%.2f',$subtotal) ?></span></h4>  
                    <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>" id="subTotalPass">
                </div>

            </div>
        </div>

        <div class="col-xs-12 bgBlack">
            <h5><strong>Conditions</strong></h5>
        </div>

        <div class="col-xs-12 bgGray"><br>
            <div class="col-md-8 col-xs-12 hasRightBorder">

                <p class="text-justify">
                </p><p>
                    Tickets or services cannot be exchanged or refunded after purchase please insure you have review and  check you order before confirming it. Please see our purchase policy for details.

                    Your contract of purchase starts as soon as you have confirmed you purchase and will terminate on the day of the event for which the ticket package and/or associated service is purchased. All transactions are subject to payment card verification checks to insure the security of the card holder.
                    <br> <br> The transaction maybe terminated if it does not pass our security validation checks. 

                    To stop ticket scalping we may restrict ticket sales to a maximum number per person and or per household please observe any publish limits for ticket quotas as tickets purchase in excess of the set amount may result in cancellation of the order.

                    <br> <br> Ticket baby collects information about you when you make a purchase This information is collected on behalf of the event organizers or promoter, for the purpose of assisting the organizers to run the event efficiently or in accordance with their private policy. This will also protect you in the case of disputes. We do not share you information with third parties or marketing firms. Please see our private policy   

                    By clicking Submit you have agreed to the terms and conditions in our purchase policy including refund policy and the organizers contacting you by email or other means in relation to information that may interest you, You may choose to opt out by contact the  directly
                </p>
                <p></p>
            </div>


            <?php $client = $this->session->userdata('client');
				
           	  // $sessions = $this->session->userdata('tables');	print_r($sessions);
		  ?>

            <!--<form action="https://secure-test.worldpay.com/wcc/purchase" method="POST">-->
           <form action="https://secure.worldpay.com/wcc/purchase" method="POST">
                <!--<input type="hidden" name="testMode" value="100" />-->
                <input type="hidden" name="instId" value="1262462">
                <input type="hidden" name="cartId" value="<?php echo $rand; ?>">
                <input type="hidden" name="amount" value="<?php echo $subtotal; ?>">
                <input type="hidden" name="currency" value="GBP">

                <input type="hidden" name="name" value="<?php echo $client['cardholder_first_name'] . ' ' . $client['cardholder_last_name']; ?>">
                <input type="hidden" name="address1" value="<?php echo $client['cardholder_address']; ?>">
                <input type="hidden" name="address2" value="<?php echo $client['cardholder_area']; ?>">
                <input type="hidden" name="town" value="<?php echo $client['cardholder_city']; ?>">
                <!--<input type="hidden" name="region" value="<?php // echo $client['cardholder_country'];        ?>">-->
                <input type="hidden" name="country" value="<?php echo $client['cardholder_country']; ?>">
                <input type="hidden" name="postcode" value="<?php echo $client['cardholder_post_code']; ?>">
                <input type="hidden" name="tel" value="<?php echo $client['cardholder_contact_number']; ?>">
                <input type="hidden" name="email" value="<?php echo $client['cardholder_email']; ?>">


                <div class="col-md-4 col-xs-12 text-center adPad50" style="padding-top:40px;">
                    <button type="submit" class="btn btn-danger btn-red btn-lg">
                        Make Payment
                    </button><br>
                    <h5><strong>Your payment will be processed</strong></h5>
                    <a href="<?php echo base_url('events/cancle_order'); ?>"><strong>Cancel Order</strong></a>
                </div>
            </form>
		



        </div>


    </div>

</div>
</div>


<?php include('includes/footer.php') ?>