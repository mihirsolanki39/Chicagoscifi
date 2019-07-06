<table id="myTable">
<thead>
<tr>
    <th width=200>Category Name</th>
    <th>ID</th>
    <th>Type</th>
    <th>Visibility</th>
    <th>Delete</th>
    <th>Modify</th>
</tr>
</thead>
<tbody>
  <?foreach($categories->result() as $n):?>
    <tr>
        <td width=320><?php echo $n->name?></td>
        <td width=50><?=$n->id?></td>
        <td width=100 class="tac"><?=strtoupper($n->category_type)?></td>
        <td width=100 class="tac"><?php echo ($n->stat == 'H') ? 'Hide' : 'Show'; ?></td>
        <td width=100 class="tac">
        <?php echo anchor(
            "categories/delete_category/".$n->id,
            '<img src="' . site_url('img/action_delete.png') . '" alt="Delete" />',
            array('id' => 'delete')
        );?>
        </td>
        <td width=290 class="tac">
        	<?php echo form_open('categories/modify_category');?>
			<?
			$data = array(
			'name'        => 'name',
			'id'          => 'name',
			'value'       => htmlspecialchars($n->name),
			'maxlength'   => '20',
			'size'        => '20'
			);
			?>
			<?php
			$selected = FALSE;
			if($n->stat == 'H')
			{
				$selected = TRUE;
			}
			echo form_input($data);			
			echo form_hidden('id',$n->id);
			echo form_checkbox('visibility','visibility',$selected);
			echo form_submit('Modify','Modify');
			echo form_close();
			?>
        
        <?php
//        if($n->stat == 'H')
//        {
//	        echo anchor(
//	            "categories/show_category/".$n->id,
//	            'Show It',
//	            array('id' => 'show')
//	        );
//        }
//        else
//        {
//	        echo anchor(
//	            "categories/hide_category/".$n->id,
//	            'Hide It',
//	            array('id' => 'hide')
//	        );        	
//        }
        ?>
        </td>
    </tr>
    <?endforeach;
?>
</tbody>
</table>
