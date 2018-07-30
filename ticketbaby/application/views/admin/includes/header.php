<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=config_item('site_name');?> | Admin Panel</title>
        <link href="<?php echo admin_css('bootstrap.min.css');  ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo admin_css('londinium-theme.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo admin_css('styles.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo admin_css('icons.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo admin_css('jquery-ui.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo admin_css('stylesheet.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo admin_css('fontawesome-iconpicker.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">    
        

        <script type="text/javascript" src="<?php echo admin_js('jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('jquery-ui.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/charts/sparkline.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/forms/uniform.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/forms/select2.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/forms/inputmask.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/forms/autosize.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/forms/inputlimit.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/forms/listbox.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/forms/multiselect.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/forms/validate.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/forms/tags.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/forms/switch.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/forms/uploader/plupload.full.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/forms/uploader/plupload.queue.min.js'); ?>"></script>

        <script type="text/javascript" src="<?php echo admin_js('plugins/interface/daterangepicker.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/interface/fancybox.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/interface/moment.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/interface/jgrowl.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/interface/datatables.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/interface/colorpicker.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/interface/fullcalendar.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/interface/timepicker.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('plugins/interface/collapsible.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('application.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('jquery.slugify.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('jquery.nestable.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo admin_js('jquery.nestable++.js'); ?>"></script>
        
        <script type="text/javascript" src="<?php echo admin_js('fontawesome-iconpicker.min.js'); ?>"></script>

       
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
        <script type="text/javascript" src="<?php echo admin_js('jquery.geocomplete.js'); ?>"></script>
       

        <script>
            $(function() {
                $('.action-destroy').on('click', function() {
                    $.iconpicker.batch('.icp.iconpicker-element', 'destroy');
                });
                // Live binding of buttons
                $(document).on('click', '.action-placement', function(e) {
                    $('.action-placement').removeClass('active');
                    $(this).addClass('active');
                    $('.icp-opts').data('iconpicker').updatePlacement($(this).text());
                    e.preventDefault();
                    return false;
                });
                $('.action-create').on('click', function() {
                    $('.icp-auto').iconpicker();
                    
                    $('.icp-dd').iconpicker({
                        //title: 'Dropdown with picker',
                        //component:'.btn > i'
                    });
                    
                    $('.icp-glyphs').iconpicker({
                        title: 'Prepending glypghicons',
                        icons: $.merge(['glyphicon-home', 'glyphicon-repeat', 'glyphicon-search',
                            'glyphicon-arrow-left', 'glyphicon-arrow-right', 'glyphicon-star'], $.iconpicker.defaultOptions.icons),
                        fullClassFormatter: function(val){
                            if(val.match(/^fa-/)){
                                return 'fa '+val;
                            }else{
                                return 'glyphicon '+val;
                            }
                        }
                    });
                    $('.icp-opts').iconpicker({
                        title: 'With custom options',
                        icons: ['fa-github', 'fa-heart', 'fa-html5', 'fa-css3'],
                        selectedCustomClass: 'label label-success',
                        mustAccept: true,
                        placement: 'bottomRight',
                        showFooter: true,
                        // note that this is ignored cause we have an accept button:
                        hideOnSelect: true,
                        templates: {
                            footer: '<div class="popover-footer">' +
                                    '<div style="text-align:left; font-size:12px;">Placements: \n\
                    <a href="#" class=" action-placement">inline</a>\n\
                    <a href="#" class=" action-placement">topLeftCorner</a>\n\
                    <a href="#" class=" action-placement">topLeft</a>\n\
                    <a href="#" class=" action-placement">top</a>\n\
                    <a href="#" class=" action-placement">topRight</a>\n\
                    <a href="#" class=" action-placement">topRightCorner</a>\n\
                    <a href="#" class=" action-placement">rightTop</a>\n\
                    <a href="#" class=" action-placement">right</a>\n\
                    <a href="#" class=" action-placement">rightBottom</a>\n\
                    <a href="#" class=" action-placement">bottomRightCorner</a>\n\
                    <a href="#" class=" active action-placement">bottomRight</a>\n\
                    <a href="#" class=" action-placement">bottom</a>\n\
                    <a href="#" class=" action-placement">bottomLeft</a>\n\
                    <a href="#" class=" action-placement">bottomLeftCorner</a>\n\
                    <a href="#" class=" action-placement">leftBottom</a>\n\
                    <a href="#" class=" action-placement">left</a>\n\
                    <a href="#" class=" action-placement">leftTop</a>\n\
                    </div><hr></div>'}
                    }).data('iconpicker').show();
                }).trigger('click');


                // Events sample:
                // This event is only triggered when the actual input value is changed
                // by user interaction
                $('.icp').on('iconpickerSelected', function(e) {
                    $('.lead .picker-target').get(0).className = 'picker-target fa-3x ' +
                            e.iconpickerInstance.options.iconBaseClass + ' ' +
                            e.iconpickerInstance.options.fullClassFormatter(e.iconpickerValue);
                });
            });
        </script>



  <script>
  $(function() {
      
         $( "#time" ).timepicker();
      
      $("#from_date").datepicker({
          dateFormat: 'dd/mm/yy'
      });
      $("#to_date").datepicker({
          dateFormat: 'dd/mm/yy'
      });
    $( "#start_date" ).datepicker({
        dateFormat: 'dd/mm/yy'
    });
    $( "#end_date" ).datepicker({
         dateFormat: 'dd/mm/yy'
    });
    $( "#start_date1" ).datepicker({
        dateFormat: 'dd/mm/yy'
    });
    $( "#end_date1" ).datepicker({
        dateFormat: 'dd/mm/yy'
    });
 
  });
  </script>


        <script type="text/javascript" charset="utf-8">
            $().ready(function () {
                $('.slug').slugify('#title');
            
                var pigLatin = function(str) {
                    return str.replace(/(\w*)([aeiou]\w*)/g, "$2$1ay");
                }
            
                $('#pig_latin').slugify('#title', {
                        slugFunc: function(str, originalFunc) { return pigLatin(originalFunc(str)); } 
                    }
                );
            
            }); 
        </script>

        <script>
              $(function(){

                        $("#geocomplete").geocomplete({
                          map: ".map_canvas",
                          details: "form ",
                          markerOptions: {
                            draggable: true,
                            zoom: true
                          }
                        });
                        
                        $("#geocomplete").bind("geocode:dragged", function(event, latLng){
                          $("input[name=lat]").val(latLng.lat());
                          $("input[name=lng]").val(latLng.lng());
                          $("#reset").show();
                        });
                        
                        
                        $("#reset").click(function(){
                          $("#geocomplete").geocomplete("resetMarker");
                          $("#reset").hide();
                          return false;
                        });
                        
                        $("#find").click(function(){
                          $("#geocomplete").trigger("geocode");
                        }).click();
                      });
        </script>   


    </head>
    <body class="sidebar-wide">
        <!-- Navbar -->
        <div class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo admin_url(); ?>">
                    <h6><?php echo $logo->site_title; ?></h6>
                </a>
                <a class="sidebar-toggle"><i class="icon-paragraph-justify2"></i></a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-icons">
                    <span class="sr-only">Toggle navbar</span><i class="icon-grid3"></i>
                </button>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar">
                    <span class="sr-only">Toggle navigation</span><i class="icon-paragraph-justify2"></i>
                </button>
            </div>
            <ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
                <li class="user dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo site_url('uploads/logo/'.$logo->image); ?>" alt="">
                        <span><?=$this->session->userdata('admin_name');?></span>
                        <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right icons-right">
                        <li><a href="<?= admin_url('settings/profile'); ?>"><i class="icon-user"></i> Profile</a></li>
                        <li><a href="<?=admin_url('settings'); ?>"><i class="icon-cog"></i> Settings</a></li>
                        <li><a href="<?=admin_url('login/logout');?>"><i class="icon-exit"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /navbar -->
		<div class="modal fade" id="exportmodal" role="dialog">
		  <div class="modal-dialog"> 
			<!-- Modal content to Export Fields list -->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Select Fields to Export Data</h4>
			  </div>
			  <div class="modal-body">
				<form action="<?php echo admin_url('orders/export_orders'); ?>" method="" id="ExportsFields">
				<div class="row">
				  <div class="col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<select class="form-control" name="selectedEvent_id">
							<option value="">---SELECT EVENT---</option>
							<?php $eventList = $this->db->get_where('tbl_events', array('status' => '1'))->result();
							foreach($eventList as $evnt){
							?>
							<option value="<?php echo $evnt->id; ?>"><?php echo $evnt->name;?></option>	
							<?php } ?>
						</select>
					</div>
					<?php
						$fields = $this->db->list_fields('tbl_orders');
					?>
					<div class="multiselect form-group" style="height: 320px; overflow: auto;">
					<table class="table table-bordered table-striped">
					<br>
						<?php 
						$FieldsLabels = '';
						$cnt=1;
						foreach($fields as $field){
							if($field==='id'){
								$FieldsLabels = "Order ID";
							}
							if($field==='event_id'){
								$FieldsLabels = "Event Name";
							}
							if($field==='customer_first_name'){
								$FieldsLabels = "First Name";
							}
							if($field==='customer_last_name'){
								$FieldsLabels = "Last Name";
							}
							if($field==='customer_email'){
								$FieldsLabels = "Email ID";
							}
							if($field==='customer_phone'){
								$FieldsLabels = "Phone Number";
							}
							if($field==='cardholder_first_name'){
								$FieldsLabels = "Card Holder First Name";
							}
							if($field==='cardholder_last_name'){
								$FieldsLabels = "Card Holder Last Name";
							}
							if($field==='cardholder_email'){
								$FieldsLabels = "Card Holder Email ID";
							}
							if($field==='cardholder_address'){
								$FieldsLabels = "Address";
							}
							if($field==='cardholder_area'){
								$FieldsLabels = "Area";
							}
							if($field==='cardholder_city'){
								$FieldsLabels = "City";
							}
							if($field==='cardholder_country'){
								$FieldsLabels = "Country";
							}
							if($field==='cardholder_post_code'){
								$FieldsLabels = "Post Code";
							}
							if($field==='cardholder_contact_number'){
								$FieldsLabels = "Contact Number";
							}
							if($field==='cardholder_mobile_number'){
								$FieldsLabels = "Mobile Number";
							}
							if($field==='subtotal'){
								$FieldsLabels = "Total";
							}
							if($field==='payment_status'){
								$FieldsLabels = "Payment Status";
							}
							if($field==='cart_id'){
								$FieldsLabels = "Cart ID";
							}
							if($field==='verified'){
								$FieldsLabels = "Verified";
							}
							if($field==='created'){
								$FieldsLabels = "Date";
							}
							if($field==='table'){
								$FieldsLabels = "Table";
							}
							if($field==='ticket_table'){
								$FieldsLabels = "Table Tickets";
							}
							if($field==='addtional'){
								$FieldsLabels = "Additionals";
							}
							if($field==='tickets'){
								$FieldsLabels = "Tickets Only";
							}
							if($field==='coupon_id'){
								$FieldsLabels = "Coupon";
							}
							if($field==='user_id'){
								$FieldsLabels = "User Name";
							}
							
							if($cnt%2==0){
								$color = "#e5e5e5";
							}
							else{
								$color = "#fcfcfc";
							}
						?>
						<tr class="background-color: <?php echo $color; ?>">
							<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<label data-labelfor="CityTown"><input type="checkbox" class="chk_status" name="export_fields[]" value="<?php echo $field; ?>" />&nbsp;&nbsp;<?php echo $FieldsLabels; ?></label><br>
							</td>
						</tr>
						<?php $cnt++; } ?>
						</table>
					</div>
				  </div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="submit" id="submitExport" class="btn btn-primary">Export</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			  </form>
			</div>
		  </div>
		</div>