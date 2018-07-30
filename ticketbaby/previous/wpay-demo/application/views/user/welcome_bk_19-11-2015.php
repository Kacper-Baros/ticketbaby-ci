<?php $this->load->helper('url');?>
<div class="container-fluid content-bg">
  <div class="container content">
    <div class="heading col-xs-12">
         
            <div class="col-md-8 col-xs-12 btnVus">
  <div class="" role="group" aria-label="...">
	
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/account_detail">Account Details</a></button>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/change_password">Change Password</a></button>
	</div>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/order_detail">Order Details</a></button>
	</div>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/my_event">My Events</a></button>
	</div>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>index.php/user/logout">Logout</a></button>
	</div>
	
  </div>
            </div>
    </div>
    <div class="col-xs-12 line2"></div>

<form class="form-horizontal" name="form"  method="POST" action="">   
      <?php 
	 
	  if ($user_detail){
	   echo $user_detail['first_name'];
	  ?>
   
       <?php } ?> 
        </form>
    </div> <!-- container ends -->
</div> <!-- Main div ends -->