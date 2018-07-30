
<div class="container-fluid content-bg">
  <div class="container content">
    
    <div class="col-xs-12 line2"></div>
	<h1>Invite Event</h1>
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

    </div> <!-- container ends -->
</div> <!-- Main div ends -->