<?php
/******************************************
* 我自己的框架: dawnPHP v0.1.0
* 
* 引用该库入口文件即可 include('dawnPHP/door.php');
******************************************/


//1.定义字符集
header("Content-type: text/html; charset=utf-8");

//2.检测入口合法性
defined('DAWN_PATH') or define('DAWN_PATH', dirname(__file__) .'/' );

//3.设置时区
date_default_timezone_set('PRC');
//date_default_timezone_set('Asia/Shanghai');
//4.定义配置文件
include(DAWN_PATH . 'config.php');


//5.数据库连接
//include(DAWN_PATH . 'conn.php');
//6.引入自定义函数库
include(DAWN_PATH . 'function.php');
//7.自动加载类
/***begin****/
//定义自动加载
function myAutoload($class){
	//加载类库
	$classPath=DAWN_PATH . 'class/';
	$path=$classPath. $class . '.class.php';
	if(file_exists($path)){
		require($path);
		return;
	}
	
	//加载控制器
	$classPath=DAWN_PATH . '../Controller/';
	$path=$classPath. $class . '.class.php';
	if(file_exists($path)){
		require($path);
		return;
	}
};


//注册自动加载函数
spl_autoload_register('myAutoload');
//============================

/***end****/