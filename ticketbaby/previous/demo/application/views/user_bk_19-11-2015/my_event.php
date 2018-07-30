
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
<?php if($event_id){?>
<form class="form-horizontal" name="form" id="" method="POST" action="<?php echo base_url();?>index.php/user/invitation">   
      
        <div class="row no-mar main-content">
          
                  <div class="col-md-6 col-xs-8 text-right">
                  <h1>Invite People</h1>
            </div>
			
			<div class="col-xs-12 bgGray"><br/>
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
                       
		<div class="billing-details"> 
		<div class="form-group cus-form">	
		<input type="hidden" name="event_id" value="<?php echo $event_id;?>">
		
	
		
	<div class="col-xs-12">
		  <label class="col-md-3 col-xs-12">Send a test invitation to:</label>
		  <div class="col-md-4 col-xs-12 col-md-pull-1">
		  <input autocomplete="off" type="email" required='true' class="form-control-register" value="<?php echo $email;?>" name="email" />
		  </div><br/><Br/>
	</div>
	
            
	<div class="col-xs-12">
		
		
		 	  <div class="col-md-0 col-xs-12 ">
		  </br>
		 <input class="btn btn-danger btn-red btn-lg" type='Submit' name='send' value="Send">
		 <a href="<?php echo base_url();?>index.php/user/my_event"><input class="btn btn-danger btn-red btn-lg" value="Back"></a><br/>
		
		
		  </div>
		 
		  
		  <br/><br/>
	</div>
                             </div>
                      </div>
                  </div>
               
                
        </div>
        
</form>
<?php }else{
	?>
	<h1>My Event</h1>
	<table class="table table-striped table-bordered table-hover">
		<thead>
		<tr>
			<th>Event Title</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Invite</th>
			<th>Accepted</th>
			<th>Preview</th>
		</tr>
		</thead>
		<tbody>
			<!--a href="<?php echo base_url();?>assets/images/calender.png"><button class="btn btn-default btn-lg" type="button" target="_blank" >Preview</button></a-->
	<?php
	
	if($all_event){
		
		foreach($all_event as $_row_event){
		
		
		if ($_row_event['start_date']=="")
		{
		$start_date="-";
		}else{
			$start_date		=	date("M d, Y",strtotime($_row_event['start_date']));}
			
			if ($_row_event['end_date']=="")
		{
		$end_date="-";
		}else{
			
			$end_date		=	date("M d, Y",strtotime($_row_event['end_date']));}
			//$edit_url		=	base_url()."index.php/event/add_event/{$_row_event['id']}";
			//$edit			=	"<a href='{$edit_url}' title='Edit Event'>Edit</a>";
			$invite_url		=	base_url()."index.php/user/my_event/{$_row_event['id']}";
			$invite			=	"<a href='{$invite_url}' title='Invite'>Invite</a>";
			
			$accept_url		=	base_url()."index.php/user/accept/{$_row_event['id']}";
			
			$preview_url1	=   base_url()."index.php/user/image_preview/{$_row_event['id']}";
			$accept			=	"<a href='{$accept_url}' title='Accept'>Accept</a>";
			//$preview		=	"<a class='image_preview' href='{$preview_url}' target='_blank' title='Preview'>Preview</a>";
			$preview		=	"<a href='{$preview_url1}' target='_blank' title='Preview'>Preview</a>";
			$back_url		=	base_url()."index.php/cart/home/";
			$title			=	ucwords($_row_event['title']);
			//echo $preview_url;die();
			echo "<tr>";
			echo "<td>{$title}</td>";
			echo "<td>{$start_date}</td>";
			echo "<td>{$end_date}</td>";
			echo "<td>{$edit} {$invite}</td>";
			echo "<td>{$edit} {$accept}</td>";
			echo "<td>{$preview}</td>";
			echo "</tr>";
			?>

			<?php 
		
		}
	}else{
		echo "<tr><td colspan='6'>No Event </td></tr>";
	}
	?>
	<tr><td colspan='6'><?php echo $this->pagination->create_links();  ?></td></tr>
		</tbody>
	</table>
<?php	
}	?>
						
    </div> <!-- container ends -->
</div> <!-- Main div ends -->