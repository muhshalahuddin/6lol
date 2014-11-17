<?php session_start();

include("db.php");

$id=$_POST['id'];

$id = $db->quote($id);

if(!isset($_SESSION['username'])){
?>

<script>
$(document).ready(function(){
	$.colorbox({href:"login.php"});
})
</script>

<?php
}else{
	
$Uname = $_SESSION['username'];

if($UserSql = $db->prepare("SELECT * FROM users WHERE username=$Uname")){
	$UserSql->execute();
    $UserRow = $UserSql->fetch();

	$Uid = $UserRow['uid'];
	
	
}else{
     
	 printf("Error: %s\n", $db->error);
	 
}



$ip=$_SERVER['REMOTE_ADDR']; 

if($_POST['id'])
{

$CheckIp = $db->prepare("SELECT * FROM voteip WHERE media_id=$id AND uid=$Uid");
$CheckIp->execute();
$VoteType = $CheckIp->fetch();

$Vote = $VoteType['type'];

$Count = $CheckIp->rowCount();

if($Count==0)
{
	$Sql = $db->prepare("UPDATE media SET votes=votes-1 WHERE id=$id");
	$Sql->execute();
	$SqlIn = $db->prepare("INSERT INTO voteip (media_id,ip,uid,type) VALUES ($id,'$ip',$Uid,2)");
	$SqlIn->execute();

}else{
//Get vote up or down

if ($Vote==1){
	
	$AddVote = $db->prepare("UPDATE media SET votes=votes-1 WHERE id=$id");
	$AddVote->execute();
	$UpdateVote = $db->prepare("UPDATE voteip SET type='2' WHERE media_id=$id");
	$UpdateVote->execute();
	
} elseif ($Vote==2){
		
	$RemoveVote	= $db->prepare("UPDATE media SET votes=votes+1 WHERE id=$id");
	$RemoveVote->execute();
	$DeleteVote = $db->prepare("DELETE FROM voteip WHERE media_id=$id");
	$DeleteVote->execute();
	
}

// End vote up down
}

}

}

$result=$db->prepare("SELECT votes FROM media WHERE id=$id");
$result->execute();
$row=$result->fetch();

echo $row['votes'];
?>
