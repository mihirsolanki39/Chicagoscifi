<?php

$con = mysql_connect("localhost", "chica53_chicagos", "M]U_Alzqf80+");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
}
  
mysql_select_db("chica53_chicagoscifi") or die(mysql_error());

if (!isset($_REQUEST['category']))
{
	die("No cat was found!");
}

$catid = $_REQUEST['category'];

$catstm = 'SELECT name FROM categories WHERE id = "'.$catid.'"';

$catresult = mysql_query($catstm);
if(!$catresult)
{
	die(mysql_error());  
}

  $num_rows = mysql_num_rows($catresult);
  if($num_rows <= 0)
  {
   	 die("Wrong cat was found!");
  }

  $catrow = mysql_fetch_assoc(($catresult));
  {
   	 $catname = $catrow["name"];
  	 
  	 $newsstm = 'SELECT * FROM news where category_id = "'.$catid.'" ORDER BY timestamp desc LIMIT 0, 5';
	 $newsresult = mysql_query($newsstm);	
	 if(!$newsstm)
	 {
		die(mysql_error());  
	 }
	 
	 $num_rows = mysql_num_rows($newsresult);
   	 if($num_rows <= 0)
     {
   	    continue;
   	 }
	 
	 echo "<div><br></div>";
  	 echo '<div><font face="tahoma,arial" size="2"></font>';
  	 echo "<td valign=bottom colspan=2>";
  	 echo "<b>".$catname ."</b>&nbsp;";
  	 echo "</div>";
	 
	 while($newsrow = mysql_fetch_assoc(($newsresult)))
  	 {
  	 	$date = date('m/d/y',strtotime($newsrow["timestamp"]));
  	    $title = $newsrow["title"];
  	    $url = $newsrow["url"];
  	    echo "<div>" ;
  	    echo $date.'&nbsp;&nbsp;&nbsp;&nbsp;';
      	echo '<a href="'.$url.'" target="_blank">'.$title.'</a>';
		echo '&nbsp;</div>';
  	 }
  	}

mysql_close($con);
?>
