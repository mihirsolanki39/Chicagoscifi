<?php

$con = mysql_connect("localhost", "chica53_chicagos", "M]U_Alzqf80+");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
}
  
mysql_select_db("chica53_chicagoscifi") or die(mysql_error());

if (!isset($_REQUEST['date']))
{
	die("No date was found!");
}

$fromdate = strtotime($_REQUEST['date']);
$enddate = strtotime(date("Y-m-d", strtotime(date ("Y-m-d", $fromdate))) . " +1 day");//$fromdate + 1;
$sqlfromdate  = date ("Y-m-d", $fromdate);
$sqlenddate  = date ("Y-m-d", $enddate);
// Retrieve all the data from the "example" table
$where =  ' where timestamp >= "'.$sqlfromdate.'" and timestamp < "'.$sqlenddate.'" ';  

//echo $where;

//$result = mysql_query("SELECT timestamp, url, id, title FROM news ".$where." order by timestamp desc");
$result = mysql_query("SELECT *,news.id AS id,categories.name AS cat_name,sources.name AS src_name FROM news,categories,sources ".$where." and news.category_id = categories.id and news.source_id = sources.id order by cat_name asc,timestamp desc");
if(!$result)
{
	die(mysql_error());  
}
?>

<div style="word-wrap: break-word; -webkit-nbsp-mode: space; -webkit-line-break: after-white-space; ">

<?   
  $lastCat="";  
  while($row = mysql_fetch_assoc(($result)))
  {
  	if (($lastCat != $row["cat_name"]) )
	{
		if(strlen($lastCat) > 0)
		{		
			echo "<div><br></div>";
		}
  		echo '<div><font face="tahoma,arial" size="2"></font>';
   		echo "<b>".$row["cat_name"] ."</b>&nbsp;";
  		echo "</div>";
  		$lastCat = $row["cat_name"];
  	}
  ?>
  	<div> 
      <a href="<?=$row["url"];?>" target="_blank"><?=$row["title"];?></a>
	&nbsp;</div>
<?
  }
?>
</div>
<?
mysql_close($con);
?>