txtBlog v0.6
===============================
	-- A simple yet powerful blog system for reading and organizing txt files based on PHP. 

## 目的：建立一个能组织和阅读txt文件的博客系统，用于管理知识。  


每周至少提交一个 commit: 
- 扫盲：不会的知识点
- 总结：整理会的知识点，条理化
- 交叉融合：新示例、新应用场景
- 用输出倒逼输入，让成长有迹可循。



![screenShot0.4.6](./public/images/screenShot0.4.6.jpg)


## 用户方面：  
	1.单用户自用博客；其他人可以浏览。  
	
## 交互：  
	2.评论有待开发。前期采用多说。  
	
## 数据存储：  
	3.不用mysql，基于文件系统。目录用文件保存，采用array格式。  
		图片：  
		文本编辑器：  
		样式表：支持几种基本设置：标题、正文、段落、图片、代码、强调、  
		支持txt文本简单解析、自动生成标题  
		markdown格式解析和样式表，代码自动高亮，自动生成标题，左下角目录响应滚轮
		[v6.2.8-2]为txt添加左下角目录，响应滚轮;		
		
## UI布局：  
	4.顶部是自定义关键词（如js、php等），  
		左边是自定义菜单；  
		[todo]支持二级菜单；  
		右边是正文；  

## 系统架构：  
	5.采用MVC；  
	6.要扩展性强：可以自动生成应用目录、管理多个记事本【未实现】  
	7.目录结构清晰。  

## 兼容性：  
	8.主流浏览器（PC端的chrome，移动端UC、腾讯浏览器）  

## 优化：  
	9.全站缓存60s。 已取消缓存，没有并发压力，没必要缓存; 
	
## 
#


## 事故：
	2016-4-13之后，80端口被封，该网站变成了局域网。  
		怎么能突破局域网的限制？  
		- 花生壳？ 


## How to run? 如何运行？
[如何部署?](help/howToRun.md)






## 参考资料：  
Markdown解析器: [HyperDown](https://github.com/SegmentFault/HyperDown)  
代码高亮: [highlight.js](https://github.com/andris9/highlight)  


``````
添加$ git remote add origin git@github.com:DawnEve/txtBlog.git
首次$ git push -u origin master

$ git branch
$ git checkout master
合并$ git merge --no-ff -m'some comments' otherBranch
推送$ git push origin master



除了默认控制器，还有其他控制器：
/index.php?c=outline&k=php&id=1_1  php的大纲
/index.php?c=summary&k=2015 年度总结
/index.php?c=summary&k=2020 年度总结
/index.php?c=summary&k=2021 年度总结
/index.php?c=summary&k=2022 年度总结
``````
