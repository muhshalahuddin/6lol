<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php 
$des = $_GET['des'];
$page = $_GET['page'];
?>
<div class="tinybox">
<div class="infomsg">Are you sure you want to disapproved this post?</div>
<div class="buttoncenter"><a class="red"href="approved_pics.php?page=<?php echo $page;?>&des=<?php echo $des?>&disapproved=yes">Yes</a></div>

</div>