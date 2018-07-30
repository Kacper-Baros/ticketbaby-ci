<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>csss/bootstrap.min.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>csss/bootstrap.min.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>csss/bootstrap-select.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>csss/style.css"/>

<link rel="stylesheet" href="<?php base_url()?>assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php base_url()?>assets/bootstrap/css/bootstrap-select.min.css" />
<link rel="stylesheet" href="<?php base_url()?>assets/bootstrapvalidator/bootstrapValidator.min.css">
<link rel="stylesheet" href="<?php base_url()?>assets/bootstrap/css/owl.carousel.css" />
<!-- Titcket Baby CSS -->
<link rel="stylesheet" href="<?php base_url()?>assets/css/style.min.css">
<link rel="stylesheet" href="<?php base_url()?>css/style.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/new/style.css" />


<script type="text/javascript" src="<?php base_url()?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php base_url()?>assets/js/bootstrap-datepicker.min.js"></script>


<!---if internet explorer is 7 or less use this script for code running--->
<!-- start--->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!-- end--->
<!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="http://ticketbaby.co.uk/demo/assets/css/html.css" media="screen"><![endif]-->
<!--[if IE  8]><link rel="stylesheet" type="text/css" href="http://ticketbaby.co.uk/demo/assets/css/htmls.css" media="screen">
<![endif]-->
<script src="<?=base_url()?>assets/jquery/jquery-2.1.4.min.js"></script>
<!-- recaptcha js -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<title>TicketBaby</title>
<style>
.search_submit{
    width: 25%;
    height: 32px;
    border-radius: 3px;
    background: #1e5799;
    background: -moz-linear-gradient(top, #1e5799 0%, #ff9e5b 0%, #ff8531 100%, #207cca 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1e5799), color-stop(0%,#ff9e5b), color-stop(100%,#ff8531), color-stop(100%,#207cca));
    background: -webkit-linear-gradient(top, #1e5799 0%,#ff9e5b 0%,#ff8531 100%,#207cca 100%);
    background: -o-linear-gradient(top, #1e5799 0%,#ff9e5b 0%,#ff8531 100%,#207cca 100%);
    background: -ms-linear-gradient(top, #1e5799 0%,#ff9e5b 0%,#ff8531 100%,#207cca 100%);
    background: linear-gradient(to bottom, #1e5799 0%,#ff9e5b 0%,#ff8531 100%,#207cca 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#207cca',GradientType=0 );
    border: 1px solid #ee6d14;
    float: left;
    color: #fff;
    text-transform: uppercase;
    text-shadow: 0 1px 1px #666;
    font-weight: bold;
    font-size: 14px;
    margin: 0 0 0 6px;
}	

.event_submit{
       width: 70%;
    height: 32px;
    border-radius: 3px;
    margin-left: 23%;
    background: #1e5799;
    background: -moz-linear-gradient(top, #1e5799 0%, #ff9e5b 0%, #ff8531 100%, #207cca 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1e5799), color-stop(0%,#ff9e5b), color-stop(100%,#ff8531), color-stop(100%,#207cca));
    background: -webkit-linear-gradient(top, #1e5799 0%,#ff9e5b 0%,#ff8531 100%,#207cca 100%);
    background: -o-linear-gradient(top, #1e5799 0%,#ff9e5b 0%,#ff8531 100%,#207cca 100%);
    background: -ms-linear-gradient(top, #1e5799 0%,#ff9e5b 0%,#ff8531 100%,#207cca 100%);
    background: linear-gradient(to bottom, #1e5799 0%,#ff9e5b 0%,#ff8531 100%,#207cca 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#207cca',GradientType=0 );
    border: 1px solid #ee6d14;
    float: right;
    color: #fff;
    height: 40px;
    text-transform: uppercase;
    text-shadow: 0 1px 1px #666;
    font-weight: bold;
    font-size: 15px;
    margin: 4px 0px 0px 6px;
}	
</style>
</head>
<body>
<div class="container-fluid orange-strip cusm navbar-fixed-top">
    <div class="container no-pad">
        <div class="col-md-3 col-sm-12 logo">
            <a href="<?=base_url();?>"><img src="<?=base_url()?>assets/images/logo2.png" /></a>
        </div>
        <div class="col-md-9 col-sm-12 header-right-panel">

                <div class="alert alert-success" style="position:absolute;display: none;">
                <a href="#" class="close" data-hide="alert" data-dismiss="alert"> &times; </a>
                <strong>Success!</strong> Your message has been sent successfully.
                </div>

                <div class="col-md-4 col-sm-4"></div>
                <div class="col-md-4 col-sm-4"></div>
                <div class="col-md-4 col-sm-4 social-icon">
                    <a href="#"><img src="<?=base_url()?>assets/images/fb.png" /></a>
                    <a href="#"><img src="<?=base_url()?>assets/images/twtr.png" /></a>
                    <a href="#"><img src="<?=base_url()?>assets/images/pin.png" /></a>
                </div>
                <nav class="navbar navbar-inverse">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                    </div>
                    <div class="collapse navbar-collapse navbar-right main-menu no-pad" id="myNavbar">
                      <ul class="nav navbar-nav">
                        <li><a href="<?=base_url();?>">Home</a></li>
						<li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Music <b class="caret"></b></a>
                            <ul class="dropdown-menu"> 
                                <li><a href="<?=base_url()?>index.php/music/clubnites">Clubnites</a></li>
                                <li><a href="<?=base_url()?>index.php/music/concerts">Concerts</a></li>
                                <li><a href="<?=base_url()?>index.php/music/music-festival">Music Festivals</a></li>
                            </ul>
						</li>
                        <li>
                        	<a href="<?=base_url()?>index.php/music/galas-awards">Galas & Awards</a>
                        </li>
                        
						<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">Theatre & Arts <b class="caret"></b></a>
						<ul class="dropdown-menu"> 
						<li><a href="<?=base_url()?>index.php/theatre_arts/comedy">Comedy</a></li>
						<li><a href="<?=base_url()?>index.php/theatre_arts/plays">Plays</a></li>
						<li><a href="<?=base_url()?>index.php/theatre_arts/shows">Shows </a></li>
						</ul>
						</li>
                        <li>
                       		<a href="<?=base_url()?>index.php/music/family-attractions">Family & Attractions</a> 
                        </li>
                        <li><a href="#">Festivals</a></li>                        
                        <li><a href="#">Exhibitions</a></li>
                        <li><a href="#">Sports</a></li>
                       
                        <!--<li><a href="#">Shop</a></li>-->
                      </ul>                                                                    
                    </div>
                </nav>
        </div>
     </div>
</div>
<div style="clear:both; display : block;margin-bottom: 60px;">&nbsp;</div>
<?php

if( base_url(uri_string())==base_url()){
?>
<div class="co">
</div>
<?php } ?>
<div class="container-fluid search-bar">
    <div class="container">
        <div class="col-md-8 col-sm-6 col-xs-12 no-pad search">
            <div class="col-md-1 col-sm-2 col-xs-2 mobilenone">
                <img src="<?=base_url()?>assets/images/search-icon.png" />
            </div>
			 <form class="form-horizontal" name="form" method="GET" action="<?php echo base_url();?>index.php/event/search">   
            <div class="col-md-10 col-sm-10 col-xs-12 no-pad">
            <input type="text" placeholder="Enter an address, zip code or city..." name="q" value='<?php echo $q;?>' />
            <input type="submit" value="Search" name="result" class='search_submit'/>
            </div>
            </form>
        </div>
        <div class="col-md-3 col-sm-2 col-xs-8">
                
            </div>
        <div class="col-md-2 col-sm-3 col-xs-12 barclay mobilenone">
            <img src="<?=base_url()?>assets/images/barclay.png" />
        </div> 
		 
		<?php
					$page_url=current_url();
					
				 	$path = base_url();
					$path .="index.php/Event/add_event";
					
					if ($page_url == $path || ($page_url == base_url().'index.php/cart/home') || ($page_url == base_url().'index.php/user/editProfile')
					 || ($page_url == base_url().'index.php/user/order_detail') || ($page_url == base_url().'index.php/user/my_event')){
					// to do
					}
					else{
		?>
	
		<form class="form-horizontal" name="form" method="GET" action="<?php echo base_url();?>index.php/Event/add_event">   
		<div class="col-md-2 col-sm-3 col-xs-12 barclay mobilenone ">
      <input type="submit" value="Create An Event" name="create_event" class='event_submit'/>
		
        </div>
		</form><?php }?>
		
    </div>
</div>



