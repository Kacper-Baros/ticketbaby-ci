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
            <form role="form" method="post" class="form-admin-event-creation" enctype="multipart/form-data"  action="<?=base_url()?>index.php/admin/page/edit?cms_id=<?php echo isset($cms_id) ? $cms_id : "";?>&page_start=<?php echo isset($page_start) ? $page_start : "";?>">
                    <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" name="cms_title" value="<?php echo isset($page_details) ? $page_details['cms_title'] : ''?>" placeholder="Enter text">
                    <p class="help-block help-block-tip">The name is how it appears on your site.</p>
                    </div>

                    <div class="form-group">
                    <label>Slug</label>
                    <input class="form-control" name="cms_page" value="<?php echo isset($page_details) ? $page_details['cms_page'] : ''?>" placeholder="Enter text">
                    <p class="help-block help-block-tip">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens</p>
                    </div>

 
                    <div class="form-group">
                    <label>Content</label>
                    <?php   
						$CKEditor = new CKEditor(base_url()."ckeditor/");  
						//$CKEditor->config['height'] = 200;
						
						$CKEditor->config['width'] = '@@screen.width * 0.6';                           
						$CKEditor->editor("details",  isset($page_details) ? $page_details['cms_content'] : ''); 
					?> 
					<!--
					<textarea class="form-control" name="details" rows="10"><?php echo isset($page_details) ? $page_details['cms_content'] : ''?></textarea>
                    -->
					</div>
                  
                    <div class="col-lg-12">
                    <div class="col-lg-8">

                    <div class="form-group">
                    <label>Active</label>
                        <div class="radio">
                            <label><input type="radio" name="active" value="Y" <?php echo (isset($page_details) && $page_details['active'] == 'Y') ? 'checked' : ''?> >True</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="N" name="active" <?php echo (isset($page_details) && $page_details['active'] == 'N') ? 'checked' : ''?> >False</label>
                        </div>
                    </div>



                    </div>

       

                    <div class="col-lg-4">
                        <div style="float:right;">
                        <a href="<?=base_url()?>index.php/admin/page/<?php echo isset($page_start) ? $page_start : "";?>"><button type="button" class="btn">Back Button</button></a>
                        <button type="submit" class="btn">Submit Button</button>

                        <input  type="hidden" name="cms_id" value="<?php echo isset($cms_id) ? $cms_id : "";?>" />
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