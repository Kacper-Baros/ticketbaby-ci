<div class="row">
    <div class="col-md-5">
        <div class="panel panel-default"> 
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-users"></i><?php
                    if (isset($coupen)) {
                        echo "Edit Coupon";
                    } else {
                        echo 'Add Coupon';
                    }
                    ?></h6>
            </div> 


            <?php
            if (isset($coupen)) {
                $url = admin_url('coupon/update');
            } else {
                $url = admin_url('coupon/add');
            }
            ?>
            
            <form class="form_edit" method="post" action="<?php echo $url; ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Coupon code</label> 
                            <input type="text" name="coupen_code" class="form-control" value="<?php
                            if (isset($coupen)) {
                                echo $coupen->coupen_code;
                            }
                            ?>">
                            <span class="form_error_show"> <?php echo form_error('coupen_code'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Coupon Type</label> 
                            <br>
                            <input class="inp_coupentype" type="radio" name="coupen_type" value="1"<?php if(isset($coupen)){ if( $coupen->coupen_type == 1 ){ echo "checked == checked";}} ?>><span class="spanclass">Percentage</span>
                            <input class="inp_coupentype" type="radio" name="coupen_type" value="2"<?php if(isset($coupen)){ if( $coupen->coupen_type == 2 ){ echo "checked == checked";}} ?>><span class="spanclass"> Flat </span>
                            <input class="inp_coupentype" type="radio" name="coupen_type" value="3"<?php if(isset($coupen)){ if( $coupen->coupen_type == 3 ){ echo "checked == checked";}} ?>> <span class="spanclass">Free </span>

                        </div>                                         
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Coupon Value</label> 
                            <input type="text" name="coupen_value" value="<?php if(isset($coupen)){ echo $coupen->coupen_value;} ?>" class="form-control">
                        </div>                                         
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Active</label> 
                            <br>
                            <input type="radio" name="status" value="1" <?php if(isset($coupen)){ if( $coupen->status == 1 ){ echo "checked == checked";}} ?>><span class="spanclass" >True</span>
                            <input type="radio" name="status"  value="0" <?php if(isset($coupen)){ if( $coupen->status == 0 ){ echo "checked == checked";}} ?> ><span class="spanclass">False</span>
                        </div>                                         
                    </div>
                </div>


                <div class="form-actions text-left "> 
                    <?php if (isset($coupen)) { ?>
                        <input type="hidden" value="<?php echo $coupen->id; ?>" name="id">
                    <?php } ?> 
                    <input type="submit" value="<?php
                    if (isset($coupen)) {
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
                            <th>Coupon Code</th>  
                            <th>Coupon Type</th>
                            <th>Coupon Value</th>
                            <th>Active</th>
                            <th class="actions-column">Action</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        <?php
                        foreach ($coupens as $c) {
                            ?>
                            <tr>  
                                <td>
                                    <?php echo $c->coupen_code; ?>
                                </td> 
                                <td>
                                    <?php if($c->coupen_type == 1){ echo "Percentage";}elseif($c->coupen_type == 2){ echo "Flat";}elseif($c->coupen_type == 3){ echo "Free";}else{ echo "NA";} ?>
                                </td>
                                
                                <td>
                                    <?php echo $c->coupen_value;  ?>
                                </td>

                                <td><?php if($c->status == 0){ echo "N";}else{ echo "Y";} ?></td>

                                <td class="text-center"> 
                                    <div class="btn-group"> 
                                        <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></button>
                                        <ul class="dropdown-menu icons-right dropdown-menu-right">
                                            <li><a href="#modal" data-toggle="modal" role="button"><i class="icon-eye"></i> View Detail</a></li>
                                            <li><a href="<?php echo admin_url('coupon/edit/' . $c->id) ?>"><i class="icon-pencil2"></i> Edit </a></li>
                                            <li><a href="javascript:void(0);" data-toggle="modal" data-target="#DeletModel_<?php echo $c->id; ?>" ><i class="icon-remove4"></i> Remove </a></li>
                                        </ul> 
                                    </div> 
                                </td> 
                            </tr> 
							<div class="modal fade" id="DeletModel_<?php echo $c->id; ?>" role="dialog">
							  <div class="modal-dialog"> 
								<!-- Modal content to Delete -->
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title"><img src="http://ticketbaby.co.uk/assets/images/logo_popup.png"><span style="font-size:30px;padding-left:110px;">Baby Alert!</span></h4>
								  </div>								  
								  <div class="modal-body">
									<form action="<?php echo admin_url('coupon/delete/'.$c->id) ?>" method="get" id="DeleteForm_<?php echo $c->id; ?>">
									<div class="row">
									  <div class="col-md-12 col-sm-12 col-xs-12">
										<div class="form-group">
										<h1 style="text-align:center;"><img src="http://ticketbaby.co.uk/assets/images/lock.jpg">&nbsp;&nbsp;&nbsp;&nbsp;PASSWORD REQUIRED</h1>
								        </div>
								      </div>
								   </div>
									<div class="row">
									  <div class="col-md-12 col-sm-12 col-xs-12">
										<div class="form-group">											
											<input class="form-control" placeholder="password" type="password" name="user_password_<?php echo $c->id; ?>" id="user_password_<?php echo $c->id; ?>">
										</div>
									  </div>
									</div>
								  </div>
								  <div class="modal-footer">
									<button type="button" onclick="javascript: SubmitPassword(<?php echo $c->id; ?>);" class="btn btn-primary">Proceed</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								  </div>
								  </form>
								</div>
							  </div>
							</div>
                        <?php } ?>
                    </tbody> 
                </table> 
            </div> 
        </div> 
    </div>
</div>
<script type="text/javascript">
//Confirm Password to Delete record
function SubmitPassword(id) {
	var formID = $("#DeleteForm_" + id).serialize();
	var Passwrd = $("#user_password_" + id).val();
	if(Passwrd!=""){
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: '<?php echo admin_url("orders/ConfirmPassword/") ?>' + '/' + id,
			data: formID,
			success: function(response) {
				if(response=='Confirmed'){
					$('#DeletModel_'+ id).modal('hide');
					$("#DeleteForm_"+id).submit();
				}
				else{
					alert("Invalid Password!");
					return false;
				}
			}
		});
	}
	else{
		alert("Please Enter Password!");
		return false;
	}
}
</script>




