

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <b>User List</b>
                    </div>
				<form action="<?php echo base_url();?>index.php/admin/user" method='get' style='margin-top:10px;'>		
						<div class="col-lg-3">
                            <div class="form-group">
                            <label>Search</label>
							<input type='text' name='q' value="<?php echo $q;?>" placeholder='Search by email or name' class="form-control">
                            <p class="help-block help-block-tip"></p>
                            </div>
						</div>
						<div class="col-lg-9" style='margin-top:15px;'>
                            <div class="pull-right">
                            <button type="submit" class="btn" name='filter' value='filter'>Filter </button>
							</div>
                        </div>
                        
                        <div class="col-lg-9" style='margin-top:15px;'>
                            <div class="pull-right">
                            <a class="fancybox" href="#inline1" >
                           		<button type="button" class="btn" name='' value=''>
                            		Export User Details
                                </button>
                             </a>
							</div>
                        </div>
				</form>	
                
                
                			
                        <div class="col-lg-3">
                           <select id="user_per_page" name="per_page">
                           		<option value="10" <?php if($this->uri->segment(3)==10){ ?>selected="selected"<?php } ?> >10</option>
                           		<option value="15" <?php if($this->uri->segment(3)==15){ ?>selected="selected"<?php } ?>>15</option>
                           		<option value="25" <?php if($this->uri->segment(3)==25){ ?>selected="selected"<?php } ?>>25</option>
                           		<option value="50" <?php if($this->uri->segment(3)==50){ ?>selected="selected"<?php } ?>>50</option>
                           </select>
						</div>
                   
                        <!-- /.panel-heading -->
                        <div class="panel-body">             

                            <div class="row">
                            <div class="col-xs-3">&nbsp;</div>
                            <div class="col-xs-9 text-right"><?php echo $pagination_link; ?></div>
                            </div>
                            
                            <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0;$i<sizeof($users);$i++){ ?>
                                <tr class="odd gradeX even gradeC">
                                    <td><?=$page_start + ($i+1);?></td>
                                    <td><a href="<?=base_url()?>index.php/admin/user/edit?id=<?=$users[$i]["id"]?>&page_start=<?=$page_start?>"><?=$users[$i]["first_name"]?></a></td>
                                    <td><?=$users[$i]["email"]?></td>
                                    <?php 
                                        $active_icon = ($users[$i]["active"] == 'Y') ? 'fa-check' : 'fa-times';
                                    ?>
                                    <td class="center"><i class="fa <?=$active_icon;?> fa-1x"></i></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            </table>

                            </div>
                            <div class="row">
                            <div class="col-xs-3">&nbsp;</div>
                            <div class="col-xs-9 text-right"><?php echo $pagination_link; ?></div>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                </div>
            <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->


	

                <div id="inline1" style="width:400px;display: none;">
                    <h4>Choose Fields</h4>
                    <p>
                    	<form name="" action="<?=base_url()?>index.php/admin/user/export" method="post">
                            <ul class="inlnUl">
                                <li>
                                    <div><input type="checkbox" name="fields[]" value="username" /></div>
                                    <label class="clsk">Username</label>
                                </li>
                                <li>
                                    <div><input type="checkbox" name="fields[]" value="password" /></div>
                                    <label class="clsk">Password</label>
                                </li>
                                <li>
                                    <div><input type="checkbox" name="fields[]" value="first_name" /></div>
                                    <label class="clsk">First_name</label>
                                </li>
                                <li>
                                    <div><input type="checkbox" name="fields[]" value="last_name" /></div>
                                    <label class="clsk">Last_name</label>
                                </li>
                                <li>
                                    <div><input type="checkbox" name="fields[]" value="email" /></div>
                                    <label class="clsk">Email</label>
                                </li>
                                <li>
                                    <div><input type="checkbox" name="fields[]" value="address" /></div>
                                    <label class="clsk">Address</label>
                                </li>
                                <li>
                                    <div><input type="checkbox" name="fields[]" value="city" /></div>
                                    <label class="clsk">City</label>
                                </li>
                                <li>
                                    <div><input type="checkbox" name="fields[]" value="state" /></div>
                                    <label class="clsk">State</label>
                                </li>
                                <li>
                                    <div><input type="checkbox" name="fields[]" value="country" /></div>
                                    <label class="clsk">Country</label>
                                </li>
                                <li>
                                    <div><input type="checkbox" name="fields[]" value="zip" /></div>
                                    <label class="clsk">Zip</label>
                                </li>
                                <li>
                                    <div><input type="checkbox" name="fields[]" value="active" /></div>
                                    <label class="clsk">Is Active</label>
                                </li>
                                <li>
                                    <div><input type="checkbox" name="fields[]" value="blocked" /></div>
                                    <label class="clsk">Is Blocked</label>
                                </li>
                                <li>
                                    <div><input type="checkbox" name="fields[]" value="last_ip" /></div>
                                    <label class="clsk">Last Ip</label>
                                </li>
                            </ul>
                            <input type="submit" name="submit" id="submit" value="Export"  />
                        </form>
                    </p>
                </div>
	
        </div>
        <!-- /.row -->    

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


