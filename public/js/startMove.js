/* startMove.js 
* name: 完美运动框架
* version: v0.2
* version: v0.3 修正flag标签的位置
* 注释: https://github.com/race616/startmove/blob/master/startMove.js
*/

//获取行内和非行内样式的封装函数
function getStyle(obj,attr){
	if (obj.currentStyle) {
		return obj.currentStyle[attr];
	}
	else{
		return getComputedStyle(obj,false)[attr];
	}
}

function startMove(obj,json,fn){
	clearInterval(obj.timer);
	obj.timer = setInterval(function(){
		var flag = true;
		for(var attr in json){
			// 1.取当前的值
			var iCur = 0;
			if(attr == 'opacity'){
				iCur = Math.round(parseFloat(getStyle(obj,attr))*100);
			}else{
				iCur = parseInt(getStyle(obj,attr));//parseInt()过滤掉px这个单位
			}
			// 2.算速度
			var iSpeed = (json[attr]-iCur)/8;//每一次定时器代码运行时，属性的一个变化量，这个值渐变，实现缓冲效果
			//iSpeed < 0,iSpeed为负值，也是无限接近于0，此时仍然向上取整，会取到0，无法达到目标值，将iSpeed变成-1
			iSpeed = iSpeed>0?Math.ceil(iSpeed):Math.floor(iSpeed);

			// 3.检测停止
			if(iCur != json[attr]){  //只要有没达到的 flag==false
				flag = false;
			}

			if (attr == 'opacity') {
				obj.style.filter = 'alpha(opacity:'+(iCur + iSpeed)+')';
				obj.style.opacity = (iCur+iSpeed)/100;
			}else{
				obj.style[attr] = iCur + iSpeed + 'px';
			}
			
		}

		if (flag) {
			clearInterval(obj.timer);
			if (fn) {
				fn();
			}
		}

	},30)
}