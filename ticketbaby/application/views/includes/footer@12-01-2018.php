<div class="container-fluid orange-strip footer">
    <div class="container">
        <div class="col-md-4 col-sm-4 footer-logo">

        </div>
        <div class="col-md-8 col-sm-12 footer-right col-xs-12">
            <div class="col-md-3 col-sm-3 promotars col-xs-6">
                <h1>Information</h1>
                <ul>
                    <li><a href="<?php echo site_url() ?>terms-and-conditions">Terms and Conditions</a></li>
                    <li><a href="<?php echo site_url() ?>privacy-policy">Privacy Policy</a></li>
                    <li><a href="<?php echo site_url() ?>deliveries">Deliveries</a></li>
                    <li><a href="<?php echo site_url() ?>front/contact">Contact Us</a></li>

                    <!--li><a href="#">Login</a></li-->
                    <li><a href="<?php echo site_url() ?>sell-tickets">Sell Tickets</a></li>    
                </ul>
            </div>
            <div class="col-md-3 col-sm-3 promotars col-xs-6">
                <h1>Customers</h1>
                <ul>
                    <li><a href="<?php echo site_url() ?>login">Login</a></li>
                    <li><a href="<?php echo site_url() ?>register">Register</a></li>
                    <li><a href="<?php echo site_url() ?>track-you-order">Track you order</a></li>
                    <li><a href="<?php echo site_url() ?>your-e-ticket-code">Your E-Ticket code</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3 promotars col-xs-6">
                <h1>Site Links</h1>
                <ul>
                    <li><a href="<?php echo site_url() ?>">Home</a></li>
                    <li><a href="<?php echo site_url() ?>about-us">About Us</a></li>
                    <li><a href="<?php echo site_url() ?>help">Help</a></li>
                    <li><a href="<?php echo site_url() ?>careers">Careers</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3 promotars  col-xs-6">
                <h1>Services</h1>
                <ul>
                    <li><a href="<?php echo site_url() ?>marketing">Marketing</a></li>
                    <li><a href="<?php echo site_url() ?>event-management">Event Management</a></li>
                    <li><a href="<?php echo site_url() ?>pr">PR</a></li>
                    <li><a href="<?php echo site_url() ?>promotions">Promotions</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>   

<div class="container-fluid top-strip footer-most">
    <div class="container no-pad">
        <div class="col-lg-4 col-sm-2 social-icon footer-social">
            <a href="#"><img src="<?php echo base_url('assets/images/fb.png') ?>"></a>
            <a href="#"><img src="<?php echo base_url('assets/images/twtr.png') ?>"></a>
            <!--<a href="#"><img src="<?php echo site_url() ?>/assets/images/pin.png"></a>-->
        </div>
        <div class="col-lg-2 col-sm-1 text-left col-md-pull-4" style="color:#fff;">
            <img src="<?php echo base_url('assets/images/uk.png'); ?>"> United Kingdom
        </div>
        <div class="col-md-6 col-sm-9 copyrights text-right">
            <p>Ticketbaby.co.uk All rights reserved 2017</p>
            <a href="#"><img src="<?php echo base_url('assets/images/footer-arrow.png') ?>" class="scroll-top-top" id="scroll-top-top"></a>
        </div>
    </div>
</div>



<script src="<?php echo theme_js('jquery-2.2.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo theme_js('vegas.js'); ?>" type="text/javascript"></script>
<script src="<?php echo theme_js('owl.carousel.js'); ?>" type="text/javascript"></script>
<script src="<?php echo theme_js('bootstrap.js'); ?>" type="text/javascript"></script>
<script src="<?php echo theme_js('easyzoom.js'); ?>" type="text/javascript"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_kJkZ-2C-oS51jmfI4TFoVkVs5Fm3oF8"type="text/javascript"></script>
<script type="text/javascript" src="<?php echo theme_js('jquery.countdownTimer.js'); ?>"></script>

<script language="javascript">
function start_timer(){
        alert(1);
        $('#demo').countdowntimer({
            minutes: 1,
            expiryUrl : "<?php echo base_url('events/expires'); ?>"
        })};
</script>



<?php  if($this->uri->segment(2) == 'booking_post' || $this->uri->segment(2) == 'billing' || $this->uri->segment(2)== 'payment') { ?>
   <script language="javascript">
       
       $( document ).ready(function() {
  		  console.log( "ready!" );
        $('#demo').countdowntimer({
            minutes: 10,
            expiryUrl : "<?php echo base_url('events/expires'); ?>"
        });
	});
   </script>
<?php } ?>



<script language="javascript">
//	 Subcategory ////
$(document).ready(function(){
	$("#Category").change(function(){
	   var  id=$(this).val();
		   $.ajax({
			url:"<?php echo base_url()."Family_trips/SubCategory" ?>",
			type:"POST",
			data:{'id':id},
			success:function(data){
			   $("#SubCategory").html(data);    
			}
		 });
	});
}); 

//slider//////
    $(document).ready(function () {
        $("#owl-demo").owlCarousel({
            autoPlay: 4000, //Set AutoPlay to 3 seconds
            items: 5,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 3],
            nav: true,
            loop: true,
            navigation: true,
            navigationText: ['<i class="fa fa-angle-left sliderleft" aria-hidden="true"></i>', '<i class="fa fa-angle-right sliderright" aria-hidden="true"></i>'],
        });
        $("#owl-demo1").owlCarousel({
            //  autoPlay: 4000, //Set AutoPlay to 3 seconds
            items: 5,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 3],
            // nav: true,
            // loop: true

        });

    });
	
//easyzoom///////////

    $(document).ready(function () {
        $('.easyzoom').easyZoom();
        $(window).on("scroll", function () {
            if ($(window).scrollTop() > 90) {
                $(".menu-section").addClass("menu_fixed");
                $(".menu_fixed").slideDown("slow");
            } else {
                $(".menu-section").removeClass("menu_fixed");
            }

            if ($(window).scrollTop() > 475) {

                $(".menu-section").addClass("menu-block");
                $(".menu_fixed").slideDown("slow");
            } else {
                $(".menu-section").removeClass("menu-block");
            }
        });
    });

	
</script>
</body>
</html>



