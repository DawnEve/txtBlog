<html>
<head>
<link rel="stylesheet" type="text/css" href="public/css/base.css" media="all">
<link rel="stylesheet" type="text/css" href="public/css/main.css" media="all">
<title>技术博客</title>
</head>

<body>
<div class=header>
<h1>我的博客</h1>
<div class=nav>
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