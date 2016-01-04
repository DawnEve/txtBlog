<ul class=left id='leftpanel'>


<?php
$trueFileName='';
$fileType='';

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
			    $fileType=$two[$j][2];
			}else{
			    $fileType='html';
			}
			$trueFileName .= '.' . $fileType;
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
var aTitle=oUl.getElementsByClassName('title');
var aSubMenu=oUl.getElementsByClassName('submenu');

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

</script>