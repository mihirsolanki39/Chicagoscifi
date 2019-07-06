<h1>News (URL)</h1>
<div id="llist">
    <?=form_label('Category')?>
    <?=form_dropdown('category_id',$categories,'','id="category_id"');?>
    <?=form_label('Source')?>
    <?=form_dropdown('source_id',$sources,'','id="source_id"');?>
    <?=anchor('news/createformURL','Create News')?>
    <div id="newstable">
