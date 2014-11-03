<?php include('header.php');?>
<div class="maintitle">Edit Picture Title</div>
<?php


$act=isset($_GET['act'])?$_GET['act']:"";

$id=isset($_GET['id'])?$_GET['id']:"";
 
if($act=='sub'){
	
	
$videoname = $mysqli->escape_string($_POST['videoname']);

	
$mysqli->query("UPDATE media SET title='$videoname' WHERE id='$id'");
?>
    
<div class="infomsgbox">Post updated successfully</div>  

<?php }

if($Sql = $mysqli->query("SELECT * FROM media WHERE id='$id'")){

    $Row = mysqli_fetch_array($Sql);
	
	$Sql->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

?>
<div class="box">
<div class="inbox">
<!--form-->
<form action="edit_vids.php?act=sub&id=<?php echo $id?>" method="post" >
<label class="artlbl">Title</label>
<div class="formdiv">
<input type="text" name='videoname' value='<?php echo stripslashes($Row['title']);?>'/>
</div>
</br>
<div class="formdiv">
<div class="sbutton"><input type="submit" id="submit" value="Update Post"/></div>
</div>
</form>
</div>
</div><!--box-->
<?php include('footer.php');?>

 