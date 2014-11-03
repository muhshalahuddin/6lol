<?php include ('header_profile.php');

$pid = $mysqli->escape_string($_GET['id']);

if($Profile = $mysqli->query("SELECT * FROM users WHERE uid='$pid'")){

    $ProfileRow = mysqli_fetch_array($Profile);
	
	$ProfileImage = $ProfileRow['avatar'];
	
	$ProfileUsername = strtolower($ProfileRow['username']);
	
	$Profile->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

?>
<div id="profile-box">

<div id="profile-center">

<div id="profile-picture">

 <?php	if (empty($ProfileImage)){ 
	echo  '<img class="pimage" src="templates/'.$settings['template'].'/images/default-avatar.png" class="bimg" alt="User Avatar" width="100" height="100">';
		}else{

	echo  '<img class="pimage" src="timthumb.php?src=http://'.$settings['siteurl'].'/avatars/'.$ProfileImage.'&amp;h=100&amp;w=100&amp;q=100" alt="User Avatar" class="avatar"/>';
 }?>	
 
 </div>
 
 <div class="profile-user-name"><h1><?php echo ucfirst($ProfileRow['username']);?></h1></div><!--profile-user-name-->
 
  <div class="profile-description"><?php echo ucfirst($ProfileRow['about']);?></div><!--profile-user-name-->
 
 </div><!--profile-center-->

</div><!--profile-box-->
<div id="profile-bottom-bar">

<ul id="profile-nav">

<li><span><a href="profile-<?php echo $pid;?>-<?php echo $ProfileUsername;?>.html">Posts</a></span></li> 
<li><span><a href="upvote-<?php echo $pid;?>-<?php echo $ProfileUsername;?>.html">Up Votes</a></span></li>
<li class="active"><span><a href="comments-<?php echo $pid;?>-<?php echo $ProfileUsername;?>.html">Comments</a></span></li>
</ul>

</div><!--profile-bottom-bar-->


<div id="container">

<section id="left">

<script type="text/javascript">
$(function() {
$(".vote").click(function()
{
var id = $(this).data("id");
var name = $(this).data("name");
var dataString = 'id='+ id ;
//var dataId = id;
var parent = $(this);

if (name=='up')
{
$(this).fadeIn(200).html;
$.ajax({
type: "POST",
url: "vote_up.php",
data: dataString,
cache: false,

success: function(html)
{
parent.parent().find(".display-vote").html(html);
}
});
}
else
{
$(this).fadeIn(200).html;
$.ajax({
type: "POST",
url: "vote_down.php",
data: dataString,
cache: false,

success: function(html)
{
parent.parent().find(".display-vote").html(html);
}
});
}
return false;
});
});
</script>

<?php

$page = $_GET["page"];
$start = ($page - 1) * 2;

if($LatestSql = $mysqli->query("SELECT * FROM comments LEFT JOIN media ON comments.pid=media.id WHERE comments.uid='$pid' ORDER BY comments.id DESC LIMIT $start, 10")){

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

<div class="post-box">
<header class="post-header">
<div class="post-title"><a href="post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html" <?php if ($MediaOpen==1){?> target="_blank" <?php }?>><h1><?php echo stripslashes($LatestRow['title']);?></h1></a></div><!--post-title-->
<div class="post-footer"><?php echo $LatestRow['views'];?> views - <?php echo $TotaleComments;?> comments</div>
</header>
<div class="post-left">

<?php if($MediaType=='1'){

list($width, $height, $target) = getimagesize("uploads/".$LatestRow['image']."");

if ($width<400){
	$NewWidth = '400';	
}else{ 
	$NewWidth = '500';
	
}	
	
?>
<a href="post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html" <?php if ($MediaOpen==1){?> target="_blank" <?php }?>>
<div class="post">

<img alt="<?php echo stripslashes($LatestRow['title']);?>" src="timthumb.php?src=http://<?php echo $settings['siteurl']; ?>/uploads/<?php echo $LatestRow['image'];?>&amp;w=<?php echo $NewWidth;?>&amp;q=100">

</div>
</a>

<?php }elseif ($MediaType=='2'){
list($width, $height) = getimagesize("uploads/".$LatestRow['image']."");

$Scale = $width / $height;

if ($width<400){
	$NewWidth = '400';	
}else{ 
	$NewWidth = '500';
	
}

$NewHeight = $NewWidth / $Scale;
$NewHeigh = round($NewHeight);

$x = 500 / 2 - 35;
$y = $NewHeight / 2 + 40;

?>

<div class="post">

<img class="thumb" alt="<?php echo stripslashes($LatestRow['title']);?>" src="timthumb.php?src=http://<?php echo $settings['siteurl']; ?>/uploads/<?php echo $LatestRow['image'];?>&amp;w=<?php echo $NewWidth;?>&amp;h=<?php echo $NewHeight;?>&amp;q=100" gif="uploads/<?php echo $LatestRow['image'];?>" width="<?php echo $NewWidth;?>">

<div class="gif-img" style="margin-top:-<?php echo $y;?>px; margin-left:<?php echo $x;?>px;"></div>

</div>

<?php }elseif ($MediaType=='3'){

$Host = $LatestRow['video_type'];

?>

<a href="post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html" <?php if ($MediaOpen==1){?> target="_blank" <?php }?>>
<div class="post">
<?php if ($Host =="youtube.com"){?>

<img alt="<?php echo stripslashes($LatestRow['title']);?>" src="timthumb.php?src=<?php echo $LatestRow['image'];?>&amp;w=500&amp;h=300&amp;q=100">

<div class="ty-play"></div>

<?php }else if ($Host =="vimeo.com"){?>

<img alt="<?php echo stripslashes($LatestRow['title']);?>" src="timthumb.php?src=<?php echo $LatestRow['image'];?>&amp;w=500&amp;q=100">

<div class="vimeo-play"></div>

<?php }else if ($Host =="funnyordie.com"){ ?>

<img alt="<?php echo stripslashes($LatestRow['title']);?>" src="timthumb.php?src=<?php echo $LatestRow['image'];?>&amp;w=500&amp;q=100">

<div class="fd-play"></div>

<?php }else if ($Host =="vine.co"){ ?>

<img alt="<?php echo stripslashes($LatestRow['title']);?>" src="timthumb.php?src=<?php echo $LatestRow['image'];?>&amp;w=500&amp;q=100">

<div class="vine-play"></div>

<?php }else if ($Host =="dailymotion.com"){ ?>

<img alt="<?php echo stripslashes($LatestRow['title']);?>" src="timthumb.php?src=<?php echo $LatestRow['image'];?>&amp;w=500&amp;q=100">

<div class="dm-play"></div>

<?php } ?>

</div>
</a>
<?php }?>


<div class="social-box">

<a class="fb-button" href="javascript:void(0);" onclick="popup('http://www.facebook.com/share.php?u=http://<?php echo $settings['siteurl'];?>/post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html&amp;title=<?php echo urlencode(ucfirst($longTitle));?>')"></a>

<a class="twitter-button" href="javascript:void(0);" onclick="popup('http://twitter.com/home?status=<?php echo urlencode(ucfirst($longTitle));?>+http://<?php echo $settings['siteurl'];?>/post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html')"></a>


<nav class="social-share">
<ul>
   <li class="has-sub"><a href=""><span>&nbsp;</span></a>
      <ul>
         <li><a href="javascript:void(0);" onclick="popup('https://plus.google.com/share?url=<?php echo $settings['siteurl'];?>/post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html')"><span>Google+</span></a></li>
         <li><a href="javascript:void(0);" onclick="popup('http://pinterest.com/pin/create/button/?url=http://<?php echo $settings['siteurl'];?>/post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html')"><span>Pinterest</span></a></li>
         <li><a href="mailto:?subject=check+out+this+post+on+<?php echo $settings['name'];?>&amp;body=<?php echo $settings['siteurl'];?>/post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html" target="_blank"><span>Email</span></a></li>
      </ul>
   </li>
</ul>
</nav><!--social-share-->

</div><!--social-box-->

</div><!--post-left-->

<div class="vote-box">
<a href="" class="vote up" data-id="<?php echo $MediaId;?>" data-name="up"></a>
<div class="display-vote" data-id="<?php echo $MediaId;?>"><?php echo $MediaVotes; ?></div>
<a href="" class="vote down" data-id="<?php echo $MediaId;?>" data-name="down"></a>

</div><!--vote-box-->

</div><!--post-box-->

<?php     
	}
$LatestSql->close();
}else{
     printf("Error: %s\n", $mysqli->error);
}
?>


