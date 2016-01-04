<?php
/**=============================================
 * Config Class
 *
 * 配置文件操作类
 * 类名时驼峰法，方法名是下划线法。
 *
 * @version		v1.0.3
 * @revise		2015.12.31
 * @date		2015.12.15
 * @author		Dawn
 * @email		JimmyMall@live.com
 * @link		https://github.com/DawnEve/DawnPHPTools
 =============================================*/
class Config{
	private $config_file='';//配置文件位置
	function __construct($config_file='config.php'){
		$this->config_file=$config_file;
	}
	
	/**
		读取配置项，有参数就返回，否则就全部返回
	*/
	function get($key=''){
	    //如果文件不存在，则返回false
	    if(!file_exists($this->config_file)){
	        return false;
	    }
	    //如果存在，则读取
		$set = include($this->config_file);
		if(''==$key){
			return $set;
		}else{
			return $set[$key];
		}
	}
	
	/**
		修改/新增配置，有值则获取，否则就全部覆盖到文件
	*/
	function set($key,$value=''){
		if(''==$value){
			self::array2config($key,$this->config_file);
		}else{
			$set = include($this->config_file);
			if($set[$key]==$value){
				return;
			}
			
			$set[$key]=$value;
			self::array2config($set,$this->config_file);
		}
	}
	
	/**
		静态方法：数组写入配制文件
	*/
	static function array2config($arr,$file){
		$str='<?php'.PHP_EOL.'return '.var_export($arr,TRUE).';';
		file_put_contents($file, $str);
	}
}
?>