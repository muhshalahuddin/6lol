<?php
session_start();
include('db.php');


if($SettingsSql = $db->prepare("SELECT * FROM settings WHERE id='1'")){
	$SettingsSql->execute();

    $settings = $SettingsSql->fetch();
	
	$Active = $settings['active'];
	
}else{
    
	 printf("Error: %s\n", $db->error);
}

//Get user info

$Uname = $_SESSION['username'];

if($UserSql = $db->prepare("SELECT * FROM users WHERE username='$Uname'")){
	$UserSql->execute();

    $UserRow = $UserSql->fetch();
	
	$UsName = strtolower($UserRow['username']);

	$Uid = $UserRow['uid'];
	
}else{
     
	 printf("Error: %s\n", $db->error);
	 
}


//Validation

if($_POST)
{		
	include('include/media_embed.php');
	
	$CheckUrl = $_POST['mLink'];
	
	if(!isset($_POST['catagory-select']) || strlen($_POST['catagory-select'])<1)
	{
		//required variables are empty
		die('<div class="msg-error">Please select a category</div>');
	}
	
	if(!isset($_POST['mName']) || strlen($_POST['mName'])<1)
	{
		//required variables are empty
		die('<div class="msg-error">Please add a title</div>');
	}
	
	if(!isset($_POST['mLink']) || strlen($_POST['mLink'])<1)
	{
		//required variables are empty
		die('<div class="msg-error">Please add a video source URL.</div>');
	}
	
	if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $CheckUrl)) {
  		//do nothing
	}else {
  	
	die('<div class="msg-error">Unsupported video source</div>');}
		
	$FileTitle			= $db->quote($_POST['mName']); // file title
	$SubmitURL          = $db->quote($_POST['mLink']); // afflite url
	$Catagory           = $db->quote($_POST['catagory-select']);
	$Date				= date("c",time());
	$Type				= "3";
	
	$pattern="@^https://vine.co/v/\w*$@i";

	if(preg_match($pattern, $CheckUrl)){
	// valid
	
	include('include/simple_html_dom.php');
	
	if (substr($CheckUrl, 0, 7) == "http://"){
		
    $CheckUrl = $CheckUrl;
	
	}elseif (substr($CheckUrl, 0, 8) == "https://"){
    
	$CheckUrl = str_replace("https", "http", $CheckUrl);
	
	$Vid = preg_replace('/^.*\//','',$CheckUrl);
	
	
	$html 				= file_get_html($CheckUrl);
	
	foreach($html->find("//meta[@property='twitter:player:stream']") as $element)
       $VineURL = $element->content;

	foreach($html->find("//meta[@property='twitter:image']") as $element)
       $VineImage = $element->content;

		
	}
	
	$VideoType = 'vine.co';
	
	$VineEmbed = '<iframe class="vine-embed" src="https://vine.co/v/'.$Vid.'/embed/simple?audio=1" width="630" height="630" frameborder="0"></iframe><script async src="//platform.vine.co/static/scripts/embed.js" charset="utf-8"></script>';
	//Insert Vines
	
	$VineInsertSql = $db->prepare("INSERT INTO media(title, image, video_type, vine_mp4, video_url, video_embed, type, catid, uid, date, active) VALUES ('$FileTitle','$VineImage','$VideoType','$VineURL','$SubmitURL','$VineEmbed','$Type','$Catagory','$Uid','$Date','$Active')");
	$VineInsertSql->execute();
	
	//Other then Vine
	
	}else {

//Get Embed Code

$em = new media_embed($SubmitURL);
	$site = $em->get_site();
	if($site != "")
	{
		$SmallThumb = $em->get_thumb("medium");
		$LargeThumb = $em->get_thumb("large");
		$EmbedCode = $em->get_iframe();
					
		
	}
	else
	{
		die('<div class="msg-error">Unsupported video source</div>');
	}

//URL info

$parse = parse_url($SubmitURL);
$host = $parse['host'];
$host = str_replace ('www.','', $host);

			
//Insert other videos
		$VideoInsertSql = $db->prepare("INSERT INTO media(title, image, thumb, video_type, video_url, video_embed, type, catid, uid, date, active) VALUES ('$FileTitle','$LargeThumb','$SmallThumb','$host','$SubmitURL','$EmbedCode','$Type','$Catagory','$Uid','$Date','$Active')");
		$VideoInsertSql->execute();

}//vine end		
?>

<script>
$('.theForm').delay(500).slideUp(1000);
$('.theForm').delay(1000).resetForm(1000);
</script>

<?php		
		
		
		die('<div class="msg-ok">Thank you for posting.</div>');
		
   
   }else{
   		die('<div class="msg-error">There seems to be a problem. please try again.</div>');
   }
   


 
?>
