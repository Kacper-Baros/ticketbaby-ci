<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?=$title;?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->


        <div class="row">

            <div class="col-lg-12">
            <div class="panel">
            <div class="panel-body">    
            <form role="form" method="post" class="form-admin-event-creation" enctype="multipart/form-data"  action="">
                    
                <div class="col-lg-12">

                    <div class="col-lg-6">
                    <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="title" value="<?php echo isset($event_details) ? $event_details['title'] : ''?>" placeholder="Enter text">
                    <p class="help-block help-block-tip">The name is how it appears on your site.</p>
                    </div>

                    <div class="form-group">
                    <label>Slug</label>
                    <input class="form-control" name="slug" value="<?php echo isset($event_details) ? $event_details['slug'] : ''?>" placeholder="Enter text">
                    <p class="help-block help-block-tip">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens</p>
                    </div>

                    <div class="form-group">
                    <label>Category</label>
                    <?php	
						if(isset($_GET['comingfrom']))
							$category_id = isset($event_details) ? $event_details['category'] : 0;
						else					
                        	$category_id = isset($event_details) ? $event_details['category_id'] : 0;
                    ?>
                    <select name="category_id" class="form-control">
                        <?php
                        foreach($category_tree['category_name'] as $k=>$row) {
                            if ( $category_id == $category_tree['cat_id'][$k] ) {
                                echo "<option selected value=".$category_tree['cat_id'][$k].">".$row."</option>"; 
                            }else {    
                                echo "<option value=".$category_tree['cat_id'][$k].">".$row."</option>";    
                            }                  
                        }
                        ?>   
                    </select>
                    </div>

                    <div class="form-group">
                    <label>Start Date</label>
                    <!--<input class="form-control" name="start_date" value="<?php echo isset($event_details) ? $event_details['start_date'] : ''?>" placeholder="Enter text">-->
                    
                        <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
