<?php include 'includes/header.php'; ?>

<?php
$cats = $this->db->get_where('tbl_post', array('remark' => 6, 'parent_id' => 0))->result();
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h3>Search Events</h3>
            <div class="panel panel-default">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title active">
                            Category
                        </h4>
                    </div>
                </a>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <div class="list-group">
                            <a href="<?php echo base_url('search'); ?>" style="background-color: #FFB584;color:#fff" class="list-group-item">All Categories</a>
                            <?php foreach ($cats as $c) { ?>
                            <a style="" href="<?php echo base_url('search').'?keyword='.'?cat_id='.$c->id ?>" class="list-group-item"><?php echo $c->title; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-md-9 searchevent1stcol">
            <h2>Events</h2>
            <?php

            function limit_words($string, $word_limit) {
                $words = explode(" ", $string);
                return implode(" ", array_splice($words, 0, $word_limit));
            }
            ?>

            <ul class="searchul">
                <?php foreach ($results as $r) { ?>
                    <a href="<?php echo base_url('events/event/' . $r->id) ?>">
                        <li>
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="<?php echo base_url() . 'uploads/images/thumbnails/' . $r->image; ?>">
                                </div>
                                <div class="col-md-9 searcheventcol">
                                    <h3 class="event_title"><?php echo $r->name; ?></h3>
                                    <p><?php echo limit_words($r->details, 50) . '...'; ?></p>
                                </div>
                            </div> 
                        </li>
                    </a>
                <?php } ?>
            </ul>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 pagination text-center">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>


        </div>





    </div>
</div>




<?php include 'includes/footer.php'; ?>


<style>
    
    @font-face {
    font-family: 'alternatego';
    src: url('../fonts/alternatego.otf') format("opentype");/* IE9 Compat Modes */
}




body{
    font-family: 'Open Sans', sans-serif !important;
}

.menu-section {
    background:#FF8734;
    border-bottom: 2px solid #ccc;
    top: 0;
    width:100%;
    z-index: 999;
    opacity: 0.8;
}
.menu-section .main-menu .navbar{
    background:none;
    margin:0;
    padding:0;
    border:none;
}
.navbar-default {
    background-color: transparent !important;
    border-color: transparent !important;
}
.navbar-nav > li > a {
    color: #fff !important;
    display: block;
    font-size: 14px;
    font-weight: 400;
    letter-spacing: 2px;
    overflow: hidden;
    padding: 7px 12px 2px 0;
    text-transform: uppercase;
    transition: all 0.3s ease-in-out 0s;
    font-family: 'Roboto Condensed', sans-serif !important;
}
.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus{
    background: transparent !important;
    color:#fff;
}
.navbar-default .navbar-nav > li > a:hover{
    /*    color:#60BB46;*/
}
.carousel-inner {
    max-height: 500px;
    overflow: hidden;
}
.slider_sec{
    height: 500px !important;
}

.top_bar li {
    display: inline;
    list-style: outside none none;
    padding-left: 20px;
}
.top_bar > ul {
    float: right;
    margin-top: 20px;
    padding: 0;
}
.top_bar a {
    background:#454545;
    border-radius: 20px;
    color: #fff;
    padding: 5px 15px;
    vertical-align: middle;
}
.top_bar img {
    margin-right: 10px;
    max-width: 16px;
}
.navbar{
    min-height: 0px !important;
}
.inquery_detail {
    background: #fff none repeat scroll 0 0;
    padding: 15px 15px 10px;
}
.inquery_form {
    margin: 120px 0;
}
.inquery_form h4 {
    background:#FF8734;
    color: #fff;
    margin: 0;
    padding: 10px;
    text-align: center;
}
.register_btn {
    background:#FF8734;
    border-color:#FF8734;
    border-radius: 0;
    display: block;
    margin-top: 15px;
    width: 100%;
    transition: all 0.3s ease-in-out 0s;
}
.register_btn:hover,.register_btn:focus{
    border-color:#FF8734;
    background:#FF8734;
    opacity:0.8;

}
.register_control{
    background: #F7F7F7;
    border: none;
    border-radius:0px;
}
.caption h2 {
    color: #fff;
    font-size: 42px;
    font-weight: bold;
    line-height: 60px;
    margin-top: 95px;
    text-transform: uppercase !important;
}
.caption p {
    color: #fff;
    font-size: 16px;
    line-height: 26px;
    margin-top: 20px;
}
.more_btn {
    border: medium none;
    border-radius: 0;
    font-size: 16px;
    margin-top: 20px;
    padding: 15px 35px;
    background: #FF8734;
    transition: all 0.3s ease-in-out 0s;
}
.more_btn:hover,.more_btn:focus{
    background: #FF8734;
    border: medium none;
    opacity:0.8;
}
.listing_event{
    background:rgba(119, 119, 119, 0.54);
    padding: 30px 0px 20px 0px;
}
.event_detail h4 {
    color: #202020;
    font-size: 18px;
    font-weight: 600;
    padding-left: 15px;
    margin-bottom: 20px;
    margin-top: 20px;
    padding-right: 15px;
}
.event_detail p {
    color: #757575;
    font-size: 15px;
    padding-left: 15px;
    margin-bottom: 20px;
    padding-right: 15px;
}
#owl-demo .item{
    margin: 3px 10px;
}
#owl-demo .item img{
    display: block;
    width: 100%;
    height: auto;
}
.event_detail {
    background: #fff none repeat scroll 0 0;
    padding-bottom: 20px;
    min-height: 340px;
}

