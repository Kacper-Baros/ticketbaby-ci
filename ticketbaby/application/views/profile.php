<?php include 'includes/header.php'; ?>
<style>.hasDatepicker {    
    border: 1px solid #ccc;
	height: 34px;
    padding: 6px 12px;
    font-size: 14px;
	/*border-radius: 4px;*/
	border-radius:4px 0 0 4px;
	float:left;
	width:85%;
    }
	.input-group-addon{
	padding: 0px 0px !important;	
	}
	.fa{
		color: #000 !important;
	}
</style>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <div class="container-fluid content-bg">
        <div class="container content">
            <div class="row no-mar main-content leftPad">
                <div class="col-md-6 col-xs-12">
                    <h2 class="text-orange">Dashboard</h2>
                </div>
                <div class="col-md-6 col-xs-12 text-right"><br>
                    <!-- <button class="btn btn-success btn-lg">Profile Settings</button> -->
                </div>
                <div class="col-xs-12">
                    <nav class="navbar navbar-default subNav">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#subNav">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse menu-collapse" id="subNav">
                            <ul class="nav navbar-nav">
                                <li><a href="<?php echo base_url('profile/edit_profile') ?>"><i class="glyphicon glyphicon-list-alt"></i> Account Details</a></li>
                                <li><a href="<?php echo base_url('placed_orders'); ?>"><i class="glyphicon glyphicon-tasks"></i> My Orders</a></li>
                                <li><a href="<?php echo base_url('client_orders'); ?>"><i class="glyphicon glyphicon-calendar"></i> My Events</a></li>
                            </ul>                                                                   
                            <ul class="nav navbar-nav navbar-right navbar-right-profile">
                                <li class="dropdown">
                                    <a href="" data-toggle="dropdown" class="dropdown-toggle"><i class="glyphicon glyphicon-cog"></i>&nbsp;<?php echo $details->username; ?><b class="caret"></b></a>
                                    <ul class="dropdown-menu"> 
                                        <li><a href="<?php echo base_url('profile/logout') ?>"><i class="glyphicon glyphicon-log-in"></i> Logout</a></li>
                                        <li><a href="<?php echo base_url('profile/edit_profile') ?>"><i class="glyphicon glyphicon-pencil"></i> Edit Profile</a></li>
                                    </ul>
                                </li> 
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-xs-12"><hr></div>
                <div class="col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="active"><a href="<?php echo base_url('profile'); ?>">Dashboard</a></li>
                    </ol>
                </div>
                <div class="col-xs-12" style="align:center">
                    <form name="frmsearch" action="#" method="get">
						<div class="col-md-3 col-md-12 cus-form4">
                            <div class="input-group date datepicker">
                                <input type="text" class="form-control" name="txtsearch" value="" placeholder="Search">
                                <span class="input-group-addon">
                                    <input type="image" src="http://ticketbaby.co.uk/assets/images/serachevent.png">
                                </span>
                            </div>
                        </div>
					</form>
					<form name="frmfind" action="#" method="get">
                        <div class="col-md-3 col-md-12 cus-form4">
                            <div class="input-group date datepicker">
							<input type="text" name="from_date" id="datefrom" value="" placeholder="Date From">  
                            </div>
                            <!--button type="reset" name="reset" style="margin-left: 270px;margin-top: -34px; z-index: 999999999; position: inherit;" />X</button-->
                        </div>
                        <div class="col-md-3 col-md-12 cus-form4">
                            <div class="input-group date datepicker">
                                <input type="text" name="to_date" value="" id="todate" placeholder="Date To">                                
                            </div>
                        </div>
                        <div class="col-md-3 col-md-12 cus-form4 formLastDiv">
                            <input type="submit" value="Find" name="filter" style="margin-top: 8px;">
                        </div><br><br><br>
                    </form>
                </div>
                <div class="col-xs-12" id="Users-Events">
				    <div class="tabbable page-tabs" id="Events-Tabs">
						<?php						    
						$userid = $this->session->userdata('user_id');
										
						//Saved Events
						$contsaveqry  = $this->db->query("SELECT * FROM tbl_saved_events WHERE user_id='".$userid."'");							
						$countsave = $contsaveqry->num_rows();
										
						//Upcoming Events
						$this->db->from('tbl_orders as tse');
						$this->db->where('tse.user_id', $userid);
						$this->db->where('te.start_date < ',date('d/m/Y'));
						$this->db->group_by('tse.event_id');
						$this->db->join('tbl_events as te', 'tse.event_id = te.id', 'LEFT'); 
						$upquery = $this->db->get();
						$countupcoming = $upquery->num_rows();
										
						//Past Events
						$this->db->from('tbl_orders as tse');
						$this->db->where('tse.user_id', $userid);
						$this->db->where('te.end_date > ',NOW());
						$this->db->join('tbl_events as te', 'tse.event_id = te.id', 'LEFT'); 
						$pstquery = $this->db->get();
						$countpast = $pstquery->num_rows();
						?>
						<ul class="nav nav-tabs"> 
							<li class="active">
								<a href="#upcoming_events" data-toggle="tab">
									<?php echo @$countupcoming; ?><br>UPCOMING EVENTS
								</a>
							</li> 
							<li class="">
								<a href="#saved_events" data-toggle="tab">
									<?php echo @$countsave; ?><br>SAVED EVENTS
								</a>
							</li>
							<li class="">
								<a href="#past_events" data-toggle="tab">
									<?php echo @$countpast; ?><br>PAST EVENTS
								</a>
							</li>
						</ul>
						<div class="tab-content"> 
						    <!-- First tab -->
						    <div class="tab-pane fade active in" id="upcoming_events">
								<div class="panel-body">
								    <div class="form-group">
										<div class="col-md-9 events-d">
										    <?php $this->db->from('tbl_orders as orders');
											$this->db->where('orders.user_id', $userid);
					                                            $this->db->where('evnt.start_date < ',date('d/m/Y'));
				                                                $this->db->group_by('orders.event_id');
				                                                $this->db->join('tbl_events as evnt', 'orders.event_id = evnt.id', 'LEFT');
											$query = $this->db->get();
											$upeventsorders = $query->result();
											if(!empty($upeventsorders)){  
											    foreach($upeventsorders as $upcomingeve){ 
												$evnt_row = $this->db->get_where('tbl_events', array('id' =>$upcomingeve->event_id))->result();
												foreach($evnt_row as $row){
												    $imagename = $row->image;

												    $eventslug = $row->slug;

												    $eventname = $row->name;

												    $eventdesc = $row->summary;

												    $eventdate = $row->start_date;

												    $eventvenue = $row->venue;

												    $eventcity = $row->city;
												}
												?>  
											<ul class="searchul">
											    <a>
												<li>
												    <div class="row" style="margin-bottom: -42px !important;">
														<div class="col-md-3">
														    <img width="140" height="140" src="<?php echo base_url(). 'uploads/images/full/'. $imagename; ?>">
														</div>
														<div class="col-md-9 searcheventcol">
														    <h3 class="event_title"><?php echo $eventname; ?></h3>
															<ul class="header_informations">
															    <li style="border: none !important;">
																	<div class="row" style="margin-left: -30px !important;">
																		<div class="col-md-5 col-sm-5 col-xs-12 infoeventcol"><i class="fa fa-calendar" aria-hidden="true"></i> Date</div>
																		<div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $eventdate; ?></div>
																		<div class="col-md-5 col-sm-5 col-xs-12 infoeventcol"><i class="fa fa-ticket" aria-hidden="true"></i> Venue</div>
																		<div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $eventvenue; ?></div>
																		<div class="col-md-5 col-sm-5 col-xs-12 infoeventcol"><i class="fa fa-map-marker" aria-hidden="true"></i>  City</div>
																		<div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $eventcity; ?></div>
																	</div>
																	<button id="detail-button-pr" class="btn" onclick="javascript:window.location='<?php echo base_url($eventslug); ?>';">See Details</button>
																</li>
															</ul>
														</div>
													</div> 
												</li>
												</a>
											</ul>
											<?php } }else{ ?>
											<ul class="searchul">
												<li>
													<div class="row">
														<div class="col-md-3">
															<img  width="150" height="100" src="<?php echo base_url(); ?>assets/images/Empty_Param_Profile.jpg" width="100%" alt="NO-EVENTS">
														</div>
														<div class="col-md-9 empty-paramh3">
															<h3 class="event_title">Your pram is empty, you have no events.</h3>
															<p></p>
														</div>
													</div>
												</li>
											</ul>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<!-- Second tab -->
							<div class="tab-pane fade" id="saved_events">
								<div class="panel-body">
									<div class="form-group">
										<div class="col-md-9  events-d">
											<?php if(!empty($listevent)){  ?>
												<?php foreach($listevent as $listeve){ 
													$evnt_det = $this->db->get_where('tbl_events', array('id' =>$listeve->event_id))->result();
													foreach($evnt_det as $rw){
														$imagename = $rw->image;
														$eventslug = $rw->slug;
														$eventname = $rw->name;
														$eventdesc = $rw->summary;
														$eventdate = $rw->start_date;
														$eventvenue = $rw->venue;
														$eventcity = $rw->city;
													}
												?>
											<ul class="searchul">
												<a>
												<li>
													<div class="row" style="margin-bottom: -42px !important;">
														<div class="col-md-3">
															<img width="140" height="140" src="<?php echo base_url(). 'uploads/images/full/'. $imagename; ?>">
														</div>
														<div class="col-md-9 searcheventcol">
															<h3 class="event_title"><?php echo $eventname; ?></h3>
															<ul class="header_informations">
															  <li style="border: none !important;">
																<div class="row" style="margin-left: -30px !important;">
																  <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol"><i class="fa fa-calendar" aria-hidden="true"></i> Date</div>
																  <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $eventdate; ?></div>
																
																
																  <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol"><i class="fa fa-ticket" aria-hidden="true"></i> Venue</div>
																  <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $eventvenue; ?></div>
																  
																
																  <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol"><i class="fa fa-map-marker" aria-hidden="true"></i>  City</div>
																  <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $eventcity; ?></div>
																  <button id="detail-button-pr" class="btn" onclick="javascript:window.location='<?php echo base_url($eventslug); ?>';">See Details</button>
																</div>
															  </li>
															</ul>
														</div>
													</div> 
												</li>
												</a>
											</ul>
											<?php } 
											}else{ ?>
											<ul class="searchul">
												<li>
													<div class="row">
														<div class="col-md-3">
															<img  width="150" height="100" src="<?php echo base_url(); ?>assets/images/Empty_Param_Profile.jpg" width="100%" alt="NO-EVENTS">
														</div>
														<div class="col-md-9 empty-paramh3">
															<h3 class="event_title">Your pram is empty, you have no events.</h3>
															<p></p>
														</div>
													</div>
												</li>
											</ul>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<!-- third tab -->
							<div class="tab-pane fade" id="past_events">
								<div class="panel-body">
									<div class="form-group">
										<div class="col-md-9  events-d">
											<?php $this->db->from('tbl_orders as tse');
							                      $this->db->where('tse.user_id', $userid);
			                                      $this->db->where('te.end_date > ', NOW());
			                                      $this->db->join('tbl_events as te', 'tse.event_id = te.id', 'LEFT'); 
							                      $query = $this->db->get();
												  $pastevent = $query->result(); if(!empty($pastevent)){{  
												  foreach($pastevent as $row){
													  $imagename = $row->image;
													  $eventslug = $row->slug;
													  $eventname = $row->name;
													  $eventdesc = $row->details;
													  $eventdate = $row->start_date;
													  $eventvenue = $row->venue;
													  $eventcity = $row->city;
												  }											  
												  ?>
											<ul class="searchul">
												<a>
												<li>
													<div class="row" style="margin-bottom: -42px !important;">
														<div class="col-md-3">
															<img width="140" height="140" src="<?php echo base_url(). 'uploads/images/full/'. $imagename; ?>">
														</div>
														<div class="col-md-9 searcheventcol">
															<h3 class="event_title"><?php echo $eventname; ?></h3>
															<ul class="header_informations">
															  <li style="border: none !important;">
																<div class="row" style="margin-left: -30px !important;">
																  <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol"><i class="fa fa-calendar" aria-hidden="true"></i> Date</div>
																  <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $eventdate; ?></div>
																
																  <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol"><i class="fa fa-ticket" aria-hidden="true"></i> Venue</div>
																  <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $eventvenue; ?></div>
																
																  <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol"><i class="fa fa-map-marker" aria-hidden="true"></i>  City</div>
																  <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $eventcity; ?></div>
																  <button id="detail-button-pr" class="btn" onclick="javascript:window.location='<?php echo base_url($eventslug); ?>';">See Details</button>
																</div>
															  </li>
															</ul>
														</div>
													</div> 
												</li>
												</a>
										    </ul>
											<?php }}else{ ?>
											<ul class="searchul">
												<li>
													<div class="row">
														<div class="col-md-3">
															<img  width="150" height="100" src="<?php echo base_url(); ?>assets/images/Empty_Param_Profile.jpg" width="100%" alt="NO-EVENTS">
														</div>
														<div class="col-md-9 empty-paramh3">
															<h3 class="event_title">Your pram is empty, you have no events.</h3>
															<p></p>
														</div>
													</div>
												</li>
											</ul>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
                <div class="col-xs-12">
                    <center>
                        <div class="col-xs-9"></div>
                    </center>
                </div>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
    $( "#datefrom" ).datepicker();
    $( "#todate" ).datepicker();
});
</script>