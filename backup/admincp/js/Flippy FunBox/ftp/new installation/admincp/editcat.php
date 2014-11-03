<?php include("header.php");?>
<div class="maintitle">Edit Category</div>
<?php

$edit = $mysqli->escape_string($_GET['edit']);

$act=isset($_GET['act'])?$_GET['act']:"";
if($act=='sub'){
$cat = $mysqli->escape_string($_POST['cat']);
$disc = $mysqli->escape_string($_POST['disc']);


$update = $mysqli->query("UPDATE categories SET cname='$cat',description='$disc' WHERE id='$edit'") 
or die(mysqli_error());?>
<div class="msg-ok">Category has been updated successfully</div>
<?php }
$qu=$mysqli->query("SELECT * FROM categories WHERE id='$edit'") or die (mysqli_error());
$row= mysqli_fetch_array($qu);
?>

<div class="box">
<div class="inbox">
<form name="newcat" action="editcat.php?act=sub&edit=<?php echo $edit;?>" method="post">
<label class="artlbl" for="cat">Category Name:</label>
<div class="formdiv"><input  name="cat" class="biginput" type="text" value="<?php echo $row['cname'];?>"/></div>

<label class="artlbl">Category Description</label>
<div class="formdiv">
<textarea name='disc' cols=40 rows=5 ><?php echo $row['description'];?></textarea>
</div>

<div class="formdiv">
<div class="sbutton"><input type="submit" id="submit"value='Update Category'/></div>
</div>
</form>	
</div>
</div>
<?php include("footer.php");?>