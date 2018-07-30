
<div class="container-fluid content-bg">
  <div class="container content">
    <div class="heading col-xs-12">
         
            <div class="col-md-8 col-xs-12 btnVus">
  <div class="" role="group" aria-label="...">
	<div class="btn-group">
	</div>
	 <?php if($this->session->flashdata('error')) { ?>                    
                        <p style="color:red">
                            <?php echo $this->session->flashdata('error');?>
                        </p>                   
                    <?php } 
					 elseif($this->session->flashdata('success')) { ?>                    
                        <p style="color:green">
                            <?php echo $this->session->flashdata('success');?>
                        </p>                   
                    <?php }?>     
	
                  </div>
            </div>
    </div>
    <div class="col-xs-12 line2"></div>
		<?php if($yes==1){
			$title	=	ucwords($event_details['title']);
			echo "<h1>You're going to {$title}</h1>";
		}?>

    </div> <!-- container ends -->
</div> <!-- Main div ends -->