<?php
session_start();

include('db.php');

if($SettingsSql = $mysqli->query("SELECT * FROM settings WHERE id='1'")){

    $settings = mysqli_fetch_array($SettingsSql);
	
	$template = $settings['template'];
	
	$FbPage = $settings['fbpage'];

    $SettingsSql->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

if(!isset($_SESSION['username'])){?>

<div class="box-title"><h1>Register New Account</h1></div>

<link href="templates/<?php echo $settings['template'];?>/css/style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>

<script>
$(document).ready(function()
{
    $('#FromRegister').on('submit', function(e)
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
    //$('#FromRegister').resetForm();  // reset form
    $('#submitButton').removeAttr('disabled'); //enable submit button
    $('#loadding').html('');
}
</script>
<div id="output-login"></div>

<div id="registerForm">
<form action="submit_user.php" id="FromRegister" method="post" >

    <label>Username
    <span class="small">Please enter your username</span>
    </label>
    <input type="text" name="uName" id="uName" />
    
     <label>Email
    <span class="small">Enter a valid email address</span>
    </label>
    <input type="text" name="uEmail" id="uEmail" />
    
     <label>Password
    <span class="small">Please provide a password</span>
    </label>
    <input type="password" name="uPassword" id="uPassword" />
    
     <label>Conform Password
    <span class="small">Retype the above password</span>
    </label>
    <input type="password" name="cPassword" id="cPassword" />
<div class="subbtn-div">     
    <button type="submit" class="btns" id="submitButton">Register</button>
</div>    
    <div class="spacer"></div>
</form>
</div> <!--the form-->

<?php }else{?>
<div class="slog-reg">You are already registed.</div>	
<?php }?>