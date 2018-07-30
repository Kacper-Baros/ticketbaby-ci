<?php include('includes/header.php'); ?>
<div class="page-container">
<?php include('includes/sidebar.php'); ?>

<?php if(isset($_GET['update']))
{ 
	$result = $this->db->get_where('tbl_homepage_banner', array('id'=>$_GET['update']))->result(); 
} 

if(isset($_GET['delete']))
{ 
		
		$this->db->where('id',$_GET['delete']);
        $aa=$this->db->delete('tbl_homepage_banner');
	    redirect(base_url() .'admin/homepage_banner');
} 

$row = $this->db->get_where('tbl_homepage_banner',array('status'=>'1'))->result();

?>
<div class="page-content">

<!-- Page header -->
		<div class="page-header">
          <div class="page-title">
   			 <h3>Dashboard</h3>
  		  </div>
        </div>
<!-- /page header --> 

<!-- Breadcrumbs line -->
		<div class="breadcrumb-line">
          <ul class="breadcrumb">
            <li><a href="http://ticketbaby.co.uk/new/admin">Home</a></li>
            <li class="active">homepage banner</li>
          </ul>
          <div class="visible-xs breadcrumb-toggle"> <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a> </div>
          <ul class="breadcrumb-buttons collapse">
   			 <li class="language dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="http://ticketbaby.co.uk/new/assets/admin/images/flags/english.png" alt=""> <span>English</span> <b class="caret"></b> </a> </li>
 		 </ul>
       </div>
<!-- /breadcrumbs line -->
<?php if(@$_GET['add']=="add" or isset($_GET['update']))
	{
	?>
    
    <?php if(isset($_GET['update'])){ $url=admin_url('homepage_banner/update'); }else { $url=admin_url('homepage_banner/add'); }	?>
                 
                  
	<a href="<?php echo admin_url('homepage_banner'); ?>"><i class="fa fa-arrow-left leftarrow" aria-hidden="true">Back</i></a>
    
		<form action="<?php echo  $url; ?>" method="post" enctype="multipart/form-data" role="form">
          <div class="panel panel-default">
    		 <div class="tabbable page-tabs">
              
              <div class="tab-content">
              <div class="tab-pane fade active in" id="content">
                <div class="panel-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Caption</label>
                        <input name="caption" class="form-control" value="<?php echo @$result[0]->caption; ?>" type="text">
                      </div>
                      <div class="col-md-6">
                        <label>Image</label>
                        <input name="image" class="form-control" value="" type="file">
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="panel-body no-padding-top">
                <div class="form-actions text-left ">
                 <?php if(isset($_GET['update']))
				 	   {
				 ?>
                 <input type="hidden" name="id" value="<?php echo $_GET['update']; ?>" />
                  <input value="update" class="btn btn-primary" name="update" type="submit">
                  <?php } else {?>
                  <input value="save" class="btn btn-primary" name="submit" type="submit">
                  <?php } ?>
                  <a href="<?php echo admin_url('homepage_banner'); ?>" class="btn btn-danger">Cancel</a> </div>
              </div>
            </div>
            </div>
		  </div>
        </form>
<?php }
	else
	{
	?>
<?php /*?><a href="<?php echo admin_url('homepage_banner/?add=add'); ?>" class="btn btn-success add_new" type="button"><i class="icon-plus"></i>Add New</a> <?php */?>
<!-- Media datatable -->
<div class="panel panel-default">
          <div class="panel-heading">
    		<h6 class="panel-title"><i class="icon-images"></i>Slider Image</h6>
 		  </div>
          <div class="row">
    		<div class="col-sm-12 post-list">
              <ul class="message-list droptrue ui-sortable" id="sortable">
              <?php foreach($row as $val)
			  		{
			  ?>
        		<li id="item-147">
                  <div class="clearfix">
                    <div class="chat-member"><a href="#"><img src="http://ticketbaby.co.uk/uploads/images/pageslider/<?php echo $val->image;?>" alt=""></a>
                      <h6><?php echo $val->caption;?></h6>
                    </div>
                    <div class="chat-actions"><a title="Edit" href="<?php echo admin_url(); ?>/homepage_banner?update=<?php echo $val->id;?>" class="btn btn-link btn-icon btn-xs"><i class="icon-pen"></i></a>
                 <?php /*?>   <a title="Remove" href="<?php echo admin_url(); ?>/homepage_banner?delete=<?php echo $val->id;?>" class="btn btn-link btn-icon btn-xs" onClick="return confirm('Are you sure ?');"><i class="icon-remove"></i></a><?php */?>
                    </div>
                  </div>
                  <ul class="message-list droptrue ui-sortable" id="sortable">
                  </ul>
                </li>

               <?php } ?>
        	 </ul>
            </div>
  		  </div>
        </div>
<?php
	}
	 include('includes/footer.php'); ?>
