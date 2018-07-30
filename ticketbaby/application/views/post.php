<?php
include 'includes/header.php';




//echo "<pre>";print_r($seo);echo "</pre>";
//echo "<pre>";print_r($profile);echo "</pre>";
//echo "<pre>";print_r($setting);echo "</pre>";
//echo "<pre>";print_r($top_menu);echo "</pre>";
//echo "<pre>";print_r($company_menu);echo "</pre>";
//echo "<pre>";print_r($footer_menu);echo "</pre>";
//echo "<pre>";
//print_r($post);
//echo "</pre>";
//echo "<pre>";print_r($posts);echo "</pre>";
?>
<!-- Comedy starts -->
<section class="comedy_section">
    <div class="container divider_container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="comedy_title" style="background:url('assets/images/comedy_bg.jpg'); background-repeat: no-repeat; background-size:cover">
                    <h4><?php echo $post->title ?></h4>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <?php if($post->image){ ?>
                            <div class="feature-img">
                                <img src="<?php echo site_url().'uploads/images/full/'. $post->image ?>" style="width: 100%">
                            </div>
                        <?php } ?>
                        <div class="content">
                            
<?php echo $post->excerpt ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<?php include 'includes/footer.php' ?>





<script src="js/jquery-2.2.3.min.js" type="text/javascript"></script>
<script src="js/moment.js" type="text/javascript"></script>
<script src="js/jquery-ui.js" type="text/javascript"></script>
<script src="js/vegas.js" type="text/javascript"></script>
<script src="js/owl.carousel.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>

<script>

  $(document).ready(function () {
      $('.faleft').closest('.owl-prev').addClass('owlleft8');
      $('.faright').closest('.owl-next').addClass('owlnext8');

      $('.owlnext8').css('position', 'absolute');
      $('.owlnext8').css('margin-top', '50px !important;');
      $('.owlnext8').css('margin-right', '75px !important;');

      $('.faleft').closest('.owl-prev').addClass('owlleft8');
      $('.owlleft8').css('display', 'none');
      $(function () {
          $("#datepicker1").datepicker();
          $("#datepicker2").datepicker();
      });

      $("#owl-demo").owlCarousel({

          autoPlay: 4000, //Set AutoPlay to 3 seconds
          items: 5,
          itemsDesktop: [1199, 3],
          itemsDesktopSmall: [979, 3],
          nav: true,
          loop: true

      });
      $("#owl-demo1").owlCarousel({

          autoPlay: 4000, //Set AutoPlay to 3 seconds
          items: 3,
          itemsDesktop: [1199, 3],
          itemsDesktopSmall: [979, 3],
          nav: true,
          loop: true

      });

      $("#owl-demo-2").owlCarousel({

          //  autoPlay: 6000, //Set AutoPlay to 3 seconds
          items: 4,
          itemsDesktop: [1199, 3],
          itemsDesktopSmall: [979, 3],
          loop: false,
          navigation: false
                  /*     navigationText: [
                   '<i class="fa fa-caret-left" aria-hidden="true"></i>',
                   '<i class="fa fa-caret-right" aria-hidden="true"></i>',
                   ]*/

      });
      $("#owl-demo-3").owlCarousel({

          autoPlay: 6000, //Set AutoPlay to 3 seconds
          items: 8,
          itemsDesktop: [1199, 3],
          itemsDesktopSmall: [979, 3],
          loop: true,
          navigation: true,
          navigationText: [
              '<i class="fa fa-caret-left" aria-hidden="true"></i>',
              '<i class="fa fa-caret-right" aria-hidden="true"></i>',
          ]

      });

      $("#owl-demo-8").owlCarousel({

          autoPlay: 6000, //Set AutoPlay to 3 seconds
          items: 1,
          itemsDesktop: [1199, 1],
          itemsDesktopSmall: [979, 1],
          loop: true,
          //  navigation:true,

      });



  });

