<?php
    if ( isset($cart_user_session) && isset($cart_user_session['billing_details']) ) {
        $billing_details = $cart_user_session['billing_details'];
    }

    if ( isset($cart_user_session) && isset($cart_user_session['user_details']) ) {
        $user_details     = $cart_user_session['user_details'];
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
                        <button type="button" class="btn btn-default btn-g-o">Billing Details</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-g">Payment</button>
                    </div>
                  </div>
            </div>
    </div>
    <div class="col-xs-12 line2"></div>


        <form id="form-billing-info" class="form-horizontal" role="form" method="post" action="<?=base_url()?>index.php/index/order">    
        <div class="row no-mar main-content">
           
                  <?php echo $order_review_view; ?>

                  <div class="col-xs-12">&nbsp;</div>

                  <!--
                  <div class="col-xs-12 bgBlack">
                        <h5><strong>Promo Code</strong></h5>
                  </div>

                  
                  <div class="col-xs-12 bgGray"><br/>
                      <div class="billing-details"> 
                            <div class="form-group cus-form">
                            <div class="col-xs-12">
                                  <label class="col-md-3 col-xs-12">Promo Code</label>
                                  <div class="col-md-4 col-xs-12 col-md-pull-1">
                                  <input type="text" class="form-control" name="customer_promo_code" value="<?php echo ($cart_captcha_session && $cart_captcha_session["event_customer_details"]) ? $cart_captcha_session["event_customer_details"]["customer_promo_code"] : ""; ?>" />     
                                  </div><br/><Br/>
                            </div>
                            </div>
                      </div>
                  </div>
                  -->

                  <div class="col-xs-12 bgBlack">
                        <h5><strong>Enter Customer Details</strong></h5>
                  </div>
                  <div class="col-xs-12 bgGray"><br/>
                      <div class="billing-details"> 
                            <div class="form-group cus-form">
                            <div class="col-xs-12">
                                  <label class="col-md-3 col-xs-12">First Name<span class="textRed">*</span></label>
                                  <div class="col-md-4 col-xs-12 col-md-pull-1">
                                  <input autocomplete="off" type="text" class="form-control" name="customer_first_name" value="<?php echo isset($user_details) ? $user_details['customer_first_name'] : ''?>" />     
                                  </div><br/><Br/>
                            </div>
                            <div class="col-xs-12">
                                  <label class="col-md-3 col-xs-12">Last Name<span class="textRed">*</span></label>
                                  <div class="col-md-4 col-xs-12 col-md-pull-1">
                                  <input autocomplete="off" type="text" class="form-control" name="customer_last_name" value="<?php echo isset($user_details) ? $user_details['customer_last_name'] : ''?>" />
                                  </div><br/><Br/>
                            </div>
                             <div class="col-xs-12">
                                  <label class="col-md-3 col-xs-12">Email<span class="textRed">*</span></label>
                                  <div class="col-md-4 col-xs-12 col-md-pull-1">
                                  <input autocomplete="off" type="email" class="form-control" name="customer_email" value="<?php echo isset($user_details) ? $user_details['customer_email'] : ''?>" />
                                  </div><br/><Br/>
                            </div>
                            </div>
                      </div>
                  </div>

                  <div class="col-xs-12 bgBlack">
                        <h5><strong>Enter Billing Details</strong></h5>
                  </div>
                  <div class="col-xs-12 bgGray"><br/>
                        <h5>Your order my be cancelled without notice if you do not use the exact billing address of your card.</h5>
                        <p class="textRed">* = Required Text</p>
                        <p class="textRed"><strong>Enter the Card Holder first and last name exactly as it appears on your card statement.</strong></p>
                        <div class="billing-details"> 
                              <div class="form-group cus-form">
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Card Holder First Name<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="text" class="form-control" name="first_name" value="<?php echo isset($billing_details) ? $billing_details['first_name'] : ''?>" />     
                                          </div><br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Card Holder Last Name<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="text" class="form-control" name="last_name" value="<?php echo isset($billing_details) ? $billing_details['last_name'] : ''?>" />
                                          </div><br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Email<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="email" class="form-control" name="email" value="<?php echo isset($billing_details) ? $billing_details['email'] : ''?>" />
                                          </div><br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Address<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="text" class="form-control" name="address" value="<?php echo isset($billing_details) ? $billing_details['address'] : ''?>"  />
                                          </div><br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Area<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                            <input autocomplete="off" type="text" class="form-control" name="area" value="<?php echo isset($billing_details) ? $billing_details['area'] : ''?>"  />
                                          </div><br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">City<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                            <input autocomplete="off" type="text" class="form-control" name="city" value="<?php echo isset($billing_details) ? $billing_details['city'] : ''?>"  />
                        
                                          </div><br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Postcode<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="text" class="form-control" name="post_code" value="<?php echo isset($billing_details) ? $billing_details['post_code'] : ''?>"  />
                                          </div><br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Country<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="text" class="form-control" placeholder="Great Britain" disabled/>
                                          </div>
                                          <div class="col-md-5 col-xs-12 col-md-pull-1">
                                                Address in a different country?<br/>
                                                <a href="#">Choose a delivery method for your area.</a>
                                          </div>
                                          <br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Phone<span class="textRed">*</span></label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="text" class="form-control" name="contact_number" value="<?php echo isset($billing_details) ? $billing_details['contact_number'] : ''?>" />
                                          </div>
                                          <div class="col-md-5 col-xs-12 col-md-pull-1">
                                                Include Area Code
                                          </div>
                                          <br/><Br/>
                                    </div>
                                    <div class="col-xs-12">
                                          <label class="col-md-3 col-xs-12">Mobile Phone</label>
                                          <div class="col-md-4 col-xs-12 col-md-pull-1">
                                          <input autocomplete="off" type="text" class="form-control" name="mobile_number" value="<?php echo isset($billing_details) ? $billing_details['mobile_number'] : ''?>" />
                        
                                          </div>
                                          <div class="col-md-5 col-xs-12 col-md-pull-1">
                                                Including a mobile number will enable us to contact you about your order via text*.<br/>
                                                *Texts to UK mobile within the UK or Irish mobiles within Ireland are free. Texts to overseas mobile, UK mobile outside the UK or Irish mobile outside Ireland may incur a charge.
                                          </div>
                                          <br/><Br/>
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
               
                   <div class="col-xs-12">&nbsp;</div>
            <div class="col-xs-12 bgGray"><br/>
                <div class="col-md-6 col-xs-12">
                    <p>
                        &nbsp;
                    </p>
                </div>
                <div class="col-md-6 col-xs-12 text-center">
                    <div class="col-md-6 col-xs-12 text-center hasRightBorder" style="visibility:hidden;">
                        <button class="btn btn-default btn-gray btn-lg">Submit Order</button><br/>
                        <h5>We will save your ticket selections in your basket, but we cannot hold actual tickets.</h5>
                    </div>
                    <div class="col-md-6 col-xs-12 text-center">
                        <button type="submit" class="btn btn-danger btn-red btn-lg">Submit Order</button><br/>
                        <h5>Buy these tickets before time runs out.</h5>
                    </div>
                </div>
            </div>
        </div>
         <input type="hidden" class="form-control" name="customer_promo_code" value="<?php echo ($cart_captcha_session && $cart_captcha_session["event_customer_details"]) ? $cart_captcha_session["event_customer_details"]["customer_promo_code"] : ""; ?>" />     
        </form>
    </div> <!-- container ends -->
</div> <!-- Main div ends -->