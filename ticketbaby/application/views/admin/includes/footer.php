       <!-- Footer --> 
        <div class="footer clearfix"> 
            <div class="pull-left">&copy; <?php echo date("Y"); ?>. Admin Panel <a href="<?php echo site_url(); ?>"><?php echo config_item('site_name'); ?></a>
            </div> 
            <div class="pull-right icons-group"> <a href="#"><i class="icon-screen2"></i></a> <a href="#"><i class="icon-balance"></i></a> <a href="#"><i class="icon-cog3"></i></a> 
            </div> 
        </div> 
        <!-- /footer -->
    </div><!-- /page content -->
</div><!-- /page container -->
<script type="text/javascript">
	function showTicketDesc(){
		var tickId = $("#ticketclasslist").val();
		if(tickId==12){
			$("#"+tickId).show();
			$("#13").hide();
			$("#27").hide();
			$("#30").hide();
			$("#39").hide();
		}
		if(tickId==13){
			$("#"+tickId).show();
			$("#12").hide();
			$("#27").hide();
			$("#30").hide();
			$("#39").hide();
		}
		if(tickId==27){
			$("#"+tickId).show();
			$("#13").hide();
			$("#12").hide();
			$("#30").hide();
			$("#39").hide();
		}
		if(tickId==30){
			$("#"+tickId).show();
			$("#13").hide();
			$("#27").hide();
			$("#12").hide();
			$("#39").hide();
		}
		if(tickId==39){
			$("#"+tickId).show();
			$("#13").hide();
			$("#27").hide();
			$("#30").hide();
			$("#12").hide();
		}
		if(tickId==''){
			$("#12").hide();
			$("#13").hide();
			$("#27").hide();
			$("#30").hide();
			$("#12").hide();
		}
		
	}
$(document).ready(function() {
	//Check whether a Field selected in Export Model or not
	$("#submitExport").click(function(){
		if ($("#ExportsFields input:checkbox:checked").length > 0){
			$("#ExportsFields").submit();
		}
		else{
		   alert("Please Select atleast one Field!");
		   return false;
		}
	});
});
</script>
</body>
</html>