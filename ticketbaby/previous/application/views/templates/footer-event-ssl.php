<?php $base_url = str_replace('http:', 'https:', base_url()); ?>
<!--search button of footer -->
<div class="container-fluid search-bar">
    <div class="container no-pad">
        <div class="col-md-7 col-sm-7 no-pad search">

        </div>
        <div class="col-md-2 col-sm-1">
        </div>
        <div class="col-md-3 col-sm-3 barclay">

            <h3><i class="glyphicon glyphicon-earphone"></i> 020 329 02710 | <i class="glyphicon glyphicon-envelope" data-toggle="modal" data-target="#myModal"></i></h3>
        </div>

    </div>
</div>
<div class="container-fluid search-bar">
    <div class="container no-pad">
        <div class="row">
            <div class="col-xs-12 text-right iconz">

            </div>
        </div>
    </div>
</div>
<!--
<div class="container-fluid search-bar">
  <div class="container no-pad">
      <div class="col-md-8 col-sm-8 no-pad search">
        </div>
        <div class="col-md-2 col-sm-1"></div>
        <div class="col-md-2 col-sm-3 barclay">
          <img src="<?= $base_url ?>assets/images/barclay.png" />
        </div>
    </div>
</div>
-->
<div class="container-fluid orange-strip footer">
    <div class="container">
        <div class="col-md-4 col-sm-4 footer-logo">

        </div>
        <div class="col-md-8 col-sm-12 footer-right">
            <div class="col-md-3 col-sm-3 promotars">
                <h1>Information</h1>
                <ul>
                    <li><a href="http://ticketbaby.co.uk/index.php/terms_conditions">Terms and Conditions</a></li>
                    <li><a href="http://ticketbaby.co.uk/index.php/privacy-policy">Privacy Policy</a></li>
                    <li><a href="http://ticketbaby.co.uk/index.php/deliveries">Deliveries</a></li>
                    <li><a href="http://ticketbaby.co.uk/index.php/index/contactus">Contact Us</a></li>
                    <?php
                    /*
                      $footer_page  = $this->page_model->get_pages_footer();
                      $url_s	=	$base_url.'index.php/';
                      foreach($footer_page as $_footer_page){
                      $title		=	strtolower($_footer_page['cms_title']);
                      $cms_title	=	ucwords($title);
                      echo " <li><a href='{$url_s}{$_footer_page['cms_page']}'>{$cms_title}</a></li>";
                      }
                     */
                    ?>

                    <!--li><a href="javascript:void(0);">Login</a></li-->
                    <li><a href="javascript:void(0);">Sell Tickets</a></li>    
                </ul>
            </div>
            <div class="col-md-3 col-sm-3 promotars">
                <h1>Customers</h1>
                <ul>
                    <li><a href="<?= base_url() ?>index.php/user/login">Login</a></li>
                      <!--li><a href="<?= base_url() ?>index.php/terms_conditions">Terms & Conditions</a></li-->
                                          <!--li><a href="<?= base_url() ?>index.php/user/registration">Registration</a></li-->
                    <li><a href="javascript:void(0);">Track you order</a></li>
                    <li><a href="javascript:void(0);">Your E-Ticket code</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3 promotars">
                <h1>Site Links</h1>
                <ul>
                    <li><a href="javascript:void(0);">Home</a></li>
                    <li><a href="javascript:void(0);">About Us</a></li>
                    <li><a href="javascript:void(0);">Help</a></li>
                    <li><a href="javascript:void(0);">Careers</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3 promotars">
                <h1>Services</h1>
                <ul>
                    <li><a href="javascript:void(0);">Marketing</a></li>
                    <li><a href="javascript:void(0);">Event Management</a></li>
                    <li><a href="javascript:void(0);">PR</a></li>
                    <li><a href="javascript:void(0);">Promotions</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid top-strip footer-most">
    <div class="container no-pad">
        <div class="col-lg-4 col-sm-2 social-icon footer-social">
            <a href="javascript:void(0);"><img src="<?= $base_url ?>assets/images/fb.png" /></a>
            <a href="javascript:void(0);"><img src="<?= $base_url ?>assets/images/twtr.png" /></a>
            <a href="javascript:void(0);"><img src="<?= $base_url ?>assets/images/pin.png" /></a>
        </div>
        <div class="col-lg-2 col-sm-1 text-left col-md-pull-4" style="color:#fff;">
            <img src="<?= $base_url ?>assets/images/uk.png"/> United Kingdom
        </div>
        <div class="col-md-6 col-sm-9 copyrights text-right">
            <p>Ticketbaby.co.uk All rights reserved 2015</p>
            <a href="javascript:void(0);"><img src="<?= $base_url ?>assets/images/footer-arrow.png" class="scroll-top-top" id="scroll-top-top" /></a>
        </div>
    </div>
</div>





<div class="modal fade" id="ticketSelect" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="choose-table-seat">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Choose Table</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="choose-table-seat">Select Tickets</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php if (isset($current_view) && $current_view == "EVENTDETAIL") { ?>
    <div class="modal fade" id="captchaSelect" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form class="captcha-select" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Verify</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning alert-error-captcha-select">
                            <strong>Error!</strong> You can't leave Captcha Code empty!.
                        </div>
                        <div class="g-recaptcha" data-theme="light" data-sitekey="<?= $siteKey; ?>"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="captcha-verify">Continue</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php } ?>


