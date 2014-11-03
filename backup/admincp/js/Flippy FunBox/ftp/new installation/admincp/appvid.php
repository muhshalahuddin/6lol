<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php 
$app = $_GET['app'];
$page = $_GET['page'];
?>
<div class="tinybox">
<div class="infomsg">Are you sure you want to approved this post?</div>
<div class="buttoncenter"><a class="red"href="pending_vids.php?page=<?php echo $page;?>&app=<?php echo $app?>&approved=yes">Yes</a></div>

</div>