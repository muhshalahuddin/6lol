<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php 
$fid = $_GET['fid'];
$page = $_GET['page'];
?>
<div class="tinybox">
<div class="infomsg">Are you sure you want to make this post featured?</div>
<div class="buttoncenter"><a class="red"href="approved_pics.php?page=<?php echo $page;?>&fid=<?php echo $fid?>&mkf=yes">Yes</a></div>

</div>