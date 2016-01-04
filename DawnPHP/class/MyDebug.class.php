<?php
/**=============================================
 * MyDebug 我的调试类
 *
 * 集成一些短名称静态函数，便于调试
 * 类名时驼峰法，方法名是下划线法。
 *
 * @version		v1.0.1
 * @revise		2015.10.08
 * @date		2015.10.06
 * @author		Dawn
 * @email		JimmyMall@live.com
 * @link		https://github.com/DawnEve/DawnPHPTools
 =============================================*/
class MyDebug{
	/*
		直接打印变量
		http://www.myexception.cn/php/352225.html
	*/
	static function p($var,$style=0){
		echo '<pre>';
		echo '<hr>';
		if($style==0){ print_r($var);
			}else{	var_dump($var);}
		echo '<hr>';
	}
	/*
		输出变量到文件
		http://www.myexception.cn/php/352225.html
	*/
	static function f($var, $file_name='debug.txt'){
		$s = print_r($var, true);
		file_put_contents($file_name, $s);
	}
}