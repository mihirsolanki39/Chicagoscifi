<table id="myTable">
  <thead>
    <tr>
      <th>Category</th>
      <th>Date</th>
      <th>Title</th>
      <th>Edit</th>
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
      <?=$n->cat_name . " (".strtoupper($n->category_type).")"?>
    </td>
    <td>
      &nbsp;&nbsp;&nbsp;<?=date('m/d/Y',strtotime($n->timestamp))?>&nbsp;&nbsp;&nbsp;
    </td>
    <td>
      <?=$n->title;?>
    </td>
    <td>
      <?=anchor(
                'news/dateEditor/'.$n->id,
                'Edit'
            );?>
    </td>
  </tr>
  <?endforeach;?>
</table>
