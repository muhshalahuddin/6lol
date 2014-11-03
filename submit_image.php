<?php session_start();
include('db.php');

if($squ = $db->prepare("SELECT * FROM settings WHERE id='1'")){
	$squ->execute();

    $settings = $squ->fetch();
	
	$template = $settings['template'];
	
	
}else{
    
	 printf("Error: %s\n", $db->error);
}

//User Info

if(!isset($_SESSION['username'])){
	
	$Uid = 0;

}else{
	
$Uname = $_SESSION['username'];

if($UserSql = $db->prepare("SELECT * FROM users WHERE username='$Uname'")){
	$UserSql->execute();

    $UserRow = $userSql->fetch();
	
	$UsName = strtolower($UserRow['username']);

	$Uid = $UserRow['uid'];
	
	$UserEmail = $UserRow['email'];
	
	$Uavatar = $UserRow['avatar'];

    $UserSql->close();
	
}else{
     
	 printf("Error: %s\n", $db->error);
	 
}

}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Submit a Image</title>
<link href="templates/<?php echo $settings['template'];?>/css/style.css" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script>
$(document).ready(function()
{
    $('#FileUploader').on('submit', function(e)
    {
        e.preventDefault();
        $('#uploadButton').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output-login").html('<div class="redirecting">Uploading.. Please wait..</div>');
		
        $(this).ajaxSubmit({
        target: '#output-login',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{	
	 
    $('#uploadButton').removeAttr('disabled'); //enable submit button
   
}
</script>
</head>

<body>
<div class="box-title">
  <h1>Post a Fun</h1>
</div>
<div class="info">Upload funny pictures, accepting GIF/JPG/PNG</div>

<div id="output-login"></div>

<div class="theForm">
  <form action="submit_i.php" id="FileUploader" enctype="multipart/form-data" method="post" >
    <label for="catagory-select">Catagory <span class="small">Select a Category</span> </label>
    <select name="catagory-select" id="catagory-select">
      <option value="">Select a Category</option>
      <?php
if($CatSelect = $db->prepare("SELECT id, cname FROM categories")){
	$CatSelect->execute();

    while($CatsRow = $catSelect->fetch()){
				
?>
      <option value="<?php echo $CatsRow['id'];?>"><?php echo $CatsRow['cname'];?></option>
      <?php

}

	
}else{
    
	 printf("Error: %s\n", $db->error);
}
?>
    </select>
    <label>Title <span class="small">Title</span> </label>
    <input type="text" name="mName" id="mName" />
    <label>File <span class="small">Choose a Image</span> </label>
    <input type="file" name="mFile" id="mFile" />
    <div class="div-btn">
      <button type="submit" class="form-button" id="uploadButton">Submit</button>
    </div>
    <div class="space"></div>
  </form>
</div>
<!-- theForm -->
</body>
</html>
