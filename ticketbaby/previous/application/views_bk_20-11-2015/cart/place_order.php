<?php
    if ( isset($cart_user_session) && isset($cart_user_session['user_details']) ) {
        $current_user = $cart_user_session['user_details'];
    }
?>
<div class="container-fluid content-bg">
  <div class="container content">
      <div class="heading col-xs-12">
                  <div class="col-md-4 col-xs-12">
                        <h1>Billing Details</h1>
                  </div>
                  <div class="col-md-8 col-xs-12 btnVus">
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                          <div class="btn-group" role="group">
                              <button type="button" class="btn btn-default btn-g">Review</button>
                          </div>
                          <div class="btn-group" role="group">
                              <button type="button" class="btn btn-default btn-g">Sign In</button>
                          </div>
                          <div class="btn-group" role="group">
                              <button type="button" class="btn btn-default btn-g">Billing Details</button>
                          </div>
                          <div class="btn-group" role="group">
                              <button type="button" class="btn btn-default btn-g-o">Payment</button>
                          </div>
                        </div>
                  </div>
        </div>
            <div class="col-xs-12 line2"></div>

        <form method="post" action="<?=$form_action;?>">    
        <div class="row no-mar main-content">
            
                  <?php echo $order_review_view; ?>
                 
                  <div class="col-xs-12">&nbsp;</div>
           
                  <div class="col-xs-12 bgBlack">
                        <h5><strong>Conditions</strong></h5>
                  </div>
                  <div class="col-xs-12 bgGray"><br/>
                        <div class="col-md-8 col-xs-12 hasRightBorder">
                        
                              <p class="text-justify">
                                   <p>
                              Tickets or services cannot be exchanged or refunded after purchase please insure you have review and  check you order before confirming it. Please see our purchase policy for details.

Your contract of purchase starts as soon as you have confirmed you purchase and will terminate on the day of the event for which the ticket package and/or associated service is purchased. All transactions are subject to payment card verification checks to insure the security of the card holder.
          <br/> <br/> The transaction maybe terminated if it does not pass our security validation checks. 

To stop ticket scalping we may restrict ticket sales to a maximum number per person and or per household please observe any publish limits for ticket quotas as tickets purchase in excess of the set amount may result in cancelation of the order.

<br/> <br/> Ticket baby collects information about you when you make a purchase This information is collected on behalf of the event organisers or promoter, for the purpose of assisting the organisers to run the event efficiently or in accordance with their private policy. This will also protect you in the case of disputes. We do not share you information with third parties or marketing firms. Please see our private policy   

