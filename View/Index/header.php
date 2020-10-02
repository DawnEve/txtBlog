<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width" />
    <meta name="keywords" content="css,javascript,node,jquery,git,python,java,sql,php,mysql,linux,ios,android,教程,软件,编程,开发,运维,云计算,网络,互联网" />
    <meta name="description" content="研究互联网产品和技术，提供原创中文精品教程" />
	<link rel="shortcut icon" href="/favicon.ico">
	
	<link rel="stylesheet" type="text/css" href="public/css/base.css" media="all">
	<link rel="stylesheet" type="text/css" href="public/css/main.css" media="all">
	<title>Dawn's Blog: web技术博客 - Powered by txtBLog</title>
	<script type="text/javascript" src="/public/js/common.js"></script>

</head>

<body>
<div class=header>


<div class=nav>
<b><a class='redBg' href='/index.php' title="知识管理系统">txtBlog</a></b>
<?php
$keyword=$arrTop['keyword'];
$top=$arrTop['data'];
	foreach($top as $key=>$value){
		//echo "$key - $value<hr>";
		if($key==$keyword){
			echo '<a class="topmenu current" href="index.php?k='.$key.'" title="'.$value.'">'.$key.'</a> ';
		}else{
			echo '<a class="topmenu" href="index.php?k='.$key.'" title="'.$value.'">'.$key.'</a> ';
		}
	}
?>
</div>
</div>

<div class=clear></div>