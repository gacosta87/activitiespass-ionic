<?php
include_once('../phpmailer.php');
$mail             = new PHPMailer(); // defaults to using php "mail()"
$body             = $mail->getFile('contents.html');
$body             = eregi_replace("[\]",'',$body);
$mail->From       = "test@unicontrol.com.pe";
$mail->FromName   = "First Last";
$mail->Subject    = "PHPMailer Test Subject via mail()";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
//$mail->MsgHTML($body);
$mail->Body       = $body;
$mail->AddAddress("juanpacheco1567@gmail.com", "John Doe");
$mail->AddAddress("jhoncompany19@gmail.com",   "John Doe");
$mail->AddAttachment("images/phpmailer.gif");             // attachment
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
/*
include_once('../phpmailer.php');
$mail             = new PHPMailer(); // defaults to using php "mail()"
$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "jhoncompany19@gmail.com";  // GMAIL username
$mail->Password   = "            ";            // GMAIL password
$body             = $mail->getFile('contents.html');
$body             = eregi_replace("[\]",'',$body);
$mail->From       = "juanpacheco1567@gmail.com";
$mail->FromName   = "First Last";
$mail->Subject    = "PHPMailer Test Subject via mail()";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
//$mail->MsgHTML($body);
$mail->Body       = $body;
$mail->AddAddress("juanpacheco1567@gmail.com", "John Doe");
$mail->AddAddress("jhoncompany19@gmail.com", "John Doe");
$mail->AddAttachment("images/phpmailer.gif");             // attachment
$mail->IsHTML(true);
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
*/



?>
