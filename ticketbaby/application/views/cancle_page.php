<?php include 'includes/header.php'; ?>
<section class="logo_title">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="order-panel">
                    <h1>Order Cancelled</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="order_detail">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                <div class="order_conent">
                    <h1 style="color:#d9534f;">Your order has been cancelled!</h1>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">

                        <?php if(isset($detail)) { ?>
                        <div class="order_table">
                            <h3>You will receive a confirmation email shortly</h3>
                            <p>A cancellation email will be sent to the email address used as checkout.</p>

                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><p> &pound; <?php echo sprintf('%.2f',$detail->subtotal); ?></p></td>
                                        <td><p class="btn btn-danger">Canceled</p></td>
                                    </tr>

                                </tbody>
                            </table>
                          
                        </div>
                        <?php } ?>
  <span><strong>Note : Your Tranaction was cancelled. you may exit this page or continue shopping here by <a href="<?php echo base_url(); ?>">clicking here</a> to continue on <a href="<?php echo base_url(); ?>">ticketbaby</a></strong></span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>



<?php // include 'includes/footer.php'; ?>