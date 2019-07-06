<table id="myTable">
  <thead>
    <tr>
      <th>Date</th>
      <th>Title</th>
      <th>Category</th>
      <th>Type</th>
      <?php /*
      <th>Source</th>
      */ ?>
      <th>Actions</th>
    </tr>
  </thead>
  <? $lastCat=""; $f="0"; ?>
  <?foreach($news->result() as $n):?>
  <?
  if($n->cat_stat == 'H')
  {
  	continue;
  }
  if ($n->url <> "") {
    if (($lastCat != $n->cat_name))
    {
      if($f!="0")
        echo "<tr><td colspan=6 height=1 valign=middle class='separator'></td></tr>";
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
      <img src="<?php echo site_url('img/text.jpg'); ?>" alt="" />
      <?=anchor(
                $n->url,
                mb_substr($n->title, 0, 50) . (mb_strlen($n->title) > 50 ? '...' : ''),
                array('target'=>'_blank')
            );?>
    </td>
    <td width="280">
      <?=$n->cat_name ?>
    </td>
    <td width="60" class="tac">
      <?=strtoupper($n->category_type)?>
    </td>
    <?php /*
    <td width="180"  class="tac">
      <?=$n->src_name?>
    </td>
    */ ?>
    <td width="60" class="tac">
      <?=anchor(
                'news/showURL/'.$n->id,
                '<img src="' . site_url('img/action_edit.png') . '" alt="Edit" />'
            );?>
      <?=anchor(
                'news/deleteURL/'.$n->id,
                '<img src="' . site_url('img/action_delete.png') . '" alt="Delete" />'
            )?>
    </td>
  </tr>
  <?
    }
  endforeach;
  ?>
</table>
