<?php
    if ( isset($cart_user_session) && isset($cart_user_session['billing_details']) ) {
        $billing_details = $cart_user_session['billing_details'];
    }

    if ( isset($cart_user_session) && isset($cart_user_session['user_details']) ) {
        $user_details     = $cart_user_session['user_details'];
    }

?>
   
<div class="container-fluid content-bg">
  <div class="container content">
     <div class="heading col-xs-12">
         
            <div class="col-md-8 col-xs-12 btnVus">
  <div class="" role="group" aria-label="...">
	<div class="btn-group">
	</div>
		<button type="button" class="btn btn-default btn-g"><a href="#">Account Details</a></button>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>/index.php/music/Change-password">Change Password</a></button>
	</div>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="#">Order Details</a></button>
	</div>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-g"><a href="<?php echo base_url();?>/index.php/music/Login">Login</a></button>
	</div>
	
                  </div>
            </div>
    </div>
    <div class="col-xs-12 line2"></div>


        <form class="form-horizontal" name="form" method="POST" action="">    
        <div class="row no-mar main-content">
           
               

                

                  <div class="col-md-6 col-xs-8 text-right">
                  <h1>Registration On Ticket Baby</h1>
            </div>
                  <div class="col-xs-12 bgGray"><br/>
                        
                        <p class="textRed">NOTE:  * = Required Text</p>

		<div class="billing-details"> 
		<div class="form-group cus-form">
		<div class="col-xs-12">
		<label class="col-md-3 col-xs-12">First Name<span class="textRed">*</span></label>
		<div class="col-md-4 col-xs-12 col-md-pull-1">
		<input  type="text" class="form-control-register" name="fname" />     
		</div><br/><Br/>
		</div>
		<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Last Name<span class="textRed">*</span></label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input autocomplete="off" type="text" class="form-control-register" name="last_name"  />
		  </div><br/><Br/>
	</div>
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Email<span class="textRed">*</span></label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input autocomplete="off" type="email" class="form-control-register" name="email" />
		  </div><br/><Br/>
	</div>
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Address<span class="textRed">*</span></label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input autocomplete="off" type="text" class="form-control-register" name="address"  />
		  </div><br/><Br/>
	</div>
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Area<span class="textRed">*</span></label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
			<input autocomplete="off" type="text" class="form-control-register" name="area"  />
		  </div><br/><Br/>
	</div>
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">City<span class="textRed">*</span></label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
			<input autocomplete="off" type="text" class="form-control-register" name="city"/>

		  </div><br/><Br/>
	</div>
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Postcode<span class="textRed">*</span></label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input autocomplete="off" type="text" class="form-control-register" name="post_code"  />
		  </div><br/><Br/>
	</div>
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Country<span class="textRed">*</span></label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input autocomplete="off" type="text" class="form-control-register" name="country" />
		  </div>
		 
		  <br/><Br/>
	</div>

	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Mobile Phone<span class="textRed">*</span></label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input  type="text" class="form-control-register" name="mobile_number" />

		  </div>
		
		  <br/><Br/>
	</div>
          
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Password<span class="textRed">*</span></label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input  type="password" class="form-control-register" name="password" />

		  </div>
		
		  <br/><Br/>
	</div>
          
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Confirm Password<span class="textRed">*</span></label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">

		  <input  type="password" class="form-control-register" name="confirm_password" />
		  </div>
		
		  <br/><Br/>
	</div>
            
	<div class="col-xs-12">
		
		  <div class="col-md-0 col-xs-12 ">
		  </br>
		 <input type="Submit" name="Submit" class="btn btn-danger btn-red btn-lg" value="Register"><br/>

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