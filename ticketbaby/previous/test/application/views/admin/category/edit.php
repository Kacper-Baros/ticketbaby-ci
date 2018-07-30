<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Category</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->


        <div class="row">

            <div class="col-lg-12">

            <div class="panel">
            <div class="panel-body">
            <form role="form" method="post" class="form-admin-category-creation" enctype="multipart/form-data"  action="<?=base_url()?>index.php/admin/category/edit?cat_id=<?=$cat_id;?>&page_start=<?=$page_start;?>">
                    <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="category_name" value="<?php echo isset($category_details) ? $category_details['category_name'] : ''?>" placeholder="Enter text">
                    <p class="help-block help-block-tip">The name is how it appears on your site.</p>
                    </div>

                    <div class="form-group">
                    <label>Slug</label>
                    <input class="form-control" name="category_slug" value="<?php echo isset($category_details) ? $category_details['category_slug'] : ''?>" placeholder="Enter text">
                    <p class="help-block help-block-tip">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens</p>
                    </div>

                    <div class="form-group">
                    <label>Parent</label>
                    <?php
                        $parent_id = isset($category_details) ? $category_details['parent_id'] : 0;
                    ?>
                    <select name="parent_id" class="form-control">
                        <option value="0" <?php echo ($parent_id == 0) ? 'selected' : ''  ?> >None</option>
                        <?php
                        foreach($category_tree['category_name'] as $k=>$row) {
                            if ( $parent_id == $category_tree['cat_id'][$k] ) {
                                echo "<option selected value=".$category_tree['cat_id'][$k].">".$row."</option>"; 
                            }else if ( $cat_id == $category_tree['cat_id'][$k] ) {
                                echo "<option disabled value=".$category_tree['cat_id'][$k].">".$row."</option>";
                            }else {    
                                echo "<option value=".$category_tree['cat_id'][$k].">".$row."</option>";    
                            }                  
                        }
                        ?>   
                    </select>
                    </div>

                    <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="category_description" rows="3"><?php echo isset($category_details) ? $category_details['category_description'] : ''?></textarea>
                    </div>
                  

                    <div class="col-lg-2">

                    <div class="form-group">
                    <label>Active</label>
                        <div class="radio">
                            <label><input type="radio" name="active" value="Y" <?php echo (isset($category_details) && $category_details['active'] == 'Y') ? 'checked' : ''?> >True</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="N" name="active" <?php echo (isset($category_details) && $category_details['active'] == 'N') ? 'checked' : ''?> >False</label>
                        </div>
                    </div>


                    <div class="form-group">
                    <label>Thumbnail</label>
                    <input name="img_extension" type="file" >    
                    </div>

                    </div>

                    <div class="col-lg-6">
                    <?php if ( isset($category_details) && $category_details['img_extension'] != "" ) { ?>
                    <div class="form-group">
                        <a href="<?=base_url()?>assets/upload/category/cat_img_<?=$cat_id . $category_details['img_extension'];?>" target="_blank">
                        <img src="<?=base_url()?>assets/upload/category/cat_img_<?=$cat_id . $category_details['img_extension'];?>" style="max-width:200px;max-height:300px;" />
                        </a>
                    </div>
                    <?php } ?>
                    </div>

                    <div class="col-lg-4">
                        <div style="float:right;">
                        <a href="<?=base_url()?>index.php/admin/category/<?=$page_start;?>"><button type="button" class="btn">Back Button</button></a>
                        <button type="submit" class="btn">Submit Button</button>

                        <input  type="hidden" name="cat_id" value="<?=$cat_id;?>" />
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