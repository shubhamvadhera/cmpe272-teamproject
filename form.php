<?php
extract($_POST);
$to = $email;
$body = 'Thank you for your feedback.!Its Appreciated..!!';
$subject = 'Thank you for your Email..!!';
$header = 'test@gmail.com';

echo "Email address is:" +$to;
mail($to, $subject, $body, $header);
?>