<div class="modal fade" id="ticketClassTooltip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <div class="modal-title-standard">STANDARD PACKAGE: <img src="<?= $base_url ?>assets/images/standard.jpg" width="580" height="166"></div>
                    <div class="modal-title-premium">PREMIUM PACKAGE:<img src="<?= $base_url ?>assets/images/premiun.jpg" width="580" height="166"></div>
                    <div class="modal-title-gold">GOLD PACKAGE:<img src="<?= $base_url ?>assets/images/gold.jpg" width="580" height="166"></div>
                    <div class="modal-title-vip">PLATINUM PACKAGE VIP:<img src="<?= $base_url ?>assets/images/vipPlatinum.jpg" width="580" height="166"></div>
                    <div class="modal-title-afterparty">AFTER PARTY TICKET:</div>
                    <div class="modal-title-afterpartyticket">AFTER PARTY TICKET:</div>

                </h4>
            </div>
            <div class="modal-body">
                <div class="modal-body-standard">
                    <span class="modaltitle">*10 per Table</span><br>
                    This is our economy package where you can enjoy this year's Movie Video & Screen Awards at an affordable price. 
                    For those on a budget, it's the best value gala ticket in town. You have the option of buying single tickets or a table<br><br>

                    <span class="modalltitle"> So what do you get with this package?</span><br>
                    Your ticket includes a three course first class meal, pre RECEPTION and the AWARDS Ceremony and evening's entertainment.
                    Tables are sold on a first come first served basis so please purchase your tickets or table 
                </div>

                <div class="modal-body-premium">
                    <span class="modaltitle">*10 per Table</span><br>
                    Our Premium Package is just a step down from our Gold package. You and your friends can enjoy the night out 
                    at the MViSAs at an affordable price with all the benefits. This is our most popular package and sells really fast<br><br>


                    <span class="modalltitle"> So what do you get with this package?</span><br>
                    You will enjoy all that the MViSAs have to offer, The Premium package will afford you entry into the event with good seating
                    location, just behind the Gold arena. You will be served an exclusive 3 course Michelin star Caribbean inspired dinner
                    You will also be treated to 2 bottles of wine at your table
                </div>

                <div class="modal-body-gold">
                    <span class="modaltitle">*10 per Table</span><br>
                    Experience the MViSA's in grand style with our Gold table package. This is one of our exclusive table packages with limited 
                    availability.<br><br>


                    <span class="modalltitle"> So what do you get with this package?</span><br>
                    You will enjoy all the MViSAs have to offer. The Gold package will afford you priority entry to the event with prime seated 
                    location, just behind the VIP Platinum area you will be so close you can almost reach and touch the stars. You will be served 
                    an exclusive 3 course Michelin star Caribbean inspired meal. Your meal will include 2 bottles of the finest sparkling wine 
                    and waiter service. With this package, you will also get 2 tickets to the exclusive after-Party
                </div>

                <div class="modal-body-vip">
                    <span class="modaltitle">*10 per Table</span><br>
                    Experience our exclusive MViSA Platinum VIP table package. This is one of our exclusive table packages and is limited. 
                    Our VIP packages are sold on request only<br><br>


                    <span class="modalltitle"> So what do you get with this package?</span><br>
                    You will enjoy all the benefits of the Celebrities and Stars, on the night and you will feel like a celebrity yourself. 
                    The VIP package will afford you VIP entry into the event with exclusive access to the VIP area where you will mingle 
                    with the stars and VIPs. You will be seated in a PRIME table location in the Platinum area just behind the stars. We are 
                    sure you will find something to tantalise your taste buds from our delectable 3 course Michelin star inspired menu, 
                    You will also be treated to our diamond bottled CHAMPAGNE,and waiter service plus free entry to the exclusive 
                    after-Party
                </div>

                <div class="modal-body-afterparty">
                    <span class="modaltitle">*Please note you will be only admitted to after party if you have a valid awards show ticket </span><br>
                    Do Not purchase after party tickets if you done have a valid MVISA Ticket
                </div>

                <div class="modal-body-afterpartyticket">
                    <span class="modaltitle">*Please note you will be only admitted to after party if you have a valid awards show ticket </span><br>
                    Do Not purchase after party tickets if you done have a valid MVISA Ticket
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="userRegisterConfirmedToolTip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <div class="modal-title-afterparty">Account Created Successfully!</div>

                </h4>
            </div>
            <div class="modal-body">

                <div class="modal-body-afterparty">
                    <span class="modaltitle">You have been registered to <?= $this->config->item('site_admin_title'); ?></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- jQuery -->

<!-- Bootstrap Core JavaScript -->
<script src="<?= $base_url ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!--
<script type="text/javascript" src="<?= $base_url ?>assets/jquery/jquery.flexisel.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $("#flexiselDemo1").flexisel();
}); 
</script>
-->
<script src="<?= $base_url ?>assets/bootstrap/js/bootstrap-select.min.js"></script>
<script src="<?= $base_url ?>assets/bootstrapvalidator/bootstrapValidator.min.js"></script>
<script src="<?= $base_url ?>assets/bootstrap/js/owl.carousel.min.js"></script>
<script src="<?= $base_url ?>assets/bootstrap/js/jscript.js"></script>
<script src="<?= $base_url ?>assets/js/t-baby.min.js"></script>
<script src="<?= $base_url ?>assets/js/new-t-baby.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>jss/jquery.flexisel.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        $("#flexiselDemo1").flexisel();
    });
</script>
<script type="text/javascript">
    $(window).load(function() {
        TBABY.init({
            base_url: "<?= $base_url ?>",
            c_view: "<?php echo isset($current_view) ? $current_view : '' ?>",
            cctr: "<?php echo isset($cart_captcha_time_remaining) ? $cart_captcha_time_remaining : 0 ?>"
        });
    });
</script>

</body>
</html> 