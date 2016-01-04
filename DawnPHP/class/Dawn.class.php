<?php
class Dawn{
	//get函数
	static function get($key,$default=''){
		if(isset($_GET[$key])){
			return $_GET[$key];
		}else{
			return $default;
		}
	}
	//post函数
	static function post($key,$default=''){
		if(isset($_POST[$key])){
			return $_POST[$key];
		}else{
			return $default;
		}
	}
	//session函数-set
	static function sessionSet($key,$value){
		$_SESSION[$key]=$value;
	}
	//session函数-get
	static function sessionGet($key){
		if(isset($_SESSION[$key])){
			return $_SESSION[$key];
		}else{
			return -1;
		}
	}
	
	//to array
	public static function toArray($obj){
		$_array = is_object($obj)?get_object_vars($obj): $obj;
	 
		foreach ($_array as $key => $value) {
			$value = (is_array($value) || is_object($value)) ? Dawn::toArray($value) : $value;
			$array[$key] = $value;
		}
	 
		return $array;
	}
	
	//出错后显示 返回首页
	public static function died(){
		die('Invalid visit.<br><a href="index.php">返回首页</a>');
	}
	
	public static function showTxt($filename){
	    //1.确定文件存在，否则提示
	    if(!file_exists($filename)){
	        return '<p>文件不存在</p>';
	    }
	    //2.对文件进行替换
	    $data = file_get_contents($filename);
	    //对<>进行转义
	    $data=preg_replace('/</','&lt;',$data);
	    $data=preg_replace('/>/','&gt;',$data);
	    //对换行的========替换为<hr>
	    $data=preg_replace('/={20,}/','<hr class=top><h4>',$data);
	    $data=preg_replace('/\-{20,}/','</h4><hr class=under>',$data);
	    
	    
	    //3.输出显示
	    return $data;
	
	}
}