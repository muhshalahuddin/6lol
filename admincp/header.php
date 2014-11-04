<?php session_start();
if(!isset($_SESSION['adminuser'])){
	header("location:login.php");
}

include ('../db.php');

if($SettingsSql = $db->prepare("SELECT * FROM settings WHERE id='1'")){
	$SettingsSql->execute();

    $settings = $SettingsSql->fetch();
	
	$name=$settings['siteurl'];
	
}else{
    
	 printf("Error: %s\n", $db->error);
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $pageTitle;?><?php echo $settings['name']; ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/colorbox.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Kameron' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script src="js/jquery.timeago.js" type="text/javascript"></script>
<script type="text/javascript" src="js/nicEdit.js"></script>
<script>
$(document).ready(function(){
$(".blue").colorbox({});
$(".red").colorbox({});
$(".preview").colorbox({});
jQuery("abbr.timeago").timeago();
})
</script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
new nicEditor().panelInstance('ptxt'); 
});
</script>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<header>
<div class="headcontaint">
<div class="logo"><a href="index.php"><img src="../images/logo.png" width="130" height="auto"></a></div>
<!--menu-->
<div class="menu">
		<ul>
		  <li><a href="index.php">Dashboard</a></li>             
          <li><a href="settings.php">Settings</a></li>  
			<li><a href="#">Manage</a>
                <ul>
                <li><a href="addnewcat.php">Add Categories</a></li>
                <li><a href="category.php">Manage Categories</a></li>
                <li><a href="approved_pics.php">Approved Pictures</a></li>
                <li><a href="pending_pics.php">Pending Pictures</a></li>
				<li><a href="approved_vids.php">Approved Videos</a></li>
                <li><a href="pending_vids.php">Pending Videos</a></li>
                <li><a href="users.php">Manage Users</a></li>
                <li><a href="comments.php">Manage Comments</a></li>
                </ul>
          </li>
          <li><a href="ads.php">Ads</a></li>
		  <li><a href="admins.php">Admin</a></li>
			<li><a href="#">Manage Pages</a>
                <ul>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="privacy.php">Privacy Policy</a></li>
                <li><a href="tms.php">Terms of Use</a></li>
                <li><a href="dmca.php">DMCA</a></li>
				</ul>
           </li>
           <li><a href="../index.php" target="_blank">View Site</a></li>
		   <li><a href="logout.php">Logout</a></li>
          </li>
		</ul>
	</div>
<!--menu-->
</div>
</header>
<div class="container">
