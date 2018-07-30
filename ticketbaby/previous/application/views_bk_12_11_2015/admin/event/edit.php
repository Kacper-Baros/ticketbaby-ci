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
                    <input class="form-control" name="start_date" value="<?php echo isset($event_details) ? $event_details['start_date'] : ''?>" placeholder="Enter text">
                    <p class="help-block help-block-tip">YYYY-MM-DD HH-MM (2015-10-30 18:30)</p>
                    </div>


                    <div class="form-group">
                    <label>End Date</label>
                    <input class="form-control" name="end_date" value="<?php echo isset($event_details) ? $event_details['end_date'] : ''?>" placeholder="Enter text">
                    <p class="help-block help-block-tip">YYYY-MM-DD HH-MM (2015-10-31 18:30)</p>
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
                                <label>Postage Fees</label>
                                <input class="form-control" name="postage_fee" value="<?php echo isset($event_additional_charge) && isset($event_additional_charge['postage_fee'])  ? $event_additional_charge['postage_fee']['additional_charge'] : ''?>" placeholder="Enter Amount">
                                <p class="help-block help-block-tip">Postage Fees</p>
                                <div class="radio">
                                <label class="radio-inline"><input name="postage_fee_type" type="radio" value="P" <?php echo ( !isset($event_additional_charge)  || isset($event_additional_charge['postage_fee']) && $event_additional_charge['postage_fee']['additional_charge_type'] == 'P') ? 'checked' : ''?>>Percentage</label>
                                <label class="radio-inline"><input name="postage_fee_type" type="radio" value="F" <?php echo ( isset($event_additional_charge) && isset($event_additional_charge['postage_fee']) && $event_additional_charge['postage_fee']['additional_charge_type'] == 'F') ? 'checked' : ''?> >Flat</label>
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
                            <input class="form-control" name="map_location" value="<?php echo isset($event_details) && isset($event_details['map_location'])  ? $event_details['map_location'] : ''?>" placeholder="Enter URL">
                            <p class="help-block help-block-tip">Example: https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2430.2058433426973!2d-1.91382...<a target="_blank" href="<?=base_url()?>assets/images/event-map-location-example.png" class="btn-md"><span class="glyphicon glyphicon-zoom-in"></span></a></p>
                            </div>

                            <div class="form-group">
                            <label>Youtube URL [Embed url]</label>
                            <input class="form-control" name="youtube_url" value="<?php echo isset($event_details) && isset($event_details['youtube_url'])  ? $event_details['youtube_url'] : ''?>" placeholder="Enter URL">
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
                    <label>City</label>
                    <input class="form-control" name="city" value="<?php echo isset($event_details) ? $event_details['city'] : ''?>" placeholder="Enter text">
                    </div>
                    

                     <div class="form-group">
                    <label>Country</label>
                    <input class="form-control" name="country" value="<?php echo isset($event_details) ? $event_details['country'] : ''?>" placeholder="Enter text">
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
                        <input name="img_extension" type="file" > 
                        <p class="help-block help-block-tip">[350*400 - width*height]</p>   
                        </div>
                        <?php if ( isset($event_details) && $event_details['img_extension'] != "" ) { ?>
                        <div class="form-group">
                        <a href="<?=base_url()?>assets/upload/event/event_img_<?=$event_id . $event_details['img_extension'];?>" target="_blank">
                        <img src="<?=base_url()?>assets/upload/event/event_img_<?=$event_id . $event_details['img_extension'];?>" style="max-width:200px;max-height:300px;" />
                        </a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label>Main carousal Thumbnail</label>
                        <input name="img_extension_main_carousel" type="file" >   
                        <p class="help-block help-block-tip">[175*328 - width*height]</p>   
                        </div>
                        <?php if ( isset($event_details) && $event_details['img_extension_main_carousel'] != "" ) { ?>
                        <div class="form-group">
                        <a href="<?=base_url()?>assets/upload/event/event_img_main_carousel_<?=$event_id . $event_details['img_extension_main_carousel'];?>" target="_blank">
                        <img src="<?=base_url()?>assets/upload/event/event_img_main_carousel_<?=$event_id . $event_details['img_extension_main_carousel'];?>" style="max-width:200px;max-height:300px;" />
                        </a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label>Reccommended carousal Thumbnail</label>
                        <input name="img_extension_recommended_carousel" type="file" > 
                        <p class="help-block help-block-tip">[175*130 - width*height]</p>     
                        </div>
                        <?php if ( isset($event_details) && $event_details['img_extension_recommended_carousel'] != "" ) { ?>
                        <div class="form-group">
                        <a href="<?=base_url()?>assets/upload/event/event_img_recommended_carousel_<?=$event_id . $event_details['img_extension_recommended_carousel'];?>" target="_blank">
                        <img src="<?=base_url()?>assets/upload/event/event_img_recommended_carousel_<?=$event_id . $event_details['img_extension_recommended_carousel'];?>" style="max-width:200px;max-height:300px;" />
                        </a>
                        </div>
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