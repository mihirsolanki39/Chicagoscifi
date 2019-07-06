<h2>Search News by Date</h2>

<div class="form">
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
                'size' => '10',
                'class' => 'datepicker')
            );
        ?>&nbsp;&nbsp;
        To (mm/dd/yyyy): <?php echo form_input(
            array(
                'name' => 'dateTo',
                'value'=> $tdate,
                'size' => '10',
                'class' => 'datepicker')
            );
        ?>&nbsp;&nbsp;&nbsp;
    <?php echo form_submit('Search','Search');?><br />
<?php echo form_close();?>
</div>
  
<?
if (isset($news))
{
?>

<table width="100%">
  <? $lastCat="";  ?>

  <?foreach($news->result() as $n):?>

  <?
if (($lastCat != $n->cat_name) )
{
  echo "<tr><td height=1 valign=middle class='separator'></td></tr>";
  echo "<tr>";
  echo "<td>";
  echo '<b>'.$n->cat_name ."</b>";
  echo "</td>";
  echo "</tr>";
  $lastCat = $n->cat_name;
  }

  ?>
  <tr>
    <td>
      <img src="<?php echo site_url('img/text.jpg'); ?>" alt="" />
      <a href="<?=$n->url;?>"><?=$n->title;?></a>
    </td>

  </tr>

  <?endforeach;?>

</table>    

<?
}
?>
