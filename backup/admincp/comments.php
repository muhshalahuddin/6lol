<?php include("header.php");?>
<div class="maintitle">Manage Comments</div>
<div class="clear"></div>
<?php

if($squ = $mysqli->query("SELECT * FROM settings WHERE id='1'")){

    $settings = mysqli_fetch_array($squ);
	
	$squ->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

error_reporting(E_ALL ^ E_NOTICE);

//Delete

$del = $mysqli->escape_string($_GET['del']);

$delete = $mysqli->escape_string($_GET['delete']);

if ($delete == 'yes'){
	
//Get Answer Info

if($GetComments = $mysqli->query("SELECT * FROM comments WHERE id='$del'")){

    $CommentRow = mysqli_fetch_array($GetComments);
	
	$PostId = $CommentRow['pid']; 
	
	$Auid = $CommentRow['uid'];
	
	$GetComments->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);

} 

//Update Comment Count
$CommentCount = $mysqli->query("UPDATE media SET cmts=cmts-1 WHERE id='$PostId'");	

//Delete Comment	
$DeleteAnswer = $mysqli->query("DELETE FROM comments WHERE id='$del'");

//Delete Votes	
$DeleteVotes = $mysqli->query("DELETE FROM votecmt WHERE aid='$del'");


?>  
<div class="msg-ok">Comment successfully deleted</div>

<?php }?>
<div class="box">
<div class="inbox">
<?php

	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = $mysqli->query("SELECT COUNT(*) as num FROM comments ORDER BY id DESC");
	$total_pages = mysqli_fetch_array($query);
	$total_pages = $total_pages['num'];
	
	/* Setup vars for query. */
	$targetpage = "comments.php"; 	//your file name  (the name of this file)
	$limit = 15; 								//how many items to show per page
	$page=$_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM comments ORDER BY id DESC LIMIT $start, $limit";
	$result = $mysqli->query($sql);
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\">« previous</a>";
		else
			$pagination.= "<span class=\"disabled\">« previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">next »</a>";
		else
			$pagination.= "<span class=\"disabled\">next »</span>";
		$pagination.= "</div>\n";		
	}
?>
<table width="930" class="datatable" border="0" cellspacing="0" cellpadding="0">
<thead>
  <tr>
  	<td width="146">Username</td>
    <td width="615">Comment</td>
    <td width="167">Actions</td>
  </tr>
 </thead>
<tbody>
	<?php
		while($row = mysqli_fetch_array($result))
		{
			$Comment = stripslashes($row['comment']);
			$CommentCount =  strlen($Comment);
			if ($CommentCount > 97) {
			$CommentCut = substr($Comment,0,97).'..';
			}else{
			$CommentCut = $Comment;}
		
		$GetPostId = $row['pid'];	
		$GetPost = $mysqli->query("SELECT id, title FROM media WHERE id=$GetPostId");
		$PostRow = mysqli_fetch_array($GetPost);
		$longTitle = $PostRow['title'];
		$MediaLink = preg_replace("![^a-z0-9]+!i", "-", $longTitle);
		$MediaLink = nl2br(strtolower($MediaLink));	
			
	?>
		<tr>
   	<td><?php echo ucfirst($row['username']);?></td>
    <td><a href="../post-<?php echo $row['pid'];?>-<?php echo $MediaLink;?>.html" target="_blank"><?php echo $CommentCut;?></a></td>
    <td>
    <center>
	<a class="red" href="deletecomment.php?page=<?php echo $page;?>&del=<?php echo $row['id'];?>">Delete</a>
	</center>
    </td>
  </tr>
	
<?php }	?>
 </tbody>
</table> 
<?=$pagination?>
<?php
$q = $mysqli->query("SELECT * FROM comments");

	$numr = mysqli_num_rows($q);
	if ($numr==0)
	{
	echo '<div class="msg">There are no comments to display at the moment.</div>';
	}
?>

</div>
</div>
	
<?php include("footer.php");?>