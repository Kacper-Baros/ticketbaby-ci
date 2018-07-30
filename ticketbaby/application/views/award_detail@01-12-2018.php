<?php include 'includes/header.php'; 
	$additional_event_detail = $this->db->get_where('additional_event_detail', array('event_id' =>$award_detail->event_id))->result();
	
?>
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
        <form method="post" action="<?php echo base_url('awards/booking_post/' .@$award_detail->event_id) ?>">
         
          <?php  foreach ($table_section as $t)
				   {
                 	$tick = $this->db->get_where('tbl_ticket_class', array('id' => $t->ticket_parent_id))->row();
                    if ($tick->class == 'Table')
					 {
						 $tbl=1;
					 }
				   }
				   
				if(@$tbl==1)
				{	   
		  ?>
					  
				  <p class="header_awards">TABLES ONLY - CHOOSE YOUR SECTION</p>
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
							if ($tick->class == 'Table') {
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
					if ($tick->class == 'Table Ticket') 
					{
						$tkt=1;
					}
				}
				
				if(@$tkt==1)
				{	
			?>
         		 <p class="header_awards">TABLE TICKETS - CHOOSE YOUR SECTION</p>
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
					if ($tick->class == 'Table Ticket') {
				?>
                	
                      <tr>
                        <td><input type='radio' onchange="open_model(<?php echo $ts->seat_id; ?>)" id="ticket_seats<?php echo $ts->seat_charge; ?>" name="table_seats" value=" <?php echo $ts->seat_id ?>">
                          <strong class="class-text"> <?php echo ' ' . $ts->ticket_class; ?></strong> <span class="ticket-class-tooltip ticky" data-toggle="modal" data-target="#tablesonlymodal<?php echo $t->tid; ?>">?</span></td>
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
			  <p class="header_awards">TICKETS</p>
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
								 <strong class="class-text name<?php echo $seat[0]->ticket_class_id; ?>"><?php echo $val->class; ?></strong> <span class="ticket-class-tooltip"data-toggle="modal" data-target="#afterpartymodal">?</span></td>
							<td>&pound <?php echo $seat[0]->seat_charge; ?></td>
							<td><?php echo $seat[0]->table_end; ?></td>
							<td><select onchange="add_tickets(this.value,<?php echo $seat[0]->seat_charge; ?>,<?php echo $seat[0]->ticket_class_id; ?>)" name="party_quantity" class="form-control party_quantity"  id="sel2">
								<option value="0">Quantity</option>
								<?php
										if($seat[0]->table_end < 10){ $to=$seat[0]->table_end;}else{ $to=10; }
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
			if(@$seet==1)
			{	
			?>
          		<p class="header_awards">ADDITIONALS</p>
                <table class='table event_table additio'>
                    <thead>
                    <th>TYPE</th>
                      <th>PRICE</th>
                      <th>AVAILABLE</th>
                      <th>Quantity</th>
                        </thead>
                          <tbody>
                      <?php
                        $party = $this->db->get_where('tbl_ticket_class', array('parent_id' =>27))->result();
						
						/*echo "<pre>";
						print_r($award_detail);
						print_r($party);
						echo "</pre>";
						exit;*/

                        foreach($party as $val)
                        {
                            @$seat= $this->db->get_where('tbl_event_seats', array('event_id' =>$award_detail->event_id,'ticket_class_id'=>$val->id))->result();
							//echo $this->db->last_query()."<br />";
                            if(@$seat)
                            {
								
								//exit;
								
                            ?>
                            
                      <tr>
                        <input type="hidden" name="after_party_price" value="<?php echo $seat[0]->seat_charge; ?>">
                        <td><input type='radio' id="after_party_radio<?php echo $seat[0]->seat_charge; ?>" name="ADDITIONALS">
                             <strong class="class-text name<?php echo $seat[0]->ticket_class_id; ?>"><?php echo $val->class; ?></strong> <span class="ticket-class-tooltip"data-toggle="modal" data-target="#afterpartymodal">?</span></td>
                        <td>&pound <?php echo $seat[0]->seat_charge; ?></td>
                        <td>
                        	<?php echo $seat[0]->table_end; 
								if($seat[0]->table_end < 20 ){ $to= $seat[0]->table_end; }else { $to=20; }
							?>
                        </td>
                        <td>
                        <select onchange="add_party(this.value,<?php echo $seat[0]->seat_charge; ?>,<?php echo $seat[0]->ticket_class_id; ?>)" name="party_quantity" class="form-control party_quantity"  id="sel1">
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
                  </table>
          <?php } 
		 	?>
          
          
          
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
                <input type="text" name="customer_promo_code" class="event-promo-code" value="" placeholder="Promo Code" style="font-weight:200;" >
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
                <li class="col-md-2 col-xs-2"><a href="<?php echo base_url('awards/remove_session/' . $i . '/' . $award_detail->event_id) ?>" class="remove_session" title="remove"><i class="fa fa-times" aria-hidden="true"></i> Remove</a></li>
                <li class="col-md-3 col-xs-3"><?php echo $s['class']; ?></li>
                <?php if ($s['section'] == 'Table') { ?>
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
					if ($s['section'] == 'Table') {
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
          
          <button type="submit"  class="button-add-to-cart addtocart" >
          <a>Add to Cart</a>
          </button>
        </form>
        <p class="message_text_award"><i class="fa fa-info-circle info_circle" aria-hidden="true"></i> Your order may be subject to a fulfilment fee or postage fee it will be added to your shopping basket</p>
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12"></div>
      <div class="col-md-5 col-sm-5 col-xs-12 header_awards_col2">
      	<?php if(@$award_detail->seat){ ?>
        <p class="header_awards right_header">SEATING PLAN</p>
        <div class="easyzoom easyzoom--overlay"> <a href="uploads/images/full/<?php echo $award_detail->seat; //echo theme_img($award_detail->seat); ?>"> <img class="seats_image"src="uploads/images/full/<?php echo $award_detail->seat; ?> <?php //echo theme_img($award_detail->seat); ?>" alt="" /> </a> </div>
        <a class="fancybox zoom_in" href="#inline1" title="Seating Plan" data-toggle="modal" data-target="#seatModal" >Enlarge <img src=<?php echo theme_img('enlarge.png') ?>></a>
        <p class="venue_header">VENUE : ICC</p>
        <?php } ?>
        
        <p class="header_awards header_awards_location">LOCATION</p>
        <!--<div id ="map_canvas" style="height: 400px" ></div>-->
     <!--   <iframe style="width:100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2430.0128387969903!2d-1.9124796847028238!3d52.478903247027326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870bc8c8cd2ec93%3A0xea3880348237a86f!2sThe+International+Convention+Centre!5e0!3m2!1sen!2snp!4v1489685023659" width="600" height="450" frameborder="0" style="border:0" allowfullscreen>
        </iframe>-->
        <iframe style="width:100%;border:0;" src="<?php echo  $additional_event_detail[0]->google_map?: 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d38024084.50591117!2d82.42490264611004!3d54.43105952959735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1495619349837';  ?>" width="600" height="450" frameborder="0" allowfullscreen >
        </iframe>
        <p class='iframe_descp'><span class='iframe_span'><?php echo $award_detail->city; ?></span> <br>
          <?php echo $award_detail->address; ?> </p>
        <p class="header_awards right_header">ORGANIZER</p>
        <p class='organizer_title'><?php echo $award_detail->venue; ?> <!--XEM--></p>
        <div class='row organizer_row'>
          <div class='col-md-6 col-sm-6 col-xs-12 xemcol1'>
            <p> <i class="fa fa-eye" aria-hidden="true"></i><a href="#"> View Organizer Profile</a> </p>
          </div>
          <div class='col-md-6 col-sm-6 col-xs-12 xemcol2'>
            <p> <i class="fa fa-envelope-o" aria-hidden="true"></i><a href="#">Contact Organizer</a></p>
          </div>
        </div>
        <div class='row organizer_row'>
          <div class='col-md-12 col-sm-12 col-xs-12'>
            <p> <img class='social_icon' src="<?php echo theme_img('/fb_icon.fw.png') ?>"><a><?php echo  @$additional_event_detail[0]->facebook; ?></a></p>
            <p><img class='social_icon' src="<?php echo theme_img('/twitter_icon.fw.png') ?>"><a><?php echo  @$additional_event_detail[0]->tweeter; ?></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row submit_email">
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
              
               <?php if ($rs->class == 'Table Ticket') { ?>
              <input class="check_table_box" type="checkbox" value="<?php echo $ts->table_no; ?>" name="table[]" <?php if($ts->seat=='10'){ echo "disabled='disabled' checked='checked'"; } ?>>
              <label style="color:green; font-size: 12px;"><?php if($ts->seat=='10'){ echo "<font color='#FF0000'>Sold Out</font>"; }else if($ts->seat > 0){ echo 10-$ts->seat." Seat available"; }else{ echo "available"; } ?> </label>
              <?php }else { ?>
               <input class="check_table_box" type="checkbox" value="<?php echo $ts->table_no; ?>" name="table[]" <?php if($ts->status=='1'){ echo "disabled='disabled' checked='checked'"; } ?>>
               <label style="color:green; font-size: 12px;"><?php if($ts->status=='1'){ echo "<font color='#FF0000'>Sold Out</font>"; }else{ echo "available"; } ?> </label>
              <?php } ?>
              
              
              <?php if ($rs->class == 'Table Ticket') { ?>
              <select class="select_seats" name="seat[<?php echo $ts->table_no; ?>]"  id="<?php echo $ts->seat; ?>" <?php if($ts->seat=='10'){ echo "disabled"; } ?>>
                <option value="0">Select Seat</option>
               <?php 
			   		
			   		if($ts->seat==0){ $from=10; }else{  $from=10-$ts->seat; }
					
			   		for($i=1; $i<=$from; $i++)
			   		{
                		echo '<option value='.$i.'>'.$i.'</option>';
					}
			    ?>
              </select>
              <?php } ?>
            </div>
            <?php } ?>
          </div>
        </div>
        <div class="modal-footer">
          <p class='modal_error'>Please Select the table</p>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<div class="modal fade" id="afterpartymodal" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">After party</h4>
      </div>
      <div class="modal-body">
        <p>*Please note you will be only admitted to after party if you have a valid awards show ticket 
          Do Not purchase after party tickets if you done have a valid MVISA Ticket</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php foreach ($table_section as $ts) { 
	 $desc = $this->db->get_where('tbl_ticket_class', array('id' => $ts->tid))->row();
    ?>
<div class="modal fade" id="tablesonlymodal<?php echo $ts->tid; ?>" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $desc->class; ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <?php if ($desc->image != '') { ?>
            <img class='image_ticket_class' src="<?php echo base_url('uploads/images/full/' . $desc->image); ?>">
            <?php } ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12"> <?php echo $desc->info; ?> </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php } 
?>

<script language="javascript">

function empty_cart(){
    $.ajax({
        type:'post',
        dataType: 'json',
        url:'<?php echo base_url('awards/empty_cart'); ?>',
        success:function(data){
            $('.ajaxul').hide();
            $('.empty_carts').hide();
            $('.session-cart-list ').hide();
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

   function add_party(total, seat_charge, ticket)
	 {
        if ($('#after_party_radio'+seat_charge).is(':checked')) {
			$('.emptyclass').hide();
			var name = $('.name'+ticket).text();
	            $.ajax({
                type: 'POST',
                dataType: 'json',
				data: {'ticket':ticket,'name':name,'total':total,'seat_charge':seat_charge },
                url: '<?php echo base_url("awards/add_party/") ?>',
                success: function (data) {
                    $('.emptty_cart').hide();
                    $('.empty_carts').show();
                    $('.afterParty').html(data);
                    $('.empt_carts').show();
                }
            });
			
        } else {
			
			
			
            alert('plesae select the after party first.');
            $('#sel1').find('option:selected').remove();
        }
    }

	function add_tickets(total, seat_charge, ticket)
	 {
        if ($('#tickets'+seat_charge).is(':checked'))
		{
			$('.emptyclass').hide();
			var name = $('.name'+ticket).text();
	            $.ajax({
                type: 'POST',
                dataType: 'json',
				data: {'ticket':ticket,'name':name,'total':total,'seat_charge':seat_charge },
                url: '<?php echo base_url("awards/add_tickets/") ?>',
                success: function (data) {
                    $('.emptty_cart').hide();
                    $('.empt_carts').show();
					$('.empty_carts').show();
                    $('.tickets').html(data);
                    
                }
            });
			
        } else {
            alert('plesae select the tickets first.');
            $('#sel2').find('option:selected').remove();
        }
    }
	
    function open_model(id) {
        $('.modal_error').hide();
        $("#tableForm" + id).trigger('reset');
        var ss = id;
        $('#myModal' + id).modal();
    }


    function select_table(id) {
		$(".btn"+id).attr('disabled','disabled');
		 $('html, body').animate({scrollTop: 1500}, 1000);
        var formID = $("#tableForm" + id).serialize();
        if (formID == '') {
            $('.modal_error').show();
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
                     console.log(data);
                }
            });
        }
    }
</script>
<?php include 'includes/footer.php'; ?>