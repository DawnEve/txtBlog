<?php
//functions
/**
	排错函数，会终止函数
*/
function debug($s,$d=false){
	echo '<pre>';
	if($d){
		var_dump($s);
	}else{
		print_r($s);
	}
	echo '</pre>';
	die();
}

/**
	同名函数
*/
function dump($s,$d=false){
	echo '<pre>';
	if($d){
		var_dump($s);
	}else{
		print_r($s);
	}
	echo '</pre>';
}


/**
	记录日志信息
*/
function myLog($keyWord='',$fileName='my_log.txt'){
	$agent=$_SERVER["HTTP_USER_AGENT"];
	//引入用户信息类
	//include('common/myAgentInfo.class.php');
	$u=new myAgentInfo();
	$browser=$u->getBrowser_2();
	$os=$u->getOS_3();
	$ip=$u->getIP();
	//记录时间
	date_default_timezone_set('PRC');
	$time=date('Y-m-d H:i:s',time());
	//写入日志
	$fh=fopen($fileName,'a');
	//时间、IP地址、消息头、系统、浏览器、关键词
	fwrite($fh,"\r\n===============================\r\n");
	fwrite($fh,"{$time}------IP: {$ip}\r\n");
	fwrite($fh,"-------------------------------\r\n");
	fwrite($fh,$agent."\r\n");
	fwrite($fh,"-------------------------------\r\n");
	fwrite($fh,"{$os}\r\n");
	fwrite($fh,"{$browser}\r\n");
	fwrite($fh,"-------------------------------\r\n");
	fwrite($fh,"keyWord: {$keyWord}\r\n");
	fwrite($fh,"===============================\r\n");
	//关闭文件
	fclose($fh);
}