<?php
error_reporting(0);
if (isset($events)) {
    $path = admin_url('awards/update');
} else {
    $path = admin_url('awards/save');
}
?>

<a href="<?php echo admin_url('awards'); ?>"><i class="fa fa-arrow-left leftarrow" aria-hidden="true">Back</i></a>
<form action="<?= $path; ?>" method="post" enctype="multipart/form-data" role="form"> 
    <div class="panel panel-default"> 

        <div class="tabbable page-tabs"> 
            <ul class="nav nav-tabs"> 
                <li class="active">
                    <a href="#content" data-toggle="tab"> Contents</a>
                </li> 
                <li class="">
                    <a href="#additional_details" data-toggle="tab"> Additional Details</a>
                </li>
				<li class="">
                    <a href="#ticketsInfo_details" data-toggle="tab"> Tickets Description</a>
                </li>
				<li class="">
                    <a href="#eticket_settings" data-toggle="tab"> E-Ticket Settings</a>
                </li>
            </ul>
            <div class="tab-content"> 
                <!-- First tab --> 
                <div class="tab-pane fade active in" id="content">

                    <div class="panel-body">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label> 
                                    <input type="text" required name="name" class="form-control" value="<?php
                                    if (isset($events->name)) {
                                        echo $events->name;
                                    }
                                    ?>">
                                           <?php echo form_error('name'); ?>
                                </div> 
                                <div class="col-md-6">
                                    <label>Slug</label> 
                                    <input type="text" name="slug" class="form-control" value="<?php
                                    if (isset($events->slug)) {
                                        echo $events->slug;
                                    }
                                    ?>">
                                           <?php echo form_error('slug'); ?>
                                </div>                                                    
                            </div>

                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Select Event Category</label> 
                                    <select name="category_id" class="select-search my_select_opt select2-offscreen" tabindex="-1">
                                        <option value="0">Select Event category</option>
                                        <?php foreach ($categories as $c) { 
											if("169"==$c->id){
										?>
                                            <option value="<?php echo $c->id; ?>" <?php
                                            if (isset($events)) {
                                                if ($c->id == $events->category_id) {
                                                    echo "selected == selected";
                                                }
                                            }
                                            ?> ><?php echo $c->title; ?></option>
                                                <?php } } ?>
                                    </select>
                                </div>   
                                <div class="col-md-6">
                                    <label>Price</label> 
                                    <input type="text" name="price" class="form-control" id="price" value="<?php
                                    if (isset($events)) {
                                        echo $events->price;
                                    }
                                    ?>">
                                </div>                                      
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Start Date</label> 
                                    <input id="start_date1" required type="text" name="start_date" class="form-control" value="<?php
                                    if (isset($events->start_date)) {
                                        echo $events->start_date;
                                    }
                                    ?>">
                                           <?php echo form_error('name'); ?>
                                </div> 
                                <div class="col-md-6">
                                    <label>Start Time</label> 
                                    <input id="time" required type="text" name="time" class="form-control" value="<?php
                                    if (isset($events->time)) {
                                        echo $events->time;
                                    }
                                    ?>">

                                </div>                                                    
                            </div>
                        </div>
						<div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>End Date</label> 
                                    <input id="end_date" required type="text" name="end_date" class="form-control" value="<?php
                                    if (isset($events->end_date)) {
                                        echo $events->end_date;
                                    }
                                    ?>">
                                           <?php echo form_error('name'); ?>
                                </div> 
                                <div class="col-md-6">
                                    <label>End Time</label> 
                                    <input id="time" required type="text" name="end_time" class="form-control" value="<?php
                                    if (isset($events->end_time)) {
                                        echo $events->end_time;
                                    }
                                    ?>">

                                </div>                                                    
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Venue</label> 
                                    <input type="text" name="venue" class="form-control" value="<?php
                                    if (isset($events->venue)) {
                                        echo $events->venue;
                                    }
                                    ?>">
                                           <?php echo form_error('venue'); ?>
                                </div> 
                                <div class="col-md-6">
                                    <label>Address</label> 
                                    <input type="text" name="address" class="form-control" value="<?php
                                    if (isset($events->address)) {
                                        echo $events->address;
                                    }
                                    ?>">
                                           <?php echo form_error('address'); ?>
                                </div>                                                    
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>City</label> 
                                    <input type="text" required name="city" class="form-control" value="<?php
                                    if (isset($events->venue)) {
                                        echo $events->city;
                                    }
                                    ?>">
                                           <?php echo form_error('city'); ?>
                                </div> 
                                <div class="col-md-6">
                                    <label>Country</label> 
                                    <input type="text" name="country" class="form-control" value="<?php
                                    if (isset($events->country)) {
                                        echo $events->country;
                                    }
                                    ?>">
                                           <?php echo form_error('country'); ?>
                                </div>                                                    
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Detail</label>
                                    <textarea style="height: 115px;" name="details" class="form-control"><?php
                                        if (isset($events->details)) {
                                            echo trim($events->details);
                                        }
                                        ?></textarea>
                                    <?php echo form_error('details'); ?>
                                </div> 
                                <div class="col-md-6">
                                    <label>Summary</label>
                                    <textarea style="height: 115px;" name="summary" class="form-control"><?php
                                        if (isset($events->summary)) {
                                            echo trim($events->summary);
                                        }
                                        ?></textarea>
                                    <?php echo form_error('summary'); ?>
                                </div> 
                            </div>
                        </div>
                     

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Featured Image:<br><i>(Image Size: 220px X 235px)</i></label> 
                                    <input type="file" class="styled form-control" id="report-screenshot" name="image">
                                    <?php if (isset($events)) { ?>
                                        <img class="featured_img" alt="No Image Found" src="<?php echo base_url('uploads/images/small/' . $events->image) ?>">  
                                    <?php } ?>

                                </div>
                                <div class="col-md-4">
                                    <label>Second Featured Image:<br><i>(Image Size: 235px X 196px)</i></label> 
                                    <input type="file" class="styled form-control" id="report-screenshot" name="image2">
                                    <?php if (isset($events)) { ?>
                                        <img class="featured_img" alt="No Image Found" src="<?php echo base_url('uploads/images/small/' . $events->image2) ?>">  
                                    <?php } ?>

                                </div>
                                <div class="col-md-4">
                                    <label>Event Seat Image:<br><i>(Image Size: 1024px X 720px)</i></i></label> 
                                    <input type="file" class="styled form-control" id="report-screenshot" name="seat">
                                    <?php if (isset($events)) { ?>
                                        <img class="featured_img" alt="No Image Found" src="<?php echo base_url('uploads/images/full/' . $events->seat) ?>">  
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Show Featured image in</label> 
                            <div class="block-inner">
                                <label class="checkbox-inline checkbox-success">
                                    <div class="checker">
                                        <span class=""><input name="main_carousel" class="styled" checked="checked" type="checkbox" <?php
                                            if (isset($events)) {
                                                if ($events->main_carousel == 1) {
                                                    echo "checked == checked";
                                                }
                                            }
                                            ?> ></span>
                                    </div>Main Carousel
                                </label>

                                <label class="checkbox-inline checkbox-success">
                                    <div class="checker">
                                        <span class="">
                                            <input class="styled" name="recommended_carousel" type="checkbox" <?php
                                            if (isset($events)) {
                                                if ($events->recommended_carousel == 1) {
                                                    echo "checked == checked";
                                                }
                                            }
                                            ?> >
                                        </span>
                                    </div>Recommended Carousel
                                </label>

                                <label class="checkbox-inline checkbox-success">
                                    <div class="checker">
                                        <span class="">
                                            <input class="styled" name="hot_ticket" type="checkbox" <?php
                                            if (isset($events)) {
                                                if ($events->hot_ticket == 1) {
                                                    echo "checked == checked";
                                                }
                                            }
                                            ?>>
                                        </span>
                                    </div>Hot Tickets
                                </label>
                                <label class="checkbox-inline checkbox-success">
                                    <div class="checker">
                                        <span class="">
                                            <input class="styled" name="just_announced" type="checkbox" <?php
                                            if (isset($events)) {
                                                if ($events->just_announced == 1) {
                                                    echo "checked == checked";
                                                }
                                            }
                                            ?>>
                                        </span>
                                    </div>Just Announced
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Active</label> <br>
                                    <input type="radio" name="status" value="1" <?php
                                    if (isset($events)) {
                                        if ($events->status == 1) {
                                            echo "checked==checked";
                                        }
                                    }
                                    ?> > True <br>
                                    <input type="radio" name="status" value="0" <?php
                                    if (isset($events)) {
                                        if ($events->status == 0) {
                                            echo "checked==checked";
                                        }
                                    }
                                    ?>> False
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- /first tab --> 
                <!-- Second tab --> 
                <div class="tab-pane fade" id="additional_details"> 
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Charity Fee</label> 
                                    <input type="text" name="charity_fee" class="form-control" value="<?php
                                    if (isset($additional_event)) {
                                        echo "$additional_event->charity_fee";
                                    }
                                    ?>" >
                                </div> 
                                <div class="col-md-6">
                                    <label>Fulfillment fee</label> 
                                    
                                   
                                    <input type="radio" name="fulfillment_status" value="0" <?php
                                    if (isset($additional_event)) {
                                        if ($additional_event->fulfillment_status == 0) {
                                            echo "checked == checked";
                                        }
                                    }
                                    ?>> Flat
                                    <input type="radio" name="fulfillment_status" value="1" <?php
                                    if (isset($additional_event)) {
                                        if ($additional_event->fulfillment_status == 1) {
                                            echo "checked == checked";
                                        }
                                    }
                                    ?>> Percentage
                                    
                                    <input type="text" name="fulfillment_fee" class="form-control" value="<?php
                                    if (isset($additional_event)) {
                                        echo "$additional_event->fulfillment_fee";
                                    }
                                    ?>" > 
                                    
                                    
                                </div> 
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Postage fee</label> 
                                    <br>
                                    <input type="radio" name="postage_status" value="0" <?php
                                    if (isset($additional_event)) {
                                        if ($additional_event->postage_status == 0) {
                                            echo "checked == checked";
                                        }
                                    }
                                    ?>> Flat<br>
                                    <input type="radio" name="postage_status" value="1" <?php
                                    if (isset($additional_event)) {
                                        if ($additional_event->postage_status == 1) {
                                            echo "checked == checked";
                                        }
                                    }
                                    ?>> Percentage

                                    <input type="text" name="postage_fee" class="form-control" value="<?php
                                    if (isset($additional_event)) {
                                        echo "$additional_event->postage_fee";
                                    }
                                    ?>" >
                                </div>

                                <div class="col-md-6">
                                    <label>Credit Card fee</label> 
                                    <br>
                                    <input type="radio" name="creditcard_status" value="0" <?php
                                    if (isset($additional_event)) {
                                        if ($additional_event->creditcard_status == 0) {
                                            echo "checked == checked";
                                        }
                                    }
                                    ?>> Flat<br>
                                    <input type="radio" name="creditcard_status" value="1" <?php
                                    if (isset($additional_event)) {
                                        if ($additional_event->creditcard_status == 1) {
                                            echo "checked == checked";
                                        }
                                    }
                                    ?>> Percentage
                                    <input type="text" name="creditcard_fee" class="form-control" value="<?php
                                    if (isset($additional_event)) {
                                        echo "$additional_event->creditcard_fee";
                                    }
                                    ?>" >
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                   <!-- <div class="row">
                                        <p style="padding-left: 17px;">Please visit this <a target="_blank" style="font-size: 17px;" href="http://www.latlong.net/convert-address-to-lat-long.html"> link </a> to get latitude and longitude.</p>

                                        <div class="col-md-6">
                                            <label>Latitude</label> 
                                            <input type="text" name="latitude" class="form-control" placeholder="longitude" value="<?php
                                            if (isset($additional_event)) {
                                                echo "$additional_event->latitude";
                                            }
                                            ?>" >
                                        </div>
                                        <div class="col-md-6">
                                            <label>Longitude</label> 
                                            <input type="text" name="longitude" class="form-control" placeholder="latitude" value="<?php
                                            if (isset($additional_event)) {
                                                echo "$additional_event->longitude";
                                            }
                                            ?>" >
                                        </div>
                                    </div> -->
									<label>Google Map (Like: https://www.google.com/maps/embed?pb=!1m18!1m12!1m...)</label> 
										<input type="text" name="google_map" class="form-control" value="<?php
										if (isset($additional_event)) {
											echo "$additional_event->google_map";
										}
                                    ?>" placeholder="E.g.:https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2478.9527702637574!2d-0.0749696842270975!3d51.58742897964837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761c17bfb17e7b%3A0x48bae551fe785951!2sBernie+Grant+Arts+Centre!5e0!3m2!1sen!2suk!4v1519840954897">
                                </div>
                                <div class="col-md-6">
                                    <label>YouTube Url</label> 
                                    <input type="text" name="youtube_url" class="form-control" value="<?php
                                    if (isset($additional_event)) {
                                        echo "$additional_event->youtube_url";
                                    }
                                    ?>" >
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Facebook Share link</label> 
                                            <input type="text" name="facebook" class="form-control" placeholder="facebook" value="<?php
                                            if (isset($additional_event)) {
                                                echo "$additional_event->facebook";
                                            }
                                            ?>" >
                                        </div>
                                        <div class="col-md-6">
                                            <label>Twitter Share link</label> 
                                            <input type="text" name="tweeter" class="form-control" placeholder="tweeter" value="<?php
                                            if (isset($additional_event)) {
                                                echo "$additional_event->tweeter";
                                            }
                                            ?>" >
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
						<div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
										<div class="col-md-6">
                                            <label>Organizer Name</label> 
                                            <input type="text" name="organiser_name" class="form-control" placeholder="Organizer Name" value="<?php
                                            if (isset($additional_event)) {
                                                echo "$additional_event->organizerName";
                                            }
                                            ?>" >
                                        </div>
										<div class="col-md-6">
                                            <label>Organizer's User ID</label>
                                            <select name="user_id" class="form-control">
												<option value="0">SELECT USER ID</option>
												<?php foreach ($userslist as $c){ ?>
													<option value="<?php echo $c->id; ?>" <?php
													if (isset($events)) {
														if ($c->id == $events->user_id) {
															echo "selected == selected";
														}
													}
													?> ><?php echo $c->username; ?></option>
												  <?php }?>
											</select>
                                        </div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
										<div class="col-md-6">
                                            <label>Organizer Contact</label> 
                                            <input type="text" name="organizer_contact" class="form-control" placeholder="Organizer Contact" value="<?php
                                            if (isset($additional_event)) {
                                                echo "$additional_event->organizerContact";
                                            }
                                            ?>" >
                                        </div>
										<div class="col-md-6">
                                            <label>Organizer Email</label> 
                                            <input type="email" name="organizer_email" class="form-control" placeholder="Organizer Email ID" value="<?php
                                            if (isset($additional_event)) {
                                                echo "$additional_event->organizerEmail";
                                            }
                                            ?>" >
                                        </div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
										<div class="col-md-6">
                                            <label>Organizer Website</label> 
                                            <input type="text" name="organizer_website" class="form-control" placeholder="Organizer Website" value="<?php
                                            if (isset($additional_event)) {
                                                echo "$additional_event->organizerWebsite";
                                            }
                                            ?>" >
                                        </div>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div> 
                <!-- /second tab --> 
				
				<!-- Third Tab -->
				<div class="tab-pane fade" id="ticketsInfo_details"> 
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
													<th colspan="3">
														<select class="form-control" name="ticketclasslist" id="ticketclasslist" onchange="javascript: showTicketDesc();">
															<option value="">SELECT TICKET CLASS</option>
															<?php
															$parentclss = $this->db->get_where('tbl_ticket_class', array('parent_id' => '0'))->result();
															foreach($parentclss as $prent){ ?>
																<option value="<?php echo $prent->id; ?>"><?php echo $prent->class; ?></option>
															<?php } ?>
														</select>
													</th>
												</tr>
											</thead>
											<thead> 
												<?php 
												$parentclss = $this->db->get_where('tbl_ticket_class', array('parent_id' => '0'))->result();
												$cnt=1;
												foreach($parentclss as $prent){
												?>
												<!--<tr>
													<th colspan="3" class="ticketinfohead">
														<label><?php echo $prent->class; ?></label>
													</th>
												</tr>-->
											<tbody id="<?php echo $prent->id; ?>" style="display:none;">
												<tr> 
													<th>Ticket Type</th>  
													<th>Description</th>
													<th>Image</th>
												</tr>
												<?php
												$subclss = $this->db->get_where('tbl_ticket_class', array('parent_id' => $prent->id))->result();
												foreach($subclss as $subcl){
													if($ticket_info){
														$info = $this->db->get_where('tbl_ticket_info', array('ticket_id' => $subcl->id, 'event_id' => $events->id))->row();
													}
												?>
												<tr>
													<input type="hidden" name="ticket_id_<?php echo $cnt; ?>" value="<?php echo $subcl->id; ?>">
													<td><?php echo $subcl->class; ?></td>
													<td><textarea class="form-control" name="description_<?php echo $cnt; ?>"><?php echo $info->description; ?></textarea></td>
													<td><input type="file" name="info_image_<?php echo $cnt; ?>"></td>
												</tr>
													<?php $cnt++; } ?>
												<?php } ?>
												<input type="hidden" name="total_ticketInfo" value="<?php echo $cnt; ?>" >
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div> 
				<!-- /Third Tab -->
				<!-- Fourth tab --> 
                <div class="tab-pane fade" id="eticket_settings"> 
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Celebrities Names (Please enter multiple names separated by colon.)</label> 
                                    <input type="text" name="celebrities" class="form-control" value="<?php
                                    if (isset($eticket_info)) {
                                        echo "$eticket_info->celebrities";
                                    }
                                    ?>" placeholder="Name 1: Name 2: Name 3">
                                </div> 
                                <!--<div class="col-md-6">
                                    <label>VIP Guest</label> 
                                    <input type="text" name="vip_guest_name" class="form-control" value="<?php/*
                                    if (isset($eticket_info)) {
                                        echo "$eticket_info->vip_guest_name";
                                    }*/
                                    ?>" >
                                </div>-->
								<div class="col-md-6">
                                    <label>Door Open Time</label> 
                                    <input id="time" type="text" name="door_open" class="form-control" value="<?php
                                    if (isset($eticket_info)) {
                                        echo "$eticket_info->door_open";
                                    }
                                    ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Door Closing Time</label> 
                                    <input id="time" type="text" name="door_close" class="form-control" value="<?php
                                    if (isset($eticket_info)) {
                                        echo "$eticket_info->door_close";
                                    }
                                    ?>" >
                                </div>
								<div class="col-md-6">
                                    <label>Dress Code Policy</label> 
                                    <input type="text" name="dress_code_policy" class="form-control" value="<?php
                                    if (isset($eticket_info)) {
                                        echo "$eticket_info->dress_code_policy";
                                    }
                                    ?>" >
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                            <div class="row">
								<div class="col-md-6">
									<label>Alcohol for Sale:</label> 
									<select type="text" name="alcohol_for_sale" class="form-control" >
										<?php
											if (isset($eticket_info)) {
												$selected = '';
												if($eticket_info->alcohol_for_sale==0){
													$selected = 'selected';
												}
											}
										?>
										<option <?php echo $selected; ?> value="1">Yes</option>
										<option <?php echo $selected; ?> value="0">No</option>
									</select>
								</div>
								<div class="col-md-6">
									<label>Minimum Age for event restricted to:</label> 
									<input type="text" name="minimum_age_restricted" class="form-control" placeholder="18 Years" value="<?php
									if (isset($eticket_info)) {
										echo "$eticket_info->minimum_age_restricted";
									}
									?>" >
								</div>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- /Fourth tab --> 

                <div class="panel-body no-padding-top">
                    <div class="form-actions text-left "> 
                        <input type="hidden" name="id" value="<?php echo $events->id; ?>">
                        <input type="submit" value="<?php
                        if (isset($event)) {
                            echo "update";
                        } else {
                            echo "save";
                        }
                        ?>" class="btn btn-primary"> 
                        <a href="<?php echo admin_url('awards'); ?>" class="btn btn-danger">Cancel</a> 

                    </div>
                </div>
            </div> 
        </div>
    </div>
</form>




