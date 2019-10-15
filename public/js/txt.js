/* 添加目录
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