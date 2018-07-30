<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User's Paid Events</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <b>Paid Event List</b>
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
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Category</th>
                                    <th>Organizer Name</th>
                                    <th>Organizer Contact Details</th>
                                    <th>Date</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0;$i<sizeof($events);$i++){ ?>
                                <tr class="odd gradeX even gradeC">
                                    <td><?=$page_start + ($i+1);?></td>
                                    <td class="text-center"><?=$events[$i]["title"];?></td>    
                                    <td class="text-center"><?=$events[$i]["slug"];?></td>    
                                    <td class="text-center">
									<?php
										$categoryNameArr = get_category_name($events[$i]["category"]);
										echo $categoryNameArr[0]->category_name;
									?>
                                    </td>    
                                    <td class="text-center"><?=$events[$i]["organizer_name"];?></td>    
                                    <td class="text-center">
                                     	<div>Contact Number :<?= $events[$i]["organizer_contact_number"];?></div>
                                     	<div> Email Id:<?= $events[$i]["organizer_email_id"];?></div>
                                    </td>    
                                    <td class="text-center"></td>  
                                    <td class="text-center">From <?=$events[$i]["start_date"];?> To <?=$events[$i]["end_date"];?></td>  
                                    <td class="text-center">
										<div>Country : <?php $countryArr = get_country_name($events[$i]["country"]); ?><?=$countryArr[0]->name;?></div>
                                        <div>State :  <?php $stateArr = get_state_name($events[$i]["state"]); ?><?=$stateArr[0]->name;?></div>
                                        <div>City :  <?php $cityArr = get_city_name($events[$i]["city"]); ?><?=$cityArr[0]->name;?></div>
                                        <div>Province : <?=$events[$i]["province"];?></div>
                                        <div>Address : <?=$events[$i]["address"];?></div>
                                        <div>Venue : <?=$events[$i]["venue"];?></div>
                                    </td>  
                                    <td class="text-center">
										<img width="60" src="<?= base_url()?>assets/upload/event/thumb/<?=$events[$i]["thumb1"];?>" />
                                    </td>  
                                    <td class="text-center">
                                    	<?php
											if($events[$i]["is_approved"]==0){
										?>
                                    	<a href="<?=base_url()?>index.php/admin/event/edit?id=<?=$events[$i]["id"]?>&page_start=0&comingfrom=<?php echo base64_encode('userpaidevent'); ?>&is_approved=<?php echo base64_encode($events[$i]["is_approved"]); ?>">
                                        	<button class="btn" type="button">Approve</button>
                                        </a>
                                        <?php }else{ ?>
                                        	<button class="btn approved" type="button">Approved</button>
                                        <?php } ?>
                                    </td>    
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