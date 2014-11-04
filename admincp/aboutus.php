<?php include('header.php');?>
<div class="maintitle">Update About Us Page</div>
<?php
$act=isset($_GET['act'])?$_GET['act']:"";
 
if($act=='sub'){
	
$aboutus = $db->quote($_POST['ptxt']);
	
$UpdateAboutUsSql = $db->prepare("UPDATE pages SET page='$aboutus' WHERE id=1");
$UpdateAboutUsSql->execute();

?>
    
<div class="msg-ok">About Us Page updated successfully.</div>  

<?php }

$q = $db->prepare("select * from pages where id=1");
$q->execute();

$s = $q->fetch();
?>
<div class="box">
<div class="inbox">
<!--form-->
<form action="aboutus.php?act=sub" method="post">
<div class="pf">
<textarea class="ptxt" id="ptxt" name="ptxt" ><?php echo $s['page']?></textarea>
</div>
</br>
<div class="clear"></div>
<div class="formdiv">
<div class="sbutton"><input type="submit" id="submit" value="Update Page"/></div>
</div>
</form>
</div>
</div><!--box-->
<?php include('footer.php');?>

 