.event_date > span {
    background:#E94A19;
    color: #fff;
    padding: 5px 10px;
}
.image {
    position: relative;
}
.event_date {
    bottom: 10px;
    position: absolute;
    right: 10px;
}

.recommended_event{
    padding: 40px 0px;
    background: #F7F7F7;
}
.home_title {
    font-family: "Roboto Condensed",sans-serif !important;
    font-size: 24px;
    font-weight: 600;
    margin-top: 0;
    text-transform: uppercase !important;
}
.underline{
    height: 2px;
    width: 97px;
    background: #fe852c;
}
.event_recommended{
    background: #fff;
    padding-bottom: 20px;
    min-height: 303px;
}
.event_recommended > h4 {
    color: #202020;
    font-size: 18px;
    font-weight: 600;
    padding-left: 10px;
    padding-right: 10px;

}
.event_recommended > a {
    color: #fe852c;
    font-size: 14px;
    padding-left: 10px;
    padding-right: 10px;
    position: absolute;
    bottom: 20px;
}
.event_space{
    padding-top: 35px;
}

#owl-demo1 .item{
    margin: 3px 5px;
}
#owl-demo1 .item img{
    display: block;
    width: 100%;
    min-height: 167px;
    max-height: 167px;
}
.recommended_event .owl-theme .owl-controls .owl-page span{
    background: #FFCCBC !important;
}
.video_side {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #f1f1f1;
    margin-top: 35px;
    padding: 10px;
}
.nav-tabs > li > a {
    display: block;
    position: relative;
    border: none !important;
    color: #fff;
    font-size: 20px;
    text-transform: uppercase !important;
    margin: 0px;
    border: none !important;
    border: none !important;
}


.nav-tabs {
    background: #454545 none repeat scroll 0 0;
    border-bottom: medium none;
    margin-top: 30px;
    min-height:40px;
    transition: all 0.3s ease-in-out 0s;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
    background: #fe852c;
    border-radius:0px !important;
    color: #fff;

}
.nav-tabs li a{
    text-align: center;
}

.movie_list{
    background: #F7F7F7;
}
.movie_list ul {
    margin: 0;
    padding: 0;

}
.movie_list a {
    color: #000;
    font-size: 16px;
    color: #202020;
    text-decoration: none;
    font-weight: 600;
}
.movie_list li:hover{
    background: #fe852c;
    color: #fff;

}
.movie_list li {
    border-bottom: 1px solid #fe852c;
    line-height: 44px;
    list-style: outside none none;
    padding: 0 20px;
    transition: all 0.3s ease-in-out 0s;
    border-color:none;
    font-size: 14px;
}
.promote_event{
    background:#F7F7F7;
    padding-bottom: 18px;
}
.promote_event h3 {
    background:#fe852c;
    color: #fff;
    font-size: 14px;
    margin-top: 30px;
    padding: 12px;
    text-align: center;
}
.promote_detail > h4 {
    font-size: 16px;
    margin-bottom: 5px;
}
.img-big {
    float: left;
    margin-bottom: 20px;
    padding-right: 15px;
}
.promote_detail {
    border-bottom: 1px solid red;
    margin-bottom: 10px;
    padding-bottom: 10px;
    padding-left: 15px;
    padding-right: 15px;
}
.promote_detail > a {
    color: #fe852c;
    line-height: 30px;
}
.addvertisment{
    margin-top: 40px;
}
.addvertisment img{
    width: 100% !important;
}
.no-right{
    padding-right: 0px !important;
}
.no-left{
    padding-left: 0px;
}
.parent_img{
    margin-top: 36px;
}
.small_img img {
    min-height: 136px;
    width: 100%;
}
.search_box{

    margin-top: 37px;
}
.search_box h4 {
    color: #202020;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
    line-height: 37px;
}
.form-control.s_control {
    border-radius: 5px !important;
    font-size: 16px;
    min-height:40px;
    text-indent: 15px;
    border: 2px solid #f2f2f2;

}
.search_control{
    width: 60% !important;
    float: right !important;
}



