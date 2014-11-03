<?php include ('header.php');?>
<script type="text/javascript" src="js/jquery.form.js"></script>
<section id="left">

<div class="post-box">
<header class="post-header">
<div class="post-title"><h1>Login to Your Account</h1></div><!--post-title-->
<div class="post-footer"></div>
</header>

<script>
$(document).ready(function()
{
    $('#UserLogin').on('submit', function(e)
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
    //$('#UserLogin').resetForm();  // reset form
    $('#submitButton').removeAttr('disabled'); //enable submit button
    $('#loadding').html('');
}
</script>

<div id="output-login">&nbsp;</div>

<div class="theForm">
<form action="submit_login.php" id="UserLogin" method="post">


<label>Username</label>
    <input type="text" name="username" id="username" />
    
<label>Password</label>
    <input type="password" name="password" id="password" />    
<div class="login_submit">
<button type="submit" class="btns" id="submitButton">Login</button>
</div>
</form>
</div>

</div><!--post-box-->


</section><!--left-->
	

<section id="right"><?php include ('right_blocks.php');?></section><!--right-->
<?php include ('footer.php');?>