By clicking Submit you have agreed to the terms and conditions in our purchase policy including refund policy and the organiser contacting you by email or other means in relation to information that may interest you, You may choose to opt out by contact the Organiser directly
                               </p>
                              </p>
                        </div>

                        <div class="col-md-4 col-xs-12">
                            <div style="padding-bottom:10px;"><strong>Billing Information:</strong></div>
                            <div> Name : <?php echo $cart_user_session["billing_details"]["first_name"]. " " . $cart_user_session["billing_details"]["last_name"];?>  </div>
                            <div> Email : <?php echo $cart_user_session["billing_details"]["email"] ?> </div>
                            <div> Address : <?php echo $cart_user_session["billing_details"]["address"] ?> </div>
                            <div> Area : <?php echo $cart_user_session["billing_details"]["area"] ?> </div>
                            <div> City : <?php echo $cart_user_session["billing_details"]["city"] ?> </div>
                            <div> Post Code : <?php echo $cart_user_session["billing_details"]["post_code"] ?> </div>
                            <div> Contact Number : <?php echo $cart_user_session["billing_details"]["contact_number"] ?> </div>
                        </div>

                        <div class="col-md-4 col-xs-12 text-center adPad50" style="padding-top:40px;">
                              <button type="submit" class="btn btn-danger btn-red btn-lg">
                              <?php if ( isset($coupon_details) && $coupon_details["coupon_type"] == "FREE" ) { ?>
                              Place Order
                              <?php } else { ?>
                              Make Payment
                              <?php } ?>
                              </button><br/>
                              <h5><strong>Your payment will be prcessed</strong></h5>
                              <a href="<?=base_url()?>"><strong>Cancel Order</strong></a>
                        </div>
                  </div>
        </div>


         <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo $sub_total_price; ?>"/> 
            <input type="hidden" name="CN" value="<?php echo $order_post_details["CustomerName"]; ?>"> 
            <input type="hidden" name="COM" value="<?php echo $order_post_details["OrderDataRaw"]; ?>">
            <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $order_post_details["CurrencyCode"]; ?>"/>
            <input type="hidden" name="EMAIL" id="EMAIL" value="<?php echo $order_post_details["ShopperEmail"]; ?>">
            <input type="hidden" name="FONTTYPE" id="FONTTYPE" value="<?php echo $order_post_details["FONTTYPE"]; ?>">
            <input type="hidden" name="LANGUAGE" id="LANGUAGE" value="<?php echo $order_post_details["ShopperLocale"]; ?>">
            <input type="hidden" name="LOGO" value="<?php echo $order_post_details["LOGO"]; ?>">
            <input type="hidden" name="ORDERID" id="ORDERID" value="<?php echo $order_post_details["OrderID"] ?>"/> 
            <input type="hidden" name="OWNERADDRESS" id="OWNERADDRESS" value="<?php echo $order_post_details["Addressline1n2"]; ?>">
            <input type="hidden" name="OWNERCTY" id="OWNERCTY" value="<?php echo $order_post_details["BillCountry"]; ?>">
            <input type="hidden" name="OWNERTELNO" value="<?php echo $order_post_details["ContactTel"]; ?>"> 
            <input type="hidden" name="OWNERTOWN" id="OWNERTOWN" value="<?php echo $order_post_details["BillTown"]; ?>">
            <input type="hidden" name="OWNERZIP" id="OWNERZIP" value="<?php echo $order_post_details["Pcde"]; ?>">
            <input type="hidden" name="PMLISTTYPE" id="PMLISTTYPE" value="<?php echo $order_post_details["PMLISTTYPE"] ?>"/>                       
            <input type="hidden" name="PSPID" id="PSPID" value="<?php echo $order_post_details["PSPID"] ?>"/>
            <input type="hidden" name="BGCOLOR" id="BGCOLOR" value="<?php echo $order_post_details["BGCOLOR"]; ?>"/>
            <input type="hidden" name="BUTTONBGCOLOR" id="BUTTONBGCOLOR" value="<?php echo $order_post_details["BUTTONBGCOLOR"]; ?>"/>
            <input type="hidden" name="BUTTONTXTCOLOR" id="BUTTONTXTCOLOR" value="<?php echo $order_post_details["BUTTONTXTCOLOR"]; ?>"/>
            <input type="hidden" name="TBLBGCOLOR" id="TBLBGCOLOR" value="<?php echo $order_post_details["TBLBGCOLOR"]; ?>"/>
            <input type="hidden" name="TBLTXTCOLOR" id="TBLTXTCOLOR" value="<?php echo $order_post_details["TBLTXTCOLOR"]; ?>">
            <input type="hidden" name="TITLE" id="TITLE" value="<?php echo $order_post_details["TITLE"]; ?>"/>
            <input type="hidden" name="TXTCOLOR" id="TXTCOLOR" value="<?php echo $order_post_details["TXTCOLOR"]; ?>">
            <input type="hidden" name="SHASign" value="<?php echo $order_post_details["strHashedString_plain"]; ?>">
            <input type="hidden" name="coupon_code" value="<?php echo $coupon_details["coupon_code"]; ?>">
            <input type="hidden" name="coupon_type" value="<?php echo $coupon_details["coupon_type"]; ?>">
            <input type="hidden" name="coupon_value" value="<?php echo ($coupon_details["coupon_value"]*100); ?>">
        </form>

    </div> <!-- container ends -->
</div> <!-- Main div ends -->
























