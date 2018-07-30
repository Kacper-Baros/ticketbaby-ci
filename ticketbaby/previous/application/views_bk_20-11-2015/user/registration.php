<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-select.min.css" />
<link rel="stylesheet" href="css/style.css">
<!-- jQuery library -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.flexisel.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $("#flexiselDemo1").flexisel();
});
</script>
<script src="js/bootstrap-select.js"></script>
<title>Registration - TicketBaby</title>
</head>



<div class="container-fluid content-bg">
	<div class="container content">
        <div class="row no-mar main-content">
			<div class="col-xs-12">
				<div class="col-md-6 col-md-offset-3 col-xs-12 bg-ar cus-form3"><br/>
						<center>
						<?php if($this->session->flashdata('error')) { ?>                    
                        <p style="color:red">
                            <?php echo $this->session->flashdata('error');?>
                        </p>                   
                    <?php } 
					 elseif($this->session->flashdata('success')) { ?>                    
                        <p style="color:green">
                            <?php echo $this->session->flashdata('success');?>
                        </p>                   
                    <?php }?>
                        
							<h2 class="text-center"><i class="glyphicon glyphicon-user"></i></h2>
							<h3></h3><br/>
						</center>
					<form class="form-horizontal" name="form" id="" method="POST" action="<?php echo base_url();?>index.php/user/save_registration">   
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="text" class="form-control" required value="<?php echo $user_name;?>" name="user_name" placeholder="Username"/>
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="text" class="form-control" required  name="first_name" placeholder="Full Name" value="<?php echo $first_name;?>"/>
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
								<input type="email" class="form-control" required name="email"  placeholder="Email" value="<?php echo $email;?>"/>
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
								<input type="text" class="form-control" required name="contact_number" placeholder="Phone Number" value="<?php echo $contact_number;?>"/>
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input type="password" class="form-control" required name="password" placeholder="Password" value="<?php echo $password;?>"/>
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input type="password" class="form-control" required name="re_password" placeholder="Re-tpye Password" value=""/>
							</div>
							<div class="form-group text-right">
								<input type="submit" class="btn btn-default btn-block"  name="submit"  value="SignUp" /><br/>
							</div>
						</form>
					</div>
					<div class="col-xs-12">&nbsp;</div>
					<div class="col-xs-12 text-center">
						<p>Have an account? <a href="<?php echo base_url();?>index.php/user/login">Login Now</a>!</p>
					</div>
			</div>
        </div>
    </div>

    </div>


