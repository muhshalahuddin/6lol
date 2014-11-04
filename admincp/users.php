<?php include("header.php");?>
<div class="maintitle">Manage Users</div>
<div class="clear"></div>
<?php
error_reporting(E_ALL ^ E_NOTICE);
//Delete category
$del = $_GET['del'];
$delete = $_GET['delete'];
if ($delete == 'yes'){
	
if ($Delete= $mysqli->query("DELETE FROM users WHERE uid='$del'")) {
    
    $Delete->close();
}

// Delete Questions
if ($DeleteQuestions = $mysqli->query("DELETE FROM questions WHERE userid='$del'")) {
      
    $DeleteQuestions->close();
}

//Dele Answers
if ($DeleteAnswers= $mysqli->query("DELETE FROM answers WHERE uid='$del'")) {
   
   
    $DeleteAnswers->close();
}

//Delete Question Votes

if ($DeleteQvotes= $mysqli->query("DELETE FROM qu_votes WHERE uid='$del'")) {
   
   
    $DeleteQvotes->close();
}

//Delete Answer Votes

if ($DeleteAvotes= $mysqli->query("DELETE FROM an_votes WHERE uid='$del'")) {
   
   
    $DeleteAvotes->close();
}

?>  
<div class="msg-ok">User successfully deleted</div>

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
	$query = $db->prepare("SELECT COUNT(*) as num FROM users ORDER BY uid DESC");
	$query->execute();
	$total_pages = $query->fetch();
	$total_pages = $total_pages['num'];
	
	/* Setup vars for query. */
	$targetpage = "users.php"; 	//your file name  (the name of this file)
	$limit = 15; 								//how many items to show per page
	$page=$_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM users ORDER BY uid DESC LIMIT $start, $limit";
	$result = $db->prepare($sql);
	$result->execute();
	
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
  	<td width="50">Avatar</td>
    <td width="316">Username</td>
    <td width="181">Email</td>
    <td width="155">Registered Date</td>
    <td width="144">Actions</td>
  </tr>
 </thead>
<tbody>
	<?php
		while($row = $result->fetch())
		{
			$avatar = $row['avatar'];
			
			$userName = strtolower($row['username']);
			
			
	?>
		<tr>
    <td>
	
	<?php if (empty($avatar)){ ?>
	<img src="../templates/<?php echo $settings['template'];?>/images/default-avatar.png" width="50" height="50">
	<?php }elseif (!empty($avatar)){?>

	<img src="../timthumb.php?src=http://<?php echo $settings['siteurl'];?>/avatars/<?php echo $row['avatar'];?>&amp;h=50&amp;w=50&amp;q=100" alt="User Avatar" class="img_thumb"/>

	<?php }?>
	</td>
	<td><?php echo $row['username'];?></td>
    <td><?php echo $row['email'];?></td>
    <td><?php echo $row['reg_date'];?></td>
    <td>
    <center>
	<a href="../profile-<?php echo $row['uid'];?>-<?php echo $userName;?>.html" target="_blank" class="green">View</a>
	<a class="red" href="deleteuser.php?page=<?php echo $page;?>&del=<?php echo $row['uid'];?>">Delete</a>
	</center>
    </td>
  </tr>
	
<?php }	?>
 </tbody>
</table> 
<?=$pagination?>
</div>
</div>
	
<?php include("footer.php");?>
