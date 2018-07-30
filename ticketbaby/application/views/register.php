<?php include 'includes/header.php' ?>
<section class="login_page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8 col-md-offset-2">
                <div class="login_div">

                    <i class="fa fa-user login_icon" aria-hidden="true"></i>
                    <h3>Register into your Ticket Baby</h3>

                    <form method="post" class="login_form" action="<?php echo base_url('register/register_user') ?>">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                <input type="text" class="form-control login-control" name="username" placeholder="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <span class="form_errors"><?php echo form_error('username') ?></span>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                <input type="text" class="form-control login-control" name="fullname" placeholder="FirstName LastName" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <span class="form_errors"><?php echo form_error('fullname') ?></span>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                <input type="email" class="form-control login-control" name="email" placeholder="Email" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <span class="form_errors"><?php echo form_error('email') ?></span>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                                <input type="text" class="form-control login-control" name="phone_no" placeholder="Phone Number" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <span class="form_errors"><?php echo form_error('phone_no') ?></span>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                <input type="password" class="form-control login-control" name="password" placeholder="Password" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <span class="form_errors"><?php echo form_error('password') ?></span>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                <input type="password" class="form-control login-control" name="re-password" placeholder="Retype Password" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <span class="form_errors"><?php echo form_error('re-password') ?></span>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success login-btn" value="Sign Up">
                        </div>
                        <div class="form-group not_account">
                            <p>Have an account? <a href="<?php echo base_url('login') ?>"> Login Now!</a></p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php' ?>

