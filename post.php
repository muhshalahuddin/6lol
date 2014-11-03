<?php include ('header_post.php');?>
<section id="left">

<?php
	//Next Link

if($Next = $db->prepare("SELECT * FROM media WHERE active=1 and id<$MediaId ORDER BY id DESC LIMIT 1")){
	$Next->execute();
	
	$NextRow = $Next->fetch();
	$NextCnt = $Next->rowCount();
	$Nid = $NextRow['id'];
	$NextName = $NextRow['title'];
	$NextLink = preg_replace("![^a-z0-9]+!i", "-", $NextName);
	$NextLink = strtolower($NextLink);
   
}else{
	
     printf("Error: %s\n", $db->error);
}

$PostUrl = "http://".$settings['siteurl']."/post-".$MediaId."-".$MediaLink.".html";
$FbUrl = "http://api.facebook.com/restserver.php?method=links.getStats&urls=".urlencode($PostUrl);
$GetData = file_get_contents($FbUrl);
$GetData = simplexml_load_string($GetData);
$FbComments = $GetData->link_stat->comment_count;

$TotaleComments =  $FbComments + $PostRow['cmts'];

if($Submiter = $db->prepare("SELECT * FROM users WHERE uid='$PostedBy'")){
	$Submiter->execute();

	$SubmiterRow = $Submiter->fetch();
	
	$SubmiterLink = strtolower($SubmiterRow['username']);
	
}else{
    
	 printf("Error: %s\n", $db->error);
}

?>

<div class="post-box">
<header class="post-header">
<div class="post-title"><h1><?php echo stripslashes($PostRow['title']);?></h1></div><!--post-title-->
<div class="post-footer"><?php echo $PostRow['views'];?> Views - <?php echo $TotaleComments;?> Comments</div>
</header>

<div class="social-box-top">

<div class="top-votes">
<a href="" class="votes up" data-id="<?php echo $MediaId;?>" data-name="up"></a>
<a href="" class="votes down" data-id="<?php echo $MediaId;?>" data-name="down"></a>
<div class="display-vote-post" data-id="<?php echo $MediaId;?>"><?php echo $MediaVotes; ?></div>
</div>

<a class="fb-button" href="javascript:void(0);" onclick="popup('http://www.facebook.com/share.php?u=http://<?php echo $settings['siteurl'];?>/post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html&amp;title=<?php echo urlencode(ucfirst($longTitle));?>')"></a>

<a class="twitter-button" href="javascript:void(0);" onclick="popup('http://twitter.com/home?status=<?php echo urlencode(ucfirst($longTitle));?>+http://<?php echo $settings['siteurl'];?>/post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html')"></a>


<nav class="social-share-page">
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
<?php if ($NextCnt>0){?>
<a id="next-button" href="post-<?php echo $Nid;?>-<?php echo $NextLink;?>.html">Next Post</a>
<?php }?>
</div><!--social-box-->

<div class="post-left-page">

<?php if($MediaType=='1'){

list($width, $height, $target) = getimagesize("uploads/".$PostRow['image']."");

if ($width<400){
	$NewWidth = '400';	
}else{ 
	$NewWidth = '600';
	
}	
	
?>
<div id="page-post">

<a class="popup-image" href="uploads/<?php echo $PostRow['image'];?>"><img alt="<?php echo stripslashes($PostRow['title']);?>" src="timthumb.php?src=http://<?php echo $settings['siteurl']; ?>/uploads/<?php echo $PostRow['image'];?>&amp;w=<?php echo $NewWidth;?>&amp;q=100"></a>

</div>

<?php }elseif ($MediaType=='2'){
list($width, $height) = getimagesize("uploads/".$PostRow['image']."");

$Scale = $width / $height;

if ($width<400){
	$NewWidth = '400';	
}else{ 
	$NewWidth = '600';
	
}
?>

<div id="page-post">

<a class="popup-image" href="uploads/<?php echo $PostRow['image'];?>"><img src="uploads/<?php echo $PostRow['image'];?>" width="<?php echo $NewWidth;?>"></a>

</div>

<?php }elseif ($MediaType=='3'){

$Host = $PostRow['video_type'];

if ($Host =="vimeo.com"){
	$H = 396;
}else if ($Host =="funnyordie.com"){
	$H = 377;
}else if ($Host =="facebook.com"){
	$H = 337;
}else if ($Host =="vine.co"){
	$H = 600;
}else{
	$H = 337;
}
		$pattern = "/height=\"[0-9]*\"/";
		$vFrame = preg_replace($pattern, "height='$H'", $PostRow['video_embed']);
		$pattern = "/width=\"[0-9]*\"/";
		$vFrame = preg_replace($pattern, "width='600'", $vFrame);

?>
<div id="page-post">

<?php echo $vFrame;?>

</div>
<?php }?>

</div><!--post-left-->

<div id="social-bottom">
<a class="fb-big"  href="javascript:void(0);" onclick="popup('http://www.facebook.com/share.php?u=http://<?php echo $settings['siteurl'];?>/post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html&amp;title=<?php echo urlencode(ucfirst($longTitle));?>')">Share on Facebook</a>
<a class="twitter-big" href="javascript:void(0);" onclick="popup('http://twitter.com/home?status=<?php echo urlencode(ucfirst($longTitle));?>+http://<?php echo $settings['siteurl'];?>/post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html')">Share on Twitter</a>
</div><!--social-bottom-->

