<?php  include 'includes/header.php'; ?>
<section class="login_page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-3">
                    <div class="login_div">
                    <i class="fa fa-lock login_icon" aria-hidden="true"></i>
                    <h3>Login into your Ticket Baby</h3>
                         <?php if($this->session->flashdata('success')) { ?>
                    <h4 class="success_msg"><?php echo $this->session->flashdata('success'); ?></h4>
                    <?php } ?>
                         <?php if($this->session->flashdata('unsuccess')) { ?>
                    <h5 class="unsuccess_msg"><?php echo $this->session->flashdata('unsuccess'); ?></h5>
                    <?php } ?>
                    <form class="login_form" method="post" action="<?php echo base_url('login/login_process') ?>">
                        <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                          <input type="text" class="form-control login-control" name="username" placeholder="Username" aria-describedby="basic-addon1">
                        </div>
                            <span class="form_errors"><?php echo form_error('username') ?></span>
                        </div>
                        <div class="form-group">
                           <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
                          <input type="password" name="password" class="form-control login-control" placeholder="Password" aria-describedby="basic-addon1">
                        </div>
                               <span class="form_errors"><?php echo form_error('password') ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success login-btn" value="Login">
                        </div>
                        <div class="form-group not_account">
                            <p>Don't have account? <a href="<?php echo base_url('register') ?>"> Register Now!</a></p>
                        </div>
                    </form>
                    </div>

                </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

