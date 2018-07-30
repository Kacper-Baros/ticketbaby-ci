<?php session_start;
				?>
<div class="container-fluid content-bg">
	<div class="col-xs-12">
	<center>
		<img src="<?=base_url()?>assets/images/cubeNite.png" class="img-responsive"/>
		
	</center>
	</div>
</div>
<div class="container-fluid content-bg">
	<div class="container content">
        <div class="row no-mar main-content">
        	<div class="col-md-4 col-sm-4 left-sidebar">
            	<div class="main-thumb">
                	<img src="<?=base_url()?>assets/images/<?php echo $event["thumb1"]; ?>" />
                </div>  
            </div>
            <div class="col-md-8 col-sm-8">
            	<div class="movie-video-heading">
                	<h1>Special Request Dancehall Edition</h1>
                    <h2>price - &euro;10.00</h2>
                    <p style="display:inline-block"><img src="<?=base_url()?>assets/images/stars.png"/></p>&nbsp;&nbsp;&nbsp;&nbsp;
                    <p style="display:inline-block"><img src="<?=base_url()?>assets/images/nimg13.png"/></p><br/><br/>
                </div>
                <div class="seating-text">
                	<p>
						Cloud 9 and GNO Present its a Dancehall Special Request<br/>
						A Bank holidy Dancehall special with some of the top dancehall DJS in the midlands throw down some of the hottest tracks of the
						Genre whilst being supported by he freshest talented DJS of the last year to give you that RnB, Hip Hop and house to give you that
						bacnk holiday raving feel.<br/>
						Hosted at Sugarsuite, Broad St the ultimate party venue you can buy a Sugarsuite round or book a VIP booth.<br/>
						For information on Birthdays, group packages or VIP go to info@goodnightsoutuk.com or call 07500693619<br/>
						DJS<br/>
						Mr Lenn<br/>
						X - Ta - C 4 x 4<br/>
						Asher Ray<br/>
						DJ Matchu<br/>
						Day Day <br/>
						MC Q<br/>
						Smart Dress Essential (uptown Style)<br/>
						No Sportsware<br/>
					</p>
				 </div>
            </div>
			<div class="col-xs-12">
			<br/>
				<div class="event-info col-xs-12 ">
                	<h1 class="dark">Event Information</h1>
					<div class="col-md-12 col-xs-12"><br/>
						<div class="col-xs-4 orang-bk text-center">
							<strong>AUG<br/>30</strong><br/>SUN
						</div>
						<div class="p-no"><br/>
							<p>Address : 200 Broad St</p>
							<p>City : Fice Ways Bimingham B15 1SU</p>
							<p>Country : United Kingdom</p>
						</div>
						<br/><br/><br/></div>
					
                </div>  
				<div class="col-md-6 col-xs-12 table-responsive cus-selectx cus-ick">
					<form name="form" method="post" action="" >
					<table class="table">
						<tr>
							<th>Ticket Type</th>
							<th>End</th>
							<th>Price</th>
							<th>Available</th>
							<th>Quantity</th>
						</tr>
						<tr>
							<td><h5 class="all-caps"><strong>Free Before 11PM</strong>
							<small><br/>Everyone Free Before 11PM</small></h5></td>
							<td>22nd Aug</td>
							<td><strong>free</strong></td>
							<td><strong>100 seats</strong></td>
							<td><!--select class="form-control">
								<option>0</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select-->
									<input type="number" max="100" min="0" name="quantity1"/>
					
							</td>
						</tr>
						<tr>
							<td><h5 class="all-caps"><strong>&euro;8 Advance Tickets</strong>
							<small><br/>&euro;8 Any Time Entry Tickets</small></h5></td>
							<td>22nd Aug</td>
							<td><strong>&euro;8.00</strong></td>
							<td><strong>100 seats</strong></td>
							<td><!--select class="form-control">
								<option>0</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select-->
							
							<input type="number" max="100" min="0" name="quantity2"/>
				<?php
				//<?=base_url()>index.php/music/view_cart
				if (isset($_POST['Submits']) )
				{$a=$_POST['quantity1'];
				$b=$_POST['quantity2'];
				
				$price1='Free';
				$price2=8;
				$total1='Free';
				 $total2=$b*8;
				 
				if ($total>0)
				{
				$_SESSION['total_Seat']='fdhjdhj';
			
				}
				}
				if($b>0)
				{
				$ticket_type1='Free Before 11PM ';
				}
				else
				{
				//$ticket_type1='EMPTY';
				}
				if($a>0)
				{
				$ticket_type2='€8 Advance Tickets  ';
				}
				else{
				//$ticket_type2='EMPTY';
				}
				
				
				?>
				
							</td>
						</tr>
					</table>
					
				         <div class="table-only qty">
                    <h1>
                        <ul>
                           
                            <li class="col-md-3 col-xs-3">Ticket Type</li>
                            <li class="col-md-3 col-xs-3">Unit/Price</li>
                            <li class="col-md-3 col-xs-3">Quantity </li>
							<li class="col-md-2 col-xs-2">Total</li>
                            <div class="clearfix"></div>
                        </ul>
                    </h1>
					  <ul>
                   
                            <li class="col-md-3 col-xs-3"><?php echo $ticket_type1; ?></li>
                            <li class="col-md-3 col-xs-3"><?php echo $price1; ?></li>
                            <li class="col-md-3 col-xs-3"><?php echo $a; ?></li>
                            <li class="col-md-2 col-xs-2"><?php echo $total1; ?></li>
                            <div class="clearfix"></div>
                        </ul>
					<br/>
					  <ul>
                        
                            <li class="col-md-3 col-xs-3"><?php echo $ticket_type2; ?></li>
                            <li class="col-md-3 col-xs-3"><?php echo $price2; ?></li>
                            <li class="col-md-3 col-xs-3"><?php echo $b; ?></li>
                            <li class="col-md-2 col-xs-2"><?php echo $total2; ?></li>
                            <div class="clearfix"></div>
                        </ul>
					
                    

                </div>
                
					<div class="col-xs-12 text-right">
						<input type="submit" name="Submits" value="Add to cart "class=" btn-danger btn-pink"/>
						<!--button class="btn btn-danger btn-pink" name="submit" >BUY TICKETS</button--><br/>
						<small>Tickets will be reserved for 10 minutes</small>
					</div>    </form>
				</div>
			<div class="col-md-6 col-xs-12">
				<div class="col-md-8 col-md-offset-4 col-xs-12 bgG2">
				<div class="col-xs-12 bgGG">
					<div class="col-xs-12 orng">
						<h4>Location</h4>
					</div>
					<div class="col-xs-12"><br/>
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4860.411686685395!2d-1.9138237!3d52.4754086!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870bcf638654fa7%3A0x1684de4c80951199!2sSugar+Suite!5e0!3m2!1sen!2s!4v1440236054041" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
					<div class="col-xs-12">&nbsp;</div>
					<p><strong>200 Broad ST</strong><br/>
					Fice Ways Bimingham B15 1SU<br/>
					United Kingdom
					</p>
				</div>
				<div class="col-xs-12">&nbsp;</div>
				</div>
			</div>
			</div>
        </div>
    </div>
      <div class="container line"></div>
     <div class="container no-pad intrest">
     	<h1>Related to your interest</h1>
     <ul id="flexiselDemo1"> 
    <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
   <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
     <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
     <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
     <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
     <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li> 
     
      <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
   <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
     <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
     <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
     <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
     <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li> 
     
      <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
   <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
     <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
     <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
     <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>
     <li class="intrest-pic"><img src="<?=base_url()?>images/intrest1.png" />
            <p>Cowboy3 <img src="<?=base_url()?>images/stars.png" /></p>
     </li>                                                         
</ul>


     </div>

    </div>