</script>
<style>
    /*Css for Comedy Page*/


    .comedy_title h4 {
        color:white;
        font-size:28px;
        font-weight:bold;
        padding:20px 15px;
        text-transform:uppercase;
        margin-top: 0px;
    }
    .comedy_title{
        margin-bottom:20px;
    }
    .comedy_section {
        background: #f8f8f8 none repeat scroll 0 0;
        padding: 30px 0;
    }
    .side_title{
        background: #000 none repeat scroll 0 0;
        color: #ff8734;
        margin: 0;
        padding: 10px 20px;
        text-transform: uppercase;
    }
    .event-control {
        border-radius: 0;
        font-size: 13px;
        height: 30px;
        padding: 0 5px;
        color:#888;
    }
    .form-group.event-group {
        margin-bottom: 8px;
    }
    .shop_event {
        background: #fff none repeat scroll 0 0;
        padding: 15px 20px;
    }
    .event-label{
        color: #888;
        float: left;
        font-weight: normal;
        margin-top: 2px;
        padding-right: 10px;
    }
    .event-label_1 {
        color: #888;
        float: left;
        font-weight: normal;
        margin-top: 5px;
        padding-right: 28px;
    }
    .input-group-addon.event-addon {
        background: transparent none repeat scroll 0 0 !important;
        border-color: #ccc;
        border-radius: 0;
        color:#FF8734;
        padding: 0;
    }
    .btn.btn-go {
        background: #ff8734 none repeat scroll 0 0;
        color: #fff;
        font-weight: bold;
        padding: 5px 15px;
        text-transform: uppercase;
    }
    .local_venue > h4 {
        background: #ccc none repeat scroll 0 0;
        color: #000;
        margin: 0;
        padding: 10px 20px;
    }
    .local_venue {
        margin-top: 35px;
    }
    .venue_list {
        background: #fff none repeat scroll 0 0;
        padding:10px 20px;
    }
    .venue_list > ul {
        list-style: outside none none;
        margin: 0;
        padding: 0;
    }
    .venue_list li {
        border-bottom: 1px solid #ccc;
        margin-bottom: 5px;
    }
    .venue_list a {
        color: #ff8734;
        font-size: 14px;
    }
    .venue_list p{
        font-size: 12px;
        color: #888;
    }
    .book_room {
        margin-top: 35px;
        position: relative;
    }
    .book_text > h4 {
        color: #fff;
        float: left;
        font-size: 20px;
        font-weight: bold;
        margin: 0;
        text-transform: uppercase;
    }
    .book_text > a {
        color: #fff;
        display: block;
        float: right;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        margin-top:2px;
    }
    .book_text {
        background:#33ADE0;
        bottom: 0;
        left: 0;
        /*opacity: 0.8;*/
        padding: 10px;
        position: absolute;
        right: 0;
    }
    .brimpide_div img {
        width: 100%;
    }
    .brimpide_div > a {
        background: #33ade0 none repeat scroll 0 0;
        color: #fef303;
        display: block;
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
        text-align: center;
        text-transform: uppercase;
    }
    .ticket_div {
        margin-top: 35px;
    }
    .ticket_div > h4 {
        background:#FA028A;
        color: #fff;
        margin: 0;
        padding: 10px;
        text-align: center;
    }
    .ticket_div img {
        width: 100%;
    }
    .facebook_trend > h4 {
        background: #ccc none repeat scroll 0 0;
        margin: 0;
        padding: 10px 20px;
        font-size: 16px;
    }
    .facebook_trend i {
        color: blue;
        font-size: 25px;
        padding-right: 5px;
        vertical-align: text-bottom;
    }
    .facebook_trend {
        margin-top: 35px;
    }
    .my-tab > li > a {
        display: block;
        padding: 3px 15px;
        position: relative;
    }
    .tab-wrapper {
        background: #fff none repeat scroll 0 0;
        padding: 10px;
    }
    .my-tab > li > a {
        background: #d7dfea none repeat scroll 0 0;
        border-radius: 0;
        display: block;
        padding: 3px 15px;
        position: relative;
    }
    .my-tab > li.active > a, .my-tab > li.active > a:hover, .my-tab > li.active > a:focus{
        color:#074777;
    }
    .my-tab > li > a:hover, .my-tab > li > a:focus{
        background: #d7dfea none repeat scroll 0 0;
    }
    .band_div img {
        float: left;
        padding-right: 10px;
    }
    .views > h3 {
        font-size: 16px;
        font-weight: bold;
        margin: 0;
    }
    .band_div > a {
        font-size: 13px;
    }
    .row.tab-list-wrapper {
        margin-top: 20px;
    }
    .views > span {
        font-size: 12px;
    }
    .more_link.text-right {
        margin-top: 15px;
    }
    .facebook_like {
        background: #ccc none repeat scroll 0 0;
        margin-top:0px;
        padding: 20px;
    }
    .my-ticket-div > h4 {
        background: #b34200 none repeat scroll 0 0;
        color: #fff;
        padding: 10px 15px;
    }
    .my-ticket-div {
        background: #fff none repeat scroll 0 0;
        padding-bottom: 15px;
    }
    .my-ticket-div > p {
        padding: 0 15px;
    }
    .login_side {
        padding-left: 15px;
    }
    .login_side > a {
        color:#FF8734;
    }
    #owl-demo-2 .item{
        margin: 3px;

    }
    #owl-demo-2 .item img{
        display: block;
        width: 100%;
        height: auto;

    }
    .item_img{
        position: relative;
    }
    .over_img > span {
        background: #fef504 none repeat scroll 0 0;
        color: #000;
        font-weight: bold;
        padding: 5px;
    }
    .over_img h4 {
        color: #fef504;
        font-size: 12px;
        margin-bottom: 0;
        padding: 5px;
    }
    .over_img p {
        color: #fff;
        font-size: 10px;
        margin-bottom: 0px;
        padding: 5px;
    }
    .list_img {
        background: #000 none repeat scroll 0 0;
    }
    .over_img {
        bottom: 0;
        position: absolute;
        z-index: 999999;
    }
    .img_detail > a {
        color: orange;
        display: block;
        font-size: 13px;
        font-weight: bold;
        margin-top: 10px;
    }
    .img_detail > p {
        font-size: 12px;
    }
    .img_detail img {
        max-width: 90px;
    }
    .custom_demo.owl-carousel.owl-theme {
        margin-top: 15px;
    }
    .custom_demo .owl-pagination {
        display: none;
    }
    .custom_demo .owl-prev {
        background: #000 none repeat scroll 0 0 !important;
        border-radius: 0 !important;
        color: #fff !important;
        left: 0;
        opacity: 1 !important;
        position: absolute;
        top: 80px;
    }
    .custom_demo .owl-next{
        background: #000 none repeat scroll 0 0 !important;
        border-radius: 0 !important;
        color: #fff !important;
        right:0;
        opacity: 1 !important;
        position: absolute;
        top: 80px;   
    }
    .hot_tickets_div > h4 {
        background: #fcfcfc none repeat scroll 0 0;
        border-bottom: 1px solid #ccc;
        font-size: 16px;
        padding: 15px;
        margin: 0px;
    }
    .hot_tickets_div h4 > span {
        background: #000 none repeat scroll 0 0;
        border-radius: 5px 5px 0 0;
        color: #fff;
        padding: 5px 15px 13px;
    }
    .hot_tickets_div {
        border: 1px solid #ccc;
        margin-top: 35px;
        border-bottom: none;
    }
    .date_div {
        background: #ff8734 none repeat scroll 0 0;
        padding: 15px;
        text-align: center;
    }
    .date_div > h4 {
        color: #fff;
        font-size: 16px;
        margin: 0;
    }
    .date_div b {
        display: block;
        font-size: 26px;
    }
    .date_div span {
        background: transparent none repeat scroll 0 0 !important;
        font-size: 12px;
    }
    .hot_ticket_list > a {
        color:#ff8734;
    }
    .hot_ticket_list > p {
        margin-bottom:0px;
    }
    .hot_ticket_col {
        background: #fff none repeat scroll 0 0;
        padding: 7px;
    }
    .hot_ticket_list > span {
        color: #888;
        font-size: 12px;
    }
    .btn.btn-ticket {
        background:#555555 none repeat scroll 0 0;
        color: #fff;
    }
    .btn-parent {
        background: #f5f5f5 none repeat scroll 0 0 !important;
        padding: 30px 20px;
    }
    .ticket_wrapper {
        background: #efefef none repeat scroll 0 0;
        margin: 0px;

    }
    .ticket_col {
        border-bottom: 1px solid #ccc;
        padding-bottom:15px;
        margin-top: 20px;
    }
    .divider_container {
        border-bottom: 1px solid #ccc;
        padding-bottom: 50px;
    }

    /*Css for Related items of comaedy page*/
    .related_section {
        background: #f8f8f8 none repeat scroll 0 0;
        padding-bottom: 50px;
    }
    .related_div > h4 {
        background: #fff none repeat scroll 0 0;
        color:#FF8734;
        margin: 0;
        padding: 10px;
    }
    .related_img {
        background:#EFEFEF;
    }
    .related_slide_detail > h4 {
        font-size: 14px;
        margin-top: 0px;
    }
    .related_slide_detail {
        background: #fff none repeat scroll 0 0;
        padding: 5px 8px 10px;
    }
    #owl-demo .item{
        margin: 3px 10px;
    }
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
    .related_img img {
        padding: 10px;
    }
    .related_slide_detail img {
        max-width: 75px;
    }


    .foo-slider{

        position: absolute;
        background: gray !important;
        z-index: 9999999;
        width: 100%;
        bottom: 0px;
        height: 85px;
        padding-top: 0px;
        margin-top: 0px;
        color: white;
        opacity: 0.8;
        padding-left: 10px;
    }

    .owl-prev{
        display: none !important;
    }
    .owl-next{
        z-index: 99;
        top: 113px !important;
        margin-right: 68px !important;
    }

    .club_slider_img {
        min-height: 300px;
        max-height: 300px;
        width: 100%;
    }

    .imgg_club{
        height: 180px !important;
        width: 100% !important;
    }



</style>
