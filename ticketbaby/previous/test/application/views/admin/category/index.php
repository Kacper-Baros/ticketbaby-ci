<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Categories</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->


        <div class="row">

            <div class="col-lg-5">
            <div class="panel">
            <div class="panel-body">
            <form role="form" method="post" class="form-admin-category-creation" enctype="multipart/form-data"  action="<?=base_url()?>index.php/admin/category/">
                    <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="category_name" placeholder="Enter text">
                    <p class="help-block help-block-tip">The name is how it appears on your site.</p>
                    </div>

                    <div class="form-group">
                    <label>Slug</label>
                    <input class="form-control" name="category_slug" placeholder="Enter text">
                    <p class="help-block help-block-tip">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens</p>
                    </div>

                    <div class="form-group">
                    <label>Parent</label>


                    <select name="parent_id" class="form-control">
                        <option value="0">None</option>
                        <?php
                        foreach($category_tree['category_name'] as $k=>$row) {
                            echo "<option value=".$category_tree['cat_id'][$k].">".$row."</option>";
                        }
                        ?>    
                    </select>
                    </div>

                    <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="category_description" rows="3"></textarea>
                    </div>
                  

                    <div class="form-group">
                    <label>Active</label>
                        <div class="radio">
                            <label><input type="radio" name="active" value="Y" checked>True</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="N" name="active">False</label>
                        </div>
                    </div>


                    <div class="form-group">
                    <label>Thumbnail</label>
                    <input name="img_extension" type="file">
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
                    <b>Category List</b>
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
                                    <th>Name</th>
                                    <th>Parent Category</th>
                                    <th>Slug</th>
                                    <th>Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0;$i<sizeof($categories);$i++){ ?>
                                <tr class="odd gradeX even gradeC">
                                    <td><?=$page_start + ($i+1);?></td>
                                    <td><a href="<?=base_url()?>index.php/admin/category/edit?cat_id=<?=$categories[$i]["cat_id"]?>&page_start=<?=$page_start?>"><?=$categories[$i]["category_name"]?></a></td>
                                    <td><?=$categories[$i]["parent_category"]?></td>
                                    <td><?=$categories[$i]["category_slug"]?></td>
                                    <?php 
                                        $active_icon = ($categories[$i]["active"] == 'Y') ? 'fa-check' : 'fa-times';
                                    ?>
                                    <td class="center"><i class="fa <?=$active_icon;?> fa-1x"></i></td>
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