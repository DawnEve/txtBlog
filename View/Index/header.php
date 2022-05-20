<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width" />
    <meta name="keywords" content="测序,高通量测序,单细胞测序分析,
	R,python,git,linux,mysql,docker,
	css,javascript,node,jquery,java,sql,php,ios,android,教程,软件,编程,开发,运维,云计算,网络,互联网" />
    <meta name="description" content="研究生物信息学与计算机/互联网交叉学科的前沿趋势和技术，提供原创中文精品教程" />
	<link rel="shortcut icon" href="/favicon.ico">
	
	<link rel="stylesheet" type="text/css" href="public/css/base.css" media="all">
	<link rel="stylesheet" type="text/css" href="public/css/main.css" media="all">
	<title>生信技术博客(BioInfo Blog) - Powered by txtBLog</title>
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