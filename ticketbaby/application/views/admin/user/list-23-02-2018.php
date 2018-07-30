
<a href="<?php echo admin_url('user_management/add_new'); ?>" class="btn btn-success add_new" type="button"><i class="icon-plus"></i>Add New</a>                
                    <!-- Media datatable --> 
                    <div class="panel panel-default"> 
                        <div class="panel-heading">
                            <h6 class="panel-title"><i class="icon-users"></i>Users</h6>
                        </div> 

                        <div class="datatable"> 
                            <table class="table table-bordered table-striped"> 
                                <thead> 
                                    <tr> 
                                        <th>Name</th>  
                                        <th>Username</th>
										<th>Password</th>
                                        <th>Email</th>
                                        <th>Last Login</th>
                                        <th class="actions-column">Action</th> 
                                    </tr> 
                                </thead> 
                                <tbody> 
                                <?php foreach ($users as $row) { ?>    

                                    <tr>  
                                        <td>
                                            <?php echo $row->name; ?>
                                        </td> 
                                        <td>
                                        	<?php echo $row->username; ?>
                                        </td>
										<td>
                                        	<?php echo $row->password; ?>
                                        </td>
                                        <td> <?php echo $row->email; ?></td>
                                        <td><?php echo $row->last_login;?></td>
                                        <td class="text-center"> 
                                            <div class="btn-group"> 
                                                <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></button>
                                                <ul class="dropdown-menu icons-right dropdown-menu-right">
                                                    
                                                    <li><a href="#modal" data-toggle="modal" role="button"><i class="icon-eye"></i> View Detail</a></li>
                                                    <li><a href="<?=admin_url('user_management/edit/'.$row->id);?>"><i class="icon-pencil2"></i> Edit </a></li>
                                                    <li><a href="<?=admin_url('user_management/delete/'.$row->id);?>" onclick="return confirm('are your sure want to delete?')"><i class="icon-remove4"></i> Remove </a></li>
                                                </ul> 
                                            </div> 
                                        </td> 
                                    </tr> 
                                <?php } ?>    
                                    
                                </tbody> 
                            </table> 
                        </div> 
                    </div> 




