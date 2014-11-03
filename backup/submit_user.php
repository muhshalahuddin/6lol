<?php
include('db.php');

if($_POST)
{	
	
	if(!isset($_POST['uName']) || strlen($_POST['uName'])<1)
	{
		//required variables are empty
		die('<div class="msg-error">Please let us know your username.</div>');
	}
	
	$UN = $mysqli->escape_string($_POST['uName']);
	
	if($UserCheck = $mysqli->query("SELECT * FROM users WHERE username ='$UN'")){

   	$VdUser = mysqli_fetch_array($UserCheck);
	
	$UNV = $VdUser['username'];

   	$UserCheck->close();
   
	}else{
   
     printf("Error: %s\n", $mysqli->error);

	}
	
	if ($_POST['uName'] == $UNV)
	{
		//required variables are empty
		die('<div class="msg-error">Username already taken. Please try another.</div>');
	}
	
	if(!isset($_POST['uName']) || strlen($_POST['uName'])<3)
	{
		//required variables are empty
		die('<div class="msg-error">Username must be more then 3 characters long.</div>');
	}
	
	if(!isset($_POST['uEmail']) || strlen($_POST['uEmail'])<1)
	{
		//required variables are empty
		die('<div class="msg-error">Please let us know your email adress.</div>');
	}
	
	$email_address = $_POST['uEmail'];
	
	if (filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
  	// The email address is valid
	} else {
  		die('<div class="msg-error">Please enter a valid email address.</div>');
	}
	
	if(!isset($_POST['uPassword']) || strlen($_POST['uPassword'])<1)
	{
		//required variables are empty
		die('<div class="msg-error">Please provide a password.</div>');
	}
	
	if(!isset($_POST['uPassword']) || strlen($_POST['uPassword'])<6)
	{
		//required variables are empty
		die('<div class="msg-error">Password must be least 6 characters long.</div>');
	}
		if(!isset($_POST['cPassword']) || strlen($_POST['cPassword'])< 1)
	{
		//required variables are empty
		die('<div class="msg-error">Please enter the same password as above.</div>');
	}
	
	if ($_POST['uPassword']!== $_POST['cPassword'])
 	{
		//required variables are empty
     	die('<div class="msg-error">Password did not match! Try again.</div>');
 	
	}
	
	error_reporting(E_ALL ^ E_NOTICE);
	$ip = $_REQUEST['REMOTE_ADDR']; // the IP address to query
	$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
	if($query && $query['status'] == 'success') {
 		$Country = $query['country'];
	} else {
  		$Country = "";
	}
	
			
	
	$UserName  			= $mysqli->escape_string($_POST['uName']); // Username
	$Email  			= $mysqli->escape_string($_POST['uEmail']); // Email
	$Password  			= $mysqli->escape_string($_POST['uPassword']); // Password
	$EnPassword         = md5($Password); // Encript Password
	$About				= "My Funny Collection";
	$RegDate		    = date("F j, Y"); //date
	
	
		
// Insert info into database table.. do w.e!
		$mysqli->query("INSERT INTO users(username, email, country, password, about, reg_date) VALUES ('$UserName', '$Email', '$Country', '$EnPassword','$About	','$RegDate')");
		
?>
<script type="text/javascript">
function leave() {
window.location = "user_login.php";
}
setTimeout("leave()", 1000);
</script>
<?php		
		
		die('<div class="redirecting">Thank you for Registering. Please wait while we redirect you to login.</div>');
		

   }else{
   		die('<div class="msg-error">There seems to be a problem. Please try again.</div>');
   } 

?>
