txtBlog v0.4.1
===============================
	-- A simple yet powerful php blog system for reading and organizing txt files. 

目的：建立一个能组织和阅读txt文件的博客系统。  

![image](public\images\screenShot0.4.6.jpg)


用户方面：  
	1.单用户自用博客；其他人可以浏览。  
交互：  
	2.评论有待开发。前期采用多说。  
数据存储：  
	3.不用mysql，基于文件系统。目录用文件保存，采用array格式。  
		图片：  
		文本编辑器：  
		样式表：支持几种基本设置：标题、正文、段落、图片、代码、强调、  
		支持txt文本简单解析  
		markdown格式解析和样式表  
		
UI布局：  
	4.顶部是自定义关键词（如js、php等），  
		左边是自定义菜单；  
		[todo]支持二级菜单；  
		右边是正文；  

系统架构：  
	5.采用MVC；  
	6.要扩展性强：可以自动生成应用目录、管理多个记事本【未实现】  
	7.目录结构清晰。  

兼容性：  
	8.主流浏览器（PC端的chrome/IE9，移动端UC、腾讯浏览器）  

优化：  
	9.全站缓存60s。  
	

事故：2016-4-13之后，80端口被封，该网站变成了局域网。  
		怎么能突破局域网的限制？  
		- 花生壳？  
	
	
``````
添加$ git remote add origin git@github.com:DawnEve/txtBlog.git
首次$ git push -u origin master
推送$ git push origin master

合并$ git merge --no-ff -m'some comments' otherBranch
``````



参考资料：  
footer效果：https://flowplayer.org/  
http://www.zixue.it/phpvideo  
footer鲜活：http://www.iisp.com/ztview/ID_18392.html  
