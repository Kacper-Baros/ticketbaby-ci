       <!-- Page header --> 
        <div class="page-header">
            <div class="page-title">
                <h3>Dashboard <small>Welcome <?=$this->session->userdata('admin_name');?>, 12 hours since last visit</small></h3>
            </div>
        </div>
        <!-- /page header -->
        
        <!-- Breadcrumbs line -->
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo admin_url(); ?>">Home</a></li>
                <li class="active"><?php if(isset($title)){ echo $title; }else{ echo "Dashboard"; } ?></li>
            </ul>
            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
            <ul class="breadcrumb-buttons collapse">
                <li class="language dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo admin_img('flags/english.png'); ?>" alt=""> 
                        <span>English</span> 
                        <b class="caret"></b>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /breadcrumbs line --> 
