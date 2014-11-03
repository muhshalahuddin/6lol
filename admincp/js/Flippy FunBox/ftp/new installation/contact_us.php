<?php include ('header.php');?>
<script type="text/javascript" src="js/jquery.form.js"></script>
<section id="left">

<div class="post-box">
<header class="post-header">
<div class="post-title"><h1>Contact Us</h1></div><!--post-title-->
<div class="post-footer"></div>
</header>

<div id="output-login"></div>
<div id="loadding"></div>

<script>
$(document).ready(function()
{
    $('#ContactUs').on('submit', function(e)
    {
        e.preventDefault();
        $('#SubmitButton').attr('disabled', ''); // disable upload button
        //show uploading message
        
        $(this).ajaxSubmit({
        target: '#output-login',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{
    $('#SubmitButton').removeAttr('disabled'); //enable submit button
    $('#loadding').html('');
}
</script>
<div class="theForm">

<form action="send_contact.php" id="ContactUs" method="post">

<label>Name</label><input name="name" type="text">

<label>Email</label><input name="email" type="text">

<label>Subject</label><input name="subject" type="text">

<label>Message</label><textarea name="message"></textarea>

<button type="submit" class="form-button" id="SubmitButton">Send</button>
</form>

</div>

</div><!--post-box-->


</section><!--left-->
	

<section id="right"><?php include ('right_blocks.php');?></section><!--right-->
<?php include ('footer.php');?>