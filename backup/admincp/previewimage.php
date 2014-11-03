<?php
include ('../db.php'); 
$id = $_GET['id'];

if($PrvSql = $mysqli->query("SELECT * FROM media WHERE id='$id'")){
	$PrvRow = mysqli_fetch_array($PrvSql);
	
	list($width, $height) = getimagesize("../uploads/".$PrvRow['image']."");

    $PrvSql->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo stripslashes($PrvRow['title']);?></title>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery.timeago.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
jQuery("abbr.timeago").timeago();
})
</script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="postBox">
<div class="pTitle"><?php echo stripslashes($PrvRow['title']);?></div>

<img src="../uploads/<?php echo $PrvRow['image'];?>" width="<?php echo $width;?>" height="<?php echo $height;?>">

<div class="clear">&nbsp;</div>
<div class="postDate"><abbr class="timeago" title="<?php echo $PrvRow['date'];?>"></abbr></div>
</div>
</body>
</html>
