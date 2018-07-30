<?php include 'includes/header.php'; 
	$additional_event_detail = $this->db->get_where('additional_event_detail', array('event_id' =>$award_detail->event_id))->result();
	
	//$session = $this->session->unset_userdata('tables');
	$this->session->unset_userdata('tables');
	$this->session->unset_userdata('tickets');
	$this->session->unset_userdata('after_party');
	$this->session->unset_userdata('promocode');
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#customer_promo_code").val('');
});
</script>
<section class="award_detail_section">
  <div class="row award_deatail_header">
    <div class="container">
      <div class="row search_payment award_page">
        <div class="col-md-7 col-sm-7 col-xs-12">
          <!--                    <div class="input-group">
                                            <input type="text" class="form-control s_control award_scontrol" placeholder="Search">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-secondary search_btn">
                                                    <i class="fa fa-search search_search_control" aria-hidden="true"></i>
                                                </button>
                                            </span>
                                        </div>--> 
        </div>
        <div class="col-md-5 col-sm-5 col-xs-12 barclayimgcol"> <img src="<?php echo theme_img('barclay.png'); ?>" class="img-responsive center-block img_payment"> </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row event_detai event_detai_detail">
      <div class="col-md-4 col-sm-4 col-xs-12">
        <?php if (@$award_detail->image2 == '') { ?>
        <img class="event_img" alt="" src="<?php echo base_url('uploads/images/full/'.@$award_detail->image); ?>">
        <?php } else { ?>
        <img class="event_img" alt="" src="<?php echo base_url('uploads/images/full/' .@$award_detail->image2); ?>">
        <?php } ?>
      </div>
      <div class="col-md-8 col-sm-8 col-xs-12 event_col">
        <h2><?php echo @strtoupper($award_detail->name); ?></h2>
        <!--            <p class="underline"></p>-->
        <div class="info_prices">
          <h3 class="award_price">Price - &pound;<?php echo @$award_detail->price; ?>.00</h3>
          <p class="award_time">Time - <?php echo @strtoupper($award_detail->time); ?></p>
        </div>
        <p class="description_event"><?php echo @$award_detail->details; ?></p>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row eventinforow">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <p>EVENT INFORMATION</p>
      </div>
      
    </div>
    <div class="row event_inforow">
      <div class="col-md-5 col-sm-5 col-xs-12 header_awards_col1">
        <p class="header_event">EVENT INFORMATION</p>
        <ul class="header_informations">
          <li>
            <div class="row">
              <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">Date</div>
              <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo @$award_detail->start_date; ?></div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">Venue</div>
              <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo @$award_detail->venue; ?></div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">Address</div>
              <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo @$award_detail->address; ?></div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">City</div>
              <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo @$award_detail->city; ?></div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">Country</div>
              <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo @$award_detail->country; ?></div>
            </div>
          </li>
        </ul>
        <p class="eventinfo-para"><?php echo @$award_detail->summary; ?></p>
        <form method="post" id="sumbit-form-tickets" action="<?php echo base_url('awards/booking_post/' .@$award_detail->event_id) ?>">
         
			<?php
		   
				$party = $this->db->get_where('tbl_ticket_class', array('parent_id' =>30))->result();
				foreach($party as $val)
				{
					@$seats= $this->db->get_where('tbl_event_seats', array('event_id' =>$award_detail->event_id,'ticket_class_id'=>$val->id))->result();
					
					if(@$seats)
					{
						$seets=1;
					}
				}
				if(@$seets==1)
				{	
				
				?>
			  <p class="header_awards">TICKETS ONLY</p>
					<table class='table event_table additio'>
						<thead>
						<th>TYPE</th>
						  <th>PRICE</th>
						  <th>AVAILABLE</th>
						  <th>Quantity</th>
							</thead>
							  <tbody>
						  <?php
							$party = $this->db->get_where('tbl_ticket_class', array('parent_id' =>30))->result();
							foreach($party as $val)
							{
								@$seat= $this->db->get_where('tbl_event_seats', array('event_id' =>$award_detail->event_id,'ticket_class_id'=>$val->id))->result();
								if(@$seat)
								{
								?>
								
						  <tr>
							<input type="hidden" name="tickets" value="<?php echo $seat[0]->seat_charge; ?>">
							<td><input type='radio' id="tickets<?php echo $seat[0]->seat_charge; ?>" name="after_party">
								 <strong class="class-text name<?php echo $seat[0]->ticket_class_id; ?>"><?php echo $val->class; ?></strong> <span class="ticket-class-tooltip" data-toggle="modal" data-target="#tablesonlymodal<?php echo $val->id; ?>" > <!--data-target="#afterpartymodal">-->?</span></td>
							<td>&pound <?php echo $seat[0]->seat_charge; ?></td>
							<td><?php echo $seat[0]->table_end; ?></td>
							<td><select onchange="add_tickets(this.value,<?php echo $seat[0]->seat_charge; ?>,<?php echo $seat[0]->ticket_class_id; ?>, <?php echo $seat[0]->id; ?>)" name="party_quantity" class="form-control party_quantity"  id="sel2">
								<option value="0">Quantity</option>
								<?php
										if($seat[0]->table_end < 10){ $to=$seat[0]->table_end;}else{ if($seat[0]->event_id=='38'){$to=2;}else{$to=20;} }
									 for ($i = 1; $i <= $to; $i++) { ?>
									 <option  value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php } ?>
							  </select>
							 </td>
						  </tr>
							<?php
								 }
							 }
							?>
						</tbody>
					  </table>
			  <?php } ?>
		 
          <?php  foreach ($table_section as $t)
				   {
                 	$tick = $this->db->get_where('tbl_ticket_class', array('id' => $t->ticket_parent_id))->row();
                    if ($tick->class == 'Tables Only')
					 {
						 $tbl=1;
					 }
				   }
				   
				if(@$tbl==1)
				{	   
		  ?>
					  
				  <p class="header_awards">TABLES ONLY <!-- - CHOOSE YOUR SECTION --></p>
				  <table class='table event_table'>
					<thead>
					  <th>TYPE</th>
					  <th>PRICE</th>
					  <th>AVAILABLE</th>
					</thead>
					<tbody>
					  <?php
						  foreach ($table_section as $t) {
							$tick = $this->db->get_where('tbl_ticket_class', array('id' => $t->ticket_parent_id))->row();
							if ($tick->class == 'Tables Only') {
					  ?>
					  <tr>
						<td><input type='radio' onchange="open_model(<?php echo $t->seat_id; ?>)" name="table_seats" value="<?php echo $t->seat_id; ?>">
						  <strong class="class-text"><?php echo $t->ticket_class; ?></strong> <span class="ticket-class-tooltip" data-toggle="modal" data-target="#tablesonlymodal<?php echo $t->tid; ?>">?</span></td>
						<td>&pound;<?php echo $t->table_charge; ?></td>
						<td><?php echo $t->available_table; ?></td>
					  </tr>
					  <?php 
							 }
						   }
					  ?>
					</tbody>
				  </table>
		 <?php } ?>
          
           <?php
				foreach ($table_section as $ts)
				{
					$tick = $this->db->get_where('tbl_ticket_class', array('id' => $ts->ticket_parent_id))->row();
					if ($tick->class == 'Table Tickets') 
					{
						$tkt=1;
					}
				}
				
				if(@$tkt==1)
				{	
			?>
         		 <p class="header_awards">TABLE TICKETS <!-- - CHOOSE YOUR SECTION --></p>
         		 <table class='table event_table'>
            <thead>
              <th>TYPE</th>
              <th>PRICE</th>
              <th>AVAILABLE</th>
            </thead>
            <tbody>
              <?php
				foreach ($table_section as $ts)
				 {
					$tick = $this->db->get_where('tbl_ticket_class', array('id' => $ts->ticket_parent_id))->row();
					if ($tick->class == 'Table Tickets') {
				?>
                	
                      <tr>
                        <td><input type='radio' onchange="open_model(<?php echo $ts->seat_id; ?>)" id="ticket_seats<?php echo $ts->seat_charge; ?>" name="table_seats" value="<?php echo $ts->seat_id ?>">
                          <strong class="class-text"> <?php echo ' ' . $ts->ticket_class; ?></strong> <span class="ticket-class-tooltip ticky" data-toggle="modal" data-target="#tablesonlymodal<?php echo $ts->tid; ?>" ><!--data-target="#tablesonlymodal<?php //echo $t->tid; ?>" --> ?</span></td>
                        <td>&pound;<?php echo $ts->seat_charge; ?></td>
                       	<td>
                        <?php 
							$total="";
							$co="";
							 foreach ($ts->table as $a) 
							  {
								 $a->table_no;
								 $total=10-$a->seat;
								 $co=$co+$total;
								 $total="";
								 if($a->status==2){
									 $co=$co-10;
								 }
							 }
							 echo $co;
					  ?>
                                <?php //echo $ts->available_table * 10; ?>
                        </td>
                      </tr>
              		
              <?php
                      }
                   }
               ?>
            </tbody>
          </table>
       
          <?php } ?>
          
              
          <?php
				$party = $this->db->get_where('tbl_ticket_class', array('parent_id' =>27))->result();
				foreach($party as $val)
				{
					@$seat= $this->db->get_where('tbl_event_seats', array('event_id' =>$award_detail->event_id,'ticket_class_id'=>$val->id))->result();
					if(@$seat)
					{
						$seet=1;
					}
				}
			?>
          		<p class="header_awards" id="additionalSelect">ADDITIONALS</p>
                <table class='table event_table additio'>
				 <?php
                  if(@$seet==1)
                  {
					  ?>
                    <thead>
                    	<th>TYPE</th>
                        <th>PRICE</th>
                      	<th>AVAILABLE</th>
                      	<th>Quantity</th>
                    </thead>
                    <tbody>
                      <?php
					    $party = $this->db->get_where('tbl_ticket_class', array('parent_id' =>27))->result();
                        foreach($party as $val)
                        {
                            @$seat= $this->db->get_where('tbl_event_seats', array('event_id' =>$award_detail->event_id,'ticket_class_id'=>$val->id))->result();
                            if(@$seat)
                            {
                            ?>
                            
                      <tr>
                        <input type="hidden" name="after_party_price" value="<?php echo $seat[0]->seat_charge; ?>">
                        <td><input type='radio' id="after_party_radio<?php echo $seat[0]->seat_charge; ?>" name="ADDITIONALS">
                             <strong class="class-text name<?php echo $seat[0]->ticket_class_id; ?>"><?php echo $val->class; ?></strong> <span class="ticket-class-tooltip" data-toggle="modal" data-target="#tablesonlymodal<?php echo $val->id; ?>" ><!-- data-target="#afterpartymodal"> -->?</span></td>
                        <td>&pound <?php echo $seat[0]->seat_charge; ?></td>
                        <td>
                        	<?php echo $seat[0]->table_end; 
								if($seat[0]->table_end < 20 ){ $to= $seat[0]->table_end; }else { $to=20; }
							?>
                        </td>
                        <td>
                        <select onchange="add_party(this.value,<?php echo $seat[0]->seat_charge; ?>,<?php echo $seat[0]->ticket_class_id; ?>, <?php echo $seat[0]->id; ?>)" name="party_quantity" class="form-control party_quantity"  id="sel1">
                            <option value="0">Quantity</option>
                            <?php for ($i = 1; $i <= $to; $i++) { ?>
                                 <option  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                          </select>
                         </td>
                      </tr>
                        <?php
                             }
                         }
						 
                        ?>
                    </tbody>
                    <? }else{ ?>
                    	<tbody>
                        	<tr>
                            	<td colspan="4" align="center">No additionals.</td>
                            </tr>
                    	</tbody>
                    <? }?>
                  </table>
          <p class="header_awards">DELIVERY</p>
          <table class='table event_table'>
            <tbody>
              <tr>
                <td><input type='radio' value="standard" name="delivery_type" checked="checked">
                  Standard</td>
                <td><input type='radio' value="special" name="delivery_type">
                  Special</td>
                <td><input type='radio' value="eticket" name="delivery_type" disabled="disabled">
                  E-Ticket <span class="ticket-class-tooltip dele" data-event="15" data-ticket-class="1" data-ticket-class-slug="vvip-platinum">?</span></td>
              </tr>
            </tbody>
          </table>
          <div class="table-only outer-additional">
            <h1 id="myorder2">Promo Code</h1>
            <ul>
              <li class="row text-center"> <span style="font-weight:200">If you have a promo code enter it here</span>
                <input type="text" id="customer_promo_code" name="customer_promo_code" class="event-promo-code" value="" placeholder="Promo Code" style="font-weight:200;">
              </li>
            </ul>
          </div>

          <div class="table-only qty text-center" id="myorder">
            <h1>
              <ul>
                <li class="col-md-2 col-xs-2">&nbsp;</li>
                <li class="col-md-3 col-xs-3">Table Type</li>
                <li class="col-md-4 col-xs-4">Unit/Price</li>
                <li class="col-md-3 col-xs-3">Total</li>
                <div class="clearfix"></div>
              </ul>
            </h1>
            <div class='emptty_cart text-center' style="padding-bottom:10px; display: none;">Empty!</div>
            <div class="session-cart-list  text-center">
            <?php
				
				$sessions = $this->session->userdata('tables');
		  		$ses = $this->session->userdata('after_party');  
				$tickets = $this->session->userdata('tickets'); 
			
				 
			  if(!empty($sessions))
			  {	   
			  
			  $co=0;
			   foreach ($sessions as $i => $s) { ?>
              <ul>
                <li class="col-md-2 col-xs-2"><a href="<?php echo base_url('awards/remove_session/' . $co . '/' . $award_detail->event_id) ?>" class="remove_session" title="remove"><i class="fa fa-times" aria-hidden="true"></i> Remove</a></li>
                <li class="col-md-3 col-xs-3"><?php echo $s['class']; ?></li>
                <?php if ($s['section'] == 'Tables Only' || $s['section'] == 'Table Tickets') { ?>
                <li class="col-md-4 col-xs-4"><span style="font-weight:100;"><?php echo $s['section']; ?></span> (<?php echo count($s['table']) ?> * <?php echo $s['table_charge'] ?>)</li>
                <?php } else { ?>
                <li class="col-md-4 col-xs-4"><span style="font-weight:100;"><?php echo $s['section']; ?></span>
                  <?php
					$sum_tickets = 0;
					foreach ($s['seat'] as $ss => $val) {
						
					if ($val != 0) {
					?>
                     <span>(<?php echo $val ?> * <?php echo $s['seat_charge'] ?>)</span>
                  	<?php
								$sum_tickets += $val * $s['seat_charge'];
							}
						}
						$co++;
					}
					?>
                </li>
                
                <li class="col-md-3 col-xs-3">&pound;
                  <?php
					$sum = count($s['table']) * $s['table_charge'];
					if ($s['section'] == 'Tables Only' || $s['section'] == 'Tables Only') {
						echo $sum;
					} else {
						echo $sum_tickets;
					}
					?>
                </li>
                <div class="clearfix"></div>
              </ul>
              <?php }
			  }
			  ?>
              
              <div class="afterParty">
				  <?php
                  if (!empty($ses) || $ses != '') { 
                   ?>
                      <ul>
                      <?php 
                        foreach($ses['after_party'] as $key=>$val)
                        {
                      ?>
                        <li class="col-md-2 col-xs-2"><a onclick="remove_after_party()" href="javascript:void(0)" class="remove_session" title="remove"><i class="fa fa-times" aria-hidden="true"></i> Remove</a></li>
                        <li class="col-md-3 col-xs-3"><?php echo $ses['after_party'][$key]['name']; ?></li>
                        <li class="col-md-4 col-xs-4"><span style="font-weight:100;"></span> (<?php echo $ses['after_party'][$key]['seat_charge']; ?> * <?php echo $ses['after_party'][$key]['total']; ?>)</li>
                        <li class="col-md-3 col-xs-3">£ <?php echo  $ses['after_party'][$key]['seat_charge'] * $ses['after_party'][$key]['total']; ?></li>
                        <div class="clearfix"></div>
                       <?php } ?> 
                      </ul>
                  <?php } ?>
              </div>
              
              <div class="tickets">
               	<?php if (!empty($tickets) || $tickets != '') {  ?>
               	 <ul>
				  <?php 
                    foreach($tickets['tickets'] as $key=>$val)
                    {
					  ?>
					<li class="col-md-2 col-xs-2"><a onclick="remove_after_party()" href="javascript:void(0)" class="remove_session" title="remove"><i class="fa fa-times" aria-hidden="true"></i> Remove</a></li>
					<li class="col-md-3 col-xs-3"><?php echo $tickets['tickets'][$key]['name']; ?></li>
					<li class="col-md-4 col-xs-4"><span style="font-weight:100;"></span> (<?php echo $tickets['tickets'][$key]['seat_charge']; ?> * <?php echo $tickets['tickets'][$key]['total']; ?>)</li>
					<li class="col-md-3 col-xs-3">£ <?php echo  $tickets['tickets'][$key]['seat_charge'] * $tickets['tickets'][$key]['total']; ?></li>
					<div class="clearfix"></div>
				   <?php } ?> 
              	</ul>
             	 <?php } ?>
              </div>
              
              <?php if(empty($sessions) and empty($ses) and empty($tickets)) { ?>
						<div class='emptty_cart text-center' style="padding-bottom:10px;">Empty!</div>
			 <?php } ?>
            </div>
          
			  <a href="javascript:void(0)" class="empty_carts" onclick="empty_cart()" <?php if(($sessions) or ($ses) or ($tickets)) { ?>  style="text-align:center; display:block;"  <?php }else { echo 'style="text-align:center; display:none;"';} ?>><i class="fa fa-times" aria-hidden="true"></i> Remove all</a>
		     
            <!--<a style="text-align:center; display:none;" href="javascript:void(0)" class="empt_carts" onclick="empty_cart()"><i class="fa fa-times" aria-hidden="true"></i> Remove all</a>--> </div>
          
          <button type="button" id="addtocart" onclick="javascript: submitOrder();" class="button-add-to-cart addtocart" >
          <a>Add to Cart</a>
          </button>
        </form>
        <p class="message_text_award"><i class="fa fa-info-circle info_circle" aria-hidden="true"></i> Your order may be subject to a fulfillment fee or postage fee it will be added to your shopping basket</p>
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12"></div>
      <div class="col-md-5 col-sm-5 col-xs-12 header_awards_col2">
      	<?php if(@$award_detail->seat){ ?>
        <p class="header_awards right_header">SEATING PLAN</p>
        <div class="easyzoom easyzoom--overlay"> <a href="uploads/images/full/<?php echo $award_detail->seat; //echo theme_img($award_detail->seat); ?>"> <img class="seats_image"src="uploads/images/full/<?php echo $award_detail->seat; ?> <?php //echo theme_img($award_detail->seat); ?>" alt="" /> </a> </div>
        <a class="fancybox zoom_in" href="#inline1" title="Seating Plan" data-toggle="modal" data-target="#seatModal" >Enlarge <img src=<?php echo theme_img('enlarge.png') ?>></a>
        <p class="venue_header">VENUE: <?php echo @$award_detail->venue; ?></p>
        <?php } ?>
        
        <p class="header_awards header_awards_location">LOCATION</p>
        <!--<div id ="map_canvas" style="height: 400px" ></div>-->
        <iframe style="width:100%;border:0;" src="<?php echo  $additional_event_detail[0]->google_map?: 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d38024084.50591117!2d82.42490264611004!3d54.43105952959735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1495619349837';  ?>" width="600" height="450" frameborder="0" allowfullscreen >
        </iframe>
        <p class='iframe_descp'><span class='iframe_span'><?php echo $award_detail->city; ?></span> <br>
          <?php echo $award_detail->address; ?> </p>
        <p class="header_awards right_header">ORGANIZER</p>
        <!--<p class='organizer_title'>Venue: <?php //echo $award_detail->venue; ?></p>-->
		<div class='row organizer_row'>
			<div class='col-md-8 col-sm-8 col-xs-8'>
				<i class="fa fa-user fa-2x" aria-hidden="true"></i>  <?php echo $additional_event_detail[0]->organizerName; ?>
			</div>
			<div class='col-md-4 col-sm-4 col-xs-4'>
				<i class="fa fa-mobile-phone fa-2x" aria-hidden="true"></i>  <?php echo  $additional_event_detail[0]->organizerContact; ?>
			</div>
		</div>
		<p class='organizer_title'>&nbsp;&nbsp;</p>
        <div class='row organizer_row'>
          <div class='col-md-12 col-sm-12 col-xs-12'>
            <span> <i class="fa fa-envelope fa-2x" aria-hidden="true"></i>  <a href="mailto:<?php echo  $additional_event_detail[0]->organizerEmail; ?>" target="_blank"><?php echo $additional_event_detail[0]->organizerEmail; ?></a></span>
          </div>
		</div>
		<?php
			$website_url = $additional_event_detail[0]->organizerWebsite;
			if($website_url!=''){
				$website_url = str_replace("https://","",$website_url);
				$website_url = str_replace("http://","",$website_url);
				$website_url = "http://".$website_url;
			}
			else{
				$website_url ='';
			}
		?>
		<div class='row organizer_row'>
		  <div class='col-md-12 col-sm-12 col-xs-12'>
			<p> <i class="fa fa-globe fa-2x" aria-hidden="true"></i>  <a href="<?php echo  $website_url; ?>" target="_blank"><?php echo $website_url;  ?></a></p>
          </div>
        </div>
		<?php
			$facebook_url = $additional_event_detail[0]->facebook;
			$twitter_url = $additional_event_detail[0]->tweeter;
			if($facebook_url!=''){
				$facebook_url = str_replace("https://","",$facebook_url);
				$facebook_url = str_replace("http://","",$facebook_url);
				$facebook_url = "https://".$facebook_url;
			}
			else{
				$facebook_url ='';
			}
			if($twitter_url!=''){
				$twitter_url = str_replace("https://","",$twitter_url);
				$twitter_url = str_replace("http://","",$twitter_url);
				$twitter_url = "https://".$twitter_url;
			}
			else{
				$twitter_url ='';
			}
		?>
        <div class='row organizer_row'>
          <div class='col-md-12 col-sm-12 col-xs-12'>
            <p> <i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i>  <!--<img class='social_icon' src="<?php echo theme_img('/fb_icon.fw.png') ?>">-->&nbsp;<a href="<?php echo  $facebook_url; ?>" target="_blank"><?php echo $facebook_url;  ?></a></p>
            <p> <i class="fa fa-twitter fa-2x" aria-hidden="true"></i> <!--<img class='social_icon' src="<?php echo theme_img('/twitter_icon.fw.png') ?>">--><a href="<?php echo $twitter_url; ?>" target="_blank"><?php echo $twitter_url;  ?></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row submit_email2">
      <div class='col-md-12 text-center'>
        <h4>Get top Events and Latest updates in your inbox with Ticket Baby</h4>
        <p>
          <input type="text" name='email_add' placeholder="Enter your email address here" class='form-control email_input'>
          <button class="submit_btn">Submit</button>
        </p>
      </div>
    </div>
  </div>
</section>
<?php foreach ($table_section as $s) { ?>
<?php $rs = $this->db->get_where('tbl_ticket_class', array('id' => $s->ticket_parent_id))->row();   ?>
<div class="modal fade" id="myModal<?php echo $s->seat_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Choose Table</h4>
      </div>
      <form id="tableForm<?php echo $s->seat_id; ?>">
      <input type="hidden" name="event_id" value="<?php echo @$award_detail->event_id; ?>" />
      <input type="hidden" name="event_seat_id" value="<?php echo $s->seat_id; ?>" />
        <div class="modal-body">
          <div class="row modalrow">
            <?php foreach ($s->table as $ts) { ?>
            	<div class="col-md-3 col-sm-3 col-xs-4 modelcols">
				
              <label>Table <?php echo $ts->table_no ?></label>
              
               <?php if ($rs->class == 'Table Tickets') { ?>
              <!--<input class="check_table_box" type="checkbox" id="TableTick_<?php //echo $ts->table_no; ?>" value="<?php //echo $ts->table_no; ?>" name="table[]" <?php //if($ts->seat=='10'){ echo "disabled='disabled' checked='checked'"; } ?>>-->
			   <input class="check_table_box" readonly="readonly" type="checkbox" id="TableTick_<?php echo $ts->table_no; ?>" value="<?php echo $ts->table_no; ?>" name="table[]" <?php if($ts->seat=='10'){ echo "disabled='disabled' checked='checked'"; } ?>>
              <label style="color:green; font-size: 12px;"><?php if($ts->seat=='10' || $ts->status=='2'){ echo "<font color='#FF0000'>SOLD OUT</font>"; }else if($ts->seat > 0){ $T=10-$ts->seat; echo "<font color='#FF0000'>".$T." Available</font>"; }else{ echo "Available"; } ?> </label>
              <?php }else { ?>
               <input class="check_table_box" type="checkbox" id="TableOnly_<?php echo $ts->table_no; ?>" value="<?php echo $ts->table_no; ?>" name="table[]" <?php if($ts->status=='1'){ echo "disabled='disabled' checked='checked'"; } ?>>
               <label style="color:green; font-size: 12px;"><?php if($ts->status=='1'){ echo "<font color='#FF0000'>SOLD OUT</font>"; }else{ echo "Available"; } ?> </label>
              <?php } ?>
              <?php if ($rs->class == 'Table Tickets') { //print_r($ts); ?>
              <select class="select_seats" name="seat[<?php echo $ts->table_no; ?>]"  id="TableTickSeat_<?php echo $ts->table_no; ?>" <?php if($ts->seat=='10' || $ts->status=='2'){ echo "disabled"; } ?> onchange="javascript: SelectTableSeats('<?php echo $ts->table_no; ?>');">
                <option value="0">Select Seat(s)</option>
               <?php 
			   		if($ts->seat==0){ $from=9; }else{  $from=10-$ts->seat; }
					
			   		for($i=1; $i<=$from; $i++)
			   		{
                		echo '<option value='.$i.'>'.$i.'</option>';
					}
					if($ts->seat==0){
			    ?>
				<option id="OptionSel_<?php echo $ts->table_no; ?>" value="">TABLE</option>
					<?php } ?>
              </select>
              <?php } ?>
            </div>
            <?php } ?>
          </div>
        </div>
        <div class="modal-footer">
          <p class='modal_error'>Please Select the Table or Seat(s)</p>
          <button id="CloseModal" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btn<?php echo $s->seat_id; ?>" onclick="select_table(<?php echo $s->seat_id; ?>)" >Select Ticket</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>
<div class="modal fade" id="seatModal" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">SEATING PLAN</h4>
      </div>
      <div class="modal-body"> <img class="seat_modal_img" src="uploads/images/full/<?php echo $award_detail->seat; ?> <?php //echo theme_img($award_detail->seat); ?>" width="100%"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php foreach ($table_section as $ts){
	 $desc = $this->db->get_where('tbl_ticket_info', array('ticket_id' => $ts->tid, 'event_id'=>$award_detail->event_id))->row();
	 
	 $clsname = $this->db->get_where('tbl_ticket_class', array('id' => $desc->ticket_id))->row();
    ?>
<div class="modal fade" id="tablesonlymodal<?php echo $ts->tid; ?>" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content to show Ticket Information -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">About <?php echo $clsname->class; ?> Ticket</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <?php if ($desc->info_image != '') { ?>
            <img class='image_ticket_class' src="<?php echo base_url('uploads/images/full/' . $desc->info_image); ?>">
            <?php } ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12"> <?php echo $desc->description; ?> </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<style>
input[type="checkbox"][readonly] {
  pointer-events: none;
  opacity: 0;
  display: none;
  visibility: none;
}
</style>
<script type="text/javascript">
function submitOrder() { //alert();
	/*if($('input[name="after_party"]').is(':checked') || $('input[name="table_seats"]').is(':checked') || $('input[name="ADDITIONALS"]').is(':checked')){
		$("#sumbit-form-tickets").submit();
	}*/
	
	var SeatID_Table = $("#SeatID_Table").val(); 
	var SeatID_TTickes = $("#SeatID_TTickes").val();
	var SeatID_Tickets = $("#SeatID_Tickets").val();
	var SeatID_APTickets = $("#SeatID_APTickets").val();
	var SeatID = '';
	if(SeatID_Table){
		SeatID = SeatID_Table;
	}
	if(SeatID_TTickes){
		SeatID = SeatID_TTickes;
	}
	if(SeatID_Tickets){
		SeatID = SeatID_Tickets;
	}
	if(SeatID_APTickets){
		SeatID = SeatID_APTickets;
	}
	
	var CartEmpty = $("#CartEmpty").val();
	var CusCoupon = $("#customer_promo_code").val();
	if(CartEmpty==0){
		if(CusCoupon!=""){
			$.ajax({
				type: 'POST',
				dataType: 'json',
				data: {'customer_promo_code':CusCoupon, 'SeatID':SeatID},
				url: '<?php echo base_url("awards/ConfirmCoupon/") ?>',
				success: function(response){
					if(response=='Confirmed'){
						alert("Promo Code Validated Successfully!");
						$("#sumbit-form-tickets").submit();
					}
					else{
						if(confirm("Invalid Promo Code, want to continue without Promo Code?")){
							$("#customer_promo_code").val('');
							$("#sumbit-form-tickets").submit();
						}
						else{
							return false;
						}
					}
				}
			});
		}
		else{
			$("#sumbit-form-tickets").submit();
		}
	}
	else{
		alert("Please Select a Ticket!");
		return false;
	}
}
//SELECT EITHER TABLE OR SEATS
function SelectTableSeats(id){
	var TabTickN = "#TableTick_"+id;
	var TabTickSeat = "#TableTickSeat_"+id;
	var OptionSelect = "#OptionSel_"+id;
	if($(TabTickSeat).val()==""){
		$(TabTickN).prop("checked", "checked");
		$(OptionSelect).text("TABLE SELECTED");
		//$(TabTickSeat).val("");
	}
	else{
		$(TabTickN).prop("checked", false);
		$(OptionSelect).text("");
	}
}

function empty_cart(){
    $.ajax({
        type:'post',
        dataType: 'json',
        url:'<?php echo base_url('awards/empty_cart'); ?>',
        success:function(data){
            $('.ajaxul').hide();
            $('.empty_carts').hide();
            $('.session-cart-list').hide();
            $('.emptty_cart').show();
            $('.empt_carts').hide();
            window.location.reload(true);
        }
    })
}

function changename(val,table){  
	$("#seat"+table).attr("name","seat["+val+"]")

}

function remove_after_party() {
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: '<?php echo base_url("awards/remove_after_party") ?>',
		success: function (data) {
			$('.afterParty').hide();
			$('.empty_cart').css('display','none !important');
			$('.emptyclass').hide();
		}
	});

}

