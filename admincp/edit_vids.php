<?php include('header.php');?>
<div class="maintitle">Edit Picture Title</div>
<?php


$act=isset($_GET['act'])?$_GET['act']:"";

$id=isset($_GET['id'])?$_GET['id']:"";
 
if($act=='sub'){
	
	
$videoname = $db->quote($_POST['videoname']);

	
$UpdateMedia = $db->prepare("UPDATE media SET title='$videoname' WHERE id='$id'");
$UpdateMedia->execute();?>
    
<div class="infomsgbox">Post updated successfully</div>  

<?php }

if($Sql = $db->prepare("SELECT * FROM media WHERE id='$id'")){
	$Sql->execute();

    $Row = $Sql->fetch();
	
}else{
    
	 printf("Error: %s\n", $db->error);
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

 
