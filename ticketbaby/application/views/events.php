<?php include 'includes/header.php'; ?>
<section class="awardtop">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h2 class="award_title"><b><?php echo $event_detail->name; ?></b></h2>
                <h3 class="award_price"><b>Price - $10.00 - $2000.00</b></h3>
                <p class="award_time">Time - 6:30 PM</p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <a href="<?php echo base_url('events/events_detail/'.$event_detail->id) ?>"> <button class="save_event add_cart"><i class="fa fa-floppy-o" aria-hidden="true"></i>VIEW DETAIL</button> </a>
                <a href=""><button class="save_event save_ev"><i class="fa fa-floppy-o" aria-hidden="true"></i> SAVE THIS EVENT</button> </a>
            </div>
        </div>
    </div>
</section>

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
            <h2>Event Information</h2> 
            <p class="underline"></p>
            <p><span class="span_info">Date</span> : <?php if(!empty($event_detail->start_date)) { echo $event_detail->start_date; } ?></p>
            <p><span class="span_info">Venue</span> : <?php if(!empty($event_detail->venue)) { echo $event_detail->venue; } ?></p>
            <p><span class="span_info">Address</span> :<?php if(!empty($event_detail->address)) { echo $event_detail->address; } ?></p>
            <p><span class="span_info">City</span> : <?php if(!empty($event_detail->city)) { echo $event_detail->city; } ?></p>
            <p><span class="span_info">Country</span> : <?php if(!empty($event_detail->country)) { echo $event_detail->country; } ?></p>

            <?php if(!empty($event_detail->details)) { ?>
            <p class="description_para"><?php echo $event_detail->details; ?></p>
            <?php } ?>
        </div>
    </div>
</div>



<?php include 'includes/footer.php'; ?>