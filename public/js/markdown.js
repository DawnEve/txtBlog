/**
* name: 为md生成目录 markdown.js: 顶部1个，左下角一个
* version: 0.1
# 
*/




/**
* name: 全局滚动时、窗口变化大小时，左下角固定位置
* version: 0.1
* 
*/
function fixNaveBoxPosition(){
	var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
	var visualHeight=document.documentElement.clientHeight; //offsetHeight
	//同步左下角窗口位置
	var combox=$("common_box");
	var selfHeight=combox.offsetHeight;
	combox.style.top=scrollTop+visualHeight-selfHeight+"px";//窗口顶端滚过的高度 + 当前浏览器可见高度 - 自身盒子高度
}
//挂载到resize
addEvent(window, 'resize', function(){
	fixNaveBoxPosition();
});







//======================
/**
* name: 为左下角生成目录外框架，
* depend on startMove.js
* version: 0.1
* version: 0.2 初始化时候显示在底部不动;
*/
function addCornerContentsBox() {
	var combox = document.getElementById("common_box");
	var cli_title = document.getElementById("cli_title");
	var cli_on = document.getElementById("cli_on");//cli_title.getElementsByTagName("b")[0];
	var flag = true, initime = null, r_len = 0;
	//var width=400; //parseInt(getStyle(combox,"width"));
	var oD=$("f_content")
	
	cli_on.onclick = function () {
		var height90=parseInt(document.documentElement.clientHeight*0.9); //parseInt(getStyle(combox,"height"));
		//console.log(flag, height90, oD.style.height,oD.offsetHeight, oD.scrollHeight, parseInt(getComputedStyle(oD,false)['height']) )
		// 如果nav很矮，则整体高度使用最低的高度
		if(oD.offsetHeight+20<height90){
			height90=oD.scrollHeight+20;
		}
		oD.style.height = height90-30+"px";
		
		
		/*如果不需要动态效果，这两句足矣
		combox.style.right = flag?'-270px':0;
		flag = !flag;
		*/
		var px_left=flag?0:-200;
		var px_height=flag?height90:30;
		combox.style.height=px_height+"px";
		
		// 左下角菜单伸缩动作
		var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
		var visualHeight=document.documentElement.clientHeight;
		var px_top=scrollTop+visualHeight-px_height;		
		startMove(combox, {"left": px_left, 'top':px_top})
		cli_on.innerHTML=flag?"-":"+";
		//
		flag = !flag;
	}
	//加载后3秒页面自动收缩；不打扰用户，初始化静默收缩在左下角.
	//initime = setTimeout("cli_on.click()", 100);
}
// 挂载函数到load事件
addEvent(window, 'load', function(){
	addCornerContentsBox();
});



//======================
/**
* name: 为顶部生成目录
* version: 0.1
* version: 0.2 修正点击锚点错位一行的问题
* version: 0.3 修正目录计数，都从1开始；准确定位URL中锚点位置；
*
*/
function addContents(){
	var oMd=document.getElementsByClassName("markdown")[0],
		aH=oMd.querySelectorAll("h1,h2,h3,h4,h5,h6"),
		oUl=createElement('ol');

	//创建content
	oContent=createElement('div',{'class':"content"},"")
	oMd.parentElement.insertBefore(oContent, oMd) //加入文档流

	//1. add "目录"
	oContent.append(createElement('h2',{},'Contents' ))
		
	for(var i=0;i<aH.length;i++){
		var j=i+1;
		var oH=aH[i],
			text=oH.innerText,  //"5.启动nginx"
			tagName=oH.tagName;  //"H3"
		var indentNum='indent_'+ tagName.replace("H",''); //标题缩进行数
		
		if(text.trim()!=""){
			// if h tag is empty, do nothing
			//1. add anchor
			//console.log(i,tagName, text,  aH[i])
			//oH.parentNode.insertBefore( createElement('p',{}, ''), oH);//占位置
			oH.parentNode.insertBefore( createElement('a',{'name':j,
				'my-data':'anchor',
				'style':"margin-top:-1px; padding-top:1px; border:1px solid rgba(0,0,0,0.0);"
			},), oH ); //h前添加锚点,无显示
			
			//2. show in the contents
			var innerSpan = createElement('span',{},text );
			var innerLi = createElement('li',{'class':'text_menu '+indentNum} );
			// 添加点击锚点
			var innerA = createElement('a',{'href':'#'+j, 'title':tagName+": "+text}); //鼠标悬停提示文字
			// 装载锚点 
			innerLi.appendChild(innerSpan);
			innerA.appendChild(innerLi);
			oUl.appendChild( innerA );
		}
	}
	//2. add contents
	oContent.append( oUl); //加入文档流
	
	//3.加入左下角菜单中
	$("f_content").getElementsByTagName("div")[0].append( oUl.cloneNode(true) );
	// 复制节点 https://blog.csdn.net/LLL_liuhui/article/details/79978487
	
	//3. add "正文"
	//oContent.append( createElement('h2',{},'正文' )); //加入文档流
}

// 挂载函数到load事件
addEvent(window, 'load', function(){
	addContents();
	locateURLAnchor();//定位URL中的锚点
});



//======================
/**
* name: 为左下角目录响应滚动，高亮当前标题；滚动左下角窗口位置
* version: 0.1
* version: 0.2 考虑顶部菜单栏遮挡部分
* 
*/
function highlightCurrentContent() {
	//为了保证兼容性，这里取两个值，哪个有值取哪一个
	//scrollTop就是触发滚轮事件时滚轮的高度
	var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
	//console.log("滚动距离" + scrollTop);
	//开始循环干活了
	//目录内容
	var oMenu=$('f_content');
	var aSpan=oMenu.getElementsByTagName("span");
	
	//正文内容
	var aA= document.querySelectorAll("a[my-data]");

	//对正文的锚点进行遍历
	for(var i=0;i<aA.length;i++){
		if(aA[i].offsetTop<scrollTop+50){//考虑顶部菜单栏遮挡部分
			//remove class cur, for 导航
			for(var j=0;j<aSpan.length;j++){
				aSpan[j].parentElement.parentElement.setAttribute("class","");
			}
			
			//add class cur, for 导航
			var oA=aSpan[i].parentElement.parentElement
			oA.setAttribute("class","cur")
		}
	}
	
	//固定左下角位置
	fixNaveBoxPosition()
}

// 挂载函数到事件
addEvent(window, 'scroll', function(){
	highlightCurrentContent();
});
