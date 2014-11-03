<?php session_start();

include("db.php");

$id=$_POST['id'];

$id = $mysqli->real_escape_string($id);

if(!isset($_SESSION['username'])){
?>

<script>
$(document).ready(function(){
	$.colorbox({href:"login.html"});
})
</script>

<?php
}else{
	
$Uname = $_SESSION['username'];

if($UserSql = $mysqli->query("SELECT * FROM users WHERE username='$Uname'")){

    $UserRow = mysqli_fetch_array($UserSql);

	$Uid = $UserRow['uid'];
	
	$UserSql->close();
	
}else{
     
	 printf("Error: %s\n", $mysqli->error);
	 
}



$ip=$_SERVER['REMOTE_ADDR']; 

if($_POST['id'])
{

$CheckIp = $mysqli->query("SELECT * FROM voteip WHERE media_id='$id' AND uid='$Uid'");
$VoteType = mysqli_fetch_array($CheckIp);

$Vote = $VoteType['type'];

$Count = mysqli_num_rows($CheckIp);

if($Count==0)
{
	$Sql = $mysqli->query("UPDATE media SET votes=votes+1 WHERE id='$id'");
	$SqlIn = $mysqli->query("INSERT INTO voteip (media_id,ip,uid,type) VALUES ('$id','$ip','$Uid','1')");

}else{
//Get vote up or down

if ($Vote==1){
	
	$RemoveVote	= $mysqli->query("UPDATE media SET votes=votes-1 WHERE id='$id'");
	$DeleteVote = $mysqli->query("DELETE FROM voteip WHERE media_id='$id'");
	
} elseif ($Vote==2){
	$AddVote = $mysqli->query("UPDATE media SET votes=votes+1 WHERE id='$id'");
	$UpdateVote = $mysqli->query("UPDATE voteip SET type='1' WHERE media_id='$id'");
	
}

// End vote up down
}

}

}

$result=$mysqli->query("SELECT votes FROM media WHERE id='$id'");
$row=mysqli_fetch_array($result);

echo $row['votes'];
?>