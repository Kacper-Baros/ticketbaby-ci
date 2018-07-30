<div class="row">

    <div class="col-md-12"> 
        
        <div class="panel panel-primary"> 
            <div class="panel-heading"> 
                <h6 class="panel-title"><i class="icon-newspaper"></i> Add Menu</h6> 
            </div> 

            <div class="panel-body">
                <div class="form-group">

                    <div class="row">
                    <?php if($this->session->flashdata('msg')){ ?>
<div class="col-md-12">
<div class="alert alert-success fade in block"> <button type="button" class="close" data-dismiss="alert">×</button> <i class="icon-info"></i> <?php echo $this->session->flashdata('msg'); ?> </div>
</div>
                    <?php } ?>
                    <form method="post" action="<?php echo admin_url('menu/save'); ?>">
                        <div class="col-md-8">
                            <label>Title</label> 
                            <input type="text" required name="title" class="form-control" value="">
                            <input type="submit" value="Save" class="btn btn-success" style="float: right; margin: 10px 15px;">
                        </div><br/>
                        
                    </form>
                    </div>


                    <div class="row">  
                        <div class="col-md-10">  
                            <ul class="message-list droptrue" id="sortable">
    <?php foreach($result as $r){ ?>                            
                                <li id="item-1">
                                    <div class="clearfix">
                                        <div class="chat-member">
                                            <h6> <?php echo $r->title; ?></h6>
                                        </div>
                                        <div class="status">
                                            <h6><a href="<?php echo admin_url('menu/organize/'.$r->id); ?>" class="btn btn-success">Organize menus</button></a></h6>
                                        </div>
                                        <div class="chat-actions">
                                            <a title="Edit" href="#" id="more<?php echo $r->id; ?>" class="btn btn-link btn-icon btn-xs"><i class="icon-pen"></i></a>
                                            <a title="Delete" href="<?php echo admin_url('menu/delete/'.$r->id); ?>" class="btn btn-link btn-icon btn-xs"><i class="icon-remove"></i></a>
                                        </div>                   
                                    </div>
                                </li>
    <?php } ?>

                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>    
    </div> 
</div>



<?php foreach($result as $r){ ?>
<script type="text/javascript">
    $("#more<?php echo $r->id; ?>").click(function(e){
      e.preventDefault();
      $("#showmore<?php echo $r->id; ?>").slideToggle();
    });
</script>
<?php } ?>