</section><!--left-->

		<nav id="page-nav"><a href="data_comments.php?page=2&id=<?php echo $pid;?>"></a></nav>

<script src="js/jquery.infinitescroll.min.js"></script>
	<script src="js/manual-trigger.js"></script>
	
	<script>
	
	
	$('#left').infinitescroll({
		navSelector  : '#page-nav',    // selector for the paged navigation 
      	nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      	itemSelector : '.post-box',     //
		loading: {
          				finishedMsg: 'No more posts to load.',
          				img: 'templates/<?php echo $settings['template'];?>/images/ajax-loader.gif'
        			}
		
		
    }, function(newElements, data, url){
$(".vote").unbind( "click" );     	
$(".vote").click(function()
{
var id = $(this).data("id");
var name = $(this).data("name");
var dataString = 'id='+ id ;
//var dataId = id;
var parent = $(this);

if (name=='up')
{
$(this).fadeIn(200).html;
$.ajax({
type: "POST",
url: "vote_up.php",
data: dataString,
cache: false,

success: function(html)
{
parent.parent().find(".display-vote").html(html);
}
});
}
else
{
$(this).fadeIn(200).html;
$.ajax({
type: "POST",
url: "vote_down.php",
data: dataString,
cache: false,

success: function(html)
{
parent.parent().find(".display-vote").html(html);
}
});
}
return false;
});

//Gif Code

$(".thumb").click( function(){
	
	$(this).parent().find('div.gif-img').removeClass('gif-img').addClass('gif-img-off'); 
	 
    $(this).attr("src", $(this).attr("gif")); 
});

$(".gif-img").click( function(){
	
	$(this).removeClass('gif-img').addClass('gif-img-off'); 
	 
    $(this).parent().find('img.thumb').attr("src", $(this).parent().find('img.thumb').attr("gif"));
});

		
    });
	</script>


<section id="right"><?php include ('right_blocks.php');?></section><!--right-->
<?php include ('footer.php');?>