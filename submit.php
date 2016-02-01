<?php

require('phpmailer/class.phpmailer.php');
require('phpmailer/class.smtp.php');


/* config start */

$emailAddress = 'jonathan.mcontreras@gmail.com';
$fromName="portfolio";
$smtp=false;

/* NOTE: IF YOU RECIEVED THIS MESSAGE "Error Occured:Could not instantiate mail function." YOU SHOULD SET SMTP CONFIG
 * AND SET $SMTP VALUE TO TRUE */

/* config end */



$email=$_POST['email'];

$msg=
'Name:	'.$_POST['name'].'<br />
Email:	'.$_POST['email'].'<br />
IP:	'.$_SERVER['REMOTE_ADDR'].'<br /><br />

Message:<br /><br />

'.nl2br($_POST['message']).'

';


$mail = new PHPMailer(); // create a object to that class.


if($smtp){

$mail->IsSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "ssl";
$mail->Port       = 465;


// optional
// used only when SMTP requires authentication

$mail->SMTPAuth = true;
$mail->Username = 'GMAIL USERNAME';
$mail->Password = 'YOUR GMAIL PASSWORD';

}



$mail->Timeout  = 50;

$mail->Subject =  "A new mail from ".$_POST['name']." | contact form feedback";
$from = $fromName;
$mail->From = $email;
$mail->FromName = $email;
$mail->AddReplyTo($emailAddress, $from);
$to = $emailAddress;
$mail->AddAddress($to, '');


$mail->MsgHTML($msg);

$mail->Body = $msg;



if($mail->Send()) {
     echo "<div class='alert alert-success' >Your message has been sent.</div>";


} else {
  echo "<div class='alert alert-error' >Error Occured:".$mail->ErrorInfo."</div>";
}






?>
