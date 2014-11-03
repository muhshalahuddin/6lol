<?php include ('header.php');?>
<section id="left">

<div class="post-box">
<header class="post-header">
<div class="post-title"><h1>Terms of Use</h1></div><!--post-title-->
<div class="post-footer"></div>
</header>

<?php
if($PageSql = $db->prepare("SELECT * FROM  pages WHERE id='3'")){
	$PageSql->execute();

    $PageRow = $PageSql->fetch();
	
?>

<div class="post-page"><p><?php echo $PageRow['page'];?></p></div><!--post-->

<?php	

	
}else{
    
	 printf("Error: %s\n", $db->error);
}
?>



</div><!--post-box-->


</section><!--left-->
	

<section id="right"><?php include ('right_blocks.php');?></section><!--right-->
<?php include ('footer.php');?>
