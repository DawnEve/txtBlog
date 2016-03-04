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

