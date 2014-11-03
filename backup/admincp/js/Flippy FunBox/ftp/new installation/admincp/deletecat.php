<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php 
$del = $_GET['del'];
$page = $_GET['page'];
?>
<div class="tinybox">
<div class="infomsg">Are you sure you want to delete this category? Please note the all the posts belongs to this category will also be deleted.</div>
<div class="buttoncenter"><a class="red"href="category.php?page=<?php echo $page;?>&del=<?php echo $del?>&delete=yes">Yes</a></div>

</div>