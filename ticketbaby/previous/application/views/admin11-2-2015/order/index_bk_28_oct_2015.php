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
					<br/>
			<form action="<?php echo base_url();?>index.php/admin/order" method='get'>		
					 <div class="form-group col-lg-3">
                    <label>Category</label>
                    <?php
                        $category_id = isset($category_id) ? $category_id : 0;
                    ?>
            
                    <select name="category_id" class="form-control">
					<option value="" selected="selected">Select Category</option>
				
                        <?php
						
					    foreach($category_name  as $k=>$row) 
						{
                            if ( $category_id == $cat_id[$k] ) {
                                echo "<option selected value=".$cat_id[$k].">".$row."</option>"; 
                            }else {    
                                echo "<option value=".$cat_id[$k].">".$row."</option>";    
                            }                  
                        }
						?>  
					</select>
                    </div>
						<div class="col-lg-3">
                            <div class="form-group">
                            <label>Date To</label>
							<input type='date' name='to' value="<?php echo $to;?>" class="form-control">
                            <p class="help-block help-block-tip"></p>
                            </div>
						</div>
						<div class="col-lg-3">
                            <div class="form-group">
                            <label>Date From</label>
							<input type='date' name='from' value="<?php echo $from;?>" class="form-control">
                            <p class="help-block help-block-tip"></p>
                            </div>
						</div>
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
								if($orders){
								for($i=0;$i<sizeof($orders);$i++){ ?>
                                <tr class="odd gradeX even gradeC">
                                    <td><?=$page_start + ($i+1);?></td>
                                    <td><a href="<?=base_url()?>index.php/admin/order/edit?order_id=<?=$orders[$i]["id"]?>&page_start=<?=$page_start?>"><?=$orders[$i]["pay_id"]?></a></td>
                                    <td><a href="<?=base_url()?>index.php/admin/event/edit?id=<?=$orders[$i]["event_id"]?>"><?=$orders[$i]["event_title"]?></a></td>
                                    <td><?=$orders[$i]["date"]?></td>
                                    <td><?=$orders[$i]["first_name"]?></td>
                                    <td><?=$orders[$i]["email"]?></td>
                                    <td><?=$orders[$i]["total_amount"]?></td>
 
                                </tr>
                                <?php }
								}else{
									echo "<tr> <td colspan='7'>No Order Found</td></tr>";
								}?>
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