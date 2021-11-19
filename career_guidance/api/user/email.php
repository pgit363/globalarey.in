<?php
    
$to = "shirkebhavna20@gmail.com";

$subject = "New Student Score";

$message .= 'Student Name :-'.$_GET['name'].',<br>';

$message .= 'Email :-'.$_GET['email'].',<br>';

$message .= 'Standard :-'.$_GET['standard'].',<br>';

$message .= 'Stream :-'.$_GET['stream'].',<br>';

$message .= 'Score :-'.$_GET['score'].',<br>';

$message .= "Regards,<br>";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";

$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <enquiry@example.com>' . "\r\n";

$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);

?>