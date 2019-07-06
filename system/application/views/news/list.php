
<table id="myTable">
  <? $lastCat="";  ?>
  <?foreach($news->result() as $n):?>
  
  <tr>
    <td>
      <?=date('m/d/Y',strtotime($n->timestamp))?>
    </td>
    <td>
      <?if ($n->content <> "") { ?>
      <a href="javascript:window.open('news/showPopup/<?=$n->id;?>','mywindow','menubar=0,resizable=1,scrollbars=1,status=0,titlebar=0,width=450,height=550')"><?=$n->title;?>
      </a>
      <?

      } else 
        echo anchor(
                $n->url,
                "$n->title",
                array('target'=>'_blank')
            );
      ?>
    </td>
  </tr>
  <?endforeach;?>
</table>
