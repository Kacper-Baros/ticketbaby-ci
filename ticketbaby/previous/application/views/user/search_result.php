
<?php $this->load->helper('url');?>
<div class="container-fluid content-bg">
  <div class="container content">
    
    <div class="col-xs-12 line2"></div>

<form class="form-horizontal" name="form" id="" method="POST" action="<?php echo base_url();?>index.php/user/search">   
      
        <div class="row no-mar main-content">
               <div class="col-md-6 col-xs-8 text-right">
                  <h1>Upcoming Events Details</h1>
            </div>
			<div class="col-xs-12 bgGray"><br/>
                        
                       
		<div class="billing-details"> 
		<div class="form-group cus-form">
		<div class="col-xs-12">
		<label class="col-md-3 col-xs-12">Event Title</label>
		<div class="col-md-4 col-xs-12 col-md-pull-1">
		
		<a href="<?php echo base_url();?>index.php/event/<?php echo $slug;?>"><?php echo $title;?></a>     
		</div><br/><Br/>
		</div>
		<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Details</label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1" style="margin-left:18%; width: 80%;">
		 <p style="text-align:justify;"><?php echo $detail;?></p>
		  </div><br/><Br/>
	</div>
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Email</label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input autocomplete="off" type="email" class="form-control-register"value="<?php echo $start_date;?>" name="email" required/>
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

	<div class="col-xs-12 ">
		  <label class="col-md-3 col-xs-12">Country</label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input autocomplete="off" type="text" class="form-control-register "value="<?php echo $country;?>" name="country" required />
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