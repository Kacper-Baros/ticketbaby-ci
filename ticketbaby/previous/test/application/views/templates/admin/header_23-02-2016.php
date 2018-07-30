<!DOCTYPE html>
<html lang="en">

<head>

<script src="<?=base_url()?>assets/bootstrap/js/bootstrap-select.min.js"></script>
<script src="<?=base_url()?>assets/bootstrapvalidator/bootstrapValidator.min.js"></script>
<script src="<?=base_url()?>assets/bootstrap/js/owl.carousel.min.js"></script>
<script src="<?=base_url()?>assets/bootstrap/js/jscript.js"></script>
<script src="<?=base_url()?>assets/js/t-baby.min.js"></script>
<script src="<?=base_url()?>assets/js/new-t-baby.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>jss/jquery.flexisel.js"></script>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ticket Baby - Administrator Panel</title>

    <?php $this->load->helper('url');?>

    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=base_url()?>assets/metisMenu/metisMenu.min.css" rel="stylesheet">


    <?php if ($title && $title == 'Dashboard') { ?>
    <!-- Morris Charts CSS -->
    <link href="<?=base_url()?>assets/morrisjs/morris.css" rel="stylesheet">
    <?php } ?>

    <!-- Custom Fonts -->
    <link href="<?=base_url()?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="<?=base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>



    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php $admin_session = $this->session->userdata('admin_session'); ?>
                <a class="navbar-brand" href="<?=base_url()?>index.php/admin/">Ticket Baby - Welcome <?php echo $admin_session['first_name']; ?> !</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">


                <li class="dropdown" style="visibility:hidden;">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown" style="visibility:hidden;">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                         <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->



                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Users
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Events
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> New Orders
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <!--
                        <li class="divider"></li>
                        
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        -->
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?=base_url()?>index.php/admin/user/profile"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="<?=base_url()?>index.php/admin/setting"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=base_url()?>index.php/admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li class="active">
                            <a href="<?=base_url()?>index.php/admin/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        
                        <li>
                            <a href="#"><i class="fa fa-sitemap"></i> Categories <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="fa fa-arrow-right -o" class="active" href="<?= base_url()?>index.php/admin/category/"> All Categories</a>
                                </li>
                             </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o"></i> Events <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="fa fa-arrow-right -o" class="active" href="<?= base_url()?>index.php/admin/event/"> All Events</a>
                                </li>
                                <li>
                                    <a class="fa fa-plus -o" href="<?=base_url()?>index.php/admin/event/edit/"> Add New</a>
                                </li>
                                <li>
                                    <a class="fa fa-arrow-right -o" href="<?=base_url()?>index.php/admin/event/promote/"> Promote Events</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-files-o"></i> Orders <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="fa fa-arrow-right -o" class="active" href="<?= base_url()?>index.php/admin/order/"> All Orders</a>
                                </li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-files-o"></i> CMS <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="fa fa-arrow-right -o" href="<?= base_url()?>index.php/admin/page/"> All Page</a>
                                </li>
                                <li>
                                    <a class="fa fa-plus -o" href="<?=base_url()?>index.php/admin/page/edit/"> Add New</a>
                                </li>
                                <li>
                                    <a class="fa fa-plus -o" href="<?=base_url()?>index.php/admin/page/changeadvertisementvideo/"> Change Advertisement Video</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users -o"></i> Users <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="fa fa-arrow-right -o" class="active" href="<?=base_url()?>index.php/admin/user/"> All Users</a>
                                </li>
                                <li>
                                    <a class="fa fa-plus -o" href="<?=base_url()?>index.php/admin/user/edit/"> Add New</a>
                                </li>
                                <!--
                                <li>
                                    <a class="fa fa-user -o" href="<?=base_url()?>index.php/admin/user/profile"> Your Profile</a>
                                </li>
                                -->
                            </ul>
                        </li>
						 <li  class='<?php echo $active;?>'>
                            <a href="#"><i class="fa fa-users -o"></i> Client <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="fa fa-arrow-right -o" class="active" href="<?=base_url()?>index.php/admin/client/"> All Clients</a>
                                </li>
                                <li>
                                    <a class="fa fa-plus -o" href="<?=base_url()?>index.php/admin/client/edit/"> Add New</a>
                                </li>
                                
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-gear -o"></i> Settings <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="fa fa-arrow-right -o" class="active" href="<?=base_url()?>index.php/admin/ticket"> Ticket</a>
                                </li>
                                <li>
                                    <a class="fa fa-arrow-right -o" class="active" href="<?=base_url()?>index.php/admin/coupon"> Coupon</a>
                                </li>
                                <li>
                                    <a class="fa fa-arrow-right -o" class="active" href="<?=base_url()?>index.php/admin/setting"> Configuration</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <?php
            $flash_server_response = $this->session->flashdata('flash_server_response');
            if ( $flash_server_response && $flash_server_response["message"] ) {
              $alert_type = $flash_server_response["success"] ?  "alert-success" : "alert-danger";
              $alert_title = $flash_server_response["success"] ?  "Success!" : "Error!";
        ?>

        <div style="position:absolute;z-index:1000;width:100%" onclick="javascript:$(this).hide();">
            <div class="alert <?=$alert_type;?>" style="position:relative;margin:0 auto;width:40%;">
            <a href="#" class="close" data-hide="alert" data-dismiss="alert"> &times; </a>
            <strong><?=$alert_title;?></strong> <?=$flash_server_response["message"];?>
            </div>
        </div>

        <?php } ?>
       


