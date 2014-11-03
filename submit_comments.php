<?php

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

include ("db.php");

include ("include/comments.class.php");

/*
/	This array is going to be populated with either
/	the data that was sent to the script, or the
/	error messages.
/*/

$Date		        = date("c",time());

$arr = array();
$validates = Comment::validate($arr);

if($validates)
{
	/* Everything is OK, insert to database: */
	
	$CommentsTxt = $db->quote($arr['comment']);
	
	$CommentsInsert = $db->prepare("INSERT INTO comments(username,comment,date,uid,pid) VALUES ('".$arr['name']."','".$CommentsTxt."','".$Date."','".$arr['ruid']."','".$arr['pid']."')") or die (mysqli_error());
	$CommentsInsert->execute();
	
	$CommentsUpdate = $db->prepare("UPDATE media SET cmts=cmts+1 WHERE id='".$arr['pid']."'");
	$CommentsUpdate->execute();
	
	$arr['date'] = date('r',time());
	
	$arr = array_map('stripslashes',$arr);
	
	$insertedComment = new Comment($arr);

	
	echo json_encode(array('status'=>1,'html'=>$insertedComment->markup()));

}
else
{
	/* Outputtng the error messages */
	echo '{"status":0,"errors":'.json_encode($arr).'}';
}

?>
