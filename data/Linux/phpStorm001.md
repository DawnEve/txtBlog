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



## 1.设置  
如何打开：菜单 File->setting；
快捷键：ctrl+alt+S;

#### 设置主题  
可以在 appearance 设置主题，推荐使用更漂亮更护眼的主题。

#### 设置字体   
搜索font，找到如何设置字体大小(editor->colors & fonts->font)。注意：改变之前先另存为主题，再修改字体。
	也可以修改行间距line spacing.


#### 在编辑器包含或者不包含文件夹
右击文件夹->mark directory as->excluded.
点击project files就可以看到所有结果。
点击project就可以看到隐藏后的文件结构。

#### 安装插件
在设置中选plugins，点击下面的的browse repositories，然后输入需要的插件的名字，右边有install 按钮。

推荐安装 symfony plugin，对sf很有用。
另一个php annotations，也很好用。
	
	








## 2.注释annotation
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




### 查看源码
按住ctrl键，鼠标单击注释中的Route，就可以打开Route类。










## 3.模板twig
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








## 4.命名空间namespace  

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

	
**自动补齐链接路径**  
	- 在控制器的方法前注释中写路由，注意要带上name：`@Route("/user/show",name="user_list")`
	- 在twig模板中协商路径引用：`<a href="{{ path('user_list') }}">back</a>`
	- 这样就不用担心方法名字和路径的改变了，只要路由名字不变，模板中的路径就会正常生成。




	
	
	
## 5.ORM系统 doctrine  
	- 选择src/AppBundle/Entity/Movie.php，鼠标放到class Movie{}的大括号之间；  
	- 自动生成：菜单 code - Generate[Alt + Insert]
	- 可以输入字母快速选择，比如orm  
	- 选择ORM class
```
自动生成注释信息
/**
 * @Doctrine\ORM\Mapping\Entity
 * @Doctrine\ORM\Mapping\Table(name="movie")
 */	
 class Movie
{
}
```	

	- 顶部写use，复制注释第一行@后面的部分，删除注释，结果如下：
```
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping  as ORM;

class Movie
{
}
```

	- 光标放到{}内，快捷键[alt + insert]，选择 orm class， 重新生成注释 
```
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping  as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="movie")
 */
class Movie
{
}
```

	- 在类中输入一些变量  
```
class Movie
{
    private $id;

    private $title;

    private $rating;

    private $year;

    private $isDirector;
}
```

	- 然后光标置入，快捷键[alt + insert]，选择 orm annotation，弹窗中全选，自动生成注释：
```
class Movie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $rating;

    /**
     * @ORM\Column(type="string")
     */
    private $year;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDirector;
}
```
	- 有自动生成，比如id自动为auto，is开头的自动定义为boolean。对于不满意的类型如rating，手动修改。光标在type的双引号内，按下[alt + space]自动弹出所有类型。


	- 设置getter：光标置入并按快捷键[alt + insert]，选getter，选id，自动生成。
	- 设置setter：光标置入并按快捷键[alt + insert]，选择getters and setters，选择其余全部，自动生成。
```
对于getter和setter的注释是无用的，如果想去掉模板中的注释，
请选择 菜单 file - settings，输入 templates，
左侧选择Editor - Code Style - File and Code Templates，
中间选择Code选项卡中的PHP Getter Method，
右侧是代码，可以删除注释。
```


	- 光标放到{}内，快捷键[alter + enter]，选择唯一的Add Doctrine Repository选项，可以看到顶部的注释多了一个()，`* @ORM\Entity(repositoryClass="MovieRepository")` ， 同时src/AppBundel/Entity目录中多了一个文件MovieRepository.php。我们手动建立一个和Entity同级文件夹Repository，拖动MovieRepository.php到该文件夹中。修改顶部命名空间为 namespace AppBundle\Repository;
	- 再回到Movie.php文件中，发现 ` * @ORM\Entity(repositoryClass="MovieRepository")`提示说 missing Repository class.删除后重写Movie,然后[ctrl + space]，选择，最终的类注释为：
```
/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MovieRepository")
 * @ORM\Table(name="movie")
 */
```









## 6.表单 Forms  

原作者的mac系统，使用了 command+N新建表单并生成代码。
Linux目前没找到对应的快捷键。本节暂停。

后续还找到了bootstrap的模板，整个就好看很多。








## 7.（从重复劳动中解放）实时模板 Live Templates   
	- 选择一段代码；
	- 菜单 tools - Save as Live Template，输入名字formAdd和描述，确定；
	- 在代码中就可以使用这个模板了。输入formAdd，按下[ctrl+space]，自动补齐这一段代码；
	
**设置模板变量**
	- 菜单 file - settings， 搜索 live template ；
	- 右侧选择刚才添加的代码，可以修改变量，变量格式： $模板变量$；
	- 然后在自动补齐代码后，光标自动跳到这些模板变量上，tab键跳转到下一个模板变量；







## 8.快速导航 Fast Navigating  

	- 导航到类：菜单 Navigate - Class,[ctrl + N] ，输入类名，回车   
	- 导航到配置文件：菜单Navigate - File[ctrl + shit + N]，输入 config.yml，回车  
		+ 比如想找bootstrap模板在哪里，就输入bootstrap，然后下拉框找即可，文件很深！！！ 
		+ 顶部有文件路径，单击可以看到下拉框子文件列表，双击则可以看到左侧文件树展开了。  
	- 导航到标志symbol:菜单Navigate - Symbol[ctrl+shift+alt+N]，然后输入formBuilder即可查看方法来源；
	

**常用快捷键**
	- 双击shift：搜索任何地方  
	- ctrl+shift+N: 搜索文件  
	- ctrl+E: 最近的文档
	- alt+Home: 导航栏顶部


**都可以在快捷键后输入字母，继续缩小范围**












## 9.重构 Refactoring  

**如果两段代码相同，则应该考虑重构成函数**  
	- 选择相同代码中的一行 菜单 Refactor - Refactor This[ctrl + alt + Shift +T];  
	- 选择重构成方法：


**还可以把方法放到父类中，但是private修饰符就变成了protected**
	- 需要时再复习。

**代码格式化**  
	- 如果感觉代码格式不统一，可以选中代码，使用菜单命令 Code - Reformat Code。
	
	


	
	
	
## 10.服务的快捷方式 service-shortcuts
	注册服务。
	
	
## 11.自己常用功能(Ubuntu下使用)

### 显示本类的成员变量和成员函数
View—>Tool Windows—>Structure[alt+7]
然后如果看不到项目文件结构，快捷键[alt+1]



### NetBeans   sublime  vim 选吧。 我现在用这三个。
NetBeans追代码 读代码用(NetBeans 很占用CPU，启动100% )
sublime 临时修改东西用
vim 开发机上用。工作敲代码