.btn.btn-secondary.search_btn {
    background: #ff8734 none repeat scroll 0 0;
    border-radius: 5px;
    color: #fff;
    margin-left: 20px;
    padding: 5px 25px;
}
.where_ticket{
    position: relative;
    margin-bottom: 30px;
}
.where_ticket h3 {
    background:#FF5721;
    color: #fff;
    margin-bottom: 0;
    margin-top: 40px;
    padding: 15px 0px;
    text-align: center;
    font-size: 18px;
}

.ticket_layer > a{
    background: rgba(0, 0, 0, 0) url("images/bg_ticket.png") no-repeat scroll 0 0;
    padding: 6px 40px;
    color: #fff;
    font-size: 18px;
}
.ticket_layer {
    bottom: 5px;
    left: 0;
    position: absolute;
    right: 0;
}
footer {
    background:#454545;
    padding-bottom: 20px;
    padding-top: 10px;
}
.footer_title {
    color: #fff;
    font-size: 24px;
    margin-bottom: 15px;
}
.social_icon li {
    display: inline-block;
    list-style: outside none none;
    padding-right: 5px;
}
.social_icon ul{
    padding: 0px;
    margin: 0px;
}
.get_in_touch > ul {
    list-style: outside none none;
    margin-top: 25px;
    padding: 0;
}
.get_in_touch p {
    color: #fff;
    font-size: 14px;
}
.get_in_touch a {
    color: #fff;
    font-size: 14px;
    line-height: 30px;
}
.copyright {
    background: #000 none repeat scroll 0 0;
    color: #fff;
    padding: 13px 0;
}
.copyright p{
    margin: 0px;
}
.country{
    float: right;
}
.country li {
    display: inline-block;
    padding-right: 15px;
    vertical-align: middle;
}
.country ul {
    padding: 0px;
    margin: 0px;
}

.img_payment {
    max-width: 264px;
    padding-bottom: 19px;
    margin-top: 6px;
}

#owl-demo .item img{
    min-height: 160px !important;
}
.navbar-default .navbar-nav > li > a{
    padding-left: 10px;
}


.navbar-default .navbar-nav > .active > a{
    background:#454545 !Important;
}

.navbar-default .navbar-nav > li > a:hover{
    background: #454545;

}
.col-xs-12.col-sm-6.col-md-6.no-right{
    padding-left: 0px !important;
}

.awardtop{
    background:#F7F7F7;
}

.award_time{
    font-weight: bold;
    font-size: 18px;
}
.award_price{
    font-family: alternatego;
    color: #FF5228;
    margin-top: 0px;
    font-size: 22px;

}

.save_event{
    padding: 15px;
    background: none;
    border: 2px solid #FF5228;
    border-radius: 10px;
    background: white;
    color: #FF5228;
    font-size: 22px;
    font-weight: bold;
    margin-top: 40px;
}



.fa-save:before, .fa-floppy-o:before{
    font-size: 30px;
}

.award_descp{
    padding-top: 20px;
    padding-bottom: 17px;
}

.award_descp p{
    color:#727272;;
    font-weight: bold;
    font-size: 15px;
}

.event_img{
    width: 100%;
    min-height: 276px;
}


.event_col p{
    color: #767676;
    font-size: 13px;
}

.event_col h2{
    font-family: alternatego;
    font-size: 33px;
    margin-bottom: 0px;
    margin-top: 0px;
}

.span_info{
    font-weight: bold;
}

.description_para{
    background: #F7F7F7;
    padding: 10px;
}

