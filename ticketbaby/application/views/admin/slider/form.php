<?php
$arr = array();
if (isset($result)) {

    $path = admin_url('slider/update_slider');
} else {
    $path = admin_url('slider/add_slider');
}
?>
<a href="<?php echo admin_url('slider'); ?>"><i class="fa fa-arrow-left leftarrow" aria-hidden="true">Back</i></a>
<form action="<?= $path; ?>" method="post" enctype="multipart/form-data" role="form"> 
    <div class="panel panel-default"> 

        <div class="tabbable page-tabs"> 
            <ul class="nav nav-tabs"> 
                <li class="active">
                    <a href="#content" data-toggle="tab"> Content</a>
                </li> 
                <li class="">
                    <a href="#attributes" data-toggle="tab"> ATTRIBUTES</a>
                </li>


            </ul>
            <div class="tab-content"> 
                <!-- First tab --> 
                <div class="tab-pane fade active in" id="content">

                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Caption</label> 
                                    <input type="text" name="caption" class="form-control" value="<?php
                                    if (isset($result['title'])) {
                                        echo $result['title'];
                                    };
                                    ?>">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Description</label> 
                            <?php
                            if (isset($result['description'])) {
                                echo $this->ckeditor->editor('description', $result['description']);
                            } else {
                                echo $this->ckeditor->editor('description', '');
                            }
                            ?>
                        </div>

                    </div>

                </div> 
                <!-- /first tab --> 


                <!-- Second tab --> 
                <div class="tab-pane fade" id="attributes"> 
                    <div class="panel-body">


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>URL</label> 
                                    <input type="text" name="url" class="form-control" value="<?php
                                    if (isset($result['url'])) {
                                        echo $result['url'];
                                    };
                                    ?>">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Order</label> 
                                    <input type="text" name="order_id" class="form-control" value="<?php
                                    if (isset($result['order_id'])) {
                                        echo $result['order_id'];
                                    } else {
                                        echo '0';
                                    }
                                    ?>" >

                                </div> 
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Featured Image:</label> 
                                    <input type="file" class="styled form-control" id="report-screenshot" name="image"> 
                                    <span class="help-block">Accepted formats: gif, png, jpg. Max file size 5Mb | Standard Size: 1400px X 200px</span>
                                </div>

                                <?php
                                if (isset($result['image'])) {
                                    if (!empty($result['image'])) {
                                        ?>
                                        <div class="col-md-6 hide_me_feature">
                                            <a href="<?php echo site_url('uploads/images/full/' . $result['image']); ?>" class="lightbox">
                                                <img src="<?php echo site_url('uploads/images/thumbnails/' . $result['image']); ?>" alt="Route Image" class="img-media admin-logo-img">
                                            </a> 
                                            <a href="javascript:void(0);" onclick="remove_feature_img(<?php echo $result['id']; ?>)" class="btn btn-danger my_btn" style="margin-top:0px; margin-left:10px;">Remove Image</a>

                                        </div>

                                        <?php
                                    }
                                }
                                ?>


                            </div>
                        </div>

                    </div>
                </div> 
                <!-- /second tab --> 





                <div class="panel-body no-padding-top">
                    <div class="form-actions text-left "> 
                        <input type="hidden" name="id" value="<?php
                        if (isset($result['id'])) {
                            echo $result['id'];
                        };
                        ?>"/>
                        <input type="submit" value="<?php
                        if (isset($result)) {
                            echo "update";
                        } else {
                            echo "save";
                        }
                        ?>" class="btn btn-primary"> 
                        <a href="<?php echo admin_url('slider'); ?>" class="btn btn-danger">Cancel</a> 

                    </div>
                </div>
            </div> 
        </div>
    </div>
</form>




<script>
    function remove_feature_img(image_id) {
        var admin_url = '<?php echo admin_url() ?>';

        $.ajax({
            method: 'POST',
            processData: false,
            contentType: false,
            url: admin_url + '/slider/remove_feature_img/' + image_id,
            success: function (result) {
                $('.hide_me_feature').hide();
                alert(result);
            }
        });
        return false;
    }

</script>