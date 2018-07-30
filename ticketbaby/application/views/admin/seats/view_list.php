<div class="row">
    <div class="col-md-5">
        <div class="panel panel-default"> 
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-users"></i><?php
                    if (isset($seats)) {
                        echo "View Ticket Class";
						$buttonName = 'Update';
						 $tkt = $this->db->get_where('tbl_ticket_class', array('id' => $seats->ticket_class_id))->row();
                    } else {
                        echo 'Add Ticket Class';
						$buttonName = 'Add';
                    }
                    ?></h6>
            </div> 
            <?php
            if (isset($seats)) {
                $url = admin_url('awards/update_seats');
            } else {
                $url = admin_url('awards/add_seats');
            }
            ?>
            
            <form class="form_edit" method="post" action="<?php echo $url; ?>">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Ticket Class</label> 
                            <select name="ticket_class" class="select-search my_select_opt select2-offscreen parent" tabindex="-1">
                                <option value="0">Select Ticket class Event</option>
                              
                                <?php foreach ($ticket_class as $tc) { ?>
                                    <option value="<?php echo $tc['id']; ?>" <?php if(isset($seats)){ if($tc['id'] == $tkt->parent_id){ echo "selected == selected";}} ?> ><?php echo $tc['class']; ?></option>
                                <?php } ?>
                            </select>
                            <span class="form_error_show"><?php echo form_error('ticket_class_id'); ?></span>
                        </div>   
                    </div>
                </div>

					<div class="form-group subcategory" >
                      <div class="row">
                        <div class="col-md-12">
                            <label>Ticket Sub Class</label> 
                            <select name="ticket_class_id" class="form-control chile" tabindex="-1">
                                <option value="0">Select sub class</option>
                                 <?php if (isset($seats))
								  {
									$result = $this->db->get_where('tbl_ticket_class', array('parent_id'=> $tkt->parent_id))->result(); 
									foreach($result as $tc) 
									{ ?>
						           		<option value="<?php echo $tc->id; ?>"  <?php if($tc->id==$tkt->id){echo "selected";}?> ><?php  echo $tc->class; ?></option>
       							<?php } 
								 }
								 ?>
                            </select>
                      </div>   
                     </div>  
                    </div>

				 <div class="tbl" <?php if (isset($seats)) { if($tkt->parent_id=="12"){ echo "style='display:block'";}else { echo "style='display:none'";} }?>>	
				 <?php if (isset($seats)) {
							if($tkt->parent_id=="12"){
								echo '<script type="text/javascript">
										$(document).ready(function() {
											$("#table_start-13").prop("disabled", "disabled");
											$("#table_end-13").prop("disabled", "disabled");
											$("#seat_charge-13").prop("disabled", "disabled");
											$("#table_charge-13").prop("disabled", "disabled");
				
											$("#price-27").prop("disabled", "disabled");
											$("#addtinal_end-27").prop("disabled", "disabled");
				
											$("#Tickts_price-30").prop("disabled", "disabled");
											$("#number_of_tickts-30").prop("disabled", "disabled");
										});
										</script>';
							}
						}
				 ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Table start</label> 
                            <input type="text" required id="table_start-12" name="table_start" class="form-control" placeholder="Enter Number" value="<?php if(isset($seats)){ echo $seats->table_start;} ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Table End</label> 
                            <input type="text" required id="table_end-12" name="table_end" class="form-control" placeholder="Enter Number" value="<?php if(isset($seats)){ echo $seats->table_end;} ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Seat Charge</label> 
                            <input type="text" required id="seat_charge-12" name="seat_charge" class="form-control" placeholder="Enter Amount" value="<?php if(isset($seats)){ echo $seats->seat_charge;} ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Table Charge</label> 
                            <input type="text" required id="table_charge-12" name="table_charge" class="form-control" placeholder="Enter Amount" value="<?php if(isset($seats)){ echo $seats->table_charge;} ?>">
                        </div>
                    </div>
                </div>
		    </div>	
				 			
          		 <div class="ticket" <?php if (isset($seats)) { if($tkt->parent_id=="13"){ echo "style='display:block'";}else { echo "style='display:none'";} }else {?>style="display:none;"<?php } ?>>	
				 <?php if (isset($seats)) {
							if($tkt->parent_id=="13"){
								echo '<script type="text/javascript">
										$(document).ready(function() {
											$("#table_start-12").prop("disabled", "disabled");
											$("#table_end-12").prop("disabled", "disabled");
											$("#seat_charge-12").prop("disabled", "disabled");
											$("#table_charge-12").prop("disabled", "disabled");
				
											$("#price-27").prop("disabled", "disabled");
											$("#addtinal_end-27").prop("disabled", "disabled");
				
											$("#Tickts_price-30").prop("disabled", "disabled");
											$("#number_of_tickts-30").prop("disabled", "disabled");
										});
										</script>';
							}
						}
				 ?>
				 <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Table start</label> 
                            <input type="text" required id="table_start-13" name="table_start" class="form-control" placeholder="Enter Number" value="<?php if(isset($seats)){ echo $seats->table_start;} ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Table End</label> 
                            <input type="text" required id="table_end-13" name="table_end" class="form-control" placeholder="Enter Number" value="<?php if(isset($seats)){ echo $seats->table_end;} ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Seat Charge</label> 
                            <input type="text" required id="seat_charge-13" name="seat_charge" class="form-control" placeholder="Enter Amount" value="<?php if(isset($seats)){ echo $seats->seat_charge;} ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Table Charge</label> 
                            <input type="text" required id="table_charge-13" name="table_charge" class="form-control" placeholder="Enter Amount" value="<?php if(isset($seats)){ echo $seats->table_charge;} ?>">
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Number Of Ticket</label> 
                            <input type="text" name="ticket_no" class="form-control" placeholder="Number Of Ticket" value="<?php if(isset($seats)){ echo $seats->table_end;} ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Seat Charge</label> 
                            <input type="text" name="ticket_charge" class="form-control" placeholder="Enter Amount" value="<?php if(isset($seats)){ echo $seats->seat_charge;} ?>">
                        </div>
                    </div>
                </div> -->
            </div>	
            
             	 <div class="Addtinal" <?php if (isset($seats)) { if($tkt->parent_id=="27"){ echo "style='display:block'";}else { echo "style='display:none'";} }else { echo "style='display:none'"; }?>>	
				 <?php if (isset($seats)) {
							if($tkt->parent_id=="27"){
								echo '<script type="text/javascript">
										$(document).ready(function() {
											$("#table_start-13").prop("disabled", "disabled");
											$("#table_end-13").prop("disabled", "disabled");
											$("#seat_charge-13").prop("disabled", "disabled");
											$("#table_charge-13").prop("disabled", "disabled");
											
											$("#table_start-12").prop("disabled", "disabled");
											$("#table_end-12").prop("disabled", "disabled");
											$("#seat_charge-12").prop("disabled", "disabled");
											$("#table_charge-12").prop("disabled", "disabled");
											
											$("#Tickts_price-30").prop("disabled", "disabled");
											$("#number_of_tickts-30").prop("disabled", "disabled");
										});
										</script>';
							}
						}
				 ?>
               	   <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Price</label> 
                            <input type="text" required id="price-27" name="price" class="form-control" placeholder="Price" value="<?php if(isset($seats)){ echo $seats->seat_charge;} ?>" />
                        </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                          <label>Ticket</label> 
                          <input type="text" required id="addtinal_end-27" name="addtinal_end" class="form-control" placeholder="Number Of Ticket" value="<?php if(isset($seats)){ echo $seats->table_end;} ?>" />
                       </div>
                    </div>
                  </div>
                  
               </div>
                	
            	 <div class="Tickts" <?php if (isset($seats)) { if($tkt->parent_id=="30"){ echo "style='display:block'";}else { echo "style='display:none'";} }else { echo "style='display:none'"; }?>>	
				 <?php if (isset($seats)) {
							if($tkt->parent_id=="30"){
								echo '<script type="text/javascript">
										$(document).ready(function() {
											$("#table_start-13").prop("disabled", "disabled");
											$("#table_end-13").prop("disabled", "disabled");
											$("#seat_charge-13").prop("disabled", "disabled");
											$("#table_charge-13").prop("disabled", "disabled");
											
											$("#table_start-12").prop("disabled", "disabled");
											$("#table_end-12").prop("disabled", "disabled");
											$("#seat_charge-12").prop("disabled", "disabled");
											$("#table_charge-12").prop("disabled", "disabled");
											
											$("#price-27").prop("disabled", "disabled");
											$("#addtinal_end-27").prop("disabled", "disabled");
										});
										</script>';
							}
						}
				 ?>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Tickets Price</label> 
                            <input type="text" required id="Tickts_price-30" name="Tickts_price" class="form-control" placeholder="Tickts Price" value="<?php if(isset($seats)){ echo $seats->seat_charge;} ?>" />
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Number Of Tickets</label> 
                            <input type="text" required id="number_of_tickts-30" name="number_of_tickts" class="form-control" placeholder="Number Of Tickts" value="<?php if(isset($seats)){ echo $seats->table_end;} ?>" />
                        </div>
                    </div>
                  </div>
                 </div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
							<label>Coupon Code</label> <br>
							<select name="coupon_id" class="select-search my_select_opt select2-offscreen" tabindex="-1">
								<option value="0">Select Coupon</option>
								<?php foreach ($coupons as $c){ 
									if($c->id=="169")
									{
									} else {
									?>
									<option value="<?php echo $c->id; ?>" <?php
									if (isset($seats)) {
										if ($c->id == $seats->coupon_id) {
											echo "selected == selected";
										}
									}
									?> ><?php echo $c->coupen_code; ?></option>
								  <?php } }?>
							</select>
						</div>
					</div>
			   </div>
			   <div class="form-group">
					<div class="row">
						<div class="col-md-12">
							<label>E-Ticket: Active</label> <br>
							<input type="radio" name="e_ticket_status" value="1" <?php
							if (isset($seats)) {
								if ($seats->e_ticket_status == 1) {
									echo "checked==checked";
								}
							}
							?> > True <br>
							<input type="radio" name="e_ticket_status" value="0" <?php
							if (isset($seats)) {
								if ($seats->e_ticket_status == 0) {
									echo "checked==checked";
								}
							}
							?>> False
						</div>
					</div>
			   </div>
			   
            </form>
        </div>
    </div>

    <div class="col-md-7">
        <!-- Media datatable --> 
        <div class="panel panel-default"> 
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-users"></i>Events Seat List</h6>
            </div> 

            <a href="<?php echo admin_url('awards/seats/'.$id) ?>" class="btn btn-success add_new_btn" type="button"><i class="icon-plus"></i>Add New</a>
            <div class="datatable"> 
                <table class="table table-bordered table-striped" id="EventSeatList"> 
                    <thead> 
                        <tr> 
                            <th>Table Start</th>  
                            <th>Table End</th>
                            <th>Seat Charge</th>
                            <th>Table Charge</th>
                            <th>Section</th>
                            <th>Class</th>
							<th>Coupon</th>
                            <th class="actions-column">Action</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        
                        <?php
                        foreach ($seats_list as $s) {

                            $t = $this->db->get_where('tbl_ticket_class', array('id' => $s->ticket_class_id))->row();
                            $z = $this->db->get_where('tbl_ticket_class', array('id' => $t->parent_id))->row();
							
							if($s->coupon_id!=0){
								$coupName = $this->db->get_where('tbl_coupen', array('id' => $s->coupon_id))->row();
								$DisCoup = $coupName->coupen_code;
							}
							else{
								$DisCoup = 'Not Applied';
							}
                         ?>
                            <tr>  
                                <td><?php echo $s->table_start; ?></td> 
                                <td><?php echo $s->table_end; ?></td>
                                <td><?php echo $s->seat_charge; ?></td>
                                <td><?php echo $s->table_charge; ?></td>
                                <td> <?php if(empty($z)){ echo $t->class;}else{ echo $z->class; }?></td>
                                <td><?php echo $t->class; ?></td>
								<td><?php echo $DisCoup; ?></td>
                                <td class="text-center"> 
                                    <div class="btn-group"> 
                                        <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></button>
                                        <ul class="dropdown-menu icons-right dropdown-menu-right">
                                            <li><a href="<?php echo admin_url('awards/view_seats/' . $s->id .'/'.$id)?>" data-toggle="modal" role="button"><i class="icon-eye"></i> View Detail</a></li>
                                            <li><a href="<?php echo admin_url('awards/edit_seats/' . $s->id .'/'.$id)?>"><i class="icon-pencil2"></i> Edit </a></li>
                                            <li><a href="<?php echo admin_url('awards/delete_seats/'.$s->id .'/'.$id) ?>" onclick="return confirm('Are your sure, want to delete?')"><i class="icon-remove4"></i> Remove </a></li>
                                        </ul> 
                                    </div> 
                                </td> 
                            </tr> 
                        <?php } ?>
                    </tbody> 
                </table> 
            </div> 
        </div> 

    </div>

