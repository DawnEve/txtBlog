joyfull development with symfony
==================================

本文基于linux系统（ubuntu 14.04），使用phpstorm 10开发。

已经配置好php环境，其实sf会自动配置环境。

## 下载和安装symfony  
http://symfony.com/download#

```
$ sudo curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony
$ sudo chmod a+x /usr/local/bin/symfony
```

Move the downloaded file to your projects directory and execute it as php symfony.
移动下载文件到工程目录(译者注：ubuntu下不用移动)，执行`php symfony`

创建工程：
```
$ symfony new myApp  


 Downloading Symfony...
    4.97 MB/4.97 MB ▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓  100%
 Preparing project...

 ✕  Symfony 3.0.3 was successfully installed but your system doesn't meet its
     technical requirements! Fix the following issues before executing
     your Symfony application:

 * date.timezone setting must be set
   > Set the "date.timezone" setting in php.ini* (like Europe/Paris).

 After fixing these issues, re-check Symfony requirements executing this command:

   php myApp/bin/symfony_requirements

 Then, you can:

    * Change your current directory to /home/wjl/PhpstormProjects/myApp

    * Configure your application in app/config/parameters.yml file.

    * Run your application:
        1. Execute the php bin/console server:run command.
        2. Browse to the http://localhost:8000 URL.

    * Read the documentation at http://symfony.com/doc


```



设置/etc/php5/cli/php.ini中的`date.timezone=PRC`之后，运行检查：  

```
$ php myApp/bin/symfony_requirements 

Symfony Requirements Checker
~~~~-~~~~~~~~~~~~-~~~~~~~~~~~~

> PHP is using the following php.ini file:
  /etc/php5/cli/php.ini

> Checking Symfony requirements:
  .............................W.......

                                              
 [OK]                                         
 Your system is ready to run Symfony projects 
                                              

Optional recommendations to improve your setup
~~~~~~~-~~~~~~~~~~~~~~~-~~~~~~~~~~~~~~-~~~~~~~~~~

 * intl extension should be available
   > Install and enable the intl extension (used for validators).


Note  The command console could use a different php.ini file
~~-~~  than the one used with your web server. To be on the
      safe side, please check the requirements from your web
      server using the web/config.php script.
```



系统提示建议安装intl扩展：
```
$ sudo apt-get install php5-intl
```
安装结束后会自动重启php5-fpm。




再次尝试运行检查：
```
$ php myApp/bin/symfony_requirements 

Symfony Requirements Checker
~~~~-~~~~~~~~~~~~~~~-~~~~~~~~~

> PHP is using the following php.ini file:
  /etc/php5/cli/php.ini

> Checking Symfony requirements:
  ......-..............-...........-.........

                                              
 [OK]                                         
 Your system is ready to run Symfony projects 
                                              

Note  The command console could use a different php.ini file
~~-~~  than the one used with your web server. To be on the
      safe side, please check the requirements from your web
      server using the web/config.php script.
```









## 启动sf
进入目录myApp，启动sf：  
```
$ php bin/console server:run  
                                       
 [OK] Server running on http://127.0.0.1:8000   
 // Quit the server with CONTROL-C.
```

浏览器访问 http://127.0.0.1:8000，可以看到sf的欢迎界面：
```
Welcome to
Symfony 3.0.3

Your application is now ready. You can start working on it at: /home/wjl/PhpstormProjects/myApp/

What's next?

Read the documentation to learn
How to create your first page in Symfony http://symfony.com/doc/3.0/book/page_creation.html
```
页面底部是一些debug工具。以后会很常用的！  



然后开始用git跟踪项目吧
```
$git init
$git add .
$git commit -m'start up sf, with ubuntu and phpstorm'
```








## 第一个页面

注意src（所有php文件）和app（其他文件）文件夹。


自动填充namespace：
phpstorm中右击src，选择mark directory as -> source root.

自动创建类：
右击src/AppBundle/Controller，选择new->php class.









