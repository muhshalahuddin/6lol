<?php include ('header.php');?>
<section id="left">

<div class="post-box">
<header class="post-header">
<div class="post-title"><h1>DMCA Policy</h1></div><!--post-title-->
<div class="post-footer"></div>
</header>

<?php
if($PageSql = $mysqli->query("SELECT * FROM  pages WHERE id='4'")){

    $PageRow = mysqli_fetch_array($PageSql);
	
?>

<div class="post-page"><p><?php echo $PageRow['page'];?></p></div><!--post-->

<?php	

    $PageSql->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}
?>



</div><!--post-box-->


</section><!--left-->
	

<section id="right"><?php include ('right_blocks.php');?></section><!--right-->
<?php include ('footer.php');?>