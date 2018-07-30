<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ticket Baby - Eticket</title>
<link href="<?php echo theme_css('eticket-style.css'); ?>" rel="stylesheet">
</head>
<body>
<?php 
	foreach($event_details as $evnt_detail){
		$EventName = $evnt_detail->name;
		$EventImage = $evnt_detail->image;
		$EventDate = $evnt_detail->start_date;
		$EventTime = strtoupper($evnt_detail->time);
		$Eventvenue = $evnt_detail->venue;
		$EventAddress = $evnt_detail->address;
		$Eventcity = $evnt_detail->city;
		$Eventcountry = $evnt_detail->country;
	}
		$dta = explode('/',$EventDate);
		$d = $dta['0'];
		$m = $dta['1'];
		$y = $dta['2'];
		$nwdta = $y.'-'.$m.'-'.$d;
		$dt = date_create($nwdta);
		$EventDate = date_format($dt, 'jS F Y');
		
	foreach($event_additionals as $evnt_adds){
		if($evnt_adds->organizerName!=''){
			$OrganizerName = $evnt_adds->organizerName;
		}else{
			$OrganizerName = '&nbsp';
		}
	}
	$count=array();	
	foreach($order_details as $orders){
		$OrderID = $orders->id;
		$CustomerName = $orders->customer_first_name.' '.$orders->customer_last_name;
		$CustomerPhone = substr($orders->cardholder_contact_number, -6, 6);
		$cartID = $orders->cart_id;
		if($orders->table){
			$TableNu = explode(',&', $orders->table);
			$TableNum = 'TABLE '.$TableNu[0];
			$TableTyp = $TableNu[1];
		}
		if($orders->ticket_table){
			$TableNu = explode(',&', $orders->ticket_table);
			$TableNum = 'TABLE '.$TableNu[0].': Seats-'.$TableNu[1];
			$TableTyp = $TableNu[2];
		}
		if($orders->tickets){
			$TableNu = explode(',&', $orders->tickets);
			$TableNum = $TableNu[0];
			$TableTyp = str_replace(",","",$TableNu[3]);
		}
		$price = '&pound; '.$orders->subtotal;
		$tickets=""; if($orders->tickets){ $ticket=(explode('&',$orders->tickets)); $count=rtrim($ticket[3],','); }
	}	
	foreach($etickets_settings as $e_ticket){
		$celebrities = $e_ticket->celebrities;
		$door_open = $e_ticket->door_open;
		$door_close = $e_ticket->door_close;
		$dress_code_policy = $e_ticket->dress_code_policy;
		$alcohol_for_sale = $e_ticket->alcohol_for_sale;
		$minimum_age_restricted = $e_ticket->minimum_age_restricted;
	}	
