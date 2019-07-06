<h2>Delete News by Date</h2>

<div class="form">
<?php echo form_open('news/deleteNews');?>
        Newer than (mm/dd/yyyy): <?php echo form_input(
            array(
                'name' => 'dateFrom',
                'value'=> '',
                'size' => '10',
                'class' => 'datepicker')
            );
        ?>&nbsp;&nbsp;
        and older than (mm/dd/yyyy): <?php echo form_input(
            array(
                'name' => 'dateTo',
                'value'=> '',
                'size' => '10',
                'class' => 'datepicker')
            );
        ?>&nbsp;&nbsp;&nbsp;<br><br>
        <?=form_label('From category')?>
        <?=form_dropdown('category_id',$categories,'','id="category_id"');?>
    <?php echo form_submit('Delete','Delete');?><br />
<?php echo form_close();?>
</div>
 
