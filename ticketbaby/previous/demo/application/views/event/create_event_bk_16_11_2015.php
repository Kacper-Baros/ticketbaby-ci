
<div class="container-fluid content-bg">
	<div class="container content">
        <div class="row no-mar main-content leftPad">
			<?php if($this->session->flashdata('error')) { ?>                    
                        <p style="color:red">
                            <?php echo $this->session->flashdata('error');?>
                        </p>                   
                    <?php } 
					 elseif($this->session->flashdata('success')) { ?>                    
                        <p style="color:green">
                            <?php echo $this->session->flashdata('success');?>
                        </p>                   
                    <?php }?>
			<div class="col-md-6 col-xs-12">
				<h2 class="text-orange">Create An Event!</h2>
			</div>
			<form method="post" name="form" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/event/add_event">
			<div class="col-md-6 col-xs-12 text-right"><br/>
				<button class="btn btn-default btn-lg" type="submit" name="Save" value="Save">Save</button>
				<input  type="hidden" name="event_id" value="<?php echo isset($event_id) ? $event_id : "";?>" />
				
				<button class="btn btn-default btn-lg" type="button" >Preview</button>
				<button class="btn btn-success btn-lg" name="make_live" value='make_live' type="submit">Make Event Live</button>
			</div>

			<div class="col-xs-12"><hr/></div>
			<div class="col-xs-12 col-md-11 cus-form3">
				<h3 class="no-mar"><strong>1 - Event Details</strong></h3><br/>
				<div class="form-group col-xs-12">
					<label>Event Title <span class="red">*</span></label>
					<input type="text" name="title" class="form-control" placeholder="Give a short distinct name" required/>
				</div>
				<div class="form-group col-xs-12">
                    <label>Slug <span class="red">*</span></label>
                    <input   class="form-control" type="text" name="slug" value="<?php echo isset($event_details) ? $event_details['slug'] : ''?>"class="form-control" placeholder="Give a short distinct name" required>
					<p class="help-block help-block-tip">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens</p>
                </div>
				<div class="form-group col-xs-12">
					<label>Category</label>
					<input type="text" name="category" class="form-control" placeholder="Enter event category"/>
				</div>
				<div class="form-group col-xs-12">
					<label>Location</label>
					<input type="text" name="venue" class="form-control" placeholder="Specify where it held"/>
				</div>
				<div class="form-group col-md-3 col-xs-12">
					<label>Start</label>
				<div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" placeholder="10/2/2015"  name="start_date" value="" >
                    <span class="add-on"><i class="icon-remove"></i></span>
					<span class="add-on"><i class="icon-th"></i></span>
				</div>
				</div>
				<div class="form-group col-md-3 col-xs-12">
					<label>&nbsp;</label>
				  <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                    <input size="16" type="text" placeholder="10:00pm" name="start_time" value="" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
					<span class="add-on"><i class="icon-th"></i></span>
                 </div>
				</div>
				<div class="form-group col-md-3 col-xs-12">
					<label>End</label>
				<div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" placeholder="10/2/2015" name="end_date" value="" >
                    <span class="add-on"><i class="icon-remove"></i></span>
					<span class="add-on"><i class="icon-th"></i></span>
				</div>
				
				</div>
					<div class="form-group col-md-3 col-xs-12">
					<label>&nbsp;</label>
				  <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                    <input size="16" type="text" placeholder="10:00pm" name="end_time" value="" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
					<span class="add-on"><i class="icon-th"></i></span>
                 </div>
				
				</div>
				<div class="form-group col-xs-12">
					<label>Event Image</label>
					
					<input name="img_extension_main_carousel" type="file" class="form-control" >
				</div>
				<div class="form-group col-xs-12">
					<label>Event Description</label>
					<textarea class="form-control" name="detail" placeholder="Tell people what's special about this event."></textarea>
				</div>
				<div class="form-group col-xs-12">
					<label>Summary</label>
					<textarea class="form-control" name="summary" placeholder="Summary about this event."></textarea>
				</div>
				<div class="form-group col-xs-12">
					<label>Organizer Name</label>
					<input type="text" class="form-control" name="organizer_name"placeholder="Who's organizing this event?"/>
				</div>
				<div class="form-group col-xs-12">
					<label>Organizer Description</label>
					<textarea class="form-control" name="organizer_description"placeholder="Share details about the organizer."></textarea>
				</div>
				<!--h3 class="no-mar"><strong><br/>2 - Create Tickets</strong></h3><br/>
				<div class="col-xs-12 text-center">
					<p>What type of ticket would you like to start with?</p>
					<button type="button" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Free Ticket</button>
					<button type="button" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Paid Ticket</button>
					<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> Donation</button>
				</div>
				<h3 class="no-mar"><strong><br/>3 - Additional Settings</strong></h3><br/>
				<div class="form-group col-xs-12">
					<div class="radio">
					  <label>
						<input type="radio" name="optionsRadios">
						<p class="fixs">Public page: <small>list this event on Eventbrite and search engines</small></p>
					  </label><br/>
					  <label>
						<input type="radio" name="optionsRadios">
						<p class="fixs">Private page: <small>do not list this event publicly</small></p>
					  </label>
					</div>
				</div>
				 
				<!--div class="form-group col-xs-12">
					<label>Event Type</label>
					<select class="form-control">
						<option value="" selected="selected">Select Category</option>
						<option value="19">Appearance or Signing</option>
						<option value="17">Attraction</option>
						<option value="18">Camp, Trip, or Retreat</option>
						<option value="9">Class, Training, or Workshop</option>
						<option value="6">Concert or Performance</option>
						<option value="1">Conference</option>
						<option value="4">Convention</option>
						<option value="8">Dinner or Gala</option>
						<option value="5">Festival or Fair</option>
						<option value="14">Game or Competition</option>
						<option value="10">Meeting or Networking Event</option>
						<option value="100">Other</option>
						<option value="11">Party or Social Gathering</option>
						<option value="15">Race or Endurance Event</option>
						<option value="12">Rally</option>
						<option value="7">Screening</option>
						<option value="2">Seminar or Talk</option>
						<option value="16">Tour</option>
						<option value="13">Tournament</option>
						<option value="3">Tradeshow, Consumer Show, or Expo</option>
					</select>
				</div-->
				<!--div class="form-group col-xs-12">
					<label>Event Top <span class="red">*</span></label>
					<select class="form-control" required>
						<option value="" selected="selected">Select a topic</option>
						<option value="118">Auto, Boat &amp; Air</option>
						<option value="101">Business &amp; Professional</option>
						<option value="111">Charity &amp; Causes</option>
						<option value="113">Community &amp; Culture</option>
						<option value="115">Family &amp; Education</option>
						<option value="106">Fashion &amp; Beauty</option>
						<option value="104">Film, Media &amp; Entertainment</option>
						<option value="110">Food &amp; Drink</option>
						<option value="112">Government &amp; Politics</option>
						<option value="107">Health &amp; Wellness</option>
						<option value="119">Hobbies &amp; Special Interest</option>
						<option value="117">Home &amp; Lifestyle</option>
						<option value="103">Music</option>
						<option value="199">Other</option>
						<option value="105">Performing &amp; Visual Arts</option>
						<option value="114">Religion &amp; Spirituality</option>
						<option value="102">Science &amp; Technology</option>
						<option value="116">Seasonal &amp; Holiday</option>
						<option value="108">Sports &amp; Fitness</option>
						<option value="109">Travel &amp; Outdoor</option>
					</select>
				</div-->
				<!--div class="form-group col-xs-12">
					  <label>Remaining Tickets</label>
					<div class="checkbox">
					  <label>
						<input type="checkbox">
						<p class="fixs">Show the number of tickets remaining on the registration page</small></p>
					  </label>
					</div>
				</div-->
				<div class="col-xs-12 text-center">
					<h2>Nice Job! You're almost done.</h2>
					<button class="btn btn-default btn-lg" type="submit" value="Save" name="Save">Save</button>
					<button class="btn btn-default btn-lg">Choose a design</button>
					<button class="btn btn-success btn-lg" name="make_live" value='make_live' type="submit">Make Event Live</button>
				</div>
			</div>
			</form>
        </div>
    </div>
      <div class="container line"></div>
     <div class="container no-pad intrest">
     	<h1>Related to your interest</h1>
     <ul id="flexiselDemo1"> 
    <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li>
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li>
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li>
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li> 
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li> 
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li> 
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li>
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li>
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li> 
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li> 
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li> 
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li> 
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li> 
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li> 
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li> 
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li> 
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li> 
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li> 
	 <li class="intrest-pic"><img src="<?php echo base_url();?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?php echo base_url();?>images/stars.png" /></p>
     </li>
                                                         
</ul>
     </div>
     </div>
    
   
<link href="<?php echo base_url();?>assets/date/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url();?>assets/date/css/font-awesome.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php echo base_url();?>assets/date/main/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/date/main/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/date/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/date/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
       language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>