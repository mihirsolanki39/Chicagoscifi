<table border="4">
  <thead>
    <tr>
      <th>Date</th>
      <th>Title</th>
      <th>Category</th>
      <?php /*
      <th>Source</th>
      */ ?>
      <th>Actions</th>
    </tr>
  </thead>
  <? $lastCat=""; $f="0"; ?>
  <?foreach($news->result() as $n):?>
  <?
  if ($n->url == "") {

  if (($lastCat != $n->cat_name))
  { 
    if($f!="0")
        echo "<tr><td colspan=5 height=1 valign=middle class='separator'></td></tr>";
    else
      $f="1";
    $lastCat = $n->cat_name;
  }

  ?>
  <tr>
    <td width="100" class="tac">
      <?=date('m/d/Y',strtotime($n->timestamp))?>
    </td>
    <td width="460">
      <?if ($n->content <> "") { ?>
      <a href='#' onclick="javascript:window.open('/new_site/news/showPopup/<?=$n->id;?>','mywindow','menubar=0,resizable=1,scrollbars=1,status=0,titlebar=0,width=650,height=650, modal=true,directories=no');return false;"><?php echo substr($n->title, 0, 50) . (strlen($n->title) > 50 ? '...' : '');?></a>
    <?

      } else 
        echo anchor(
                $n->url,
                "$n->title",
                array('target'=>'_blank')
            );
      ?>

    </td>
    <td width="340">
      <?=$n->cat_name ?>
    </td>
    <?php /*
    <td width="180"  class="tac">
      <?=$n->src_name?>
    </td>
    */ ?>
    <td width="60" class="tac">
      <?=anchor(
                'news/show/'.$n->id,
                '<img src="' . site_url('img/action_edit.png') . '" alt="Edit" />'
            );?>
      <?=anchor(
                'news/delete/'.$n->id,
                '<img src="' . site_url('img/action_delete.png') . '" alt="Delete" />'
            )?>
    </td>
  </tr>
  <?
  }
  endforeach;?>
</table>
