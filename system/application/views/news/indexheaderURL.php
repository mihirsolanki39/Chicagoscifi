<h2>News</h2>
<div id="llist">
    <div class="form">
    <?=form_label('Category')?>
    <?=form_dropdown('category_id',$categories,'','id="category_id"');?>
    <?php /*
    <?=form_label('Source')?>
    <?=form_dropdown('source_id',$sources,'','id="source_id"');?>
    */ ?>
    <button onclick="window.location.href='<?php echo site_url('news/createformURL'); ?>';">Create News</button>
    </div>
    <div id="newstable">
