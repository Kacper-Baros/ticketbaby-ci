<?php
error_reporting(0);
if (isset($user)) {
    $path = admin_url('user_management/update/' . $user->id);
} else {
    $path = admin_url('user_management/save');
}
?>
       <form action="<?= $path; ?>" method="post" enctype="multipart/form-data" role="form"> 
           <div class="panel panel-default"> 
               <div class="panel-heading">
                   <h6 class="panel-title">
                   <i class="icon-user"></i>
                   <?php if (isset($user)) { echo "Edit User"; } else{ echo "Add User "; }  ?>
                   </h6>
               </div> 
               <div class="panel-body">
                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-6">
                               <label>Name</label> 
                               <input type="text" name="name" class="form-control" value="<?php if(isset($user->name)){echo $user->name;}?>">
                               <?php echo form_error('name'); ?>
                           </div> 
                           <div class="col-md-6">
                               <label>Email</label> 
                               <input type="text" name="email" class="form-control" value="<?php if(isset($user->email)){echo $user->email;}?>">
                               <?php echo form_error('email'); ?>
                           </div>                                                    
                       </div>
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-6">
                               <label>Username</label> 
                               <input type="text" name="username" class="form-control" value="<?php if(isset($user->username)){echo $user->username;}?>">
                               <?php echo form_error('username'); ?>
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
                               <input type="password" name="repeat_password" class="form-control" value="">
                               <?php echo form_error('repeat_password'); ?>
                           </div>
                                                                                                        
                       </div>
                           <?php
    if (isset($user->name)) { ?>
        <p>leave password fields blank if you dont want to change the password</p>
<?php    }
    ?>                         
                   </div>


                   <div class="form-actions text-right"> 
                        
                       <a href="<?php echo admin_url('user_management'); ?>" class="btn btn-danger">Cancel</a> 
                       <input type="submit" value="<?php if(isset($user->name)){ echo "Update User"; }else{  echo "Add User"; }  ?>" class="btn btn-primary"> 
                   </div>
               </div>
           </div>
       </form>
















<!-- 

<?php
error_reporting(0);
if (isset($user)) {
    $path = admin_url('user_management/update/' . $user->id);
} else {
    $path = admin_url('user_management/save');
}
?>
<form action="<?= $path; ?>" method="post">
    <div class="element">
        <label for="name">Name<span class=""></span></label>
        <input id="name" name="name" class="" value="<?= $user->name; ?>" />
        <?= form_error('name'); ?>
    </div>
    <div class="element">
        <label for="email">Email<span class=""></span></label>
        <input id="name" name="email" class="" value="<?= $user->email; ?>" />
        <?= form_error('email'); ?>
    </div>
    <div class="element">
        <label for="username">Username<span class=""></span></label>
        <input id="name" name="username" class="" value="<?= $user->username; ?>" />
        <?= form_error('username'); ?>
    </div>
    <div class="element">
        <label for="password">Password<span class=""></span></label>
        <input id="name" name="password" class=""  value="" />
        <?= form_error('password'); ?>
    </div>
    <div class="element">
        <label for="password">Repeat Password<span class=""></span></label>
        <input id="name" name="repeat_password" class="" />
    </div>
    <?php
    if (isset($user->name)) {
        echo 'leave password fields blank if you dont want to change the password';
    }
    ?>
<?php if (isset($user->name)) { ?>
        <div class="entry">
            <button type="submit" class="add">Update User</button>

        </div>
    <?php } else {
        ?>
        <button type="submit" class="add">Add User</button>
<?php } ?>
</form> -->