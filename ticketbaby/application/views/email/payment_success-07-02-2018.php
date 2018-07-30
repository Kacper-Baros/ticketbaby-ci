<html>
<head>
    <title>Success Email</title>
</head>
<body>
        <?php 
		
			  $detail = $this->session->userdata('client');
			  $tables = $this->session->userdata('tables');
			
		 ?>
        <b>Hello, <?php echo @$detail['cardholder_first_name']; ?></b>
        <br>
        <p>Your order has been placed successfully. Thank you</p>
        <b>Billing Information</b>
        <p>Name: <?php echo @$detail['cardholder_first_name'] . ' ' . $detail['cardholder_last_name']; ?></p>
        <p>Email: <?php echo @$detail['cardholder_email']; ?></p>
        <p>Address: <?php echo @$detail['cardholder_address']; ?></p>
        <p>Area: <?php echo @$detail['cardholder_area']; ?></p>
        <p>City: <?php echo @$detail['cardholder_city']; ?></p>
        <p>Contact Number: <?php echo @$detail['cardholder_contact_number']; ?></p>
        
        <table width="100%" style="border-collapse:collapse;text-align:center;" border="1">
            <tr style="border:7px solid #ddd">
                <th>No</th>
                <th>Section</th>
                <th>Type</li>
                <th>Table Type</li>
                <th>Table</li>
                <th>Price</th>
                <th>Total</th>
            
            </tr>
                <?php  
				
						$z = 1;
					    $total="";
               		 foreach ($tables as $s) { ?>
                    <tr style="border:7px solid #ddd">
                        <td><?php echo $z; ?></td>
                        <td><?php echo $s['class']; ?></td>
                        <td><?php echo $s['section']; ?></td>
            			<td><?php echo $s['class']; ?></td>
                        <td><?php  foreach($s['table'] as $tbl) { echo "(".$tbl.")"; } ?></td>
                        <?php if ($s['section'] == 'Table') {
							 ?>
                            <td><span style="font-weight:100;"></span> (<?php echo count($s['table']) ?> * <?php echo $s['table_charge'] ?>)</td>
                        <?php } else { ?>
                            <td><span style="font-weight:100;"></span>
                                    <?php
                                    $sum_tickets = 0;
                                    foreach ($s['seat'] as $ss => $val) {
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
                       		<td>&pound; <?php
                            $sum = count($s['table']) * $s['table_charge'];
                            if ($s['section'] == 'Table') {
                                echo $sum;
								$sub =$sum;
                            } else {
                                echo $sum_tickets;
								$sub =$sum_tickets;
                            }
							$total=$total+$sub;
                            ?></td>

                    </tr>
				<?php   $z++;   } ?>
				
                 <?php 
				 	/// after_party ///////////
				  		$ses = $this->session->userdata('after_party'); 
						if (!empty($ses)) 
						{ 
						?>
							<tr>
						 <?php 
							$after_party_price="";
							foreach($ses['after_party'] as $key=>$val)
					  		{
						 ?>		
								<td> <?php echo $z; ?></td>
								<td>Addtional</td>
								<td><?php echo $ses['after_party'][$key]['name']; ?></td>
								<td><?php echo $ses['after_party'][$key]['name']; ?></td>
								<td><span style="font-weight:100;"></span> ( <?php echo $ses['after_party'][$key]['total']; ?>)</td>
                                <td><?php echo  "(".$ses['after_party'][$key]['seat_charge'] ."*". $ses['after_party'][$key]['total'].")"; ?> </td>
								<td>&pound; <?php echo  $ses['after_party'][$key]['seat_charge'] * $ses['after_party'][$key]['total']; 
									 $after_party_price = $after_party_price + $ses['after_party'][$key]['seat_charge'] * $ses['after_party'][$key]['total']; ?>			
                                 </td>    	
								</tr>
								
						 <?php 
							$z++;
						 } ?>       
							</tr>
							<?php
						}
						
					////////// tickets/////
					
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
								<td> <?php echo $z; ?></td>
								<td>Addtional</td>
								<td><?php echo $tickets['tickets'][$key]['name']; ?></td>
								<td><?php echo $tickets['tickets'][$key]['name']; ?></td>
								<td><span style="font-weight:100;"></span> ( <?php echo $tickets['tickets'][$key]['total']; ?>)</td>
                                <td><?php echo  "(".$tickets['tickets'][$key]['seat_charge'] ."*". $tickets['tickets'][$key]['total'].")"; ?> </td>
					<td>&pound; <?php echo  $tickets['tickets'][$key]['seat_charge'] * $tickets['tickets'][$key]['total']; 					
									$tickets_price = $tickets_price + $tickets['tickets'][$key]['seat_charge'] * $tickets['tickets'][$key]['total']; ?>			
                                 </td>    	
								</tr>
								
						 <?php 
							$z++;
						 } ?>       
							</tr>
							<?php
						}
						
					 $order_details = $this->Front_model->fetch_detail_awards($tables[0]['event_id']);
				  ?>
                 
                   <tr style="font-size: 20px; font-weight: bold;border:7px solid #ddd;text-align:right;">
                	<?php if ($order_details->fulfillment_status == 0) { ?>
                       <td colspan="7" >Fulfilment Fees   &pound; <?php echo $order_details->fulfillment_fee; ?></td>
                   <?php } else { ?>
                   <td>Fulfilment Fees   <?php echo $order_details->fulfillment_fee ?> % </td>
                 <?php } ?>
                </tr>    
                   <tr style="font-size: 20px; font-weight: bold;border:7px solid #ddd;text-align:right;">
                        
                        <?php if ($order_details->postage_status == 0) { ?>
                            <td colspan="7" >
                                Postage Fees  &pound; <?php echo $order_details->postage_fee; ?>
                            </td>
                        <?php } else { ?>
                            <td>
                                Postage Fees  <?php echo $order_details->postage_fee; ?> %
                            </td>
                        <?php } ?>
                    </tr>  
                   <tr style="font-size: 20px; font-weight: bold;border:7px solid #ddd;text-align:right;">
            	<td colspan="7">SUBTOTAL - &pound;  <?php echo @$total+$order_details->fulfillment_fee+$order_details->postage_fee+$after_party_price+$tickets_price; ?></td>
            </tr>
            </table>
            
            
    </body>

</html>