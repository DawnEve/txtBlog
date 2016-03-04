<?php 
/**=============================================
 * Log 日志类
 *
 * 系统日志功能：访问日志、错误日志
 * 类名时驼峰法，方法名是下划线法。
 *
 * @version		v0.0.1
 * @revise		2016.03.04
 * @date		2016.03.04
 * @author		Dawn
 * @email		JimmyMall@live.com
 * @link		https://github.com/DawnEve/DawnPHPTools
 =============================================*/
 //http://blog.csdn.net/wide288/article/details/19110205
class Log{
	
	/**
	*	记录日志信息 
	*	v0.2 记录来源url 
	*/
	static function myLog($keyWord='visit',$fileName='my_log.txt'){
		$agent=$_SERVER["HTTP_USER_AGENT"];
		//引入用户信息类
		$u=new myAgentInfo();
		$browser=$u->getBrowser_2();
		$os=$u->getOS_3();
		$ip=$u->getIP();
		//记录时间
		date_default_timezone_set('PRC');
		$time=date('Y-m-d H:i:s',time());
		
		//获取当前完整的url(http://www.cnblogs.com/A-Song/archive/2011/12/14/2288215.html)
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		
		//访问来源url
		$Referer='';
		if(isset($_SERVER['HTTP_REFERER'])){
			$Referer=$_SERVER['HTTP_REFERER'];
		}
		
		//打开日志
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
		fwrite($fh,"-------------------------------\r\n");
		fwrite($fh,"url: {$url}\r\n");
		fwrite($fh,"-------------------------------\r\n");
		fwrite($fh,"from: {$Referer}\r\n");
		fwrite($fh,"===============================\r\n");
		//关闭文件
		fclose($fh);
	}








}