$barData = array('OrderID'=>$OrderID,'Event Name'=>$EventName,'Customer Name'=>$CustomerName);	
?>
<?php if (!empty($count)) { for ($x = 1; $x <= $count; $x++) {?>
<div class="wrapper">
	<div class="header">
    	<div class="header-center">
        	<div class="header-top">
            	<div class="logo">
                	<img src="<?php echo base_url(); ?>assets/images/logo-eticket.png" />
                </div>
                <div class="barcode">
					<span style="float: right;margin-top: 12px;margin-left: 86px;">
						<?php $cartID = $cartID.$x; echo barCode($cartID); ?>
						<b style="margin-left: 49px;"><?php echo $cartID; ?></b>
					</span>
                </div>
                <div class="logo-content">
                	<p>ticketbaby.co.uk</p>
                </div>
            </div>
            <div class="header-bottom">
            	<div class="header-left">
					<div class="vertical-text-top">
					<b><?php echo $OrganizerName; ?></b><br>
					<?php echo $EventDate; ?> - from <?php echo $EventTime; ?><br>
					<?php echo $EventName; ?><br>
					<b>Order#:</b>
                    <div style="text-align:center; margin-left: 62px;">
						<?php echo barCode($cartID); ?>
						<b style="margin-right: 62px;"><?php echo $cartID; ?></b>
                    </div>
					</div>
                </div>
                <div class="header-bottom-center">
                </div>
                <div class="header-right">
                	<div class="header-right-main">
                		<h1><?php echo $OrganizerName; ?></h1>
                    </div>
                	<div class="header-right-uper">
                        <p id="Presents-By" align="center"><span>Presents</span></p>
                        <p id="Evnt-Name" align="center"><?php echo $EventName; ?></p>
                        <p id="Evnt-Date" align="center"><?php echo $EventDate; ?> - from <?php echo $EventTime; ?></p>
                        <p id="Evnt-Celeb" align="center"><?php echo $celebrities; ?></p>
						<br/>
                        <p id="Evnt-Venue" align="center"><?php echo $Eventvenue; ?></p>
                        <p id="Evnt-Address" align="center"><span><?php echo $EventAddress; ?></span> </p>
                    </div>
                    <div class="header-right-bottom">
                    	<div class="bottom-right-price">
                        	<p id="Price"><?php if($price==0){echo $price.'.00'; }else{ echo $price; } ?></p>
                            <h2 style="margin-left:15px;margin-top:14px;"> CUST# </h2>
                        </div>
                    	<div class="bottom-right">
							
                        	<h2 id="TableNu"><?php echo $TableNum; ?></h2>
                            <p class="table-num-subtitile"><?php echo $x." of ".$TableTyp; ?></p>
							<p id="VIP-Name"><?php echo $CustomerName; ?></p>
                        </div>
                    </div>
                    <div class="bottom-qrcode">
                    	<div class="qrcode-img">
						<?php $EvntNM = str_replace("&","and",$EventName); ?>
                        	<img id='barcode' src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo 'OrderID: '.$OrderID.', Event Name: '.$EvntNM.', Customer Name: '.$CustomerName; ?>&amp;size=100x100" alt="" title="Scan Me" width="110" height="110" />
                        </div>
                        <h2> ADMIT ONE </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="center">
    	<div class="center-left">
        	<p>PLEASE PRINT AND BRING THIS TICKET TO GAIN ENTRY.<br>YOU MAY ALSO SHOW THIS TICKET ON YOUR MOBILE DEVICE.<br>NO TICKET, NO ENTRY. GUESTLIST CHECK WILL STILL APPLY#</p>
            <h3><?php echo $EventName; ?></h3>            
            <p><?php echo $EventAddress.' '.$Eventcountry; ?></p>
            <h2>+++++++++++++++++</h2>
            <h2>**** ADMITS ONE ****</h2>
            	<div class="admit-content">
					<p id="Customer-Name"><?php echo $CustomerName; ?></p>
                </div>
                <p>DOOR OPEN <?php echo $door_open; ?> FOR EVENT ACCESS</p>
                <h3>DOOR OPEN FROM <?php echo $door_open; ?> </h3>
                <p class="data-content">STRICTLY NO ENTRY FOR EVENT AFTER <b><?php echo $door_close; ?></b></p>
                <p class="data-content">PLEASE ARIVE EARLY.</p>
				<div class="data-contents">
	                <p class="data-content"><span><b>DRESS CODE POLICY:</b> <?php echo $dress_code_policy; ?></span></p>
	                <p class="data-content"><span><b>ALCOHOL FOR SALE:</b> <?php if($alcohol_for_sale==1){echo "YES"; } else{ echo "No"; } ?></span></p>
	                <p class="data-content"><span><b>MINIMUM AGE FOR EVENT RESTRICTED TO:</b> <?php echo $minimum_age_restricted; ?></span></p>
                </div>
                <h2>+++++++++++++++++</h2>
                <ul>
                	<li> &lowast; No food or drink permitted to the venue.</li>
                    <li> &lowast; Bags may be searched on entry.</li>
                    <li> &lowast; Random searches in operation.</li>					
                </ul>
                <div class="data-contents">
                	<p class="data-content"><span><?php echo $OrganizerName; ?> look forward to hosting you on the nights.</span></p>
                </div>
        </div>
        <div class="center-right">
        	<div class="right-uper">
            	<center><img src="<?php echo base_url('uploads/images/full/'.$EventImage); ?>"></center>
                <center><?php echo barCode($cartID); ?></center>
                <p align="center" style="margin-top: 2px;"><?php echo $cartID; ?></p>
                <div class="validatecode" style="margin-top: -14px;">
					<p id="Valid-Code"><?php echo $CustomerPhone; ?></p>
                </div>
                <p align="center"style="margin-bottom: 2px;">VALIDATION CODE</p>
            </div>
            <div class="right-bottom">
				<p style="margin-left:10px;font-size: 31px; margin-bottom: -8px;"><b>This is your eTicket</b></p>
				<p style="margin-left:10px;">This barcode allows only one entry per scan.</p>
				<p style="margin-left:10px;"><b>Unauthorised duplication or sale of this ticket may prevent your admittance to the event.</b></p>
				<p style="margin-left:10px;font-size: 12px;text-align: justify;">Keep this ticket in a safe place as you would a regular ticket. TicketBaby is will not be responsible for any Inconvenience cause by lost or duplicated tickets. In the event that the duplicate appears we reserve the right to refuse entry to all ticket holders and may refund the face value of the original ticket to the purchaser which will constitute to the full settlement. See full terms for use of tickets at www.ticketbaby.co.uk.</p>
				<p align="center">THE RESALE OF THIS TICKET IS PROHIBITED</p>
            	<center><img src="<?php echo base_url(); ?>assets/images/EticketLogo.jpg" /></center>
                <p align="center"><span>www.ticketbaby.co.uk</span></p>
            </div>
        </div>
		<div class="bottom_text">
                        <p align="center">For our latest events and latest bookings please visit us at</p>
                        <h1>Ticketbaby.co.uk</h1>
						<span>We got you Covered!</span>
        </div>
    </div>
</div>
<?php }}else{ ?>
<div class="wrapper">
	<div class="header">
    	<div class="header-center">
        	<div class="header-top">
            	<div class="logo">
                	<img src="<?php echo base_url(); ?>assets/images/logo-eticket.png" />
                </div>
                <div class="barcode">
					<span style="float: right;margin-top: 12px;margin-left: 86px;">
						<?php $cartID = $cartID.$cartID; echo barCode($cartID); ?>
						<b style="margin-left: 49px;"><?php echo $cartID; ?></b>
					</span>
                </div>
                <div class="logo-content">
                	<p>ticketbaby.co.uk</p>
                </div>
            </div>
            <div class="header-bottom">
            	<div class="header-left">
					<div class="vertical-text-top">
					<b><?php echo $OrganizerName; ?></b><br>
					<?php echo $EventDate; ?> - from <?php echo $EventTime; ?><br>
					<?php echo $EventName; ?><br>
					<b>Order#:</b>
                    <div style="text-align:center; margin-left: 62px;">
						<?php echo barCode($cartID); ?>
						<b style="margin-right: 62px;"><?php echo $cartID; ?></b>
                    </div>
					</div>
                </div>
                <div class="header-bottom-center">
                </div>
                <div class="header-right">
                	<div class="header-right-main">
                		<h1><?php echo $OrganizerName; ?></h1>
                    </div>
                	<div class="header-right-uper">
                        <p id="Presents-By" align="center"><span>Presents</span></p>
                        <p id="Evnt-Name" align="center"><?php echo $EventName; ?></p>
                        <p id="Evnt-Date" align="center"><?php echo $EventDate; ?> - from <?php echo $EventTime; ?></p>
                        <p id="Evnt-Celeb" align="center"><?php echo $celebrities; ?></p>
						<br/>
                        <p id="Evnt-Venue" align="center"><?php echo $Eventvenue; ?></p>
                        <p id="Evnt-Address" align="center"><span><?php echo $EventAddress; ?></span> </p>
                    </div>
                    <div class="header-right-bottom">
                    	<div class="bottom-right-price">
                        	<p id="Price"><?php if($price==0){echo $price.'.00'; }else{ echo $price; } ?></p>
                            <h2 style="margin-left:15px;margin-top:14px;"> CUST# </h2>
                        </div>
                    	<div class="bottom-right">
							
                        	<h2 id="TableNu"><?php echo $TableNum; ?></h2>
                            <p class="table-num-subtitile"><?php echo $TableTyp; ?></p>
							<p id="VIP-Name"><?php echo $CustomerName; ?></p>
                        </div>
                    </div>
                    <div class="bottom-qrcode">
                    	<div class="qrcode-img">
						<?php $EvntNM = str_replace("&","and",$EventName); ?>
                        	<img id='barcode' src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo 'OrderID: '.$OrderID.', Event Name: '.$EvntNM.', Customer Name: '.$CustomerName; ?>&amp;size=100x100" alt="" title="Scan Me" width="110" height="110" />
                        </div>
                        <h2> ADMIT ONE </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="center">
    	<div class="center-left">
        	<p>PLEASE PRINT AND BRING THIS TICKET TO GAIN ENTRY.<br>YOU MAY ALSO SHOW THIS TICKET ON YOUR MOBILE DEVICE.<br>NO TICKET, NO ENTRY. GUESTLIST CHECK WILL STILL APPLY#</p>
            <h3><?php echo $EventName; ?></h3>            
            <p><?php echo $EventAddress.' '.$Eventcountry; ?></p>
            <h2>+++++++++++++++++</h2>
            <h2>**** ADMITS ONE ****</h2>
            	<div class="admit-content">
					<p id="Customer-Name"><?php echo $CustomerName; ?></p>
                </div>
                <p>DOOR OPEN <?php echo $door_open; ?> FOR EVENT ACCESS</p>
                <h3>DOOR OPEN FROM <?php echo $door_open; ?> </h3>
                <p class="data-content">STRICTLY NO ENTRY FOR EVENT AFTER <b><?php echo $door_close; ?></b></p>
                <p class="data-content">PLEASE ARIVE EARLY.</p>
				<div class="data-contents">
	                <p class="data-content"><span><b>DRESS CODE POLICY:</b> <?php echo $dress_code_policy; ?></span></p>
	                <p class="data-content"><span><b>ALCOHOL FOR SALE:</b> <?php if($alcohol_for_sale==1){echo "YES"; } else{ echo "No"; } ?></span></p>
	                <p class="data-content"><span><b>MINIMUM AGE FOR EVENT RESTRICTED TO:</b> <?php echo $minimum_age_restricted; ?></span></p>
                </div>
                <h2>+++++++++++++++++</h2>
                <ul>
                	<li> &lowast; No food or drink permitted to the venue.</li>
                    <li> &lowast; Bags may be searched on entry.</li>
                    <li> &lowast; Random searches in operation.</li>					
                </ul>
                <div class="data-contents">
                	<p class="data-content"><span><?php echo $OrganizerName; ?> look forward to hosting you on the nights.</span></p>
                </div>
        </div>
        <div class="center-right">
        	<div class="right-uper">
            	<center><img src="<?php echo base_url('uploads/images/full/'.$EventImage); ?>"></center>
                <center><?php echo barCode($cartID); ?></center>
                <p align="center" style="margin-top: 2px;"><?php echo $cartID; ?></p>
                <div class="validatecode" style="margin-top: -14px;">
					<p id="Valid-Code"><?php echo $CustomerPhone; ?></p>
                </div>
                <p align="center"style="margin-bottom: 2px;">VALIDATION CODE</p>
            </div>
            <div class="right-bottom">
				<p style="margin-left:10px;font-size: 31px; margin-bottom: -8px;"><b>This is your eTicket</b></p>
				<p style="margin-left:10px;">This barcode allows only one entry per scan.</p>
				<p style="margin-left:10px;"><b>Unauthorised duplication or sale of this ticket may prevent your admittance to the event.</b></p>
				<p style="margin-left:10px;font-size: 12px;text-align: justify;">Keep this ticket in a safe place as you would a regular ticket. TicketBaby is will not be responsible for any Inconvenience cause by lost or duplicated tickets. In the event that the duplicate appears we reserve the right to refuse entry to all ticket holders and may refund the face value of the original ticket to the purchaser which will constitute to the full settlement. See full terms for use of tickets at www.ticketbaby.co.uk.</p>
				<p align="center">THE RESALE OF THIS TICKET IS PROHIBITED</p>
            	<center><img src="<?php echo base_url(); ?>assets/images/EticketLogo.jpg" /></center>
                <p align="center"><span>www.ticketbaby.co.uk</span></p>
            </div>
        </div>
		<div class="bottom_text">
                        <p align="center">For our latest events and latest bookings please visit us at</p>
                        <h1>Ticketbaby.co.uk</h1>
						<span>We got you Covered!</span>
        </div>
    </div>
</div>
<?php } ?>
</body>
</html>