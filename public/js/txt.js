function addContents(){
	//获取目录dom
	 aH4=document.getElementsByTagName('h4')
	var	oContent=getElementsByClassName('content')[0],
		oPre=oContent.getElementsByTagName('pre')[0],
		oDiv=createElement('div');
		oUl=createElement('ol');
	//添加标题、日期
	oDiv.appendChild( createElement('h2',{},'目录' ) );
	//oDiv.appendChild( createElement('p',{}, 'lastModified: ' + document.lastModified ) );
	//添加内容
	for(var i=0;i<aH4.length;i++){
		var text=aH4[i].innerHTML;
		if(trim(text)!=''){
			oUl.appendChild( createElement('li',{'class':'text_menu'},text ) );
		}
	}
	oDiv.appendChild( oUl );
	//添加标题
	oDiv.appendChild( createElement('h2',{},'正文' ) );
	//加入文档流
	oContent.insertBefore( oDiv, oPre);
}

//风险：修改的时候防止被覆盖！
window.onload=function(){
	addContents();
}