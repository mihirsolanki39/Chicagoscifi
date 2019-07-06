<img src="/new_site/img/header_news.jpg">
<br/>
	<br/>

<?foreach($news_item->result() as $n):?>
    <b>Title:</b> <?
    echo $n->title;
	?>
	<br/>
	<br/>
    <b>Date: </b><?
    echo $n->timestamp;
	?>
	<br/>
	<br/>
    <?
    echo $n->content;
	?>
<?endforeach;?>
