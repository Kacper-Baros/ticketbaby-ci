<?php include 'includes/header.php' ?>
<?php $slide = $this->db->get_where('tbl_post', array('id' => 148))->row(); ?>
<section class="slider_sec">
  <div id="myCarousel" class="carousel slide my_slider"  data-ride="carousel"> 
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <?php
            $j = 0;
            foreach ($sliders as $si)
			 {
				 
                ?>
      <li data-target="#myCarousel" data-slide-to="<?php echo $j; ?>" class="<?php
                if ($j == 0) {
                    echo "active";
                }
                ?>"></li>
      <?php
                    $j++;
                }
                ?>
    </ol>
    
    <!-- Wrapper for Slides -->
    <div class="carousel-inner">
      <?php
            $i = 0;
            foreach ($sliders as $ss)
			 {
                ?>
      <div class="item <?php if ($i == 0){ echo 'active'; } ?>"> 
        <!-- Set the first background image using inline CSS below. -->
        <div class="fill" style="background-image:url('<?php echo base_url('uploads/images/full/' . $ss->image) ?>');"></div>
        <div class="carousel-caption">
          <div class="caption">
            <h2><?php echo $ss->title; ?></h2>
            <p><?php echo $ss->description; ?> </p>
            <?php if ($ss->url != '') { ?>
            <a href="<?php $ss->url; ?>" class="btn btn-success more_btn">Learn More</a>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php
                $i++;
            }
            ?>
    </div>
    
    <!-- Controls --> 
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <span class="icon-prev"></span> </a> <a class="right carousel-control" href="#myCarousel" data-slide="next"> <span class="icon-next"></span> </a>
    <div class="col-xs-12 col-sm-4 col-md-3 inquery_col"> </div>
  </div>
</section>
<div class="container">
  <div class="row search_payment">
    <div class="col-md-7 col-sm-7 col-xs-12">
      <form id="searchForm" method="get" action="<?php echo base_url('search') ?>">
        <div class="input-group">
          <div class="col-xs-12 col-sm-8 col-md-8 col-xs-8">
            <input type="text" class="form-control s_control" name="keyword" placeholder="Search">
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-xs-4"> <span class="input-group-btn">
            <button type="submit" class="btn btn-secondary search_btn"> <i class="fa fa-search search_search_control" aria-hidden="true"></i> </button>
            </span> </div>
        </div>
      </form>
    </div>
    <div class="col-md-5 col-sm-5 col-xs-12"> <img src="<?php echo theme_img('barclay.png'); ?>" class="img-responsive center-block img_payment"> </div>
  </div>
</div>
<section class="listing_event">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div id="owl-demo">
          <?php

                    function limit_words($string, $word_limit) {
                        $words = explode(" ", $string);
                        return implode(" ", array_splice($words, 0, $word_limit));
                    }
                    ?>
          <?php foreach ($main_carousel as $m) { ?>
          <?php 
		  
		  /*if ($m->event_type == 0) { ?>
          <a href="<?php echo base_url('Family_trips/singleview/'. $m->id); ?>">
          <?php } else { */
		  	
		    $award_slug = $this->db->get_where('tbl_events',array('id'=>$m->id))->row()->slug; ?>
         	 <a href="<?php echo base_url($award_slug);  ?>" >
         
          <div class="item">
            <div class="event_detail recomme">
              <div class="image"> <img src="<?php echo base_url('uploads/images/medium/' . $m->image) ?>" alt="Owl Image" class="img-responsive">
                <div class="event_date"> <span><?php echo $m->start_date ?></span> </div>
              </div>
              <h4><?php echo $m->name ?></h4>
              <p><?php echo limit_words($m->details, 10) . '...' ?></p>
              <button class="get_ticket_btn" href="<?php echo base_url('family_trips/singleview/'. $m->id); ?>">Get Tickets</button>
            </div>
          </div>
          </a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="recommended_event">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <h3 class="home_title">RECOMMENDED EVENTS</h3>
        <div class="underline"></div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div id="owl-demo1" class="event_space">
              <?php foreach ($recommended_carousel as $r) { ?>
              <?php /*if ($r->event_type == 0) { ?>
              <a href="<?php echo base_url('events/event/' . $r->id); ?>">
              <?php } else { ?>
              	<!--<a href="<?php echo base_url('awards/award_details/' . $r->id); ?>">-->
              <?php }*/ 
			  
			  ?>
             
              <?php $award_slug = $this->db->get_where('tbl_events',array('id'=>$r->id))->row()->slug; ?>
              
              <a href="<?php echo base_url($award_slug); ?>">
              
              <div class="item">
                <div class="event_detail recommended">
                  <div class="image"> <img src="<?php echo base_url('uploads/images/medium/' . $r->image) ?>" alt="Owl Image" class="img-responsive">
                    <div class="event_date"> <span><?php echo $r->start_date ?></span> </div>
                  </div>
                  <h4><?php echo $r->name ?></h4>
                  <button class="get_ticket_btn" href="<?php echo base_url('events/event/' . $r->id); ?>">Get Tickets</button>
                </div>
              </div>
              </a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script  src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js" language="javascript" ></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-4482989842467373",
    enable_page_level_ads: true
  });
</script>


<section class="ticket_section">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-3 col-md-3">
        <div class="promote_event">
          <h3>LET US PROMOTE YOUR EVENT</h3>
          <?php
                    //echo "<pre>";print_r($promote_events); echo '</pre>';
                    
                    foreach ($promote_events as $p) { ?>
          <div class="promote_detail ">
            <div class="col-sm-5"><img src="<?php echo base_url('uploads/images/small/' . $p->image); ?>" class="img-responsive img-big" alt=""></div>
            <div class="col-sm-7" style="padding-left:0; padding-right: 0">
              <h5 style="font-weight: bold"><?php echo strtoupper($p->title); ?></h5>
              <p><?php echo $p->sdate.' '.$p->time; ?></p>
              <a href="<?php echo site_url(). 'events/pevent/'.$p->id;?>">see details</a> </div>
            <div class="clearfix"></div>
          </div>
          <?php } ?>
          <a class="more_button" href="<?php echo site_url()?>events/peventlist" style="text-align:center">More</a> </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 ticketcol ">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#hot_tickets" aria-controls="hot_tickets" role="tab" data-toggle="tab">HOT TICKETS</a></li>
          <li role="presentation"><a href="#announced" aria-controls="announced" role="tab" data-toggle="tab">JUST ANNOUNCED</a></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="hot_tickets">
            <div class="movie_list">
              <ul>
                <?php
						$co=0;
						foreach($hot_ticket as $h) {
							if($co==6){ break; } 
							$co++;
							$cat_name = $this->db->get_where('tbl_post', array('id' => $h->category_id))->row()->title;
                   ?>
                <li>
                  <?php if ($h->event_type == 0) { ?>
                  <a href="<?php echo base_url('events/event/' . $h->id); ?>">
                  <?php } else { ?>
                  <a href="<?php echo base_url('awards/award_details/' . $h->id); ?>">
                  <?php } ?>
                  <span class="event_name"><?php echo $h->name;//echo limit_words($h->name, 3) ?></span> <span class="pull-right"><?php echo $cat_name; ?> </a> </li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="announced">
            <div class="movie_list">
              <ul>
                <?php
						$co=0;
						foreach($just_announced as $j) {
							if($co==6){ break; } 
							$co++;
						$cat_name = $this->db->get_where('tbl_post', array('id' => $j->category_id))->row()->title;
                  ?>
                <li>
                  <?php if ($j->event_type == 0) { ?>
                  <a href="<?php echo base_url('events/event/' . $j->id); ?>">
                  <?php } else { ?>
                  <a href="<?php echo base_url('awards/award_details/' . $j->id); ?>">
                  <?php } ?>
                  <span class="event_name"><?php echo $j->name;//echo limit_words($j->name, 3) ?></span> <span class="pull-right"><?php echo $cat_name; ?></span> </a> </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="addvertisment"> 
        		 <?php 
					 $homepage_banner = $this->db->get_where('tbl_homepage_banner',array('status'=>'1'))->result();
				   ?>
                		
                     <img src="<?php  echo base_url(); ?>/uploads/images/pageslider/<?php echo $homepage_banner[0]->image;?>" alt="..." class="img-responsive" height="127px" width="603px">
                        
                      
             		
				 
               </div>
               
        <div class="search_box text-center">
          <h4>Get top Events and Latest updates in your inbox with TicketBaby</h4>
          <div class="input-group">
            <div class=" col-md-9 col-sm-8 col-xs-12">
              <input type="text" class="form-control s_control" placeholder="Enter you Email address.">
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12"> <span class="input-group-btn">
              <button type="submit" class="btn btn-secondary search_btn"> Submit </button>
              </span> </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="row parent_img">
          <h3 class="home_title">Advertisement</h3>
          <div class="underline"></div>
          <div class="no-right">
            <?php /*?><div class="small_img"> <img src="<?php echo theme_img('sponsor_img.jpg'); ?>" class="img-responsive" alt=""> </div><?php */?>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                      <?php 
					  		$co=0;
					  		foreach($row as $val)
					  		{
					   ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo  $co; ?>" class="<?php if($co==0){ echo "active";} ?>"></li>
                       <?php $co++; } ?> 
                      </ol>

             		 <div class="carousel-inner" role="listbox">
                     <?php 
					  		$co=0;
					  		foreach($row as $val)
					  		{
					   ?>
                		<div class="item <?php if($co==0){ echo "active";} ?>">
                          <img src="<?php  echo base_url(); ?>/uploads/images/pageslider/<?php echo $val->image;?>" alt="..."  height="100%"  width="100%">
                          <div class="carousel-caption">
                            
                          </div>
                        </div>
                       <?php $co++; } ?> 
                		
             		 </div>
				</div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="where_ticket">
          <h3>WHERE ARE MY TICKETS ?</h3>
          <!--<img src="<?php echo theme_img('ticket.png'); ?>" class="img-responsive" alt="">--> 
          <!--                    <div class="ticket_layer">
                        <a href="#">Buy Tickets Online</a>
                    </div>-->
          <div class="alert alert-success done" style="display:none;">
                inquiery has been submitted
            </div>
                        
          <form method="POST" action="" id="myfrom">
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" placeholder="Your Name" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" placeholder="Your Email" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Event Name</label>
              <input type="text" name="ename" placeholder="Event Name" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Purchase Date</label>
              <input type="text" name="date" placeholder="Purchase Date" class="form-control" required>
            </div>
            
            <div class="form-group text-center">
              <input type="submit" class="btn btn-secondary search_btn" value="Send Enquiry">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
<script language="javascript">
 $("#myfrom").submit(function(){
  $.ajax({
	   url: "<?php echo site_url().'front/sendmail'?>",
	   type: "POST",
	   data:  new FormData(this),
	   contentType: false,
	   cache: false,
	   processData:false,
   	   success: function(data){
	   		$("#myfrom")[0].reset();
			$('.done').show();
			$('.done').fadeOut(7000);
			
    	}      
    });
     return false;
});
</script>
