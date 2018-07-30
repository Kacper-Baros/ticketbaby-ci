<div class="row">
     
    <div class="col-md-5">
         <div class="panel panel-default"> 
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-users"></i><?php if(isset($ipedit)){ echo "Edit IP";} else{ echo 'Add New IP';} ?></h6>
            </div> 
            
             <?php
             if(isset($ipedit)){
             $url = admin_url('ip_management/update');
             }else{
                 $url = admin_url('ip_management/add');
             }
             ?>
             <form class="form_edit" method="post" action="<?php echo $url; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
						<label>User</label>
                        <input type="text" name="ip_user" class="form-control" value="<?php if(isset($ipedit)){ echo $ipedit->ip_user;} ?>">
						<label>Location</label>
                        <input type="text" name="ip_location" class="form-control" value="<?php if(isset($ipedit)){ echo $ipedit->ip_location;} ?>">
						<label>IP Address</label>
                        <input type="text" name="ip_address" class="form-control" value="<?php if(isset($ipedit)){ echo $ipedit->ip_address;} ?>">
                    </div>
                </div>
             </div>
               <div class="form-actions text-left "> 
                      <?php if(isset($ipedit)) { ?>
                   <input type="hidden" value="<?php echo $ipedit->address_id; ?>" name="id">
                        <?php } ?> 
                        <input type="submit" value="<?php if(isset($ipedit)){ $rdct = 'ip_management'; echo 'Update';}else{ $rdct = ''; echo 'Add';} ?>" class="btn btn-primary"> 
                       <a href="<?php echo admin_url($rdct); ?>" class="btn btn-danger">Cancel</a> 
                       
                    </div>
            
        </form>
    </div>
          </div>

    <div class="col-md-7">
        <!-- Media datatable --> 
        <div class="panel panel-default"> 
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-users"></i>IP Addresses</h6>
            </div> 

            <div class="datatable"> 
                <table class="table table-bordered table-striped"> 
                    <thead> 
                        <tr> 
                            <th>S.N.</th>
							<th>User</th>
							<th>Location</th>
                            <th>IP Address</th>
                            <th class="actions-column">Action</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        <?php $cnt=1; foreach ($ip_list as $ip) { ?>
                            <tr>  
                                <td>
                                    <?php echo $cnt; ?>
                                </td>
								<td>
                                    <?php echo $ip->ip_user; ?>
                                </td>
								<td>
                                    <?php echo $ip->ip_location; ?>
                                </td>
                                <td>
                                    <?php echo $ip->ip_address; ?>
                                </td>
                                <td class="text-center"> 
                                    <div class="btn-group"> 
                                        <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></button>
                                        <ul class="dropdown-menu icons-right dropdown-menu-right">
                                            <li><a href="<?php echo admin_url('ip_management/edit/' . $ip->address_id) ?>"><i class="icon-pencil2"></i> Edit </a></li>
											<li><a href="javascript:void(0);" data-toggle="modal" data-target="#DeletModel_<?php echo $ip->address_id; ?>" ><i class="icon-remove4"></i> Remove </a></li>
                                        </ul> 
                                    </div> 
                                </td> 
                            </tr>
							<div class="modal fade" id="DeletModel_<?php echo $ip->address_id; ?>" role="dialog">
							  <div class="modal-dialog"> 
								<!-- Modal content to Delete -->
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Are you Sure to Delete! Please Enter Password:</h4>
								  </div>
								  <div class="modal-body">
									<form action="<?php echo admin_url('ip_management/delete/'.$ip->address_id) ?>" method="get" id="DeleteForm_<?php echo $ip->address_id; ?>">
									<div class="row">
									  <div class="col-md-12 col-sm-12 col-xs-12">
										<div class="form-group">
											<br>
											<input class="form-control" placeholder="password" type="password" name="user_password_<?php echo $ip->address_id; ?>" id="user_password_<?php echo $ip->address_id; ?>">
										</div>
									  </div>
									</div>
								  </div>
								  <div class="modal-footer">
									<button type="button" onclick="javascript: SubmitPassword(<?php echo $ip->address_id; ?>);" class="btn btn-primary">Proceed</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								  </div>
								  </form>
								</div>
							  </div>
							</div>
							
                        <?php $cnt++; } ?>
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




