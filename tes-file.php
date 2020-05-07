<?php


$to = "uzumakienjat26@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: jatnika026@gmail.com" . "\r\n" .
"CC: somebodyelse@example.com";

mail($to,$subject,$txt,$headers);

?>