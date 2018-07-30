          <!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Client</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-lg-12">
		  
			
				<div class="col-lg-12"></div>	
				
								
							<!-- BEGIN FORM-->
							<form action="<?php echo base_url();?>index.php/admin/client/import_csv" method='post' id='formID_csv' style='margin-top:10px;' enctype='multipart/form-data'>		
				
							
								
								<div class="col-lg-12"></div>		
									<div class="form-group col-lg-9">
										<label class="col-lg-3"><h4>Send invitation</h4></label>
										<div class="col-md-6">
											<div class="input-group">
												  <input autocomplete="off" type="email" required='true' class="form-control-register" value="<?php echo $users[$i]["email"];?>" name="email" placeholder="Enter Email"/>
					
					<div class="col-lg-4">
                        <div style="float: right; height: 278px;  margin-left:20px; width: 260px;">
                    
                        <button type="submit" class="btn">Submit Button</button>
						<a href="<?=base_url()?>index.php/admin/client/<?php echo isset($page_start) ? $page_start : "";?>"><button type="button" class="btn">Back Button</button></a>

                        <input  type="hidden" name="user_id" value="<?php echo isset($user_id) ? $user_id : "";?>" />
                        <input  type="hidden" name="id_admin" value="0" />

                        </div>
                    </div>
												
											</div>
										</div>
									</div>
									
									
							
							</form>
							<!-- END FORM-->
							
								
						</div>
						</div>