安装phpstorm
===================


## 安装java

`$ sudo apt-get install openjdk-7-jdk`

测试是否安装成功:

```
$ java -version
java version "1.7.0_95"
OpenJDK Runtime Environment (IcedTea 2.6.4) (7u95-2.6.4-0ubuntu0.14.04.1)
OpenJDK 64-Bit Server VM (build 24.95-b01, mixed mode)
```

显示版本号，表明安装成功。





## 下载并解压phpStorm(Lightning-smart PHP IDE)
先从官网下载 https://www.jetbrains.com/phpstorm/，解压
```
$ cd ~
$ wget https://download.jetbrains.com/webide/PhpStorm-10.0.3.tar.gz
$ tar -xzvf PhpStorm-10.0.3.tar.gz  

$ cd PhpStorm-143.1770/

$ ./bin/phpstorm.sh
```







## phpstorm可以写出很长的命名空间  
英文视频：[Lean and Mean Dev with PhpStorm (for Symfony)](http://knpuniversity.com/screencast/phpstorm)  

	- Get the life-changing Symfony plugin
	- Auto-complete namespaces (please stop typing them)!
	- Tricks for annotations, Doctrine, forms, Twig and more
	- Refactoring
	- Live Templates
	- Fast navigation
	- Symfony service integration
	- .... (and always) well-intentioned jokes.


### 第一课  
关键词：UI升级、项目管理、插件




### 快捷键 

https://www.jetbrains.com/phpstorm/help/keyboard-shortcuts-you-cannot-miss.html

```
phpstorm 说明书：
https://www.jetbrains.com/phpstorm/help/quick-start-guide.html
https://confluence.jetbrains.com/display/PhpStorm/Tutorials
```
 - ctrl+Q 查看相关文档。
 
 



## 激活服务器

http://www.gowhich.com/blog/714

IntelliJ IDEA开源社区 提供了如下通用激活方法：
注册时选择License server
然后输入框填写：http://idea.lanyus.com/
然后点击 OK，就搞定了。

JetBrains注册码计算： idea.lanyus.com/









## the PhpStorm Symfony Plugin |sf插件
To get really crazy, you'll want to install the amazing, incredible Symfony plugin. This thing makes Symfony development so absurdly fun, I'm going to walk you through its installation right now.

http://blog.aboutc.net/php/41/phpstorm-install-markdown-plugin

> 菜单栏 File -> Setting -> Plugins -> Browse repositories...（在底部），输入symfony。


In Preferences, search for Symfony and click the plugins option. From here, click 'Browse Repositories` and then find the Symfony Plugin. You'll recognize it as the one with over 1.3 million downloads.

安装完毕，重启 PhpStorm，插件即可生效。

> 插件生效：菜单栏File -> Setting -> Languages & Frameworks -> Symfony选项下：勾选enable plugin for this project。






















