<?php 
/*
$to = 'sandipv920@gmail.com'; // Put in your email address here ranyoursitez@gmail.com
$subject  = "TravPro"; // The default subject. Will appear by default in all messages. Change this if you want.

// User info (DO NOT EDIT!)
$name ='sandy'; //stripslashes($_REQUEST['name1']); // sender's name
$email ='skvaghasiya@yahoo.com'; //stripslashes($_REQUEST['email1']); // sender's email
$phone = '9909324193';//stripslashes($_REQUEST['contact1']);
$message = 'Just Checking';//stripslashes($_REQUEST['message1']); 




// The message you will receive in your mailbox
// Each parts are commented to help you understand what it does exaclty.
// YOU DON'T NEED TO EDIT IT BELOW BUT IF YOU DO, DO IT WITH CAUTION!
$msg  = "Name: ".$name."\r\n";  // add sender's name to the message
$msg .= "E-mail: ".$email."\r\n";  // add sender's email to the message
$msg .= "Phone: ".$phone."\r\n";  // add sender's email to the message
$msg .="Message:".$message."\r\n";
$msg .= "Subject: ".$subject."\r\n\n"; // add subject to the message (optional! It will be displayed in the header anyway)
$msg .= "---Message--- \r\n";
$msg .= "\r\n\n"; 

$mail = @mail($to, $subject, $msg, "From:".$email);  // This command sends the e-mail to the e-mail address contained in the $to variable

if($mail) {
	echo "Your Query has been received, We will contact you soon.";  //This is the message that will be shown when the message is successfully send
	
} else {
	echo 'Message could not be sent!';   //This is the message that will be shown when an error occured: the message was not send
}*/

?>


<?php
         $to = "sandipv920@gmail.com";
         $subject = "This is subject";
         
         $message = "<b>This is HTML message.</b>";
         $message .= "<h1>This is headline.</h1>";
         
         $header = "From:info@sadgurusoft.com \r\n";
         //$header .= "Cc:sadgurusoft.com@gmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
      ?>