<!-- Media datatable --> 
<style>
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
  border: 1px solid #ddd !important;
}
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th{
padding:10px 5px !important;	
}
</style>

<?php 
	if(isset($_GET['delete']))
	{
		
			
		$q="Select *  FROM tbl_orders WHERE id = ".$_GET['delete'];
		$resulte = $this->db->query($q);
		$rows = $resulte->result_array();
		
		
		if($rows[0]['table']!="")
		{
				$tbl=explode('&',$rows[0]['table']);
				$table=explode(',',rtrim($tbl[0],','));
				$event_seat_id=explode(',',rtrim($tbl[2],','));
				foreach($table as $key=>$val)
				{
				 $q1="UPDATE tbl_event_tables SET status = 0  WHERE event_id = ". $_GET['event_id']." and event_seat_id =".$event_seat_id[$key]." and table_no = ".$val; 
					$resulte = $this->db->query($q1);
				}
		}
		
		
		if($rows[0]['ticket_table']!="")
		{
				$tck=explode('&',$rows[0]['ticket_table']);
				$ticket=explode(',',rtrim($tck[0],','));
				$No_of_tickrt=explode(',',rtrim($tck[1],','));
				$event_seat_id=explode(',',rtrim($tck[3],','));
				
				foreach($ticket as $key=>$val)
				{
					$qty="Select *  FROM tbl_event_tables WHERE event_id = ". $_GET['event_id']." and event_seat_id =".$event_seat_id[$key]." and table_no=".$val;
					$resulte = $this->db->query($qty);
					$row = $resulte->result_array();
					$seat=$row[0]['seat']-$No_of_tickrt[$key];
					
					 $q1="UPDATE tbl_event_tables SET seat = '$seat'  WHERE id=".$row[0]['id']; 
					 $resulte = $this->db->query($q1);
					
					if($seat==0)
					{
						$q="UPDATE tbl_event_tables SET status = 0  WHERE   id=".$row[0]['id'];
						$resulte = $this->db->query($q);
					}
				}
		}
		
		if($rows[0]['addtional']!="")
		{
			$addtional=explode('&',$rows[0]['addtional']);
			$addt=explode(',',rtrim($addtional[2],','));
			$add_seat=explode(',',rtrim($addtional[3],','));
			foreach($addt as $key=>$val)
			{
				$tbl_event = $this->db->get_where('tbl_event_seats', array('event_id' => $_GET['event_id'],'ticket_class_id'=>$val))->row();
				$total=($tbl_event->table_end+$add_seat[$key]);
				
				$q="UPDATE tbl_event_seats SET table_end  = $total  WHERE event_id = ". $_GET['event_id']." and ticket_class_id=".$val; 
				$resulte = $this->db->query($q);
			}
		}
		
		if($rows[0]['tickets']!="")
		{
			$tickets=explode('&',$rows[0]['tickets']);
			$addt=explode(',',rtrim($tickets[2],','));
			$add_seat=explode(',',rtrim($tickets[3],','));
			foreach($addt as $key=>$val)
			{
				$tbl_event = $this->db->get_where('tbl_event_seats', array('event_id' => $_GET['event_id'],'ticket_class_id'=>$val))->row();
				$total=($tbl_event->table_end+$add_seat[$key]);
				
				$q="UPDATE tbl_event_seats SET table_end  = $total  WHERE event_id = ". $_GET['event_id']." and ticket_class_id=".$val; 
				$resulte = $this->db->query($q);
			}
		}
		
		 $q="DELETE FROM tbl_orders WHERE id = ".$_GET['delete'];
		 $this->db->query($q);
		 redirect(site_url('admin/orders'));
	}
