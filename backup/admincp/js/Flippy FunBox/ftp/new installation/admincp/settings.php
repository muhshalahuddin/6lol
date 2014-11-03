<?php include('header.php');?>
<div class="maintitle">Site Settings</div>
<?php
$act=isset($_GET['act'])?$_GET['act']:"";
 
if($act=='sub'){
$name = $mysqli->escape_string($_POST['site']);
$siteurl = $mysqli->escape_string($_POST['siteurl']);
$keys = $mysqli->escape_string($_POST['keywords']);
$desc = $mysqli->escape_string($_POST['descrp']);
$email = $mysqli->escape_string($_POST['email']);
$openin = $mysqli->escape_string($_POST['open-posts']);
$fbapp = $mysqli->escape_string($_POST['fbapp']);
$fbpage = $mysqli->escape_string($_POST['fbpage']);
$twitter = $mysqli->escape_string($_POST['twitter']);
$gplus = $mysqli->escape_string($_POST['gplus']);
$active = $mysqli->escape_string($_POST['active']);
$template = $mysqli->escape_string($_POST['template']);

	
$mysqli->query("UPDATE settings SET name='$name',siteurl='$siteurl',keywords='$keys',descrp='$desc',email='$email',open_posts='$openin',fbapp='$fbapp',fbpage='$fbpage',twitter='$twitter',gplus='$gplus',active='$active',template='$template' WHERE id=1");

if($_FILES["file"]["name"]!=''){
	 	   move_uploaded_file($_FILES["file"]["tmp_name"], "../images/logo.png");
	}?>
    
<div class="msg-ok">Settings updated successfully.</div>  

<?php } 

if($SiteSettings = $mysqli->query("SELECT * FROM settings WHERE id='1'")){

    $SettingsRow = mysqli_fetch_array($SiteSettings);
	
	$name=$SettingsRow['siteurl'];

    $SiteSettings->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}


?>
<div class="box">
<div class="inbox">
<!--form-->
<form action="settings.php?act=sub" method="post" enctype="multipart/form-data">
<label class="artlbl">Site Name</label>
<div class="formdiv">
<input type="text" name='site' value='<?php echo $SettingsRow['name']?>'/>
</div>
<label class="artlbl">Logo (159px x 47px)</label>
<div class="formdiv">
<input type='file' class="file" name='file'/>
</div>
<div class="clear"></div>
<label class="artlbl">Site URL (without "http://" and end "/")</label>
<div class="formdiv">
<input type="text" name='siteurl' value='<?php echo $SettingsRow['siteurl']?>'/>
</div>
<div class="clear"></div>
<label class="artlbl">Meta Keywords (Separated by Commas)</label>
<div class="formdiv">
<textarea name='keywords' cols=40 rows=5 ><?php echo $SettingsRow['keywords']?></textarea>
</div>
<label class="artlbl">Meta Description</label>
<div class="formdiv">
<textarea name='descrp' cols=40 rows=5 ><?php echo $SettingsRow['descrp']?></textarea>
</div>

<label class="artlbl">Email</label>
<div class="formdiv">
<input type="text" name='email' value='<?php echo $SettingsRow['email']?>'/>
</div>

<label class="artlbl">Open Posts in</label>
<div class="formdiv">
<select name="open-posts" id="open-posts">
<?php if ($SettingsRow['open_posts']==1){?>
<option value="1">New Tab</option>
<option value="0">Self (Same Window)</option>
<?php }else{?>
<option value="0">Self (Same Window)</option>
<option value="1">New Tab</option>
<?php }?>
</select>
</div>
<div class="clear"></div>

<label class="artlbl">Facebook App ID</label>
<div class="formdiv">
<input type="text" name='fbapp' value='<?php echo $SettingsRow['fbapp']?>'/>
</div>

<label class="artlbl">Facebook Fan Page</label>
<div class="formdiv">
<input type="text" name='fbpage' value='<?php echo $SettingsRow['fbpage']?>'/>
</div>

<label class="artlbl">Twitter URL</label>
<div class="formdiv">
<input type="text" name='twitter' value='<?php echo $SettingsRow['twitter']?>'/>
</div>

<label class="artlbl">Google+ URL</label>
<div class="formdiv">
<input type="text" name='gplus' value='<?php echo $SettingsRow['gplus']?>'/>
</div>

<label class="artlbl">Auto Approve Posts</label>
<div class="formdiv">
<select name="active" id="active">
<?php if ($SettingsRow['active']==1){?>
<option value="1">ON</option>
<option value="0">OFF</option>
<?php }else{?>
<option value="0">OFF</option>
<option value="1">ON</option>
<?php }?>
</select>
</div>
<div class="clear"></div>

<label class="artlbl">Template</label>
<div class="formdiv">
<select name="template" id="template">
<option value="<?php echo $SettingsRow['template'];?>"><?php echo ucfirst($SettingsRow['template']);?></option>
<?php
foreach(glob('../templates/*', GLOB_ONLYDIR) as $dir) {
	$TemplateDir = substr($dir, 13);
	$TemplateName = ucfirst($TemplateDir)
?>
<option value="<?php echo $TemplateDir;?>"><?php echo $TemplateName;?></option>
<?php }?>
</select>
</div>
<div class="clear"></div>

</br>
<div class="formdiv">
<div class="sbutton"><input type="submit" id="submit" value="Update Site Settings"/></div>
</div>
</form>
</div>
</div><!--box-->
<?php include('footer.php');?>

 