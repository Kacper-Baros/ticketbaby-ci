<?php include 'includes/header.php'; ?>
<!-- Comedy starts -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<section class="comedy_section" >
  <div class="container divider_container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="comedy_title" style="background:url('assets/images/comedy_bg.jpg'); background-repeat: no-repeat; background-size:cover">
          <h4>Festivals</h4>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-3 col-md-3">
            <h4 class="side_title">Shop For Events</h4>
            <div class="shop_event">
              <form method="post" action="<?php echo base_url('search/index') ?>">
                <div class="form-group event-group">
                  <div class="select_style">
                    <select class="form-control event-control" name="Category_id" id="Category_id">
                      <option value="0">Select Category</option>
                      <option value="129">Club Nights</option>
					  <option value="134">Concerts</option>
					  <option value="169">Galas & Awards</option>
					  <option value="130">Theatre & Arts</option>
					  <option value="128">Family & Attraction</option>
					  <option value="167">Festivals</option>
                    </select>
                   </div>
				  </div>
				  <div class="form-group event-group">
					  <div class="select_style">
						<input class="form-control event-control" placeholder="Event Name" name="keywords" id="keywords">
					  </div>
				  </div>
				  <div class="form-group event-group">
					  <div class="select_style">
						<select class="form-control event-control" name="City_Town" id="City_Town">
						  <option value="0">City / Town</option>
						  <?php
							$this->db->distinct();
							$this->db->select('city');
							$cities = $this->db->get('tbl_events')->result();
							foreach($cities as $val){ ?>
							<option value="<?php echo $val->city; ?>"><?php echo $val->city; ?></option>
							<?php } ?>
						</select>
					  </div>
				  </div>
                <div class="form-group event-group">
                  <label class="event-label">From</label>
                  <div class="input-group">
                    <input type="text" class="form-control event-control"  aria-describedby="basic-addon1" name="from_date" id="datepicker1">
                    <span class="input-group-addon event-addon"><i class="fa fa-calendar" aria-hidden="true"></i> </span> </div>
                </div>
                <div class="form-group event-group">
                  <label class="event-label_1">To</label>
                  <div class="input-group">
                    <input type="text" class="form-control event-control"  aria-describedby="basic-addon1" name="to_date" id="datepicker2">
                    <span class="input-group-addon event-addon" ><i class="fa fa-calendar" aria-hidden="true"></i> </span> </div>
                </div>
                <div class="form-group event-group text-right">
                  <input type="submit" class="btn btn-go" value="Go">
                </div>
              </form>
            </div>
          </div>
		  <?php 
			$festivals = $this->db->get_where('tbl_events',array('category_id'=>167))->result();
			if(empty($festivals)){
		  ?>
		  <div class="col-xs-12 col-sm-12 col-md-6" style="padding: 0px;">
               <img src="<?php echo base_url(); ?>assets/images/NO-EVENTS.jpg" width="100%" alt="NO-EVENTS"> 
          </div>
		  <?php } else{ ?>
          <div class="col-xs-12 col-sm-12 col-md-6" style="padding: 0px;">
            <div id="owl-demo-8" class="custom_demo">
              <?php foreach($festivals as $s) { ?>
              <div class="item" style="position: relative">
                <div class="foo-slider" style="position: absolute;">
                  <p>
                  <h3><?php echo $s->name; ?></h3>
                  </p>
                  <!--<h4>Academy Manchester Ticket</h4>-->
                </div>
                <div class="item_img"> <img src="<?php echo base_url('uploads/images/full/'.$s->image2) ?>" class="img-responsive club_slider_img" alt=""> </div>
              </div>
              <?php } ?>
            </div>
            <div id="owl-demo-2" class="custom_demo">
            </div>
          </div>
		  <?php } ?>		  
          <div class="col-xs-12 col-sm-3 col-md-3">
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
			</div>
		</div>
	</div>
	</div>
	</div>
</section>
<section class="comedy_section" id="section_next" >
  <div class="container divider_container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="col-xs-12 col-sm-9 col-md-9" style="z-index: 9;">
            <ul id="listevents">
				<?php $filter = $city = $cityid = '';
					if(isset($_REQUEST['filter']) || isset($_REQUEST['city']) || isset($_REQUEST['cityid'])){
						$filter = $_REQUEST['filter'];
						$city = $_REQUEST['city'];
						$cityid = $_REQUEST['cityid'];
					}
					if($filter=='OK'){
						$data = $this->db->order_by('id','DESC')->get_where('tbl_events',array('category_id'=>167, 'city'=>$city))->result();
					}
					else{
						$data = $this->db->order_by('id','DESC')->get_where('tbl_events',array('category_id'=>167))->result();
					}
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
								<?php echo $val->venue.", ".$val->city; ?>
							</p>
							<div class="wrap-tickbtn-sharebtn">
								<span class="Event-List-Button">
								<?php $soldout=0;
								if($val->status==1 && ($forcheckdate > date('Y-m-d'))){ ?>
										<button onclick="javascript: window.location='<?php echo base_url($val->slug); ?>';" class="get_ticket_btn_E">Get Tickets</button>
								<?php	} else{ $soldout=1; ?>
										<button class="sold_ticket_btn">SOLD OUT!</button>
								<?php }  ?>
									
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
										<a onclick="javascript:InstagramShare(<?php echo $val->id; ?>);" href="javascript: void(0);"><img src="<?php echo theme_img('instagram.png') ?>" alt="Instagram" title="Instagram"></a>
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
          </div>
		  <div class="col-xs-12 col-sm-3 col-md-3">
		  <?php if(empty($club_sliders)){ ?>
			<div class="where_ticket"></div>
		  <?php } else{ ?>
            <div class="where_ticket">
              <h3>FILTER BY</h3>
              <form method="POST" action="">
				CITY / TOWN
                <div class="multiselect form-group"><br>
					<?php 
					$cities = $this->db->get_where('tbl_events',array('category_id'=>167))->result();
					$cityArr = array();
					foreach($cities as $val){
						$CitVar = trim($val->city);
						$cityArr[$CitVar][] = $CitVar;
					}
					if(count($cityArr)>0){
						$cnt=1;
						foreach($cityArr as $CityName => $count){
					?>
						&nbsp;&nbsp;&nbsp;&nbsp;<label onclick="javascript: filterCity(<?php echo $cnt; ?>);" data-labelfor="CityTown"><input type="checkbox" name="city_town_<?php echo $cnt; ?>" id="city_town_<?php echo $cnt; ?>" value="<?php echo $CityName;?>" <?php if($cityid == $cnt){ echo "checked='checked'"; } ?> />&nbsp;&nbsp;<?php echo $CityName." (".count($count).")";?></label><br>
					<?php $cnt++; } 
					} ?>
				</div>
              </form>
            </div>
			<?php } ?>
		</div>
		<div class="container">
			<div class="row submit_email2">
			  <div class='col-md-12 text-center'>
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
	</div>
  </div>
</section>
<?php include 'includes/footer.php' ?>
<script language="javascript">

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
        items : 1,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        //nav: true,
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