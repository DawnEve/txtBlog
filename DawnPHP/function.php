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
	v0.2 记录来源url 
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
	
	//访问来源url
	$Referer='';
	if(isset($_SERVER['HTTP_REFERER'])){
		$Referer=$_SERVER['HTTP_REFERER'];
	}
	
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
	fwrite($fh,"-------------------------------\r\n");
	fwrite($fh,"from: {$Referer}\r\n");
	fwrite($fh,"===============================\r\n");
	//关闭文件
	fclose($fh);
}


/**
* 根据友情链接数组，输出拼接好的字符串。【对外】
* 1.输入一级数组： array('http://jsbin.com/','jsbin'[,'练习前端的好工具！']),
* 2.或二级数组：
*	array( //数组示例
*		array('http://jsbin.com/','jsbin'[,'练习前端的好工具！']),
*		array('http://baidu.com/','baidu'[,'搜索工具！']),
*	);
* 3.输出非数组
* 直接打印出链接字符串。
*/
function print_links($links,$name='',$title=''){
	//如果参数是三个字符串
	if(is_string ($links)){
		echo get_link( array($links,$name,$title) );
		return true;
	}
	
	//如果是二级数组
	$str='';
	if(is_array($links[0])){
		for($i=0; $i<count($links); $i++){
			//获取单个数组
			$arr=$links[$i];
			$str .= get_link($arr);
			
			//如果不是结尾，增加|
			if($i!= (count($links)-1) ) $str .=  ' | ';
			//如果是结尾，换行
			if( ($i!=0) && ($i%15==0) ) $str .=  '<br />';
		}
	}else{
		//如果是一级数组
		$str .= get_link($links);
	}
	echo $str;
}


/** 【私有函数】根据友情链接数组，输出拼接好的字符串
* array('http://jsbin.com/','jsbin'[,'练习前端的好工具！']),// 例子数据
*/
function get_link($arr){
	$str='';
	//拼接注释
	$title='';
	if(isset($arr[2])){
		$title=' title="'.$arr[2].'"';
	}
	//拼接链接
	$str .= "<a href='". $arr[0] ."' target='_blank'".$title.">". $arr[1] ."</a>";
	
	//返回结果
	return $str;
}