<input class="form-control" type="text" placeholder=""  name="start_date" value="<?php echo isset($event_details) ? date("j F Y", strtotime($event_details['start_date'])) : ''?>" readonly  >
                            <span class="add-on"><i class="icon-remove"></i></span>
                            <span class="add-on"style="position   : absolute;
                                                            right		:7%;
                                                            top	 	   : 0px;
                                                            margin-top : 35px;">
                            <i class="icon-th"><img src="<?php echo base_url();?>assets/images/calender.png"/></i></span>
                            
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                   	 <label>Start Time</label>
                          <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                            <input class="form-control" type="text" placeholder="10:00pm" name="start_time" value="<?php echo isset($event_details) ? $event_details['start_time'] : ''?>" readonly >
                            <span class="add-on"><i class="icon-remove"></i></span>
                            <span class="add-on" style="position   : relative;
                                                            left		: 89%;
                                                            top	 	   : -26px;
                                                            ">
                            <i class="icon-th"><img src="<?php echo base_url();?>assets/images/calender.png"/></i></span>
                         </div>
					</div>

                    <div class="form-group">
                    <label>End Date</label>
                    <!--<input class="form-control" name="end_date" value="<?php echo isset($event_details) ? $event_details['end_date'] : ''?>" placeholder="Enter text">-->
                        <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input class="form-control" type="text" placeholder="10/2/2015" name="end_date" value="<?php echo isset($event_details) ? date("j F Y", strtotime($event_details['end_date'])) : ''?>" readonly >
                            <span class="add-on"><i class="icon-remove"></i></span>
                            <span class="add-on"style="left		: 89%;
                                                    position: relative;
                                                    top: -26px;">
                            <i class="icon-th"><img src="<?php echo base_url();?>assets/images/calender.png"/></i></span>
                        </div>
                        <p class="help-block help-block-tip">YYYY-MM-DD HH-MM (2015-10-31 18:30)</p>
                    </div>
                    
                    <div class="form-group">
                    	<label>End Time</label>
                        <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                        <input class="form-control"  type="text" placeholder="10:00pm" name="end_time" value="<?php echo isset($event_details) ? $event_details['end_time'] : ''?>" readonly>
                        <span class="add-on"><i class="icon-remove"></i></span>
                        <span class="add-on"style="left		: 89%;
                                                    position: relative;
                                                    top: -26px;">
                        <i class="icon-th"><img src="<?php echo base_url();?>assets/images/calender.png"/></i></span>
                        </div>
					</div>

                    <div class="form-group">
                    <label>Summary</label>
                    <textarea class="form-control" name="summary" rows="2"><?php echo isset($event_details) ? $event_details['summary'] : ''?></textarea>
                    </div>

                    <div class="form-group">
                    <label>Details</label>
                    <textarea class="form-control" name="details" rows="4"><?php echo isset($event_details) ? $event_details['details'] : ''?></textarea>
                    </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="panel">
                        <div class="panel-body"> 
                            <h4>Additional Details</h4>


                            <div class="form-group">
                            <label>Charity</label>
                            <input class="form-control" name="additional_charity" value="<?php echo isset($event_details) ? $event_details['additional_charity'] : ''?>" placeholder="Enter Amount">
                            <p class="help-block help-block-tip">Charity</p>
                            </div>

                            <div class="form-group">
           
                                <label>Fulfilment Fees</label>
                                <input class="form-control" name="fulfilment_fee" value="<?php echo isset($event_additional_charge) && isset($event_additional_charge['fulfilment_fee'])  ? $event_additional_charge['fulfilment_fee']['additional_charge'] : ''?>" placeholder="Enter Amount">
                                <p class="help-block help-block-tip">Fulfilment Fees</p>
                                <div class="radio">
                                <label class="radio-inline"><input name="fulfilment_fee_type" type="radio" value="P" <?php echo ( !isset($event_additional_charge)  || isset($event_additional_charge['fulfilment_fee']) && $event_additional_charge['fulfilment_fee']['additional_charge_type'] == 'P') ? 'checked' : ''?> >Percentage</label>
                                <label class="radio-inline"><input name="fulfilment_fee_type" type="radio" value="F" <?php echo ( isset($event_additional_charge) && isset($event_additional_charge['fulfilment_fee']) && $event_additional_charge['fulfilment_fee']['additional_charge_type'] == 'F') ? 'checked' : ''?> >Flat</label>
                                </div>
                            </div>

                           
                            <div class="form-group">
                                <label>Registered Postage Fees</label>
                                <input class="form-control" name="registered_postage_fee" value="<?php echo isset($event_additional_charge) && isset($event_additional_charge['registered_postage_fee'])  ? $event_additional_charge['registered_postage_fee']['additional_charge'] : ''?>" placeholder="Enter Amount">
                                <p class="help-block help-block-tip">Postage Fees</p>
                                <div class="radio">
                                <label class="radio-inline"><input name="registered_postage_fee_type" type="radio" value="P" <?php echo ( !isset($event_additional_charge)  || isset($event_additional_charge['registered_postage_fee']) && $event_additional_charge['registered_postage_fee']['additional_charge_type'] == 'P') ? 'checked' : ''?>>Percentage</label>
                                <label class="radio-inline"><input name="registered_postage_fee_type" type="radio" value="F" <?php echo ( isset($event_additional_charge) && isset($event_additional_charge['registered_postage_fee']) && $event_additional_charge['registered_postage_fee']['additional_charge_type'] == 'F') ? 'checked' : ''?> >Flat</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Special delivery Postage Fees</label>
                                <input class="form-control" name="special_postage_fee" value="<?php echo isset($event_additional_charge) && isset($event_additional_charge['special_postage_fee'])  ? $event_additional_charge['special_postage_fee']['additional_charge'] : ''?>" placeholder="Enter Amount">
                                <p class="help-block help-block-tip">Postage Fees</p>
                                <div class="radio">
                                <label class="radio-inline"><input name="special_postage_fee_type" type="radio" value="P" <?php echo ( !isset($event_additional_charge)  || isset($event_additional_charge['special_postage_fee']) && $event_additional_charge['special_postage_fee']['additional_charge_type'] == 'P') ? 'checked' : ''?>>Percentage</label>
                                <label class="radio-inline"><input name="special_postage_fee_type" type="radio" value="F" <?php echo ( isset($event_additional_charge) && isset($event_additional_charge['special_postage_fee']) && $event_additional_charge['special_postage_fee']['additional_charge_type'] == 'F') ? 'checked' : ''?> >Flat</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Credit Card Charges</label>
                                <input class="form-control" name="credit_card_fee" value="<?php echo isset($event_additional_charge) && isset($event_additional_charge['credit_card_fee'])  ? $event_additional_charge['credit_card_fee']['additional_charge'] : ''?>" placeholder="Enter Amount">
                                <p class="help-block help-block-tip">Credit Card Charges</p>
                                <div class="radio">
                                <label class="radio-inline"><input name="credit_card_fee_type" type="radio" value="P" <?php echo ( !isset($event_additional_charge)  || isset($event_additional_charge['credit_card_fee']) && $event_additional_charge['credit_card_fee']['additional_charge_type'] == 'P') ? 'checked' : ''?>>Percentage</label>
                                <label class="radio-inline"><input name="credit_card_fee_type" type="radio" value="F" <?php echo ( isset($event_additional_charge) && isset($event_additional_charge['credit_card_fee']) && $event_additional_charge['credit_card_fee']['additional_charge_type'] == 'F') ? 'checked' : ''?>>Flat</label>
                                </div>
                            </div>
                
                        </div>
                        </div>

                        <div class="panel">
                        <div class="panel-body"> 
                            <div class="form-group">
                            <label>Google Map location [Embed map iframe's src]</label>
                            <input class='form-control' name='map_location' value='<?php echo isset($event_details) && isset($event_details['map_location'])  ?  $event_details['map_location'] : ''?>' placeholder='Enter URL'>
                            <p class="help-block help-block-tip">Example: https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2430.2058433426973!2d-1.91382...<a target="_blank" href="<?=base_url()?>assets/images/event-map-location-example.png" class="btn-md"><span class="glyphicon glyphicon-zoom-in"></span></a></p>
                            </div>

                            <div class="form-group">
                            <?php echo isset($event_details) && isset($event_details['youtube_url'])  ? $event_details['youtube_url'] : ''?>
                            <label>Youtube URL [Embed url]</label>
                            <input class='form-control' name='youtube_url' value='<?php echo isset($event_details) && isset($event_details['youtube_url'])  ? stripslashes($event_details['youtube_url']) : ''?>' placeholder='Enter URL'>
                            <p class="help-block help-block-tip">Example: https://www.youtube.com/embed/RlgOoZJ4FNo <a target="_blank" href="<?=base_url()?>assets/images/event-youtube-url-example.png" class="btn-md"><span class="glyphicon glyphicon-zoom-in"></span></a></p>
                            </div>

                        </div>
                        </div>
                    </div>
               
                </div>    





                <div class="col-lg-12">
                    <div class="col-lg-6">
                    <div class="form-group">
                    <label>Venue</label>
                    <input class="form-control" name="venue" value="<?php echo isset($event_details) ? $event_details['venue'] : ''?>" placeholder="Enter text">
                    </div>


                    <div class="form-group">
                    <label>Address</label>
                    <input class="form-control" name="address" value="<?php echo isset($event_details) ? $event_details['address'] : ''?>" placeholder="Enter text">
                    </div>
                    </div>
                    

                    <div class="col-lg-6">
                    
                    <div class="form-group">
                    <label>Country</label>
                    <select name="country" class="country form-control" id="country">
                    	<option value="">Select Country</option>
                        <?php
							
							if(!empty($countries)){
								foreach($countries as $country){
									if($event_details['country']==$country['id'])
										$selected = "selected";
									else
										$selected = "";
									echo "<option value='".$country['id']."' ".$selected.">".$country['name']."</option>";
								}
							}
						?>
                    </select>
                    <!--<input class="form-control" name="country" value="<?php echo isset($event_details) ? $event_details['country'] : ''?>" placeholder="Enter text">-->
                    </div>
                    
                    <div class="form-group">
                    <label>State</label>
                     
                    <select name="state" class="state form-control" id="state">
                    	<option value="">Select State</option>
                        <?php
							$states = get_states_by_country_id($event_details['country']);
							if(!empty($states)){
								foreach($states as $state){
									if($event_details['state']==$state->id)
										$selected = "selected";
									else
										$selected = "";
									echo "<option value='".$state->id."' ".$selected.">".$state->name."</option>";
								}
							}
						?>
                    </select>
                    <!--<input class="form-control" name="country" value="<?php echo isset($event_details) ? $event_details['country'] : ''?>" placeholder="Enter text">-->
                    </div>
                    
                    <div class="form-group">
                    <label>City</label>
                        <select name="city" class="city form-control" id="city">
                            <option value="">Select City</option>
                            <?php  
							
								$cities = get_cities_by_country_id($event_details['state']);                              
                                if(!empty($cities)){
                                    foreach($cities as $city){
                                        if($event_details['city']==$city->id)
                                            $selected = "selected";
                                        else
                                            $selected = "";
                                        echo "<option value='".$city->id."' ".$selected.">".$city->name."</option>";
                                    }
                                }
                            ?>
                        </select>
                    <!--<input class="form-control" name="city" value="<?php echo isset($event_details) ? $event_details['city'] : ''?>" placeholder="Enter text">-->
                    </div>
                    

                     
                    </div>
                </div>    

                  
                <div class="col-lg-12">
                    <div class="panel">
                    <div class="panel-body"> 
                    <div class="col-lg-12 pull-left">
                    <div class="form-group">
                    <label>Active</label>
                        <div class="radio">
                            <label><input type="radio" name="active" value="Y" <?php echo ( !isset($event_details)  || isset($event_details) && $event_details['active'] == 'Y') ? 'checked' : ''?> >True</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="N" name="active" <?php echo (isset($event_details) && $event_details['active'] == 'N') ? 'checked' : ''?> >False</label>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="panel">
                    <div class="panel-body"> 
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label>Detail Thumbnail</label>
                        <input name="img_extension" type="file" value=""> 
                        
                        <p class="help-block help-block-tip">[350*400 - width*height]</p>   
                        </div>
                        <?php if(!isset($_GET['comingfrom'])){  ?>
                        
                        <?php if ( isset($event_details) && $event_details['img_extension'] != "" ) { ?>
                        <div class="form-group">
                        <?php if(!isset($user_event_id)){ ?>
                        <a href="<?=base_url()?>assets/upload/event/user_event_img_<?=$event_details['user_event_id'] . $event_details['img_extension'];?>" target="_blank">
                        <img src="<?=base_url()?>assets/upload/event/thumb/<?=$event_details['thumb1'];?>" style="max-width:200px;max-height:300px;" />
                        </a>
                        <?php }else{ ?>
                        <a href="<?=base_url()?>assets/upload/event/event_img_<?=$event_id . $event_details['img_extension']; ?>" target="_blank">
                        <img src="<?=base_url()?>assets/upload/event/event_img_<?=$event_id . $event_details['img_extension'];?>" style="max-width:200px;max-height:300px;" />
                        </a>
                        <?php } ?>
                        </div>
                        <?php } ?>
                        <?php }else{ ?>
                        <input type="hidden" name="paid_user_event_thumb1" value="<?=$event_details["thumb1"];?>"  />
                        <input type="hidden" name="paid_user_event_thumb2" value="<?=$event_details["thumb2"];?>"  />
                        <img src="<?= base_url()?>assets/upload/event/thumb/<?=$event_details["thumb1"];?>" style="max-width:200px;max-height:300px;" />
                        <?php } ?>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label>Main carousal Thumbnail</label>
                        <input name="img_extension_main_carousel" type="file" >   
                        <p class="help-block help-block-tip">[175*328 - width*height]</p>   
                        </div>
                        <?php if ( isset($event_details) && $event_details['img_extension_main_carousel'] != "" ) { ?>
                         <?php if(!isset($_GET['comingfrom'])){ ?>
                        <div class="form-group">
                        <a href="<?=base_url()?>assets/upload/event/thumb/<?=$event_details['thumb1_main_carousel'];?>" target="_blank">
                        <img src="<?=base_url()?>assets/upload/event/thumb/<?=$event_details['thumb1_main_carousel'];?>" style="max-width:200px;max-height:300px;" />
                        </a>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label>Reccommended carousal Thumbnail</label>
                        <input name="img_extension_recommended_carousel" type="file" > 
                        <p class="help-block help-block-tip">[175*130 - width*height]</p>     
                        </div>
                        <?php if ( isset($event_details) && $event_details['img_extension_recommended_carousel'] != "" ) { ?>
                        <?php if(!isset($_GET['comingfrom'])){ ?>
                        <div class="form-group">
                        <a href="<?=base_url()?>assets/upload/event/event_img_recommended_carousel_<?=$event_id . $event_details['img_extension_recommended_carousel'];?>" target="_blank">
                        <img src="<?=base_url()?>assets/upload/event/event_img_recommended_carousel_<?=$event_id . $event_details['img_extension_recommended_carousel'];?>" style="max-width:200px;max-height:300px;" />
                        </a>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="panel">
                    <div class="panel-body">
                    <h4>Event Visibility</h4>
                        <div class="col-lg-3">
                            <div class="checkbox">
                            <label><input type="checkbox" name="show_main_carousel" value="Y" <?php echo ( isset($event_details) && $event_details['show_main_carousel'] == 'Y') ? 'checked' : ''?> >Show event in main carousal</label>
                            </div>
                            <div class="checkbox">
                            <label><input type="checkbox" name="show_recommended_carousel" value="Y" <?php echo ( isset($event_details) && $event_details['show_recommended_carousel'] == 'Y') ? 'checked' : ''?>  >Show event in recommended carousal</label>
                            </div> 
                            <div class="checkbox">
                            <label><input type="checkbox" name="show_hot_ticket" value="Y" <?php echo ( isset($event_details) && $event_details['show_hot_ticket'] == 'Y') ? 'checked' : ''?> >Show event in hot ticket</label>
                            </div>
                            <div class="checkbox">
                            <label><input type="checkbox" name="show_just_announced" value="Y" <?php echo ( isset($event_details) && $event_details['show_just_announced'] == 'Y') ? 'checked' : ''?> >Show event in just announced</label>
                            </div>           
                        </div>

                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                <div class="form-group">
                                <label>Tooltip title</label>
                                <input class="form-control" name="hot_ticket_tootip_title" value="<?php echo isset($event_details) ? $event_details['hot_ticket_tootip_title'] : ''?>" placeholder="Enter text">
                                <p class="help-block help-block-tip">Hot ticket tooltip title</p>
                                <br/>
                                <label>Tooltip content</label>
                                <textarea class="form-control" name="hot_ticket_tootip_details" rows="2"><?php echo isset($event_details) ? $event_details['hot_ticket_tootip_details'] : ''?></textarea>
                                <p class="help-block help-block-tip">Hot ticket tooltip content</p>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                <label>Tooltip title</label>
                                <input class="form-control" name="just_announced_tootip_title" value="<?php echo isset($event_details) ? $event_details['just_announced_tootip_title'] : ''?>" placeholder="Enter text">
                                <p class="help-block help-block-tip">Just announced tooltip title</p>
                                <br/>
                                <label>Tooltip content</label>
                                <textarea class="form-control" name="just_announced_tootip_details" rows="2"><?php echo isset($event_details) ? $event_details['just_announced_tootip_details'] : ''?></textarea>
                                <p class="help-block help-block-tip">Just announced tooltip content</p>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="pull-right">
                            <a href="<?=base_url()?>index.php/admin/event/<?php echo isset($page_start) ? $page_start : "";?>"><button type="button" class="btn">Back Button</button></a>
                            <button type="submit" class="btn">Submit Button</button>
                            <input  type="hidden" name="event_id" value="<?php echo isset($event_id) ? $event_id : "";?>" />
                            <input  type="hidden" name="user_event_id" value="<?php echo isset($event_details) ? $event_details['user_event_id'] : ''?>" />
                            <input  type="hidden" name="province" value="" />
                            </div>
                        </div>
                    </div>
                    </div>


                </div>





            </form>
            </div>
            </div>
            </div>
            <!-- /.col-lg-5 -->



        </div>
        <!-- /.row -->    

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<link href="<?php echo base_url();?>assets/date/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<!--<script type="text/javascript" src="<?php echo base_url();?>assets/date/main/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>-->
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
				url: '<?php echo base_url();?>index.php/admin/event/getStatesList',
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
			//alert(stateId);
			$.ajax({
				type: 'POST',        
				url: '<?php echo base_url();?>index.php/admin/event/getCitiesList',
				data: ({stateId:stateId}),
				cache: false,
				success:function(data) 
				{
					//alert(data);
					if(data!=''){
						$('#city').html(data);
						$('#city').removeAttr('disabled');
					}
				},
				error:function()
				{
					alert("An Error has occurred!!");
				}
			});	
		});
	});
	
	
</script>	