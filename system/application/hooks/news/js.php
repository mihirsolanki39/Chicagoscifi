<script type="text/javascript">
    $(document).ready(function(){
        $('textarea').fck({path: '<?=site_url('js/fckeditor')?>' + '/'});

        $('#llist select').change(function(){
            $.ajax({
                url: "<?=site_url('news/index')?>",
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
