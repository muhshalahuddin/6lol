<?php include('header.php');?>
<div class="maintitle">Mange Advertisements</div>
<?php
$act=isset($_GET['act'])?$_GET['act']:"";
 
if($act=='sub'){
$ada = $db->quote($_POST['ada']);
$adb = $db->quote($_POST['adb']);
$adc = $db->quote($_POST['adc']);

$UpdateSiteadSql = $db->prepare("UPDATE siteads SET ad1='$ada',ad2='$adb',ad3='$adc' WHERE id=1");
$UpdateSiteadSql->execute();

?>
    
<div class="msg-ok">Advertisements updated successfully.</div>  

<?php }

if($Sql = $db->prepare("SELECT * FROM siteads WHERE id=1")){
	$Sql->execute();
	
    $Row = $sql->fetch();
	
}else{
    
	 printf("Error: %s\n", $db->error);
}

?>
<div class="box">
<div class="inbox">
<!--form-->
<form action="ads.php?act=sub" method="post" enctype="multipart/form-data">
<label class="artlbl">HTML/JavaScript Ads. (300 x 250)</label>
<div class="formdiv">
<textarea name='ada' cols=40 rows=10 ><?php echo $Row['ad1']?></textarea>
</div>
<label class="artlbl">HTML/JavaScript Ads. (300 x 250)</label>
<div class="formdiv">
<textarea name='adb' cols=40 rows=10 ><?php echo $Row['ad2']?></textarea>
</div>
<label class="artlbl">HTML/JavaScript Ads. (728 x 90)</label>
<div class="formdiv">
<textarea name='adc' cols=40 rows=10 ><?php echo $Row['ad3']?></textarea>
</div>
</br>
<div class="formdiv">
<div class="sbutton"><input type="submit" id="submit" value="Update Site Ads"/></div>
</div>
</form>
</div>
</div><!--box-->
<?php include('footer.php');?>

 
