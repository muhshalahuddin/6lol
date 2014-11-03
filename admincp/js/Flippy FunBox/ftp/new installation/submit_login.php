<?php
session_start();
ob_start();

include('db.php');

if($squ = $mysqli->query("SELECT * FROM settings WHERE id='1'")){

    $settings = mysqli_fetch_array($squ);
	
	//$ReURL = $settings['url'];

    $squ->close();
}else{
     printf("Error: %s\n", $mysqli->error);
}

if(!isset($_SESSION['username'])){

if($_POST)
{	
	
	$username =	$mysqli->escape_string($_POST['username']); 
	$password = $mysqli->escape_string($_POST['password']);
	$gpassword=md5($password);
	
	if($UserCheck = $mysqli->query("SELECT * FROM users WHERE username ='$username' and password ='$gpassword'")){

   	$VdUser = mysqli_fetch_array($UserCheck);
	
	$Count= mysqli_num_rows($UserCheck);

   	$UserCheck->close();
   
	}else{
   
     printf("Error: %s\n", $mysqli->error);

	}
	
	if ($Count == 1)
	{
		//required variables are empty
		$_SESSION["username"] = $username;
		//header("location:index.html");
?>
<script type="text/javascript">
function leave() {
  window.location = "index.html";
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