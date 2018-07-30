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
                <h1 class="page-header">Promote events</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->


        <div class="row">

            <div class="col-lg-5">
            <div class="panel">
            <div class="panel-body">
            <form role="form" method="post" class="form-promote-event-creation"  enctype="multipart/form-data" action="">

                    <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" name="title" placeholder="Enter title" value="<?php echo isset($flash_client_request) && $flash_client_request["title"] ? $flash_client_request["title"] : "";  ?>">
                    <p class="help-block help-block-tip">Title</p>
                    </div>

                    <div class="form-group">
                    <label>URL</label>
                    <input class="form-control" name="url" placeholder="Enter url" value="<?php echo isset($flash_client_request) && $flash_client_request["url"] ? $flash_client_request["url"] : "";  ?>">
                    </div>

                    <div class="form-group">
                    <label>URL target</label>
                    <select name="url_target" class="form-control">
                        <option selected value="_blank">New window</option>
                        <option value="_self">Default window</option>
                    </select>
                    </div>

                     <div class="form-group">
                        <label>Detail Thumbnail</label>
                        <input name="img_extension" type="file" > 
                        <p class="help-block help-block-tip">[89*68 - width*height]</p>   
                        </div>
                        <?php if ( isset($flash_client_request) && $flash_client_request['img_extension'] != "" ) { ?>
                        <div class="form-group">
                        <a href="<?=base_url()?>assets/upload/event/promote_event_img_<?=$flash_client_request['id'] . $flash_client_request['img_extension'];?>" target="_blank">
                        <img src="<?=base_url()?>assets/upload/event/promote_event_img_<?=$flash_client_request['id'] . $flash_client_request['img_extension'];?>" style="max-width:200px;max-height:300px;" />
                        </a>
                        </div>
                    <?php } ?>


                    <div class="col-lg-12">
                        <div class="col-lg-6">       
                            <div class="form-group">
                            <label>Active</label>
                            <div class="radio">
                            <label><input type="radio" name="active" value="Y" <?php echo ( !isset($flash_client_request)  || isset($flash_client_request) && $flash_client_request['active'] == 'Y') ? 'checked' : ''?> >True</label>
                            </div>
                            <div class="radio">
                            <label><input type="radio" value="N" name="active" <?php echo (isset($flash_client_request) && $flash_client_request['active'] == 'N') ? 'checked' : ''?> >False</label>
                            </div>
                             </div>
                        </div>

                        <div class="col-lg-6">
                        <input type="hidden" value="<?=$id?>" name="id" >
                    <button type="submit" class="btn pull-right">Submit Button</button>       
                        </div>
                    </div>

                    

                     
                    
            </form>
            </div>
            </div>
            </div>
            <!-- /.col-lg-5 -->


            <div class="col-lg-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <b>Promote event list</b>
                    </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">             

                            <div class="row">
                            <div class="col-xs-3">&nbsp;</div>
                            <div class="col-xs-9 text-right">
                                <?php if ( $id > 0 ) { ?>
                                <a href="<?=base_url()?>index.php/admin/event/promote">
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
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Del</th>
                                    <th>Title</th>
                                    <th>URL</th>
                                    <th>URL target</th>
                                    <th  >Active</th>
   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for($i=0;$i<sizeof($promote_event_lists);$i++){ 
                                    $active = ($promote_event_lists[$i]["active"] == 'Y') ? 'fa-check' : 'fa-times';
                                ?>
                                <tr class="odd gradeX even gradeC">
                                    <td><!--<?=$page_start + ($i+1);?>--></td>
                                    <td class="text-center btn-md"><a href="<?=base_url()?>index.php/admin/event/promote?id=<?=$promote_event_lists[$i]["id"]?>&per_page=<?=$per_page?>"> <span class="glyphicon glyphicon-edit"></span> </a></td>
                                    <td class="text-center btn-md"><a style="cursor:pointer;" name="confirm_delete" delete-href="<?=base_url()?>index.php/admin/event/promote/delete?id=<?=$promote_event_lists[$i]["id"]?>&per_page=<?=$per_page?>"> <span class="glyphicon glyphicon-remove"></span> </a></td>
                                    <td><?=$promote_event_lists[$i]["title"]?></td>
                                    <td><?=$promote_event_lists[$i]["url"]?></td>
                                    <td><?=$promote_event_lists[$i]["url_target"]?></td>
                                    <td class="text-center btn-md"><span class="fa <?=$active;?> fa-1x"></span></td>
        
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