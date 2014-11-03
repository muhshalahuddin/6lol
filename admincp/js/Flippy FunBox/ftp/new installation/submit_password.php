<?php
session_start();

include('db.php');


if($_POST)
{	
	
	if(!isset($_SESSION['username'])){
	//Do Nothing
}else{
	
$Uname = $_SESSION['username'];

if($UserSql = $mysqli->query("SELECT * FROM users WHERE username='$Uname'")){

    $UserRow = mysqli_fetch_array($UserSql);

	$UPW = $UserRow['password'];
	
	$UPID = $UserRow['uid'];
	
    $UserSql->close();
}else{
     printf("Error: %s\n", $mysqli->error);
}

}
//
	$ExtPassword = $_POST['nPassword'];
	$EnexPassword = md5($ExtPassword);
	
	if ($EnexPassword !== $UPW)
	{
		//required variables are empty
		die('<div class="msg-error">Existing password doesn&acute;t match.</div>');
	}
	
	if(!isset($_POST['uPassword']) || strlen($_POST['uPassword'])<1)
	{
		//required variables are empty
		die('<div class="msg-error">Please provide a password.</div>');
	}
	
	if(!isset($_POST['uPassword']) || strlen($_POST['uPassword'])<6)
	{
		//required variables are empty
		die('<div class="msg-error">New password must be least 6 characters long.</div>');
	}
		if(!isset($_POST['cPassword']) || strlen($_POST['cPassword'])< 1)
	{
		//required variables are empty
		die('<div class="msg-error">Please enter the same password as above.</div>');
	}
	
	if ($_POST['uPassword']!== $_POST['cPassword'])
 	{
		//required variables are empty
     	die('<div class="msg-error">Conform Password did not match! Try again.</div>');
 	
	}
	
		
	$Password  			= $mysqli->escape_string($_POST['uPassword']); // Password
	$EnPassword         = md5($Password); // Encript Password
		
		
// Update info into database table.. do w.e!
		$mysqli->query("UPDATE users SET password='$EnPassword' WHERE uid='$UPID'");
		
		
		die('<div class="msg-ok">Your password updated successfully.</div>');
		

   }else{
   		die('<div class="msg-error">There seems to be a problem. Please try again.</div>');
   } 

?>