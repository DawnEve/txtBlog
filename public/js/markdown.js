/**
* name: 为md生成目录 markdown.js
* version: 0.1
# 
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
		var oH=aH[i],
			text=oH.innerText,  //"5.启动nginx"
			tagName=oH.tagName;  //"H3"
		var indentNum='indent_'+ tagName.replace("H",''); //标题缩进行数
		
		if(text.trim()!=""){
			// if h tag is empty, do nothing
			//1. add anchor
			//console.log(i,tagName, text,  aH[i])
			oH.parentNode.insertBefore( createElement('p',{}, ''), oH);//占位置
			oH.parentNode.insertBefore( createElement('a',{'name':i}, ''), oH.previousSibling ); //h前一个元素前加锚点,无显示
			
			//2. show in the contents
			var innerSpan = createElement('span',{},text );
			var innerLi = createElement('li',{'class':'text_menu '+indentNum} );
			// 添加点击锚点
			var innerA = createElement('a',{'href':'#'+i, 'title':tagName+": "+text}); //鼠标悬停提示文字
			// 装载锚点 
			innerLi.appendChild(innerSpan);
			innerA.appendChild(innerLi);
			oUl.appendChild( innerA );
		}
	}
	//2. add contents
	oContent.append( oUl); //加入文档流
	//3. add "正文"
	//oContent.append( createElement('h2',{},'正文' )); //加入文档流
}

addEvent(window, 'load', function(){
	addContents();
});
