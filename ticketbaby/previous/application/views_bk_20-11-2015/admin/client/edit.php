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
            <form role="form" method="post" class="form-admin-user-creation" action="<?=base_url()?>index.php/admin/client/edit?id=<?php echo isset($user_id) ? $user_id : "";?>&page_start=<?php echo isset($page_start) ? $page_start : "";?>">
                    <div class="form-group">

                    <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" required='true' name="user_name" value="<?php echo isset($user_details) ? $user_details['user_name'] : ''?>" placeholder="Enter text">
                    </div>    

                   
                    <div class="form-group">
                    <label>Full Name</label>
                    <input class="form-control" required='true' name="first_name" value="<?php echo isset($user_details) ? $user_details['first_name'] : ''?>" placeholder="Enter text">
                    </div>

                    <!--div class="form-group">
                    <label>Last Name</label>
                    <input class="form-control" name="first_name" value="<?php echo isset($user_details) ? $user_details['last_name'] : ''?>" placeholder="Enter text">
                    </div-->
  

                    <div class="form-group">
                    <label>Email</label>
                    <input type='email' class="form-control" required='true' name="email" value="<?php echo isset($user_details) ? $user_details['email'] : ''?>" placeholder="Enter text">
                    </div>

					 <div class="form-group">
                    <label>Phone</label>
                    <input class="form-control" required='true' name="phone" value="<?php echo isset($user_details) ? $user_details['phone'] : ''?>" placeholder="Enter text">
                    </div>
					 <?php //if ( !isset($user_id) ) { ?>
                    <div class="form-group">
                    <label>Password</label>
                    <input type='password' class="form-control" required='true' name="password"  value="<?php echo isset($user_details) ? 'password_boxer' : ''?>" placeholder="Enter text">
                    </div>
                    <?php //} ?>

                    <!--div class="col-lg-6">
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
                    </div-->


                  
                    <div class="col-lg-12">
                    <div class="col-lg-8">

                    <div class="form-group">
                    <label>Active</label>
                        <div class="radio">
                            <label><input type="radio" name="status" value="1" <?php echo (isset($user_details) && $user_details['status'] == '1') ? 'checked' : ''?> >True</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="0" name="status" <?php echo (isset($user_details) && $user_details['status'] == '0') ? 'checked' : ''?> >False</label>
                        </div>
                    </div>


                    </div>

          

                    <div class="col-lg-4">
                        <div style="float:right;">
                        <a href="<?=base_url()?>index.php/admin/client/<?php echo isset($page_start) ? $page_start : "";?>"><button type="button" class="btn">Back Button</button></a>
                        <button type="submit" class="btn">Submit Button</button>

                        <input  type="hidden" name="id" value="<?php echo isset($user_id) ? $user_id : "";?>" />
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