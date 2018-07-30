<?php include 'includes/header.php'; 

//echo '<pre>';print_r($event_detail); echo '</pre>';
?>


<div class="container">
    <div class="row award_descp">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php if(!empty($event_detail->summary)) { ?>
            <p><?php echo $event_detail->summary; ?></p>
            <?php } ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row event_detai">
        <div class="col-md-5 col-sm-5 col-xs-12">
            <img class="event_img" src="<?php if(!empty($event_detail->image)) { echo base_url('uploads/images/full/'.$event_detail->image); } ?>">
        </div>

        <div class="col-md-7 col-sm-7 col-xs-12 event_col">
            <h2>Event details</h2> 
            <p class="underline"></p>
            <p><span class="span_info">Date</span> : <?php if(!empty($event_detail->sdate)) { echo $event_detail->sdate; } ?></p>
            <p><span class="span_info">Time</span> : <?php if(!empty($event_detail->time)) { echo $event_detail->time; } ?></p>
            <p><span class="span_info">Venue</span> : <?php if(!empty($event_detail->venue)) { echo $event_detail->venue; } ?></p>
            <p><span class="span_info">Address</span> :<?php if(!empty($event_detail->address)) { echo $event_detail->address; } ?></p>
            <p><span class="span_info">City</span> : <?php if(!empty($event_detail->city)) { echo $event_detail->city; } ?></p>
            <p><span class="span_info">Country</span> : <?php if(!empty($event_detail->country)) { echo $event_detail->country; } ?></p>                 
            <?php if(!empty($event_detail->details)) { ?>
            <p class="description_para"><?php echo $event_detail->details; ?></p>
            <?php } ?>
             <?php if(!empty($event_detail->url)) { ?>
            <a href="<?php echo $event_detail->url ?>" class="btn btn-primary btn-lg" target="_NEW">Event Link</a>
            <?php } ?>
            
        </div>
    </div>
</div>



<?php include 'includes/footer.php'; ?>