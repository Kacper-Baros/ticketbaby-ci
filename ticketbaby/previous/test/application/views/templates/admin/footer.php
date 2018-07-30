    </div>
    <!-- /#wrapper -->

    <footer class="main-footer">
    <div class="pull-right hidden-xs">
        <?php $this->load->helper('date'); echo standard_date('DATE_RFC822', time()); ?>
    </div>
    <strong>Copyright &copy; 2015-2016 <a href="<?=base_url()?>" target="_blank">Ticket Baby</a>.</strong> All rights reserved.
    </footer>

    
   
    <!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url()?>assets/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url()?>assets/js/sb-admin-2.js"></script>

    <!-- Morris Charts JavaScript -->
    <?php if ($title && $title == 'Dashboard') { ?>
        <script src="<?=base_url()?>assets/morrisjs/raphael.js"></script>
        <script src="<?=base_url()?>assets/morrisjs/morris-data.js"></script>
        <script src="<?=base_url()?>assets/morrisjs/morris.min.js"></script>
    <?php } ?>

   <!-- <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-select.min.js"></script>
    <script src="<?=base_url()?>assets/bootstrapvalidator/bootstrapValidator.min.js"></script>-->

    <script src="<?=base_url()?>assets/js/t-baby-admin.min.js"></script>
	

<script type="text/javascript">
    $(window).load(function() {
        TBABYADMIN.init({
          base_url: "<?=base_url()?>"
        });
    }); 
</script>
<script type="text/javascript">
	$(document).ready(function() {
		/*
		 *  Simple image gallery. Uses default settings
		 */
	
		$('.fancybox').fancybox();
	
		/*
		 *  Different effects
		 */
		
	});
	
	
	$(document).ready(function(){
		$('#submit').on('click',function(e){
			
			var value = '';
			$("input[name='fields[]']:checked").each(function (){
				if(value==''){
					value = $(this).val();
				}
			});	
			
			if(value==''){
				alert("Please Choose Atleast One Field");
				e.preventDefault();
					
			}else{
				return true;		
			}

		});
		
		/**USER PER PAGE*/	
		$('#user_per_page').on('change',function(){
			var per_page = $(this).val();
			$('#per_page_hidden').val(per_page);
			window.location.href='<?php echo base_url();?>index.php/admin/user/'+per_page;
			
		});
		/**USER PER PAGE*/
		
		/**CLIENT PER PAGE*/	
		$('#client_per_page').on('change',function(){
			var per_page = $(this).val();
			$('#per_page_hidden').val(per_page);
			window.location.href='<?php echo base_url();?>index.php/admin/client/'+per_page;
			
		});
		/**CLIENT PER PAGE*/	
		
	});
	

</script>

</body>

</html>