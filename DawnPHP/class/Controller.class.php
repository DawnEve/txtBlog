<?php
/**=============================================
 * Controller 控制器基类
 *
 * 用于系统初始化、资源调用等
 * 类名时驼峰法，方法名是下划线法。
 *
 * @version		v1.0.1
 * @revise		2015.10.08
 * @date		2015.10.06
 * @author		Dawn
 * @email		JimmyMall@live.com
 * @link		https://github.com/DawnEve/DawnPHPTools
 =============================================*/
 
class Controller{
	//从php到模板传值。
	public $data;
	
	function __construct(){
		//记录日志
		Log::myLog();
	}
	
	function loadModel($class){
		//加载模型
		$classPath=DAWN_PATH . '../Model/';
		$path=$classPath. $class . '.class.php';
		if(file_exists($path)){
			require($path);
			return;
		}
	}
	
	/**
		[作废，不好用]显示视图
	*/
	function view($file){
		include('View/'.$file.'.html');
		//echo $file;
	}
	
	/**
		获取顶部菜单
	*/
	function getTopMenu($keyword){
		$top=new Config(BLOG_MENU . '/TopMemu.php');

		$data=$top->get();
		$arr=array('keyword'=>$keyword);
		$arr['data']=$data;
		
		return $arr;
	}
	
	/**
		获取左侧菜单
	*/
	function getLeftMenu($keyword,$id){
	    $top=new Config(BLOG_MENU . $keyword.'.php');
		$data=$top->get();	    
		
		$arr=array('keyword'=>$keyword);
		$arr['id']=$id;
		$arr['data']=$data;
		
		return $arr;
	}

}