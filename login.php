<?php
session_start();

include('db.php');

if($squ = $db->prepare("SELECT * FROM settings WHERE id='1'")){
	$squ->execute();

    $settings = $squ->fetch();

}else{
     printf("Error: %s\n", $db->error);
}
?>
<!doctype html>
<html><head>
<meta charset="utf-8">
<title>Login to Your Account</title>
<link href="templates/<?php echo $settings['template'];?>/css/style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>

<script>
$(document).ready(function()
{
    $('#FromLogin').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitButton').attr('disabled', ''); // disable upload button
        //show uploading message
        
        $(this).ajaxSubmit({
        target: '#output-login',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{
    //$('#FromLogin').resetForm();  // reset form
    $('#submitButton').removeAttr('disabled'); //enable submit button
    $('#loadding').php('');
}
</script>
</head>

<body>

<div class="box-title"><h1>Login to Your Account</h1></div>

<div id="output-login">&nbsp;</div>

<div id="LogForm">
<form action="submit_login.php" id="FromLogin" method="post">

<label>Username</label>
    <input type="text" name="username" id="username" />
    
<label>Password</label>
    <input type="password" name="password" id="password" />    
<div class="login_submit">
<button type="submit" class="btns" id="submitButton">Login</button>
</div>
</form>
</div>
</body>
