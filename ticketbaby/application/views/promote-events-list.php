<?php include 'includes/header.php';  ?>




<div class="container">
    <h2 class="text-center">PROMOTED EVENT</h2>
    <div class="row event_detai">
        <div class="row" style="border-bottom: 2px solid;margin-bottom: 10px;padding: 15px;background: rgba(0, 0, 0, .3);color: #fff;margin-top: 25px;">
            <div class="col-sm-2 col-sm-offset-1"></div>
            
                <p class="col-sm-2 text-center"><span class="span_info">Date</span></p>
                <p class="col-sm-2 text-center"><span class="span_info">Time</span></p>
                <p class="col-sm-2 text-center"><span class="span_info">Venue</span></p>
                <p class="col-sm-2"></p>
            
        </div>
        
        <?php        foreach ($event_detail as $r){ ?>
        <div class="row" style="border-bottom: 1px solid; margin-bottom: 10px;padding: 15px">
        <div class="col-sm-2  col-sm-offset-1 text-center">
            <img class="event_img" src="<?php if(!empty($r->image)) { echo base_url('uploads/images/full/'.$r->image); } ?>" style="width: 100px;height: auto;min-height: auto;">
        </div>
          <p class="col-sm-2 text-center"><?php if(!empty($r->sdate)) { echo $r->sdate; } ?></p>
            <p class="col-sm-2 text-center"><?php if(!empty($r->time)) { echo $r->time; } ?></p>
            <p class="col-sm-2 text-center"><?php if(!empty($r->venue)) { echo $r->venue; } ?></p>
            <p class="col-sm-2 text-center"><a href="<?php echo site_url().'events/pevent/'.$r->id; ?>" class="btn btn-default">Detail</a></p>
            
        
        </div>
        <?php } ?>
        

       
    </div>
</div>



<?php include 'includes/footer.php'; ?>