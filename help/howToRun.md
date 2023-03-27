# 部署到本地(基于 php 5.6)
在 docker 中测试过，参考镜像： https://hub.docker.com/r/dawneve/php  
在 win10/win11 测试过。  
下文是 win 上的部署，其他环境请自行摸索。


## 1.下载并安装xampp
使用bing搜索 xampp，下载 php 5.6 最新子版本，比如：
```
https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/5.6.33/
强烈建议安装到某磁盘根目录，比如 G:/xampp/
否则目录层次过多，以后使用极其不便！
```


## 2.在本机 host 文件设置虚拟域名

使用管理员权限打开 C:\Windows\System32\drivers\etc\hosts，末尾添加一行: IP地址 虚拟域名，比如：

`127.0.0.1 blog.dawneve.cc`

IP是固定格式，后面的域名随便取名，看着像个域名即可。




## 3.在apache中设置虚拟域名指向的文件夹

在 G:\xampp\apache\conf\extra\httpd-vhosts.conf 末尾添加几行:

```
<VirtualHost *:80>
    ServerAdmin webmaster@dummy-host2.example.com
    DocumentRoot "G:/xampp/htdocs/txtBlog"
    ServerName blog.dawneve.cc
	ServerAlias blog.m.biomooc.com blog.biomooc.com
    ErrorLog "logs/blog.com-error.log"
    CustomLog "logs/blog.com-access.log" common
</VirtualHost>
```

主要是两项：
- ServerName 设置域名，和 hosts 中的一致即可
- DocumentRoot 设置文件夹，就是要访问的网站的原文件
- 其他日志、别名等不重要，甚至可以省略。


## 4.下载本博客代码
下载博客代码，解压后放到 G:/xampp/htdocs/txtBlog/。 

- 直接从github下载解压
- 或者在上一级文件中git clone克隆代码:
	* 需要提前安装 git：https://git-scm.com/downloads
	* 然后在 G:/xampp/htdocs/ 目录空白处右击，选择 git bash，执行命令:
	* `$ git clone https://github.com/dawneve/txtBlog.git`


## 5.重启apache服务

双击 G:\xampp\xampp-control.exe，控制面板就会出现在windows的右下角托盘中。

双击托盘图标，呼出xampp控制面板，单击第一行 apache 对应的 Start，稍等，如没有报错信息，就是web服务器启动正常。

在浏览器输入 blog.dawneve.cc 即可访问本博客系统。

执行顺序：输入 域名 回车，到host找IP，发现是本机，问apache该域名对应的文件夹，apache解析该文件夹。









# 部署到阿里云虚拟主机(2018.11.7)

1.先把blog二级域名解析到空间，再绑定到阿里云空间  
2.子域名指向子目录：在根目录htdocs下创建文件.htaccess，内容如下。  

```
RewriteEngine On
RewriteBase /
# 绑定 blog.applymed.cn 到子目录 txtBlog
RewriteCond %{HTTP_HOST} ^blog.applymed.cn$ [NC]
RewriteCond %{REQUEST_URI} !^/txtBlog/
RewriteRule ^(.*)$ /txtBlog/$1 [L,QSA]
#可以绑定多个，只需要重复以上三行代码，并更改一下域名、目录名 就好了
```

3.折腾了半天无法显示，最后发现是缓存实现不了。先注释掉index.php中的两行缓存后，一切正常显示了。  
4.网址： http://blog.applymed.cn/ [域名已过期]
