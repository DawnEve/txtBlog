<?php
//引用库
include('DawnPHP/door.php');

//获取数据
$c=Dawn::get('c','Index');//控制器
$a=Dawn::get('a','index');//动作
$k=Dawn::get('k','R');//关键词
$id=Dawn::get('id','0_0');//关键词下的页面，由页面序号索引到文件名	

//实例化缓存
$inEdit=array('Linux','Python','R',"NGS","scSeq",'English','Illustrator');//传入正在编辑的关键词，不缓存这些部分
$cache=new Cache( $inEdit );
#$cache->page_init();//页面缓存初始化 



	//实例化控制器
	$c=$c.'Controller';
	$controller=new $c;//new后面不能是表达式
	//调用操作
	$controller->$a($k,$id);


#$cache->page_cache(1);//一般是最后一行,页面缓存结束