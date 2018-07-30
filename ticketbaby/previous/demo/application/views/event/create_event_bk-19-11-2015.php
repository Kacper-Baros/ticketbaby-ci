
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
					<div class="col-md-8 col-xs-12 btnVus">
  <div class="" role="group" aria-label="...">
	
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/account_detail">Account Details</a></button>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/change_password">Change Password</a></button>
	</div>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/order_detail">Order Details</a></button>
	</div>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/my_event">My Events</a></button>
	</div>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/logout">Logout</a></button>
	</div>
	
  </div>
        </div>
			<div class="col-md-6 col-xs-12">
				<h2 class="text-orange">Create An Event!</h2>
			</div>
			<form method="post" name="form" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/event/add_event">
			<div class="col-md-6 col-xs-12 text-right"><br/>
				<button class="btn btn-default btn-lg" type="submit" name="Save" value="Save">Save</button>
				<input  type="hidden" name="event_id" value="<?php echo isset($event_id) ? $event_id : "";?>" />
				
			
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
					<span class="add-on"><i class="icon-th"><img src="<?php echo base_url();?>assets/images/calender.png"/></i></span>
					
				</div>
				</div>
				<div class="form-group col-md-3 col-xs-12">
					<label>&nbsp;</label>
				  <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                    <input size="16" type="text" placeholder="10:00pm" name="start_time" value="" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
					<span class="add-on"><i class="icon-th"><img src="<?php echo base_url();?>assets/images/calender.png"/></i></span>
                 </div>
				</div>
				<div class="form-group col-md-3 col-xs-12">
					<label>End</label>
				<div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" placeholder="10/2/2015" name="end_date" value="" >
                    <span class="add-on"><i class="icon-remove"></i></span>
					<span class="add-on"><i class="icon-th"><img src="<?php echo base_url();?>assets/images/calender.png"/></i></span>
				</div>
				
				</div>
					<div class="form-group col-md-3 col-xs-12">
					<label>&nbsp;</label>
				  <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                    <input size="16" type="text" placeholder="10:00pm" name="end_time" value="" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
					<span class="add-on"><i class="icon-th"><img src="<?php echo base_url();?>assets/images/calender.png"/></i></span>
                 </div>
				
				</div>
				<div class="form-group col-xs-12">
					<label>Event Image</label>
					<input name="img_extension_main_carousel" type="file" class="form-control" required>
			<p class="help-block help-block-tip">(Image max size limit 2 mb)</p>
             
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
				
				<div class="col-xs-12 text-center">
					<h2>Nice Job! You're almost done.</h2>
					<button class="btn btn-default btn-lg" type="submit" value="Save" name="Save">Save</button>
					<!--button class="btn btn-default btn-lg">Choose a design</button-->
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