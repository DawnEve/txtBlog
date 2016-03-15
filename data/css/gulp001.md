Gulp start up
=====================

## 为什么使用gulp？  

当下的wap开发不仅仅是html+css+js，还有less、coffeeScript等。
要运行，就需要从开发到生产的转化，这是很重复的东西。可以使用自动化工具来完成。  

Less等格式良好，但是用户并不需要这些注释和格式，只要运行良好即可。转化成css文件更好。
  
- 重复工作：  
	+ 预处理语言的编译；  
	+ js css html 压缩混淆  
	+ 图片体积优化  
	
- 除了gulp之外，还有一些类似的自动化工具，比如grunt、webpack。
	使用上、效率上gulp更优！  

## 安装gulp  

- gulp官网：http://www.gulpjs.com.cn/，	用自动化构建工具增强你的工作流程！  

- 安装node.js
	+ node.js给前端掀起了一场工业革命。  
	+ 如果访问失败，请使用http://npm.taobao.org（这是一个完整 npmjs.org 镜像），该页面有怎么使用的命令：$ npm install -g cnpm --registry=https://registry.npm.taobao.org
	+ 安装完使用命令行工具(cmd、PowerShell、git等)测试版本号 node -v，版本号为v4.3.1，测试npm版本号npm -v，2.14.12
	+ npm3以前的版本文件依赖是层级依赖，npm3以后的依赖关系改为平行依赖；
- 安装 gulp 命令行工具
	+ npm -install -g gulp 
	+ 其中-g参数，指定全局安装
	+ 测试是否安装成功：gulp -v，输出CLI version 3.9.1 
	
- 翻墙：vpn、lantern


## 使用gulp  
- 初始化gulp项目
	+ 在网站根目录建立文件夹gulp_demo
	+ 命令行进入该目录，输入npm init，然后一路回车确认，该目录中产生一个package.json文件。
	+ 除了全局安装，还要本地安装一次，npm install gulp --save，参数save是保存到json文件；
	+ 可见在gulp_demo中又多了一个node_modules文件夹，其下gulp/node_modules/中是依赖的包；
	
- 建立并运行第一个任务
	+ 建立文件 gulp_demo/gulpfile.js，这个名字是固定的！文件内容如下：
			
		```
		'use strict';

		//载入gulp核心包
		const gulp = require('gulp');

		//gulp是用来执行一些重复性操作的，
		//一般我们将这些重复性操作划分为不同的任务

		//如何定义一个任务
		//第一个参数是任务，第二个参数是任务的执行体

		gulp.task('hello',function(){
			console.log('hello world, gulp!'); 
			//这里编写一些重复性的流程
		});

		//使用命令行运行任务
		```


	+ 使用命令行进入该文件夹，运行命令名：gulp hello，回车输出：
			
		```
		Jimmy@Jimmy-PC MINGW32 /c/xampp/htdocs/gulp_demo
		$ gulp hello
		[20:00:31] Using gulpfile C:\xampp\htdocs\gulp_demo\gulpfile.js
		[20:00:31] Starting 'hello'...
		hello world, gulp!
		[20:00:31] Finished 'hello' after 88 μs
		```

我们注意到，已经输出了'hello world, gulp!'






## gulp基础API
	
- gulp原生API一共四个：.src .pipe .watch .dest，其他则是第三方插件提供功能。  

- 最简单的是拷贝任务，比如，把一个文件从src/index.html拷贝到dest目录，在刚才的gulpfile.js文件夹后面接着写：

```
// 拷贝文件 任务
gulp.task('dest',function(){
	//获取文件
	gulp.src('src/index.html').pipe(gulp.dest('dist/'));
	//基本就是照着.pipe().pie()...，构成了一个流水线。
});
```


 - 把所有html文件从src拷贝到dest目录，只需要使用*.html通配符即可：

```
// 拷贝文件 任务
gulp.task('dest',function(){
	//获取文件
	gulp.src('src/*.html').pipe(gulp.dest('dist/'));
	//基本就是照着.pipe().pipe()...，构成了一个流水线。
});
```


- 把所有文件都从src拷贝到dest目录，则使用*.*通配符。
	- 但是这样是取不到子目录中的文件的，使用*/*.*即可。
	- 上述通配符只能统配一级目录，如果目录超过一级怎么办？使用\*\*/\*.\*，在gulp中2个\*表示递归目录。
	
