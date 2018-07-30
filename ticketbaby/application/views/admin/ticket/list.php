<div class="row">
     
    <div class="col-md-5">
         <div class="panel panel-default"> 
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-users"></i><?php if(isset($ticket)){ echo "Edit Ticket Class";} else{ echo 'Add Ticket Class';} ?></h6>
            </div> 
             
            
             <?php
             if(isset($ticket)){
             $url = admin_url('ticket/update');
             }else{
                 $url = admin_url('ticket/add');
             }
             ?>
             <form class="form_edit" method="post" action="<?php echo $url; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label>Class</label> 
                        <input type="text" name="class" class="form-control" value="<?php if(isset($ticket)){ echo $ticket->class;} ?>">
                        <span class="form_error_show"> <?php echo form_error('class'); ?></span>
                    </div>
                </div>
             </div>
                
             <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label>Parent</label> 
                        <select name="parent_id" class="select-search my_select_opt select2-offscreen" tabindex="-1">
                            <option value="0">Select Parent Category</option>
                            <?php foreach($tickets as $t) { ?>
                            <option value="<?php echo $t->id; ?>" <?php if(isset($ticket)){ if($t->id ==  $ticket->parent_id ){ echo 'selected == selected';}} ?> ><?php echo $t->class; ?></option>
                            <?php } ?>
                            
                        </select>
                    </div>                                         
                </div>
            </div>
            
             <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label>Description</label> 
                        <textarea class="form-control" name="info"><?php if(isset($ticket)){ echo $ticket->info;} ?></textarea>
                    </div>                                         
                </div>
            </div>
            
             <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <input type="file" name='image'>
                    </div>                                         
                </div>
            </div>
            
            
               <div class="form-actions text-left "> 
                      <?php if(isset($ticket)) { ?>
                   <input type="hidden" value="<?php echo $ticket->id; ?>" name="id">
                        <?php } ?> 
                        <input type="submit" value="<?php if(isset($ticket)){ echo 'Update';}else{ echo 'Add';} ?>" class="btn btn-primary"> 
                       <a href="<?php echo admin_url(); ?>" class="btn btn-danger">Cancel</a> 
                       
                    </div>
            
        </form>
    </div>
          </div>

    <div class="col-md-7">
        <!-- Media datatable --> 
        <div class="panel panel-default"> 
            <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-users"></i>Events</h6>
            </div> 

            <div class="datatable"> 
                <table class="table table-bordered table-striped"> 
                    <thead> 
                        <tr> 
                            <th>ID</th>  
                            <th>Class</th>
                            <th>Parent</th>
                            <th class="actions-column">Action</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        <?php foreach ($ticket_list as $e) { 
                            
                            $s = $this->db->get_where('tbl_ticket_class',array('id'=>$e->parent_id))->row();
                           
                            ?>
                            <tr>  
                                <td>
                                    <?php echo $e->id; ?>
                                </td> 
                                <td>
                                    <?php echo $e->class; ?>
                                </td>
                                
                                <td><?php if(!empty($s)){ echo $s->class; } ?></td>
                                
                                <td class="text-center"> 
                                    <div class="btn-group"> 
                                        <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></button>
                                        <ul class="dropdown-menu icons-right dropdown-menu-right">
                                            <li><a href="#modal" data-toggle="modal" role="button"><i class="icon-eye"></i> View Detail</a></li>
                                            <li><a href="<?php echo admin_url('ticket/edit/' . $e->id) ?>"><i class="icon-pencil2"></i> Edit </a></li>
											<?php if($e->id!='' && $e->parent_id!=0){ ?>
                                            <li><a href="<?php echo admin_url('ticket/delete/'.$e->id) ?>" onclick="return confirm('Are you sure, want to delete?')"><i class="icon-remove4"></i> Remove </a></li>
											<?php } ?>
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





