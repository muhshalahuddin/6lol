<?php if(!empty($Ad1)){ ?>
<div class="ads-one">
<?php echo $Ad1;?>
</div>
<?php }?>

<div id="featured-box">
<div class="right-bar-title"><h1>Featured</h1></div>

<?php
if ($Featured = $db->prepare("SELECT id,title,image,type,feat FROM media WHERE feat=1 ORDER BY id DESC LIMIT 10")){
	$Featured->execute();
	
	while($FeaturedRow = $Featured->fetch()){
		
	$FeaturedType = $FeaturedRow['type']; 		
	$FeaturedTitle= stripslashes($FeaturedRow['title']);
	$strFeatured = strlen ($FeaturedTitle);
	if ($strFeatured > 30) {
	$FeaturedMediaTitle = substr($FeaturedTitle,0,30).'...';
	}else{
	$FeaturedMediaTitle = $FeaturedTitle;}
	
	$FeaturedLink = preg_replace("![^a-z0-9]+!i", "-", $FeaturedTitle);
	$FeaturedLink = nl2br(strtolower($FeaturedLink));
?>
<a href="post-<?php echo $FeaturedRow['id'];?>-<?php echo $FeaturedLink;?>.html" <?php if ($MediaOpen==1){?> target="_blank" <?php }?>>
<div class="featured-post">
<div class="featured-image">
<?php if($FeaturedType==3){?>
<img alt="<?php echo stripslashes($FeaturedRow['title']);?>" src="timthumb.php?src=<?php echo $FeaturedRow['image'];?>&amp;w=300&amp;h=105&amp;q=100">
<?php }else{?>
<img alt="<?php echo stripslashes($FeaturedRow['title']);?>" src="timthumb.php?src=http://<?php echo $settings['siteurl']; ?>/uploads/<?php echo $FeaturedRow['image'];?>&amp;w=300&amp;h=105&amp;q=100">
<?php }?>
</div>
<div class="featured-title"><h2><?php echo $FeaturedMediaTitle;?></h2></div>
</div><!--featured-post-->
</a>
<?php     
	}
}else{
     printf("Error: %s\n", $db->error);
}
?>
</div><!--featured-box-->

<?php if(!empty($Ad2)){ ?>
<div id="ads-two">
<?php echo $Ad2;?>
</div>
<?php }?>
