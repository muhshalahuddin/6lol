<?php
session_start();
include('db.php');

if($SettingsSql = $mysqli->query("SELECT * FROM settings WHERE id='1'")){

    $settings = mysqli_fetch_array($SettingsSql);
	
	$Active = $settings['active'];
	
	$SettingsSql->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

//Get user info

$Uname = $_SESSION['username'];

if($UserSql = $mysqli->query("SELECT * FROM users WHERE username='$Uname'")){

    $UserRow = mysqli_fetch_array($UserSql);
	
	$UsName = strtolower($UserRow['username']);

	$Uid = $UserRow['uid'];
	
    $UserSql->close();
	
}else{
     
	 printf("Error: %s\n", $mysqli->error);
	 
}

$UploadDirectory	= 'uploads/'; //Upload Directory, ends with slash & make sure folder exist


if (!@file_exists($UploadDirectory)) {
	//destination folder does not exist
	die('<div class="msg-error">Make sure Upload directory exist!</div>');
}

if($_POST)
{	

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
	
	if(!isset($_FILES['mFile']))
	{
		//required variables are empty
		die('<div class="msg-error">Please select a image file</div>');
	}

	
	if($_FILES['mFile']['error'])
	{
		//File upload error encountered
		die(upload_errors($_FILES['mFile']['error']));
	}

	$FileName			= strtolower($_FILES['mFile']['name']); //uploaded file name
	$FileTitle			= $mysqli->escape_string($_POST['mName']); // file title
	$ImageExt			= substr($FileName, strrpos($FileName, '.')); //file extension
	$FileType			= $_FILES['mFile']['type']; //file type
	$FileSize			= $_FILES['mFile']["size"]; //file size
	$RandNumber   		= rand(0, 9999999999); //Random number to make each filename unique.
	$Catagory           = $mysqli->escape_string($_POST['catagory-select']); 
	$Date				= date("c",time());
	
	
	switch(strtolower($FileType))
	{
		//allowed file types
		case 'image/png': //png file
		case 'image/gif': //gif file 
		case 'image/jpeg': //jpeg file
			break;
		default:
			die('<div class="msg-error">Unsupported File! Please upload JPG, GIF or PNG file</div>'); //output error
	}
	
	if ($FileType == 'image/gif'){
		
		$Type				="2";
		
	}else{
		
		$Type				="1";
		
	}

  
	//File Title will be used as new File name
	$NewFileName = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), strtolower($FileTitle));
	$NewFileName = $NewFileName.'_'.$RandNumber.$ImageExt;
   //Rename and save uploded file to destination folder.
   if(move_uploaded_file($_FILES['mFile']["tmp_name"], $UploadDirectory . $NewFileName ))
   {
		
// Insert info into database table.. do w.e!
		$mysqli->query("INSERT INTO media(title, image, type, catid, uid, date, active) VALUES ('$FileTitle','$NewFileName','$Type','$Catagory','$Uid','$Date','$Active')") or die (mysqli_error());
		

?>

<script>
$('.theForm').delay(500).slideUp(1000);
$('.theForm').delay(1000).resetForm(1000);
</script>

<?php


		die('<div class="msg-ok">Thank you for your submission.</div>');

		
   }else{
   		die('<div class="msg-error">There seems to be a problem. please try again.</div>');
   }
}

//function outputs upload error messages, http://www.php.net/manual/en/features.file-upload.errors.php#90522
function upload_errors($err_code) {
	switch ($err_code) { 
        case UPLOAD_ERR_INI_SIZE: 
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini'; 
        case UPLOAD_ERR_FORM_SIZE: 
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form'; 
        case UPLOAD_ERR_PARTIAL: 
            return 'The uploaded file was only partially uploaded'; 
        case UPLOAD_ERR_NO_FILE: 
            return 'No file was uploaded'; 
        case UPLOAD_ERR_NO_TMP_DIR: 
            return 'Missing a temporary folder'; 
        case UPLOAD_ERR_CANT_WRITE: 
            return 'Failed to write file to disk'; 
        case UPLOAD_ERR_EXTENSION: 
            return 'File upload stopped by extension'; 
        default: 
            return 'Unknown upload error'; 
    } 
} 
?>