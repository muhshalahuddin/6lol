<?php
session_start();

include('db.php');


if($_POST)
{	
	
	if(!isset($_SESSION['username'])){
	//Do Nothing
}else{
	
$Uname = $_SESSION['username'];

if($UserSql = $db->prepare("SELECT * FROM users WHERE username='$Uname'")){
	$UserSql->execute();

    $UserRow = $UserSql->fetch();

	$UPID = $UserRow['uid'];
	
}else{
     printf("Error: %s\n", $db->error);
}

}
//
	if(!isset($_POST['uEmail']) || strlen($_POST['uEmail'])<1)
	{
		//required variables are empty
		die('<div class="msg-error">Please let us know your email adress.</div>');
	}
	
	$email_address = $_POST['uEmail'];
	
	if (filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
  	// The email address is valid
	} else {
  		die('<div class="msg-error">Please enter a valid email address.</div>');
	}
	
	
		
	$Email  			= $db->quote($_POST['uEmail']); // Email
	$About              = $db->quote($_POST['about']); // About
	$Sex				= $db->quote($_POST['sex']); // Gender
	$Country			= $db->quote($_POST['country']); // Gender 
	$Birthday			= $db->quote($_POST['birthday']); // Birthday 
	
		
// Update info into database table.. do w.e!
		$InsertInfoUserProfileSql = $db->prepare("UPDATE users SET email='$Email',country='$Country', gender='$Sex', birthday='$Birthday', about='$About' WHERE uid='$UPID'");
		$InsertInfoUserProfileSql->execute();
		
		die('<div class="msg-ok">Your profile updated successfully.</div>');
		

   }else{
   		die('<div class="msg-error">There seems to be a problem. Please try again.</div>');
   } 

?>
