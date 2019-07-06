
<?foreach($news_item->result() as $n):?>
<html>
<head>
<title><?=$n->title;?></title>
</head>
<div align=center><img src="/new_site/img/header_news.jpg"/></div>
<br/>
	<br/>

    <b>Title:</b> <?
    echo $n->title;
	?>
	<br/>
	<br/>
    <b>Date: </b><?
    echo date('m/d/Y',strtotime($n->timestamp));
	?>
	<br/>
	<br/>
    <?
    echo $n->content;
	?>
<?endforeach;?>
<html>