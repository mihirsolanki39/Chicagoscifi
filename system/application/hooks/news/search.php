<h1>Search News by Date</h1>
<br/>
<br/>

<?
$fdate="";
if (isset($_POST['dateFrom']))
{
$fdate = $_POST['dateFrom'];
}
$tdate="";
if (isset($_POST['dateTo']))
{
$tdate = $_POST['dateTo'];
}
?>
<?php echo form_open('news/search');?>
        From (mm/dd/yyyy): <?php echo form_input(
            array(
                'name' => 'dateFrom',
                'value'=> $fdate,
                'size' => '10')
            );
        ?><br/>
        To (mm/dd/yyyy): <?php echo form_input(
            array(
                'name' => 'dateTo',
                'value'=> $tdate,
                'size' => '10')
            );
        ?><br/>
<br/>
<br/>
    <?php echo form_submit('Search','Search');?><br />
<?php echo form_close();?>

  
<?
if (isset($news))
{
?>

<table id="myTable">
  <? $lastCat="";  ?>

  <?foreach($news->result() as $n):?>

  <?
if (($lastCat != $n->cat_name) )
{
  echo "<tr height=40 valign=bottom>    <td valign=bottom colspan=2 height='40' valign=middle>";
  echo "<b>".$n->cat_name . " (".strtoupper($n->category_type).")"."</b><br/>";
  echo "</td> </tr>";
  $lastCat = $n->cat_name;
  }

  ?>
  <tr>
    <td>
      &nbsp;&nbsp;&nbsp;<?=date('m/d/Y',strtotime($n->timestamp))?>&nbsp;&nbsp;&nbsp;
    </td>
    <td>
      <?=$n->title;?>
    </td>

  </tr>

  <?endforeach;?>

</table>    

<?
}
?>
