
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

            <li class="<?php
            if ($this->uri->segment('2') == 'slider') {
                echo "active";
            }
            ?>">
                <a href="<?php echo admin_url('slider'); ?>"><span>Slider</span> <i class="icon-images"></i></a>
            </li>  

			<li class="<?php
            if ($this->uri->segment('2') == 'homepage_banner') {
                echo "active";
            }
            ?>">
                <a href="<?php echo admin_url('homepage_banner'); ?>"><span>Homepage Banner</span> <i class="icon-images"></i></a>
            </li>  
            

            <li class="<?php
            if ($this->uri->segment('2') == 'menu') {
                echo "active";
            }
            ?>">
                <a href="<?php echo admin_url('menu'); ?>"><span>Menu</span> <i class="icon-menu"></i></a>
            </li> 

            <li class="<?php
            if ($this->uri->segment('2') == 'category') {
                echo "active";
            }
            ?>">
                <a href="<?php echo admin_url('category'); ?>"><span>Categories</span> <i class="icon-newspaper"></i></a>
            </li> 

            <li class="<?php
            if ($this->uri->segment('2') == 'awards') {
                echo "active";
            }
            ?>">
                <a href="<?php echo admin_url('awards'); ?>"><span>Galas and Awards</span> <i class="icon-newspaper"></i></a>
            </li> 
            
            
              <li class="<?php  if ($this->uri->segment('2') == 'pageslider') {echo "active"; } ?>">
                <a href="<?php echo admin_url('pageslider'); ?>"><span>Page slider</span> <i class="icon-newspaper"></i></a>
            </li> 
            
        
             <li>
                <a href="#" class="expand <?php
                if ($this->uri->segment('2') == 'events' || $this->uri->segment('2') == 'events') {
                    echo "level-opened";
                }
                ?>"><span>Events</span> <i class="icon-wrench"></i></a>
                <ul>
                    <li><a href="<?php echo admin_url('events'); ?>">All Events</a></li>
                    <li><a href="<?php echo admin_url('events/add'); ?>">Add Events</a></li>
                    <li><a href="<?php echo admin_url('promote_events'); ?>">Promote Events</a></li>
				</ul>
              </li>
            
          <li class="<?php
            if ($this->uri->segment('2') == 'users') {
                echo "active";
            }
            ?>">
                <a href="<?php echo admin_url('users'); ?>"><span>Users</span> <i class="icon-newspaper"></i></a>
            </li> 
            
            
            <li class="<?php
            if ($this->uri->segment('2') == 'orders') {
                echo "active";
            }
            ?>">
                <a href="<?php echo admin_url('orders'); ?>"><span>Orders</span> <i class="icon-newspaper"></i></a>
            </li> 
            
            
            <li class="<?php
            if ($this->uri->segment('2') == 'subscribers') {
                echo "active";
            }
            ?>">
                <a href="<?php echo admin_url('subscribers'); ?>"><span>Subscribers</span> <i class="icon-newspaper"></i></a>
            </li> 


            

            <li class="<?php
            if ($this->uri->segment('2') == 'page') {
                echo "active";
            }
            ?>">
                <a href="<?php echo admin_url('page'); ?>"><span>Page's</span> <i class="icon-newspaper"></i></a>
            </li>

            <!--             <li>
                            <a href="#" class="expand <?php
            if ($this->uri->segment('2') == 'post' || $this->uri->segment('2') == 'post_category') {
                echo "level-opened";
            }
            ?>"><span>Post</span> <i class="icon-newspaper"></i></a>
                            <ul>
                                <li><a href="<?php echo admin_url('post_category'); ?>">Post Category</a></li>
                                <li><a href="<?php echo admin_url('post'); ?>">Posts</a></li>
                            </ul>
                        </li> -->





            <li>
                <a href="#" class="expand <?php
                if ($this->uri->segment('2') == 'settings' || $this->uri->segment('2') == 'user_management') {
                    echo "level-opened";
                }
                ?>"><span>Settings</span> <i class="icon-wrench"></i></a>
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
