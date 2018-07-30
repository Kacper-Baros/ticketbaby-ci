<?php include 'includes/header.php'; ?>

<section class="award_detail_section">
    <div class="container">
        <div class="row event_detai event_detai_detail">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <img class="event_img" src="<?php echo base_url('uploads/images/full/' . $event_detail->image); ?>">
            </div>


            <div class="col-md-8 col-sm-8 col-xs-12 event_col">
                <h2><?php echo $event_detail->name; ?></h2> 
    <!--            <p class="underline"></p>-->
                <div class="info_prices">
                    <h3 class="award_price"><b>Price - $10.00 - $2000.00</b></h3>
                    <p class="award_time">Time - 6:30 PM</p>
                </div>
                <p class="description_event"><?php echo $event_detail->details; ?></p>
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
                            <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">:<?php echo $event_detail->start_date; ?></div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">Venue</div>
                            <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">:<?php echo $event_detail->venue; ?></div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">Address</div>
                            <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">:<?php echo $event_detail->address; ?></div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">City</div>
                            <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">:<?php echo $event_detail->city; ?></div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12 infoeventcol">Country</div>
                            <div class="col-md-7 col-sm-7 col-xs-12 infoeventcol2">:<?php echo $event_detail->country; ?></div>
                        </div>
                    </li>
                </ul>

                <p class="eventinfo-para">Welcome to the Movie Video &amp; Screen awards. For a limited time, we are selling “Early Bird” tickets at last year’s prices but these are going rise as venue cost has increased. Early Bird tickets will be available till 1st May 2017 and are limited. Please book them early as when they are gone there are gone!! The increase will only affect Premium and Standard tickets.</p>
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
                                    <td> <input type='radio' onchange="open_model(<?php echo $t->seat_id; ?>)" name="table_seats" value="<?php echo $t->seat_id ?>"> <?php echo $t->ticket_class; ?></td>
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
                                    <td> <input type='radio' onchange="open_model(<?php echo $ts->seat_id; ?>)" name="table_seats" value="<?php echo $ts->seat_id ?>"> <?php echo $ts->ticket_class; ?></td>
                                    <td> &pound;<?php echo $ts->table_charge; ?></td>
                                    <td><?php echo $ts->available_table; ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <p class="header_awards">ADDITIONALS</p>
                <table class='table event_table'>
                    <thead>
                    <th>TYPE</th>
                    <th>PRICE</th>
                    <th>Quantity</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <input type='radio' name="s"> After Party</td>
                            <td>200</td>
                            <td>
                                <select class="form-control" id="sel1">
                                    <option selected>Quantity</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                </select></td>
                        </tr>

                    </tbody>
                </table>

                <p class="header_awards">DELEVERY</p>
                <table class='table event_table'>
                    <tbody>
                        <tr>
                            <td> <input type='radio' name="s"> Standard</td>
                            <td> <input type='radio' name="s"> Special</td>
                            <td> <input type='radio' name="s"> E-Ticket</td>
                        </tr>

                    </tbody>
                </table>


                <?php $sessions = $this->session->userdata('tables'); ?>
                

                <?php // debug($sessions); ?>
                <div class="row totalrow">
                    <div class="col-md-3 col-sm-3 col-xs-3"></div>
                    <div class="col-md-3 col-sm-3 col-xs-3">Table Type</div>
                    <div class="col-md-3 col-sm-3 col-xs-3">Unit/Price</div>
                    <div class="col-md-3 col-sm-3 col-xs-3">Total</div>
                </div>

              
                <?php if ($sessions) { ?>
                    <?php foreach ($sessions['table'] as $s => $j) { ?>
                        <div class="row totalrowitem">
                            <div class="col-md-3 col-sm-3 col-xs-3">Delete(X)</div>
                            <div class="col-md-3 col-sm-3 col-xs-3"><?php echo $sessions['class']; ?></div>
                            <div class="col-md-3 col-sm-3 col-xs-3">20</div>
                            <div class="col-md-3 col-sm-3 col-xs-3"><?php echo $sessions['table_charge']; ?></div>
                        </div>
                        <?php
                    }
                }
                ?>

                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-3"></div>
                    <div class="col-md-3 col-sm-3 col-xs-3"></div>
                    <div class="col-md-3 col-sm-3 col-xs-3"></div>
                    <div class="col-md-3 col-sm-3 col-xs-3"><?php echo $total = $sessions['table_charge'] * count($sessions['table']); ?></div>
                </div>
                <a class="addtocart" href="javascript:void(0);" class="button-add-to-cart">Add to Cart</a>

                <p class="message_text_award"><i class="fa fa-info-circle info_circle" aria-hidden="true"></i>
                    Your order may be subject to a fulfillment fee or postage fee it will be added to your shopping basket</p>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-12"></div>
            <div class="col-md-5 col-sm-5 col-xs-12 header_awards_col2">

                <p class="header_awards header_awards_location">LOCATION</p>
                <iframe style='width: 100%;' src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3531.6358751322728!2d85.34417431453885!3d27.728526731168838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb196796c2dde3%3A0x36a3b22f875af582!2sSukedhara+Communication!5e0!3m2!1sen!2snp!4v1487437593459" height="390" frameborder="0" style="border:0" allowfullscreen></iframe>
                <p class='iframe_descp'><span class='iframe_span'>Biringham</span>
                    <br>
                    The international Convenction Center.
                </p>

                <p class="header_awards right_header">ORGANIZER</p>
                <p class='organizer_title'>XEM</p>
                <div class='row organizer_row'>
                    <div class='col-md-6 col-sm-6 col-xs-12 xemcol1'>
                        <p> <i class="fa fa-eye" aria-hidden="true"></i><a href="#"> View Organizer Profile</a> </p>
                        <p> <img class='social_icon' src="<?php echo theme_img('/fb_icon.fw.png') ?>"><a>facebook.com/bimal</a></p>
                        <p><img class='social_icon' src="<?php echo theme_img('/twitter_icon.fw.png') ?>"><a>instagram.com/bimal</a></p>
                    </div>
                    <div class='col-md-6 col-sm-6 col-xs-12 xemcol2'>
                        <p> <i class="fa fa-envelope-o" aria-hidden="true"></i><a href="#">Contact Organizer</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="container">
        <div class="row submit_email">
            <div class='col-md-12 text-center'>
                <h4 style="font-weight: bold;">Get top Events and Latest updates in your inbox with BabyTicket Finds</h4>
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
                            <?php foreach ($s->table as $ts) { ?>
                                <div class="col-md-3 col-sm-3 col-xs-4 modelcols">
                                    <label>Table <?php echo $ts->table_no ?></label>
                                    <input class="check_table_box" type="checkbox" value="<?php echo $ts->table_no; ?>" name="table[]">
                                    <label style="color:green; font-size: 12px;">available</label>
                                    <?php if ($rs->class == 'Ticket') { ?>
                                        <select class='select_seats'>
                                            <option value="0">Select Seat</option>
                                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                                <option value="<?php $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
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

<script>
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
        } else {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo base_url("events/reserve_seats/") ?>' + '/' + id,
                data: formID,
                success: function (data) {
                    $('#myModal' + id).modal('hide');
                    console.log(data.results.table);
                    $('html, body').animate({scrollTop: 1400}, 2000);
                }
            });
        }
    }

</script>

<div class="modal fade" id="seatModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Seat Planning</h4>
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
<?php include 'includes/footer.php'; ?>