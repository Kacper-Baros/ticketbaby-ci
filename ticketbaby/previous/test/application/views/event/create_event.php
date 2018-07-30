
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
				<div class="col-xs-12">
				<nav class="navbar navbar-default subNav">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#subNav">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                    </div>
                    <div class="collapse navbar-collapse" id="subNav">
                      <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url();?>index.php/user/editProfile"><i class="glyphicon glyphicon-list-alt"></i> Account Details</a></li>
						<li><a href="<?php echo base_url();?>index.php/user/order_detail"><i class="glyphicon glyphicon-tasks"></i> Order Details</a></li>
						<li><a href="<?php echo base_url();?>index.php/user/my_event"><i class="glyphicon glyphicon-calendar"></i> My Events</a></li>
                        <?php if($user_detail['id']!=''){ ?>
                        <li class="<?php if($this->router->fetch_method()=='add_event'){ echo "userActiveMenu"; } ?> " >
                            <a href="<?php echo base_url();?>index.php/Event/add_event"><i class="glyphicon glyphicon-calendar"></i> Create An Event</a>
                        </li>
                        <?php } ?>
                      </ul>                                                                   
					  <ul class="nav navbar-nav navbar-right">
					  <li class="dropdown">
						<a href="" data-toggle="dropdown" class="dropdown-toggle"><i class="glyphicon glyphicon-cog"></i>&nbsp;<?php echo ($user_detail['user_name']);?> <b class="caret"></b></a>
						<ul class="dropdown-menu"> 
							<li><a href="<?php echo base_url();?>index.php/user/logout"><i class="glyphicon glyphicon-log-in"></i> Logout</a></li>
							<li><a href="<?php echo base_url();?>index.php/user/editProfile"><i class="glyphicon glyphicon-pencil"></i> Edit Profile</a></li>
						</ul>
					  </li> 
					  </ul>
                    </div>
                </nav>
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
                    <input   class="form-control" type="text" name="slug" value="<?php echo isset($event_details) ? $event_details['slug'] : '' ?>" placeholder="Give a short distinct name" required>
					<p class="help-block help-block-tip">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens</p>
                </div>
                
				<div class="form-group col-xs-12">
					<label>Category</label>   
				   	<?php  
						if($categoriesDropDown!=''){
							echo $categoriesDropDown;
						}
					?>                 
					<!--<input type="text" name="category" class="form-control" placeholder="Enter event category"/>-->
				</div>
                
                
                <div class="form-group col-xs-12">
					<label>Country</label>
					<select name="country" class="country" id="country">
                    	<option>Select Country</option>
                        <?php
							if(!empty($countries)){
								foreach($countries as $country){
									echo "<option value='".$country['id']."'>".$country['name']."</option>";
								}
							}
						?>
                    </select>
				</div>
                
                <div class="form-group col-xs-12">
					<label>State</label>
					<select name="state" class="state" id="state" disabled='disabled'>
                    	<option>Select State</option>
                    </select>
				</div>
                
                <div class="form-group col-xs-12">
					<label>City</label>
					<select name="city" class="city" id="city" disabled='disabled'>
                    	<option>Select City</option>
                    </select>
				</div>
                
                <div class="form-group col-xs-12">
					<label>Address</label>
					<input type="text" name="address" class="form-control" placeholder="Specify Address"/>
				</div>
                
                <div class="form-group col-xs-12">
					<label>Province</label>
					<input type="text" name="province" class="form-control" placeholder="Specify Province"/>
				</div> 
                
				<div class="form-group col-xs-12">
					<label>Venue</label>
					<input type="text" name="venue" class="form-control" placeholder="Specify Venue"/>
				</div>
                
                
				<div class="form-group col-md-3 col-xs-12">
					<label>Start</label>
				<div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" type="text" placeholder="10/2/2015"  name="start_date" value="" >
                    <span class="add-on"><i class="icon-remove"></i></span>
					<span class="add-on"style="position   : absolute;
													right		:7%;
													top	 	   : 0px;
													margin-top : 35px;">
					<i class="icon-th"><img src="<?php echo base_url();?>assets/images/calender.png"/></i></span>
					
				</div>
				</div>
				
				<div class="form-group col-md-3 col-xs-12">
					<label>&nbsp;</label>
				  <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                    <input class="form-control" type="text" placeholder="10:00pm" name="start_time" value="" readonly >
                    <span class="add-on"><i class="icon-remove"></i></span>
					<span class="add-on" style="position   : absolute;
													right		: 7%;
													top	 	   : 0px;
													margin-top : 35px;">
					<i class="icon-th"><img src="<?php echo base_url();?>assets/images/calender.png"/></i></span>
                 </div>
				</div>
                
				<div class="form-group col-md-3 col-xs-12">
					<label>End</label>
				<div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" type="text" placeholder="10/2/2015" name="end_date" value="" >
                    <span class="add-on"><i class="icon-remove"></i></span>
					<span class="add-on"style="position   : absolute;
													right		: 7%;
													top	 	   : 0px;
													margin-top : 35px;">
					<i class="icon-th"><img src="<?php echo base_url();?>assets/images/calender.png"/></i></span>
				</div>
				
				</div>
					<div class="form-group col-md-3 col-xs-12">
					<label>&nbsp;</label>
				  <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                    <input class="form-control"  type="text" placeholder="10:00pm" name="end_time" value="" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
					<span class="add-on"style="position   : absolute;
													right		: 7%;
													top	 	   : 0px;
													margin-top : 35px;">
					<i class="icon-th"><img src="<?php echo base_url();?>assets/images/calender.png"/></i></span>
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
                
                <h3 class="no-mar"><strong>Organiser Details</strong></h3><br/>
				<div class="form-group col-xs-12">
					<label>Organizer Name</label>
					<input type="text" class="form-control" name="organizer_name" placeholder="Who's organizing this event?"/>
				</div>
                
                <div class="form-group col-xs-12">
					<label>Contact Number</label>
					<input type="text" class="form-control" name="organizer_contact_number" placeholder="Contact Number of Organizer[0-9]"/>
				</div>
                
                <div class="form-group col-xs-12">
					<label>Email</label>
					<input type="email" class="form-control" name="organizer_email_id" placeholder="Email-id of Organizer"/>
				</div>
                
                <div class="form-group col-xs-12">
					<label>Website</label>
					<input type="text" class="form-control" name="organizer_website" placeholder="Website of Organizer"/>
				</div>
                
				<div class="form-group col-xs-12">
					<label>Organizer Description</label>
					<textarea class="form-control" name="organizer_description" placeholder="Share details about the organizer."></textarea>
				</div>
                
                <div class="form-group col-xs-12">
					<label>Event Type</label>
					Free:<input type="radio" name="event_type" value="free" />
					Paid:<input type="radio" name="event_type" value="paid" />
				</div>
				
				<div class="col-xs-12 text-center">
					<h2>Nice Job! You're almost done.</h2>
                    <input type="hidden" class="form-control" value="<?php echo $user_detail['id']; ?>" name="user_id"  />
					<button class="btn btn-default btn-lg" type="submit" value="Save" name="Save">Save</button>
					<!--button class="btn btn-default btn-lg">Choose a design</button-->
					<button class="btn btn-success btn-lg" name="make_live" value='make_live' type="submit">Make Event Live</button>
				</div>
			</div>
			</form>
        </div>
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
	
	$(document).ready(function(){
		//GET STATES LIST DEPENDING ON COUNTRY
		$('.country').on('change',function(){
			var countryId = $('#country').val();
			
			$.ajax({
				type: 'POST',        
				url: '<?php echo base_url();?>index.php/event/getStatesList',
				data: ({countryId:countryId}),
				cache: false,
				success:function(data) 
				{
					if(data!='')
						$('#state').html(data);
						$('#state').removeAttr('disabled');
				},
				error:function()
				{
					alert("An Error has occurred!!");
				}
			});	
		});
		
		
		//GET CITIES LIST DEPENDING ON STATE
		$('.state').on('change',function(){
			var stateId = $('#state').val();
			
			$.ajax({
				type: 'POST',        
				url: '<?php echo base_url();?>index.php/event/getCitiesList',
				data: ({stateId:stateId}),
				cache: false,
				success:function(data) 
				{
					if(data!='')
						$('#city').html(data);
						$('#city').removeAttr('disabled');
				},
				error:function()
				{
					alert("An Error has occurred!!");
				}
			});	
		});
	});
	
	
	
</script>