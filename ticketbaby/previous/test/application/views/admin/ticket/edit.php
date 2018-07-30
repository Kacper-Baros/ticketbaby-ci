<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit ticket class</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->


        <div class="row">

            <div class="col-lg-12">

            <div class="panel">
            <div class="panel-body">
            <form role="form" method="post" class="form-ticket-class-creation"  action="<?=base_url()?>index.php/admin/ticket/edit?id=<?=$ticket_class_id;?>&page_start=<?=$page_start;?>">
                    <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" name="title" value="<?php echo isset($ticket_class_details) ? $ticket_class_details['title'] : ''?>" placeholder="Enter text">
                    <p class="help-block help-block-tip">The name is how it appears on your site.</p>
                    </div>

                    <div class="form-group">
                    <label>Slug</label>
                    <input class="form-control" name="class" value="<?php echo isset($ticket_class_details) ? $ticket_class_details['class'] : ''?>" placeholder="Enter text">
                    <p class="help-block help-block-tip">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens</p>
                    </div>

                    <div class="form-group">
                    <label>Section</label>
                    <?php
                        $section_id = isset($ticket_class_details) ? $ticket_class_details['section_id'] : 0;
                    ?>
                    <select name="section_id" class="form-control">
                        <?php
                        foreach($ticket_section_details as $k=>$row) {
                            if ( $section_id == $row["id"] ) {
                                echo "<option selected value=".$row["id"].">".$row["title"]."</option>"; 
                            }else {    
                                echo "<option value=".$row["id"].">".$row["title"]."</option>";  
                            }                  
                        }
                        ?>   
                    </select>
                    </div> 

                    <div class="form-group">
                    <label>Tooltip</label>
                    <textarea class="form-control" name="tool_tip" rows="2"><?php echo isset($ticket_class_details) ? $ticket_class_details['tool_tip'] : ''?></textarea>
                    </div>

                    <div class="col-lg-12">
                    <div class="col-lg-4">
                    <div class="form-group">
                    <label>Order</label>
                    <input class="form-control" name="order" value="<?php echo isset($ticket_class_details) ? $ticket_class_details['order'] : ''?>" placeholder="Enter number">
                    <p class="help-block help-block-tip">Order</p>
                    </div>
                    </div>


                    <div class="col-lg-4">

                    <div class="form-group">
                    <label>Type</label>
                        <div class="radio">
                            <label><input type="radio" name="ticket_selection_type" value="1" <?php echo (isset($ticket_class_details) && $ticket_class_details['ticket_selection_type'] == '1') ? 'checked' : ''?> >Select field</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="2" name="ticket_selection_type" <?php echo (isset($ticket_class_details) && $ticket_class_details['ticket_selection_type'] == '2') ? 'checked' : ''?> >Input field</label>
                        </div>
                    </div>

                    </div>



                    <div class="col-lg-4">
                        <div style="float:right;">
                        <a href="<?=base_url()?>index.php/admin/ticket/<?=$page_start;?>"><button type="button" class="btn">Back Button</button></a>
                        <button type="submit" class="btn">Submit Button</button>

                        <input  type="hidden" name="id" value="<?=$ticket_class_id;?>" />
                        </div>
                    </div>
                    </div>
                    
            </form>
            </div>
            </div>
            </div>
            <!-- /.col-lg-5 -->



        </div>
        <!-- /.row -->    

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->