.event_detai{
    padding-bottom: 25px;
}
.header_awards{
    background: #fe852c;
    text-align: left;
    color: white;
    padding: 10px;
    font-size: 18px;
    margin-bottom: 0px;
}

.header_awards_col2{
    padding-right: 0px;
}

.add_cart{
    margin-right: 40px;
}
.save_event:hover{
    background: #FE5722;
    color: white;
    transition: 1s;
}

.event_detai_detail {
    padding-top: 20px;
    background: white;
    margin-top: 32px;
    margin-bottom: 0px;;
    border: 1px solid;
    padding: 30px 20px 20px 20px;
    border-bottom: none !important;
}
.event_table thead tr th{

}

.total_header thead{
    background: #1771ce;
    color: white;
    font-size: 20px;
}
.proceed_btn{
    width: 62%;
    padding: 7px;
    font-size: 20px;
    font-weight: bold;
    color: black;
    margin-left: auto;
    margin-right: auto;
    display: block;
    background: #FFC622;
    border: none;
    border-radius: 7px;
    box-shadow: 1px 2px 3px #ccc;
    margin-bottom: 35px;
    margin-top: 40px;
}

.info_circle{
    font-size: 36px;
    float: left;
    padding-right: 15px;
    margin-left: 15px;
    color:#FF8734;
}

.message_text_award{
    padding-bottom: 10px;
    padding-top: 10px;
    font-size: 12px;
    border: 1px solid #ccc;
    margin-top: 25px;
    margin-bottom: 20px;

}

.venue_header{
    font-size: 20px;
    padding: 10px 0px 10px 0px;
    text-align: center;
    font-weight: bold;
}
.header_awards_location{
    margin-top: 40px;
    margin-bottom: 0px;
}
.iframe_span{
    font-size: 20px;
    font-weight: bold;
}
.iframe_descp{
    background: #F7F7F7;
    font-size: 17px;
    padding-left: 10px;
    padding-right: 10px;
    margin-bottom: 20px;
    font-size: 14px;
}

.seats_image{
    width: 320px;
    margin-left: auto;
    margin-right: auto;
    display: block;
    margin-bottom: 20px;
}
.right_header{
    margin-bottom: 0px;
}

.organizer_title{
    background: #F7F7F7;
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: 10px;
    font-size: 20px;
    border-bottom: 2px solid #FE5722;
    margin-bottom: 0px;
    font-weight: bold;
}
.xemcol1 p{
    color: #FE5722;
}
.xemcol2 p{
    color: #FE5722;
}
.organizer_row{
    margin-left: 0px;
    margin-right: 0px;
    background:#F7F7F7; 
    padding-top: 10px;
}

.fa-eye:before{
    font-size: 27px;
    color: #FFC622;
    position: relative;
    top: 4px;
    margin-right: 10px;
}
.fa-envelope-o:before{
    font-size: 27px;
    color: #FFC622;
    position: relative;
    top: 4px;
    margin-right: 10px;
}
body a{
    text-decoration: none;
}

.social_icon{
    margin-right: 10px;
}

.submit_email{
    padding-top: 25px;
}

.email_input{
    width: 40%;
    margin-left: auto;
    margin-right: auto;
}

.submit_btn{
    padding: 7px 41px;
    color: white;
    font-size: 18px;
    margin-top: 10px;
    background: #FE5722;
}

.event_space a{
    text-decoration: none;
}
.event_space p {
    color: #FE5722;
    position: absolute;
    bottom: 12px;
    left: 20px;
    font-size:16px;
}

.modalrow label{
    display: block;
    text-align: center;
}
.check_table_box{
    margin-left: auto !important;
    margin-right: auto !important;
    display: block !important;
}

.modelcols{
    margin-bottom: 20px !important;
}

.totalrow{
    background: #fe852c;
    margin-left: 0px;
    margin-right: 0px;
    color: white;
    padding: 4px;
}

.totalrowitem{
    border-bottom: 4px solid #ccc;
    margin-left: 0px;
    margin-right: 0px;
    padding: 2px;
}
.select_seats{
    margin-left: auto;
    margin-right: auto;
    display: block;
}

.modal_error{
    display: none;
    color: red;
    position: absolute;
    left: 25%;
}

.search_payment{
    padding-top: 15px;
}



.menu_fixed{
    position: fixed;

}

