<div class="row">


    <div class="col-md-5">
        <div class="panel panel-default"> 
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-users"></i><?php
                    if (isset($subscribers)) {
                        echo "Edit Subscribers";
                    } else {
                        echo 'Add Subscribers';
                    }
                    ?></h6>
            </div> 

            <?php
            if (isset($subscribers)) {
                $url = admin_url('subscribers/update');
            } else {
                $url = admin_url('subscribers/add');
            }
            ?>
            <form class="form_edit" method="post" action="<?php echo $url; ?>">

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Email Address</label> 
                            <input type="text" class="form-control" name="email" value="<?php
                            if (isset($subscribers)) {
                                echo $subscribers->email;
                            }
                            ?>">
                            <span class="form_error_show"><?php echo form_error('email'); ?></span>
                        </div>                                         
                    </div>
                </div>
                
                <div class="form-actions text-left "> 
                    <?php if (isset($subscribers)) { ?>
                        <input type="hidden" value="<?php echo $subscribers->id; ?>" name="id">
                    <?php } ?> 
                    <input type="submit" value="<?php
                    if (isset($subscribers)) {
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
                            <th>Email</th>
                            
                            <th class="actions-column">Action</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        <?php
                        $i = 1;
                        foreach ($subscribers_list as $s) {
                            ?>
                            <tr>  
                                <td>
                                   <?php echo $i; ?>
                                </td> 
                                <td>
                                    <?php echo $s->email; ?>
                                </td> 
                                <td class="text-center"> 
                                    <div class="btn-group"> 
                                        <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></button>
                                        <ul class="dropdown-menu icons-right dropdown-menu-right">
                                            <li><a href="<?php echo admin_url('subscribers/edit/' . $s->id) ?>"><i class="icon-pencil2"></i> Edit </a></li>
                                            <li><a href="<?php echo admin_url('subscribers/delete/' . $s->id) ?>" onclick="return confirm('are your sure want to delete?')"><i class="icon-remove4"></i> Remove </a></li>
                                        </ul> 
                                    </div> 
                                </td> 
                            </tr> 
                        <?php $i++; } ?>
                    </tbody> 
                </table> 
            </div> 
        </div> 

    </div>

</div>





