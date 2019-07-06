<?if (!isset($hideCreate)) {
?>
<h1>News (Content)</h1>
<?}
else
{
?>

<?
}
?>
<div id="llist">
  <? if (isset($categories)){?>
    
  <?=form_label('Category')?>
    
    <?=form_dropdown('category_id',$categories,'','id="category_id"');?>
    <?=form_label('Source')?>
    <?=form_dropdown('source_id',$sources,'','id="source_id"');?>
  <?if (!isset($hideCreate))
      echo anchor('news/createform','Create News')?>
  <?}?>
  <div id="newstable">
