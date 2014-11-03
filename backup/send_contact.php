<?php
include ("db.php");

if($_POST)
{	
	if(!isset($_POST['name']) || strlen($_POST['name'])<1)
	{
		//required variables are empty
		die('<div class="msg-error">Please let us know your name.</div>');
	}
	if(!isset($_POST['email']) || strlen($_POST['email'])<1)
	{
		//required variables are empty
		die('<div class="msg-error">Please provide us with a valid email address.</div');
	}
	
	$email_address = $_POST['email'];
	
	if (filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
  	// The email address is valid
	} else {
  		die('<div class="msg-error">Please provide a valid email address.</div>');
	}
	
	if(!isset($_POST['subject']) || strlen($_POST['subject'])<1)
	{
		//required variables are empty
		die('<div class="msg-error">Subject cannot be blank.</div>');
	}
	if(!isset($_POST['message']) || strlen($_POST['message'])<1)
	{
		//required variables are empty
		die('<div class="msg-error">Message cannot be blank.</div>');
	}

if($SettingsSql = $mysqli->query("SELECT * FROM settings WHERE id='1'")){

    $settings = mysqli_fetch_array($SettingsSql);

    $SettingsSql->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}	


$sitecontact = $settings['email'];
$fromname = $mysqli->escape_string($_POST['name']);
$frommail = $mysqli->escape_string($_POST['email']);
$fromsubject = $mysqli->escape_string($_POST['subject']);
$frommessage= $mysqli->escape_string($_POST['message']);

require_once('include/class.phpmailer.php');

$mail             = new PHPMailer(); ;

$mail->AddReplyTo($frommail, $fromname);

$mail->SetFrom($frommail, $fromname);

$mail->AddReplyTo($frommail, $fromname);

$address = $settings['email'];

$mail->AddAddress($address, $sitecontact);

$mail->Subject = $fromsubject;

$mail->MsgHTML($frommessage);

if(!$mail->Send()) {?>
<div class="msg-error">Error sending mail</div>
<?php } else {?>
<div class="msg-ok">Message sent. We will contact you back as soon as possible.</div>

<?php }

}

?>