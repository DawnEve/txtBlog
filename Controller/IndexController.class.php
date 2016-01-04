<?php

class IndexController extends Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index($k='',$id=''){
		if($k=='')return;
		if($id=='')return;
	
		//1.获得数据
		//1.1 获得顶部导航
		$arrTop=$this->getTopMenu($k);
		//1.2获得左侧导航信息
		$arrLeft=$this->getLeftMenu($k,$id);

		//1.3对数据进行判断，如果为空，则在加载完顶部和侧边目录后返回
		$num=count($arrLeft['data']);
		
		//2.加载视图并显示
		$c = substr(__class__,0,stripos(__class__,'Controller'));
		$a = substr(__method__,2+stripos(__method__,'::'));

		$file=$c.'/'.$a;
		include('View/'.$file.'.html');
	}

}