
<div class="container-fluid content-bg">
  <div class="container content">
    
    <div class="col-xs-12 line2"></div>
	<h1>Invite For Event</h1>
	<table class="table table-striped table-bordered table-hover">
		<thead>
		<tr>
			<th>Invite Email</th>
			<th>Invite Date</th>
			<th>Accept</th>
		
		</tr>
		</thead>
		<tbody>
	<?php
	if($all_event){
		
		foreach($all_event as $_row_event){
			$start_date	=	date("M d, Y",strtotime($_row_event['created_date']));
			if($_row_event['attend_user']==1)
				$attend_user	=	"Yes";
			else
				$attend_user	=	"No";
				
			echo "<tr>";
			echo "<td>{$_row_event['invite_email']}</td>";
			echo "<td>{$start_date}</td>";
			echo "<td>{$attend_user}</td>";
			echo "</tr>";
		}
	}else{
		echo "<tr><td colspan='4'>No Coming </td></tr>";
	}
	?><tr><td colspan='4'><?php echo $this->pagination->create_links();  ?></td></tr>
		</tbody>
	</table>
<div class="col-lg-12">
								<div style="float:right;">
								<a href="<?=base_url()?>index.php/user/my_event/<?php echo isset($page_start) ? $page_start : "";?>"><button type="button" class="btn">Back</button></a>
								<input  type="hidden" name="order_id" value="<?php echo isset($order_id) ? $order_id : "";?>" />
								</div>    
							</div>
    </div> <!-- container ends -->
</div> <!-- Main div ends -->