
<?foreach($news_item->result() as $n):?>
    <?php echo form_open('news/save');?>
        Title: 
        <br/>
        <?php echo form_input(
            array(
                'name' => 'title',
                'value' => $n->title,
                'size' => '60')
            );
        ?><br/>
        <br/>
        URL:
        <br />
        
        <?php echo form_input(
            array(
                'name' => 'url',
                'value' => $n->url,
                'size' => '120')
            );
        ?><br/>
        <br/>
        Category: 
        &nbsp;
        <?php echo form_dropdown('category_id',$categories,$n->category_id);?>
        &nbsp;
        Source: 
        &nbsp;
        <?php echo form_dropdown('source_id',$sources,$n->source_id);?> &nbsp;
        <?php echo form_hidden('id',$n->id)?>
        <?php echo form_submit('Save','Save');?><br />
    <?php echo form_close();?>
<?endforeach;?>
