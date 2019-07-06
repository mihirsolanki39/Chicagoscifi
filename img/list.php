<?php

$con = mysql_connect("localhost", "chica53_chicagos", "M]U_Alzqf80+");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
}
  
mysql_select_db("chica53_chicagoscifi") or die(mysql_error());
$where="";
// Retrieve all the data from the "example" table
if (isset($_REQUEST['cat']))
{
  $where =  ' where category_id = '.$_REQUEST['cat']." ";  
}
$result = mysql_query("SELECT timestamp, url, id, title FROM news ".$where." order by timestamp desc")
or die(mysql_error());  


?>

<table id="myTable">
<?
while($row = mysql_fetch_array($result))
  {
?>


<tr>
  <td>
    <?=date('m/d/Y',strtotime($row['timestamp']))?>
  </td>
  <td>
    <?if ($row['url'] == "") {?>
      <a href='#' onclick="javascript:window.open('/new_site/news/showPopup/<?=$row['id'];?>','mywindow','menubar=0,resizable=1,scrollbars=1,status=0,titlebar=0,width=650,height=650');return false;"><?=$row[title];?>
      </a>

      <? } else { ?>

  <a target='_blank' href="<?=$row['url']?>"><?=$row['title']?>
      </a>

      <?}?>
  </td>
</tr>
<?
}
?>
</table>

<?
mysql_close($con);

?>