.menu-block{
    position: fixed;
    opacity: 1 !important;
}

.owl-theme .owl-controls{
    display: block !important;
}

.owl-prev{
    position: absolute;
    left: -68px !important;
    top: 45%
}
.owl-next{
    position: absolute;
    right: -68px !important;
    top: 45%
}

.sliderleft{
    font-size: 23px !important;
    padding: 4px 2px !important;
    padding: 4px !important;
}
.sliderright{
    font-size: 23px !important;
    padding: 4px 2px !important;   
    padding: 4px !important;
}
.owl-pagination{
    display: none !important;
}
.toprow{
    background:rgba(51, 51, 51, 0.81);
    padding-left: 30px;
    padding-top: 2px;
    color: white;

}
.social_icon ul li a img{
    width: 24px;
}
.get_ticket_btn{
    position: absolute;
    left: 33%;
    bottom: 25px;
    background: #FF8734;
    color: white;
    border: none;
    border-radius: 4px;
    box-shadow: 2px 2px 4px #ccc;
}
.recomme{
    background: black !important;
    color: white !important;
    min-height: 385px !important;
}

.recomme h4{
    color: white !important;
}

.recomme p{
    color: white !important;
}

.nav-tabs > li > a{
    font-size: 14px;
}
.nav-tabs{
    position: relative;
}
.nav-tabs > li{
    width: 50%;
}
.ticketcol{
    padding-right: 60px;
    margin-bottom: 25px;
}

.addvertisment img{
    max-height: 153px;
}
.parent_img{
    margin-right: 0px;
    margin-left: 0px;
}
.header_awards_col1{
    padding-right: 30px !important;
}

.more_top ul{
    margin-top: 7px;
}

.social_icon ul{
    padding-top: 5px;
}

.phone_no{
    position: absolute;
    top: 7px;
    margin-left: 60px;
}

.contact-usbody{
    background: #F7F7F7;
}
.contact_container{
    background: white;
}

.main-content{
    background: white;
    margin-top: 30px;
    margin-bottom: 30px;
    border: 2px solid lightgray;
}
.heading{
    padding-left: 28px;
    color: #DF5B00;
    padding-top: 0px !important;
    margin-top: 5px;
}
.input_form{
    border: 1px solid #ffb584;
}

