<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ticket Class</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->


        <div class="row">

            <div class="col-lg-5">
            <div class="panel">
            <div class="panel-body">
            <form role="form" method="post" class="form-ticket-class-creation" action="">
                    <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" name="title" placeholder="Enter text">
                    <p class="help-block help-block-tip">The name is how it appears on your site.</p>
                    </div>

                    <div class="form-group">
                    <label>Slug</label>
                    <input class="form-control" name="class" placeholder="Enter text">
                    <p class="help-block help-block-tip">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens</p>
                    </div>

                    <div class="form-group">
                    <label>Section</label>


                    <select name="section_id" class="form-control">
                        <?php
                        foreach($ticket_section_details as $k=>$row) {
                            echo "<option value=".$row["id"].">".$row["title"]."</option>";
                        }
                        ?>    
                    </select>
                    </div>

                    <div class="form-group">
                    <label>Tooltip</label>
                    <textarea class="form-control" name="tool_tip" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                    <label>Order</label>
                    <input class="form-control" name="order" placeholder="Enter number">
                    <p class="help-block help-block-tip">Order</p>
                    </div>
                  

                    <div class="form-group">
                    <label>Type</label>
                        <div class="radio">
                            <label><input type="radio" name="ticket_selection_type" value="1" checked>Select field</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="2" name="ticket_selection_type">Input field</label>
                        </div>
                    </div>


                                      
                    <button type="submit" class="btn pull-right">Submit Button</button>
                    
            </form>
            </div>
            </div>
            </div>
            <!-- /.col-lg-5 -->


            <div class="col-lg-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <b>Ticket class list</b>
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
                                    <th>Section</th>
                                    <th>Slug</th>
                                    <th>Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0;$i<sizeof($ticket_class_details);$i++){ ?>
                                <tr class="odd gradeX even gradeC">
                                    <td><?=$page_start + ($i+1);?></td>
                                    <td><a href="<?=base_url()?>index.php/admin/ticket/edit?id=<?=$ticket_class_details[$i]["id"]?>&page_start=<?=$page_start?>"><?=$ticket_class_details[$i]["title"]?></a></td>
                                    <td><?=$ticket_class_details[$i]["section_title"]?></td>
                                    <td><?=$ticket_class_details[$i]["class"]?></td>
                                    <td><?=$ticket_class_details[$i]["order"]?></td>
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