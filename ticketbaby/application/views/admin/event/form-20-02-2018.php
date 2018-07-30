<?php
	if(isset($_GET['delete_img']))
	{
		$q="UPDATE tbl_events SET seat = '".''."' WHERE id = ".$_GET['delete_img'];
		$this->db->query($q);
		redirect(base_url().'admin/events/edit/'.$_GET['delete_img']);
	}
	  
error_reporting(0);
if (isset($events)) {
    $path = admin_url('events/update');
} else {
    $path = admin_url('events/save');
}
?>
<a href="<?php echo admin_url('events'); ?>"><i class="fa fa-arrow-left leftarrow" aria-hidden="true">Back</i></a>

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

                                        <?php foreach ($categories as $c)
										 { 
											if($c->id=="169")
											{
											} else {
											?>
                                        
                                            <option value="<?php echo $c->id; ?>" <?php
                                            if (isset($events)) {
                                                if ($c->id == $events->category_id) {
                                                    echo "selected == selected";
                                                }
                                            }
                                            ?> ><?php echo $c->title; ?></option>
                                          <?php } }?>
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
                                    <input type="text" required name="start_date" class="form-control" id="start_date" value="<?php
                                    if (isset($events)) {
                                        echo $events->start_date;
                                    }
                                    ?>">
                                </div> 

                                <div class="col-md-6">
                                    <label>Start Time</label> 
                                    <input id="time" required type="text" name="time" class="form-control" value="<?php
                                    if (isset($events)) {
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
                                    if (isset($events->city)) {
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
                                    <textarea name="details" class="form-control"><?php
                                        if (isset($events->details)) {
                                            echo $events->details;
                                        }
                                        ?></textarea>
                                    <?php echo form_error('details'); ?>
                                </div> 
                                <div class="col-md-6">
                                    <label>Summary</label> 
                                    <textarea name="summary" class="form-control"><?php
                                        if (isset($events->summary)) {
                                            echo $events->summary;
                                        }
                                        ?></textarea>

                                    <?php echo form_error('summary'); ?>
                                </div>                                                    
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Featured Image:</label> 
                                    <input type="file" class="styled form-control" id="report-screenshot" name="image">
                                    <?php if (isset($events)) { ?>
                                        <img class="featured_img" alt="No Image Found" src="<?php echo base_url('uploads/images/small/' . $events->image) ?>">  
                                    <?php } ?>

                                </div>
                                <div class="col-md-4">
                                    <label> Second Featured Image:</label> 
                                    <input type="file" class="styled form-control" id="report-screenshot" name="image2">
                                    <?php if (isset($events)) { ?>
                                        <img class="featured_img" alt="No Image Found" src="<?php echo base_url('uploads/images/small/' . $events->image2) ?>">  
                                    <?php } ?>

                                </div>
                                <div class="col-md-4">
                                    <label>Event Seat Image:</label> 
                                    <input type="file" class="styled form-control" id="report-screenshot" name="seat">
                                    <?php if (!empty($events->seat))
									 {
									 ?>
                                        <img class="featured_img" alt="No Image Found" src="<?php echo base_url('uploads/images/full/' . $events->seat) ?>">  </br>
                                        <a href="<?php echo admin_url('events/edit/'.$events->id.'?delete_img='.$events->id); ?>" class="btn btn-danger" onclick="return confirm('Are You sure to delete Seat Image');">Remove</a>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Show Featured image in</label> 
                            <div class="block-inner">
                                <label class="checkbox-inline checkbox-success">
                                    <div class="checker">
                                        <span class=""><input name="main_carousel" class="styled"  type="checkbox" <?php
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
                                <div class="col-md-12">
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
                                        if ($additional_event->credutcard_status == 0) {
                                            echo "checked == checked";
                                        }
                                    }
                                    ?>> Percentage
                                    
                                    <input type="text" name="creditcard_fee" class="form-control" value="<?php
                                    if (isset($additional_event)) {
                                        echo "$additional_event->creditcard_fee";
                                    }
                                    ?>">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Google Map</label> 
                                    <input type="text" name="google_map" class="form-control" value="<?php
                                    if (isset($additional_event)) {
                                        echo "$additional_event->google_map";
                                    }
                                    ?>" >
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
                                            <label>Organizer Contact</label> 
                                            <input type="text" name="organizer_contact" class="form-control" placeholder="Organizer Contact" value="<?php
                                            if (isset($additional_event)) {
                                                echo "$additional_event->organizerContact";
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
                                            <label>Organizer Email</label> 
                                            <input type="email" name="organizer_email" class="form-control" placeholder="Organizer Email ID" value="<?php
                                            if (isset($additional_event)) {
                                                echo "$additional_event->organizerEmail";
                                            }
                                            ?>" >
                                        </div>
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
												<?php 
												$parentclss = $this->db->get_where('tbl_ticket_class', array('parent_id' => '0'))->result();
												$cnt=1;
												foreach($parentclss as $prent){
												?>
												<tr>
													<th colspan="3" class="ticketinfohead">
														
														<label><?php echo $prent->class; ?></label>
													</th>
												</tr>
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
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div> 
				<!-- /Third Tab -->

                <div class="panel-body no-padding-top">
                    <div class="form-actions text-left "> 
                        <input type="hidden" name="id" value="<?php echo $events->id; ?>">
                        <input type="submit" value="
						<?php
                        if (isset($event))
						 {
                            echo "update";
                        } else {
						    echo "save";
                        }
                        ?>" class="btn btn-primary"> 
                        <a href="<?php echo admin_url('events'); ?>" class="btn btn-danger">Cancel</a> 
                    </div>
                </div>
            </div> 
        </div>
    </div>
</form>



