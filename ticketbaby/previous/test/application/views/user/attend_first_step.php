<?php
$event_id.=$this->uri->segment(3);
$email.=$this->uri->segment(4);
$code.=$this->uri->segment(5);
$event_id.=$this->uri->segment(6);
$user_id.=$this->uri->segment(7);
$href = '';
$href.=$event_id.'/'.$email.'/'.$code.'/'.$event_id.'/'.$user_id;
?>
<div class="container-fluid content-bg">
	<div class="container content">
        <div class="row no-mar main-content leftPad">
			<div class="col-md-6 col-xs-12">
				<h2 class="text-orange">Please provide us some details of yours</h2>
			</div>
			
			
		
			<div class="col-xs-12 ">
                <form method="post" name="form" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/user/attend/<?php echo $href;?>">               
                	<div class="col-xs-12"><hr/></div>
                    
                    <div class="col-xs-12 cus-form3">
                    
                        <div class="form-group col-xs-12">
                            <label>Your Name <span class="red">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Please provide your name" required/>
                        </div>
                        
                        <div class="form-group col-xs-12">
                            <label>Contact Number <span class="red">*</span></label>
                            <input   class="form-control" type="text" name="contactNo" value="" placeholder="Please provide your contact number" required>
                        </div>
                        
                        <div class="col-xs-12 text-center">
                            <h2>Nice Job! You're almost done.</h2>
                            <button class="btn btn-default btn-lg" type="submit" value="Save" name="confirm">Confirm</button>
                        </div>  
               		</div>
                </form>
			</div>
        </div>
    </div>
</div>
