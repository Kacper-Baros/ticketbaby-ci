    </div>
    <!-- /#wrapper -->

    <footer class="main-footer">
    <div class="pull-right hidden-xs">
        <?php $this->load->helper('date'); echo standard_date('DATE_RFC822', time()); ?>
    </div>
    <strong>Copyright &copy; 2015-2016 <a href="<?=base_url()?>" target="_blank">Ticket Baby</a>.</strong> All rights reserved.
    </footer>

    
    <!-- jQuery -->
    <script src="<?=base_url()?>assets/jquery/jquery-2.1.4.min.js"></script>

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

    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-select.min.js"></script>
    <script src="<?=base_url()?>assets/bootstrapvalidator/bootstrapValidator.min.js"></script>

    <script src="<?=base_url()?>assets/js/t-baby-admin.min.js"></script>

    <script type="text/javascript">
    $(window).load(function() {
        TBABYADMIN.init({
          base_url: "<?=base_url()?>"
        });
    }); 
    </script>

</body>

</html>