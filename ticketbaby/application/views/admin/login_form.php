<?php include('includes/login-header.php'); ?>

	<?
				//Temporary block to IP addresses //
				
				$Access=0;
				$DEAN='/';
				$IP=$_SERVER['REMOTE_ADDR'];
				
				if($IP=="124.253.59.218")		$Access=1;
				if($IP=="82.45.55.223")			$Access=1;
				if($IP=="110.172.135.22")		$Access=1;
				if($IP=="209.209.231.102")		$Access=1;
				
				if($IP=="82.43.155.114")		$Access=1;
				
				if($Access==1)
					$DEAN='login/process';
				
	?>
    
    
    <body class="full-width page-condensed">

        <!-- Navbar -->
        <div class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-right">
                    <span class="sr-only">Toggle navbar</span>
                    <i class="icon-grid3"></i>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="<?php echo site_url('uploads/logo/'.$logo->image); ?>" alt="<?php echo $logo->site_title; ?>">
                </a>
            </div>
        </div>
        <!-- /navbar -->
        
        <!-- Login wrapper -->
        <div class="login-wrapper">
            <form action="<?=admin_url($DEAN);?>" method="post" role="form" name="form" onSubmit="return validateForm()">
                <div class="popup-header">
                    <a href="#" class="pull-left"><i class="icon-user-plus"></i></a>
                    <span class="text-semibold">User Login::</span>
                    <div class="btn-group pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></a>
                        <ul class="dropdown-menu icons-right dropdown-menu-right">
                            <li><a href="#"><i class="icon-info"></i> Forgot password?</a></li>
                        </ul>
                    </div>
                </div>
                <div class="well">
                    <div class="form-group has-feedback">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username"><i class="icon-users form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback"><label>Password:</label>
                        <input type="password" name="password" class="form-control" placeholder="Password"><i class="icon-lock form-control-feedback"></i>
                    </div>
                    <div class="row form-actions">
<!--                         <div class="col-xs-6">
                            <div class="checkbox checkbox-success">
                                <label>
                                    <input type="checkbox" class="styled">Remember me</label>
                            </div>
                        </div> -->
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-warning pull-right"><i class="icon-menu2"></i> Sign in</button>
                        </div>
                    </div>
                </div> 
            </form>
        </div>
        <!-- /login wrapper --> 
        
        <!-- Footer --> 
		<?php
        include('includes/footer.php'); ?>