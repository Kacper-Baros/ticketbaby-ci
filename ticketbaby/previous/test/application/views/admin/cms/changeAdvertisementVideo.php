
    
    
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?=$title;?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->


        <div class="row">

            <div class="col-lg-12">
            <div class="panel">
            <div class="panel-body">
            <form role="form" method="post" class="form-admin-event-creation" enctype="multipart/form-data"  action="<?=base_url()?>index.php/admin/page/changeadvertisementvideo">
                    <div class="form-group">
                        <label>Provide Url</label>
                        <input class="form-control" type="text" name="video_url" value="" placeholder="Enter Url">
                        <p class="help-block help-block-tip">Add Video Url Here .</p>
                        <input class="form-control" type="hidden" name="field" value="advertisement_video" >
                    </div>
                    
 
                    <div class="col-lg-12">
                        <div class="col-lg-4">
                            <div style="float:right;">
                                <button type="submit" class="btn">Update</button>
                            </div>
                        </div>
                    </div>
                    
            </form>
            </div>
            </div>
            </div>
            <!-- /.col-lg-5 -->
<?php
echo "<pre>";print_r($data);

?>
			<iframe type="text/html" width="560" height="315" src="<?php echo trim($advertisement_video[0]['video'],'"'); ?>" frameborder="0"></iframe>

        </div>
        <!-- /.row -->    

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->