.btn-orang {
    background: rgba(0, 0, 0, 0) linear-gradient(1deg, #de5b00 0%, #fa6805 100%) repeat scroll 0 0;
    border: 0 none;
    border-radius: 3px;
    color: #fff;
    font-family: HelveticaLTStd-Bold;
    text-transform: uppercase;
}

.search-bar {
    background: #fff none repeat scroll 0 0;
    border-bottom: 1px solid #b2b2b2;
    padding: 8px 0;
    margin-bottom: 20px;
}

.barclay{
    position: relative;
    left: 100px;
    top: -3px;
}

.barclay h4{
    font-size: 14px;
    position: relative;
    top: 3px;
}

.nav > li > a:hover, .nav > li > a:focus{
    background: none;
}
.movie_list li:hover {
    background: none;
    color: initial;
}

.icon_topheader{
    vertical-align: middle;
}
.vegas-slide-inner{
    background-attachment: fixed;
}
.easyzoom is-ready{
    width: 100% !important;
}
.easyzoom{
    width: 100% !important;
}
.seat_modal_img{
    margin-left: auto;
    margin-right: auto;
    display: block;
}

.logo a img{
    width: 150px;
    padding-top: 4px;
    padding-bottom: 2px
}

.info_prices{
    line-height: 0px;
}

.award_detail_section{
    background: #F7F7F7;
}

.event_detai_detail {
    padding-top: 20px;
    background: white;
    margin-top: 32px;
    margin-bottom: 0px;
    border: 1px solid #ccc;
}

.description_event{
    border: 1px solid;
    padding: 6px 20px;
    font-size: 13px !important;
}

.event_inforow{
    border:1px solid #ccc;
    border-top:none !important;
    background: white !important;
    border-right: 1px solid #ccc;
    border-left:1px solid #ccc;
}

.eventinforow{
    background: white;
    border-left:1px solid #ccc;
    border-right: 1px solid #ccc;
}

.eventinforow p{
    background: #333333;
    color: white;
    padding: 4px;
    font-size: 22px;
}
.event_table{
    border: 1px solid #ccc;
}
.header_informations{
    list-style: none !important;
    padding-left: 0px;
}

.header_informations li{
    padding-left: 10px;
    border-bottom: 1px solid #ccc;
    padding: 9px;
}
.header_event{
    background: #F2F2F2;
    padding: 10px;
    font-size: 24px;
    margin-bottom: 0px;
    font-family: alternatego;
}
.infoeventcol{
    font-weight: bold;
    color: #E15B00;
    font-size: 12px;
}

.infoeventcol2{
  
    font-size: 13px;
}

.eventinfo-para {

    background: #f2f2f2;
    border: 1px solid #ccc;
    font-size: 12px;
    color: #df5b00;
    padding: 15px;
    margin: 25px 0;
    font-weight: normal;

}

.addtocart {
    background: #1771ce;
    border-radius: 3px;
    color: #fff;
    display: inline-block;
    font-family: alternatego;
    font-size: 20px;
    margin: 13px 0 0;
    padding: 7px 24px;
    text-shadow: 0 1px 1px #000;
    text-transform: uppercase;
    margin-left: auto;
    margin-right: auto;
    display: block;
    width: 135px;
}
.addtocart:hover{
    color:white;
}
.addtocart a{
    color:white;
}

.navbar-right{
    margin-top: 15px !important;
}
.search_search_control{
    font-size: 22px;
}
.header_awards_col2 .right_header{
    text-align: center;

}
.promotars h1 {
    color: white;
    font-size: 14px;
    font-weight: bold;
    margin: 10px 0;
}
.promotars ul {
    margin: 0;
    padding: 0;
}
.promotars ul li {
    display: block;
}

.promotars ul li a {
    font-size: 12px;
    color: white;
}
.orange-strip{
    background:#454545 !important;
    padding-top: 15px;
    padding-bottom: 20px;
}
.footer-most {
    padding: 10px 0;
    height: auto;
}
.no-pad {
    padding: 0;
}
.footer-social {
    text-align: left;
    margin: -33px 0 15px;
}
.copyrights {
    padding: 0;
}
.copyrights img {
    border-left: 1px solid #999;
    border-right: 1px solid #999;
    margin: 0 0 0 22px;
    padding: 0 40px;
}
.copyrights p {
    margin: 0;
    font-size: 12px;
    color: #999;
    display: inline;
    color: white;
}
.footer-most{
    background:#373f46;
}

  .ticket-class-tooltip {
    font-size: 14px;
    font-weight: bold;
    margin: 0 20px 0 3px;
    padding: 0 5px;
    background: #df5b00;
    color: white;
    position: absolute;
    left: 26%;
    margin-top: 5px;
}

.dele{
    position: relative;
}


   .table-only h1 {
    font-size: 17px;
    color: #fff;
    border: none;
    background: #ff8d3f;
    font-family: alternatego;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
    margin-top: 0px;

}

.outer-additional h1 {
    border: 1px solid #ccc;
    margin: 0;
    padding: 10px 15px;
    text-transform: uppercase;
    font-size: 17px;
    font-family: alternatego;
}

.table-only ul{
    list-style: none;
    padding-left: 0px;
    padding-top: 11px;
    padding-bottom: 8px;
}

.table-only li{
    font-size: 12px;
    font-weight: bold;
}

.event_table thead tr th{
    font-size: 11px;
}
.event_table tr td{
    font-size: 12px;
}
.event_table tr td:nth-child(1){
    font-weight: bold;
}
.award_page{
    background: white !important;
}
.award_scontrol{
    width: 80% !important;
    float: right !important;
    border-bottom: 2px solid #ccc;
}
.zoom_in{
    position: absolute !important;
    right:0 !important;
}
.header_awards{
    font-size: 18px;
    font-family: alternatego;

}

.more_button{
    margin-left: auto;
    margin-right: auto;
    display: block;
    background: #ff8734;
    border: none;
    color: white;
    border-radius: 3px;
    padding: 4px 30px;
    font-size: 17px;
}

.qty {
    margin: 0 0 10px 0;
    border: 1px solid #ccc;
}
.qty ul li {
    border-bottom: none;
    font-family: Arial, Helvetica, sans-serif;
    text-transform: none;
    text-align: center;
    margin: 0;
}
.image_ticket_class{
    margin-bottom: 10px;
}
.map-canvas{
    height: 300px;
}


.content h1 {
    border-bottom: 1px solid #ccc;
    color: #df5b00;
    font-family: alternatego;
    font-size: 40px;
    margin: 0;
    padding: 10px 15px;
    text-transform: uppercase;
}

.btn-group-justified {
    display: table;
    width: 100%;
    table-layout: fixed;
    border-collapse: separate;
}
.line2 {
    height: 1px;
    background: #ccc;
    margin: 15px auto;
}

.seats_list{
    width: 70px;
    margin-left: auto;
    margin-right: auto;
    display: block;
        
}

/*logincss*/

.login_div {
    background: #fcfcfc none repeat scroll 0 0;
    margin-bottom: 50px;
    margin-top: 50px;
    padding-bottom: 30px;
    padding-top: 20px;
    text-align: center;
    box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
}
.login_div > h3 {
    color: #ff8734;
    font-size: 30px;
}
.login_form {
    margin: 40px 30px 0;
}
.login-control {
    border-radius: 0 5px 5px 0 !important;
    min-height: 45px;
    border-color: #FFB584;
    background: transparent;
}

.btn.btn-success.login-btn {
    background:transparent !important;
    border-color:#FFB584;
    font-size: 18px;
    margin-top: 15px;
    padding: 10px 0;
    width:100%;
    color: #333;
}
.btn.btn-success.login-btn:hover{
	background: #ccc !important;
	border-color: #ccc;
}
.not_account a {
    padding-left: 5px;
}
.not_account > p {
    margin-top: 30px;
    text-align: center;
}
.login_icon {
    border: 2px solid #FFB584;
    border-radius: 50%;
    color:#ff8734;
    font-size: 50px;
    margin-bottom:20px;
    margin-top: 30px;
    padding: 20px 32px;
}
.input-group-addon {
    background-color:#FFB584;
    border: 1px solid #FFB584;
    border-radius: 4px;
    color: #fff;
    font-size: 20px;
    font-weight: normal;
    line-height: 1;
    min-width:45px;
    text-align: center;
}

.fa-envelope-o:before {
    font-size: 19px;
    color: white;
    position: relative;
    top: 4px;
    margin-right: 0px;
}

.form_errors{
    color: red !important;
}
.success_msg{
    color: green;
}
.unsuccess_msg{
    color: red;
}


/*end of login css*/

.menu-collapse{
    background:gray !important;
}

.navbar-right-profile{
margin-top: 0px !important;
}

.cus-form4{
    padding-bottom: 30px;
    margin-bottom: 21px;
}

.btnVus{
    margin-top: 16px;
}

.btn btn-default btn-g-o{
    background: black;
    color: white;
}

.btn-headers{
        color: black;
    font-weight: bold;
}

.active_btn{
    background: black !important;
    color: white !important;
}


.order_thumb_image{
    width: 100% !important;
}

.bgBlack {
    background: #000 !important;
    color: #fff !important;
}
.formerror{
    color: red;
}

.bgGray {
    background: #EFEFEF;
    color: #000;
}

.ticky{
    margin-top: 0px !important;
}
.event_table tr td:nth-child(1){
    min-width: 119px;
}
.additio tr td:nth-child(1){
    min-width: 119px !important;
}


.bar_logo img{
     margin-top: 25px;
    max-width: 230px;
}
.logo_title {
    background: #ccc none repeat scroll 0 0;
    margin-bottom: 35px;
    margin-top: 15px;
}
.order-panel h1 {
    font-size: 26px;
    font-weight: 600;
    margin-top:0px;
    margin-bottom: 0px;
    padding: 20px 0px;
}
.order_conent > h1 {
    color: blue;
    font-size: 60px;
    font-weight: bold;
    margin-bottom: 30px;
    margin-top: 0;
}
.order_table > h3 {
    font-size: 26px;
    font-weight: bold;
    margin-top: 0;
}
.order_table > p {
    color: #555;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 30px;
}
.order_table > span {
    display: block;
    margin-bottom: 15px;
}

.searcheventcol h3{
    margin-top: 0px;
}
.searchul{
    list-style: none;
}
.searchul li{
    margin-bottom: 25px;
    border: 1px solid #ccc;
    padding: 20px;
}

.pagination strong{
    background:orange;
    padding: 6px;
    color: white;
}

.searchevent1stcol h2{
    text-align: center;
}

    
    
    </style>