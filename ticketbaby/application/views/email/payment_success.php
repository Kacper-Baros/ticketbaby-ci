<html>
<head>
    <title>Success Email</title>
</head>
<body style="width: 1024px;font-family: 'Open Sans', sans-serif !important;">
<div style="height: 64px;display: block; box-sizing: border-box; background: #FF8734; border-bottom: 2px solid #ccc; top: 0; width: 100%; z-index: 999;">
<div style="padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;">
	<div style="margin-right: -15px;margin-left: -15px;">
		<div style="width: 16.66666667%; position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;">
			<div style="width: 150px; padding-top: 4px; padding-bottom: 2px;">
				<a href="http://ticketbaby.co.uk/"><img style="display: block;max-width: 100%;height: auto; margin-left: 50px;" src="http://ticketbaby.co.uk/assets/images/logo.png" alt=""></a>
			</div>
		</div>
	</div>
</div>
</div>
<div style="margin-left:80px; margin-top: 10px;">
        <?php 
			  $detail = $this->session->userdata('client');
			  $tables = $this->session->userdata('tables');
		 ?>
		<p style="float: right; font-weight: 600; margin-right: 140px; text-transform: uppercase;">Order Confirmation</p>
		<p style="float: right; font-weight: 600; margin-right: -100px; text-transform: uppercase;"> ID#: <?php echo @$detail['cart_id']; ?></p>
		<br> 
        <i>Hello <?php echo @$detail['cardholder_first_name']; ?>,</i>        
        <p>Your order has been placed successfully. Thank you</p>
        <b>Billing Information</b>
        <p>Name: <?php echo @$detail['cardholder_first_name'] . ' ' . $detail['cardholder_last_name']; ?></p>
        <p>Email: <?php echo @$detail['cardholder_email']; ?></p>
        <p>Address: <?php echo @$detail['cardholder_address']; ?></p>
        <p>Area: <?php echo @$detail['cardholder_area']; ?></p>
        <p>City: <?php echo @$detail['cardholder_city']; ?></p>
        <p>Contact Number: <?php echo @$detail['cardholder_contact_number']; ?></p>
        <br><br><br>
		<?php
		$tbl_event = $this->db->get_where('tbl_events', array('id' => $detail['event_id']))->row();
		$event_name = $tbl_event->name;
		?>
        <table width="100%">
            <tr style="background-color: #ddd; border: none !important; height: 30px;">
                <th style="width:10%";>Quantity</th>
				<th style="width:17%;">Event</th>
                <th>Item</th>
                <th>Section</li>
                <th>Type</li>
                <th>Table No.</li>
                <th style="width:8%;">Unit Price</th>
                <th>Total</th>
            </tr>
                <?php  
						//$z = 1;
					    $total="";
						$quantity = '';
               		 foreach ($tables as $s) { ?>
					 <?php
						if ($s['section'] == 'Tables Only' || ($s['section'] == 'Table Tickets' && @$s['table']!='')){
							$quantity = count($s['table']);
						} else if($s['section'] == 'Table Tickets'){ 
							foreach ($s['seat'] as $ss => $val){
								if ($val != 0) {
									$quantity = $val;
								}
							}
						}
					  ?>
                    <tr>
                        <td style="border-left: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;width:10%;"><?php echo $quantity; ?></td>
						<td style="border-left: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;width:24%;"><?php echo $event_name; ?></td>
                        <td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;"><?php echo $s['section']; ?></td>
                        <td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;"><?php echo $s['section']; ?></td>
            			<td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;"><?php echo $s['class']; ?></td>
                        <td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;"><?php  foreach($s['table'] as $tbl) { echo "(".$tbl.")"; } 
						if($s['section'] == 'Table Tickets'){
							foreach ($s['table'] as $tbl => $val){
								echo "(".$tbl.")";
							}
						}
						?>
						</td>
                        <?php //if ($s['section'] == 'Tables Only') {
							if ($s['section'] == 'Tables Only' || ($s['section'] == 'Table Tickets' && @$s['table']!='')){
							 ?>
                            <td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;width:8%;">(<?php echo count($s['table']) ?> * <?php echo $s['table_charge'] ?>)</td>
                        <?php } else if($s['section'] == 'Table Tickets'){ ?>
                            <td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;">
                                    <?php
                                    $sum_tickets = 0;
                                    foreach ($s['seat'] as $ss => $val){
                                        if ($val != 0) {
                                            ?>
                                            <span>(<?php echo $val ?> * <?php echo $s['seat_charge'] ?>)</span>
                                            <?php
                                            $sum_tickets += $val * $s['seat_charge'];
                                        }
                                    }
                                }
                              ?>
                        </td>
                       		<td style="border-right: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;">&pound; <?php
                            $sum = count($s['table']) * $s['table_charge'];
                            //if ($s['section'] == 'Tables Only') {
							if ($s['section'] == 'Tables Only' || ($s['section'] == 'Table Tickets' && @$s['table']!='')) {
                                echo $sum;
								$sub =$sum;
                            } else if($s['section'] == 'Table Tickets'){
                                echo $sum_tickets;
								$sub =$sum_tickets;
                            }
							$total=$total+$sub;
                            ?></td>

                    </tr>
				<?php   /*$z++;*/   } ?>
				
                 <?php 
				 	/// after_party ///////////
				  		$ses = $this->session->userdata('after_party'); 
						if (!empty($ses)){ 
						?>
							<tr>
						 <?php 
							$after_party_price="";
							foreach($ses['after_party'] as $key=>$val){
						 ?>		
								<td style="border-left: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;"> <?php echo $ses['after_party'][$key]['total']; ?></td>
								<td style="border-left: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;"><?php echo $event_name; ?></td>
								<td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;">Additional</td>
								<td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;">Additional</td>
								<td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;"><?php echo $ses['after_party'][$key]['name']; ?></td>
								<td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;">N/A</td>
                                <td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;"><?php echo  "(".$ses['after_party'][$key]['seat_charge'] ."*". $ses['after_party'][$key]['total'].")"; ?> </td>
								<td style="border-right: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;">&pound; <?php echo  $ses['after_party'][$key]['seat_charge'] * $ses['after_party'][$key]['total']; 
									 $after_party_price = $after_party_price + $ses['after_party'][$key]['seat_charge'] * $ses['after_party'][$key]['total']; ?>
                                 </td>    	
								</tr>
								
						 <?php 
							/*$z++;*/
						 } ?>       
							</tr>
							<?php
						}
						
					//////////tickets/////
					
				  		$tickets = $this->session->userdata('tickets'); 
						if (!empty($tickets)) 
						{ 
						?>
							<tr>
						 <?php 
							$tickets_price="";
							foreach($tickets['tickets'] as $key=>$val)
					  		{
						 ?>		
								<td style="border-left: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;"> <?php echo $tickets['tickets'][$key]['total']; ?></td>
								<td style="border-left: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;"><?php echo $event_name; ?></td>
								<td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;">Tickets Only</td>
								<td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;">Tickets Only</td>
								<td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;"><?php echo $tickets['tickets'][$key]['name']; ?></td>
								<td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;">N/A</td>
                                <td style="border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;"><?php echo  "(".$tickets['tickets'][$key]['seat_charge'] ."*". $tickets['tickets'][$key]['total'].")"; ?> </td>
								<td style="border-right: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px;text-align: center;">&pound; <?php echo  $tickets['tickets'][$key]['seat_charge'] * $tickets['tickets'][$key]['total']; 					
									$tickets_price = $tickets_price + $tickets['tickets'][$key]['seat_charge'] * $tickets['tickets'][$key]['total']; ?>
                                 </td>
								</tr>
								
						 <?php 
							/*$z++;*/
						 } ?>       
							</tr>
							<?php
						}
					 //$order_details = $this->Front_model->fetch_detail_awards($tables[0]['event_id']);
				  ?>
					<tr>
						<td style="border-left: 1px solid #ddd !important; border-right: 1px solid #ddd !important; height: 30px;" colspan="6">&nbsp;</td>
					</tr>
					<tr>
                        <td style="border-left: 1px solid #ddd !important;" colspan="6"></td>
                        <?php if ($order_details->postage_status == 0) { ?>
							<td style="border-left: 7px solid #FF8734 !important; border-top:  1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px; padding-left: 18px;" colspan="1">Postage Fees:</td>
							<td style="border-right: 1px solid #ddd !important; border-top:  1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px; padding-left: 18px;" colspan="1"> &pound; <?php echo $order_details->postage_fee; ?></td>
                        <?php } else { ?>
							<td style="border-left: 7px solid #FF8734 !important; border-bottom: 1px solid #ddd !important; height: 30px; padding-left: 18px;" colspan="1">Postage Fees:</td>
							<td style="border-right: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px; padding-left: 18px;" colspan="1"> &pound; <?php echo $order_details->postage_fee; ?> %</td>
                        <?php } ?>
                    </tr>
                   <tr>
						<td style="border-left: 1px solid #ddd !important;color: #F7CEAF; font-weight: 600; font-size: 18px;text-align: center;" colspan="6"><i>We Got You Covered</i></td>
                	<?php if ($order_details->fulfillment_status == 0) { ?>
						<td style="border-left: 7px solid #FF8734 !important; border-bottom: 1px solid #ddd !important; height: 30px; padding-left: 18px;" colspan="1">Fulfillment Fees:</td>
						<td style="border-right: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px; padding-left: 18px;" colspan="1"> &pound; <?php echo $order_details->fulfillment_fee; ?></td>
                   <?php } else { ?>
						<td style="border-left: 7px solid #FF8734 !important; border-bottom: 1px solid #ddd !important; height: 30px; padding-left: 18px;" colspan="1">Fulfillment Fees:</td>
						<td style="border-right: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px; padding-left: 18px;" colspan="1"> &pound; <?php echo $order_details->fulfillment_fee ?> % </td>
                 <?php } ?>
					</tr>    
					<tr>
						<td style="border-left: 1px solid #ddd !important;" colspan="6"></td>
						<td style="border-left: 7px solid #FF8734 !important; border-bottom: 1px solid #ddd !important; height: 30px; padding-left: 18px;" colspan="1">Charges:</td>
						<?php if ($order_details->creditcard_status == 0) { ?>
						<td style="border-right: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px; padding-left: 18px;" colspan="1"> &pound; <?php echo $order_details->creditcard_fee; ?></td>
						 <?php }else{ ?>
						 <td style="border-right: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; height: 30px; padding-left: 18px;" colspan="1"> &pound; <?php echo $order_details->creditcard_fee; ?> % </td>
						 <?php   } ?>
					</tr>
                   <tr>
						<td style="background-color: #ddd; border: none !important; height: 30px; font-weight: 600; text-align: right;" colspan="7">Total: </td>
						<td style="background-color: #ddd; border: none !important; height: 30px;font-weight: 600;text-align: center;" colspan="1"> &pound;  <?php echo @$total+$order_details->fulfillment_fee+$order_details->postage_fee+$order_details->creditcard_fee+$after_party_price+$tickets_price; ?></td>
					</tr>
            </table><br>
            <p style="text-align: right;"><i style="color: #ddd; font-weight: 600; vertical-align: baseline;">Online Payment Process By </i><img src="http://ticketbaby.co.uk/assets/images/worldpay-logo.png"></p>
			<p style="font-size:20px;font-weight:bold;">Print your E-Ticket from <a href="http://ticketbaby.co.uk/eticket/<?php echo @$detail['order_id']; ?>">Here</a></p>
            <p style="text-align:center;">Thank you for using TicketBaby Internet Ticket System</p>
</div>
</body>
</html>