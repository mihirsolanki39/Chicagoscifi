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
<?php echo form_open('news/filterNews');?>
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
		<? if (isset($_POST['category_id'])) { ?>
			<?=form_dropdown('category_id',$categories, $_POST['category_id'],'id="category_id"');?>
		<? } else  { ?>
			<?=form_dropdown('category_id',$categories,'','id="category_id"');?>
		<? }  ?>
    <?php echo form_submit('Search','Search');?><br />
<?php echo form_close();?>
</div>
  
<?
if (isset($news))
{
?>
<?php echo form_open('news/filterNews');?>
<table width="100%">
  <? $lastCat="";  ?>

  <?foreach($news->result() as $n):?>

  <?
if (($lastCat != $n->cat_name) )
{
  echo "<tr><td height=1 valign=middle class='separator'></td></tr>";
  echo "<tr>";
  echo "<td>";
  echo '<input type="checkbox" class="main-category" data-category="'. str_replace(' ', '',$n->cat_name) .'">';
  echo '<b>'.$n->cat_name ."</b>";
  echo "</td>";
  echo "</tr>";
  $lastCat = $n->cat_name;
  }

  ?>
  <tr>
    <td>
		<input type="checkbox" class="<?= str_replace(' ', '', $n->cat_name);?>" name="ids[]" value="<?=$n->id;?>">
      <img src="<?php echo site_url('img/text.jpg'); ?>" alt="" />
      <a href="<?=$n->url;?>"><?=$n->title;?></a>
    </td>

  </tr>

  <?endforeach;?>

</table>    
<br /><?php 
if(empty($news->result())) {
	echo("<h3>No news found in your date range</h3>");
} else {
	echo form_submit('delete-news','Delete');
}

?>
<?php echo form_close();?>
<?
}
?>

<script>
document.addEventListener('DOMContentLoaded', function(){ 
    $('.main-category').change(function() {
		var classSelector = $(this).data( "category" );
        if(this.checked) {
			$("." + classSelector).prop('checked', true);
        } else {
			$("." + classSelector).prop('checked', false);
		}
    });
}, false);
</script>
