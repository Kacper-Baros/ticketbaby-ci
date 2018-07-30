<div class="container-fluid content-bg">
    <div class="container content">        

        <div class="heading col-xs-12">
            <div class="col-md-4 col-xs-12">
                <h1>Order Review</h1>
            </div>
            <div class="col-md-8 col-xs-12 btnVus">
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-g-o">Review</button>
                  </div>
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-g">Sign In</button>
                  </div>
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-g">Billing Details</button>
                  </div>
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-g">Payment</button>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 line2"></div>
        <div class="row no-mar main-content">


            <form method="post" action="<?=base_url()?>index.php/index/billing">
            <?php echo $order_review_view; ?>


            
            <div class="col-xs-12">&nbsp;</div>
            <?php if ( $event["additional_charity"] > 0 ) { ?>
            <div class="col-xs-12 bgBlack">
                <h5><strong>Looking for Hotel?</strong></h5>
            </div>



            <div class="col-xs-12 bgGray"><br>
                <div class="col-xs-12 bgWhite-o">
                    <div class="col-md-4 col-xs-12 adpad bottomPad" style="padding-top:20px;">
                    <img class="img-responsive" src="<?=base_url()?>assets/images/add-to-cart-movie.png">
                    </div>
                <div class="col-md-8 col-xs-12">
                    <p style="padding:20px 10px 10px 10px;">
                    Looking for a hotel? why not check in at our partner hotel. All rooms are designed with a touch of class and relaxation in mind. With the choice of Cosy Standard rooms, Deluxe double, twin and interconnecting rooms, junior or presidential suites, with modern décor rooms with complimentary Wi-Fi, 42” LCD TV, laptop safe, tea & coffee making facilities, black out curtains, quality rain showers and the Park Regis toiletries call 0121 369 5555 and quote ‘Movie, Screen & Video awards’ to receive the special rate of £75.00 bed & breakfast based on single or double occupancy.
                    </p>
                    <div class="col-md-12 col-xs-12">
                    <div class="col-md-8 col-xs-12">
                    &nbsp;
                    </div>
                    <div class="col-md-4 col-xs12 bgGray adpad text-center" style="display:none;">
                    
                    <h3 class="no-mar">&pound; <?php echo $event["additional_charity"]; ?></h3>
                     <?php 
                        $additonal_details_charity_amount = 0; 
                        if( isset($cart_user_session) && isset($cart_user_session["additonal_details"]) ) { 
                                $additonal_details_charity_amount = $cart_user_session["additonal_details"]["charity_amount"];
                        }
                    ?>
                    <!--input type="checkbox" name="additional-charity" price="<//?php //echo $event["additional_charity"] ?>" value="1" </?php// if ($additonal_details_charity_amount > 0) { //?/> checked </?php } ?> /-->
                    
                    </div>
                    </div>
                    <div class="col-xs-12">&nbsp;</div>
                </div>
                </div>
                <div class="col-xs-12">&nbsp;</div>
            </div>


            <?php } ?>


            <div class="col-xs-12">&nbsp;</div>


            <div class="col-xs-12 bgGray"><br/>
                <div class="col-md-6 col-xs-12">
                    <p>
                        Please ensure you review your order all sales are final in the
                        unlikely event of a refund there will be any admin charge.<br/><br/>
                        You may delete any item before you complete your order.<br/><br/>
                        All orders are subject of account approval and billing address verification.
                    </p>
                </div>
                <div class="col-md-6 col-xs-12 text-center">
                    <div class="col-md-6 col-xs-12 text-center hasRightBorder" style="visibility:hidden;">
                        <button class="btn btn-default btn-gray btn-lg">Submit Order</button><br/>
                        <h5>We will save your ticket selections in your basket, but we cannot hold actual tickets.</h5>
                    </div>
                    <div class="col-md-6 col-xs-12 text-center">
                        <button type="submit" class="btn btn-danger btn-red btn-lg">Confirm order</button><br/>
                        <h5>Buy these tickets before time runs out.</h5>
                    </div>
                </div>
            </div>
            </form>

        </div>

    </div> <!-- container ends -->
</div> <!-- Main div ends -->