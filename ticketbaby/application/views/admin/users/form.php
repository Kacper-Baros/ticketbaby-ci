<?php
error_reporting(0);
//print_r($_REQUEST['id']);
if (isset($users)) {
    $path = admin_url('users/update/' . $users->id);
} else {
    $path = admin_url('users/save');
}
?>
       <form action="<?echo $path; ?>" method="post" enctype="multipart/form-data" role="form"> 
           <div class="panel panel-default"> 
               <div class="panel-heading">
                   <h6 class="panel-title">
                   <i class="icon-user"></i>
                   <?php if (isset($users)) { echo "Edit User"; } else{ echo "Add User "; }  ?>
                   </h6>
               </div> 
               <div class="panel-body">
                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-6">
                               <label>Full Name</label> 
                               <input type="text" name="fullname" class="form-control" value="<?php if(isset($users->fullname)){echo $users->fullname;}?>">
                               <?php echo form_error('fullname'); ?>
                           </div> 
                           <div class="col-md-6">
                               <label>Username</label> 
                               <input type="text" name="username" class="form-control" value="<?php if(isset($users->username)){echo $users->username;}?>" <?php if(isset($users->username)){ echo 'readonly="readonly"';}?>>
                               <?php echo form_error('username'); ?>
                           </div>                                                    
                       </div>
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-6">
                               <label>Email</label> 
                               <input type="text" name="email" class="form-control" value="<?php if(isset($users->email)){echo $users->email;}?>">
                               <?php echo form_error('email'); ?>
                           </div> 
						   <div class="col-md-6">
                               <label>Phone Number</label> 
                               <input type="text" name="phone_no" class="form-control" value="<?php if(isset($users->phone_no)){echo $users->phone_no;}?>">
                               <?php echo form_error('phone_no'); ?>
                           </div> 
                       </div>                       
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-6">
                               <label>Password</label> 
                               <input type="password" name="password" class="form-control" value="">
                               <?php echo form_error('password'); ?>
                           </div> 
                           <div class="col-md-6">
                               <label>Repeat Password</label> 
                               <input type="password" name="re_password" class="form-control" value="">
                               <?php echo form_error('re_password'); ?>
                           </div>
                                                                                                        
                       </div>
                           <?php
							if (isset($user->fullname)) { ?>
								<p>Leave password fields blank if you don't want to change the password</p>
						<?php    }
							?>                         
                   </div>


                   <div class="form-actions text-right"> 
                        
                       <a href="<?php echo admin_url('users'); ?>" class="btn btn-danger">Cancel</a> 
                       <input type="submit" value="<?php if(isset($users->fullname)){ echo "Update User"; }else{  echo "Add User"; }  ?>" class="btn btn-primary">
                   </div>
               </div>
           </div>
       </form>