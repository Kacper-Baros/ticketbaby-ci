
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


        <form class="form-horizontal" name="form" method="POST" action="<?php echo base_url();?>index.php/user/confirm">    
        <div class="row no-mar main-content">
           
               <?php 
				
				  if($this->session->flashdata('error')) { ?>                    
                        <p style="color:red">
                            <?php echo $this->session->flashdata('error');?>
                        </p>                   
                    <?php } 
					 elseif($this->session->flashdata('success')) { ?>                    
                        <p style="color:green">
                            <?php echo $this->session->flashdata('success');?>
                        </p>                   
                    <?php }?>

                

                  <div class="col-md-6 col-xs-8 text-right">
                  <h1>Change Password</h1>
            </div>
                  <div class="col-xs-12 bgGray"><br/>
                           
                        <p class="textRed">NOTE:  * = Required Text</p>

		<div class="billing-details"> 
		<div class="form-group cus-form">



          <input type="hidden" name="user_ids" value="<?php echo $id;?>">
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Old Password<span class="textRed">*</span></label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input  type="password" class="form-control" name="old_password" required />

		  </div>
		
		  <br/><Br/>
	</div>       
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Password<span class="textRed">*</span></label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input  type="password" class="form-control" name="password" required />

		  </div>
		
		  <br/><Br/>
	</div>
          
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Confirm Password<span class="textRed">*</span></label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input  type="password" class="form-control" name="con_password" required/>

		  </div>
		
		  <br/><Br/>
	</div>
            
	<div class="col-xs-12">
		
		  <div class="col-md-0 col-xs-12 ">
		  </br>
		 <input type="Submit" name="confirm_password" class="btn btn-danger btn-red btn-lg" value="Change Password"><br/>

		  </div>
		 
		  <div class="col-md-0 col-xs-12 ">
		  </br>
		 <a href="<?php echo base_url();?>index.php/cart/home"><input class="btn btn-danger btn-red btn-lg" value="Back"></a><br/>

		  </div>
		 
		  
		  <br/><br/>
	</div>
                              </div>
                      </div>
                  </div>
               
                
        </div>
         
        </form>
    </div> <!-- container ends -->
</div> <!-- Main div ends -->