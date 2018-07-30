
<?php $this->load->helper('url');?>
<div class="container-fluid content-bg">
  <div class="container content">
    
    <div class="col-xs-12 line2"></div>

<form class="form-horizontal" name="form" id="" method="POST" action="<?php echo base_url();?>index.php/user/edit_user_detail">   
      
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
                  <h1>Edit Account details</h1>
            </div>
			<div class="col-xs-12 bgGray"><br/>
                        
                       
		<div class="billing-details"> 
		<div class="form-group cus-form">
		<div class="col-xs-12">
			  <label class="col-md-3 col-xs-12">User Name</label>
			  <div class="col-md-4 col-xs-12 col-md-pull-1">
			  <input autocomplete="off" type="text" class="form-control-register" value="<?php echo $user_name;?>" name="user_name" required />
			  </div><br/><Br/>
		</div>
		
		<div class="col-xs-12">
			<label class="col-md-3 col-xs-12">First Name</label>
			<div class="col-md-4 col-xs-12 col-md-pull-1">
			<input type="hidden" name="user_ids" value="<?php echo $id;?>">
			<input  type="text" class="form-control-register" name="first_name" value="<?php echo $first_name;?>"required />     
			</div><br/><Br/>
		</div>
		
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Email</label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input autocomplete="off" type="email" class="form-control-register"value="<?php echo $email;?>" name="email" required/>
		  </div><br/><Br/>
	</div>
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Address</label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input autocomplete="off" type="text" class="form-control-register" value="<?php echo $address;?>"name="address"  required/>
		  </div><br/><Br/>
	</div>
	
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">City</label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
			<input autocomplete="off" type="text" class="form-control-register" value="<?php echo $city;?>"name="city"required/>

		  </div><br/><Br/>
	</div>
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Area</label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
			<input autocomplete="off" type="text" class="form-control-register" value="<?php echo $area;?>"name="area"required  />
		  </div><br/><Br/>
	</div>
	<div class="col-xs-12 ">
		  <label class="col-md-3 col-xs-12">Country</label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input autocomplete="off" type="text" class="form-control-register "value="<?php echo $country;?>" name="country" required />
		  </div>
		 
		  <br/><Br/>
	</div>
<div class="col-xs-12 ">
		  <label class="col-md-3 col-xs-12">Phone </label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input autocomplete="off" type="text" class="form-control-register "value="<?php echo $phone;?>" name="phone" required />
		  </div>
		 
		  <br/><Br/>
	</div>

          
	<div class="col-xs-12">
		
		  <div class="col-md-0 col-xs-12 ">
		  </br>
		 <input type="Submit" name="update" class="btn btn-danger btn-red btn-lg" value="Update"><br/>

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