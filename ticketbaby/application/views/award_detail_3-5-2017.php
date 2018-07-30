<?php 


include 'includes/header.php'; ?>

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
                <div class="col-md-5 col-sm-5 col-xs-12 barclayimgcol">
                    <img src="<?php echo theme_img('barclay.png'); ?>" class="img-responsive center-block img_payment">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row event_detai event_detai_detail">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <?php if ($award_detail->image2 == '') { ?>
                    <img class="event_img" src="<?php echo base_url('uploads/images/full/' . $award_detail->image); ?>">
                <?php } else { ?>
                    <img class="event_img" src="<?php echo base_url('uploads/images/full/' . $award_detail->image2); ?>">
                <?php } ?>

            </div>



            <div class="col-md-8 col-sm-8 col-xs-12 event_col">
                <h2><?php echo strtoupper($award_detail->name) ?></h2> 
    <!--            <p class="underline"></p>-->
                <div class="info_prices">
                    <h3 class="award_price">Price - &pound;10.00 - &pound;2000.00</h3>
                    <p class="award_time">Time - <?php echo strtoupper($award_detail->time); ?></p>
                </div>
                <p class="description_event"><?php echo $award_detail->details; ?></p>
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
                            <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $award_detail->start_date; ?></div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">Venue</div>
                            <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $award_detail->venue; ?></div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">Address</div>
                            <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $award_detail->address; ?></div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">City</div>
                            <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $award_detail->city; ?></div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">Country</div>
                            <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">: <?php echo $award_detail->country; ?></div>
                        </div>
                    </li>

                </ul>

                <p class="eventinfo-para"><?php echo $award_detail->summary; ?></p>

                <form method="post" action="<?php echo base_url('awards/booking_post/' . $award_detail->event_id) ?>">
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
                                        <td> <input type='radio' onchange="open_model(<?php echo $t->seat_id; ?>)" name="table_seats" value="<?php echo $t->seat_id ?>"> <strong class="class-text"><?php echo $t->ticket_class; ?></strong> 
                                            <span class="ticket-class-tooltip" data-toggle="modal" data-target="#tablesonlymodal<?php echo $t->tid; ?>">?</span>
                                        </td>
                                        <td> &pound;<?php echo $t->table_charge; ?></td>
                                        <td><?php echo $t->available_table; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    <p class="header_awards">TICKETS - CHOOSE YOUR SECTION</p>
                    <table class='table event_table'>
                        <thead>
                        <th>TYPE</th>
                        <th>PRICE</th>
                        <th>AVAILABLE</th>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($table_section as $ts) {
                                $tick = $this->db->get_where('tbl_ticket_class', array('id' => $ts->ticket_parent_id))->row();
                                if ($tick->class == 'Ticket') {
                                    ?>
                                    <tr>
                                        <td> <input type='radio' onchange="open_model(<?php echo $ts->seat_id; ?>)" name="table_seats" value=" <?php echo $ts->seat_id ?>"><strong class="class-text"> <?php echo ' ' . $ts->ticket_class; ?></strong>
                                            <span class="ticket-class-tooltip ticky" data-toggle="modal" data-target="#tablesonlymodal<?php echo $t->tid; ?>">?</span>
                                        </td>
                                        <td> &pound;<?php echo $ts->seat_charge; ?></td>
                                        <td><?php echo $ts->available_table; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                    $ses = $this->session->userdata('after_party');
                    ?>

                    <p class="header_awards">ADDITIONALS</p>
                    <table class='table event_table additio'>
                        <thead>
                        <th>TYPE</th>
                        <th>PRICE</th>
                        <th>Quantity</th>
                        </thead>
                        <tbody>



                            <?php
                            foreach ($table_party as $tp) {
                                //  echo $ts->tid;
                                $party = $this->db->get_where('tbl_ticket_class', array('id' => $tp->tid))->row();
                                if ($party->class == 'after party') {
                                    ?>
                                    <tr>
                                <input type="hidden" name="after_party_price" value="<?php echo $tp->seat_charge; ?>">
                                <td> <input type='radio' id="after_party_radio" name="after_party"> <?php echo $tp->ticket_class; ?> <span class="ticket-class-tooltip"data-toggle="modal" data-target="#afterpartymodal">?</span></td>
                                <td> &pound; <?php echo $tp->seat_charge; ?></td>
                                <td>
                                    <select onchange="add_party(this.value,<?php echo $tp->seat_charge ?>)" name="party_quantity" class="form-control party_quantity" id="sel1">
                                        <option value="0">Quantity</option>
                                        <?php for ($i = 1; $i <= 20; $i++) { ?>
                                            <option  value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                    </table>

                    <p class="header_awards">DELIVERY</p>
                    <table class='table event_table'>
                        <tbody>
                            <tr>
                                <td> <input type='radio' value="standard" name="delivery_type" checked="checked"> Standard</td>
                                <td> <input type='radio' value="special" name="delivery_type"> Special</td>
                                <td> <input type='radio' value="eticket" name="delivery_type" disabled="disabled"> E-Ticket <span class="ticket-class-tooltip dele" data-event="15" data-ticket-class="1" data-ticket-class-slug="vvip-platinum">?</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="table-only outer-additional">
                        <h1 id="myorder2">Promo Code</h1>
                        <ul>         
                            <li class="row text-center">
                                <span style="font-weight:200">If you have a promo code enter it here</span>
                                <input type="text" name="customer_promo_code" class="event-promo-code" value="" placeholder="Promo Code" style="font-weight:200;" >
                            </li>
                        </ul>
                    </div>


                    <?php $sessions = $this->session->userdata('tables'); ?>

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
                            <?php if (empty($sessions)) { ?>
                                <div class='emptyclass' style="padding-bottom:10px;">Empty!</div>
                            <?php } else { ?>

                               
                                <?php foreach ($sessions as $i => $s) { ?>
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
                                            }
                                            ?>
                                        </li>
                                        <li class="col-md-3 col-xs-3">&pound; <?php
                                            $sum = count($s['table']) * $s['table_charge'];
                                            if ($s['section'] == 'Table') {
                                                echo $sum;
                                            } else {
                                                echo $sum_tickets;
                                            }
                                            ?></li>
                                        <div class="clearfix"></div>
                                    </ul>
                                <?php }
                                ?>
  						<a href="javascript:void(0)" class="empty_carts" onclick="empty_cart()"><i class="fa fa-times" aria-hidden="true"></i> Remove all</a>
                            <?php }
                            ?>
                            <?php if (!empty($ses) || $ses != '') { ?>
                                <ul class="afterParty">
                                    <li class="col-md-2 col-xs-2"><a onclick="remove_after_party()" href="javascript:void(0)" class="remove_session" title="remove"><i class="fa fa-times" aria-hidden="true"></i> Remove</a></li>
                                    <li class="col-md-3 col-xs-3"><?php echo $ses['name']; ?></li>
                                    <li class="col-md-4 col-xs-4"><span style="font-weight:100;"></span> (<?php echo $ses['total_seats'] ?> * <?php echo $ses['seat_charge'] ?>)</li>
                                    <li class="col-md-3 col-xs-3">£ <?php echo $ses['total_seats'] * $ses['seat_charge']; ?></li>
                                    <div class="clearfix"></div>
                                </ul>
                            <?php } ?>




                        </div>

                           <a style="text-align:center; display:none;" href="javascript:void(0)" class="empt_carts" onclick="empty_cart()"><i class="fa fa-times" aria-hidden="true"></i> Remove all</a>
                    </div>

                    <?php
                    $sessions = $this->session->userdata('tables');
                    ?>

                    <button type="submit" class="addtocart" class="button-add-to-cart" ><a>Add to Cart</a></button>

                </form>

                <p class="message_text_award"><i class="fa fa-info-circle info_circle" aria-hidden="true"></i>
                    Your order may be subject to a fulfilment fee or postage fee it will be added to your shopping basket</p>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-12"></div>
            <div class="col-md-5 col-sm-5 col-xs-12 header_awards_col2">
                <p class="header_awards right_header">SEATING PLAN</p>

                <div class="easyzoom easyzoom--overlay">

                    <a href="<?php echo theme_img('seats.fw.png') ?>">
                        <img class="seats_image" src="<?php echo theme_img('seats.fw.png') ?>" alt="" />
                    </a>

                </div>
                <a class="fancybox zoom_in" href="#inline1" title="Seating Plan" data-toggle="modal" data-target="#seatModal" >Enlarge <img src=<?php echo theme_img('enlarge.png') ?>></a>    

                <p class="venue_header">VENUE : ICC</p>

                <p class="header_awards header_awards_location">LOCATION</p>
                <!--<div id ="map_canvas" style="height: 400px" ></div>-->
                <iframe style="width:100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2430.0128387969903!2d-1.9124796847028238!3d52.478903247027326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870bc8c8cd2ec93%3A0xea3880348237a86f!2sThe+International+Convention+Centre!5e0!3m2!1sen!2snp!4v1489685023659" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                <p class='iframe_descp'><span class='iframe_span'>Birmingham</span>
                    <br>
                    Birmingham  International Convention Centre
                </p>

                <p class="header_awards right_header">ORGANIZER</p>
                <p class='organizer_title'>XEM</p>
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
                        <p> <img class='social_icon' src="<?php echo theme_img('/fb_icon.fw.png') ?>"><a>www.facebook.com/mvisaawards</a></p>
                        <p><img class='social_icon' src="<?php echo theme_img('/twitter_icon.fw.png') ?>"><a>@mvisas</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="container">
        <div class="row submit_email">
            <div class='col-md-12 text-center'>
                <h4>Get top Events and Latest updates in your inbox with Ticket Baby</h4>
                <p> <input type="text" name='email_add' placeholder="Enter your email address here" class='form-control email_input'>
                    <button class="submit_btn">Submit</button>
                </p>
            </div>
        </div>
    </div>

</section>


<?php foreach ($table_section as $s) { ?>

    <?php $rs = $this->db->get_where('tbl_ticket_class', array('id' => $s->ticket_parent_id))->row();
    ?>


    <div class="modal fade" id="myModal<?php echo $s->seat_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Choose Table</h4>
                </div>
                <form id="tableForm<?php echo $s->seat_id; ?>">
                    <div class="modal-body">
                        <div class="row modalrow">
                            <?php foreach ($s->table as $ts) {
                                ?>
                                <div class="col-md-3 col-sm-3 col-xs-4 modelcols">
                                    <label>Table <?php echo $ts->table_no ?></label>
                                    <input class="check_table_box" type="checkbox" value="<?php echo $ts->table_no; ?>" name="table[]">
                                    <label style="color:green; font-size: 12px;">available</label>
                                    <?php if ($rs->class == 'Ticket') { ?>
                                        <select class="select_seats" name="seat[<?php echo $ts->table_no; ?>]">
                                            <option value="0">Select Seat</option>
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
                                        </select>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>





                    <div class="modal-footer">
                        <p class='modal_error'>Please Select the table</p>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="select_table(<?php echo $s->seat_id; ?>)" >Select Ticket</button>
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
            <div class="modal-body">
                <img class="seat_modal_img" src="<?php echo theme_img('seats.fw.png') ?>">
            </div>
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

<?php foreach ($table_section as $ts) { ?>
    <?php $desc = $this->db->get_where('tbl_ticket_class', array('id' => $ts->tid))->row();
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
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php echo $desc->info; ?>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
<?php } ?>


<script>


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
            
        }
    })
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


    function add_party(total, seat_charge) {
        if ($('#after_party_radio').is(':checked')) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo base_url("awards/add_party/") ?>' + '/' + total + '/' + seat_charge,
                success: function (data) {
                    $('.afterParty').hide();
                    $('.session-cart-list ').show();
                    $('.session-cart-list ').append(data);
                    
                }
            });

        } else {
            alert('plesae select the after party first.');
            $('#sel1').find('option:selected').remove();
        }
    }

    function open_model(id) {
        $('.modal_error').hide();
        $("#tableForm" + id).trigger('reset');
        var ss = id;
        $('#myModal' + id).modal();
    }

    function select_table(id) {
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
                     $('.session-cart-list ').show();
                     $('.emptyclass').hide();
                    $('html, body').animate({scrollTop: 1500}, 1000);
                    $('.emptty_cart').hide();
                     $('.empt_carts').show();
                     $('.empty_carts').hide();
                 //   window.location.reload(true);
                 //   window.location.hash = '#myorder2';
                    console.log(data);
                  
                }
            });
        }
    }



</script>




<?php include 'includes/footer.php'; ?>