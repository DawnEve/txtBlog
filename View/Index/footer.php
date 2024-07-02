<style>
.ewm{float:right; margin: -40px 10px;}
.ewm img{ width: 100px;}
.ewm p{ text-align:center;}


.footer .fade b{color:#ddd;}
</style>


<div class='footer'>
	<a name='footer'></a>
	<div class=wrap>
		<div class='fade'>
			
	<?php //友情链接


		//计算机技术类============================工具类
		$links_IT_tools=array(
			//api手册
			array('http://www.runoob.com/','菜鸟教程网'),
			array('https://www.coonote.com/','菜鸟笔记'),
			array('http://www.codebaoku.com/','编程宝库','编程宝库！'),
			array('https://www.twle.cn/','简单教程网','提供md编辑器'),
			array('http://jsbin.com/','jsbin','练习前端的好工具！'),
			array('https://tool.lu/','在线工具'),

			array('http://jquery.cuishifeng.cn/','jQuery手册'),
			array('http://css.cuishifeng.cn/','css手册'),

			array('http://www.w3school.com.cn/','w3school'),
			array('http://www.shouce.ren/api/index','在线手册下载'),
			array('http://tool.chinaz.com/tools/jsformat.aspx','html/js格式化','代码美化'),
			//
			array('https://iconarchive.com/tag/google-chrome','icon'),
			array('https://icon-icons.com/search/icons/?filtro=cplusplus&sort=popular','icon2'),
			array('https://excalidraw.com/','手绘流程图'),
			
			array('http://mioweb.biomooc.com/','miostudio'),
		);
		echo '<br /><b>友情链接[IT Tools]</b>: ';
		print_links($links_IT_tools);
		
		
		//计算机技术类============================后端资料类
		$links_Back=array(
			// Linux/shell 
			array('http://mingxinglai.com/','Linux命令博客','赖明星，网易/腾讯db工程师(厦门大学数据库实验室林子雨老师的学生http://dblab.xmu.edu.cn/)'),
			array('https://www.junmajinlong.com/','Linux/Mysql/Perl'),
			array("http://www.zsythink.net/archives/tag/awk/",'linux/awk等','运维 朱双印个人日志'),

			array('http://nginx.org/en/docs/','Nginx'),
			
			//PHP
			array('https://www.laruence.com/jscss','laruence 风雪之隅', 'PHP8核心开发者'),
			array('https://soulteary.com/about/','苏洋博客', '系统、互联网'),
			//array('http://www.imeixue.cn/','每学网'),// 韩顺平的作品？ 打不开了
			array('http://php.net/','PHP'),
			array('http://www.blogdaren.com/','php博客花园'),
			//array('http://gaodc.com/','8年php高东臣博客'), //域名过期
			
			
			//sql
			array('http://www.sqlite.org/','sqlite'),

			//C++
			array('https://normaluhr.github.io/2020/12/31/Effective-C++/','Effective C++读书笔记'),
			
			//Java
			array('https://github.com/itwanger/toBeBetterJavaer','toBeBetterJavaer'),
			array('http://cmsblogs.com/?page_id=488','cmsblogs(Java)'),

			//高阶技能
			array('https://colobu.com/about/','鸟窝(blog)','在微博 做架构和开发工作'),
			array('https://github.com/leohxj/a-programmer-prepares','程序员的自我修养'),
			array('https://www.qtmuniao.com/about/','青藤木鸟(分布式)'),
			
			
			array('http://fex.baidu.com/ueditor/#start-config','uEditor','百度富文本编辑器'),
			array("https://www.shiyanlou.com/",'实验楼','第一家以实验为核心的IT在线教育平台'),
		);
		echo '<br /><b>后端资料</b>: ';
		print_links($links_Back);

		
		//计算机技术类============================前端资料类
		$links_Front=array(
			//前端名人
			array('http://www.zhangxinxu.com/','张鑫旭', '腾讯ISUX。欢迎与我一同交流web前端方面的东西！'),
			array('http://www.ruanyifeng.com/','阮一峰','Alipay.com as an Node/JavaScript engineer.'),
			array('http://www.liaoxuefeng.com/','廖雪峰'),
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
			
			//前端技术 js
			array('http://www.cnblogs.com/ljchow/archive/2010/06/09/1754352.html','js动画原理'),
			array('http://www.css88.com/archives/1706','前端js'),
			array('http://aibusy.com/','爱前端js'),


			//切图 网页设计
			array('http://www.uimaker.com/member/reg_new.php','UI制造者'),
			array('http://www.qietu.com/','切图网'),

			array('http://www.shejipi.com/','设计癖'),
			array('http://www.shejidaren.com/free-bootstrap-ui-kits.html','设计达人'),
			//array('http://code.csdn.net/news/2819417','25个前端框架'),//404 2019.7
			//array('http://www.w3cfuns.com/article-1306-1.html','响应式布局'), //关停2019.7

			//导航
			array('http://f2er.club/','醉牛前端导航'),
			array('http://caibaojian.com/links','前端网址导航'),
		);
		echo '<br /><b>前端技术</b>: ';
		print_links($links_Front);
		
		
		// 视频资源类
		$links_video=array(
			array("https://www.bilibili.com/",'bilibili'),
			array("https://www.imooc.com/",'慕课网'),
			array('https://study.163.com/','网易云课堂'),
			array("http://ninghao.net/",'宁皓网','React，Bootstrap，Laravel 视频教程'),
			
			array('http://edu.ibeifeng.com/list-index-is_key-is_new.html','北风网'),
			
			array('https://www.ted.com/','TED视频'),
		);
		echo '<br /><b>视频</b>: ';
		print_links($links_video);
		
		echo '<br /><b>数学</b>: ';
		print_links(array(
			array('http://3d-genome.life/','李程3D基因组(多元回归/贝叶斯/)'),
			array('https://blog.csdn.net/hpdlzu80100/category_7468916.html','数学笔记(高数/线代/统计/)'), //https://blog.csdn.net/hpdlzu80100
			array('https://face2ai.com/Math-Probability-5-5-The-Negative-Binomial-Distribution/','谭升(统计/书list)'),
			array('https://qinqianshan.com/math/probability_distribution/','SAM NOTE(统计等)'),
			array('https://www.cnblogs.com/pinard/category/894690.html','刘建平Pinard(数据挖掘等)'),
		));



		echo '<br /><b>ML/AI</b>: ';
		print_links(array(	
			array('http://freemind.pluskid.org/','张驰原pluskid(ML/AI)'),
			array('https://blog.csdn.net/v_july_v/article/details/7624837','july(ML/AI)'),
			array('http://blog.17study.com.cn/','月色(ML/AI)'),
			array('https://mofanpy.com/','莫烦'),
		));




		echo '<br /><b>生信</b>: ';
		print_links(array(
			array('https://www.math.pku.edu.cn/teachers/lidf/docs/Rbook/html/_Rbook/markdown.html','北大R语言教程'),
			array('http://www.bioinfo-scrounger.com/','生信笔记'),
			array('https://www.cnblogs.com/leezx/tag/单细胞/','单细胞'),
			array('https://divingintogeneticsandgenomics.rbind.io/#publications','Ming Tang(scATAC)'),
			array('https://life2cloud.com/cn/2018/11/pipelines-styles/','李剑峰(生信流程)'),
			
			array('http://blog.shenwei.me/about/','shenwei(微生物)'),
			array('http://www.dengfeilong.com/post/aboutUs.html','邓飞龙(微生物)'),
			array('http://kaopubear.top/','Fei Zhao(bioinfo)'),
			array('https://liulab-dfci.github.io/teaching','liulab'), //X Shirley Liu
			array('http://www.dzbioinformatics.com/','HiC'), //南京师范大学生命科学学院在读博士2020.12 戴早, 前列腺癌、生物信息学、分子动力学和量化计算
			array('http://www.wuchangsong.com/','ATAC'), //
			array('http://www.chenlianfu.com/','生信培训'), //陈连福的生信博客
			array('https://github.com/YutingPKU','刘玉婷的GitHub'), //北大刘程组学生，包括ChIP-seq/RNA-seq/Hi-C数据处理的脚本
			array('http://www.biotrainee.com:8081/jmzeng/book/basic/','曾健明的笔记'),
			array('http://blog.biochen.com/about','陈雯(lincRNA)'),
			array('https://github.com/xuzhougeng/myscripts/blob/master/igv_web.py','徐洲更(生信脚本)'), //其中 igv那个值得学习 
			//array('',''),
		));
?>


<?php if($web_status==1){?>
<script type="text/javascript">
var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1257823738'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/stat.php%3Fid%3D1257823738%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
</script>
<?php }?>
			
		</div>
		
		
		<div class=ewm><img src='public/images/erweima.png'><p>扫码关注</p></div>
		
		
		<div class='links'>
			Copyright &copy; 2009 - <?php echo date('Y',time()); ?> DawnEve. All Rights Reserved. | 
			<a class=red target='_blank' href='https://github.com/DawnEve/txtBlog'>Folk me on Github</a> | 
			<a href='index.php?k=Git&id=0_2'>Contact me</a> | 
			<a target='_blank' href='http://pan.baidu.com/s/1i3imHpF' title='密码:qa53'>web tools</a>
		</div>

		
		<div class='small fade'>
			♥ Do have faith in what you're doing. 
			[<?php echo date('Y-m-d H:i:s',time());?>] 
			Powered by <a target='_blank' href='https://github.com/DawnEve/txtBlog' title='txtBlog(A simple yet powerful php blog system for reading and organizing txt files.)'>txtBLog 
			v0.6.6
			</a>
			
			
			
			<!-- 浏览计数器: 异步 -->
			<a target="_blank" href="http://stuff.mit.edu/doc/counter-howto.html" id='viewCounter'>
				<!-- <img src="https://stuff.mit.edu/cgi/counter/txtBlog"> -->
			</a>
			

			
		</div>
	</div>
</div>



<div class="foot_top">
	<a href="#" id="to_top" onclick='gotoTop();return false;'>返回顶部</a>
	<a href="#footer" id="to_top">下到底部</a>
</div>









</body>
</html>