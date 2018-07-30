<?php
if ( $this->input->server('REQUEST_METHOD') == 'POST' || $id > 0 ) {
    $flash_client_request = $this->session->flashdata('flash_client_request');
}else{
    unset($flash_client_request);
}

?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Event Ticket Setting</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->


        <div class="row">

            <div class="col-lg-5">
            <div class="panel">
            <div class="panel-body">
            <form role="form" method="post" class="form-event-ticket-creation" action="">


                    <div class="form-group">
                    <label>Ticket class</label>        

                    <select name="ticket_class_id" class="form-control">
                        <?php
                        foreach($ticket_section_details as $rs) {
                            echo "<optgroup label=".$rs["title"].">";
                                foreach($rs["ticket_class_details"] as $k=>$row) {
                                    if ( isset($flash_client_request) && $flash_client_request["ticket_class_id"] == $row["id"] ) {
                                        echo "<option selected value=".$row["id"].">".$row["title"]." [".$row["class"]."] </option>";
                                    }else{
                                        echo "<option value=".$row["id"].">".$row["title"]." [".$row["class"]."] </option>";    
                                    }                                  
                                }
                            echo "</optgroup>";
                        }
                        ?>    
                    </select>
                    </div>


                    <div class="form-group">
                    <label>Table start number</label>
                    <input class="form-control" name="table_start_number" placeholder="Enter number" value="<?php echo isset($flash_client_request) && $flash_client_request["table_start_number"] ? $flash_client_request["table_start_number"] : "";  ?>">
                    <p class="help-block help-block-tip">Table start number</p>
                    </div>

                    <div class="form-group">
                    <label>Table end number</label>
                    <input class="form-control" name="table_end_number" placeholder="Enter number" value="<?php echo isset($flash_client_request) && $flash_client_request["table_end_number"] ? $flash_client_request["table_end_number"] : "";  ?>">
                    <p class="help-block help-block-tip">Table start number</p>
                    </div>


                    <div class="form-group">
                    <label>Seat charge</label>
                    <input class="form-control" name="unit_price" placeholder="Enter amount" value="<?php echo isset($flash_client_request) && $flash_client_request["unit_price"] ? $flash_client_request["unit_price"] : "";  ?>">
                    <p class="help-block help-block-tip">Seat charge</p>
                    </div>


                    <div class="form-group">
                    <label>Table charge</label>
                    <input class="form-control" name="table_price" placeholder="Enter amount" value="<?php echo isset($flash_client_request) && $flash_client_request["table_price"] ? $flash_client_request["table_price"] : "";  ?>">
                    <p class="help-block help-block-tip">Table charge</p>
                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-6">
                        <div class="form-group pull-left">
                            <label>Table's seat count</label>
                                <input class="form-control" name="table_seat_count" placeholder="Enter amount" value="<?php echo isset($flash_client_request) && $flash_client_request["table_seat_count"] > 10 ? $flash_client_request["table_seat_count"] : 10;   ?>">             
                            </div>         
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group pull-left">
                            <label>Ticket group</label>
                                <select name="ticket_group" class="form-control">
                                    <option value="default" <?php echo isset($flash_client_request) && $flash_client_request["ticket_group"] != "additional" ? "selected" : "";   ?> >Default</option>
                                    <option value="additional" <?php echo isset($flash_client_request) && $flash_client_request["ticket_group"] == "additional" ? "selected" : "";   ?> >Additional</option>
                                </select>              
                            </div>         
                        </div>
                        <!--
                        <div class="col-lg-6">  
                            <div class="form-group">
                            <label>Missing table numbers</label>
                            <input class="form-control" name="missing_table_numbers" placeholder="Enter numbers">
                            <p class="help-block help-block-tip">Missing table numbers (separated by commas)</p>
                            </div>                        
                        </div>
                         -->
                    </div>

                    <input type="hidden" value="<?=$id?>" name="id" >
                    <input type="hidden" value="<?=$event_id?>" name="event_id" >
                    <button type="submit" class="btn pull-right">Submit Button</button>

                     
                    
            </form>
            </div>
            </div>
            </div>
            <!-- /.col-lg-5 -->


            <div class="col-lg-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <b>Ticket seat list</b>
                    </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">             

                            <div class="row">
                            <div class="col-xs-3">&nbsp;</div>
                            <div class="col-xs-9 text-right">
                                <?php if ( $id > 0 ) { ?>
                                <a href="<?=base_url()?>index.php/admin/ticket/event?event_id=<?=$event_id?>&event_page_start=<?=$event_page_start?>&per_page=<?=$per_page?>">
                                <button type="button" class="btn btn-primary btn-xs" style="margin-bottom:10px;">Add New</button>
                                </a>
                                <?php }else{ ?>
                                <?php echo $pagination_link; ?>
                                <?php } ?>
                            </div>
                            </div>
                            
                            <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Edit</th>
                                    <th>Del</th>
                                    <th>Table start</th>
                                    <th>Table end</th>
                                    <th>Seat charge</th>
                                    <th>Table charge</th>
                                    <th>Section</th>
                                    <th>Class</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0;$i<sizeof($event_ticket_details);$i++){ ?>
                                <tr class="odd gradeX even gradeC">
                                    <td><!--<?=$page_start + ($i+1);?>--></td>
                                    <td><a href="<?=base_url()?>index.php/admin/ticket/event?id=<?=$event_ticket_details[$i]["id"]?>&event_id=<?=$event_id?>&event_page_start=<?=$event_page_start?>&per_page=<?=$per_page?>"> <span class="glyphicon glyphicon-edit"></span> </a></td>
                                    <td><a style="cursor:pointer;" name="confirm_delete" delete-href="<?=base_url()?>index.php/admin/ticket/event_ticket_delete?id=<?=$event_ticket_details[$i]["id"]?>&event_id=<?=$event_id?>&event_page_start=<?=$event_page_start?>&per_page=<?=$per_page?>"> <span class="glyphicon glyphicon-remove"></span> </a></td>
                                    <td><?=$event_ticket_details[$i]["table_start_number"]?></td>
                                    <td><?=$event_ticket_details[$i]["table_end_number"]?></td>
                                    <td><?=$event_ticket_details[$i]["unit_price"]?></td>
                                    <td><?=$event_ticket_details[$i]["table_price"]?></td>
                                    <td><?=$event_ticket_details[$i]["section_title"]?></td>
                                    <td><?=$event_ticket_details[$i]["class_title"]?></td>
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