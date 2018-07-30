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
				</form>	
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


        </div>
        <!-- /.row -->    

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->