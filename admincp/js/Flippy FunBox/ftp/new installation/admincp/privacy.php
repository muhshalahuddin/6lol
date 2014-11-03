<?php include('header.php');?>
<div class="maintitle">Update Privacy Policy Page</div>
<?php
$act=isset($_GET['act'])?$_GET['act']:"";
 
if($act=='sub'){
	
$privacy = $mysqli->escape_string($_POST['ptxt']);
	
$mysqli->query("UPDATE pages SET page='$privacy' WHERE id=2");

?>
    
<div class="msg-ok">Privacy Policy Page updated successfully.</div>  

<?php }

$q=$mysqli->query("select * from pages where id=2");
$s=mysqli_fetch_assoc($q);
?>
<div class="box">
<div class="inbox">
<!--form-->
<form action="privacy.php?act=sub" method="post">
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

 