<table id="myTable">
  <thead>
    <tr>
      <th>Last Modified</th>
      <th>Title</th>
      <!--<th>URL</th>-->
      <th>Category</th>
      <th>Source</th>
      <th>Edit</th>
      <th>&nbsp;&nbsp;&nbsp;Delete</th>
    </tr>
  </thead>
  <? $lastCat="";  ?>
  <?foreach($news->result() as $n):?>
  <?
if (($lastCat != $n->cat_name) )
{
  echo "<tr height=1>    <td colspan=6 height='1' valign=middle><hr size=4 color=black/></td> </tr>";
  $lastCat = $n->cat_name;
  }

  ?>
  <tr>
    <td>
      <?=date('m/d/Y',strtotime($n->timestamp))?>
    </td>
    <td>
      <?if ($n->content <> "") { ?>
      <a href="javascript:window.open('news/showPopup/<?=$n->id;?>','mywindow','menubar=0,resizable=1,scrollbars=1,status=0,titlebar=0,width=450,height=550')"><?=$n->title;?></a>
    <?

      } else 
        echo anchor(
                $n->url,
                "$n->title",
                array('target'=>'_blank')
            );
      ?>

    </td>
    <!--<td>
        </td>-->
    <td>
      <?=$n->cat_name . " (".strtoupper($n->category_type).")"?>
      
    </td>
    <td>
      <?=$n->src_name?>
    </td>
    <td>
      <?=anchor(
                'news/show/'.$n->id,
                'Edit'
            );?>
    </td>
    <td align='center'>
      &nbsp;&nbsp;&nbsp;<?=anchor(
                'news/delete/'.$n->id,
                'Delete'
            )?>
    </td>
  </tr>
  <?endforeach;?>
</table>
