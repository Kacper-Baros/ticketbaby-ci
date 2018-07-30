<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Events</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <b>Event List</b>
                    </div>
			<form action="<?php echo base_url();?>index.php/admin/Event" method='get'>	
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label>Event Name</label>
							<input type='text' name='event_name' value="<?php echo $event_name;?>" class="form-control">
                            <p class="help-block help-block-tip"></p>
                            </div>
						</div>
						<div class="col-lg-12">
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
                                    <th>Edit</th>
                                    <th>Main <br/> carousel</th>
                                    <th>Recommended <br/> carousel</th>
                                    <th>Hot ticket</th>
                                    <th>Just announced</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Slug</th>
                                    <th>Active</th>
                                    <th>Set Seats</th>
                                    <th>Preview</th>
                                    <th>Booking</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0;$i<sizeof($events);$i++){ 
                                    $active_icon = ($events[$i]["active"] == 'Y') ? 'glyphicon-ok-circle' : 'glyphicon-remove-circle';

                                    $show_main_carousel = ($events[$i]["show_main_carousel"] == 'Y') ? 'fa-check' : 'fa-times';
                                    $show_recommended_carousel = ($events[$i]["show_recommended_carousel"] == 'Y') ? 'fa-check' : 'fa-times';
                                    $show_hot_ticket = ($events[$i]["show_hot_ticket"] == 'Y') ? 'fa-check' : 'fa-times';
                                    $show_just_announced = ($events[$i]["show_just_announced"] == 'Y') ? 'fa-check' : 'fa-times';
                                ?>
                                <tr class="odd gradeX even gradeC">
                                    <td><?=$page_start + ($i+1);?></td>
                                    <td class="text-center"><a href="<?=base_url()?>index.php/admin/event/edit?id=<?=$events[$i]["id"]?>&page_start=<?=$page_start?>"> <span class="glyphicon glyphicon-edit"></span> </a></td>    
                                    <td class="text-center btn-md"><span class="fa <?=$show_main_carousel;?> fa-1x"></span></td>
                                    <td class="text-center btn-md"><span class="fa <?=$show_recommended_carousel;?> fa-1x"></span></td>
                                    <td class="text-center btn-md"><span class="fa <?=$show_hot_ticket;?> fa-1x"></span></td>
                                    <td class="text-center btn-md"><span class="fa <?=$show_just_announced;?> fa-1x"></span></td>
                                    <td><a href="<?=base_url()?>index.php/admin/event/edit?id=<?=$events[$i]["id"]?>&page_start=<?=$page_start?>"><?=$events[$i]["title"]?></a></td>
                                    <td><?=$events[$i]["category_name"]?></td>
                                    <td><?=$events[$i]["slug"]?></td>
                                    <td class="text-center"><i class="glyphicon <?=$active_icon;?> "></i></td>
                                    <td class="text-center"><a href="<?=base_url()?>index.php/admin/ticket/event?event_id=<?=$events[$i]["id"]?>&event_page_start=<?=$page_start?>"><span class="glyphicon glyphicon-cog"></span></a></td>
                                    <td class="text-center"><a target="_blank" href="<?=base_url()?>index.php/event/<?=$events[$i]["slug"]?>"> <span class="glyphicon glyphicon-eye-open"></span> </a></td>
                                    <td class="text-center"><a target="_blank" href="<?=base_url()?>index.php/admin/event/booking/<?=$events[$i]["id"]?>"> <span class="glyphicon glyphicon-list-alt"></span> </a></td>
									
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