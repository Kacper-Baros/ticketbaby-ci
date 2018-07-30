<!-- Media datatable --> 
<style>
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
  border: 1px solid #ddd !important;
}
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th{
padding:10px 5px !important;	
}
</style>
<div class="panel panel-default order-table"> 
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-users"></i>Customer Sales</h6>
    </div>
    <div class="datatable"> 
        <table class="table table-bordered table-striped" id="orderTable"> 
            <thead> 
                <tr> 
                    <th>Order ID</th>
					<th>Full Name</th>
                    <th>Event</th>
                    <th>Date</th>
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
						<td><?php echo $s->customer_first_name.' '.$s->customer_last_name; ?></td>
                        <td>
                        <?php
							 $q="SELECT `name` FROM `tbl_events` WHERE `id`=".$s->event_id;
							  $res = $this->db->query($q);
							  $row = $res->result_array();
							  echo $row[0]['name'];
						?>
						<?php  $table=""; if($s->table){  $table=(explode('&',$s->table)); } ?>
                      </td>
                        <td><?= date('m/d/Y H:i:s', $s->created); ?> </td>						
                        <?php  $ticket=""; if($s->ticket_table){  $ticket=(explode('&',$s->ticket_table)); } ?>
                     	<?php  $tickets=""; if($s->tickets){ $ticket=(explode('&',$s->tickets)); }  ?>
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
});
</script>