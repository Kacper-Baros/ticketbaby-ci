<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Settings</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->


        <div class="row">

            <div class="col-lg-12">

            <div class="panel">
            <div class="panel-body">
            <form role="form" method="post" class="form-admin-category-creation" action="">     
                    <?php 
                        $temp = ""; $show = ""; 
                        foreach($settings as $k=>$v) { 
                            if ( $temp == $v["category"] ) {
                                $show = "";
                            }else{
                                $show = $temp = $v["category"];
                            }
                    ?>

                    <?php if ($show != "") { ?>
                    <div class="col-lg-12">
                    <h4><?=$show;?></h4>
                    </div>
                    <?php } ?>

                    <div class="col-lg-4">

                    <div class="form-group">
                    <label><?=$v["title"];?></label>

                    <?php if ($v["field_type"] == "textarea") { ?>
                        <textarea class="form-control" name="<?=$v["field"];?>" rows="2"><?=$v["value"];?></textarea>
                    <?php }else{ ?>
                        <input class="form-control" name="<?=$v["field"];?>" value="<?=$v["value"];?>" placeholder="Enter text">
                    <?php } ?>
                    

                    <p class="help-block help-block-tip"><?=$v["description"];?></p>
                    </div>

                    </div>

                    <?php } ?>

                  

                    <div class="col-lg-12">
                        <div style="float:right;">
                        <button type="submit" class="btn">Submit Button</button>
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