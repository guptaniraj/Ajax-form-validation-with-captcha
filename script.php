<?php
$fname= $_REQUEST['fname'];	
$to = $_REQUEST['email'];
$subject = "Subject";
$txt = "Hii ".$fname ." Thanks for the submmision. We will contact you within 24 hours.";
$headers = "From: ";

//mail($to,$subject,$txt,$headers);
	
?>