</div>

<script>
$(document).ready(function() {
	//SORTING ORDERS
    $('#EventSeatList').DataTable( {
		destroy: true,
		"order": [[ 4, "desc" ]]
	});
} );
	$(".parent").change(function(){
		var id=$(this).val();
		if(id=='13')
		{
			$(".ticket").show();
			$(".tbl").hide();
			$(".Addtinal").hide();
			$(".Tickts").hide();
			
			$("#table_start-12").prop("disabled", "disabled");
			$("#table_end-12").prop("disabled", "disabled");
			$("#seat_charge-12").prop("disabled", "disabled");
			$("#table_charge-12").prop("disabled", "disabled");
			
			$("#price-27").prop("disabled", "disabled");
			$("#addtinal_end-27").prop("disabled", "disabled");
			
			$("#Tickts_price-30").prop("disabled", "disabled");
			$("#number_of_tickts-30").prop("disabled", "disabled");
		}
		if(id=='12')
		{
			$(".ticket").hide();
			$(".tbl").show();
			$(".Addtinal").hide();
			$(".Tickts").hide();
			
			$("#table_start-13").prop("disabled", "disabled");
			$("#table_end-13").prop("disabled", "disabled");
			$("#seat_charge-13").prop("disabled", "disabled");
			$("#table_charge-13").prop("disabled", "disabled");
			
			$("#price-27").prop("disabled", "disabled");
			$("#addtinal_end-27").prop("disabled", "disabled");
			
			$("#Tickts_price-30").prop("disabled", "disabled");
			$("#number_of_tickts-30").prop("disabled", "disabled");
		}
		
		if(id=='27')
		{
			$(".ticket").hide();
			$(".tbl").hide();
			$(".Addtinal").show();
			$(".Tickts").hide();
			
			$("#table_start-13").prop("disabled", "disabled");
			$("#table_end-13").prop("disabled", "disabled");
			$("#seat_charge-13").prop("disabled", "disabled");
			$("#table_charge-13").prop("disabled", "disabled");
			
			$("#table_start-12").prop("disabled", "disabled");
			$("#table_end-12").prop("disabled", "disabled");
			$("#seat_charge-12").prop("disabled", "disabled");
			$("#table_charge-12").prop("disabled", "disabled");
			
			$("#Tickts_price-30").prop("disabled", "disabled");
			$("#number_of_tickts-30").prop("disabled", "disabled");
		}
		
		if(id=='30')
		{
			$(".ticket").hide();
			$(".tbl").hide();
			$(".Addtinal").hide();
			$(".Tickts").show();
			
			$("#table_start-13").prop("disabled", "disabled");
			$("#table_end-13").prop("disabled", "disabled");
			$("#seat_charge-13").prop("disabled", "disabled");
			$("#table_charge-13").prop("disabled", "disabled");
			
			$("#table_start-12").prop("disabled", "disabled");
			$("#table_end-12").prop("disabled", "disabled");
			$("#seat_charge-12").prop("disabled", "disabled");
			$("#table_charge-12").prop("disabled", "disabled");
			
			$("#price-27").prop("disabled", "disabled");
			$("#addtinal_end-27").prop("disabled", "disabled");
		}
		
		
		form_data={'id':id};
		$.ajax({
			url: "<?php echo admin_url(); ?>/events/ticket",
			type: 'POST',
			data: form_data,
			success: function(data) 
			{
				
				$(".chile").html(data);
			}
		})
	});
</script>
<?php /*?><script language="javascript">
	$(".parent").change(function(){
		var id=$(this).val();
		if(id=='13')
		{
			$(".ticket").show();
			$(".tbl").hide();
			$(".Addtinal").hide();
		}
		if(id=='12')
		{
			$(".ticket").hide();
			$(".tbl").show();
			$(".Addtinal").hide();
		}
		
		if(id=='27')
		{
			$(".ticket").hide();
			$(".tbl").hide();
			$(".Addtinal").show();

		}
		form_data={'id':id};
		$.ajax({
			url: "<?php echo admin_url(); ?>/events/ticket",
			type: 'POST',
			data: form_data,
			success: function(data) 
			{
				
				$(".chile").html(data);
			}
		})
	});
</script><?php */?>


