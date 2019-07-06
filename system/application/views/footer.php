
    </div><!--center-->
    <div id="r" class="span-2 last">&nbsp;</div>
</div><!--container-->

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">window.jQuery || document.write('<script type="text/javascript" src="<?php echo site_url('js/jquery-1.8.2.min.js')?>"><\/script>')</script>
<script type="text/javascript" src="<?php echo site_url('js/jquery-ui-1.8.23.custom.min.js')?>"></script>
<?php /*
<script type="text/javascript" src="<?php echo site_url('js/jquery.FCKEditor.js')?>"></script>
*/ ?>
<script type='text/javascript' src='<?php echo site_url('js/jquery.tablesorter.min.js')?>'></script>
<script type='text/javascript'>
$(document).ready(function(){
    $("#myTable").tablesorter({});

    $("input.datepicker").datepicker({
        dateFormat : 'mm/dd/yy'
    });
});
</script>


<?php if (in_array($this->router->class, array('news', 'newsURL'))) : ?>
<?php
$flag="3";
if (isset($newFlag)) {
	$flag = $newFlag;
}

function geturl($flg) {
	if ($flg=="3") {
		return site_url('news');
    }
	else {
		return site_url('newsURL');
    }
}
?>
  <script type="text/javascript">
    $(document).ready(function(){
<?php /*
        $('textarea').fck({path: '<?php echo site_url('js/fckeditor')?>' + '/'});
*/ ?>

        $('#llist select').change(function(){
            $.ajax({
                url: "<?=geturl($flag)?>",
                data: {
                    category_id : $('select#category_id').val(),
                    source_id : $('select#source_id').val()
                },
                type: 'POST',
                success: function(html){
                    $("#newstable").html(html).hide().fadeIn();
                }
            });
        });
    });
</script>
<?php endif; ?>

</body>
</html>
