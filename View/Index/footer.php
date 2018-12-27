<style>
.ewm{float:right; margin: -40px 10px;}
.ewm img{ width: 100px;}
.ewm p{ text-align:center;}

</style>


<div class='footer'>
	<a name='footer'></a>
	<div class=wrap>
		<div class='fade'>
			
	<?php //友情链接


		//计算机技术类============================工具类
		$links_IT_tools=array(
			//api手册
			array('http://jsbin.com/','jsbin','练习前端的好工具！'),
			array('http://jquery.cuishifeng.cn/','jQuery手册'),

			array('http://www.runoob.com/','菜鸟教程网'),
			array('http://www.w3school.com.cn/','w3school'),
			array('http://mioweb.biomooc.com/','miostudio'),
			array('http://php.net/','PHP'),
			array('http://www.sqlite.org/','sqlite'),
			array('http://nginx.org/en/docs/','Nginx'),
			array('http://fex.baidu.com/ueditor/#start-config','uEditor','百度富文本编辑器'),
			//
			array('http://aibusy.com/blog/?p=226','Sublime插件'),
		);
		echo '<br />友情链接[IT Tools]: ';
		print_links($links_IT_tools);
		
		
		//计算机技术类============================后端资料类
		$links_Back=array(
			array('http://mingxinglai.com/','Linux命令博客','赖明星，网易/腾讯db工程师(厦门大学数据库实验室林子雨老师的学生http://dblab.xmu.edu.cn/)'),
			array('http://www.imeixue.cn/','每学网'),// 韩顺平的作品？
			array('http://www.css88.com/archives/1706','前端'),

			array('http://www.shejipi.com/12931.html','设计癖'),
			array('http://www.w3cfuns.com/article-1306-1.html','响应式布局'),
			array('http://code.csdn.net/news/2819417','25个前端框架'),
			array('http://aibusy.com/course_list.html','前端大纲'),
			array('http://www.cnblogs.com/ljchow/archive/2010/06/09/1754352.html','js动画原理'),
			array('http://www.blogdaren.com/','php博客花园'),
			//array('http://gaodc.com/','8年php高东臣博客'),
			array('http://www.shouce.ren/api/index','在线手册下载'),
			array('http://cmsblogs.com/?page_id=488','cmsblogs(Java)'),
		);
		echo '<br />后端资料: ';
		print_links($links_Back);
		
		//计算机技术类============================前端资料类
		$links_Front=array(
			//前端名人
			array('http://www.ruanyifeng.com/','阮一峰','Alipay.com as an Node/JavaScript engineer.'),
			array('http://www.liaoxuefeng.com/','廖雪峰'),
			array('http://www.zhangxinxu.com/','张鑫旭', '腾讯ISUX。欢迎与我一同交流web前端方面的东西！'),
			array('http://rapheal.sinaapp.com/about/','拉风博客', '腾讯广州研发部，微信产品部门'),
			array('http://www.cnblogs.com/jikey/p/4426105.html','豪情的博客', '高级qq群'),
			array('http://www.nowamagic.net/','简明现代魔法','其实每个程序员都是魔法师'),
			array('http://www.ycku.com/course/','李炎恢','瓢城Web俱乐部'),
			array('http://bonsaiden.github.io/JavaScript-Garden/zh/#function.closures','js秘密花园'),
			array('http://www.bootcss.com/','bootstrap'),

			array('http://www.bluesdream.com/blog/','BlueDream','前端博客'),
			array('http://ideazhao.com/', '灵感的小窝','生活琐碎、前端杂谈、诗情画意、随心笔记'),
			// array('http://www.dyike.com/index.php/aboutme', '一刻笔记','生活琐碎、前端杂谈、诗情画意、随心笔记'),
			
			//前端团队博客 
			array("http://fequan.com/",'前端圈'),
			array("http://www.75team.com/",'齐舞团'),
			//array("http://f2e.im/",'F2E'),
			array("http://www.html-js.com/",'前端乱炖'),
			array("https://www.shiyanlou.com/",'实验楼','第一家以实验为核心的IT在线教育平台'),
			
			//
			//array("http://www.w3.org/",'W3C'),
			//array("http://www.w3ctech.com/",'w3ctech'),
			//array("http://www.w3cplus.com/",'w3cplus'),
			array('http://web.jobbole.com/85160/','伯乐在线'),
			array('https://www.v2ex.com/', 'v2ex', 'V2EX 是一个关于分享和探索的地方。创意工作者们的社区'),
			array('http://tool.oschina.net/apidocs', 'API手册', 'oschina编程API手册'),
			array('http://stackoverflow.com/','StackOverflow'),
			array('http://segmentfault.com/','SegmentFault', '中文编程问答'),
			array('http://www.kancloud.cn/explore','看云文档'),
			
			//切图
			array('http://www.uimaker.com/member/reg_new.php','UI制造者'),
			array('http://www.qietu.com/','切图网'),

			array('http://www.shejidaren.com/free-bootstrap-ui-kits.html','设计达人'),
		);
		echo '<br />前端技术: ';
		print_links($links_Front);
		
		
		// 视频资源类
		$links_video=array(
			array("http://www.imooc.com/",'慕课网'),
			array('http://study.163.com/','网易云课堂'),
			array("http://ninghao.net/",'宁皓网','React，Bootstrap，Laravel 视频教程'),
			
			array('http://edu.ibeifeng.com/list-index-is_key-is_new.html','北风网'),
			
			array('https://www.ted.com/','TED视频'),
		);
		echo '<br />视频: ';
		print_links($links_video);
		
		echo '<br />生物信息学: ';
		print_links(array(
			array('http://www.bioinfo-scrounger.com/','生信笔记'),
			array('http://blog.shenwei.me/about/','shenwei的生信博客'),
			//array('',''),
		));
?>		
			

			<br />导航:			
			<a href="http://f2er.club/" target="blank">醉牛前端导航</a> | 
			<a href="http://caibaojian.com/links" target="blank">前端网址导航</a> |

<?php if($web_status==1){?>
<script type="text/javascript">
var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1257823738'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/stat.php%3Fid%3D1257823738%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
</script>
<?php }?>
			
		</div>
		
		
		<div class=ewm><img src='public/images/erweima.png'><p>扫码登陆本站</p></div>
		
		
		<div class='links'>
			Copyright &copy; 2009 - 2018 DawnEve. All Rights Reserved. | 
			<a target='_blank' href='https://github.com/DawnEve'>Folk me on Github</a> | 
			<a class=red href='index.php?k=Git&id=0_2'>Contact me</a> | 
			<a target='_blank' href='http://pan.baidu.com/s/1i3imHpF' title='密码:qa53'>web tools</a>
		</div>

		
		<div class='small fade'>
			♥ Do have faith in what you're doing. 
			[<?php echo date('Y-m-d H:i:s',time());?>] 
			Powered by <a target='_blank' href='https://github.com/DawnEve/txtBlog' title='txtBlog(A simple yet powerful php blog system for reading and organizing txt files.)'>txtBLog v0.4</a>
		</div>
	</div>
</div>



<div class="foot_top">
	<a href="#" id="to_top" onclick='gotoTop();return false;'>返回顶部</a>
	<a href="#footer" id="to_top">下到底部</a>
</div>









</body>
</html>