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
if($TotPics = $db->prepare("SELECT id FROM media WHERE type=1 or type=2")){
	$TotPics->execute();

    $TpNum = $TotPics->rowCount();
  
?> 
     <td><?php echo $TpNum;?></td>

<?php

}else{
    
	 printf("Error: %s\n", $db->error);
}

?>     
</tr>
<tr>
<td>Total Approved Pictures</td>
<?php
if($TaPics= $db->prepare("SELECT id FROM media WHERE type=1 or type=2 and active=1")){
	$TaPics->execute();
    $TaNum = $TaPics->rowCount();
?>     

<td><?php echo $TaNum;?></td>

<?php

	
}else{
    
	 printf("Error: %s\n", $db->error);
}

?>

</tr>
<tr>
    <td>Total Approval Pending Pictures</td>
<?php
if($TpPics = $db->prepare("SELECT id FROM media WHERE active=0 and (type=1 or type=2)")){
	$TpPics->execute();

    $TpNum = $TpPics->rowCount();
?>      
    <td><?php echo $TpNum;?></td>
<?php
	
}else{
    
	 printf("Error: %s\n", $db->error);
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
if($TotVids = $db->prepare("SELECT id FROM media WHERE type=3")){
	$TotVids->execute();

    $TvNum = $TotVids->rowCount();
  
?>     
	 <td><?php echo $TvNum;?></td>
<?php

	
}else{
    
	 printf("Error: %s\n", $db->error);
}

?>     
</tr>
<tr>
    <td>Total Approved Videos</td>
<?php 
if($TaVids = $db->prepare("SELECT id FROM media WHERE type=3 and active=1")){
	$TaVids->execute();

    $TvaNum = $TaVids->rowCount();
  
?>      
    <td><?php echo $TvaNum;?></td>
<?php

	
}else{
    
	 printf("Error: %s\n", $db->error);
}

?>
    
</tr>
<tr>
    <td>Total Approval Pending Videos</td>
<?php 
if($TpVids = $db->prepare("SELECT id FROM media WHERE type=3 and active=0")){
	$TpVids->execute();

    $TvpNum = $TpVids->rowCount();
  
?>    
    <td><?php echo $TvpNum;?></td>
<?php

	
}else{
    
	 printf("Error: %s\n", $db->error);
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
	if($TtaPics = $db->prepare("SELECT * FROM media WHERE type=1 or type=2 and active=1 ORDER BY id DESC LIMIT 10")){
		$TtaPics->execute();

		while($PicRow = $TtaPics->fetch())
		{
		$fpost = $PicRow['feat'];
		?>
		<tr>
    <td><a class="preview" href="previewimage.php?id=<?php echo $PicRow['id'];?>"><?php echo stripslashes($PicRow['title']);?></a></td>
    <td><abbr class="timeago" title="<?php echo $PicRow['date'];?>"></abbr></td>
</tr>
<?php
		}

	
}else{
    
	 printf("Error: %s\n", $db->error);
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
	if($TtaVids = $db->prepare("SELECT * FROM media WHERE type=3 and active=1 ORDER BY id DESC LIMIT 10")){
		$TtaVids->execute();

		while($VidRow = $TtaVids->fetch())
		{
		$fpost = $VidRow['feat'];
		?>
		<tr>
    <td><a class="preview" href="previewvideos.php?id=<?php echo $VidRow['id'];?>"><?php echo stripslashes($VidRow['title']);?></a></td>
    <td><abbr class="timeago" title="<?php echo $VidRow['date'];?>"></abbr></td>
</tr>
<?php
		}

	
}else{
    
	 printf("Error: %s\n", $db->error);
}

?> 
 </tbody>
</table>
</div>
</div><!--box-->
<?php include('footer.php');?>

 
