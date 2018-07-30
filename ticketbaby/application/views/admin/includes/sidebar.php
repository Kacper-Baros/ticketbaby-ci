
<div class="sidebar collapse">
    <div class="sidebar-content">
        <!-- User dropdown -->
        <div class="user-menu dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo site_url('uploads/logo/' . $logo->image); ?>" alt="">
                <div class="user-info"><?php echo $logo->site_title; ?><span><?php echo $logo->site_email; ?></span>
                </div>
            </a>
            <div class="popup dropdown-menu dropdown-menu-right"> 
                <div class="thumbnail"> 
                    <div class="thumb">
                        <img alt="" src="<?php echo site_url('uploads/logo/' . $logo->image); ?>">
                        <div class="thumb-options">
                            <span>
                                <a href="<?php echo admin_url('settings'); ?>" class="btn btn-icon btn-success">
                                    <i class="icon-pencil"></i>
                                </a>
                            </span>
                        </div> 
                    </div> 
                    <div class="caption text-center"> 
                        <h6><?php echo $logo->site_title; ?><small><?php echo $logo->site_email; ?></small></h6> 
                    </div> 
                </div> 
                <ul class="list-group">

                </ul>
            </div>
        </div>
        <!-- /user dropdown -->
        <!-- Main navigation -->
        <ul class="navigation">
            <li class="<?php
            if (!isset($title)) {
                echo "active";
            }
            ?>">
                <a href="<?php echo admin_url(); ?>"><span>Dashboard</span> <i class="icon-screen2"></i></a>
            </li>
			<!-- Orders Menu -->
			<li class="<?php if ($this->uri->segment('2') == 'orders') { echo "active"; } ?>">
                <a href="<?php echo admin_url('orders'); ?>"><span>Orders</span> <i class="icon-newspaper"></i></a>
            </li>
			<!-- Events Menu -->
			 <li>
				<a href="#" class="expand <?php
				if ($this->uri->segment('2') == 'awards' || $this->uri->segment('2') == 'events' || $this->uri->segment('2') == 'promote_events') {
					echo "level-opened";
				}
				?>"><span>Events</span> <i class="fa fa-deviantart"></i></a>
				<ul>
					<li><a href="<?php echo admin_url('events'); ?>">All Events</a></li>
					<li><a href="<?php echo admin_url('awards'); ?>">Galas and Awards</a></li>
                    <li><a href="<?php echo admin_url('events/add'); ?>">Add Events</a></li>
                    <li><a href="<?php echo admin_url('promote_events'); ?>">Promote Events</a></li>
				</ul>
			 </li>
			<!-- Marketing Menu -->
			<li>
				<a href="#" class="expand <?php
				if ($this->uri->segment('2') == 'slider' || $this->uri->segment('2') == 'homepage_banner' || $this->uri->segment('2') == 'pageslider') {
					echo "level-opened";
				}
				?>"><span>Marketing</span> <i class="icon-images"></i></a>
				<ul>
					<li><a href="<?php echo admin_url('slider'); ?>">Slider</a></li>
					<li><a href="<?php echo admin_url('homepage_banner'); ?>">Homepage Banner</a></li>
					<li><a href="<?php echo admin_url('pageslider'); ?>">Page slider</a></li>
				</ul>
			 </li>
			 <!-- Page Setup Menu -->
			 <li>
				<a href="#" class="expand <?php
				if ($this->uri->segment('2') == 'category' || $this->uri->segment('2') == 'menu' || $this->uri->segment('2') == 'page') {
					echo "level-opened";
				}
				?>"><span>Page Setup</span> <i class="fa fa-gear"></i></a>
				<ul>
					<li><a href="<?php echo admin_url('category'); ?>">Categories</a></li>
					<li><a href="<?php echo admin_url('menu'); ?>">Menu</a></li>
					<li><a href="<?php echo admin_url('page'); ?>">Page's</a></li>
				</ul>
			 </li>
			 <!-- Registration Menu -->
			 <li>
				<a href="#" class="expand <?php
				if ($this->uri->segment('2') == 'users' || $this->uri->segment('2') == 'subscribers') {
					echo "level-opened";
				}
				?>"><span>Registration</span> <i class="fa fa-user"></i></a>
				<ul>
					<li><a href="<?php echo admin_url('users'); ?>">Users</a></li>
					<li><a href="<?php echo admin_url('subscribers'); ?>">Subscribers</a></li>
				</ul>
			 </li>
			 <!-- Customers Menu -->
			 <li>
				<a href="#" class="expand <?php
				if ($this->uri->segment('2') == '#' || $this->uri->segment('2') == '#') {
					echo "level-opened";
				}
				?>"><span>Manage Customers</span> <i class="fa fa-users"></i></a>
				<ul>
					<li><a href="#">Client Sales</a></li>
					<li><a href="#">Check-In List</a></li>
					<li><a href="#">Email Customers</a></li>
				</ul>
			 </li>
			 <!-- Reports Menu -->
			 <li>
				<a href="#" class="expand <?php
				if ($this->uri->segment('2') == '#' || $this->uri->segment('2') == 'customer_sales'){
					echo "level-opened";
				}
				?>"><span>Reports</span> <i class="fa fa-file-o"></i></a>
				<ul>
					<li><a href="#" data-toggle="modal" data-target="#exportmodal">General Report</a></li>
					<li><a href="<?php echo admin_url('customer_sales'); ?>">Customers Sales</a></li>
					<li><a href="<?php echo admin_url('outstanding_orders'); ?>">Outstanding Orders</a></li>
				</ul>
			 </li>
			 <!-- Settings Menu -->
			 <li>
				<a href="#" class="expand <?php
				if ($this->uri->segment('2') == 'settings' || $this->uri->segment('2') == 'user_management') {
					echo "level-opened";
				}
				?>"><span>Settings</span> <i class="fa fa-gears"></i></a>
				<ul>
					<li><a href="<?php echo admin_url('settings/profile'); ?>">Company Profile</a></li>
					<li><a href="<?php echo admin_url('ip_management'); ?>">IP Management</a></li>
					<li><a href="<?php echo admin_url('user_management'); ?>">User Management</a></li>
					<li><a href="<?php echo admin_url('ticket'); ?>">Ticket Class Setting</a></li>
					<li><a href="<?php echo admin_url('coupon'); ?>">Coupon Setting</a></li>
					<li><a href="<?php echo admin_url('settings'); ?>">Site Settings</a></li>

				</ul>
			 </li>


        </ul>
        <!-- /main navigation -->
    </div>
</div>
