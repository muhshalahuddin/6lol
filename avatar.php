<?php
include('db.php');
session_start();

$Uname = $_SESSION['username'];

if($UserSql = $db->prepare("SELECT * FROM users WHERE username='$Uname'")){
	$UserSql->execute();
	
    $UserRow = $UserSql->fetch();
	
	$uid = $UserRow['uid'];
	$avatrimage = $UserRow['avatar'];
	
    $UserSql->close();
}else{
     printf("Error: %s\n", $db->error);
}
$path = "avatars/";

$valid_formats = array("jpg", "png", "gif", "jpeg");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
$name = $_FILES['photoimg']['name'];
$size = $_FILES['photoimg']['size'];
if(strlen($name))
{
list($txt, $ext) = explode(".", $name);
if(in_array($ext,$valid_formats))
{
if($size<(1024*1024)) // Image size max 1 MB
{
$actual_image_name = time().$uid.".".$ext;
$tmp = $_FILES['photoimg']['tmp_name'];
if(move_uploaded_file($tmp, $path.$actual_image_name))
{
$stmt = $db->prepare("UPDATE users SET avatar='$actual_image_name' WHERE uid='$uid'");
$stmt->execute();

echo json_encode(array('img'=>"<img src='avatars/".$actual_image_name."' class='preview' width='150'/>",'msg'=>"<div class='msg-ok'>Awesome, Profile picture has been uploaded.</div>"));
return;

if (!empty($avatrimage)) {
    unlink("avatars/$avatrimage");
}

}
else
echo json_encode(array('msg'=>"<div class='msg-error'>There seems to be a problem. Please try again.</div>"));
return;

}
else
echo json_encode(array('msg'=>"<div class='msg-error'>Image file size max 1 MB.</div>"));
return;

}
else
echo json_encode(array('msg'=>"<div class='msg-error'>Invalid file format</div>"));
return;

}
else
echo json_encode(array('msg'=>"<div class='msg-error'>Please select image.</div>"));
return;
exit;
}
?>
