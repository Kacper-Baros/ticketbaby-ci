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
                                <?php for($i=0;$i<sizeof($orders);$i++){ ?>
                                <tr class="odd gradeX even gradeC">
                                    <td><?=$page_start + ($i+1);?></td>
                                    <td><a href="<?=base_url()?>index.php/admin/order/edit?order_id=<?=$orders[$i]["id"]?>&page_start=<?=$page_start?>"><?=$orders[$i]["pay_id"]?></a></td>
                                    <td><a href="<?=base_url()?>index.php/admin/event/edit?id=<?=$orders[$i]["event_id"]?>"><?=$orders[$i]["event_title"]?></a></td>
                                    <td><?=$orders[$i]["date"]?></td>
                                    <td><?=$orders[$i]["first_name"]?></td>
                                    <td><?=$orders[$i]["email"]?></td>
                                    <td><?=$orders[$i]["total_amount"]?></td>
 
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