<?php
//引用库
include('DawnPHP/door.php');

//获取数据
$c=Dawn::get('c','Index');//控制器
$a=Dawn::get('a','index');//动作

$k=Dawn::get('k','NGS');//关键词
$id=Dawn::get('id','0_0');//关键词下的页面，由页面序号索引到文件名	

//实例化缓存
$inEdit=array('Linux','Python','R',"NGS", "html");//传入正在编辑的关键词，不缓存这些部分
#$cache=new Cache( $inEdit );
#$cache->page_init();//页面缓存初始化




// 随机化首页 Begin
if(""==Dawn::get('c','')){
	// 获取随机化的$k, $id:
	if(""==Dawn::get('k','')){
		// 随机选择一个 topMenu
		$menuItems = include('data/TopMemu.php');
		$keys = array_keys($menuItems);
		$k = $keys[array_rand($keys)];
	}
	if(""==Dawn::get('id','')){
		// 随机选择一个 leftMenu
		//一级数组
		$leftArr = include("data/".$k.".php");
		$firstLevelIndex = array_rand($leftArr);

		//二级数组
		$secondLevelArray = $leftArr[$firstLevelIndex][2];
		$secondLevelIndex = array_rand($secondLevelArray);

		$id=$firstLevelIndex . '_' . $secondLevelIndex;
	}
}
// 随机化首页 End




	//实例化控制器
	$c=$c.'Controller';
	$controller=new $c;//new后面不能是表达式
	//调用操作
	$controller->$a($k,$id);


#$cache->page_cache(600);//一般是最后一行,页面缓存结束。设置缓存600s=10min