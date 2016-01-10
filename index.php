<?php
//引用库
define("DAWN_PATH","F:/xampp/htdocs/txtBlog/DawnPHP/");
include('DawnPHP/door.php');

//获取数据
$c=Dawn::get('c','Index') . 'Controller';//控制器
$a=Dawn::get('a','index');//动作
$k=Dawn::get('k','PHP');//关键词
$id=Dawn::get('id','0_0');//关键词下的页面，由页面序号索引到文件名


//获取完整的url(http://www.cnblogs.com/A-Song/archive/2011/12/14/2288215.html)
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//记录日志
myLog($url);

//实例化控制器
$controller=new $c();
//调用操作
$controller->$a($k,$id);