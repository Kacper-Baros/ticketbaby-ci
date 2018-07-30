
<div class="container-fluid content-bg">
  <div class="container content">
    
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
		 <a href="<?php echo base_url();?>index.php/event/add_event"><input class="btn btn-danger btn-red btn-lg" value="Back To Create Event"></a><br/>
		
		
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
		</tr>
		</thead>
		<tbody>
	<?php
	if($all_event){
		
		foreach($all_event as $_row_event){
			$start_date	=	date("M d, Y",strtotime($_row_event['start_date']));
			$end_date	=	date("M d, Y",strtotime($_row_event['end_date']));
			//$edit_url	=	base_url()."index.php/event/add_event/{$_row_event['id']}";
			//$edit		=	"<a href='{$edit_url}' title='Edit Event'>Edit</a>";
			$invite_url	=	base_url()."index.php/user/my_event/{$_row_event['id']}";
			$invite		=	"<a href='{$invite_url}' title='Invite'>Invite</a>";
			
			$accept_url	=	base_url()."index.php/user/accept/{$_row_event['id']}";
			$accept		=	"<a href='{$accept_url}' title='Accept'>Accept</a>";
			$back_url	=	base_url()."index.php/cart/home/";
			$title		=	ucwords($_row_event['title']);
			echo "<tr>";
			echo "<td>{$title}</td>";
			echo "<td>{$start_date}</td>";
			echo "<td>{$end_date}</td>";
			echo "<td>{$edit} {$invite}</td>";
			echo "<td>{$edit} {$accept}</td>";
			echo "</tr>";
			
			//echo "<a href='{$back_url}' title='Back'>Backssss</a>";
		}
	}else{
		echo "<tr><td colspan='5'>No Event </td></tr>";
	}
	?>
	
	<tr><td colspan='5'><?php echo $this->pagination->create_links();  ?></td></tr>
		</tbody>
	</table>
<?php	
}?>
								<div style="float:right;">
								<a href="<?=base_url()?>index.php/cart/home/<?php echo isset($page_start) ? $page_start : "";?>"><button type="button" class="btn">Back</button></a>
								<input  type="hidden" name="order_id" value="<?php echo isset($order_id) ? $order_id : "";?>" />
								</div>   					
    </div> <!-- container ends -->
</div> <!-- Main div ends -->