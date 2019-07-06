<ul>
<?php
    foreach($categories as $k => $v):?>
        <li><strong><?php echo $v?></strong>
                <em><?php echo anchor(
                        "admin/delete_category/".$k,
                        'Delete'
                    );?>
                </em>
            </li>
    <?endforeach;
?>
</ul>
