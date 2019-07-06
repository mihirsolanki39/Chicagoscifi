<?if (!isset($hideCreate)) {
?>
<h2>News Content</h2>
<?}
else
{
?>

<?
}
?>
<div id="llist">
  <? if (isset($categories)){?>
    <div class="form">
    <?=form_label('Category')?>
    <?=form_dropdown('category_id',$categories,'','id="category_id"');?>
    <?php /*
    <?=form_label('Source')?>
    <?=form_dropdown('source_id',$sources,'','id="source_id"');?>
    */ ?>
  <?if (!isset($hideCreate)) :?>
      <button onclick="window.location.href='<?php echo site_url('news/createform'); ?>';">Create News</button>
  <?php endif; ?>
  <?}?>
    </div>
  <div id="newstable">
