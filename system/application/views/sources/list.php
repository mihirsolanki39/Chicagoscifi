<table id="myTable">
<thead>
<tr>
    <th width=200>Source Name</th>
    <th>Delete</th>
</tr>
</thead>
<tbody>

<?php
    foreach($sources as $src):
?>
    <tr>
        <td width=200><?php echo $src->name?></td>
        <td class="tac">
        <?php echo anchor(
            "sources/delete/".$src->id,
            '<img src="' . site_url('img/action_delete.png') . '" alt="Delete" />',
            array('id' => 'delete')
        );?>
        </td>
    </tr>
    <?endforeach;
?>
</tbody>
</table>
