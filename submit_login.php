<?php
session_start();
ob_start();

include('db.php');

if($squ = $db->prepare("SELECT * FROM settings WHERE id='1'")){
	$squ->execute();

    $settings = $squ->fetch();
	
	//$ReURL = $settings['url'];

}else{
     printf("Error: %s\n", $db->error);
}

if(!isset($_SESSION['username'])){

if($_POST)
{	
	
	$username =	$db->quote($_POST['username']); 
	$password = $_POST['password'];
	$gpassword=md5($password);
	
	$xsql="SELECT * FROM `users` WHERE `username` =$username and `password` ='$gpassword'";
	if($UserCheck = $db->prepare($xsql)){
	
	$UserCheck->execute();
   	$VdUser = $UserCheck->fetch();
	$Count= $UserCheck->rowCount();
   
	}else{
   
     printf("Error: %s\n", $db->error);

	}
	
	if ($Count == 1)
	{
		//required variables are empty
		$_SESSION["username"] = $username;
		//header("location:index.php");
?>
<script type="text/javascript">
function leave() {
  window.location = "index.php";
}
setTimeout("leave()", 1000);
</script>
<?php

	die('<div class="redirecting">Login You on. Please Wait!!.</div>');
	
	
   }else{
	   
	   die('<div class="msg-error">Username or password is wrong.</div>');
   		
   } 
}
}
ob_end_flush();
 
?>
