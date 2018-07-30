<?php include 'includes/header.php'; ?>
<!-- Comedy starts -->
<style>
/*Css for Comedy Page*/

   
.comedy_title h4 {	color:white;	font-size:28px;	font-weight:bold;	padding:20px 15px;	text-transform:uppercase;	margin-top: 0px;}
.comedy_title {	margin-bottom:20px;}
.comedy_section {	background: #f8f8f8 none repeat scroll 0 0;	padding: 30px 0;}
.side_title {	background: #000 none repeat scroll 0 0;	color: #ff8734;	margin: 0;	padding: 10px 20px;	text-transform: uppercase;}
.event-control {	border-radius: 0;	font-size: 13px;	height: 30px;	padding: 0 5px;	color:#888;}
.form-group.event-group {	margin-bottom: 8px;}
.shop_event {	background: #fff none repeat scroll 0 0;	padding: 15px 20px;}
.event-label {color: #888;float: left;font-weight: normal;	margin-top: 2px;	padding-right: 10px;}
.event-label_1 {color: #888;float: left;font-weight: normal;margin-top: 5px;padding-right: 28px;}
.input-group-addon.event-addon {background: transparent none repeat scroll 0 0 !important;border-color: #ccc;border-radius: 0;color:#FF8734;padding: 0;}
.btn.btn-go {background: #ff8734 none repeat scroll 0 0;color: #fff;font-weight: bold;padding: 5px 15px;text-transform: uppercase;}
.local_venue > h4 {background: #ccc none repeat scroll 0 0;	color: #000;	margin: 0;	padding: 10px 20px;}
.local_venue {	margin-top: 35px;}
.venue_list {	background: #fff none repeat scroll 0 0;	padding:10px 20px;}
.venue_list > ul {	list-style: outside none none;	margin: 0;	padding: 0;}
.venue_list li {	border-bottom: 1px solid #ccc;	margin-bottom: 5px;}
.venue_list a {	color: #ff8734;	font-size: 14px;}
.venue_list p {	font-size: 12px;	color: #888;}
.book_room {	margin-top: 35px;	position: relative;}
.book_text > h4 {	color: #fff;	float: left;	font-size: 20px;	font-weight: bold;	margin: 0;	text-transform: uppercase;}
.book_text > a {	color: #fff;	display: block;	float: right;	font-size: 14px;	font-weight: bold;	text-transform: uppercase;	margin-top:2px;}
.book_text {	background:#33ADE0;	bottom: 0;	left: 0;
	/*opacity: 0.8;*/
    padding: 10px;	position: absolute;	right: 0;}
.brimpide_div img {	width: 100%;}
.brimpide_div > a {	background: #33ade0 none repeat scroll 0 0;	color: #fef303;	display: block;	font-size: 16px;	font-weight: bold;
	padding: 10px;	text-align: center;	text-transform: uppercase;}
.ticket_div {	margin-top: 35px;}
.ticket_div > h4 {	background:#FA028A;	color: #fff;	margin: 0;	padding: 10px;	text-align: center;}
.ticket_div img {	width: 100%;}
.facebook_trend > h4 {	background: #ccc none repeat scroll 0 0;	margin: 0;	padding: 10px 20px;	font-size: 16px;}
.facebook_trend i {	color: blue;	font-size: 25px;	padding-right: 5px;	vertical-align: text-bottom;}
.facebook_trend {	margin-top: 35px;}
.my-tab > li > a {	display: block;	padding: 3px 15px;	position: relative;}
.tab-wrapper {	background: #fff none repeat scroll 0 0;	padding: 10px;}
.my-tab > li > a {	background: #d7dfea none repeat scroll 0 0;	border-radius: 0;	display: block;	padding: 3px 15px;	position: relative;}
.my-tab > li.active > a, .my-tab > li.active > a:hover, .my-tab > li.active > a:focus {	color:#074777;}
.my-tab > li > a:hover, .my-tab > li > a:focus {	background: #d7dfea none repeat scroll 0 0;}
.band_div img {	float: left;	padding-right: 10px;}
.views > h3 {	font-size: 16px;	font-weight: bold;	margin: 0;}
.band_div > a {	font-size: 13px;}
.row.tab-list-wrapper {	margin-top: 20px;}
.views > span {	font-size: 12px;}
.more_link.text-right {	margin-top: 15px;}
.facebook_like {	background: #ccc none repeat scroll 0 0;	margin-top:0px;	padding: 20px;}
.my-ticket-div > h4 {	background: #b34200 none repeat scroll 0 0;	color: #fff;	padding: 10px 15px;}
.my-ticket-div {	background: #fff none repeat scroll 0 0;	padding-bottom: 15px;}
.my-ticket-div > p {	padding: 0 15px;}
.login_side {	padding-left: 15px;}
.login_side > a {	color:#FF8734;}
#owl-demo-2 .item {	margin: 3px;}
#owl-demo-2 .item img {	display: block;	width: 100%;	height: auto;}
.item_img {	position: relative;}
.over_img > span {	background: #fef504 none repeat scroll 0 0;	color: #000;font-weight: bold;padding: 5px;}
.over_img h4 {	color: #fef504;	font-size: 12px;	margin-bottom: 0;	padding: 5px;}
.over_img p {	color: #fff;	font-size: 10px;	margin-bottom: 0px;	padding: 5px;}
.list_img {	background: #000 none repeat scroll 0 0;}
.over_img {	bottom: 0;	position: absolute;	z-index: 999999;}
.img_detail > a {	color: orange;	display: block;	font-size: 13px;	font-weight: bold;	margin-top: 10px;}
.img_detail > p {	font-size: 12px;}
.img_detail img {	max-width: 90px;}
.custom_demo.owl-carousel.owl-theme {	margin-top: 15px;}
.custom_demo .owl-pagination {	display: none;}
.custom_demo .owl-prev {	background: #000 none repeat scroll 0 0 !important;	border-radius: 0 !important;	color: #fff !important;	left: 0;	opacity: 1 !important;	position: absolute;	top: 80px;}
.custom_demo .owl-next {	background: #000 none repeat scroll 0 0 !important;	border-radius: 0 !important;	color: #fff !important;
	right:0;	opacity: 1 !important;	position: absolute;	top: 80px;}
.hot_tickets_div > h4 {	background: #fcfcfc none repeat scroll 0 0;	border-bottom: 1px solid #ccc;	font-size: 16px;	padding: 15px;	margin: 0px;}
.hot_tickets_div h4 > span {	background: #000 none repeat scroll 0 0;	border-radius: 5px 5px 0 0;	color: #fff;	padding: 5px 15px 13px;}
.hot_tickets_div {	border: 1px solid #ccc;	margin-top: 35px;	border-bottom: none;}
.date_div {	background: #ff8734 none repeat scroll 0 0;	padding: 10px;	text-align: center;}
.date_div > h4 {	color: #fff;	font-size: 16px;	margin: 0;}
.date_div b {	display: block;	font-size: 26px;}
.date_div span {	background: transparent none repeat scroll 0 0 !important;	font-size: 12px;}
.hot_ticket_list > a {	color:#ff8734;}
.hot_ticket_list > p {	margin-bottom:0px;}
.hot_ticket_col {	background: #fff none repeat scroll 0 0;	padding: 7px;}
.hot_ticket_list > span {	color: #888;	font-size: 12px;}
.btn.btn-ticket {	background:#555555 none repeat scroll 0 0;	color: #fff;}
.btn-parent {	background: #fff none repeat scroll 0 0 !important;	padding: 25px 20px;}
.ticket_wrapper {	background: #efefef none repeat scroll 0 0;	margin: 0px;}
.ticket_col {	border-bottom: 1px solid #ccc;	padding-bottom:15px;	margin-top: 20px;}
.divider_container {	border-bottom: 1px solid #ccc;	padding-bottom: 50px;}
/*Css for Related items of comaedy page*/
.related_section {	background: #f8f8f8 none repeat scroll 0 0;	padding-bottom: 50px;}
.related_div > h4 {	background: #fff none repeat scroll 0 0;	color:#FF8734;	margin: 0;	padding: 10px;}
.related_img {	background:#EFEFEF;}
.related_slide_detail > h4 {	font-size: 14px;	margin-top: 0px;}
.related_slide_detail {	background: #fff none repeat scroll 0 0;	padding: 5px 8px 10px;}
#owl-demo .item {	margin: 3px 10px;}
#owl-demo .item img {	display: block;	width: 100%;	height: auto;}
.related_img img {	padding: 10px;}
.related_slide_detail img {	max-width: 75px;}
.foo-slider {	position: absolute;	background: gray !important;	z-index: 9999999;	width: 100%;	bottom: 0px;	height: 85px;	padding-top: 0px;	margin-top: 0px;	color: white;	opacity: 0.8;	padding-left: 10px;}
.owl-prev {	display: none !important;}
.owl-next {	z-index: 99;	top: 113px !important;	margin-right: 68px !important;}
.club_slider_img {	min-height: 300px;	max-height: 300px;	width: 100%;}
.imgg_club {	height: 180px !important;	width: 100% !important;}
.parent_img {  margin-top: -2px !important;}
</style>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<section class="comedy_section">
  <div class="container divider_container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="comedy_title" style="background:url('assets/images/comedy_bg.jpg'); background-repeat: no-repeat; background-size:cover">
          <h4> Concerts </h4>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-3 col-md-3">
            <h4 class="side_title">Shop For Events</h4>
            <div class="shop_event">
              <form>
                <div class="form-group event-group">
                  <div class="select_style">
                    <select class="form-control event-control" id="Category">
                      <option>Select Category</option>
                      <?php foreach ($categories as $c) { ?>
                      <option value="<?php echo $c->id; ?>">
                      <?php  echo $c->title; ?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group event-group">
                  <div class="select_style">
                    <select class="form-control event-control" id="SubCategory">
                      <option>SubCategory</option>
                    </select>
                  </div>
                </div>
                <div class="form-group event-group">
                  <div class="select_style">
                    <select class="form-control event-control">
                      <option>Select Date Range</option>
                      <option>Select Date Range 1</option>
                      <option>Select Date Range 2</option>
                      <option>Select Date Range 3</option>
                      <option>Select Date Range 4</option>
                    </select>
                  </div>
                </div>
                <div class="form-group event-group">
                  <label class="event-label">From</label>
                  <div class="input-group">
                    <input type="text" class="form-control event-control"  aria-describedby="basic-addon1" id="datepicker1">
                    <span class="input-group-addon event-addon"><i class="fa fa-calendar" aria-hidden="true"></i> </span> </div>
                </div>
                <div class="form-group event-group">
                  <label class="event-label_1">To</label>
                  <div class="input-group">
                    <input type="text" class="form-control event-control"  aria-describedby="basic-addon1" id="datepicker2">
                    <span class="input-group-addon event-addon" ><i class="fa fa-calendar" aria-hidden="true"></i> </span> </div>
                </div>
                <div class="form-group event-group">
                  <input type="text" class="form-control event-control" placeholder="Phoenix & Tucson">
                </div>
                <div class="form-group event-group text-right">
                  <input type="submit" class="btn btn-go" value="Go">
                </div>
              </form>
            </div>
            <div class="local_venue">
              <h4>Local Venue</h4>
              <div class="venue_list">
                <ul>
                  <li> <a href="#">Commerica Theater</a>
                    <p>12 Events</p>
                  </li>
                  <li> <a href="#">Commerica Theater</a>
                    <p>12 Events</p>
                  </li>
                  <li> <a href="#">Commerica Theater</a>
                    <p>12 Events</p>
                  </li>
                  <li> <a href="#">Commerica Theater</a>
                    <p>12 Events</p>
                  </li>
                  <li> <a href="#">Commerica Theater</a>
                    <p>12 Events</p>
                  </li>
                  <li> <a href="#">Commerica Theater</a>
                    <p>12 Events</p>
                  </li>
                </ul>
              </div>
            </div>
            <div class="book_room"> <img src="<?php echo base_url('assets/images/book_room.jpg') ?>" class="img-responsive" alt="">
              <div class="book_text">
                <h4>Hilton</h4>
                <a href="#">Book Now</a> </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6" style="padding: 0px;">
            <div id="owl-demo-8" class="custom_demo">
              <?php foreach($club_sliders as $s) { ?>
              <div class="item" style="position: relative">
                <div class="foo-slider" style="position: absolute;">
                  <p>
                  <h3><?php echo $s->name; ?></h3>
                  </p>
                  <h4>Academy Manchester Ticket</h4>
                </div>
                <div class="item_img"> <img src="<?php echo base_url('uploads/images/full/'.$s->image) ?>" class="img-responsive club_slider_img" alt=""> </div>
              </div>
              <?php } ?>
            </div>
            <div id="owl-demo-2" class="custom_demo">
              <?php foreach($club_sliders as $ss) {
       				 $date=explode('/',$ss->start_date);
					$award_slug = $this->db->get_where('tbl_events',array('id'=>$ss->id))->row()->slug;
     			?>
              <div class="item">
                <div class="item_img"> <img src="<?php echo base_url('uploads/images/full/'.$ss->image) ?>" class="img-responsive imgg_club" alt="">
                  <div class="over_img"> <span><?php echo $date[0].'/'.$date[1];?></span>
                    <div class="list_img">
                      <h4><?php echo $ss->name; ?></h4>
                    </div>
                  </div>
                </div>
                <div class="img_detail"> <a href="<?php  echo base_url($award_slug); ?>" ><?php echo $ss->venue; ?></a> <img src="<?php echo base_url('assets/images/star.png') ?>" class="img-responsive" alt=""> </div>
              </div>
              <?php } ?>
            </div>
            <div class="hot_tickets_div" <?php if(!$club_sliders){?> style="margin-top:0;" <?php } ?>>
              <h4><span>See Ticket</span></h4>
              <!-- list start here -->
              <div class="row ticket_wrapper">
                <?php foreach($resulte as $val) { 
					$month="";
					$date=explode('/',$val->start_date);
					if($date[1]=="1"){ $month="JAN"; }
					if($date[1]=="2"){ $month="FEB"; }
					if($date[1]=="3"){ $month="MAR"; }
					if($date[1]=="4"){ $month="APR"; }
					if($date[1]=="5"){ $month="MAY"; }
					if($date[1]=="6"){ $month="JUN"; }
					if($date[1]=="7"){ $month="JULY"; }
					if($date[1]=="8"){ $month="AUG"; }
					if($date[1]=="9"){ $month="SEP"; }
					if($date[1]=="10"){ $month="OCT"; }
					if($date[1]=="11"){ $month="NOV"; }
					if($date[1]=="12"){ $month="DEC"; }
				$award_slug = $this->db->get_where('tbl_events',array('id'=>$val->id))->row()->slug;			
		     ?>
                <div class="col-xs-12 col-sm-12 col-md-12 ticket_col">
                  <div class="col-xs-12 col-sm-3 col-md-2" style="padding: 0px;">
                    <div class="date_div">
                      <h4><?php echo $month; ?> <br/>
                        <b><?php echo $date[0]; ?></b> <span><?php echo rtrim(date('l', strtotime($val->start_date)),'day'); ?></span></h4>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 hot_ticket_col">
                    <div class="hot_ticket_list"> <a href="<?php echo  base_url($award_slug); ?>"><?php echo $val->name; ?></a>
                      <p><?php echo $val->slug; ?></p>
                      <span>More Dates</span> </div>
                  </div>
                  <div class="col-xs-12 col-sm-3 col-md-4 btn-parent">
                    <div class="hot_ticket_btn_div"> <a href="<?php echo  base_url($award_slug); ?>" class="btn btn-ticket">See Tickets</a> </div>
                  </div>
                </div>
                <?php  } ?>
              </div>
              <!-- list end here --> 
              
            </div>
          </div>
          <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="row parent_img">
              <h3 class="home_title">Advertisement</h3>
              <div class="underline"></div>
              <div class="no-right">
                <div class="small_img"> <img src="<?php echo  base_url(); ?>/assets/images/sponsor_img.jpg" class="img-responsive" alt=""> </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="where_ticket">
              <h3>WHERE ARE MY TICKETS ?</h3>
              <form method="POST" action="<?php echo  base_url(); ?>front/sendmail">
                <div class="form-group">
                  <label>Name</label>
                  <input name="name" placeholder="Your Name" class="form-control" type="text">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input name="email" placeholder="Your Email" class="form-control" type="email">
                </div>
                <div class="form-group">
                  <label>Event Name</label>
                  <input name="ename" placeholder="Event Name" class="form-control" type="text">
                </div>
                <div class="form-group">
                  <label>Purchase Date</label>
                  <input name="date" placeholder="Purchase Date" class="form-control" type="text">
                </div>
                <div class="form-group">
                  <input class="btn btn-secondary search_btn" value="Send Enquiry" type="submit">
                </div>
              </form>
            </div>
            <!--<div class="facebook_trend">
              <h4><i class="fa fa-facebook-official" aria-hidden="true"></i> Friends On Ticket baby</h4>
              <div class="tab-wrapper">
                <ul class="nav nav-tabs my-tab" role="tablist">
                  <li role="presentation" class="active"><a href="#everyone" aria-controls="everyone" role="tab" data-toggle="tab">Facebook</a></li>
                  <li role="presentation"><a href="#friends" aria-controls="friends" role="tab" data-toggle="tab">Twitter</a></li>
                </ul>
                
                <!-- Tab panes -->
                <!--<div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="everyone">
                    <div class="row tab-list-wrapper">
                      <div class="fb-page" data-href="https://www.facebook.com/jalodara.jayesh.9/info?tab=page_info" data-width="250" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
                        <div class="fb-xfbml-parse-ignore">
                          <blockquote cite="https://www.facebook.com/jalodara.jayesh.9/info?tab=page_info"><a href="https://www.facebook.com/jalodara.jayesh.9/info?tab=page_info">Bigshop</a></blockquote>
                        </div>
                      </div>
                    </div>
                    <div class="more_link text-right"> <a href="#">More Artists ></a> </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="friends" style="height:200px;overflow-y:scroll;"> <a class="twitter-timeline" href="https://twitter.com/Flipkart">Tweets by ticketbaby </a> 
                    <script async src="http://platform.twitter.com/widgets.js" charset="utf-8"></script> 
                  </div>
                </div>
              </div>
              <div class="facebook_like">
                <h4>Ticket Baby Facebook Like</h4>
              </div>
              <!--<div class="my-ticket-div">
                <h4>my TICKET BABY</h4>
                <p>Hello,<br/>
                  Update Your list favourites and never miss an event! </p>
                <div class="login_side"> <a href="#">Sign In</a> <span>Or</span> <a href="#">Create Account</a> </div>
              </div> 
            </div>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="related_section">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="related_div">
          <h4>Related To Your Interest</h4>
          <div id="owl-demo-3" class="owl-demo-3">
            <div class="item">
              <div class="related_img"> <img src="<?php echo base_url('assets/images/related_img_1.jpg') ?>" class="img-responsive"> </div>
              <div class="related_slide_detail">
                <h4>COW BOY 3</h4>
                <img src="<?php echo base_url('assets/images/star.png') ?>" class="img-responsive" alt=""> </div>
            </div>
            <div class="item">
              <div class="related_img"> <img src="<?php echo base_url('assets/images/related_img_1.jpg') ?>" class="img-responsive"> </div>
              <div class="related_slide_detail">
                <h4>COW BOY 3</h4>
                <img src="<?php echo base_url('assets/images/star.png') ?>" class="img-responsive" alt=""> </div>
            </div>
            <div class="item">
              <div class="related_img"> <img src="<?php echo base_url('assets/images/related_img_1.jpg') ?>" class="img-responsive"> </div>
              <div class="related_slide_detail">
                <h4>COW BOY 3</h4>
                <img src="<?php echo base_url('assets/images/star.png') ?>" class="img-responsive" alt=""> </div>
            </div>
            <div class="item">
              <div class="related_img"> <img src="<?php echo base_url('assets/images/related_img_1.jpg') ?>" class="img-responsive"> </div>
              <div class="related_slide_detail">
                <h4>COW BOY 3</h4>
                <img src="<?php echo base_url('assets/images/star.png') ?>" class="img-responsive" alt=""> </div>
            </div>
            <div class="item">
              <div class="related_img"> <img src="<?php echo base_url('assets/images/related_img_1.jpg') ?>" class="img-responsive"> </div>
              <div class="related_slide_detail">
                <h4>COW BOY 3</h4>
                <img src="<?php echo base_url('assets/images/star.png') ?>" class="img-responsive" alt=""> </div>
            </div>
            <div class="item">
              <div class="related_img"> <img src="<?php echo base_url('assets/images/related_img_1.jpg') ?>" class="img-responsive"> </div>
              <div class="related_slide_detail">
                <h4>COW BOY 3</h4>
                <img src="<?php echo base_url('assets/images/star.png') ?>" class="img-responsive" alt=""> </div>
            </div>
            <div class="item">
              <div class="related_img"> <img src="<?php echo base_url('assets/images/related_img_1.jpg') ?>" class="img-responsive"> </div>
              <div class="related_slide_detail">
                <h4>COW BOY 3</h4>
                <img src="<?php echo base_url('assets/images/star.png') ?>" class="img-responsive" alt=""> </div>
            </div>
            <div class="item">
              <div class="related_img"> <img src="<?php echo base_url('assets/images/related_img_1.jpg') ?>" class="img-responsive"> </div>
              <div class="related_slide_detail">
                <h4>COW BOY 3</h4>
                <img src="<?php echo base_url('assets/images/star.png') ?>" class="img-responsive" alt=""> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include 'includes/footer.php' ?>
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/interface/moment.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/vegas.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js" type="text/javascript"></script>
<script>

$(document).ready(function() {
    $('.faleft').closest('.owl-prev').addClass('owlleft8');
    $('.faright').closest('.owl-next').addClass('owlnext8');

 $('.owlnext8').css('position','absolute');
    $('.owlnext8').css('margin-top','50px !important;');
    $('.owlnext8').css('margin-right','75px !important;');

    $('.faleft').closest('.owl-prev').addClass('owlleft8');
    $('.owlleft8').css('display','none');
    $( function() {
            $( "#datepicker1" ).datepicker();
            $( "#datepicker2" ).datepicker();
        } );

    $("#owl-demo").owlCarousel({

        autoPlay: 4000, //Set AutoPlay to 3 seconds
        items : 5,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        nav: true,
        loop:true

    });
    $("#owl-demo1").owlCarousel({

        autoPlay: 4000, //Set AutoPlay to 3 seconds
        items : 3,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        nav: true,
        loop:true

    });

    $("#owl-demo-2").owlCarousel({

      //  autoPlay: 6000, //Set AutoPlay to 3 seconds
        items : 4,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        loop:false,
        navigation:false
           /*     navigationText: [
                    '<i class="fa fa-caret-left" aria-hidden="true"></i>',
                    '<i class="fa fa-caret-right" aria-hidden="true"></i>',
                ]*/

    });
    $("#owl-demo-3").owlCarousel({

        autoPlay: 6000, //Set AutoPlay to 3 seconds
        items : 8,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        loop:true,
        navigation:true,
                navigationText: [
                    '<i class="fa fa-caret-left" aria-hidden="true"></i>',
                    '<i class="fa fa-caret-right" aria-hidden="true"></i>',
                ]

    });

    $("#owl-demo-8").owlCarousel({

        autoPlay: 6000, //Set AutoPlay to 3 seconds
        items : 1,
        itemsDesktop : [1199,1],
        itemsDesktopSmall : [979,1],
        loop:true,
      //  navigation:true,
           
    });



});


</script>