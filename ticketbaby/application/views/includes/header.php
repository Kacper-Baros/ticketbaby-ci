<!--
To change this template, choose Tools | Templates
<a href="../../../../../../../C:/Users/HP/Desktop/countdown plugin/harshen-jquery-countdownTimer-d7cfb71/DEMO/index.html"></a>
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Ticket Baby</title>
        <!--<meta http-equiv="refresh" content="0;url=http://www.example.com/thanks.html" />-->
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        
<!--        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,600i,700,700i,800,800i" rel="stylesheet">-->

        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <link href="<?php echo theme_css('bootstrap.css'); ?>" rel="stylesheet">
        <!--<link href="<?php // echo theme_css('bootstrap-theme.css');                     ?>" rel="stylesheet">-->
        <link href="<?php echo theme_css('owl.theme.css') ?>" rel="stylesheet">
        <link href="<?php echo theme_css('owl.carousel.css') ?>" rel="stylesheet">
        <link href="<?php echo theme_css('vegas.css') ?>" rel="stylesheet">
        <!--<link href="<?php // echo theme_css('responsive.css')     ?>" rel="stylesheet">-->
        <link href="<?php echo theme_css('easyzoom.css') ?>" rel="stylesheet">
        <link href="<?php echo theme_css('jquery.countdownTimer.css') ?>" rel="stylesheet">
        
        <link href="<?php echo theme_css('style.css') ?>?v=<?php echo time();?>" rel="stylesheet">
        <link href="<?php echo theme_css('media.css') ?>?v=<?php echo time();?>" rel="stylesheet">
        
        
        
 <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
 <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-3451577156042935",
    enable_page_level_ads: true
  });
