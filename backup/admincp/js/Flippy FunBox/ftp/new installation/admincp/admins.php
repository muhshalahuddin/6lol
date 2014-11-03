<?php include ('header.php');?>
<div class="maintitle">Update Admin Login</div>
<?php

if($qu = $mysqli->query("SELECT * FROM admin WHERE id='1'")){

    $re = mysqli_fetch_array($qu);
	$p = $re['adminpassword']; 
    $qu->close();
}else{
     printf("Error: %s\n", $mysqli->error);
}


$act=isset($_GET['pass'])?$_GET['pass']:"";
 
if($act=='up'){

//////
$copassword = $mysqli->escape_string($_POST['cpassword']);
$curpassword=md5($copassword);
$password = $mysqli->escape_string($_POST['npassword']);
$newpassword=md5($password);
$cpassword = $mysqli->escape_string($_POST['copassword']);
$confopassword=md5($cpassword);
///////
if ($p==$curpassword){
if ($newpassword==$confopassword){
$upp = $mysqli->query("UPDATE admin SET adminpassword='$newpassword' WHERE id='1'") or die (mysqli_error());?>
<div class="msg-ok">Admin password updated successfully.</div>          
<?php	}else{?>
<div class="errormsgbox">Your new password and conform password doesn't match. Please try again.</div>
<?php }	
}else{?>
<div class="errormsgbox">Current Password you provided doesn't match the one in our database. Please try again.</div>
<?php }
	
}
///////////
$act=isset($_GET['user'])?$_GET['user']:"";
 
if($act=='up'){

$adminname = $mysqli->escape_string($_POST['auser']);
	
	$uaa = $mysqli->query("UPDATE admin SET adminuser='$adminname' WHERE id='1'") or die (mysqli_error());?>
<div class="msg-ok">Admin username updated successfully.</div>   	
<?php }
$q = $mysqli->query("SELECT * FROM admin WHERE id='1'") or die (mysqli_error());
$r = mysqli_fetch_array($q);
?>
<div class="box">
<div class="inbox">
<form method="post" action="admins.php?user=up">
<label class="artlbl">Admin Username:</label>
<div class="formdiv">
<input type="text" tabindex="1" class="input" id="auser" name="auser" value="<?php echo $r['adminuser'];?>"/>
</div>

<br/>
<div class="formdiv">
<div class="sbutton">
<input type="submit" tabindex="5" id="submit" value="Update Username" />
</div>
</div>
</form>
<div class="clear"></div>

<form method="post" action="admins.php?pass=up">

<label class="artlbl">Current Password:</label>
<div class="formdiv">
<input type="password" tabindex="2" class="input" id="cpassword" name="cpassword" value=""/>
</div>

<label class="artlbl">New Password:</label>
<div class="formdiv">
<input type="password" tabindex="3" class="input" id="npassword" name="npassword" value=""/>
</div>

<label class="artlbl">Conform Password:</label>
<div class="formdiv">
<input type="password" tabindex="4" class="input" id="copassword" name="copassword" value=""/>
</div>

<br/>
<div class="formdiv">
<div class="sbutton">
<input type="submit" tabindex="5" id="submit" value="Update Password" />
</div>
</div>
</form>
</div>
</div>
<?php include ('footer.php');?>


