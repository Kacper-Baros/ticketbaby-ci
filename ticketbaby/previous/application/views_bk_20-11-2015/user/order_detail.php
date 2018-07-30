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
<?php	
								//print_r($details);
								if (count($details) > 1){?>
                            <div class="row">
                            <div class="col-xs-3">&nbsp;</div>
                            <div class="col-xs-9 text-right"><?php echo $pagination_link; ?></div>
                            </div>
                            
                            <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover table-responsive" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <!--th>Pay ID</th-->
                                    <th>Event</th>
                                    <th>Date</th>
                                    <th>First Name</th>
                                    <th>Email</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$a= count($details);
								$a=$a-1;
								for($i=0;$i<$a;$i++){
								?>
                                <tr class="odd gradeX even gradeC">
                                    <td><?=$page_start + ($i+1);?></td>
                                    <td><a target="_blank" href="<?=base_url()?>index.php/user/order_edit?order_id=<?=$details[$i]["id"]?>&page_start=<?=$page_start?>"><?=$orders[$i]["id"]?></a></td>
                                    <!--td><a target="_blank" href="<?=base_url()?>index.php/user/order_edit?order_id=<?=$details[$i]["id"]?>&page_start=<?=$page_start?>"><?=$details[$i]["pay_id"]?></a></td-->
                                    <td><?=$details[$i]["event_title"]?></a></td>
                                    <td><?=$details[$i]["date"]?></td>
                                    <td><?=$details[$i]["first_name"]?></td>
                                    <td><?=$details[$i]["email"]?></td>
                                    <td><?=$details[$i]["total_amount"]?></td>
 
                                </tr>
                                <?php } }
								else
								{
								echo "NO order placed";
								}
								?>
                            </tbody>
                            </table>
<div class="col-lg-12">
								<div style="float:right;">
								<a href="<?=base_url()?>index.php/cart/home/<?php echo isset($page_start) ? $page_start : "";?>"><button type="button" class="btn">Back</button></a>
								<input  type="hidden" name="order_id" value="<?php echo isset($order_id) ? $order_id : "";?>" />
								</div>    
							</div>
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