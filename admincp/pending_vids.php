<?php include("header.php");?>
<div class="maintitle">Manage Pending Videos</div>
<div class="clear"></div>
<?php
error_reporting(E_ALL ^ E_NOTICE);
//Delete category
$del = $_GET['del'];
$delete = $_GET['delete'];
if ($delete == 'yes'){
//delete the data	
$delete=$db->prepare("DELETE FROM media WHERE id='$del'");
$delete->execute();

?>  
<div class="msg-ok">Post successfully deleted</div>

<?php }

$app = $_GET['app'];
$approved = $_GET['approved'];
if ($approved == 'yes'){

$UpdateMedia = $db->prepare("UPDATE media SET active='1' WHERE id='$app'");
$UpdateMedia->prepare();

?>
<div class="msg-ok">Post successfully updated</div>

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
	$query = $db->prepare("SELECT COUNT(*) as num FROM media WHERE type=3 and active=0 ORDER BY id DESC");
	$query->execute();
	$total_pages = $query->fetch();
	$total_pages = $total_pages['num'];
	
	/* Setup vars for query. */
	$targetpage = "pending_vids.php"; 	//your file name  (the name of this file)
	$limit = 10; 								//how many items to show per page
	$page=$_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$result = $db->prepare("SELECT * FROM media WHERE type=3 and active=0 ORDER BY id DESC LIMIT $start, $limit");
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
<table width="925" class="datatable" border="0" cellspacing="0" cellpadding="0">
<thead>
  <tr>
    <td width="340">Title</td>
    <td width="150">Added Date</td>
    <td width="338">Actions</td>
  </tr>
 </thead>
<tbody>
	<?php
	
		while($row = $result->fetch())
		{
		$fpost = $row['feat'];
		?>
		<tr>
    <td><a class="preview" href="previewvideos.php?id=<?php echo $row['id'];?>"><?php echo stripslashes($row['title']);?></a></td>
    <td><abbr class="timeago" title="<?php echo $row['date'];?>"</td>
    <td>
    <center>
	<a class="red"href="deletepvids.php?page=<?php echo $page;?>&del=<?php echo $row['id'];?>">Delete</a>
    <a class="blue"href="appvid.php?page=<?php echo $page;?>&app=<?php echo $row['id'];?>">Approve</a>
    <a class="green"href="edit_vids.php?id=<?php echo $row['id'];?>">Edit Info</a>
    </center>
    </td>
  </tr>
	
<?php }	?>
 </tbody>
</table> 
<?=$pagination?>
<?php
$q = $db->prepare("SELECT * FROM media WHERE type=3 and active=0 ORDER BY id desc LIMIT $start,$limit");
$q->execute();

	$numr = $q->rowCount();
	if ($numr==0)
	{
	echo '<div class="msg">There are no pending videos at the moment.</div>';
	}
?>
</div>
</div>
	
<?php include("footer.php");?>
