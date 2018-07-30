<?php
$arr = array();
if (isset($result)) {
    $id = $result['id'];
    $parent_id = $result['parent_id'];
    $path = admin_url('category/update_link');
} else {
  $id = '';
  $parent_id = '';
    $path = admin_url('category/save_link');
}
?>


       <form action="<?= $path; ?>" method="post" enctype="multipart/form-data" role="form"> 
           <div class="panel panel-default"> 

                  <div class="tabbable page-tabs"> 
                    <ul class="nav nav-tabs"> 
                      <li class="active">
                        <a href="#content" data-toggle="tab"> Content</a>
                      </li> 

                      
                    </ul>
                  <div class="tab-content"> 
                  <!-- First tab --> 
                    <div class="tab-pane fade active in" id="content">
 
                     <div class="panel-body">
                         <div class="form-group">
                             <div class="row">
                                 <div class="col-md-6">
                                     <label>Title</label> 
                                     <input type="text" required name="title" id="title" class="form-control" value="<?php if(isset($result['title'])){echo $result['title'];};?>">
                                 </div>
                             </div>
                         </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6">
                                <label>Parent</label> 



  <?php
  $options  = array();
  $options[0] = 'Select Parent Page';
  function page_loop($pages, $dash = '', $id=0)
  {
    $options  = array();
    foreach($pages as $page)
    {
      //this is to stop the whole tree of a particular link from showing up while editing it
      if($id != $page->id)
      {
        $options[$page->id] = $dash.' '.$page->title;
        $options      = $options + page_loop($page->children, $dash.'-', $id);
      }
    }
    return $options;
  }
  $options  = $options + page_loop($pages, '', $id);
  echo form_dropdown('parent_id', $options,  set_value('parent_id', $parent_id),'class="select-search my_select_opt"', 'tabindex="2"');
  
  ?>

                              </div>
                          </div>
                        </div>

                             <div class="form-group">
                             <div class="row">
                                 <div class="col-md-6">
                                     <label>URL</label> 
                                     <input type="text" required name="url" class="form-control" value="<?php if(isset($result['url'])){echo $result['url'];};?>">
                                     <span>(ex. <?php echo base_url(); ?> )</span>
                                 </div>
                             </div>
                             </div>
                        
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6">
                               <label>Order</label> 
                               <input type="text" name="order_id" class="form-control" value="<?php if(isset($result['order_id'])){echo $result['order_id'];}else{echo '0';}?>" >
                               
                            </div> 
                          </div>
                        </div>

                        
                     </div>

                    </div> 
                    <!-- /first tab --> 


                    <div class="panel-body no-padding-top">
                    <div class="form-actions text-left "> 
                        <input type="hidden" name="id" value="<?php if (isset($result['id'])) { echo $result['id']; }; ?>"/>
                      <input type="submit" value="<?php if(isset($result)){ echo "update"; }else{ echo "save"; } ?>" class="btn btn-primary"> 
                       <a href="<?php echo admin_url('category'); ?>" class="btn btn-danger">Cancel</a> 
                       
                    </div>
                    </div>
                </div> 
              </div>
           </div>
       </form>

