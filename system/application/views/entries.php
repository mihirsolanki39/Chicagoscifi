<ul>
<?php
    foreach($entries as $entry):?>
            
        <li><?php echo $e->timestamp?></li>
        <li><?php echo $e->title?></li>
        <li><?php echo $e->content?></li>

    <?endforeach;
?>
</ul>
