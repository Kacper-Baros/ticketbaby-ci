<div class="row">
    <div class="col-md-3"> 
        <div class="panel panel-primary"> 
            <div class="panel-heading"> 
                <h6 class="panel-title"><i class="icon-newspaper"></i> Post, Categories & Pages</h6> 
            </div> 
            <div class="panel-body"> 
                <div class="block-inner">
                    
<form method="post" action="<?php echo admin_url('menu/organize_menu/'.$id); ?>">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#post">Post</a></li>
                  <li><a data-toggle="tab" href="#categories">Categories</a></li>
                  <li><a data-toggle="tab" href="#pages">Pages</a></li>
                </ul>

                <div class="tab-content tab-content-menu">
                    <div id="post" class="tab-pane tab-pane-menu fade in active">
                        <h3>Posts</h3>
                        <?php foreach($all_posts as $p){ ?>
                        <label class="checkbox-inline checkbox-success">
                            <div class="checker"><span class="checked"><input type="checkbox" name="post_id[]" value="<?php echo $p->id; ?>" class="styled"></span>
                            </div><?php echo $p->title; ?>
                        </label>
                        <?php } ?>

                    </div>

                  
                    <div id="categories" class="tab-pane tab-pane-menu fade">
                        <h3>Categories</h3>
                        <?php foreach($categories as $c){ ?>
                        <label class="checkbox-inline checkbox-success">
                            <div class="checker"><span class="checked"><input type="checkbox" name="post_id[]" value="<?php echo $c->id; ?>" class="styled"></span>
                            </div><?php echo $c->title; ?>
                        </label>
                        <?php } ?>
                    </div>


                    <div id="pages" class="tab-pane tab-pane-menu fade">
                        <h3>Pages</h3>
                        <?php foreach($pages as $page){ ?>
                        <label class="checkbox-inline checkbox-success">
                            <div class="checker"><span class="checked"><input type="checkbox" name="post_id[]" value="<?php echo $page->id; ?>" class="styled"></span>
                            </div><?php echo $page->title; ?>
                        </label>
                        <?php } ?>
                    </div>


                </div>

                <input type="submit" value="save" class="btn btn-success" style="float: right; margin-top: 10px;">


                </div>
             </div> 
        </div> 
    </div>


    <div class="col-md-9"> 
        <div class="panel panel-primary"> 
            <div class="panel-heading"> 
                <h6 class="panel-title"><i class="icon-newspaper"></i><?php echo $post->title; ?> items</h6> 
            </div> 


        <div class="panel-body">
            <div class="col-md-7">
                <div class="dd nestable" id="nestable">
            <?php echo $result; ?>
                </div>
            </div>

            <div class="col-md-5">

                <div class="" id="addmenu">
                    <a href="javascript:void(0);" class="btn btn-success" onclick="add()">Add Menu</a>
                    <div id="menuadd">

                    </div>

                    <div class="" id="actiondiv">
     
                    </div>

                </div>
            </div>

        </div>    
    </div>    


    </div>



<style type="text/css">
    .button-delete{
    right: 40px;
    bottom: 0px;
    top: 0px;
    padding-top: 9px;
    }.button-edit{
    position: absolute;
    top: 0px;
    right: 0px;
    padding-top: 10px;
    }.my-btn-delete{
        margin: 5px 1px 5px;
    }.my-btn{
        margin: 5px;
    }

</style>







<script>

$(document).ready(function () {
    var admin_url = '<?php echo admin_url('menu/manage_order'); ?>';
    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target), output = list.data('output');

        $.ajax({
            method: "POST",
            url: admin_url,
            data: {
                list: list.nestable('serialize')
            },
            success:function(result){
                //alert(result);
            }
        })
    };

    $('#nestable').nestable({

    }).on('change', updateOutput);
});
</script>


<script type="text/javascript">
function edit(e){
    var admin_url = '<?php echo admin_url(); ?>';
    $('#apddiv').remove();
    var postid = $(e).attr('data-id');
    var id = $(e).attr('id');
    var menuid = $(e).attr('data-menuid');
    var parent_id = $(e).attr('data-parentid');
    var title = $(e).attr('data-title');
    var url = $(e).attr('data-url');
    var content = '<div id="apddiv"><h3>Action</h3><form method="post" action="'+admin_url+'/menu/update_menu_item/'+id+'"><input type="hidden" name="menu_id" value="'+menuid+'"><div class="form-group omenulabel"><label>Menu title</label><input type="text" required name="menu_title" class="form-control" value="'+title+'"></div><div class="form-group omenulabel"><label>Url</label><input type="text" name="url" class="form-control" value="'+url+'"></div><input type="hidden"  name="parent_id" class="form-control" value="'+parent_id+'"><input type="hidden"  name="post_id" class="form-control" value="'+postid+'"><input type="hidden"  name="id" class="form-control" value="'+id+'"><a href="'+admin_url+'/menu/deletemenu/'+id+'/'+menuid+'" class="btn btn-danger" style="float: right;margin-top: 10px;" onclick="return confirm(\'Are you sure ?\');">Delete</a><a href="'+admin_url+'/menu/organize/'+menuid+'" class="btn btn-primary" style="margin-top: 10px;">Cancle</a><input type="submit" value="Update" class="btn btn-success" style="float: right; margin: 10px 15px;"></form></div>';
    $('#actiondiv').append(content);
    return false;
}

function add(){
    var admin_url = '<?php echo admin_url(); ?>';
    var menu_id = '<?php echo $id; ?>';
    var url = '<?php echo admin_url(); ?>/menu/addmenu/';
    var addmenucontent = '<form action="'+url+'" method="post"><div class="form-group omenulabel"><input type="hidden" name="menu_id" value="'+menu_id+'"><label>Menu title</label><input type="text" required name="menu_title" class="form-control"><label>Url</label><input type="text" name="url" class="form-control"><a href="'+admin_url+'/menu/organize/'+menu_id+'" class="btn btn-primary" style="margin-top: 10px;">Cancle</a><input type="submit" value="Save" class="btn btn-success" style="float: right; margin-top: 10px;"></div></form>';
    $('#menuadd').append(addmenucontent);
    return false;
}

</script>

<style type="text/css">
    .omenulabel{
        margin-bottom: 10px!important;
    }
</style>