<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row" style='margin-top: 14px;'>
            <div class="col-lg-12">
                <h1 class="page-header">CMS Pages</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <b>Page List</b>
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
									<th>Edit</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0;$i<sizeof($pages);$i++){ ?>
                                <tr class="odd gradeX even gradeC">
                                    <td><?=$page_start + ($i+1);?></td>
                                    <td><a href="<?=base_url()?>index.php/admin/page/edit?cms_id=<?=$pages[$i]["cms_id"]?>&page_start=<?=$page_start?>"> <span class="glyphicon glyphicon-edit"></span> </a></td>
									<td><a href="<?=base_url()?>index.php/admin/page/edit?cms_id=<?=$pages[$i]["cms_id"]?>&page_start=<?=$page_start?>"><?=$pages[$i]["cms_title"]?></a></td>
                                    <td><?=$pages[$i]["cms_page"]?></td>
                                    <?php 
                                        $active_icon = ($pages[$i]["active"] == 'Y') ? 'fa-check' : 'fa-times';
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