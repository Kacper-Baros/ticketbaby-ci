<?php include 'includes/header.php'; ?>
<?php $slide = $this->db->get_where('tbl_post', array('id' => 148))->row(); ?>
<section class="slider_sec">
  <div id="myCarousel" class="carousel slide my_slider"  data-ride="carousel"> 
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <?php
            $j = 0;
            foreach ($sliders as $si)
			 {
				 
                ?>
      <li data-target="#myCarousel" data-slide-to="<?php echo $j; ?>" class="<?php
                if ($j == 0) {
                    echo "active";
                }
                ?>"></li>
      <?php
                    $j++;
                }
                ?>
    </ol>
    
    <!-- Wrapper for Slides -->
    <div class="carousel-inner">
      <?php
            $i = 0;
            foreach ($sliders as $ss)
			 {
                ?>
      <div class="item <?php if ($i == 0){ echo 'active'; } ?>"> 
        <!-- Set the first background image using inline CSS below. -->
        <div class="fill" style="background-image:url('<?php echo base_url('uploads/images/full/' . $ss->image) ?>');"></div>
        <div class="carousel-caption">
          <div class="caption">
            <h2><?php echo $ss->title; ?></h2>
            <p><?php echo $ss->description; ?> </p>
            <?php if ($ss->url != '') { ?>
            <a href="<?php $ss->url; ?>" class="btn btn-success more_btn">Learn More</a>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php
                $i++;
            }
            ?>
    </div>
    
    <!-- Controls --> 
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <span class="icon-prev"></span> </a> <a class="right carousel-control" href="#myCarousel" data-slide="next"> <span class="icon-next"></span> </a>
    <div class="col-xs-12 col-sm-4 col-md-3 inquery_col"> </div>
  </div>
</section>
<div class="container">
  <div class="row search_payment">
    <div class="col-md-7 col-sm-7 col-xs-12">
      <form id="searchForm" method="get" action="<?php echo base_url('search') ?>">
        <div class="input-group">
          <div class="col-xs-12 col-sm-8 col-md-8 col-xs-8">
            <input type="text" class="form-control s_control" name="keyword" placeholder="Search">
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-xs-4"> <span class="input-group-btn">
            <button type="submit" class="btn btn-secondary search_btn"> <i class="fa fa-search search_search_control" aria-hidden="true"></i> </button>
            </span> </div>
        </div>
      </form>
    </div>
    <div class="col-md-5 col-sm-5 col-xs-12"> <img src="<?php echo theme_img('barclay.png'); ?>" class="img-responsive center-block img_payment"> </div>
  </div>
</div>
<section class="listing_event">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
		<h3 class="home_recomTitle">Recommended Events</h3>
		<div class="underlineH"></div>
        <div id="owl-demo">
          <?php
			function limit_words($string, $word_limit) {
				$words = explode(" ", $string);
				return implode(" ", array_splice($words, 0, $word_limit));
			}
          ?>
          <?php foreach ($main_carousel as $m) { ?>
          <?php 
		  
		  /*if ($m->event_type == 0) { ?>
          <a href="<?php echo base_url('Family_trips/singleview/'. $m->id); ?>">
          <?php } else { */
		  	
		    $award_slug = $this->db->get_where('tbl_events',array('id'=>$m->id))->row()->slug; ?>
         	 <a href="<?php echo base_url($award_slug);  ?>" >
         
          <div class="item">
            <div class="event_detail recomme">
              <div class="image"> <img src="<?php echo base_url('uploads/images/medium/' . $m->image) ?>" alt="Owl Image" class="img-responsive">
                <div class="event_date"> <span><?php echo $m->start_date ?></span> </div>
              </div>
              <h4><?php echo $m->name ?></h4>
              <p><?php echo limit_words($m->details, 10) . '...' ?></p>
              <button class="get_ticket_btn" href="<?php echo base_url('family_trips/singleview/'. $m->id); ?>">Get Tickets</button>
            </div>
          </div>
          </a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="recommended_event" id="section_next">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="row">
          <div class="col-xs-12 col-sm-9 col-md-9">
            <ul id="listevents">
				<?php 
					$data = $this->db->order_by('id','DESC')->get_where('tbl_events',array('status'=>1))->result();
					$eventCount=1;
					foreach($data as $val){
				?>
				<li class="owl-items">
					<div class="item">
						<div class="event_detail_s">
							<div class="image">
								<img class="img-responsive" alt="<?php echo $val->name ?>" src="<?php echo base_url('uploads/images/medium/' . $val->image) ?>">
							</div>
							<h4><?php if($val->name){ echo $val->name; } else{ "&nbsp;"; } ?></h4>
							<?php   	
								$showsdate = '';
								$showedate = ''; 
								if($val->start_date!=''){
									$stdt = explode('/',$val->start_date); 
									$d = $stdt['0'];
									$m = $stdt['1'];
									$y = $stdt['2'];
									$nwdta = $y.'-'.$m.'-'.$d;
									$dtstrt = date_create($nwdta); 
									$showsdate = date_format($dtstrt, 'd M Y');
								}
								if($val->end_date!=''){
									$endt = explode('/',$val->end_date);
									$d = $endt['0'];
									$m = $endt['1'];
									$y = $endt['2'];
									$nwendt = $y.'-'.$m.'-'.$d;
									$dtend = date_create($nwendt);
									$forcheckdate = date_format($dtend, 'Y-m-d');
									$showedate = date_format($dtend, 'd M Y');
								}
							?>
							<p>
								<i class="fa fa-calendar" aria-hidden="true"></i> 
								<?php echo $showsdate.' '.strtoupper($val->time).' - <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$showedate.' '.strtoupper($val->end_time); ?>
								<br><br>
								<i class="fa fa-map-marker" aria-hidden="true"></i>
								<?php echo trim($val->venue).", ".trim($val->city); ?>
							</p>
							<div class="wrap-tickbtn-sharebtn">
								<span class="Event-List-Button">
								<?php
									$soldout=0;
								if($val->status==1 && ($forcheckdate > date('Y-m-d'))){ ?>
										<button onclick="javascript: window.location='<?php echo base_url($val->slug); ?>';" class="get_ticket_btn_E">Get Tickets</button>
								<?php } else{ $soldout=1; ?>
										<button class="sold_ticket_btn">SOLD OUT!</button>
								<?php } ?>
									
								</span>
								<span class="share-btn">
									<input type="image" data-toggle="modal" data-target="#ShareModel_<?php echo $val->id; ?>" src="<?php echo theme_img('share-icon-peeps.png') ?>" title="Share Event" style="height: 28px;border-right: thin #e0ded3 solid;padding-right: 7px;padding-left: 4px;"/>
									<?php $userid = $this->session->userdata('user_id');
									if(empty($userid)){ ?>
										<input type="image" data-toggle="modal" data-target="#LoginModel" src="<?php echo theme_img('icon-save.png') ?>" title="Saves Event" style="height: 28px;padding-left: 2px;"/>
									<?php }else{
											$eventID = $val->id;
											$query = $this->db->query("SELECT * FROM tbl_saved_events WHERE event_id='".$eventID."' AND user_id='".$userid."'");
											$rows = $query->row();
											if(empty($rows)){
												 $savedid = 0;
											}
											else{
												$savedid = $rows->save_id;
											}
											if($soldout==0){
												if($savedid!=0){
										?>
													<input type="image" src="<?php echo theme_img('icon-save-red.png') ?>" title="Remove Saved" style="height: 28px;padding-left: 2px;" onclick="javascript: RemoveEvents(<?php echo $savedid; ?>);"/>
												<?php } else{ ?>
													<input type="image" src="<?php echo theme_img('icon-save.png') ?>" title="Save Event" style="height: 28px;padding-left: 2px;" onclick="javascript:SaveEvents(<?php echo $val->id; ?>, <?php echo $userid; ?>);"/>
												<?php } ?>
											<?php }else{ ?>
												<input type="image" src="<?php echo theme_img('icon-save-blue.png') ?>" title="Not Allowed" style="height: 28px;padding-left: 2px; cursor:no-drop;" />
											<?php } ?>
									<?php } ?>
								</span>
							</div>
						</div>
					</div>
				</li>
				<div class="modal fade" id="ShareModel_<?php echo $val->id; ?>" role="dialog">
				  <div class="modal-dialog"> 
					<!-- Modal content -->
					<div class="modal-content">
					  <div class="modal-header" style="background: #FF8734;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<center><h4 class="modal-title">Share The Love Baby!!</h4></center>
						<img id="modal-logo" src="<?php echo theme_img('logo.png') ?>" class="img-responsive">
					  </div>
					  <div class="modal-body">
						<div class="row">
						  <div class="col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<br>
								<div class="col-lg-4 col-sm-2 social-shares-icons">
									<center>
										<a onclick="javascript:FacebookShare(<?php echo $val->id; ?>);" href="javascript: void(0);"><img src="<?php echo theme_img('facebook.png') ?>" alt="Facebook" title="Share this Event on Facebook"></a>
										<a onclick="javascript:TwitterShare(<?php echo $val->id; ?>);" href="javascript: void(0);"><img src="<?php echo theme_img('twiiter.png') ?>" alt="Twitter" title="Share this Event on Twitter"></a>
										<a onclick="javascript:InstagramShare();" href="javascript: void(0);"><img src="<?php echo theme_img('instagram.png') ?>" alt="Instagram" title="Instagram"></a>
										<a href="javascript: void(0);"><img src="<?php echo theme_img('email-icon-share.jpg') ?>" alt="Email" title="Email"></a>
									</center>
								</div>
								<input class="form-control" type="text" id="EventLink_<?php echo $val->id; ?>" value="<?php echo base_url($val->slug); ?>">
							</div>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
				
				<?php $eventCount++; } ?>
				<input type="hidden" name="eventsCount" id="eventsCount" value="<?php echo  $eventCount++; ?>" />
			</ul>
			<?php if($eventCount>8){ ?>
			<style>
				#listevents li{
					display:none;
				}
			</style>
			<center id="loadmoreimage" style="display:none;">
				<img src="<?php echo base_url(); ?>assets/images/balls-spinner.gif" width="80px" height="80px" alt="" />
			</center>
			<?php } ?>
			<div class="modal fade" id="LoginModel" role="dialog">
			  <div class="modal-dialog"> 
				<!-- Modal content -->
				<div class="modal-content">
				  <div class="modal-header" style="background: #FF8734;">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<center><h4 class="modal-title">Save This Event</h4></center>
					<img id="modal-logo" src="<?php echo theme_img('logo.png') ?>" class="img-responsive">
				  </div>
				  <div class="modal-body">
					<div class="row">
					  <div class="col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<br>
							<p>Log in or sign up for TicketBaby to save events you're interested in.
							<button id="sign-up-btn" type="button" onclick="javascript: window.location='<?php echo base_url('register'); ?>';" class="btn btn-primary">SIGN UP</button></p>
						</div>
					  </div>
					</div>
				  </div>
				  <div class="modal-footer">
						<p>Already have an account? <a href="<?php echo base_url('login'); ?>">Log in</a></p>
				  </div>
				</div>
			  </div>
			</div>
			<div class="container">
				<div class="row submit_email">
				  <div class='col-md-12 text-center' style="position:static !important;">
					<h4>Get top Events and Latest updates in your inbox with Ticket Baby</h4>
					<p>
					<form id="myfrom">
					  <input type="text" name='email_add' placeholder="Enter your email address here" class='form-control email_input'>
					  <button class="submit_btn">Submit</button>
					</form>
					</p>
				  </div>
				</div>
			</div>
          </div>
          <!--<div class="floatcontainer" style="float: right; width:25%">
         	<div class="inner" style="border:1px solid white;position:fixed;width:200px;bottom:20px;">some text here</div>
          </div>-->
		  <div class="col-xs-12 col-sm-3 col-md-3">
          	<div id="fixedElement">
				<div class="row parent_img">
				  <h3 class="home_title">Advertisement</h3>
				  <div class="underline"></div>
				  <div class="no-right">
					<!--<div class="small_img"> <img src="<?php  //echo base_url(); ?>assets/images/sponsor_img.jpg" class="img-responsive" alt=""> </div>-->
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						  <ol class="carousel-indicators">
						  <?php 
								$co=0;
								foreach($row as $val)
								{
						   ?>
							<li data-target="#carousel-example-generic" data-slide-to="<?php echo  $co; ?>" class="<?php if($co==0){ echo "active";} ?>"></li>
						   <?php $co++; } ?> 
						  </ol>
						 <div class="carousel-inner" role="listbox">
					 <?php 
								$co=0;
								foreach($row as $val)
								{
						   ?>
							<div class="item <?php if($co==0){ echo "active";} ?>">
							  <img src="<?php  echo base_url(); ?>/uploads/images/pageslider/<?php echo $val->image;?>" alt="..." >
							  <div class="carousel-caption">
								
							  </div>
							</div>
						   <?php $co++; } ?> 
							
						 </div>
						</div>
					  </div>
					</div>
					<div class="promote_event">
					  <h3>LET US PROMOTE YOUR EVENT</h3>
					  <?php
						//echo "<pre>";print_r($promote_events); echo '</pre>';
						
						foreach ($promote_events as $p) { ?>
					  <div class="promote_detail ">
						<div class="col-sm-5"><img src="<?php echo base_url('uploads/images/small/' . $p->image); ?>" class="img-responsive img-big" alt=""></div>
						<div class="col-sm-7" style="padding-left:0; padding-right: 0">
						  <h5 style="font-weight: bold; margin-top: 0px; margin-bottom: 0px; font-size: 12px !important;"><?php echo strtoupper($p->title); ?></h5>
						  <p style="margin: 0 0 0px !important; font-size: 12px !important;"><?php echo $p->sdate.' '.$p->time; ?></p>
						  <a style="float: right;" href="<?php echo site_url(). 'events/pevent/'.$p->id;?>">see details</a> 
						</div>
						<div class="clearfix"></div>
					  </div>
					  <?php } ?>
					  <a class="more_button" href="<?php echo site_url()?>events/peventlist" style="text-align:center">More</a> 
					</div>
                </div>
			</div>
			<!--<div class="col-xs-12 col-sm-3 col-md-3">
				
		  </div>-->
        </div>
      </div>
    </div>
  </div>
</section>

<script src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js" language="javascript" ></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-4482989842467373",
    enable_page_level_ads: true
  });
</script>
<?php include 'includes/footer.php'; ?>
<script language="javascript">
 $("#myfrom").submit(function(){
  $.ajax({
	   url: "<?php echo site_url().'front/sendmail'?>",
	   type: "POST",
	   data:  new FormData(this),
	   contentType: false,
	   cache: false,
	   processData:false,
   	   success: function(data){
	   		$("#myfrom")[0].reset();
			$('.done').show();
			$('.done').fadeOut(7000);
			
    	}      
    });
     return false;
});
/*
$(window).scroll(function(e){ 
  var $el = $('#fixedElement'); 
  var isPositionFixed = ($el.css('position') == 'fixed');
  if ($(this).scrollTop() > 1100 && !isPositionFixed){ 
   // $('#fixedElement').css({'position': 'fixed', 'top': '65px', 'right':'60px'}); 
	$('#fixedElement').css({'position': 'fixed', 'top': '65px', 'width':'262px'}); 
  }
  if ($(this).scrollTop() < 1100 && isPositionFixed)
  {
    $('#fixedElement').css({'position': 'static', 'top': '0px'}); 
  } 
});*/
</script>