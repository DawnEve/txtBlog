/**
* name: 为txt生成目录 txt.js: 顶部1个，左下角一个
* version: 0.2 修订

window.addEventListener("load", fun, false);
*/



/**
* name: 全局滚动时、窗口变化大小时，动态调整窗口高度
* version: 0.1
* version: 0.2 简化代码
*/
function updateContent(){
	//1.导航栏最小化时，不用处理
	var cli_on = document.getElementById("cli_on");
	if(cli_on.innerHTML=="+"){
		return false;
	}
	//2.最大化时，需要适应当前窗口的高度
	var oD=$("f_content");
	var height90=parseInt(document.documentElement.clientHeight*0.9);
	//console.log("\n1>>", height90, oD.offsetHeight, oD.scrollHeight)
	if(oD.offsetHeight + 20<height90){
		height90= Math.min(height90, oD.scrollHeight+20);
	}
	//console.log("2>>", height90, oD.offsetHeight, oD.scrollHeight)
	oD.style.height = height90-30+"px";
	$("common_box").style.height = height90+"px";
}

//挂载到resize，降低触发次数
var resizeTimer = null;
addEvent(window, 'resize', function(){
	if (resizeTimer) clearTimeout(resizeTimer);
	resizeTimer = setTimeout(function () {
		updateContent();
    }, 300);
});






//======================
/**
* name: 为左下角生成目录外框架，
* depend on startMove.js
* version: 0.1
* version: 0.2 初始化时候显示在底部不动;
* version: 0.3 简化代码
*/
function addCornerContentsBox() {
	//var cli_title = document.getElementById("cli_title");
	var cli_on = document.getElementById("cli_on");//cli_title.getElementsByTagName("b")[0];
	var combox = document.getElementById("common_box");
	var oD=$("f_content");

	cli_on.onclick = function(){
		var flag = this.innerHTML=="+";

		var height90=parseInt(document.documentElement.clientHeight*0.9); //parseInt(getStyle(combox,"height"));
		//console.log(flag, height90, oD.style.height,oD.offsetHeight, oD.scrollHeight, parseInt(getComputedStyle(oD,false)['height']) )
		// 如果nav很矮，则整体高度使用最低的高度
		if(oD.offsetHeight+20<height90){
			height90=oD.scrollHeight+20;
		}
		oD.style.height = height90-30+"px";

		/*如果不需要动态效果，这两句足矣
		combox.style.left = flag?0:'-200px';
		combox.style.height = (flag?height90:30) +"px";
		*/
		startMove(combox, {
			"left": flag?0:-200,
			'height':flag?height90:30
		});

		this.innerHTML=flag?"-":"+";
	}
}
// 挂载函数到load事件
addEvent(window, 'load', function(){
	addCornerContentsBox();
	window.scrollBy(1, 1); //主动触发滚动，否则没有高亮
});




//======================
/**
*name: 为顶部生成目录
*v0.3
*v0.4 https://blog.csdn.net/weixin_41728561/article/details/86524574 锚点定位被导航栏遮住了
*v0.5 修正目录计数，都从1开始；准确定位URL中锚点位置；
*/
function addContents(){
	//get dom: h4 node
	var	oContent=getElementsByClassName('content')[0],
		oPre=oContent.getElementsByTagName('pre')[0],
		aH4=oPre.getElementsByTagName('h4'),
		oUl=createElement('ol');
	//1. add "目录"
	oContent.insertBefore( createElement('h2',{},'目录' ), oPre);//加入文档流
	//添加内容
	for(var i=0;i<aH4.length;i++){
		var j=i+1;//从1开始，而不是0.
		var text=aH4[i].innerHTML;
		if(trim(text)!=''){
			//1.1 添加锚定a标签到h4标签前面，包含显示编号
			var oH4 = aH4[i]
			oH4.parentNode.insertBefore( createElement('a',{
				'class':'smallA',
				'name':j,
				'my-data':'anchor',
				'style':"margin-top:-33px; padding-top:33px;"
			}, '[Section '+j+']'), oH4 ); //h4前显示section

			//1.2 li中添加span,span中添加text
			var innerSpan = createElement('span',{},text );
			var innerLi = createElement('li',{'class':'text_menu'} );
			// 添加点击锚点
			var innerA = createElement('a',{'href':'#'+j});
			// 装载锚点
			innerLi.appendChild(innerSpan);
			innerA.appendChild(innerLi);
			oUl.appendChild( innerA );
		}
	}
	//2. add contents
	oContent.insertBefore( oUl, oPre); //加入文档流

	//3.加入左下角菜单中
	$("f_content").getElementsByTagName("div")[0].appendChild( oUl.cloneNode(true) );

	//3. add "正文"
	oContent.insertBefore( createElement('h2',{},'正文' ), oPre); //加入文档流
}

//风险：修改的时候防止被覆盖！
/*
window.onload=function(){
	addContents();
}
*/
//这是比较安全的绑定方式
addEvent(window, 'load', function(){
	addContents();
	locateURLAnchor();//定位URL中的锚点
});




//======================
/**
* name: 为左下角目录响应滚动，高亮当前标题；滚动左下角窗口位置
* version: 0.1
* version: 0.2 考虑顶部菜单栏遮挡部分
* version: 0.3 简化代码
*/
function highlightCurrentContent() {
	//1.获取已经滚动高度
	//为了保证兼容性，这里取两个值，哪个有值取哪一个:scrollTop就是触发滚轮事件时滚轮的高度
	var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;

	//2.全部导航 ele
	var aSpan=$('f_content').getElementsByTagName("span");

	//3.全部正文锚点 ele
	var aA= document.querySelectorAll("a[my-data]");

	//4.remove class cur, for 导航
	for(var j=0;j<aSpan.length;j++){
		aSpan[j].parentElement.parentElement.setAttribute("class","");
	}

	//5.遍历正文锚点
	for(var i=0; i<aA.length; i++){
		if(aA[i].offsetTop >= scrollTop+50){ //考虑顶部菜单栏遮挡部分
			//6. add class cur, for 导航
			var oA=aSpan[i==0?0:i-1].parentElement.parentElement
			oA.setAttribute("class","cur");
			break;
		}
	}
}

// 挂载函数到事件
addEvent(window, 'scroll', function(){
	highlightCurrentContent();
});
