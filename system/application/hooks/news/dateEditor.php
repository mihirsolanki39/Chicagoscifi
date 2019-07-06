<h1>News Date Editor</h1>
<?foreach($news_item->result() as $n):?>
    <?php echo form_open('news/save');?>
        <? echo form_hidden('dateEdit', 'dateEdit'); ?>
        Title : <?=$n->title?>
        <br/>
        Date: 
        <?php echo form_input(
            array(
                'name' => 'date',
                'value' => date('m/d/Y',strtotime($n->timestamp)),
                'size' => '60')
            );
        ?><br/><br/>
        <?php echo form_hidden('id',$n->id)?>
        <?php echo form_submit('Save','Save');?><br />
    <?php echo form_close();?>
<?endforeach;?>
