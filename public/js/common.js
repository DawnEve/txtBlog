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


//创建新dom
function createElement(tag, json, innerHTML){
	var json=json||{};
	var dom=document.createElement(tag);
	
	for(var key in json){
		dom.setAttribute(key,json[key]);
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

