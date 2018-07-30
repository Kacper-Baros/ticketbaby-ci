<a href="<?php echo admin_url('users/add'); ?>" class="btn btn-success add_new" type="button"><i class="icon-plus"></i>Add New</a>   
<?php
	if(isset($_GET['id'])){
		$q="DELETE FROM tbl_users WHERE id = ".$_GET['id'];
		$this->db->query($q);
		redirect(site_url('admin/users'));
	}
?>             
                    <!-- Media datatable --> 
                    <div class="panel panel-default"> 
                        <div class="panel-heading">
                            <h6 class="panel-title"><i class="icon-users"></i>Users</h6>
                        </div> 

                        <div class="datatable"> 
                            <table class="table table-bordered table-striped"> 
                                <thead> 
                                    <tr> 
                                        <th>User Name</th>  
										<th>Password</th>  
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th class="actions-column">Action</th> 
                                    </tr> 
                                </thead> 
                                <tbody> 
								<?php foreach($users as $e) { ?>
                                    <tr>  
                                        <td>
                                         <?php echo $e->username; ?>
                                        </td> 
										<td>
                                         <?php echo $e->password; ?>
                                        </td>
                                        <td>
                                        <?php echo $e->fullname; ?>
                                        </td>
                                        <td> <?php echo $e->email; ?></td>
                                        <td><?php echo $e->phone_no; ?></td>
                                        <td class="text-center"> 
                                            <div class="btn-group"> 
                                                <button class="btn btn-default btn-icon dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></button>
                                                <ul class="dropdown-menu icons-right dropdown-menu-right">
                                                    <li><a href="<?php echo admin_url('users/edit/'.$e->id) ?>"><i class="icon-pencil2"></i> Edit </a></li>
                                                    <li><a href="<?php echo admin_url('users?id='.$e->id) ?>" onclick="return confirm('Are your sure want to delete?')"><i class="icon-remove4"></i> Remove </a></li>
                                                </ul> 
                                            </div> 
                                        </td> 
                                    </tr> 
<?php } ?>
                                </tbody> 
                            </table> 
                        </div> 
                    </div> 
