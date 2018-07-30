<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Client</h1>
            </div>
			<?php if($this->session->flashdata('error')) { ?>                    
                        <p style="color:red">
                            <?php echo $this->session->flashdata('error');?>
                        </p>                   
                    <?php } 
					 elseif($this->session->flashdata('success')) { ?>                    
                        <p style="color:green">
                            <?php echo $this->session->flashdata('success');?>
                        </p>                   
                    <?php }?>    
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <b>Client List</b>
                    </div>
				<form action="<?php echo base_url();?>index.php/admin/client" method='get' style='margin-top:10px;'>		
					<div class="col-lg-3">
						<div class="form-group">
						<label></label>
						<input type='text' name='q' value="<?php echo $q;?>" placeholder='Search by email or name' class="form-control">
						<p class="help-block help-block-tip"></p>
						</div>
					</div>
					<div class="col-lg-9" style='margin-top:15px;'>
						<div class="pull-right">
						<button type="submit" class="btn" name='filter' value='filter'>Filter </button>
						</div>
					</div>
				</form>	
				<div class="col-lg-12"></div>	
				
						<div class="col-lg-12 pull-right">
							<a class='pull-right' href="<?php echo base_url();?>index.php/admin/client/download_csv" target='_blank'><i class="fa fa-download"></i> Download Sample CSV File</a>
						</div>		
							<!-- BEGIN FORM-->
							<form action="<?php echo base_url();?>index.php/admin/client/import_csv" method='post' id='formID_csv' style='margin-top:10px;' enctype='multipart/form-data'>		
				
							
								
								<div class="col-lg-12"></div>		
									<div class="form-group col-lg-9">
										<label class="col-lg-3">Import CSV/Excel file</label>
										<div class="col-md-6">
											<div class="input-group">
												<input type='file' required='true' name='file' id='file' accept=".csv" onchange="checkfile(this);">
												<label id="csv_file-message" class="message">Required, only .xls and .csv files allowed </label>
												
											</div>
										</div>
									</div>
									
									
								
									<div class="form-group col-lg-3">
										<button type="submit" class="btn pull-right" name='filter' value='filter'>Upload CSV </button>
									</div>
								
							</form>
							<!-- END FORM-->
							
								
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created Date</th>
									 <th>Active</th>
									<th>Edit</th>
									<!--th>Invite</th-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0;$i<sizeof($users);$i++){ ?>
                                <tr class="odd gradeX even gradeC">
                                    <td><?=$page_start + ($i+1);?></td>
                                    <td><a href="<?=base_url()?>index.php/admin/client/edit?id=<?=$users[$i]["id"]?>&page_start=<?=$page_start?>"><?=$users[$i]["first_name"]?></a></td>
                                    <td><?=$users[$i]["email"]?></td>
									<td><?php echo date('M d, Y',strtotime($users[$i]["created_date"]));?></td>
                                    <?php 
                                        $active_icon = ($users[$i]["status"] == '1') ? 'fa-check' : 'fa-times';
                                    ?>
                                    <td class="center"><i class="fa <?=$active_icon;?> fa-1x"></i></td>
									 <td class="text-center"><a href="<?=base_url()?>index.php/admin/client/edit?id=<?=$users[$i]["id"]?>&page_start=<?=$page_start?>"> <span class="glyphicon glyphicon-edit"></span> </a></td>    
									 <!--td class="text-center"><a href="<?=base_url()?>index.php/admin/client/invite?id=<?=$users[$i]["id"]?>&page_start=<?=$page_start?>">Invite</a></td-->    
                                   
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
 <script src="<?php echo base_url();?>js/jquery.min.js"></script>

 <script src="<?php echo base_url();?>js/jquery.validate.min.1.9.0.js"></script>
<script type="text/javascript" language="javascript">
function checkfile(sender) {
    var validExts = new Array(".xlsx", ".xls", ".csv");
    var fileExt = sender.value;
    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
    if (validExts.indexOf(fileExt) < 0) {
      $("#file").val('');
	   $("#file").css('border','1px solid #F44336');
		alert("Invalid file selected, valid files are of " +
               validExts.toString() + " types.");
      return false;
    }
	else{
		$("#file").css('border','1px solid #8BC34A');
		return true;
	} 
}
</script>

<!-- /#page-wrapper -->
