
<a href="<?php echo admin_url('slider/slider_form'); ?>" class="btn btn-success add_new" type="button"><i class="icon-plus"></i>Add New</a>                
                    <!-- Media datatable --> 
                    <div class="panel panel-default"> 
                        <div class="panel-heading">
                            <h6 class="panel-title"><i class="icon-images"></i>Slider Image</h6>
                        </div> 

                        <div class="row">
                            <div class="col-sm-12 post-list">

<?php echo $res; ?>

                                
                            </div>
                        </div>
                    </div> 


<script type="text/javascript">
    $(document).ready(function () {
        var admin_url = '<?php echo admin_url(); ?>';

        $('.post-list ul').sortable({
            //axis: 'y',

            update: function (event, ui) {
                var data = $(this).sortable('serialize');
                
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: '<?php echo admin_url('slider/manage_order/'); ?>',
                    success:function(result){
                        alert(result);
                    }
                });
            }
        });


});
</script>


<script type="text/javascript">
//$('.post-list ul li ul').hide();
$('.post-list ul li').click(function(e){
    if( $(this).find('>ul').hasClass('active') ){
        $(this).children('ul').removeClass('active').children('li').slideUp(100);
        //$(this).children('ul').show(100);
        e.stopPropagation();
    }
    else{
        $(this).children('ul').addClass('active').children('li').slideDown(100);
        e.stopPropagation();
    }
});
</script>






