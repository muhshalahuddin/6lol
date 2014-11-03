<?php include ('header.php');

$term = $mysqli->escape_string($_GET['term']);

if($CountPosts = $mysqli->query("SELECT * FROM media WHERE (title LIKE '%$term%') AND active=1")){

$RowCount = mysqli_num_rows($CountPosts);

$CountPosts->close();

}else{
     printf("Error: %s\n", $mysqli->error);
}	

?>

<section id="left">

<div id="search-title"><div id="search-title-left"><h1>Your Search for "<?php echo $term;?>"</h1></div> <div id="search-count"><?php echo $RowCount;?> Results</div></div>

<?php

if($LatestSql = $mysqli->query("SELECT * FROM media WHERE (title LIKE '%$term%') AND active=1 ORDER BY id DESC LIMIT 0, 10")){

while ($LatestRow = mysqli_fetch_array($LatestSql)){
	
	$MediaId = $LatestRow['id'];
	$MediaType = $LatestRow['type'];
	$MediaVotes = $LatestRow['votes'];
		
	$longTitle = stripslashes($LatestRow['title']);
	$strTitle = strlen ($longTitle);
	if ($strTitle > 30) {
	$MediaTitle = substr($longTitle,0,30).'...';
	}else{
	$MediaTitle = $longTitle;}
	
	$MediaLink = preg_replace("![^a-z0-9]+!i", "-", $longTitle);
	$MediaLink = nl2br(strtolower($MediaLink));
	
	$PostUrl = "http://".$settings['siteurl']."/post-".$MediaId."-".$MediaLink.".html";
	$FbUrl = "http://api.facebook.com/restserver.php?method=links.getStats&urls=".urlencode($PostUrl);
	$GetData = file_get_contents($FbUrl);
	$GetData = simplexml_load_string($GetData);
	$FbComments = $GetData->link_stat->comment_count;

	$TotaleComments =  $FbComments + $LatestRow['cmts'];
	
?>

<div class="search-post-box">


<?php if($MediaType=='1'){?>
<a href="post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html" <?php if ($MediaOpen==1){?> target="_blank" <?php }?>>
<div class="search-post">

<img alt="<?php echo stripslashes($LatestRow['title']);?>" src="timthumb.php?src=http://<?php echo $settings['siteurl']; ?>/uploads/<?php echo $LatestRow['image'];?>&amp;w=220&amp;h=120&amp;q=100">

</div>
</a>

<?php }elseif ($MediaType=='2'){?>

<a href="post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html" <?php if ($MediaOpen==1){?> target="_blank" <?php }?>>
<div class="search-post">

<img class="thumb" alt="<?php echo stripslashes($LatestRow['title']);?>" src="timthumb.php?src=http://<?php echo $settings['siteurl']; ?>/uploads/<?php echo $LatestRow['image'];?>&amp;w=220&amp;h=120&amp;q=100" width="<?php echo $NewWidth;?>">

</div>
</a>

<?php }elseif ($MediaType=='3'){?>

<a href="post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html" <?php if ($MediaOpen==1){?> target="_blank" <?php }?>>
<div class="search-post">

<img alt="<?php echo stripslashes($LatestRow['title']);?>" src="timthumb.php?src=<?php echo $LatestRow['image'];?>&amp;w=220&amp;h=120&amp;q=100">

</div>
</a>
<?php }?>

<header class="search-post-header">
<div class="search-post-title"><a href="post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html" <?php if ($MediaOpen==1){?> target="_blank" <?php }?>><h1><?php echo stripslashes($LatestRow['title']);?></h1></a></div><!--post-title-->
<div class="post-footer"><?php echo $LatestRow['views'];?> views - <?php echo $TotaleComments;?> comments</div>
</header>

</div><!--search-post-box-->

<?php     
	}
$LatestSql->close();
}else{
     printf("Error: %s\n", $mysqli->error);
}
?>


</section><!--left-->

		<nav id="page-nav"><a href="data_search.php?term=<?php echo $term;?>&amp;page=2"></a></nav>

<script src="js/jquery.infinitescroll.min.js"></script>
	<script src="js/manual-trigger.js"></script>
	
	<script>
	
	
	$('#left').infinitescroll({
		navSelector  : '#page-nav',    // selector for the paged navigation 
      	nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      	itemSelector : '.search-post-box',     //
		loading: {
          				finishedMsg: 'No more posts to load.',
          				img: 'templates/<?php echo $settings['template'];?>/images/ajax-loader.gif'
        			}
		
		
    }, function(newElements, data, url){
	
    });
	</script>


<section id="right"><?php include ('right_blocks.php');?></section><!--right-->
<?php include ('footer.php');?>