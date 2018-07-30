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
                <h1 class="page-header">Coupon</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->


        <div class="row">

            <div class="col-lg-5">
            <div class="panel">
            <div class="panel-body">
            <form role="form" method="post" class="form-coupon-creation" action="">



                    <div class="form-group">
                    <label>Coupon code</label>
                    <input class="form-control" name="coupon_code" placeholder="Enter number" value="<?php echo isset($flash_client_request) && $flash_client_request["coupon_code"] ? $flash_client_request["coupon_code"] : "";  ?>">
                    <p class="help-block help-block-tip">Coupon code</p>
                    </div>

                    <div class="form-group">
                        <label>Coupon Type</label>                      
                        <div class="radio">
                        <label class="radio-inline"><input name="coupon_type" type="radio" value="P" <?php echo ( !isset($flash_client_request)  || isset($flash_client_request['coupon_type']) && $flash_client_request['coupon_type'] == 'P') ? 'checked' : ''?> >Percentage</label>
                        <label class="radio-inline"><input name="coupon_type" type="radio" value="F" <?php echo ( isset($flash_client_request) && isset($flash_client_request['coupon_type']) && $flash_client_request['coupon_type'] == 'F') ? 'checked' : ''?> >Flat</label>
                        <label class="radio-inline"><input name="coupon_type" type="radio" value="FREE" <?php echo ( isset($flash_client_request) && isset($flash_client_request['coupon_type']) && $flash_client_request['coupon_type'] == 'FREE') ? 'checked' : ''?> >FREE</label>
                        </div>
                        <p class="help-block help-block-tip">FREE / F -> Flat / P -> Percentage</p>
                    </div>


                    <div class="form-group">
                    <label>Coupon value</label>
                    <input class="form-control" name="coupon_value" placeholder="Enter amount" value="<?php echo isset($flash_client_request) && $flash_client_request["coupon_value"] ? $flash_client_request["coupon_value"] : "";  ?>">
                    <p class="help-block help-block-tip">Coupon value</p>
                    </div>


                   

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
                    <b>Coupon list</b>
                    </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">             

                            <div class="row">
                            <div class="col-xs-3">&nbsp;</div>
                            <div class="col-xs-9 text-right">
                                <?php if ( $id > 0 ) { ?>
                                <a href="<?=base_url()?>index.php/admin/coupon">
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
                                    <th>Coupon</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Active</th>
   
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0;$i<sizeof($coupon_lists);$i++){ ?>
                                <tr class="odd gradeX even gradeC">
                                    <td><!--<?=$page_start + ($i+1);?>--></td>
                                    <td><a href="<?=base_url()?>index.php/admin/coupon?id=<?=$coupon_lists[$i]["id"]?>&per_page=<?=$per_page?>"> <span class="glyphicon glyphicon-edit"></span> </a></td>
                                    <td><a style="cursor:pointer;" name="confirm_delete" delete-href="<?=base_url()?>index.php/admin/coupon/delete?id=<?=$coupon_lists[$i]["id"]?>&per_page=<?=$per_page?>"> <span class="glyphicon glyphicon-remove"></span> </a></td>
                                    <td><?=$coupon_lists[$i]["coupon_code"]?></td>
                                    <td><?=$coupon_lists[$i]["coupon_type"]?></td>
                                    <td><?=$coupon_lists[$i]["coupon_value"]?></td>
                                    <td><?=$coupon_lists[$i]["active"]?></td>
        
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