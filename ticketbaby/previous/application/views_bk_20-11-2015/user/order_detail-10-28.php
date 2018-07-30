<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Orders</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <b>Order List</b>
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
                                    <th>Pay ID</th>
                                    <th>Event</th>
                                    <th>Date</th>
                                    <th>First Name</th>
                                    <th>Email</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								//print_r($details);
								for($i=0;$i<count($details);$i++){
								?>
                                <tr class="odd gradeX even gradeC">
                                    <td><?=$page_start + ($i+1);?></td>
                                    <td><a target="_blank" href="<?=base_url()?>index.php/user/order_edit?order_id=<?=$details[$i]["id"]?>&page_start=<?=$page_start?>"><?=$details[$i]["pay_id"]?></a></td>
                                    <td><a target="_blank" href="<?=base_url()?>index.php/user/event_edit?id=<?=$details[$i]["event_id"]?>"><?=$details[$i]["event_title"]?></a></td>
                                    <td><?=$details[$i]["date"]?></td>
                                    <td><?=$details[$i]["first_name"]?></td>
                                    <td><?=$details[$i]["email"]?></td>
                                    <td><?=$details[$i]["total_amount"]?></td>
 
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