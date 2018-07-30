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
		<a href="<?php echo admin_url("orders/export_order_new/"); ?>">export</a>
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
                    <th>Post</th>					
                    <th class="actions-column"><img src="http://ticketbaby.co.uk/assets/images/view.png"></th> 
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
                                <a href="<?php echo admin_url('orders/make_unverify/' . $s->id) ?>">  <i class="fa fa-check" aria-hidden="true"></i> Posted </i></a>
                            <?php } ?>
                        </td>						
                        <td class="text-center"> 
                            <div class="btn-group"> 
                                <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></button>
                                <ul class="dropdown-menu icons-right dropdown-menu-right">
                                    <li><a href=" <?php echo admin_url('orders/view_order_detail/' . $s->id) ?>" ><i class="icon-eye"></i> View Detail</a></li>
                                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#DeletOrderModel_<?php echo $s->id; ?>" > <i class="icon-eye"></i>Delete</a></li>
                                </ul> 
                            </div> 
                        </td> 
                    </tr>
					<div class="modal fade" id="DeletOrderModel_<?php echo $s->id; ?>" role="dialog">
					  <div class="modal-dialog"> 
						<!-- Modal content to Delete -->
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><img src="http://ticketbaby.co.uk/assets/images/logo_popup.png"><span style="font-size:30px;padding-left:110px;">Baby Alert!</span></h4>
						  </div>
						  <div class="modal-body">
							<form action="" method="get" id="DeleteForm_<?php echo $s->id; ?>">
							<div class="row">
									  <div class="col-md-12 col-sm-12 col-xs-12">
										<div class="form-group">
										<h1 style="text-align:center;"><img src="http://ticketbaby.co.uk/assets/images/lock.jpg">&nbsp;&nbsp;&nbsp;&nbsp;PASSWORD REQUIRED</h1>
								        </div>
								      </div>
						    </div>
							<div class="row">
							  <div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<br>
									<input type="hidden" name="event_id" value="<?php echo $s->event_id; ?>">
									<input type="hidden" name="delete" value="<?php echo $s->id; ?>">
									<input class="form-control" placeholder="password" type="password" name="user_password_<?php echo $s->id; ?>" id="user_password_<?php echo $s->id; ?>">
								</div>
							  </div>
							</div>
						  </div>
						  <div class="modal-footer">
							<button type="button" onclick="javascript: SubmitPassword(<?php echo $s->id; ?>);" class="btn btn-primary">Proceed</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  </div>
						  </form>
						</div>
					  </div>
					</div>
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
});

//Confirm Password to Delete record
function SubmitPassword(id) {
	var formID = $("#DeleteForm_" + id).serialize();
	var Passwrd = $("#user_password_" + id).val();
	if(Passwrd!=""){
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: '<?php echo admin_url("orders/ConfirmPassword/") ?>' + '/' + id,
			data: formID,
			success: function(response) {
				if(response=='Confirmed'){
					$('#DeletOrderModel_'+ id).modal('hide');
					$("#DeleteForm_"+id).submit();
				}
				else{
					alert("Invalid Password!");
					return false;
				}
			}
		});
	}
	else{
		alert("Please Enter Password!");
		return false;
	}
}
</script>