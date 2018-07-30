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
            <form role="form" method="post" class="form-admin-user-creation" action="<?=base_url()?>index.php/admin/user/edit?user_id=<?php echo isset($user_id) ? $user_id : "";?>&page_start=<?php echo isset($page_start) ? $page_start : "";?>">
                    <div class="form-group">
					<input type="hidden" name="id" value="<?php echo $user_id;?>"/>
                    <div class="form-group">
                    <label>Email</label>
					 <input class="form-control" name="email" value="<?php echo isset($user_details) ? $user_details['email'] : ''?>" placeholder="Enter text">
                    </div>    

                    <?php if ( !isset($user_id) ) { ?>
                    <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password"  value="<?php echo isset($user_details) ? $user_details['password'] : ''?>" placeholder="Enter text">
                    </div>
                    <?php } ?>

                    <div class="form-group">
                    <label>First Name</label>
                    <input class="form-control" name="first_name" value="<?php echo isset($user_details) ? $user_details['first_name'] : ''?>" placeholder="Enter text">
                    </div>

                    <div class="form-group">
                    <label>Last Name</label>
                    <input class="form-control" name="last_name" value="<?php echo isset($user_details) ? $user_details['last_name'] : ''?>" placeholder="Enter text">
                    </div>
  
                    <div class="col-lg-6">
                    <div class="form-group">
                    <label>Address</label>
                    <input class="form-control" name="address" value="<?php echo isset($user_details) ? $user_details['address'] : ''?>" placeholder="Enter text">
                    </div>


                    <div class="form-group">
                    <label>City</label>
                    <input class="form-control" name="city" value="<?php echo isset($user_details) ? $user_details['city'] : ''?>" placeholder="Enter text">
                    </div>

                    <div class="form-group">
                    <label>State</label>
                    <input class="form-control" name="state" value="<?php echo isset($user_details) ? $user_details['state'] : ''?>" placeholder="Enter text">
                    </div>
                    </div>

                    <div class="col-lg-6">
  
                     <div class="form-group">
                    <label>Country</label>
                    <input class="form-control" name="country" value="<?php echo isset($user_details) ? $user_details['country'] : ''?>" placeholder="Enter text">
                    </div>

                    <div class="form-group">
                    <label>Zip</label>
                    <input class="form-control" name="zip" value="<?php echo isset($user_details) ? $user_details['zip'] : ''?>" placeholder="Enter text">
                    </div>
                    </div>


                  
                    <div class="col-lg-12">
                    <div class="col-lg-8">

                    <div class="form-group">
                    <label>Active</label>
                        <div class="radio">
                            <label><input type="radio" name="active" value="Y" <?php echo (isset($user_details) && $user_details['active'] == 'Y') ? 'checked' : ''?> >True</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="N" name="active" <?php echo (isset($user_details) && $user_details['active'] == 'N') ? 'checked' : ''?> >False</label>
                        </div>
                    </div>


                    </div>

          

                    <div class="col-lg-4">
                        <div style="float:right;">
                        <a href="<?=base_url()?>index.php/admin/user/<?php echo isset($page_start) ? $page_start : "";?>"><button type="button" class="btn">Back Button</button></a>
                        <button type="submit" name="update"class="btn">Submit Button</button>

                        <input  type="hidden" name="user_id" value="<?php echo isset($user_id) ? $user_id : "";?>" />
                        <input  type="hidden" name="id_admin" value="0" />

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