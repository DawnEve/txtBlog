<?php
/**=============================================
 * Cache Class
 *
 * 文件缓存类
 * 类名时驼峰法，方法名是下划线法。
 *
 * @version		v0.0.4
 * @revise		2017.01.05 
 * @date		2016.03.04
 * @author		Dawn
 * @email		JimmyMall@live.com
 * @link		https://github.com/DawnEve/DawnPHPTools
 =============================================*/
 /**
 v0.0.3 改为发现更新内容时更新缓存。
 v0.0.4 修复找不到文件还缓存的报错bug
 */
 //针对本博客做了优化，以后要写的更通用
 //参照 http://www.poluoluo.com/jzxy/201501/333293.html
 
class Cache{
	private $cacheRoot  = "./cache/"; //缓存目录 [属性可写]
	private $cacheFileName  = ""; //缓存文件名 
	private $cacheLimitTime   = 3600;  //缓存更新时间秒数，0为不缓存 [单位：秒]
	private $cacheFileExt    = ".html"; //缓存文件名 
	
	private $_c;
	private $_a;
	private $_k;
	private $_id;
	private $_uri;
	private $edit=array(); // 正在更新的关键词
	
	function __construct($edit=array()){
		$this->_c=strtolower($GLOBALS['c']);
		$this->_a=strtolower($GLOBALS['a']);
		$this->_uri=strtolower( $this->_c . '_' . $this->_a);
		
		$this->_k=strtolower($GLOBALS['k']);
		$this->_id=strtolower($GLOBALS['id']);
		
		//忽略大小写
		for($i=0; $i<count($edit); $i++){
			$edit[$i]=strtolower( $edit[$i] );
		}
		
		$this->edit=$edit;//正在更新的数组。
	}
	
	
	
	function page_init(){     
		$url = $_SERVER['REQUEST_URI'];//子url，该参数一般是唯一的 
		$pageid = $this->_k . '_' . $this->_id . '-' . md5($url); 
		
		//$dir = str_replace('/','_',substr($_SERVER['SCRIPT_NAME'],1,-4));//适合pathinfo模式
		$dir=$this->_uri;
		
		
		//目录命名方式，如exp_index 
		 if(!file_exists($pd = $this->cacheRoot . $dir.'/')){
			@mkdir($pd,0777) or die("$pd目录创建失败");
		}
		
		//如cache/page/exp_index/ 
		$this->cacheFileName = $pd.$pageid.'.html'; 
		//如cache/page/exp_index/cc8ef22b405566745ed21305dd248f0e.html
		
		$contents=null;
		if(file_exists($this->cacheFileName)){
			$contents = file_get_contents( $this->cacheFileName );//读出
		}
		
		//读出原始文件的创建日期
		//filemtime() 函数返回文件内容上次的修改时间。
		$file_name=$this->getFilePath($this->_c,$this->_k,$this->_id);
		if(file_exists($file_name)){
			$file_time=filemtime($file_name);
		}else{
			return;
			//$file_time=time();
		}
		
		// echo $file_time; 
		// echo date("Y-m-d H:i:s",1453350412);
		// die();
	 
	 
	 
	 
		//对应page_cache()函数中加上的自定义头部 
		if($contents && substr($contents, 13, 10) == $file_time ){ 
			echo substr($contents, 27); 
			Log::mylog('cache');
			exit(0); 
		}
		//return true;
		
		if( !in_array($this->_k, $this->edit)){
			ob_start();//开启缓存
		}
	}
	
	//获取不同控制器下的文件路径。就是index控制器，其他控制器。
	function getFilePath($c,$k,$id){
		if($c=="index"){
			$config=include("data/".$k.'.php');
			$arr=explode("_",$id);
			
			$file_arr=$config[$arr[0]][2][$arr[1]];
			$file_name=$file_arr[1].'.'.$file_arr[2];
			return "data/".$this->_k.'/'.$file_name;
		}else{
			return "View/".ucfirst($c)."/".$this->_k.".html";
		}
		//http://blog.dawneve.com/index.php?c=outline
		//http://blog.dawneve.com/index.php?c=outline&k=php
		//http://blog.dawneve.com/index.php?c=summary&k=2015
	}
	
	
	function page_cache($ttl = 0){
		//如果在编辑，则啥也不做
		if( in_array($this->_k , $this->edit) ){
			return;
		}
		
		$ttl = $ttl ? $ttl : $this->cacheLimitTime;//缓存时间，默认3600s 
		$contents = ob_get_contents();//从缓存中获取内容 
		
		//获取数据文件创建时间
		$file_name=$this->getFilePath($this->_c,$this->_k,$this->_id);
		if(file_exists($file_name)){
			$file_time=filemtime($file_name);
		}else{
			return;
			//$file_time=time();
		}
		
		//$contents = "<!--page_ttl:" . (time() + $ttl) . "-->n" . $contents; 
		$contents = "<!--page_ttl:" . $file_time . "-->n" . $contents; 
		//加上自定义头部：过期时间=生成时间+缓存时间 
		file_put_contents( $this->cacheFileName, $contents); //写入缓存文件中 
		ob_end_flush();//释放缓存 
	}
}