function add_party(total, seat_charge, ticket, SeatID) {
  //if ($('#after_party_radio'+seat_charge).is(':checked')) {
	if ($('input[name="ADDITIONALS"]').is(':checked')) {
		$('.emptyclass').hide();
		var name = $('.name'+ticket).text();
			$.ajax({
			type: 'POST',
			dataType: 'json',
			data: {'ticket':ticket,'name':name,'total':total,'seat_charge':seat_charge, 'SeatID':SeatID },
			url: '<?php echo base_url("awards/add_party/") ?>',
			success: function (data) {
				$('.emptty_cart').hide();
				$('.empty_carts').show();
				$('.afterParty').html(data);
				$('.empt_carts').show();
				
				$('#additionalSelect').text("ADDITIONALS : "+name);
			}
		});
		
	} else {
		var getselectName = $('.name'+ticket).text().toLowerCase().trim();
		alert('Plesae select the '+getselectName+' first.');
	   // $('#sel1').find('option:selected').remove();
	   $('#sel1').val('');
	}
}

function add_tickets(total, seat_charge, ticket, SeatID) {
	//if ($('#tickets'+seat_charge).is(':checked')){
	if ($('input[name="after_party"]').is(':checked')){
		$('.emptyclass').hide();
		var name = $('.name'+ticket).text();
			$.ajax({
			type: 'POST',
			dataType: 'json',
			data: {'ticket':ticket,'name':name,'total':total,'seat_charge':seat_charge, 'SeatID':SeatID },
			url: '<?php echo base_url("awards/add_tickets/") ?>',
			success: function (data){
				$('.emptty_cart').hide();
				$('.empt_carts').show();
				$('.empty_carts').show();
				$('.tickets').html(data);
			}
		});
	} else {
		alert('Plesae select the tickets first.');
		//$('#sel2').find('option:selected').remove();
		$('#sel2').val('');
	}
}
function open_model(id) {
	$('.modal_error').hide();
	$("#tableForm" + id).trigger('reset');
	var ss = id;
	$('#myModal' + id).modal();
	$('input[name="table_seats"]').prop("checked", false);
}

function select_table(id ) {
	//alert(id); return false;
	//$(".btn"+id).attr('disabled','disabled');
	 $('html, body').animate({scrollTop: 1500}, 1000);
	var formID = $("#tableForm" + id).serialize();
	//alert(formID); return false;
	
	if (formID == '') {
		$('.modal_error').show();
		$('input[name="table_seats"]').prop("checked", false);
		return false;
	} else {
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: '<?php echo base_url("events/reserve_seats/") ?>' + '/' + id,
			data: formID,
			success: function (data) {
				$('#myModal' + id).modal('hide');
				 $('.session-cart-list ').append(data);
				 $('.emptyclass').hide();
				 $('.emptty_cart').hide();
				 $('.empty_carts').show();
				 $('input[name="table_seats"]').prop("checked", false);
				 console.log(data);
			}
		});
	}
}
</script>
<?php include 'includes/footer.php'; ?>