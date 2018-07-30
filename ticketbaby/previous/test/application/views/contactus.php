<div class="container-fluid content-bg">
	<div class="container content">
		<div class="heading">
		<h1>contact us</h1>
		</div>
		<div class="row no-mar main-content">
			<div class="col-md-4 col-xs-12" style="padding-left:30px;">
            	<?php  echo htmlspecialchars_decode($contact_details['cms_content']);  ?>
				
			</div>
			<div class="col-md-8 col-xs-12">
				<object type="text/html" data="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.4440090694616!2d-0.1049202842294524!3d51.5234155796378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761b50f70e99d1%3A0xf3d69af6eafcce44!2s157+St+John+St%2C+London+EC1V+4PW%2C+UK!5e0!3m2!1sen!2sin!4v1456574155732" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></object>
			</div>
			<div class="col-xs-12 cus-form3"><br/><br/>
			<form action="http://ticketbaby.co.uk/index.php/index/contactusform" method="post">
				<div class="form-group col-md-6">
					<label>First Name</label>
					<input type="text" class="form-control" placeholder="First Name" name="fname" required/>
				</div>
				<div class="form-group col-md-6">
					<label>Last Name</label>
					<input type="text" class="form-control" placeholder="Last Name" name="lname" required/>
				</div>
				<div class="form-group col-md-6">
					<label>Subject</label>
					<input type="text" class="form-control" placeholder="Subject" name="subject" required/>
				</div>
				<div class="form-group col-md-6">
					<label>Email</label>
					<input type="email" class="form-control" placeholder="Email" name="email" required/>
				</div>
				<div class="form-group col-xs-12">
					<label>Message</label>
					<textarea class="form-control" name="message"></textarea>
				</div>
				<div class="form-group col-xs-12">
					<input type="submit" class="btn btn-orang" Value="Submit" required/>
				</div>
			</form>
			</div>
		</div>
	</div>  
</div> 