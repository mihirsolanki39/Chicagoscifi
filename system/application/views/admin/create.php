<?php echo form_open('admin/add');?>
    Title: 
    <br/>
    <?php echo form_input('title','');?><br/>
    <br/>
    URL:
    <br />
    <?php echo form_input('url','');?><br/>
    <br/>
    Content: 
    <br/>
    <?php echo form_textarea('content','');?><br />
    <br/>
    Category: 
    <br/>
    <?php echo form_dropdown('category',$categories);?><br />
    <br />
    <?php echo form_submit('Go','Go');?><br />
<?php echo form_close();?>