?>
<div class="panel panel-default order-table"> 
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-users"></i>Events</h6>
    </div>
    <div class="filter_by_date">
        <form method="post" action="<?php echo admin_url('orders/list_orders'); ?>">
            <input name="from" type="text" placeholder="From" id="from_date">
            <input name="to" type="text" placeholder="To"  id="to_date">
            <input type="submit" value="find">
        </form>
    </div>
    <a class="exportOrder" data-toggle="modal" data-target="#exportmodal"> <!-- href="<?php //echo admin_url('orders/export_orders'); ?>" --> <i class="fa fa-external-link" aria-hidden="true"></i> Export </a>
	<div class="modal fade" id="exportmodal" role="dialog">
	  <div class="modal-dialog"> 
		<!-- Modal content to Export Fields list -->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Select Fields to Export Data</h4>
		  </div>
		  <div class="modal-body">
			<form action="<?php echo admin_url('orders/export_orders'); ?>" method="" id="ExportsFields">
			<div class="row">
			  <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="form-group">
					<select class="form-control" name="selectedEvent_id">
						<option value="">---SELECT EVENT---</option>
						<?php $eventList = $this->db->get_where('tbl_events', array('status' => '1'))->result();
						foreach($eventList as $evnt){
						?>
						<option value="<?php echo $evnt->id; ?>"><?php echo $evnt->name;?></option>	
						<?php } ?>
					</select>
				</div>
				<?php
					$fields = $this->db->list_fields('tbl_orders');
				?>
				<div class="multiselect form-group" style="height: 320px; overflow: auto;">
				<br>
					<?php 
					$FieldsLabels = '';
					foreach($fields as $field){
						if($field==='id'){
							$FieldsLabels = "Order ID";
						}
						if($field==='event_id'){
							$FieldsLabels = "Event Name";
						}
						if($field==='customer_first_name'){
							$FieldsLabels = "First Name";
						}
						if($field==='customer_last_name'){
							$FieldsLabels = "Last Name";
						}
						if($field==='customer_email'){
							$FieldsLabels = "Email ID";
						}
						if($field==='customer_phone'){
							$FieldsLabels = "Phone Number";
						}
						if($field==='cardholder_first_name'){
							$FieldsLabels = "Card Holder First Name";
						}
						if($field==='cardholder_last_name'){
							$FieldsLabels = "Card Holder Last Name";
						}
						if($field==='cardholder_email'){
							$FieldsLabels = "Card Holder Email ID";
						}
						if($field==='cardholder_address'){
							$FieldsLabels = "Address";
						}
						if($field==='cardholder_area'){
							$FieldsLabels = "Area";
						}
						if($field==='cardholder_city'){
							$FieldsLabels = "City";
						}
						if($field==='cardholder_country'){
							$FieldsLabels = "Country";
						}
						if($field==='cardholder_post_code'){
							$FieldsLabels = "Post Code";
						}
						if($field==='cardholder_contact_number'){
							$FieldsLabels = "Contact Number";
						}
						if($field==='cardholder_mobile_number'){
							$FieldsLabels = "Mobile Number";
						}
						if($field==='subtotal'){
							$FieldsLabels = "Total";
						}
						if($field==='payment_status'){
							$FieldsLabels = "Payment Status";
						}
						if($field==='cart_id'){
							$FieldsLabels = "Cart ID";
						}
						if($field==='verified'){
							$FieldsLabels = "Verified";
						}
						if($field==='created'){
							$FieldsLabels = "Date";
						}
						if($field==='table'){
							$FieldsLabels = "Table";
						}
						if($field==='ticket_table'){
							$FieldsLabels = "Table Tickets";
						}
						if($field==='addtional'){
							$FieldsLabels = "Additionals";
						}
						if($field==='tickets'){
							$FieldsLabels = "Tickets Only";
						}
						if($field==='coupon_id'){
							$FieldsLabels = "Coupon";
						}
					?>
						&nbsp;&nbsp;&nbsp;&nbsp;<label data-labelfor="CityTown"><input type="checkbox" class="chk_status" name="export_fields[]" value="<?php echo $field; ?>" />&nbsp;&nbsp;<?php echo $FieldsLabels; ?></label><br>
					<?php } ?>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="submit" id="submitExport" class="btn btn-primary">Export</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
    <div class="datatable"> 
        <table class="table table-bordered table-striped" id="orderTable"> 
            <thead> 
                <tr> 
                    <th>Order ID</th>  
                    <th>Event</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Table No</th>
                    <th>Table Ticket</th>
                    <th>Tickets</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Verify</th>
                    <th class="actions-column">Action</th> 
                </tr> 
            </thead> 
            <tbody> 

                <?php foreach ($orders as $s) { ?>
                    <tr>  
                        <td><?php echo $s->id; ?></td> 
                        <td>
                        <?php
							 $q="SELECT `name` FROM `tbl_events` WHERE `id`=".$s->event_id;
							  $res = $this->db->query($q);
							  $row = $res->result_array();
							  echo $row[0]['name'];
						?>
                      </td>
                        <td><?= date('m/d/Y H:i:s', $s->created); ?> </td>
                        <td><?= $s->cardholder_first_name; ?></td>
                        <td><?= $s->cardholder_email; ?> </td>
                        <td><?php  $table=""; if($s->table){  $table=(explode('&',$s->table)); echo rtrim($table[0],','); } ?> </td>
                        <td><?php  $ticket=""; if($s->ticket_table){  $ticket=(explode('&',$s->ticket_table)); echo rtrim($ticket[0],',');  } ?></td>
                     	<?php /*?><td><?php  $addtional=""; if($s->addtional){ $addtional=(explode('&',$s->addtional)); echo rtrim($addtional[2],','); }  ?></td><?php */?>
                     	<td><?php  $tickets=""; if($s->tickets){ $ticket=(explode('&',$s->tickets)); echo rtrim($ticket[3],','); }  ?></td>
                        <td><?php 	  $co=0; $co1=0; $co3=0;$co4=0;
									  if($s->table){ $co=count(explode(',',$table[0]))-1; }
									  if($s->ticket_table){ $co1 = trim($ticket[1],','); } 
									 // if($s->addtional){ $co3=count(explode(',',$addtional[2]))-1; } 
									  if($s->tickets){ $co4=count(explode(',',$ticket[2]))-1; } 
									  echo $co+$co1+$co3+$co4;
							?>
                         </td>
                        <td> <?= $s->subtotal; ?></td>
                        <td>
                            <?php if ($s->verified == 0) { ?>
                                <a href="<?php echo admin_url('orders/make_verify/' . $s->id) ?>">  <i class="fa fa-times" aria-hidden="true"> Pending </i></a>
                            <?php } else { ?>
                                <a href="<?php echo admin_url('orders/make_unverify/' . $s->id) ?>">  <i class="fa fa-check" aria-hidden="true"></i> On process </i></a>
                            <?php } ?>
                        </td>
                        <td class="text-center"> 
                            <div class="btn-group"> 
                                <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></button>
                                <ul class="dropdown-menu icons-right dropdown-menu-right">
                                    <li><a href=" <?php echo admin_url('orders/view_order_detail/' . $s->id) ?>" ><i class="icon-eye"></i> View Detail</a></li>
                                    <li><a href="javascript:void(0);" onclick="javascript: ConfirmDelete(<?php echo $s->id; ?>,<?php echo $s->event_id; ?>);" > <i class="icon-eye"></i>Delete</a></li>
                                </ul> 
                            </div> 
                        </td> 
                    </tr> 
                <?php } ?>
            </tbody> 
        </table> 
    </div> 
</div>
<script type="text/javascript">
$(document).ready(function() {
	//SORTING ORDERS : NEWEST FIRST
    $('#orderTable').DataTable( {
		destroy: true,
		"order": [[ 0, "desc" ]]
	});
	
	//Check whether a Field selected in Export Model or not
	$("#submitExport").click(function(){
		if ($("#ExportsFields input:checkbox:checked").length > 0){
			$("#ExportsFields").submit();
		}
		else{
		   alert("Please Select atleast one Field!");
		   return false;
		}
	});
});
//Confirm Password to Delete record
function ConfirmDelete(oID, eID){
    var return_value=prompt("Are you Sure to delete. Enter Password:");
	if(return_value===""){
		alert("Invalid Password!");
		return false;
	}
    else if(return_value==="your_password"){ //alert(oID+"-"+eID);
		<?php //echo admin_url('orders/?delete='.$s->id.'&event_id='.$s->event_id) ?>
		window.location="?delete="+oID+"&event_id="+eID;
        return true;
	}
    else{
        return false;
	}
}
</script>