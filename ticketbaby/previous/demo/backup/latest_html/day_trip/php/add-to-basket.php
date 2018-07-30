<?php
$name=$_POST['fname'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$sender=$name;
$info='Name : '.$name."\r\n".'Phone : '.$phone."\r\n".'Email : '.$email;
$header='from: '.$email."\r\n";
$to ='dean@vtelevision.co.uk';
$send_contact=mail($to,$sender,$info,$header);
if($send_contact){
//echo "Thank you for your interest. We will get in touch with you soon.";
echo "<script>setTimeout(\"location.href = '../family_attractions.html';\",1);</script>";
}
else {
echo "ERROR";
}
?>