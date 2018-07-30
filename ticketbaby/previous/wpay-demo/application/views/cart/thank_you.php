<div class="container-fluid order-cmplt">
	<div class="container ">   	
        <h2 style="font-weight: 700;">Order Completed<h2>
    </div>
</div>

<div class="container-fluid ">
	<div class="container message">
    	<div class="row">
            <div class="col-md-8 col-md-offset-2" >
            	<h1 style="" class="thankyou">Thank you for your purchase!</h1>
        		<p class="confrm-email">You will receive a conformation email shortly</p>
        		<p class="ammar">A confirmation email containg your order summary and invoice will be sent to the email address used at checkout</p>
        		
				<table class="table table-bordered">
				<thead>
					<tr>
					<th>Order Amount</th>
					<th>Item Description</th>
					<!--<th>Quantity</th>-->
					<th>Event</th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<td>&pound; <?php echo $cart_results['total_price']; ?></td>
					<td><?php echo $event['title']; ?></td>
					<!--<td>1.1.1</td>-->
					<td><a href="<?=base_url()?>index.php/event/<?php echo $event['slug']; ?>"><button class="btn btn-large btn-success">Details</button></a></td>
				</tr>
				</tbody>
				</table>
				
				<p class="ammar"><b>Note:</b> 
				This page will expire and return you to the home page short 
				after or you can click here to continue to shopping on ticketbaby</p>
				
            	<br/><br/>
            	<br/><br/><br/><br/>
            </div>
        </div>
        
    </div>
</div>






















