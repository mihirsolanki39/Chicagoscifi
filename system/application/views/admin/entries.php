<table>
<?php
    foreach($entries->result() as $e):?>
        <tr>
            <td>Posted <?php echo date('m/d/Y H:i:s',strtotime($e->timestamp))?></td>
            <td>in <?php echo $e->name?></td>
            <td>
                <strong>
                <?php echo anchor(
                        prep_url(
                            $e->url
                        ),
                        $e->title
                    );?>
                </strong>
                <em><?php echo anchor(
                        "admin/delete_entry/{$e->id}",
                        'Delete'
                    );?>
                </em>
            </td>
        </tr>
        <tr><td><?php echo $e->content?></td></tr>
        <tr><td><hr/></td></tr>

    <?endforeach;
?>
</table>