</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$(function() {
	$("#datefrom").datepicker({
	   //showOn: both - datepicker will appear clicking the input box as well as the calendar icon
	   //showOn: button - datepicker will appear only on clicking the calendar icon
	   showOn: 'button',
	   //you can use your local path also eg. buttonImage: 'images/x_office_calendar.png'
	   buttonImage: 'http://ticketbaby.co.uk/assets/images/datepicker.png',
	   buttonImageOnly: true,
	   changeMonth: true,
	   changeYear: true,
	   showAnim: 'slideDown',
	   duration: 'fast',
	   dateFormat: 'dd/mm/yy'
	});
	$("#todate").datepicker({
	   //showOn: both - datepicker will appear clicking the input box as well as the calendar icon
	   //showOn: button - datepicker will appear only on clicking the calendar icon
	   showOn: 'button',
	   //you can use your local path also eg. buttonImage: 'images/x_office_calendar.png'
	   buttonImage: 'http://ticketbaby.co.uk/assets/images/datepicker.png',
	   buttonImageOnly: true,
	   changeMonth: true,
	   changeYear: true,
	   showAnim: 'slideDown',
	   duration: 'fast',
	   dateFormat: 'dd/mm/yy'
	});
});
</script>
<?php $row = $this->db->get_where('tbl_slider',array('status'=>'1'))->result(); ?>

    </head>
    <body>
        <?php if ($this->uri->segment(2) == 'booking_post' || $this->uri->segment(2) == 'billing' || $this->uri->segment(2) == 'payment') { ?>
            <div class="timeout">
                <p>Time left to complete this page.</p>
                <span id="demo"></span>
            </div>
        <?php } ?>
		
        <section class="toprow">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-4 col-xs-6">
                        <div class="social_icon">
                            <ul>
								<?php
									$usernm = '';
									$userdetails = '';									
									//print_r($this->session->CI->load->details);
									$userid = $this->session->userdata('user_id');
									if(!empty($userid)) {
										
										$userdetails = $this->db->get_where('tbl_users', array('id' => $userid))->row();
									}									
									if($userdetails!=''){
										$usernm = $userdetails->fullname;
									}
									else{
										$usernm = 'Guest';
									}
								?>
								<li><i><b>Hello, <?php echo $usernm; ?></b></i></li>
								<!--
                                <li><a href="#"><img src="<?php //echo theme_img('facebook.png') ?>" class="img-responsive" alt="" title="Facebook"></a></li>
                                <li><a href="#"><img src="<?php //echo theme_img('twiiter.png') ?>" class="img-responsive" alt="" title="Twitter"></a></li>
                                <li><a href="#"><img src="<?php //echo theme_img('google_plus.png') ?>" class="img-responsive" alt="" title="Google Plus"></a></li>
                                <li><a href="#"><img src="<?php //echo theme_img('instagram.png') ?>" class="img-responsive" alt="" title="Instagram"></a></li>
								-->
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-8 col-xs-6">
                        <div class="top_bar more_top">
                            <ul>
                                <li><i class="glyphicon glyphicon-earphone icon_topheader"></i> <span class="number_phone icon_topheader">020 329 02710 | </span> <i class="glyphicon glyphicon-envelope icon_topheader" data-toggle="modal" data-target="#myModal"></i></li>
                                <?php if ($this->session->userdata('user_id') != '') { ?>
                                    <li class="desk_only"><a href="<?php echo base_url('profile') ?>">Dashboard</a></li>
                                    <li class="desk_only"><a href="<?php echo base_url('profile/logout') ?>"> Logout</a></li>
                                <?php } else { ?>
                                    <li class="desk_only"><a href="<?php echo base_url('login') ?>"><img src="<?php echo theme_img('user.png') ?>"> Login</a></li>
                                    <li class="desk_only"><a href="<?php echo base_url('register') ?>"><img src="<?php echo theme_img('user.png') ?>"> Register</a></li>    

                                <?php } ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="menu-section">
            <div class="container">
                <div class="row">
                    <div class=" col-md-2 col-sm-2">
                        <div class="logo">
                            <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_img('logo.png') ?>" class="img-responsive" alt=""></a>
                        </div>
                    </div>
                    <div class="col-md-10 col-sm-10">
                        <div class="top_bar">
                            <ul>
                                <!--<li><a href="#"><img src="<?php // echo theme_img('search.png')        ?>"> Search</a></li>-->
                                <!--<li><a href="#"><img src="<?php //  echo theme_img('calender.png')        ?>"> Create an Event</a></li>-->
                            </ul>
                        </div>
                        <div class="main-menu" id="main-menu">
                            <nav class="navbar navbar-default" role="navigation">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header pull-right">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse navbar-ex1-collapse">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class=""><a href="<?php echo base_url(); ?>">Home</a></li>
                                         <li class="music">
                                            <a href="#">Music</a>
                                            <ul class="dropdown-menu">
                                           <li><a href="<?php echo base_url('club_nights') ?>">Club Nights</a></li>
                                           <li><a href="<?php echo base_url('concert') ?>">Concerts</a></li>
                                          </ul>
                                        </li>
										<li class=""><a href="<?php echo base_url(); ?>">Trips </a></li>
                                        <?php $award_slug = $this->db->get_where('tbl_events',array('id'=>24))->row()->slug; ?>
                                        <li class =""><a href="<?php echo base_url('galas_awards'); /*echo "galas_awards";*/ ?>">Galas & Awards</a></li>
                                        <li> <a href="<?php echo base_url('Theater_arts') ?>" >Theatre & Arts</a>
                                         		<!--                <ul class="dropdown-menu">
                                           <li><a href="<?php echo base_url('comedy') ?>">Comedy</a></li>
                                           <li><a href="<?php echo base_url('plays') ?>">Plays</a></li>
                                          </ul>-->
                                        </li>
									    <li class =""><a href="<?php echo base_url('Family_trips') ?>">Family & Attraction</a></li>
                                        
									    <li class =""><a href="<?php echo base_url('festivals') ?>">Festivals</a></li>
                                        <!--<li class ="<?php // if($this->uri->segment(2) == 'contact') {echo "active";}      ?>"><a href="<?php // echo base_url('front/contact')     ?>">Contact Us</a></li>-->
                                        <?php if ($this->session->userdata('user_id') != '') { ?>
                                            <li><a href="#">Create an Event</a></li>
                                        <?php } ?>
                                    </ul>
                                </div><!-- /.navbar-collapse -->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>