<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php 
$unfid = $_GET['unfid'];
$page = $_GET['page'];
?>
<div class="tinybox">
<div class="infomsg">Are you sure you want to make this post unfeatured?</div>
<div class="buttoncenter"><a class="red"href="approved_pics.php?page=<?php echo $page;?>&unfid=<?php echo $unfid?>&unf=yes">Yes</a></div>

</div>