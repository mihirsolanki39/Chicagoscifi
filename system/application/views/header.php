<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
 <head>
     <title>chicagoscifi.com</title>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <link rel="stylesheet" href="<?php echo site_url('css/reset.css'); ?>" type="text/css" media="screen">
     <link rel="stylesheet" href="<?php echo site_url('css/style.css'); ?>" type="text/css" media="screen, print">
     <link rel="stylesheet" href="<?php echo site_url('css/jquery-ui-1.8.23.custom.css'); ?>" type="text/css" media="screen, print">
</head>
<body>
    <?php /*
    <div align="center">
        <img src="<?=site_url('img/header_news.jpg')?>"/>
    </div>  
    */ ?>

    <h1>Chicago Sci-Fi</h1>

    <div id="nav">
        <?php echo anchor('newsURL',     'News',         ($this->router->class == 'newsURL'    ? array('class' => 'active') : array())); ?>
        <?php /*
        <?php echo anchor('news',        'News Content', ($this->router->class == 'news' && $this->router->method != 'search' ? array('class' => 'active') : array())); ?>
        */ ?>
        <?php echo anchor('news/search', 'News Search',  ($this->router->class == 'news' && $this->router->method == 'search' ? array('class' => 'active') : array())); ?>
        <?php echo anchor('news/filterNews', 'Filter News',  ($this->router->class == 'news' && $this->router->method == 'filterNews' ? array('class' => 'active') : array())); ?>
        <?php echo anchor('news/deleteNews', 'Delete News By Date', ($this->router->class == 'news' && $this->router->method == 'deleteNews' ? array('class' => 'active') : array())); ?>
        <?php echo anchor('categories',  'Categories',   ($this->router->class == 'categories' ? array('class' => 'active') : array())); ?>
		<?php echo anchor('news/category_switcher', 'Category Switcher',  ($this->router->class == 'news' && $this->router->method == 'category_switcher' ? array('class' => 'active') : array())); ?>
        <?php /*
        <?php echo anchor('sources',     'Sources',      ($this->router->class == 'sources'    ? array('class' => 'active') : array())); ?>
        */ ?>
    </div>

    <div id="container">
        <div id="c" class="span-20">
