//兼容IE8。解决IE8不支持getElementsByClassName
//这个有点长，暂时没用到
var getElementsByClassName2 = function (searchClass, node,tag) { 
	if(document.getElementsByClassName){ 
		var nodes = (node || document).getElementsByClassName(searchClass),result = []; 
		for(var i=0; node = nodes[i++]; ){ 
			if(tag !== "*" && node.tagName === tag.toUpperCase()){ 
				result.push(node) 
			}else{ 
				result.push(node) 
			} 
		} 
		return result 
	}else{
		var node = node || document; 
		var tag = tag || "*"; 
		var classes = searchClass.split(" "), 
			elements = (tag === "*" && node.all)? node.all : node.getElementsByTagName(tag), 
			patterns = [], 
			current,
			match; 
		var i = classes.length; 
		while(--i >= 0){ 
			patterns.push(new RegExp("(^|\s)" + classes[i] + "(\s|$)")); 
		} 
		var j = elements.length; 
		while(--j >= 0){
			current = elements[j]; 
			match = false; 
			for(var k=0, kl=patterns.length; k<kl; k++){ 
				match = patterns[k].test(current.className); 
				if (!match) break; 
			}
			if(match) result.push(current); 
		}
		return result; 
	} 
}



//通过id获取dom
function $(o){
	if(typeof o=="object") return o;
	return document.getElementById(o);
}



/**
	目的：兼容IE8。解决IE8不支持getElementsByClassName
	通过类名来获取一组元素的方法
	有三个参数，第一个参数必须要有表示类名，后两个参数可选
	第二个ele是限定的范围，如果没有ele这个参数，则表示在整个文档的范围内返回所有的类名是className的元素
	第三个参数是限定的标签名，表示取到此类名的元素的标签名必须是此参数传进来的名
*/
function getElementsByClassName(className,ele,tagName){//通过类名获取元素，后两可参数是可选的
	var a=[];//用来存筛选用来的元素
	var eles=null;
	if(ele) {//如果指定了第二个参数，就是限定了获取元素的范围
		if(tagName){//如果指定了第三个参数 就是限定了标记名
			eles=ele.getElementsByTagName(tagName);
		}else{
			eles=ele.getElementsByTagName('*');
		}
	}else{ //如果没有传后两个参数
		eles=document.getElementsByTagName('*');//则在所有的元素中做遍历
	}
	
	var reg_exp=new RegExp("\\b" + className + "\\b");
	for(var i=0;i<eles.length;i++){
		if(eles[i].className.search(reg_exp)!=-1){//用正则表达式来判断是不是包含此类名
			a.push(eles.item(i));	//如果满足条件，则存到数组里
		}
	}
	return a;
}


/** 返回创建的dom元素
* 只有第一个参数是必须的。
* 其余2个参数可选。
*/
function createElement(tag, json, innerHTML){
	var json=json||{};
	var dom=document.createElement(tag);
	
	if(json!=undefined){
		for(var key in json){
			dom.setAttribute(key,json[key]);
		}
	}
	
	if(innerHTML!=undefined){
		dom.innerHTML=innerHTML;
	}
	return dom;
}

//去除字符串首尾空格
function trim(str){ //删除左右两端的空格
	return str.replace(/(^\s*)|(\s*$)/g, "");
}
function ltrim(str){ //删除左边的空格
	return str.replace(/(^\s*)/g,"");
}
function rtrim(str){ //删除右边的空格
	return str.replace(/(\s*$)/g,"");
}



/**
* js回到页面顶部，缓动效果
* version 1.0
* @param acceleration 速度
* @param stime 时间间隔 (毫秒)
**/
function gotoTop(acceleration,stime) {
	var acceleration = acceleration || 0.05,
		stime = stime || 10,
		pos=getXY(),
		x=pos[0],
		y=pos[1];
	
	// 滚动距离 = 目前距离 / 速度, 因为距离原来越小, 速度是大于 1 的数, 所以滚动距离会越来越小
	var speeding = 1 + acceleration;
	window.scrollTo(Math.floor(x / speeding), Math.floor(y / speeding));
  
   // 如果距离不为零, 继续调用函数
	var timer=setTimeout(function(){
		if(x > 0 || y > 0) {
			gotoTop(acceleration,stime);
		}		
	}, stime);
	
	//tool fn:获得当前视图所在位置[x,y]
	function getXY(){
		var x1 = 0;
		var y1 = 0;
		var x2 = 0;
		var y2 = 0;
		var x3 = 0;
		var y3 = 0;
		if (document.documentElement) {
		   x1 = document.documentElement.scrollLeft || 0;
		   y1 = document.documentElement.scrollTop || 0;
		}
		if (document.body) {
		   x2 = document.body.scrollLeft || 0;
		   y2 = document.body.scrollTop || 0;
		}
		var x3 = window.scrollX || 0;
		var y3 = window.scrollY || 0;

		// 滚动条到页面顶部的水平距离
		var x = Math.max(x1, Math.max(x2, x3));
		// 滚动条到页面顶部的垂直距离
		var y = Math.max(y1, Math.max(y2, y3));
		return [x,y];
	}
}//end of gotoTop.



//给obj增加事件的自定义函数：兼容IE/chrome/ff
function addEvent(obj,ev,fn){
	if(obj.addEventListener){
		//ff:addEventListener
		obj.addEventListener(ev,fn,false);
	}else{
		//IE:attachEvent
		obj.attachEvent('on'+ev,fn);
	}
}
/*
实例：
addEvent(oBtn,'click',function(){
		alert('c');
	});
*/


//获得中文人类友好时间格式
function getHumanDate(date){
	var weekCN=["日", "一", "二", "三", "四", "五", "六"];
	var nDate=date || new Date();
	var dateStamp = 
	nDate.getFullYear() + '年' +
	(nDate.getMonth()+1) + '月' + 
	nDate.getDate() + '日' + 
	" 星期"+ weekCN[nDate.getDay()] + ' '+
	nDate.toString().substring(16,24);
	return dateStamp;
}
//console.log( getHumanDate() );  



//绑定事件
addEvent(window, 'load', function(){
	//右上角添加时间
	//如果太窄，则不显示。
	var clientWidth=document.documentElement.clientWidth;
	//console.log(clientWidth)
	//if(1 || clientWidth>1270){
	//var oWeek=createElement('div',{'style':'float:right; line-height:30px; color:#ccc;'},getHumanDate())
	var oWeek=createElement('div',{'style':'float:right; line-height:30px; color:#ccc;','id':'topTime'},getHumanDate())
	var oNav=document.getElementsByClassName('nav')[0];
	oNav.appendChild(oWeek);
	//}
});

