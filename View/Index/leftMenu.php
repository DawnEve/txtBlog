<ul class=left id='leftpanel'>


<?php
$trueFileName='';//真实文件名
$fileType=''; //文件类型

for($i=0; $i<count($arrLeft['data']);$i++){
	//1级目录
	$one=$arrLeft['data'][$i];
	if(false==$one){
		$title1='暂时没有数据.';
	}else{
		$title1=$i . '. ' . $one[1];
	}
	echo "<li><h5 class=title>{$title1}</h5>";
	echo '	<ul class=submenu>';
	//2级目录
	$two=$one[2];
	for($j=0;$j<count($two);$j++){
		$class='';
		$fileSeq=$i.'_'.$j;
		if($id==$fileSeq){
			//为类定义
			$class=' class=cur';
			//获取文件的真名
			$trueFileName = $two[$j][1];
			//为文件真名连接扩展名
			if(isset($two[$j][2])){
			    //获取文件扩展名
			    $fileType=strtolower( $two[$j][2] );
			}else{
			    $fileType='html';
			}
			$trueFileName .= '.' . $fileType;
			
			
			// 根据文件类型判断需要加载的组件
			switch( strtolower($fileType) ){
				//如果是txt，则引入txt.js文件
				case 'txt':
					echo '<script type="text/javascript" src="/public/js/startMove.js"></script>';
					echo '<script type="text/javascript" src="/public/js/txt.js"></script>';
					echo '<link rel="stylesheet" type="text/css" href="/public/css/txt.css">';
					break;
				//如果是markdown，则引入md的样式表
				case 'md':
				case 'markdown':
					echo '<script type="text/javascript" src="/public/js/startMove.js"></script>';
					echo '<script type="text/javascript" src="/public/js/markdown.js"></script>';
					echo '<link rel="stylesheet" type="text/css" href="/public/css/MarkDown3.css">';//温和的样式表
					//echo '<link rel="stylesheet" type="text/css" href="/public/css/MarkDown2.css">';//原始txt样的md
					break;
			}

		}
		//这是文件说明
		$fname=$two[$j][0];

		//拼装左侧菜单链接
		echo "<li".$class."><a href='index.php?k=".$keyword."&id=".$fileSeq."'>". $fileSeq .' '.$fname."</a></li>";
	}

	echo "</ul>";
	echo "</li>";
}
?>

	
	
</ul>

<script>
//获得元素
function $(s){
	return document.getElementById(s);
}
//打印结果，调试用
function n(s){
	console.log(s);
}

//左侧菜单toggle
var oUl=$('leftpanel');

//getElementsByClassName不兼容IE8-。用到了common.js中定义的函数getElementsByClassName
var aTitle=getElementsByClassName('title',oUl);
var aSubMenu=getElementsByClassName('submenu',oUl);


for(var i=0;i<aTitle.length;i++){
	var oTitle=aTitle[i];
	oTitle.index=i;
	oTitle.onclick=function(){
		var oSubMenu=aSubMenu[this.index];
		if(oSubMenu.style.display=='none'){
			oSubMenu.style.display='block';
		}else{
			oSubMenu.style.display='none';
		}
	}
}



//为html的title添加文件名 $trueFileName
document.title = "<?php echo $keyword . '/' . $trueFileName;?>"+" | "+document.title;
</script>