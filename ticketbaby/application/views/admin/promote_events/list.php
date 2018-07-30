<div class="row">
    <div class="col-md-5">
        <div class="panel panel-default"> 
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-users"></i><?php
                    if (isset($promote)) {
                        echo "Edit Promote Events";
                    } else {
                        echo 'Add Promote Events';
                    }
                    ?></h6>
            </div> 


            <?php
            if (isset($promote)) {
                $url = admin_url('promote_events/update');
            } else {
                $url = admin_url('promote_events/add');
            }
            ?>
            <form class="form_edit" method="post" action="<?php echo $url; ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Title</label> 
                            <input type="text" name="title" class="form-control" value="<?php
                            if (isset($promote)) {
                                echo $promote->title;
                            }
                            ?>">
                            <span class="form_error_show"> </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Start Date</label> 
                            <input type="text" name="sdate" class="form-control" value="<?php
                            if (isset($promote)) {
                                echo $promote->sdate;
                            }
                            ?>">
                            <span class="form_error_show"> </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>End Date</label> 
                            <input type="text" name="edate" class="form-control" value="<?php
                            if (isset($promote)) {
                                echo $promote->edate;
                            }
                            ?>">
                            <span class="form_error_show"> </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Time</label> 
                            <input type="text" name="time" class="form-control" value="<?php
                            if (isset($promote)) {
                                echo $promote->time;
                            }
                            ?>">
                            <span class="form_error_show"> </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Venue</label> 
                            <input type="text" name="venue" class="form-control" value="<?php
                            if (isset($promote)) {
                                echo $promote->venue;
                            }
                            ?>">
                            <span class="form_error_show"> </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Address</label> 
                            <input type="text" name="address" class="form-control" value="<?php
                            if (isset($promote)) {
                                echo $promote->address;
                            }
                            ?>">
                            <span class="form_error_show"> </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>City</label> 
                            <input type="text" name="city" class="form-control" value="<?php
                            if (isset($promote)) {
                                echo $promote->city;
                            }
                            ?>">
                            <span class="form_error_show"> </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Country</label> 
                            <input type="text" name="country" class="form-control" value="<?php
                            if (isset($promote)) {
                                echo $promote->country;
                            }
                            ?>">
                            <span class="form_error_show"> </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Enter Url</label> 
                            <input type="text" name="url" class="form-control" value="<?php
                            if (isset($promote)) {
                                echo $promote->url;
                            }
                            ?>">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Detail</label> 
                            <textarea name="details" class="form-control"><?php
                            if (isset($promote->details)) {
                                echo $promote->details;
                            }
                            ?></textarea>
                            
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Url Target</label> 
                            <select name="url_target" class="select-search my_select_opt select2-offscreen" tabindex="-1">
                                <option value="_blank" <?php if(isset($promote)){ if($promote->url_target == '_blank'){echo "selected == selected";}} ?> >New Window</option>
                                <option value="_self" <?php if(isset($promote)){ if($promote->url_target == '_self'){echo "selected == selected";}} ?>>Default Window</option>
                            </select>
                        </div>                                         
                    </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="file" name='image'>
                        </div>                                         
                        <div class="col-md-6">
                           <?php if(isset($promote)){ ?>
                            <img src="<?php echo base_url('uploads/images/thumbnails/'.$promote->image) ?>">  
                       <?php  } ?>
                        </div>                                         
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                              <label>Active</label>  <br>
                            <input type="radio" name='active' value="1" <?php if(isset($promote)){ if($promote->status == 1){ echo "checked == checked";}} ?> > True <br>
                            <input type="radio" name='active' value="0" <?php if(isset($promote)){ if($promote->status == 0){ echo "checked == checked";}} ?>> False 
                        </div>                                         
                    </div>
                </div>


                <div class="form-actions text-left "> 
                    <?php if (isset($promote)) { ?>
                        <input type="hidden" value="<?php echo $promote->id; ?>" name="id">
                    <?php } ?> 
                    <input type="submit" value="<?php
                    if (isset($promote)) {
                        echo 'Update';
                    } else {
                        echo 'Add';
                    }
                    ?>" class="btn btn-primary"> 
                    <a href="<?php echo admin_url(); ?>" class="btn btn-danger">Cancel</a> 

                </div>

            </form>
        </div>
    </div>

    <div class="col-md-7">
        <!-- Media datatable --> 
        <div class="panel panel-default"> 
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-users"></i>Events</h6>
            </div> 

            <div class="datatable"> 
                <table class="table table-bordered table-striped"> 
                    <thead> 
                        <tr> 
                            <th>#</th>  
                            <th>Title</th>  
                            <th>URL</th>
                            <th>URL Target</th>
                            <th class="actions-column">Active</th> 
                            <th class="actions-column">Action</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        <?php
                        $i = 1;
                        foreach($promote_details as $p) { ?>
                        <tr>  
                            <td>
                             <?php echo $i; ?>
                            </td> 
                            <td>
                              <?php echo $p->title; ?>
                            </td> 
                            <td>
                              <?php echo $p->url; ?>
                            </td>

                            <td>
                                <?php echo $p->url_target; ?>
                            </td>
                            <td>
                              <?php if($p->status == 1){ ?>
                                 <i class="fa fa-check" aria-hidden="true"></i>  
                           <?php }else{ ?>
                               <i class="fa fa-times" aria-hidden="true"></i>
                         <?php  } ?>
                            </td>

                            <td class="text-center"> 
                                <div class="btn-group"> 
                                    <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></button>
                                    <ul class="dropdown-menu icons-right dropdown-menu-right">
                                        <li><a href="<?php echo admin_url('promote_events/edit/'.$p->id); ?>"><i class="icon-pencil2"></i> Edit </a></li>
                                        <li><a href="#" onclick="return confirm('are your sure want to delete?')"><i class="icon-remove4"></i> Remove </a></li>
                                    </ul> 
                                </div> 
                            </td> 
                        </tr> 
                        <?php $i ++; } ?>
                    </tbody> 
                </table> 
            </div> 
        </div> 

    </div>

</div>





