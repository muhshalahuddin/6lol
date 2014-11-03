<?php
session_start();
ob_start();
?>
<?php include('../db.php');?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Flippy FunBox - Admin Control Panel</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Kameron' rel='stylesheet' type='text/css'>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<header>
<div class="headcontaint">
<div class="logo"><a href="index.html"><img src="../images/logo.png" width="220" height="70"></a></div>

</div>
</header>
<div class="container">
<div class="maintitle">Login to Admin Contol Panel</div>
<?php
$err=isset($_GET['error'])?$_GET['error']:""; 
if($err=='error'){?>
<div class="errormsgbox">Wrong Username or Password. Please try again.</div>	
<?php }

if(!isset($_SESSION['adminuser'])){
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from Form
$adminuser=$mysqli->escape_string($_POST['adminuser']); 
$adminpassword=$mysqli->escape_string($_POST['adminpassword']); 
$gpassword=md5($adminpassword); // Encrypted Password

if($sql= $mysqli->query("SELECT id FROM admin WHERE adminuser='$adminuser' and adminpassword='$gpassword'")){

    $result = mysqli_fetch_array($sql);
	$count=mysqli_num_rows($sql);

// If result matched $username and $password, table row must be 1 row
if($count==1)
{
$_SESSION["adminuser"] = $adminuser;

header("location:index.php");
}
else
{
header("location:login.php?error=error");

}
}

$sql->close();
}

ob_end_flush();

?>
<div class="box">
<div class="login_box">
<form action="login.php" method="post">
<div class="login_input">
<label class="loginlbl"  for="adminuser">Username :</label>
<input type="text" name="adminuser"/>
</div>
<div class="login_input">
<label class="loginlbl"  for="adminpassword">Password :</label>
<input type="password" name="adminpassword"/>
</div>
<div class="login_submit">
<input type="submit" id="submit" value=" Login to Admin Contol Panel"/>
</div>
</form>
</div>

</div>
<?php }else{
header("location:index.php");
}

include('footer.php');
?>