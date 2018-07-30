<div class="container-fluid content-bg">
    <div class="container content">
        <div class="row no-mar main-content">
        <div id="adlist" class="owl-carousel" style="padding-left:25px;padding-right:25px;">
            <?php
                foreach ($home_page_event_list as $event_item):
                    if($event_item['show_main_carousel'] == "Y") { 
            ?>
                <?php if ( $event_item['ticketseatrows'] > 0 ) { ?>
                <div class="item"><a href="<?=base_url()?>index.php/event/<?php echo $event_item['slug'] ?>"><img src="<?=base_url()?>assets/upload/event/thumb/<?php echo $event_item['thumb1_main_carousel'] ?>" class="img-responsive" alt=""/></a></div>          
                <?php }else{ ?>
                <div class="item"><img src="<?=base_url()?>assets/upload/event/thumb/<?php echo $event_item['thumb1_main_carousel'] ?>" class="img-responsive" alt=""/></div>
                <?php } ?>
            <?php
                }
                endforeach;
            ?>
            <!--
            <div class="item"><a href="<?=base_url()?>index.php/event/movie-video-and-screen-awards"><img src="<?=base_url()?>assets/images/img01.jpg" class="img-responsive" alt=""/></a></div>
            <div class="item"><a href="<?=base_url()?>index.php/event/after-party-movie-video-and-screen-awards"><img src="<?=base_url()?>assets/images/img04.jpg" class="img-responsive" alt=""/></a></div>
            <div class="item"><a href="<?=base_url()?>index.php/event/special-request-dance-hall-edition"><img src="<?=base_url()?>assets/images/img6.jpg" class="img-responsive" alt=""/></a></div>
            <div class="item"><img src="<?=base_url()?>assets/images/img7.jpg" class="img-responsive" alt=""/></div>
            <div class="item"><img src="<?=base_url()?>assets/images/img8.jpg" class="img-responsive" alt=""/></div>
            <div class="item"><img src="<?=base_url()?>assets/images/tobago.jpg" class="img-responsive" alt=""/></div>
            -->
        </div>
        </div>
    </div>  

    <div class="container">
        <div class="row form2">
            <div class="col-xs-12">&nbsp;</div>
            <div class="col-md-3 col-xs-12 bgDark adpad20">
            <h4 class="text-center text-orang">Register with TicketBaby</h4>
                            <form  role="form" method="post" action="<?=base_url()?>index.php/user/registration">    
                                <div class="form-group">
                                    <input type="text" name="first_name" autocomplete="off" class="form-control" value="" placeholder="Name" required/>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" autocomplete="off" class="form-control" value="" placeholder="Email" required/>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" autocomplete="off" class="form-control" value="" placeholder="Password" required/>
                                </div>
                                <div class="error-msg"></div>
                                <div class="form-group text-center">
                                    <button type="submit" name="submit" class="btn btn-orang btn-dangers">Sign up</button>
                                </div>
                            </form>
            </div>
            <div class="col-md-6 col-xs-12 bgOrang adpad20" style="padding-bottom:39px;">
                <h4 class="text-center text-white">Recommended Events</h4>
                <div id="slist" class="owl-carousel">
                <?php
                    foreach ($home_page_event_list as $event_item):
                        if($event_item['show_recommended_carousel'] == "Y") { 
                ?>
                    <?php if ( $event_item['ticketseatrows'] > 0 ) { ?>
                    <div class="item"><a href="<?=base_url()?>index.php/event/<?php echo $event_item['slug'] ?>"><img src="<?=base_url()?>assets/upload/event/thumb/<?php echo $event_item['thumb1_recommended_carousel'] ?>" class="img-responsive" alt=""/></a></div>          
                    <?php }else{ ?>
                    <div class="item"><img src="<?=base_url()?>assets/upload/event/thumb/<?php echo $event_item['thumb1_recommended_carousel'] ?>" class="img-responsive" alt=""/></div>
                    <?php } ?>
                <?php
                    }
                    endforeach;
                ?>
                 <!--   
                 <div class="item"><a href="<?=base_url()?>index.php/event/movie-video-and-screen-awards"><img src="<?=base_url()?>assets/images/img001.png" class="img-responsive" alt=""/></a></div>
                 <div class="item"><img src="<?=base_url()?>assets/images/img003.png" class="img-responsive" alt=""/></div>
                 <div class="item"><img src="<?=base_url()?>assets/images/img007-carnival.jpg" class="img-responsive" style="width:175px;height:130px;" alt=""/></div>
                  -->
                </div>
                 <br/>
            </div>
            <div class="col-md-3 col-xs-12 bgDark adBtmPad adpad20 addd"><br/>
                <h4 class="text-center text-orang" style="margin-top:-2px;">Advertisement</h4>
				<iframe width="100%" height="171" src="https://www.youtube.com/embed/LmO2ednJRas" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
        <div class="col-xs-12">&nbsp;</div>
        <div class="col-md-3 col-xs-12 leftNo content">
        <div class="col-xs-12 bgOrang-o">
        <h4 class="text-center">let us promote your event</h4>
        </div>
        <table class="table table-striped">
        <tr>
        <td><img src="<?=base_url()?>assets/images/imgz02.jpg" class="img-responsive"/></td>
        <td class="h5">ASHLEIGH SEALY TRUST
        <img src="<?=base_url()?>assets/images/stars.png" class="img-responsive"/>
        <button class="btn btn-sm btn-xs btn-orang btn-danger" data-container="body" data-toggle="popover" data-trigger="hover" title="ASHLEIGH SEALY TRUST" data-placement="right" data-content="ASHLEIGH SEALY TRUST">See Details</button>
        </td>
        </tr>
        <tr>
        <td><img src="<?=base_url()?>assets/images/imgz01.jpg" class="img-responsive"/></td>
        <td class="h5">Vows Family Day
        <img src="<?=base_url()?>assets/images/stars.png" class="img-responsive"/>
        <button class="btn btn-sm btn-xs btn-orang btn-danger" data-container="body" data-toggle="popover" data-trigger="hover" title="Vows" data-placement="right" data-content="The annual family community day returns to the Bindley hall this July. With all the usual fanfair, stalls, exhibitions, food and music all makr up the fun community day.">See Details</button>
        </td>
        </tr>
        <tr>
        <td><img src="<?=base_url()?>assets/images/img004.jpg" class="img-responsive"/></td>
        <td class="h5">Rockfest
        <img src="<?=base_url()?>assets/images/stars.png" class="img-responsive"/>
        <button class="btn btn-sm btn-xs btn-orang btn-danger">See Details</button>
        </td>
        </tr>
        <tr>
        <td><img src="<?=base_url()?>assets/images/img006.jpg" class="img-responsive"/></td>
        <td class="h5">Hamilton
        <img src="<?=base_url()?>assets/images/stars.png" class="img-responsive"/>
        <button class="btn btn-sm btn-xs btn-orang btn-danger">See Details</button>
        </td>
        </tr>
        </table>
        <div class="form-group adpad">
        <button class="btn btn-sm  btn-orang btn-danger">More</button>
        </div>
        </div>
        <div class="col-md-6 col-xs-12">
        <div class="col-xs-12 visible-xs">&nbsp;</div>
        <div class="col-xs-12 bgGr1">
        <button class="btn btn-black-g btn-lg noBtmRad" name="btn-hot-ticket-tab">Hot Tickets</button>
        <button class="btn btn-orang btn-lg f1 noBtmRad" name="btn-just-announced-ticket-tab">Just Announced</button>
        </div>
        <div class="col-xs-12 bgGray form2 rightSh"><br/>
        <div class="form-group col-xs-12">
        <button class="btn btn-orang f1 pull-left btn-danger">Events <i class="glyphicon glyphicon-chevron-down"></i></button>
        <button class="btn btn-black-g pull-right">Category <i class="glyphicon glyphicon-chevron-down"></i></button><br/>
        </div>

        <div class="hot_ticket_list">
            <?php
            foreach ($home_page_event_list as $event_item):
            if($event_item['show_hot_ticket'] == "Y") { 
                $event_title = $event_item['title'];
                $category_title = ucfirst( strtolower( $event_item['category_name'] ) );
                $hot_ticket_tootip_title = $event_item['hot_ticket_tootip_title'];
                $hot_ticket_tootip_details = $event_item['hot_ticket_tootip_details'];
                $hot_ticket_tooltip = "";
                if( trim($hot_ticket_tootip_details) ) {
                    $hot_ticket_tooltip = 'data-container="body" data-toggle="popover" data-trigger="hover" title="'.$hot_ticket_tootip_title.'" data-placement="right" data-content="'.$hot_ticket_tootip_details.'"';    
                }
            ?>
            <?php

			if ( $event_item['ticketseatrows'] > 0 ) { ?>
                <div class="col-xs-12 bgWhite2"  <?=$hot_ticket_tooltip;?> >
                <p class="pull-left">
                <span class="tbabywinopenurl" data-location="<?=base_url()?>index.php/event/<?php echo $event_item['slug'] ?>"><?php echo $event_title; ?></span>
                </p>
                <p class="pull-right">
                <a href="<?=base_url()?>index.php/music/<?php echo $category_title; ?>"><?php echo $category_title; ?></a>
                </p>
                </div>
            <?php }else{ ?>
                <div class="col-xs-12 bgWhite2" <?=$hot_ticket_tooltip;?> >
                <p class="pull-left">
                <?php echo $event_title; ?>
                </p>
                <p class="pull-right">
                <a href="#"><?php echo $category_title; ?></a>
                </p>
                </div>
            <?php } ?>
            <?php
            }
            endforeach;
            ?>

            <!--
            <div class="col-xs-12 bgWhite2">
            <p class="pull-left">
            <span class="tbabywinopenurl" data-location="<?=base_url()?>index.php/event/movie-video-and-screen-awards">Movie Video & Screen Awards</span>
            </p>
            <p class="pull-right">
            <a href="<?=base_url()?>index.php/event/movie-video-and-screen-awards">Galas & Awards</a>
            </p>
            </div>
            <div class="col-xs-12 bgWhite2">
            <p class="pull-left">
            MViSA Masquerade After party
            </p>
            <p class="pull-right">
            <a href="#">Theatre & Arts</a>
            </p>
            </div>
            <div class="col-xs-12 bgWhite2">
            <p class="pull-left">
            IOJN Local Hero awards Birmingham
            </p>
            <p class="pull-right">
            <a href="#">Theatre & Arts</a>
            </p>
            </div>
            <div class="col-xs-12 bgWhite2" data-container="body" data-toggle="popover" data-trigger="hover" title="Barbados Independence Dinner" data-placement="right" data-content="Tickets not yet available coming August 2015">
            <p class="pull-left" > 
            Barbados Independence Dinner
            </p>
            <p class="pull-right">
            <a href="#"> Galas & Awards</a>
            </p>
            </div>
            -->
        </div>

        <div class="just_announced_list" style="display:none;">
            <?php
            foreach ($home_page_event_list as $event_item):
            if($event_item['show_just_announced'] == "Y") { 
                $event_title = $event_item['title'];
                $category_title = ucfirst( strtolower( $event_item['category_name'] ) );
                $just_announced_tootip_title = $event_item['just_announced_tootip_title'];
                $just_announced_tootip_details = $event_item['just_announced_tootip_details'];
                $just_announced_tooltip = "";
                if( trim($hot_ticket_tootip_details) ) {
                    $just_announced_tooltip = 'data-container="body" data-toggle="popover" data-trigger="hover" title="'.$just_announced_tootip_title.'" data-placement="right" data-content="'.$just_announced_tootip_details.'"';    
                }
            ?>
            <?php if ( $event_item['ticketseatrows'] > 0 ) { ?>
                <div class="col-xs-12 bgWhite2" <?=$just_announced_tooltip;?> >
                <p class="pull-left">
                <span class="tbabywinopenurl" data-location="<?=base_url()?>index.php/event/<?php echo $event_item['slug'] ?>"><?php echo $event_title; ?></span>
                </p>
                <p class="pull-right">
                <a href="<?=base_url()?>index.php/event/movie-video-and-screen-awards"><?php echo $category_title; ?></a>
                </p>
                </div>
            <?php }else{ ?>
                <div class="col-xs-12 bgWhite2" <?=$just_announced_tooltip;?> >
                <p class="pull-left">
                <?php echo $event_title; ?>
                </p>
                <p class="pull-right">
                <a href="#"><?php echo $category_title; ?></a>
                </p>
                </div>
            <?php } ?>
            <?php
            }
            endforeach;
            ?>
        </div>




        </div>
        <div class="col-xs-12"><br/>
        <center>
        <a href="<?=base_url()?>index.php/event/movie-video-and-screen-awards"><img src="<?=base_url()?>assets/images/img0banner.jpg" class="img-responsive"/></a>
        </center>
        </div>
        <div class="col-xs-12 visible-xs">&nbsp;</div>
        </div>
        <div class="col-md-3 col-xs-12 rightNo"><center>
        <a href="<?=base_url()?>index.php/event/movie-video-and-screen-awards"><img src="<?=base_url()?>assets/images/img001.jpg" class="img-responsive"/></a><br/>
        <img src="<?=base_url()?>assets/images/dummy.jpg" class="img-responsive"/><br/></center>
        </div>
        </div>
    </div>
</div> 