<div id="post-date"><abbr class="timeago" title="<?php echo $PostRow['date'];?>"></abbr> BY <a class="user-link" href="profile-<?php echo $PostedBy;?>-<?php echo $SubmiterLink;?>.html"><?php echo strtoupper($SubmiterRow['username']);?></a></div>

<div id="comments-box">

<script type="text/javascript">
$(document).ready(function() {
		//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
});
</script>

<ul class="tabs">
    <li><a href="#tab1">Facebook Comments (<?php echo $FbComments;?>)</a></li>
    <li><a href="#tab2"><?php echo $settings['name']; ?> Comments (<?php echo $PostRow['cmts'];?>)</a></li>
   <!-- <li><a href="#tab3">Top Rated Scripts</a></li>-->
</ul>
<div class="tab_container">
<div id="tab1" class="tab_content">


<div class="fb-comments" data-href="http://<?php echo $settings['siteurl'];?>/post-<?php echo $MediaId;?>-<?php echo $MediaLink;?>.html" data-num-posts="6" data-width="600"></div>

</div><!--end of tab1-->
<div id="tab2" class="tab_content">

<?php

if (empty($Uavatar)){ 
	$AvatarImg =  'templates/'.$template.'/images/default-avatar.png" class="bimg';
}elseif (!empty($Uavatar)){
	$AvatarImg =  'avatars/'.$Uavatar;
 }

?>

<div id="main">

<div class="comment-form">
	
	<form id="addCommentsForm" method="post">

        	<input type="hidden" name="name" id="name" value="<?php echo $Uname;?>" />
            
            <input type="hidden" name="ruid" id="ruid" value="<?php echo $Uid;?>" />
            
            <input type="hidden" name="avatarlink" id="avatarlink" value="<?php echo $AvatarImg;?>" />
            
            <input type="hidden" name="pid" id="pid" value="<?php echo $pid;?>" />
            
            <input type="hidden" name="email" id="email" value="<?php echo $UserEmail;?>"/>
           
                      
           <textarea name="comment" id="comment" cols="20" rows="5" placeholder="Leave a comment"></textarea>
           
            <?php if(!isset($_SESSION['username'])){?> 
            <a class="cmt-link" href="login.html">Login</a><label class="error"></label>
            <?php }else{?>           
            <input type="submit" id="submit" class="cmtbtn" value="Submit" /><label class="error"></label>
            <?php }?>

    </form>
    </div>

<div id="jr"></div>

<div id="addcommentContainer">
<!--Comments-->
<?php

include ("include/comments.class.php");

// All comments
if($Comments = $db->prepare("SELECT * FROM comments LEFT JOIN users ON comments.uid=users.uid WHERE comments.pid='$pid' ORDER BY comments.id DESC")){
	$Comments->execute();

   while ($Comment = $Comments->fetch()){
   
   $CommentId = $Comment['id'];
   $CommentVotes = $Comment['votes'];
   $CommentdBy = $Comment['username'];
   $CommentFull = $Comment['comment'];
   $CommentDate = $Comment['date']; 
   $CommentAvatar = $Comment['avatar'];
   $CommentUserId = $Comment['uid'];
   $CommentUserName = strtolower($Comment['username']);
?>

<div class="comment">
			<div class="comment-box">
				<div class="avatar">
                <a href="profile-<?php echo $CommentUserId;?>-<?php echo $CommentUserName;?>.html">
                <?php	if (empty($CommentAvatar)){ 
	echo  '<img src="templates/'.$settings['template'].'/images/default-avatar.png" class="bimg" alt="User Avatar" width="50" height="50">';
		}elseif (!empty($CommentAvatar)){

	echo  '<img src="timthumb.php?src=http://'.$settings['siteurl'].'/avatars/'.$CommentAvatar.'&amp;h=50&amp;w=50&amp;q=100" alt="User Avatar" class="avatar"/>';
 }?>			</a>
				</div>
				<header class="comment-header">
				<span class="name"><a href="profile-<?php echo $CommentUserId;?>-<?php echo $CommentUserName;?>.html"><?php echo $CommentdBy;?></a></span>
				<span class="date"><abbr class="timeago" title="<?php echo $CommentDate;?>"></abbr></span>
                </header>
                <aside class="answe-display"><p><?php echo $CommentFull;?></p></aside>

</div>

    <div class="comment-bottom">
    
<div class="comment-vote-box">

<div class="comment-display-vote" data-id="<?php echo $CommentVotes; ?>"><?php echo $CommentVotes; ?> Points</div>

<a href="" class="comment-vote up" data-id="<?php echo $CommentId; ?>" data-name="comment-up"></a>

<a href="" class="comment-vote down" data-id="<?php echo $CommentId; ?>" data-name="comment-down"></a>

</div><!--comment-vote-->
    
    </div><!--comment-bottom-->


	
</div><!--comment--> 

<?php
}

}else{
   
     printf("Error: %s\n", $db->error);

}         

?>  
 

</div><!--comment-->   


<script type="text/javascript" src="js/jquery.comments.js"></script>

</div><!--end of tab 2-->
</div><!--end-container-->


</div><!--comments-box-->

</div><!--post-box-->
</div>


</section><!--left-->
	

<section id="right"><?php include ('right_blocks.php');?></section><!--right-->
<?php include ('footer.php');?>
