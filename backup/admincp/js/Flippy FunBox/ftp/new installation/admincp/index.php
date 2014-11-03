<?php include('header.php');?>
<div class="maintitle">Dashboard</div>
<div class="box-top">
<div class="inbox">
<div class="leftTable">
<table width="455" class="datatable" border="0" cellspacing="0" cellpadding="0">
<thead>
  <tr>
    <td width="300">Picture Statistics</td>
    <td width="160"></td>
   </tr>
 </thead>
<tbody>
<tr>
    <td>Total Pictures</td>
<?php
if($TotPics = $mysqli->query("SELECT id FROM media WHERE type=1 or type=2")){

    $TpNum = $TotPics->num_rows;
  
?> 
     <td><?php echo $TpNum;?></td>

<?php

    $TotPics->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

?>     
</tr>
<tr>
<td>Total Approved Pictures</td>
<?php
if($TaPics= $mysqli->query("SELECT id FROM media WHERE type=1 or type=2 and active=1")){

    $TaNum = $TaPics->num_rows;
?>     

<td><?php echo $TaNum;?></td>

<?php

    $TaPics->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

?>

</tr>
<tr>
    <td>Total Approval Pending Pictures</td>
<?php
if($TpPics = $mysqli->query("SELECT id FROM media WHERE active=0 and (type=1 or type=2)")){

    $TpNum = $TpPics->num_rows;
?>      
    <td><?php echo $TpNum;?></td>
<?php

    $TpPics->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

?>  
    
</tr>
</tbody>
</table> 
</div>
<!--#-->
<div class="rightTable">
<table width="455" class="datatable" border="0" cellspacing="0" cellpadding="0">
<thead>
  <tr>
    <td width="300">Video Statistics</td>
    <td width="160"></td>
   </tr>
 </thead>
<tbody>
<tr>
    <td>Total Videos</td>
<?php
if($TotVids = $mysqli->query("SELECT id FROM media WHERE type=3")){

    $TvNum = $TotVids->num_rows;
  
?>     
	 <td><?php echo $TvNum;?></td>
<?php

    $TotVids->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

?>     
</tr>
<tr>
    <td>Total Approved Videos</td>
<?php 
if($TaVids = $mysqli->query("SELECT id FROM media WHERE type=3 and active=1")){

    $TvaNum = $TaVids->num_rows;
  
?>      
    <td><?php echo $TvaNum;?></td>
<?php

    $TaVids->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

?>
    
</tr>
<tr>
    <td>Total Approval Pending Videos</td>
<?php 
if($TpVids = $mysqli->query("SELECT id FROM media WHERE type=3 and active=0")){

    $TvpNum = $TpVids->num_rows;
  
?>    
    <td><?php echo $TvpNum;?></td>
<?php

    $TpVids->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

?>   
</tr>
</tbody>
</table> 
</div>
</div>
</div>
<div class="clear"></div>
<!--#-->

<div class="maintitle">Last 10 Approved Pictures</div>
<div class="box-top">
<div class="inbox">

<table width="925" class="datatable" border="0" cellspacing="0" cellpadding="0">
<thead>
  <tr>
    <td width="678">Title</td>
    <td width="150">Added Date</td>
   </tr>
 </thead>
<tbody>
	<?php
	if($TtaPics = $mysqli->query("SELECT * FROM media WHERE type=1 or type=2 and active=1 ORDER BY id DESC LIMIT 10")){

		while($PicRow = mysqli_fetch_array($TtaPics))
		{
		$fpost = $PicRow['feat'];
		?>
		<tr>
    <td><a class="preview" href="previewimage.php?id=<?php echo $PicRow['id'];?>"><?php echo stripslashes($PicRow['title']);?></a></td>
    <td><abbr class="timeago" title="<?php echo $PicRow['date'];?>"></abbr></td>
</tr>
<?php
		}

    $TtaPics->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

?> 
 </tbody>
</table> 
<!--#-->
</div>
</div>
<!--#-->

<div class="maintitle">Last 10 Approved Videos</div>
<div class="box-top">
<div class="inbox">


<table width="925" class="datatable" border="0" cellspacing="0" cellpadding="0">
<thead>
  <tr>
    <td width="678">Title</td>
    <td width="150">Added Date</td>
  </tr>
 </thead>
<tbody>
	<?php
	if($TtaVids = $mysqli->query("SELECT * FROM media WHERE type=3 and active=1 ORDER BY id DESC LIMIT 10")){

		while($VidRow = mysqli_fetch_array($TtaVids))
		{
		$fpost = $VidRow['feat'];
		?>
		<tr>
    <td><a class="preview" href="previewvideos.php?id=<?php echo $VidRow['id'];?>"><?php echo stripslashes($VidRow['title']);?></a></td>
    <td><abbr class="timeago" title="<?php echo $VidRow['date'];?>"></abbr></td>
</tr>
<?php
		}

    $TtaVids->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

?> 
 </tbody>
</table>
</div>
</div><!--box-->
<?php include('footer.php');?>

 