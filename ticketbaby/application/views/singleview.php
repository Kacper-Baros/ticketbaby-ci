<?php include 'includes/header.php'; ?>
<section class="award_detail_section">
  <div class="row award_deatail_header">
    <div class="container">
      <div class="row search_payment award_page">
        <div class="col-md-7 col-sm-7 col-xs-12"> 
        
        </div>
        <div class="col-md-5 col-sm-5 col-xs-12 barclayimgcol"> <img src="<?php echo  base_url(); ?>assets/images/barclay.png" class="img-responsive center-block img_payment"> </div>
      </div>
    </div>
  </div>
  <?php //print_r($additional); ?>
	
  <div class="container">
    <div class="row event_detai event_detai_detail">
      <?php if($resulte[0]->image) {?><div class="col-md-4 col-sm-4 col-xs-12"> <img class="event_img" src="<?php echo  base_url(); ?>uploads/images/full/<?php echo $resulte[0]->image; ?>"> </div><?php } ?>
      <div class="col-md-8 col-sm-8 col-xs-12 event_col">
        <h2><?php echo $resulte[0]->name; ?></h2>
        <!--            <p class="underline"></p>-->
        <div class="info_prices">
          <h3 class="award_price">Price - £10.00 - £2000.00</h3>
          <p class="award_time"> <?php  if($resulte[0]->time){ echo "Time - ".$resulte[0]->time; }?></p>
        </div>
        <p class="description_event"><?php echo $resulte[0]->summary; ?></p>
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
              <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $resulte[0]->start_date; ?></div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">Venue</div>
              <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">:  <?php echo $resulte[0]->venue; ?></div>
            </div>
          </li>
          <li>
            <div class="row">
              <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">Address</div>
              <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $resulte[0]->address; ?></div>
            </div>
          </li>
          <?php if($resulte[0]->city){ ?>
          <li>
            <div class="row">
              <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">City</div>
              <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $resulte[0]->city; ?></div>
            </div>
          </li>
           <?php } ?>
           
          <?php if($resulte[0]->country){ ?>
          <li>
            <div class="row">
              <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">Country</div>
              <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $resulte[0]->country; ?></div>
            </div>
          </li>
          <?php } ?>
        </ul>
        <p class="eventinfo-para"><?php echo $resulte[0]->details; ?>.</p>
        <form method="post" action="<?php echo  base_url(); ?>awards/booking_post/8">
          <p class="header_awards">TABLES ONLY - CHOOSE YOUR SECTION</p>
          <table class="table event_table">
            <thead>
              <tr>
                <th>TYPE</th>
                <th>PRICE</th>
                <th>AVAILABLE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input onchange="open_model(8)" name="table_seats" value="8" type="radio">
                  <strong class="class-text">VVIP Platinum</strong> <span class="ticket-class-tooltip" data-toggle="modal" data-target="#tablesonlymodal14">?</span></td>
                <td> £2000</td>
                <td>12</td>
              </tr>
              <tr>
                <td><input onchange="open_model(10)" name="table_seats" value="10" type="radio">
                  <strong class="class-text">VIP Platinum</strong> <span class="ticket-class-tooltip" data-toggle="modal" data-target="#tablesonlymodal15">?</span></td>
                <td> £1500</td>
                <td>10</td>
              </tr>
              <tr>
                <td><input onchange="open_model(9)" name="table_seats" value="9" type="radio">
                  <strong class="class-text">Gold</strong> <span class="ticket-class-tooltip" data-toggle="modal" data-target="#tablesonlymodal16">?</span></td>
                <td> £1000</td>
                <td>10</td>
              </tr>
              <tr>
                <td><input onchange="open_model(14)" name="table_seats" value="14" type="radio">
                  <strong class="class-text">Premium</strong> <span class="ticket-class-tooltip" data-toggle="modal" data-target="#tablesonlymodal17">?</span></td>
                <td> £690</td>
                <td>20</td>
              </tr>
              <tr>
                <td><input onchange="open_model(12)" name="table_seats" value="12" type="radio">
                  <strong class="class-text">Standard</strong> <span class="ticket-class-tooltip" data-toggle="modal" data-target="#tablesonlymodal18">?</span></td>
                <td> £590</td>
                <td>10</td>
              </tr>
            </tbody>
          </table>
          <p class="header_awards">TICKETS - CHOOSE YOUR SECTION</p>
          <table class="table event_table">
            <thead>
              <tr>
                <th>TYPE</th>
                <th>PRICE</th>
                <th>AVAILABLE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input onchange="open_model(18)" name="table_seats" value=" 18" type="radio">
                  <strong class="class-text"> Premium</strong> <span class="ticket-class-tooltip ticky" data-toggle="modal" data-target="#tablesonlymodal21">?</span></td>
                <td> £69</td>
                <td>10</td>
              </tr>
              <tr>
                <td><input onchange="open_model(13)" name="table_seats" value=" 13" type="radio">
                  <strong class="class-text"> Standard</strong> <span class="ticket-class-tooltip ticky" data-toggle="modal" data-target="#tablesonlymodal21">?</span></td>
                <td> £59</td>
                <td>10</td>
              </tr>
            </tbody>
          </table>
          <p class="header_awards">ADDITIONALS</p>
          <table class="table event_table additio">
            <thead>
              <tr>
                <th>TYPE</th>
                <th>PRICE</th>
                <th>Quantity</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <input name="after_party_price" value="10" type="hidden">
                <td><input id="after_party_radio" name="after_party" type="radio">
                  after party <span class="ticket-class-tooltip" data-toggle="modal" data-target="#afterpartymodal">?</span></td>
                <td> £ 10</td>
                <td><select onchange="add_party(this.value,10)" name="party_quantity" class="form-control party_quantity" id="sel1">
                    <option value="0">Quantity</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                  </select></td>
              </tr>
            </tbody>
          </table>
          <p class="header_awards">DELIVERY</p>
          <table class="table event_table">
            <tbody>
              <tr>
                <td><input value="standard" name="delivery_type" checked="checked" type="radio">
                  Standard</td>
                <td><input value="special" name="delivery_type" type="radio">
                  Special</td>
                <td><input value="eticket" name="delivery_type" disabled="disabled" type="radio">
                  E-Ticket <span class="ticket-class-tooltip dele" data-event="15" data-ticket-class="1" data-ticket-class-slug="vvip-platinum">?</span></td>
              </tr>
            </tbody>
          </table>
          <div class="table-only outer-additional">
            <h1 id="myorder2">Promo Code</h1>
            <ul>
              <li class="row text-center"> <span style="font-weight:200">If you have a promo code enter it here</span>
                <input name="customer_promo_code" class="event-promo-code" value="" placeholder="Promo Code" style="font-weight:200;" type="text">
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
            <div class="emptty_cart text-center" style="padding-bottom:10px; display: none;">Empty!</div>
            <div class="session-cart-list  text-center">
              <div class="emptyclass" style="padding-bottom:10px;">Empty!</div>
            </div>
            <a style="text-align:center; display:none;" href="javascript:void(0)" class="empt_carts" onclick="empty_cart()"><i class="fa fa-times" aria-hidden="true"></i> Remove all</a> </div>
          <button type="submit" class="addtocart">
          <a>Add to Cart</a>
          </button>
        </form>
        <p class="message_text_award"><i class="fa fa-info-circle info_circle" aria-hidden="true"></i> Your order may be subject to a fulfilment fee or postage fee it will be added to your shopping basket</p>
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12"></div>
      <div class="col-md-5 col-sm-5 col-xs-12 header_awards_col2">
        <p class="header_awards right_header">SEATING PLAN</p>
        <div class="easyzoom easyzoom--overlay is-ready"> <a href="<?php echo  base_url(); ?>assets/images/seats.fw.png"> <img class="seats_image" src="<?php echo  base_url(); ?>assets/images/seats.fw.png" alt=""> </a> </div>
        <a class="fancybox zoom_in" href="#inline1" title="Seating Plan" data-toggle="modal" data-target="#seatModal">Enlarge <img src="<?php echo  base_url(); ?>assets/images/enlarge.png"></a>
        <p class="venue_header">VENUE : ICC</p>
        <p class="header_awards header_awards_location">LOCATION</p>
        <!--<div id ="map_canvas" style="height: 400px" ></div>-->
          <?php if(@$additional[0]->google_map){ ?>
        	<iframe style="width:100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2430.0128387969903!2d-1.9124796847028238!3d52.478903247027326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870bc8c8cd2ec93%3A0xea3880348237a86f!2sThe+International+Convention+Centre!5e0!3m2!1sen!2snp!4v1489685023659" allowfullscreen="" width="600" height="450" frameborder="0"></iframe>
        <?php } ?>
        <p class="iframe_descp"><span class="iframe_span">Birmingham</span> <br>
          Birmingham  International Convention Centre </p>
        <p class="header_awards right_header">ORGANIZER</p>
        <p class="organizer_title">XEM</p>
        <div class="row organizer_row">
          <div class="col-md-6 col-sm-6 col-xs-12 xemcol1">
            <p> <i class="fa fa-eye" aria-hidden="true"></i><a href="#"> View Organizer Profile</a> </p>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 xemcol2">
            <p> <i class="fa fa-envelope-o" aria-hidden="true"></i><a href="#">Contact Organizer</a></p>
          </div>
        </div>
        <div class="row organizer_row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <p> <img class="social_icon" src="<?php echo  base_url(); ?>assets/images//fb_icon.fw.png"><a>www.facebook.com/mvisaawards</a></p>
            <p><img class="social_icon" src="<?php echo  base_url(); ?>assets/images//twitter_icon.fw.png"><a>@mvisas</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row submit_email">
      <div class="col-md-12 text-center">
        <h4>Get top Events and Latest updates in your inbox with Ticket Baby</h4>
        <p>
          <input name="email_add" placeholder="Enter your email address here" class="form-control email_input" type="text">
          <button class="submit_btn">Submit</button>
        </p>
      </div>
    </div>
  </div>
</section>



<?php include 'includes/footer.php' ?>