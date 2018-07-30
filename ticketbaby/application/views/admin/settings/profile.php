
       <form action="<?=admin_url('settings/update_profile');?>" method="post" enctype="multipart/form-data" role="form"> 
           <div class="panel panel-default"> 
               <div class="panel-heading">
                   <h6 class="panel-title"><i class="icon-pencil4"></i>Update Company Detail</h6>
               </div> 
               <div class="panel-body">
                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-12">
                               <label>Company Name</label> 
                               <input type="text" name="company_name" class="form-control" value="<?=$profile->company_name;?>">
                           </div>
                       </div>
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-6">
                               <label>Address 1</label> 
                               <input type="text" name="address1" class="form-control" value="<?=$profile->address1;?>">
                           </div>
                           <div class="col-md-6">
                               <label>Address 2</label> 
                               <input type="text" name="address2" class="form-control" value="<?=$profile->address2;?>">
                           </div>
                       </div>                       
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-4">
                               <label>Phone</label> 
                               <input type="text" name="phone" class="form-control" value="<?=$profile->phone;?>">
                           </div>
                           <div class="col-md-4">
                               <label>Phone1</label> 
                               <input type="text" name="phone1" class="form-control" value="<?=$profile->phone1;?>">
                           </div>

                           <div class="col-md-4">
                               <label>Fax</label> 
                               <input type="text" name="fax" class="form-control" value="<?=$profile->fax;?>">
                           </div>                                                      
                       </div>
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-3">
                               <label>Facebook</label> 
                               <input type="text" name="facebook" class="form-control" value="<?=$profile->facebook;?>">
                           </div>
                           <div class="col-md-3">
                               <label>Twitter</label> 
                               <input type="text" name="twitter" class="form-control" value="<?=$profile->twitter;?>">
                           </div>
                           <div class="col-md-3">
                               <label>Email</label> 
                               <input type="text" name="email" class="form-control" value="<?=$profile->email;?>">
                           </div> 

                           <div class="col-md-3">
                               <label>LinkedIn</label> 
                               <input type="text" name="linkedin" class="form-control" value="<?=$profile->linkedin;?>">
                           </div>                                                                                 
                       </div>
                   </div>

                
                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-3">
                               <label>Google+</label> 
                               <input type="text" name="googleplus" class="form-control" value="<?=$profile->googleplus;?>">
                           </div>
                           <div class="col-md-3">
                               <label>Skype</label> 
                               <input type="text" name="skype" class="form-control" value="<?=$profile->skype;?>">
                           </div>  

                           <div class="col-md-3">
                               <label>YouTube</label> 
                               <input type="text" name="youtube" class="form-control" value="<?=$profile->youtube;?>">
                           </div>  

                       </div>
                   </div>



                   <div class="form-group">
                       <label>Company Detail</label> 
                       <textarea name="company_detail" rows="5" cols="5" class="elastic form-control"><?=$profile->company_detail;?></textarea>
                   </div>                    

                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-6">
                               <label>Latitude</label> 
                               <input type="text" name="lat" class="form-control" value="<?=$profile->lat;?>">
                           </div>
                           <div class="col-md-6">
                               <label>Longitude</label> 
                               <input type="text" name="lng" class="form-control" value="<?=$profile->lang;?>">
                           </div>
                       </div>                       
                   </div>  


                   <div class="form-actions text-right"> 
                       <input type="submit" value="Submit" class="btn btn-primary"> 
                   </div>
               </div>
           </div>
       </form>

<style>
  #examples a {
    text-decoration: underline;
  }
 .map_canvas { 
    width: auto; 
    height: 400px; 
    margin: 10px 20px 10px 0;
  }
 
</style>