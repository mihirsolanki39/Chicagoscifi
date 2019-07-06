<?php echo form_open('news/save');?>
    Title: 
    <br/>
    <?php echo form_input(
        array(
            'name' => 'title',
            'value' => $news->title,
            'size' => '120')
        );
    ?><br/>
    <br/>
    URL:
    <br />
    
    <?php echo form_input(
        array(
            'name' => 'url',
            'value' => $news->url,
            'size' => '120')
        );
    ?><br/>
    <br/>
    Categories: 
    &nbsp;
    <?php echo form_multiselect('category_id[]', $categories, $selected_categories, 'size="10"');?>
    &nbsp;
    <?php /*
    Source: 
    &nbsp;
    <?php echo form_dropdown('source_id',$sources,$n->source_id);?> &nbsp;
    Date (mm/dd/yyyy): <?php echo form_input(
        array(
            'name' => 'ndate',
            'value'=> date('m/d/Y',strtotime($n->timestamp)),
            'size' => '10',
            'class' => 'datepicker')
        );
    ?>&nbsp;
    */ ?>
    <?php echo form_hidden('id',$news->id)?>
    <?php echo form_submit('Save','Save');?><br />
<?php echo form_close();?>