- 更多的[globs正则匹配语法](https://github.com/isaacs/node-glob)，参考其Glob Primer部分。
	+ src/\*
	+ src/\*/\*
	+ src/\*\*/\*
	+ src/\*.jpg
	+ src/\*.{jpg|png}
	+ 多个globs可以使用数组：
		* ['src/\*.{jpg,png}', 'a/a.html']
	+ 排除语句： !demo.html 
	
- 默认任务是名字为default的任务，运行时直接输入gulp即可运行。

```
// 默认任务
gulp.task('default',function(){
	console.log('hello world, from default!');
});
```





## watch命令：监视文件是否变化，如果变化，则自动执行任务

```
// 默认任务
gulp.task('default',function(){
	console.log('hello world, from default!');
	//当src目录的文件发生变化时，自动执行后面的任务
	gulp.watch('src/*', ['dest']);
});
```

- 使用命令行执行gulp后，命令并没有立刻结束，在src/下的文件发生修改时会继续自动执行。









## 第三方插件
1. 编译less文件  
	+ 先定义src/style.less文件:
	
		```
		@baseColor:#f40;
		body{
			background-color:@baseColor;
			div{
				height:100px;   /*some comment*/
			}
		}	
		```

	+ 接着安装less转css的gulp插件：npm install gulp-less --save
		使用说明在https://www.npmjs.com/package/gulp-less
	+ 在gulpfile.js中写任务：
	
		```
		//载入less模块
		var less=require('gulp-less');
		// 把less编译成css文件
		gulp.task('style',function(){
			gulp.src('src/**/*.less')
				.pipe(less())  //让less转换为css
				.pipe(gulp.dest('dist/'));
		});
		```

	+ 运行该任务：gulp style，随后可见在dist/css/style.css文件。
	
		```
		body {
		  background-color: #f40;
		}
		body div {
		  height: 100px;
		  /*some comment*/
		}
		```




2. 自动化监视less文件  
	+ 继续向gulpfile.js中添加任务：
	
		```
		// 监视less文件
		gulp.task('watch', function(){
			gulp.watch('src/**/*.less',['style']);
		});
		```

	+ 然后命令行启动该任务：gulp watch
	+ 然后修改less文件的时候，dist中就立刻编译；

	+ 这样使用less才爽！
	
3. 小结：如何使用gulp插件？
	+ 首先有一个需求；
	+ 然后是大npmjs.org或github上搜索相关包； 
	+ 根据官方地址和基本使用方法做demo练习；
	+ 详细看API。

	+ 常用插件
		* 编译 Less: gulp-less  
		* 编译 Jade: gulp-jade  
		* 创建本地服务器：[gulp-commect](https://www.npmjs.com/package/gulp-connect)
		* 实时预览
		* 合并文件：[gulp-concat](https://www.npmjs.com/package/gulp-concat)
		* 最小化 js 文件：[gulp-uglify](https://www.npmjs.com/package/gulp-uglify)
		* 重命名文件：[gulp-rename](https://www.npmjs.com/package/gulp-rename)
		* 最小化 css 文件：[gulp-minify-css](https://www.npmjs.com/package/gulp-minify-css)
		* 压缩 html 文件：[gulp-minify-html](https://www.npmjs.com/package/gulp-minify-html)
		* 最小化图像：[gulp-imagemin](https://www.npmjs.com/package/gulp-imagemin)
	
4. 另一个插件实例：gulp-connect创建本地服务器
- 安装模块npm install gulp-connect --save--dev  
- 在gulpfile.js中继续写任务：

```
var connect = require('gulp-connect');

gulp.task('connect', function() {
  connect.server({
    root: 'app',
    livereload: true
  });
});

gulp.task('html', function () {
  gulp.src('./app/*.html')
    .pipe(connect.reload());
});

gulp.task('watch', function () {
  gulp.watch(['./app/*.html'], ['html']);
});

gulp.task('default', ['connect', 'watch']);
```

- 建立app/index.html文件，随便写内容；
- 运行该任务：gulp，输出文字提示可以访问的地址：http://localhost:8080
- 访问该地址，可见该文件的内容。说明服务器正常启动！
- 但是，更新index.html文件内容后，只有命令行在变化，网页没更新！！（暂时没找到原因）


> the end. Also at: http://miostudio.blog.163.com/blog/static/220765129201611784748444/
