<h1>Create News</h1>
<?php echo form_open('news/create');?>
    Title: 
    <br/>
    <?php echo form_input(
        array(
            'name' => 'title',
            'size' => '60')
        );
    ?><br/>
    <br/>
    URL:
    <br />
    <?php echo form_input(
        array(
            'name' => 'url',
            'size' => '120')
        );
    ?><br/>
    <br/>
    Content: 
    <br/>
    <?php echo form_textarea('content','');?><br />
    <br/>
Category:
&nbsp;&nbsp;
<?php echo form_dropdown('category_id',$categories);?>&nbsp;&nbsp;&nbsp;
Source:
&nbsp;&nbsp;
<?php echo form_dropdown('source_id',$sources);?>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo form_submit('Go','Go');?><br />
<?php echo form_close();?>
