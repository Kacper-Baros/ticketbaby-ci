
       <form action="<?=admin_url('settings/save');?>" method="post" enctype="multipart/form-data" role="form"> 
           <div class="panel panel-default"> 
               <div class="panel-heading">
                   <h6 class="panel-title"><i class="icon-pencil4"></i>Edit Site Setting</h6>
               </div> 
               <div class="panel-body">
                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-12">
                               <label>Site Title</label> 
                               <input type="text" name="site_title" class="form-control" value="<?=$setting->site_title;?>">
                           </div>
                       </div>
                   </div>


                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-6">
                               <label>Update Logo:</label> 
                               <input type="file" class="styled form-control" id="report-screenshot" name="image"> 
                               <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                           </div>
                           <div class="col-md-6">
                               <a href="<?php echo site_url('uploads/logo/'.$setting->image); ?>" class="lightbox">
                                    <img src="<?php echo site_url('uploads/logo/'.$setting->image); ?>" alt="Site Logo" class="img-media admin-logo-img">
                                </a> 
                           </div>
                       </div>
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-12">
                               <label>Site Email</label> 
                               <input type="text" name="site_email" class="form-control" value="<?=$setting->site_email;?>">
                           </div>
                       </div>
                   </div>


                    <div class="form-group">
                        <label>Offline:</label>
                            <div>
                                <label class="radio-inline">
                                    <input type="radio" name="offline" class="styled" value="1" <?php if($setting->offline==1){echo 'checked="checked"';}?>>On
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="offline" class="styled" value="0" <?php if($setting->offline==0){echo 'checked="checked"';}?>>Off
                                </label>                               
                                </div>                                   
                    </div>


                   <div class="form-group">
                       <label>Offline Message:</label> 
                       <textarea name="offline_message" rows="5" cols="5" class="elastic form-control"><?=$setting->offline_message;?></textarea>
                   </div>  

                   <br/>
                <h1>Index Page SEO</h1>
                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-12">
                               <label>Title</label> 
                               <input type="text" name="seotitle" class="form-control" value="<?=$setting->seotitle;?>">
                           </div>
                       </div>
                   </div>                   

                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-12">
                               <label>Keywords</label> 
                               <input type="text" name="seokeyword" class="form-control" value="<?=$setting->seokeyword;?>">
                           </div>
                       </div>
                   </div>

                   <div class="form-group">
                       <label>Description</label> 
                       <textarea name="seodescription" rows="5" cols="5" class="elastic form-control"><?=$setting->seodescription;?></textarea>
                   </div>                    



                   <div class="form-actions text-right"> 
                       <input type="submit" value="Submit" class="btn btn-primary"> 
                   </div>
               </div>
           </div>
       </form>

