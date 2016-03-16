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

> 插件生效：菜单栏File -> Setting -> Languages & Frameworks -> Symfony选项下：勾选enable plugin for this project。修改前两行的app为var。

  
1.自动命名空间，使用settings-directories.[NO]




<br>
<br>
<br>
<br>
===============

# 学习怎么使用phpstorm10
http://knpuniversity.com/screencast/phpstorm



## 1.设置：
如何打开：菜单 File->setting；
快捷键：ctrl+alt+S;

### 1.1设置主题  
可以在 appearance 设置主题，推荐使用更漂亮更护眼的主题。

### 1.2设置字体   
搜索font，找到如何设置字体大小(editor->colors & fonts->font)。注意：改变之前先另存为主题，再修改字体。
	也可以修改行间距line spacing.


	
	

## 2.在编辑器包含或者不包含文件夹
右击文件夹->mark directory as->excluded.
点击project files就可以看到所有结果。
点击project就可以看到隐藏后的文件结构。

## 3.安装插件
在设置中选plugins，点击下面的的browse repositories，然后输入需要的插件的名字，右边有install 按钮。

推荐安装 symfony plugin，对sf很有用。
另一个php annotations，也很好用。

## 4.注释annotation
右击src文件夹，选择mark directory as -> source Root.
展开src文件夹，展开AppBundle，展开Controller，看到DefaultController.php.
右击Controller文件夹，选择new->php class，在name中输入UserController，确定。

```
    /**
     * @Route("/show")
     */
    function show(){
        return new Response("this is the show user method.");
    }
```  

注意：输入注释/**回车就生成注释框架，删除其他注释，只留下 * @，然后接着写Rou差不多就出现提示了，使用上下箭头选择合适的提示，回车或tab就完成了use的自动添加。

注释中一定要用双引号！




## 5.查看源码
按住ctrl键，鼠标单击注释中的Route，就可以打开Route类。




## 6.模板twig
展开/app/Resources/views，右击views，新建文件夹user。
右击user文件夹，新建文件new.html.twig
```
{% extends 'base.html.twig' %}

{% block body %}
    <h1>new user page</h1>

{% endblock %}
```




然后在src/AppBundel/Controller/UserController.php中添加：

```
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
    /**
     * @Route("/user/new",name="edit_user")   
	 * //这里一定要用双引号！
     */
    function new2Action(){
        return $this->render("user/new.html.twig",array());
    }
```







### 向模板传递参数：
```
在控制器中写参数id：
    /**
     * @Route("/user/new",name="edit_user")
     * //这里一定要用双引号！
     */
    function new2Action(){
        return $this->render("user/new.html.twig",array(
            'id'=>'a001'
        ));
    }
在模板中引用：
{% extends 'base.html.twig' %}

{% block body %}
    <h1>new user page</h1>
    {{ id }}
{% endblock %}
```

运行symfony的server：`$ php bin/console server:run`

浏览器访问：http://localhost:8000/user/new
即可看到输出：
new user page
a001








### 模板中使用过滤器

模板中：

```
{% extends 'base.html.twig' %}

{% block body %}
    <h1>new user page</h1>
    <p>{{ id }}
    <p>{{ id | upper }}
    <p>{{ 'now'|date }}
    <p>today is {{ 'now'|date("Y-m-d H:i:s") }}
{% endblock %}
```

访问时显示：
new user page
a001
A001
March 14, 2016 17:37
today is 2016-03-14 17:37:35

想查看某个过滤器的具体实现，请按住ctrl键，并单击过滤器（比如upper）。



### 快速建立form表单
在app/Resources/views/user/下建立文件_form.html.twig，然后输入form，接着按tab健，即可生成<form action=""></form>

```
<form action="" method="POST">
    User Name: <input type="text" name="username" /><br>
    Email: <input type="text" name="email" /><br>
    <button type="submit">Save</button>
</form>

在其他页面中引用该表单：
    {{ include("user/_form.html.twig") }}
```




## 7.命名空间namespace  

	1. 菜单 file - settings，输入 directories，搜索;
	1. 点击左侧的Project:myApp 下的 Directories；
	1. 点击中间一列的 src文件夹，点击顶部的mark as: sources；
	1. 点击右侧的src右侧的很小的p字母，添加Package prefix；
	1. 再次在src/controller/下新建php类时，出现了含有前缀的命名空间 `miostudio\AppBundle\Controller`。




**自动命名空间的添加**

	- 但是我们一般不需要添加前缀，只需要定义src为source文件夹即可。
	- 我们单击src/AppBundel，新建文件夹Entity，右击建立php class文件Movie.php，发现成功自动添加的命名空间 namespace AppBundle\Entity;
	- 当我们回到src/Controller时，在某个控制器方法中写 `$movie=new Movie();` ，phpstorm会自动在顶部添加命名空间`use AppBundle\Entity\Movie;`。  




**手动添加命名空间**
	- 如果某些原因没有自动添加命名空间，则可以手动添加。
	- 光标移动到 `$movie=new Movie();` 的Move上，然后 `Alt + Enter`即可手动添加命名空间。







