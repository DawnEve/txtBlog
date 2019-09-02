<?php
/**=============================================
 * myAgentInfo Class
 *
 * This class enables you to log user info: IP, time, url.
 * 类名时驼峰法，方法名是下划线法。
 *
 * @version		v1.0.0
 * @revise		2016.01.05
 * @date		2015.12.31
 * @author		Dawn
 * @email		JimmyMall@live.com
 * @link		https://github.com/DawnEve/DawnPHPTools
 =============================================*/


/*
下面分别是各个浏览器的navigator.userAgent
//Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN) AppleWebKit/533.21.1 (KHTML, like Gecko) Version/5.0.5 Safari/533.21.1  –safari
//Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.220 Safari/535.1                             –chrome
//Opera/9.80 (Windows NT 5.1; U; Edition Next; zh-cn) Presto/2.8.158 Version/11.50  –opera
//Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; InfoPath.1; .NET4.0C; .NET4.0E; InfoPath.2)  —ie
//Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.2.24) Gecko/20111103 Firefox/3.6.24    –firefox
*/
/////////////////////////////////////类的定义

class myAgentInfo{
	//获取用户IP
	//http://www.cnblogs.com/xiaochaohuashengmi/archive/2011/07/05/2098154.html
    function getIP2 (){
		 //global $_SERVER;
		 //$agent=$_SERVER["HTTP_USER_AGENT"];
		 if (getenv('HTTP_CLIENT_IP')) {
			 $ip = getenv('HTTP_CLIENT_IP');
		 } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
			 $ip = getenv('HTTP_X_FORWARDED_FOR'); 
		 } elseif (getenv('REMOTE_ADDR')) {
			 $ip = getenv('REMOTE_ADDR');
		 } else {
			 $ip = $_SERVER['REMOTE_ADDR'];
		 }
		 return $ip; 
     }
	
	
	/**
		获取用户IP
	*/
	function getIP(){
		if (isset($_SERVER)) {
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
				$realip = $_SERVER['HTTP_CLIENT_IP'];
			} else {
				$realip = $_SERVER['REMOTE_ADDR'];
			}
		} else {
			if (getenv("HTTP_X_FORWARDED_FOR")) {
				$realip = getenv( "HTTP_X_FORWARDED_FOR");
			} elseif (getenv("HTTP_CLIENT_IP")) {
				$realip = getenv("HTTP_CLIENT_IP");
			} else {
				$realip = getenv("REMOTE_ADDR");
			}
		}
		return $realip;
	}
	
	/**
		新浪接口根据ip查询所在区域信息
	*/
	function getRegion2($ip){
		$res = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=$ip");
		
		$res = json_decode($res,true);
		return $res;//返回的是个数组
		//print_r($res0);	echo "<br/>";
	}
	
	
	/**
		淘宝接口根据ip查询所在区域信息
	*/
	function getRegion($ip){
		$res = file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=$ip");
		
		$res = json_decode($res,true);
		return $res;//返回的是个数组
		//print_r($res0);	echo "<br/>";
	}
	
	
	//浏览器类型
	////http://my.oschina.net/junn/blog/314064
	function getBrowser(){
		$agent=$_SERVER["HTTP_USER_AGENT"];
		if(strpos($agent,'MSIE')!==false || strpos($agent,'rv:11.0')) //ie11判断
			return "ie";
		else if(strpos($agent,'UCBrowser')!==false)
			return 'UCBrowser';
		else if(strpos($agent,'Firefox')!==false)
			return "firefox";
		else if(strpos($agent,'Chrome')!==false)
			return "chrome";
		else if(strpos($agent,'Opera')!==false)
			return 'opera';
		else if((strpos($agent,'Chrome')==false)&&strpos($agent,'Safari')!==false)
			return 'safari';
		else
			return 'unknown';
	}
 
	//浏览器版本号 粗糙
	//http://my.oschina.net/junn/blog/314064
	function getBrowserVer(){
		if (empty($_SERVER['HTTP_USER_AGENT'])){    //当浏览器没有发送访问者的信息的时候
			return 'unknow';
		}
		$agent= $_SERVER['HTTP_USER_AGENT'];   
		if (preg_match('/MSIE\s(\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif (preg_match('/UCBrowser\/(\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif (preg_match('/FireFox\/(\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif (preg_match('/Opera[\s|\/](\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif (preg_match('/Chrome\/(\d+)\..*/i', $agent, $regs))
			return $regs[1];
		elseif ((strpos($agent,'Chrome')==false)&&preg_match('/Safari\/(\d+)\..*$/i', $agent, $regs))
			return $regs[1];
		else
			return 'unknow';
	}
	
	
	/**
		正在使用。获取浏览器版本信息
	*/
	function getBrowser_2(){
		 //global $_SERVER;
		 $Agent = $_SERVER['HTTP_USER_AGENT']; 
		 
		 //$Agent='Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)';
		 //$Agent='Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html))';
		 
		 $browser = '';
		 $browserver = '';
		 $Browsers = array('Lynx', 'MOSAIC', 'AOL', 'Opera', 'JAVA', 'MacWeb', 'WebExplorer', 'OmniWeb','Safari','Chrome','MQQBrowser'); 
		 for($i = 0; $i <count($Browsers); $i ++){
			 if(strpos($Agent, $Browsers[$i])){
				 $browser = $Browsers[$i]; 
				 $browserver = '';
			 }
		 }		 
		
		//获取浏览器型号和版本号
		if(preg_match('/Mozilla/', $Agent) && preg_match('/MSIE/', $Agent)){
			$temp = explode('(', $Agent);
			$Part = $temp[1]; 
			$temp = explode(';', $Part);
			$Part = $temp[1];
			$temp = explode(' ', $Part);
			$browserver = $temp[2]; 
			$browser = 'Internet Explorer';
		}elseif(preg_match('/Mozilla/', $Agent) && preg_match('/Firefox/', $Agent)){
			$temp = explode('(', $Agent); //[0] =>Mozilla/5.0	[1] =>Windows NT 6.1; WOW64; rv:31.0) Gecko/20100101 Firefox/31.0
			$Part = $temp[1]; //Windows NT 6.1; WOW64; rv:31.0) Gecko/20100101 Firefox/31.0
			$temp = explode(')', $Part); //[0] => Windows NT 6.1; WOW64; rv:31.0	[1] =>  Gecko/20100101 Firefox/31.0
			$Part = $temp[1];// Gecko/20100101 Firefox/31.0
			$temp = explode(' ', $Part);  // [0] =>     [1] => Gecko/20100101    [2] => Firefox/31.0
			$browserver = $temp[2]; //Firefox/31.0
			$browserver = preg_replace('/(Firefox\/)/', '', $browserver);//31.0
			$browser = 'Firefox';
		}elseif(preg_match('/Mozilla/', $Agent) && preg_match('/MQQBrowser/', $Agent)){
			$temp = explode('(', $Agent); 
			$Part = $temp[2]; 
			$temp = explode(')', $Part); 
			$Part = $temp[1];
			$temp = explode(' ', $Part);
			$browserver = $temp[1]; 
			$browserver = preg_replace('/(MQQBrowser\/)/','',$browserver);
			$browser = 'MQQBrowser';
		}elseif(preg_match('/Mozilla/', $Agent) && preg_match('/UCBrowser/', $Agent)){
			$temp = explode('(', $Agent); 
			$Part = $temp[2]; 
			$temp = explode(')', $Part); 
			$Part = $temp[1];
			$temp = explode(' ', $Part);
			$browserver = $temp[2]; 
			$browserver = preg_replace('/(UCBrowser\/)/','',$browserver);
			$browser = 'UCBrowser';
		}elseif(preg_match('/Mozilla/', $Agent) && preg_match('/Safari/', $Agent) && (!preg_match('/Chrome/', $Agent)) ) {
			$temp = explode('(', $Agent); 
			$Part = $temp[2]; 
			$temp = explode(')', $Part);
			$browserver = $temp[1];
			$temp = explode(' ', $browserver); 
			$browserver = $temp[2]; 
			$browserver = preg_replace('/(Safari\/)/', '', $browserver);
			$browser = 'Safari'; 
		}elseif(preg_match('/Mozilla/', $Agent) && preg_match('/Chrome/', $Agent)){
			$temp = explode('(', $Agent); 
			$Part = $temp[2]; 
			$temp = explode(')', $Part); 
			$Part = $temp[1];
			$temp = explode(' ', $Part);
			$browserver = $temp[1];  
			$browserver = preg_replace('/(Chrome\/)/','',$browserver);
			$browser = 'Chrome';
		}elseif(preg_match('/Mozilla/', $Agent) && preg_match('/Baiduspider/', $Agent)){
			$temp = explode('(', $Agent); 
			// [0] => Mozilla/5.0 	    [1] => compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)
			$Part = $temp[1]; 
			$temp = explode(';', $Part); 
			//  [0] => compatible	    [1] =>  Baiduspider/2.0	    [2] =>  +http://www.baidu.com/search/spider.html)
			$browserver = $temp[1];  
			$browserver = preg_replace('/(Baiduspider\/)/','',$browserver);
			$browser = 'Baiduspider';
		}elseif(preg_match('/Mozilla/', $Agent) && preg_match('/bingbot/', $Agent)){
			$temp = explode('(', $Agent); 
			$Part = $temp[1]; 
			$temp = explode(';', $Part); 
			$browserver = $temp[1];  
			$browserver = preg_replace('/(bingbot\/)/','',$browserver);
			$browser = 'bingbot';
		}elseif(preg_match('/Mozilla/', $Agent) && preg_match('/Googlebot/', $Agent)){
			$temp = explode('(', $Agent); 
			$Part = $temp[1]; 
			$temp = explode(';', $Part); 
			$browserver = $temp[1];  
			$browserver = preg_replace('/(Googlebot\/)/','',$browserver);
			$browser = 'Googlebot';
		}
		 
		//拼装字符串
		if($browser != ''){
			$browseinfo = $browser.' '.$browserver;
		} else {
			$browseinfo = 'unknow';
		}

		return $browseinfo;
     }
	
	/*
	//获取操作系统类型：很粗糙
	function getOS_2(){
		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(strpos($agent, 'windows nt')) {
			$platform = 'windows';
		} elseif(strpos($agent, 'macintosh')) {
			$platform = 'mac';
		} elseif(strpos($agent, 'ipod')) {
			$platform = 'ipod';
		} elseif(strpos($agent, 'ipad')) {
			$platform = 'ipad';
		} elseif(strpos($agent, 'iphone')) {
			$platform = 'iphone';
		} elseif (strpos($agent, 'android')) {
			$platform = 'android';
		} elseif(strpos($agent, 'unix')) {
			$platform = 'unix';
		} elseif(strpos($agent, 'linux')) {
			$platform = 'linux';
		} else {
			$platform = 'other';
		}
			return $platform;
	}
	*/
	
	
	
     function getOS(){
		 //global $_SERVER;
		 $agent = $_SERVER['HTTP_USER_AGENT'];
		 $os = false;
		 if (preg_match('/win/i', $agent) && strpos($agent, '95')){ 
			 $os = 'Windows 95';
		 }
		 elseif (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90')){
			 $os = 'Windows ME'; 
		 }
		 elseif (preg_match('/win/i', $agent) && preg_match('/98/', $agent)){
			 $os = 'Windows 98';
		 }
		 elseif (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent)){ 
			 $os = 'Windows XP';
		 }
		 elseif (preg_match('/win/i', $agent) && preg_match('/nt 5.2/i', $agent)){
			$os = 'Windows 2003';
		 }
		 elseif (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent)){
			 $os = 'Windows 2000';
		 } 
		 
		 elseif (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent)){
			$os = 'Windows 7';
		 }
		 elseif (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent)){
			$os = 'Windows 8';
		 }
		 elseif (preg_match('/win/i', $agent) && preg_match('/nt 6.3/i', $agent)){
			$os = 'Windows 8.1';
		 }
		 elseif (preg_match('/win/i', $agent) && preg_match('/nt 6.4/i', $agent)){
			$os = 'Windows 10';
		 }
		 elseif (preg_match('/win/i', $agent) && preg_match('/NT 10.0/i', $agent)){
			$os = 'Windows 10';
		 }
		 elseif (preg_match('/win/i', $agent) && preg_match('/nt 6/i', $agent)){
			$os = 'Windows vista';
		 }
		 elseif (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent)){
			 $os = 'Windows NT';
		 }
		 elseif (preg_match('/win/i', $agent) && preg_match('/32/', $agent)){ 
			 $os = 'Windows 32';
		 }
		 elseif (preg_match('/android/i', $agent)){
			 $os = 'Android';
		 }
		 elseif (preg_match('/linux/i', $agent)){
			 $os = 'Linux';
		 }
		 elseif (preg_match('/unix/i', $agent)){ 
			 $os = 'Unix';
		 }
		 elseif (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent)){
			 $os = 'SunOS';
		 } 
		 elseif (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent)){
			 $os = 'IBM OS/2';
		 }
		 elseif (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent)){ 
			 $os = 'Macintosh';
		 }
		 elseif (preg_match('/PowerPC/i', $agent)){
			 $os = 'PowerPC';
		 }
		 elseif (preg_match('/AIX/i', $agent)){ 
			 $os = 'AIX';
		 }
		 elseif (preg_match('/HPUX/i', $agent)){
			 $os = 'HPUX';
		 }
		 elseif (preg_match('/NetBSD/i', $agent)){ 
			 $os = 'NetBSD';
		 }
		 elseif (preg_match('/BSD/i', $agent)){
			 $os = 'BSD';
		 }
		 elseif (preg_match('/OSF1/', $agent)){ 
			 $os = 'OSF1';
		 }
		 elseif (preg_match('/IRIX/', $agent)){
			 $os = 'IRIX';
		 }
		 elseif (preg_match('/FreeBSD/i', $agent)){ 
			 $os = 'FreeBSD';
		 }
		 elseif (preg_match('/teleport/i', $agent)){
			 $os = 'teleport';
		 }
		 elseif (preg_match('/flashget/i', $agent)){ 
			 $os = 'flashget';
		 }
		 elseif (preg_match('/webzip/i', $agent)){
			 $os = 'webzip';
		 }
		 elseif (preg_match('/offline/i', $agent)){ 
			 $os = 'offline';
		 }
		 else {
			 $os = 'Unknown';
		 }
		 return $os;
     }
	 
	 
	 
	 
	 //正值表达式比对解析$_SERVER['HTTP_USER_AGENT']中的字符串 获取访问用户的浏览器的信息
	function getBrowser_3() {
		$Agent = $_SERVER['HTTP_USER_AGENT'];
		$browseragent="";   //浏览器
		$browserversion=""; //浏览器的版本
		if (preg_match('/MSIE ([0-9].[0-9]{1,2})/',$Agent,$version)) {
			 $browserversion=$version[1];
			 $browseragent="Internet Explorer";
		} else if(preg_match('/Opera\/([0-9]{1,2}.[0-9]{1,2})/',$Agent,$version)) {
			 $browserversion=$version[1];
			 $browseragent="Opera";
		} else if (preg_match( '/Firefox\/([0-9.]{1,5})/',$Agent,$version)) {
			 $browserversion=$version[1];
			 $browseragent="Firefox";
		}else if (preg_match( '/Chrome\/([0-9.]{1,3})/',$Agent,$version)) {
			 $browserversion=$version[1];
			 $browseragent="Chrome";
		}
		else if (preg_match( '/Safari\/([0-9.]{1,3})/',$Agent,$version)) {
			 $browseragent="Safari";
			 $browserversion="";
		}
		else {
			$browserversion="";
			$browseragent="Unknown";
		}
		return $browseragent." ".$browserversion;
	}
	
	/**
		正在使用。
·		获取操作系统信息
	*/
	function getOS_3() {
		$Agent = $_SERVER['HTTP_USER_AGENT'];
		
		//$Agent='Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36';
		//$Agent='Mozilla/5.0 (iPhone; CPU iPhone OS 5_0 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9A334 Safari/7534.48.3';
		
		$browserplatform='';
		if (preg_match('/win/i',$Agent) && strpos($Agent, '95')) {
			$browserplatform="Windows 95";
		}
		elseif (preg_match('/win 9x/i',$Agent) && strpos($Agent, '4.90')) {
			$browserplatform="Windows ME";
		}
		elseif (preg_match('/win/i',$Agent) && preg_match('/98/',$Agent)) {
			$browserplatform="Windows 98";
		}
		elseif (preg_match('/win/i',$Agent) && preg_match('/nt 5.0/i',$Agent)) {
			$browserplatform="Windows 2000";
		}
		elseif (preg_match('/win/i',$Agent) && preg_match('/nt 5.1/i',$Agent)) {
			$browserplatform="Windows XP";
		}
		elseif (preg_match('/win/i',$Agent) && preg_match('/nt 6.0/i',$Agent)) {
			$browserplatform="Windows Vista";
		}
		elseif (preg_match('/win/i',$Agent) && preg_match('/nt 6.1/i',$Agent)) {
			$browserplatform="Windows 7";
		}
		elseif (preg_match('/win/i',$Agent) && preg_match('/nt 10.0/i',$Agent)) {
			$browserplatform="Windows 10";
		}
		elseif (preg_match('/win/i',$Agent) && preg_match('/32/',$Agent)) {
			$browserplatform="Windows 32";
		}
		elseif (preg_match('/win/i',$Agent) && preg_match('/nt/i',$Agent)) {
			$browserplatform="Windows NT";
		}
		
		elseif (preg_match('/Kindle/i',$Agent)) {
			$version='';
			preg_match( '/Kindle\/(\d\.\d){1}/',$Agent,$version);
			//MyDebug::f($version);die();
			$browserplatform="Kindle" .' '. $version[1];
		}
		
		elseif (preg_match('/Android/i',$Agent)) {
			$version='';
			//preg_match( '/Android\s{1}\/(\d+\.\d+\.\d+)\s/',$Agent,$version);
			preg_match( '/Android(\s)(\d\.\d\.\d){1}\;/',$Agent,$version);
			
			//myDebug($version,'');die();
			/*
			 $temp = explode('(', $Agent); 
			 $Part = $temp[1]; 
			 $temp = explode(')', $Part); 
			 $Part = $temp[0];
			 $temp = explode(' ', $Part);//myDebug($temp,'');die();
			 $version = $temp[2]; 
			*/
			
			$browserplatform="Android" .' '. $version[2];
		}
		elseif (preg_match('/linux/i',$Agent)) {
			$browserplatform="Linux";
		}
		elseif (preg_match('/unix/i',$Agent)) {
			$browserplatform="Unix";
		}
		elseif (preg_match('/sun/i',$Agent) && preg_match('/os/i',$Agent)) {
			$browserplatform="SunOS";
		}
		elseif (preg_match('/ibm/i',$Agent) && preg_match('/os/i',$Agent)) {
			$browserplatform="IBM OS/2";
		}
		elseif (preg_match('/iPhone/i',$Agent) && preg_match('/os/i',$Agent)) {
			dump($Agent);
			$browserplatform="iPhone";
		}
		elseif (preg_match('/Mac/i',$Agent) && preg_match('/PC/i',$Agent)) {
			$browserplatform="Macintosh";
		}
		elseif (preg_match('/Mac OS/i',$Agent)) {
			$browserplatform="Mac OS";
		}
		
		elseif (preg_match('/PowerPC/i',$Agent)) {
			$browserplatform="PowerPC";
		}
		elseif (preg_match('/AIX/i',$Agent)) {
			$browserplatform="AIX";
		}
		elseif (preg_match('/HPUX/i',$Agent)) {
			$browserplatform="HPUX";
		}
		elseif (preg_match('/NetBSD/i',$Agent)) {
			$browserplatform="NetBSD";
		}
		elseif (preg_match('/BSD/i',$Agent)) {
			$browserplatform="BSD";
		}
		elseif (preg_match('/OSF1/i',$Agent)) {
			$browserplatform="OSF1";
		}
		elseif (preg_match('/IRIX/i',$Agent)) {
			$browserplatform="IRIX";
		}
		elseif (preg_match('/FreeBSD/i',$Agent)) {
			$browserplatform="FreeBSD";
		}
		if ($browserplatform=='') {$browserplatform = "Unknown"; }
		return $browserplatform;
	}
}