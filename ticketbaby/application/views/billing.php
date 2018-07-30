<?php include('includes/header.php') ?>
<div class="container">
    <div class="row no-mar main-content">
        <div class="row">
            <div class="heading col-xs-12">
                <div class="col-md-4 col-xs-12">
                    <h1 class="payment_title">BILLING DETAILS</h1>
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
                            <button type="button" class="btn btn-headers">Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        
        if ($this->session->userdata('coupen_value') != '') {
            if ($this->session->userdata('coupen_type') == '3') {
                $url = site_url('awards/payment_discount/' . $order_details->event_id);
            }else{
                 $url = site_url('awards/payment/'.$order_details->event_id);
            }
        } else {
            $url = site_url('awards/payment/'.$order_details->event_id);
        }
        ?>

        <form method="post" action="<?php echo $url; ?>">
            <div class="col-md-4 col-sm-4 left-sidebar">
                <div class="main-thumb">
                    <img class="order_thumb_image" src="<?php echo base_url('uploads/images/medium/'.$order_details->image) ?>" alt="">
                </div>  
            </div>
            <!-- Col-md-8 -->
            <div class="col-md-8 col-sm-8">
                <div class=" col-md-6 col-xs-12 movie-video-heading">
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
                        <?php 
							   $sessions = $this->session->userdata('tables'); 
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
							?>
							
							<?php
							$sm = 0;
							$price_seats = 0;
							$t = 0;
							foreach ($sessions as $so) {
								if ($so['section'] == 'Table Tickets') {
									$price = count(@$so['table']) * $so['table_charge'];
									foreach ($so['seat'] as $key => $val) {
										if ($val != 0) {
											$price_seats = $val * (@$so['seat_charge']);
											$sm += $price_seats;
										}
									}
								}
								$t += $price;
							}
							@$total_price = $t + $sm;
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
									 
                                    $z = 1;
                                    foreach ($sessions as $s) {
                                        ?>
                                        <ul>
                                            <li class="col-md-1"><?php //echo $z; ?></li>
                                            <li class="col-md-3 col-xs-3"><?php echo $s['class']; ?></li>
                                            <li class="col-md-3 col-xs-3"><?php echo $s['section']; ?></li>

                                            <?php if ($s['section'] == 'Tables Only' || ($s['section'] == 'Table Tickets' && @$s['table']!='')) { ?>
                                                <li class="col-md-3 col-xs-4"><span style="font-weight:100;"></span> (<?php echo count(@$s['table']) ?> * <?php echo $s['table_charge'] ?>)</li>
                                            <?php } else if($s['section'] == 'Table Tickets'){ ?>
                                                <li class="col-md-3 col-xs-4"><span style="font-weight:100;"></span>
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
								 
								if (!empty($ses)) 
								{ 
									?>
                                        <ul class="aparty">
                                     <?php 
										$after_party_price="";
									    foreach($ses['after_party'] as $key=>$val)
										{
									?>		
                                            <li class="col-md-1"> <?php //echo $key; ?></li>
                                            <li class="col-md-3 col-xs-3"><?php echo $ses['after_party'][$key]['name']; ?></li>
                                            <li class="col-md-3 col-xs-3">Additional</li>
                                            <li class="col-md-3 col-xs-4"><span style="font-weight:100;"></span> (<?php echo $ses['after_party'][$key]['seat_charge']; ?> * <?php echo $ses['after_party'][$key]['total']; ?>)</li>
                                            <li class="col-md-2 col-xs-3">£ <?php echo  $ses['after_party'][$key]['seat_charge'] * $ses['after_party'][$key]['total']; ?>
                                            								<?php   $after_party_price = $after_party_price + $ses['after_party'][$key]['seat_charge'] * $ses['after_party'][$key]['total']; ?>				
                                            </li>
                                            <div class="clearfix"></div>
                                     <?php }
											//$total_price = $after_party_price;
									 ?>       
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
									 } 
										//$total_price = $tickets_price;
									 ?>       
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
                                            Fulfilment Fees (+)  &pound; <?php echo $order_details->fulfillment_fee ?>
                                        </td>
                                    <?php } else { ?>
                                        <td>Fulfilment Fees (+)  <?php echo $order_details->fulfillment_fee ?> % </td>
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
                                        @$discount = $total_price;
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
                                    <?php } else { ?>
                                        <td>
                                            Credit Card Charges (+) <?php echo $order_details->creditcard_fee; ?> %
                                        </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><span class="seating-chart-popup"><strong>Seating Chart</strong></span></td> 
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

                    <?php
                    /*if ($order_details->creditcard_status == 0) {
                        @$creditcard_price = $order_details->creditcard_fee;
                    } else {
                        @$creditcard_price = ($order_details->creditcard_fee / 100) * $total_price;
                    }*/
                    ?>

                    <?php /*?><div class="col-xs-12 text-center bgWhite allBorders borderdiv">
                        <h4>Ticket</h4>
                        <h4>Price - £ <?php echo @sprintf('%.2f', $total_price); ?></h4>
                    </div><?php */?>
                    
                    <div class="col-xs-12 text-center bgWhite noBorders">
                        <?php
								$subtotal = '';
								$subtotal1 = '';						
                        if ($this->session->userdata('coupen_value') != '') {
                            if ($this->session->userdata('coupen_type') == 3)
							 {
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
                            <span id="subTotalSpan"><?php echo @sprintf('%.2f', $subtotal) ?></span></h4>  
                        <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>" id="subTotalPass">
                    </div>

                </div>
            </div>


            <div class="col-xs-12 bgBlack">
                <h5><strong>Enter Customer Details</strong></h5>
            </div>

            <div class="col-xs-12 bgGray"><br>
                <div class="billing-details"> 
                    <div class="form-group cus-form has-feedback">
                        <div class="col-xs-12">
                            <label class="col-md-3 col-xs-12">First Name<span class="textRed">*</span></label>
                            <div class="col-md-4 col-xs-12 col-md-pull-1">
                                <input required  autocomplete="off" type="text" class="form-control" name="customer_first_name" value="<?php echo set_value('customer_first_name'); ?>" data-bv-field="customer_first_name"><i class="form-control-feedback bv-no-label" data-bv-icon-for="customer_first_name" style="display: none;"></i>     
                                <small class="formerror"><?php echo form_error('customer_first_name') ?></small></div><br><br>
                        </div>
                        <div class="col-xs-12">
                            <label class="col-md-3 col-xs-12">Last Name<span class="textRed">*</span></label>
                            <div class="col-md-4 col-xs-12 col-md-pull-1">
                                <input required   autocomplete="off" type="text" class="form-control" name="customer_last_name" value="<?php echo set_value('customer_last_name'); ?>" data-bv-field="customer_last_name"><i class="form-control-feedback bv-no-label" data-bv-icon-for="customer_last_name" style="display: none;"></i>
                                <small class="formerror"><?php echo form_error('customer_last_name') ?></small></div><br><br>
                        </div>
                        <div class="col-xs-12">
                            <label class="col-md-3 col-xs-12">Email<span class="textRed">*</span></label>
                            <div class="col-md-4 col-xs-12 col-md-pull-1">
                                <input required  autocomplete="off" type="email" class="form-control" name="customer_email" value="<?php echo set_value('customer_email'); ?>" data-bv-field="customer_email"><i class="form-control-feedback" data-bv-icon-for="customer_email" style="display: none;"></i>
                                <small class="formerror"><?php echo form_error('customer_email') ?></small></div><br><br>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xs-12 bgBlack">
                <h5><strong>Enter Billing Details</strong></h5>
            </div>

            <div class="col-xs-12 bgGray"><br>
                <h5>Your order my be cancelled without notice if you do not use the exact billing address of your card.</h5>
                <p class="textRed">* = Required Text</p>
                <p class="textRed"><strong>Enter the Card Holder first and last name exactly as it appears on your card statement.</strong></p>
                <div class="billing-details"> 
                    <div class="form-group cus-form has-feedback">
                        <div class="col-xs-12">
                            <label class="col-md-3 col-xs-12">Card Holder First Name<span class="textRed">*</span></label>
                            <div class="col-md-4 col-xs-12 col-md-pull-1">
                                <input required  autocomplete="off" type="text" class="form-control" name="cardholder_first_name" value="<?php echo set_value('cardholder_first_name'); ?>" data-bv-field="first_name"><i class="form-control-feedback bv-no-label" data-bv-icon-for="first_name" style="display: none;"></i>     
                                <small class="formerror"><?php echo form_error('cardholder_first_name') ?></small></div><br><br>
                        </div>
                        <div class="col-xs-12">
                            <label class="col-md-3 col-xs-12">Card Holder Last Name<span class="textRed">*</span></label>
                            <div class="col-md-4 col-xs-12 col-md-pull-1">
                                <input required   autocomplete="off" type="text" class="form-control" name="cardholder_last_name" value="<?php echo set_value('cardholder_last_name'); ?>" data-bv-field="last_name"><i class="form-control-feedback bv-no-label" data-bv-icon-for="last_name" style="display: none;"></i>
                                <small class="formerror"><?php echo form_error('cardholder_last_name') ?></small></div><br><br>
                        </div>
                        <div class="col-xs-12">
                            <label class="col-md-3 col-xs-12">Email<span class="textRed">*</span></label>
                            <div class="col-md-4 col-xs-12 col-md-pull-1">
                                <input required  autocomplete="off" type="email" class="form-control" name="cardholder_email" value="<?php echo set_value('cardholder_email'); ?>" data-bv-field="email"><i class="form-control-feedback" data-bv-icon-for="email" style="display: none;"></i>
                                <small class="formerror"><?php echo form_error('cardholder_email') ?></small></div><br><br>
                        </div>
                        <div class="col-xs-12">
                            <label class="col-md-3 col-xs-12">Address<span class="textRed">*</span></label>
                            <div class="col-md-4 col-xs-12 col-md-pull-1">
                                <input required  autocomplete="off" type="text" class="form-control" name="cardholder_address" value="<?php echo set_value('cardholder_address'); ?>" data-bv-field="address"><i class="form-control-feedback bv-no-label" data-bv-icon-for="address" style="display: none;"></i>
                                <small class="formerror"><?php echo form_error('cardholder_address') ?></small> </div><br><br>
                        </div>
                        <div class="col-xs-12">
                            <label class="col-md-3 col-xs-12">Area<span class="textRed">*</span></label>
                            <div class="col-md-4 col-xs-12 col-md-pull-1">
                                <input required  autocomplete="off" type="text" class="form-control" name="cardholder_area" value="<?php echo set_value('cardholder_area'); ?>" data-bv-field="area"><i class="form-control-feedback bv-no-label" data-bv-icon-for="area" style="display: none;"></i>
                                <small class="formerror"><?php echo form_error('cardholder_area') ?></small></div><br><br>
                        </div>
                        <div class="col-xs-12">
                            <label class="col-md-3 col-xs-12">City<span class="textRed">*</span></label>
                            <div class="col-md-4 col-xs-12 col-md-pull-1">
                                <input required  autocomplete="off" type="text" class="form-control" name="cardholder_city" value="<?php echo set_value('cardholder_city'); ?>" data-bv-field="city"><i class="form-control-feedback bv-no-label" data-bv-icon-for="city" style="display: none;"></i>
                                <small class="formerror"><?php echo form_error('cardholder_city') ?></small></div><br><br>
                        </div>

                        <div class="col-xs-12">
                            <label class="col-md-3 col-xs-12">Postcode<span class="textRed">*</span></label>
                            <div class="col-md-4 col-xs-12 col-md-pull-1">
                                <input required  autocomplete="off" type="text" class="form-control" name="cardholder_post_code" value="<?php echo set_value('cardholder_post_code'); ?>" data-bv-field="post_code"><i class="form-control-feedback bv-no-label" data-bv-icon-for="post_code" style="display: none;"></i>
                                <small class="formerror"><?php echo form_error('cardholder_post_code') ?></small>  </div><br><br>
                        </div>
                        <div class="col-xs-12">
                            <label   class="col-md-3 col-xs-12">Country<span class="textRed">*</span></label>
                            <div class="col-md-4 col-xs-12 col-md-pull-1">
                                <input required autocomplete="off" type="text" class="form-control country-class" name="cardholder_country" value="United Kingdom" placeholder="United Kingdom">
                            </div>
                            <div class="col-md-5 col-xs-12 col-md-pull-1">
                                Address in a different country?<br>
                                <a href="#">Choose a delivery method for your area.</a>
                            </div>
                            <br><br>
                        </div>
                        <div class="col-xs-12">
                            <label class="col-md-3 col-xs-12">Phone<span class="textRed">*</span></label>
                            <div class="col-md-4 col-xs-12 col-md-pull-1">
                                <input required autocomplete="off" type="text" class="form-control" name="cardholder_contact_number" value="<?php echo set_value('cardholder_contact_number'); ?>" data-bv-field="contact_number"><i class="form-control-feedback bv-no-label" data-bv-icon-for="contact_number" style="display: none;"></i>
                                <small class="formerror"><?php echo form_error('cardholder_contact_number') ?></small> </div>
                            <div class="col-md-5 col-xs-12 col-md-pull-1">
                                Include Area Code
                            </div>
                            <br><br>
                        </div>
                        <div class="col-xs-12">
                            <label class="col-md-3 col-xs-12">Mobile Phone</label>
                            <div class="col-md-4 col-xs-12 col-md-pull-1">
                                <input autocomplete="off" type="text" class="form-control" name="cardholder_mobile_number" value="<?php echo set_value('cardholder_mobile_number'); ?>">
                                <small class="formerror"><?php echo form_error('cardholder_mobile_number') ?></small>

                            </div>
                            <div class="col-md-5 col-xs-12 col-md-pull-1">
                                Including a mobile number will enable us to contact you about your order via text*.<br>
                                *Texts to UK mobile within the UK or Irish mobiles within Ireland are free. Texts to overseas mobile, UK mobile outside the UK or Irish mobile outside Ireland may incur a charge.
                            </div>
                            <br><br>
                        </div>
                        <!--
                        <div class="col-xs-12"><br/><Br/>
                              <div class="checkbox">
                                    <label>
                                      <input type="checkbox">
                                      Stor my card and billing information in your secure system to make future purchases faster and easier. You will have the opportunity later in the process to manage your account settings. <a href="#">Privacy Policy</a>
                                    </label>
                              </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>





            <div class="col-xs-12 bgGray"><br>
                <div class="col-md-6 col-xs-12">
<!--                    <p>
                        Please ensure you review your order all sales are final in the
                        unlikely event of a refund there will be any admin charge.<br><br>
                        You may delete any item before you complete your order.<br><br>
                        All orders are subject of account approval and billing address verification.
                    </p>-->
                </div>
                <div class="col-md-6 col-xs-12 text-center">
                    <div class="col-md-6 col-xs-12 text-center hasRightBorder" style="visibility:hidden;">
                        <button class="btn btn-default btn-gray btn-lg">Submit Order</button><br>
                        <h5>We will save your ticket selections in your basket, but we cannot hold actual tickets.</h5>
                    </div>

                    <div class="col-md-6 col-xs-12 text-center">
                        <button type="submit" class="btn btn-danger btn-red btn-lg">Submit order</button><br>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>


<?php include('includes/footer.php') ?>