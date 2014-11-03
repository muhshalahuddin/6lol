<?php include ('header.php');?>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/jquery.ui.datepicker.min.js"></script>
<link href="templates/<?php echo $settings['template'];?>/css/jquery.ui.all.css" rel="stylesheet" type="text/css">
<script>
$(function() {
$( "#birthday" ).datepicker({
changeMonth: true,
changeYear: true,
dateFormat: 'yy-mm-dd'
});
});
</script>
<section id="left">

<script type="text/javascript">
$(document).ready(function()
{
$('#photoimg').live('change', function()
{
$("#preview").html('');
$("#output-msg").html('<div class"loader"><img src="templates/<?php echo $settings['template'];?>/images/loading.gif" alt="Please Wait"/> <br/><span>Uploading...</span></div>');


$("#imageform").ajaxForm(
{
    dataType:'json',
    success:function(json){
       $('#preview').html(json.img);
       $('#output-msg').html(json.msg);
    }
}).submit();

});
});
</script>

<div class="post-box">
<header class="post-header">
<div class="post-title"><h1>Settings</h1></div><!--post-title-->
<div class="post-footer"></div>
</header>

<div id="uploading"></div>
<div id="output-msg"></div>
<div class="theForm">

<form action="avatar.php" method="post" name="imageform" id="imageform" enctype="multipart/form-data">
        <!-- begin image label and input -->
		<label>Image<span class="small">(gif, jpg, png)</span>
    </label>
		<input type="file" size="45" name="photoimg" id="photoimg" /><!-- end image label and input -->
 
      </form><!-- end form -->

<div id="preview"></div>
</div>

<div class="box-title"><h1>Edit Info</h1></div>

<script>
$(document).ready(function()
{
    $('#FromProfile').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitButton').attr('disabled', ''); // disable upload button
        //show uploading message
        //$("#div-loadding").html('<div class="loader"><img src="templates/<?php echo $settings['template'];?>/images/ajax-loader.gif" alt="Please Wait"/> <br/><span>Submiting...</span></div>');
        $(this).ajaxSubmit({
        target: '#output',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{
    //$('#FromProfile').resetForm();  // reset form
    $('#submitButton').removeAttr('disabled'); //enable submit button
    //$('#div-loadding').html('');
}
</script>

<?php

if($Profile = $db->prepare("SELECT * FROM users WHERE uid='$Uid'")){
	$Profile->execute();

    $ProfileRow = $profile->fetch();
	
	$Gender = $ProfileRow['gender'];
	
}else{
    
	 printf("Error: %s\n", $db->error);
}	

?>

<div id="output"></div>
<div class="theForm">
<form action="submit_profile.php" id="FromProfile" method="post" >

	<label>Gender
    <span class="small">Select Your Gender</span>
    </label>
    <select name="sex" id="sex">
   	<?php if(!empty($Gender)){?>
    <option value="<?php echo $Gender;?>"><?php echo $Gender;?></option>
    <?php }?>
    <option disabled value="">Chose</option>
	<option value="Male">Male</option>
    <option value="Female">Female</option>
    </select>    

    <label>Nickname
    <span class="small">Cannot be changed</span>
    </label>
    <input type="text" disabled="disabled" name="uName" id="uName" value="<?php echo $ProfileRow['username'];?>" />
    
    <label>Birthday
    <span class="small">Click to select</span>
    </label>
    <input type="text" name="birthday" id="birthday" value="<?php echo $ProfileRow['birthday'];?>" />
    
     <label>Email
    <span class="small">Enter a valid email address</span>
    </label>
    <input type="text" name="uEmail" id="uEmail" value="<?php echo $ProfileRow['email'];?>"/>
    
     <label>Country
    <span class="small">Let us know your country</span>
    </label>
    <input type="text" name="country" id="country" value="<?php echo $ProfileRow['country'];?>"/>
    
    <label>About
    <span class="small">Tell us little bit about your self</span>
    </label>
    <textarea name="about" cols="40" rows="5"><?php echo $ProfileRow['about'];?></textarea>
   
<div class="subbtn-div">    
    <button type="submit" class="btns" id="submitButton">Submit</button>
</div>    
</form>
</div> <!--the form-->

<div class="box-title"><h1>Update Password</h1></div>

<script>
$(document).ready(function()
{
    $('#FromPassword').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitButton').attr('disabled', ''); // disable upload button
        //show uploading message
        //$("#load").html('<div class="loader"><img src="templates/<?php echo $settings['template'];?>/images/ajax-loader.gif" alt="Please Wait"/> <br/><span>Submiting...</span></div>');
        $(this).ajaxSubmit({
        target: '#outputmsg',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{
    //$('#FromPassword').resetForm();  // reset form
    $('#submitButton').removeAttr('disabled'); //enable submit button
    //$('#load').html('');
}
</script>
<div id="outputmsg"></div>
<div class="theForm">
<form action="submit_password.php" id="FromPassword" method="post" >

    <label>Old Password
    <span class="small">Please provide your old password</span>
    </label>
    <input type="password" name="nPassword" id="uPassword" />
    
     <label>New Password
    <span class="small">Please provide the new password</span>
    </label>
    <input type="password" name="uPassword" id="uPassword" />
    
     <label>Conform Password
    <span class="small">Retype the above password</span>
    </label>
    <input type="password" name="cPassword" id="cPassword" />
<div class="subbtn-div">    
    <button type="submit" class="btns" id="submitButton">Submit</button>
</div>    

</form>
</div> <!--the form-->

</div><!--post-box-->


</section><!--left-->
	

<section id="right"><?php include ('right_blocks.php');?></section><!--right-->
<?php include('footer.php');?>
