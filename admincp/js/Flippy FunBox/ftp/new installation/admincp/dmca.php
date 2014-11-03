<?php include('header.php');?>
<div class="maintitle">Update DMCA Policy Page</div>
<?php
$act=isset($_GET['act'])?$_GET['act']:"";
 
if($act=='sub'){
	
$dmca = $mysqli->escape_string($_POST['ptxt']);
	
$mysqli->query("UPDATE pages SET page='$dmca' WHERE id=4");

?>
    
<div class="msg-ok">DMCA Policy Page updated successfully.</div>  

<?php }

$q=$mysqli->query("select * from pages where id=4");
$s=mysqli_fetch_assoc($q);
?>
<div class="box">
<div class="inbox">
<!--form-->
<form action="dmca.php?act=sub" method="post">
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

 