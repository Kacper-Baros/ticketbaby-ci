<a href="<?php echo admin_url('awards/add'); ?>" class="btn btn-success add_new" type="button"><i class="icon-plus"></i>Add New</a>                
<!-- Media datatable --> 

<div class="panel panel-default"> 
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-users"></i>Events</h6>
    </div> 
	<?php 
	     if(isset($_GET['id']))
		 {	
			$this->db->where('id',$_GET['id']);
        	$this->db->delete('tbl_events');
			
			$this->db->where('event_id',$_GET['id']);
        	$this->db->delete('additional_event_detail');
			
			
			
			redirect(base_url() . 'admin/awards');
		 }
	?>
    <div class="datatable"> 
        <table class="table table-bordered table-striped"> 
            <thead> 
                <tr> 
                    <th>#</th>
                    <th>Edit</th>
                    <th>Event Name</th>  
                    <th>slug</th>
                    <th>Category</th>
                    <th>Active</th>
                    <th>Seats Setting</th>
                    <th>Preview</th>
                    <th>Booking</th>
                    <th class="actions-column">Remove</th> 
                </tr> 
            </thead> 
            <tbody> 


                <?php
                $i = 1;
                foreach ($events as $e) {
                    $cat_name = $this->db->get_where('tbl_post', array('id' => $e->category_id))->row();
                    ?>
                    <tr>  

                        <td><?php echo $i; ?></td>
                        <td><a href="<?php echo admin_url('awards/edit/' . $e->id) ?>"><i class="icon-pencil2"></i> Edit </a></td>

                        <td>
                            <?php echo $e->name; ?>
                        </td> 
                        <td><?php echo $e->slug; ?></td>
                        <td><?php echo $cat_name->title; ?></td>

                        <td><?php if ($e->status == 1) { ?>
                                <i class="fa fa-check" aria-hidden="true"></i>
                            <?php } else { ?>
                                <i class="fa fa-times" aria-hidden="true"></i>
                            <?php } ?></td>
                        <td><a href="<?php echo admin_url('awards/seats/' . $e->id); ?>"> <i class="fa fa-cog" aria-hidden="true"></i>Seats Setting</a></td>
                        <td><a href="<?php echo base_url($e->slug);//base_url('awards/award_detail/' . $e->id) ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"> Preview</i></a></td>

                        <td class="text-center"> 
                            <a href="<?php echo admin_url('orders/booking/'.$e->id) ?>" ><i class="fa fa-tasks" aria-hidden="true"></i> Bookings</a>
                        </td> 

                        <td class="text-center"> 
                            <a href="<?php echo admin_url('awards?id='.$e->id) ?> " onclick="return confirm('are your sure want to delete?')"><i class="icon-remove4"></i> Remove </a>
                        </td> 

                    </tr> 
                    <?php $i++;
                } ?>
            </tbody> 
        </table> 
    </div> 
</div> 




