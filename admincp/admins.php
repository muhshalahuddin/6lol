<?php include ('header.php');?>
<div class="maintitle">Update Admin Login</div>
<?php

if($qu = $db->prepare("SELECT * FROM admin WHERE id='1'")){
	$qu->execute();

    $re = $qu->fetch();
	$p = $re['adminpassword']; 
}else{
     printf("Error: %s\n", $db->error);
}


$act=isset($_GET['pass'])?$_GET['pass']:"";
 
if($act=='up'){

//////
$copassword = $db->quote($_POST['cpassword']);
$curpassword=md5($copassword);
$password = $db->quote($_POST['npassword']);
$newpassword=md5($password);
$cpassword = $db->quote($_POST['copassword']);
$confopassword=md5($cpassword);
///////
if ($p==$curpassword){
if ($newpassword==$confopassword){
$upp = $db->prepare("UPDATE admin SET adminpassword='$newpassword' WHERE id='1'");
$upp->execute(); ?>
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

$adminname = $db->quote($_POST['auser']);
	
	$uaa = $db->prepare("UPDATE admin SET adminuser='$adminname' WHERE id='1'");
	$uaa->execute();
	?>
<div class="msg-ok">Admin username updated successfully.</div>   	
<?php }
$q = $db->prepare("SELECT * FROM admin WHERE id='1'");
$q->execute();

$r = $q->fetch();
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


