nginx服务器快速入门
=====================

```
测试环境：ubuntu 14.04
nginx版本：nginx/1.9.12
```


	
[官网下载站](http://www.nginx.org/),  [官网商业站](https://www.nginx.com/),  [官网docs](http://nginx.org/en/docs/), 

[中文手册](http://www.nginx.cn/doc/index.html), [nginx how to](http://www.nginx.cn/nginx-how-to)

[官方英文新手指南](http://nginx.org/en/docs/beginners_guide.html)


> Nginx 是一个很强大的高性能Web和反向代理服务器，它具有很多非常优越的特性：在高连接并发的情况下，Nginx是Apache服务器不错的替代品，感谢Nginx为我们选择了 epoll and kqueue作为开发模型。


相信很多人都听过nginx，这个小巧的东西慢慢地在吞食apache和IIS的份额。那究竟它有什么作用呢？可能很多人未必了解。

说到反向代理，可能很多人都听说，但具体什么是反向代理，很多人估计就不清楚了。摘一段百度百科上的描述：

http://cxshun.iteye.com/blog/1535188


> 反向代理（Reverse Proxy）方式是指以代理服务器来接受internet上的连接请求，然后将请求转发给内部网络上的服务器，并将从服务器上得到的结果返回给internet上请求连接的客户端，此时代理服务器对外就表现为一个服务器。  











# 为什么选择Nginx

Nginx 是一个高性能的 Web 和反向代理服务器, 它具有有很多非常优越的特性:

**作为 Web 服务器**：相比 Apache，Nginx 使用更少的资源，支持更多的并发连接，体现更高的效率，这点使 Nginx 尤其受到虚拟主机提供商的欢迎。能够支持高达 50,000 个并发连接数的响应，感谢 Nginx 为我们选择了 epoll and kqueue 作为开发模型.

**作为负载均衡服务器**：Nginx 既可以在内部直接支持 Rails 和 PHP，也可以支持作为 HTTP代理服务器 对外进行服务。Nginx 用 C 编写, 不论是系统资源开销还是 CPU 使用效率都比 Perlbal 要好的多。

**作为邮件代理服务器**: Nginx 同时也是一个非常优秀的邮件代理服务器（最早开发这个产品的目的之一也是作为邮件代理服务器），Last.fm 描述了成功并且美妙的使用经验。

**Nginx 安装非常的简单，配置文件 非常简洁（还能够支持perl语法），Bugs非常少的服务器**: Nginx 启动特别容易，并且几乎可以做到7*24不间断运行，即使运行数个月也不需要重新启动。你还能够在 不间断服务的情况下进行软件版本的升级。


# 安装 
正式开始前，编译环境gcc g++ 开发库之类的需要提前装好，这里默认你已经装好。

ububtu平台编译环境可以使用以下指令
```
apt-get install build-essential
apt-get install libtool
```

### 1.下载源代码 
http://nginx.org/en/download.html

`$ wget http://nginx.org/download/nginx-1.9.12.tar.gz`
-rw-rw-r--  1 wjl  wjl  899183  2月 24 23:01 nginx-1.9.12.tar.gz
只有899kb。

### 2.解压缩并尝试安装
```
$ tar -xzvf nginx-1.9.12.tar.gz
$ cd nginx-1.9.12/
$  ./configure
```

报错：提示缺少 PCRE 模块。
./configure: error: the HTTP rewrite module requires the PCRE library.
You can either disable the module by using --without-http_rewrite_module
option, or install the PCRE library into the system, or build the PCRE library
statically from the source with nginx by using --with-pcre=<path> option.






### 3.安装依赖的程序  
http://www.nginx.cn/install 中提到“一般我们都需要先装 [PCRE](http://www.pcre.org/), zlib，前者为了重写rewrite，后者为了gzip压缩。”


> 建议用root模式。或者命令前面加上sudo。


```
1).选定源码目录
可以是任何目录，本文选定的是/usr/local/src

cd /usr/local/src

2).安装PCRE库(PCRE - Perl Compatible Regular Expressions)
ftp://ftp.csx.cam.ac.uk/pub/software/programming/pcre/ 下载最新的 PCRE 源码包，使用下面命令下载编译和安装 PCRE 包：

cd /usr/local/src
# wget ftp://ftp.csx.cam.ac.uk/pub/software/programming/pcre/pcre-8.34.tar.gz  版本不存在  
# wget ftp://ftp.csx.cam.ac.uk/pub/software/programming/pcre/pcre2-10.20.tar.gz	高版本不识别  
wget ftp://ftp.csx.cam.ac.uk/pub/software/programming/pcre/pcre-8.37.tar.gz
tar -zxvf pcre-8.37.tar.gz
cd pcre-8.37
./configure
make
make install


(make之前输出)
pcre-8.37 configuration summary:

    Install prefix .................. : /usr/local
    C preprocessor .................. : gcc -E
    C compiler ...................... : gcc
    C++ preprocessor ................ : g++ -E
    C++ compiler .................... : g++
    Linker .......................... : /usr/bin/ld -m elf_x86_64
    C preprocessor flags ............ : 
    C compiler flags ................ : -g -O2 -fvisibility=hidden
    C++ compiler flags .............. : -O2 -fvisibility=hidden -fvisibility-inlines-hidden
    Linker flags .................... : 
    Extra libraries ................. : 

    Build 8 bit pcre library ........ : yes
    Build 16 bit pcre library ....... : no
    Build 32 bit pcre library ....... : no
    Build C++ library ............... : yes
    Enable JIT compiling support .... : no
    Enable UTF-8/16/32 support ...... : no
    Unicode properties .............. : no
    Newline char/sequence ........... : lf
    \R matches only ANYCRLF ......... : no
    EBCDIC coding ................... : no
    EBCDIC code for NL .............. : n/a
    Rebuild char tables ............. : no
    Use stack recursion ............. : yes
    POSIX mem threshold ............. : 10
    Internal link size .............. : 2
    Nested parentheses limit ........ : 250
    Match limit ..................... : 10000000
    Match limit recursion ........... : MATCH_LIMIT
    Build shared libs ............... : yes
    Build static libs ............... : yes
    Use JIT in pcregrep ............. : no
    Buffer size for pcregrep ........ : 20480
    Link pcregrep with libz ......... : no
    Link pcregrep with libbz2 ....... : no
    Link pcretest with libedit ...... : no
    Link pcretest with libreadline .. : no
    Valgrind support ................ : no
    Code coverage ................... : no


(make install 时输出)
----------------------------------------------------------------------
Libraries have been installed in:
   /usr/local/lib

If you ever happen to want to link against installed libraries
in a given directory, LIBDIR, you must either use libtool, and
specify the full pathname of the library, or use the '-LLIBDIR'
flag during linking and do at least one of the following:
   - add LIBDIR to the 'LD_LIBRARY_PATH' environment variable
     during execution
   - add LIBDIR to the 'LD_RUN_PATH' environment variable
     during linking
   - use the '-Wl,-rpath -Wl,LIBDIR' linker flag
   - have your system administrator add LIBDIR to '/etc/ld.so.conf'

See any operating system documentation about shared libraries for
more information, such as the ld(1) and ld.so(8) manual pages.
----------------------------------------------------------------------


3).安装zlib库
http://zlib.net/zlib-1.2.8.tar.gz 下载最新的 zlib 源码包，使用下面命令下载编译和安装 zlib包：

cd /usr/local/src
wget http://zlib.net/zlib-1.2.8.tar.gz
tar -zxvf zlib-1.2.8.tar.gz
cd zlib-1.2.8
./configure
make
make install

4).安装ssl（某些vps默认没装ssl)

cd /usr/local/src
wget http://www.openssl.org/source/openssl-1.0.1c.tar.gz
tar -zxvf openssl-1.0.1c.tar.gz


cd openssl-1.0.1c/
./Configure
./config   

显示 Configured for linux-x86_64.


make	时间很长  
make install 	报错  


检测版本号
# openssl version
OpenSSL 1.0.1f 6 Jan 2014
```











### 4.安装nginx    

再次回到nginx目录  *(下面为了展示需要写在多行，执行时内容需要在同一行)* ：
```
sudo ./configure 
	--sbin-path=/usr/local/nginx/nginx --conf-path=/usr/local/nginx/nginx.conf  
	--pid-path=/usr/local/nginx/nginx.pid  --with-http_ssl_module  
	--with-pcre=/usr/local/src/pcre-8.37  --with-zlib=/usr/local/src/zlib-1.2.8  
	--with-openssl=/usr/local/src/openssl-1.0.1c


最后输出：
Configuration summary
  + using PCRE library: /usr/local/src/pcre-8.37
  + using OpenSSL library: /usr/local/src/openssl-1.0.1c
  + md5: using OpenSSL library
  + sha1: using OpenSSL library
  + using zlib library: /usr/local/src/zlib-1.2.8

  nginx path prefix: "/usr/local/nginx"
  nginx binary file: "/usr/local/nginx/nginx"
  nginx modules path: "/usr/local/nginx/modules"
  nginx configuration prefix: "/usr/local/nginx"
  nginx configuration file: "/usr/local/nginx/nginx.conf"
  nginx pid file: "/usr/local/nginx/nginx.pid"
  nginx error log file: "/usr/local/nginx/logs/error.log"
  nginx http access log file: "/usr/local/nginx/logs/access.log"
  nginx http client request body temporary files: "client_body_temp"
  nginx http proxy temporary files: "proxy_temp"
  nginx http fastcgi temporary files: "fastcgi_temp"
  nginx http uwsgi temporary files: "uwsgi_temp"
  nginx http scgi temporary files: "scgi_temp"




（而原来直接执行 ./configure 结果如下：）
Configuration summary
  + using system PCRE library
  + OpenSSL library is not used
  + using builtin md5 code
  + sha1 library is not found
  + using system zlib library

  nginx path prefix: "/usr/local/nginx"
  nginx binary file: "/usr/local/nginx/sbin/nginx"
  nginx modules path: "/usr/local/nginx/modules"
  nginx configuration prefix: "/usr/local/nginx/conf"
  nginx configuration file: "/usr/local/nginx/conf/nginx.conf"
  nginx pid file: "/usr/local/nginx/logs/nginx.pid"
  nginx error log file: "/usr/local/nginx/logs/error.log"
  nginx http access log file: "/usr/local/nginx/logs/access.log"
  nginx http client request body temporary files: "client_body_temp"
  nginx http proxy temporary files: "proxy_temp"
  nginx http fastcgi temporary files: "fastcgi_temp"
  nginx http uwsgi temporary files: "uwsgi_temp"
  nginx http scgi temporary files: "scgi_temp"
并且找不到/usr/local/nginx文件夹。


接着:
sudo make  
sudo make install  
```

--with-pcre=/usr/src/pcre-8.37 指的是pcre-8.37 的源码路径。

--with-zlib=/usr/src/zlib-1.2.7 指的是zlib-1.2.7 的源码路径。

装成功后 /usr/local/nginx 目录下如下:
```
root@wjl-VirtualBox:/usr/local/nginx# ls
fastcgi.conf            koi-win             nginx.conf.default
fastcgi.conf.default    logs                scgi_params
fastcgi_params          mime.types          scgi_params.default
fastcgi_params.default  mime.types.default  uwsgi_params
html                    nginx               uwsgi_params.default
koi-utf                 nginx.conf          win-utf
```







### 5.启动nginx   
确保系统的 80 端口没被其他程序占用，运行/usr/local/nginx/nginx 命令来启动 Nginx，
`netstat -ano|grep 80`

有结果则可能是有一个http服务在运行，先停止掉：
`service httpd stop`


如果查不到结果后执行（ubuntu下必须用sudo启动，不然只能在前台运行）
`sudo /usr/local/nginx/nginx`




再次查看端口号，发现多了一个：
```
wjl@wjl-VirtualBox:~$ netstat -ano|grep 80
tcp        0      0 0.0.0.0:80              0.0.0.0:*               LISTEN      off (0.00/0/0)
```

打开浏览器访问此机器的 IP（使用ifconfig命令查看），如果浏览器出现 Welcome to nginx! 则表示 Nginx 已经安装并运行成功。
```
Welcome to nginx!

If you see this page, the nginx web server is successfully installed and working. Further configuration is required.

For online documentation and support please refer to nginx.org.
Commercial support is available at nginx.com.

Thank you for using nginx.
```

到这里nginx就安装完成了，如果只是处理静态html就不用继续安装了。
	/usr/local/nginx/nginx.conf 主配置文件  
	/usr/local/nginx/html 目录下就是nginx静态文件目录  
	/usr/local/nginx/logs 目录下是日志文件    
	

如果你需要处理php脚本的话，还需要 [安装php-fpm](http://www.nginx.cn/231.html)。




### 6.使用ab工具测试nginx性能

如果没有安装ab，先安装: `$ sudo apt-get install apache2-utils`


使用ab工具测试本地服务器每秒最大负载：
```
$ ab -n10000 -c1 http://127.0.0.1/

...
Requests per second:    5887.30 [#/sec] (mean)
...
```




### 7.停止nginx


另一个查找端口的命令：
```
wjl@wjl-VirtualBox:~$ netstat -tupln | grep 80
(Not all processes could be identified, non-owned process info
 will not be shown, you would have to be root to see it all.)
tcp        0      0 0.0.0.0:80              0.0.0.0:*               LISTEN      -               
```



通过ps命令，查找nginx的pid号是22997:  
```
root@wjl-VirtualBox:/usr/local/nginx# ps aux | grep nginx
root     22997  0.0  0.0  22552   716 ?        Ss   16:39   0:00 nginx: master process /usr/local/nginx/nginx
nobody   22998  0.0  0.1  22992  1420 ?        S    16:39   0:00 nginx: worker process 
wjl      23069  0.1 10.6 733304 94876 ?        Sl   16:56   0:02 /usr/lib/firefox/firefox /usr/local/nginx/html/50x.html
wjl      23162  0.1  2.4 699300 21684 ?        Sl   16:58   0:02 gedit /usr/local/nginx/nginx.conf
root     23972  0.0  0.1  15944   948 pts/14   S+   17:20   0:00 grep --color=auto nginx
```


关掉nginx进程：
```
kill -s QUIT 22997  
```


### 8.添加快捷方式（软/硬链接[?]）
```
$ sudo ln -s /usr/local/nginx/nginx /usr/bin/nginx
```
这将会大大简化命令。不用路径再加上 `./nginx` 了，可以直接在任何目录使用 `nginx`。


测试链接效果：
```  
$ nginx -h
nginx version: nginx/1.9.12
Usage: nginx [-?hvVtTq] [-s signal] [-c filename] [-p prefix] [-g directives]

Options:
  -?,-h         : this help
  -v            : show version and exit
  -V            : show version and configure options then exit
  -t            : test configuration and exit
  -T            : test configuration, dump it and exit
  -q            : suppress non-error messages during configuration testing
  -s signal     : send signal to a master process: stop, quit, reopen, reload
  -p prefix     : set prefix path (default: /usr/local/nginx/)
  -c filename   : set configuration file (default: /usr/local/nginx/nginx.conf)
  -g directives : set global directives out of configuration file
```

  









<br>
<br>
<br>
<br>
------------

# nginx配置  
http://nginx.org/en/docs/beginners_guide.html

配置文件位置 /usr/local/nginx/nginx.conf，我们接下来将要修改它。  


### 配置文件：  


```
#user  nobody;
worker_processes  1;  #表示工作进程的数量，一般设置为cpu的核数

#error_log  logs/error.log;
#error_log  logs/error.log  notice;
#error_log  logs/error.log  info;

#pid        logs/nginx.pid;


events {
    worker_connections  1024; # 表示每个工作进程的最大连接数
}


http {
    include       mime.types;
    default_type  application/octet-stream;

    #log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
    #                  '$status $body_bytes_sent "$http_referer" '
    #                  '"$http_user_agent" "$http_x_forwarded_for"';

    #access_log  logs/access.log  main;

    sendfile        on;
    #tcp_nopush     on;

    #keepalive_timeout  0;
    keepalive_timeout  65;

    #gzip  on;

    server {  # 块定义了虚拟主机
        listen       80;  # 监听端口
        server_name  localhost; #监听域名

        #charset koi8-r;

        #access_log  logs/host.access.log  main;

        location / {  
			# 是用来为匹配的 URI 进行配置，URI 即语法中的“/uri/”。
			# location  / { }匹配任何查询，因为所有请求都以 / 开头。
            root   html; # 指定对应uri的资源查找路径，这里html为相对路径，完整路径为/usr/local/nginx/html/   
            index  index.html index.htm; # 指定首页index文件的名称，可以配置多个，以空格分开。如有多个，按配置顺序查找。
        }

        #error_page  404              /404.html;

        # redirect server error pages to the static page /50x.html
        #
        error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root   html;
        }

        # proxy the PHP scripts to Apache listening on 127.0.0.1:80
        #
        #location ~ \.php$ {
        #    proxy_pass   http://127.0.0.1;
        #}

        # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
        #
        #location ~ \.php$ {
        #    root           html;
        #    fastcgi_pass   127.0.0.1:9000;
        #    fastcgi_index  index.php;
        #    fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
        #    include        fastcgi_params;
        #}

        # deny access to .htaccess files, if Apache's document root
        # concurs with nginx's one
        #
        #location ~ /\.ht {
        #    deny  all;
        #}
    }


    # another virtual host using mix of IP-, name-, and port-based configuration
    #
    #server {
    #    listen       8000;
    #    listen       somename:8080;
    #    server_name  somename  alias  another.alias;

    #    location / {
    #        root   html;
    #        index  index.html index.htm;
    #    }
    #}


    # HTTPS server
    #
    #server {
    #    listen       443 ssl;
    #    server_name  localhost;

    #    ssl_certificate      cert.pem;
    #    ssl_certificate_key  cert.key;

    #    ssl_session_cache    shared:SSL:1m;
    #    ssl_session_timeout  5m;

    #    ssl_ciphers  HIGH:!aNULL:!MD5;
    #    ssl_prefer_server_ciphers  on;

    #    location / {
    #        root   html;
    #        index  index.html index.htm;
    #    }
    #}

}
```


### 1.静态服务器及常用功能  
文件放到 nginx/html 目录下，nginx就是一个静态web服务器了。  
也可调整目录位置：

启动和停止：`nginx -s signal`，其中signal可以是以下其中之一：
	- stop — fast shutdown
	- quit — graceful shutdown(This command should be executed under the same user that started nginx.)
	- reload — reloading the configuration file(修改配置文件后需要重启nginx)
	- reopen — reopening the log files







### 2.代理服务器 
```
 server {
        listen       80;
        server_name  localhost;

        #charset koi8-r;

        #access_log  logs/host.access.log  main;

        location / {
            root   html;
            index  index.html index.htm; 
        }
		
		#这里增加一个代理服务器：
        location /images/ {
            proxy_pass http://192.168.1.100; #可以加上端口号
			# proxy_pass http://192.168.1.100:8080;
        }
```
注意格式：/和{之间要有空格，语句以;结尾。

然后重启nginx服务器： `# ./nginx -s reload`，使新的配置生效。

访问 `http://192.168.1.177/images/`时，nginx服务器就从http://192.168.1.100获取数据，然后显示给浏览器。相当于是个中间贩子。




还可以使用更复杂的正则表达式：
```
location ~ \.(gif|jpg|png)$ {
    root /data/images;
}
```
The parameter is a regular expression matching all URIs ending with .gif, .jpg, or .png. A regular expression should be preceded with ~. The corresponding requests will be mapped to the /data/images directory.
参数是一个正则表达式，匹配所有以.gif, .jpg, .png结尾的URI。正则表达式要以~开头。响应的请求可以被映射到/data/images目录。


There are many more directives that may be used to further configure a proxy connection.
还有更多进一步配置 [代理连接的指令](http://nginx.org/en/docs/http/ngx_http_proxy_module.html)。








<br>
<br>
<br>
<br>
------------

### 3.nginx运行php    
http://www.nginx.cn/231.html
http://nginx.org/en/docs/beginners_guide.html


nginx can be used to route requests to FastCGI servers which run applications built with various frameworks and programming languages such as PHP.
nginx可以用于路由请求到用多种框架和编程语言比如php建立起应用的FastCGI服务器。


The most basic nginx configuration to work with a FastCGI server includes using the fastcgi_pass directive instead of the proxy_pass directive, and fastcgi_param directives to set parameters passed to a FastCGI server. Suppose the FastCGI server is accessible on localhost:9000. Taking the proxy configuration from the previous section as a basis, replace the proxy_pass directive with the fastcgi_pass directive and change the parameter to localhost:9000. In PHP, the SCRIPT_FILENAME parameter is used for determining the script name, and the QUERY_STRING parameter is used to pass request parameters. The resulting configuration would be:
最基本的能用于FastCGI服务器的nginx配置包括：使用 [fastcgi_pass](http://nginx.org/en/docs/http/ngx_http_fastcgi_module.html#fastcgi_pass) 指令代替 proxy_pass 指令，使用 [fastcgi_param](http://nginx.org/en/docs/http/ngx_http_fastcgi_module.html#fastcgi_param) 执行设置一系列传递给FastCGI服务器的参数。假设FastCGI服务器可以通过 localhost:9000 访问。在之前的代理配置的基础上，用 fastcgi_pass 指令替换 proxy_pass 指令，参数改为 ocalhost:9000。在PHP中，SCRIPT_FILENAME参数用于决定脚本名字，QUERY_STRING参数用于传递请求参数。得到的配置可能这样：

```
server {
    location / {
        fastcgi_pass  localhost:9000;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param QUERY_STRING    $query_string;
    }

    location ~ \.(gif|jpg|png)$ {
        root /data/images;
    }
}
```

This will set up a server that will route all requests except for requests for static images to the proxied server operating on localhost:9000 through the FastCGI protocol.
这将通过FastCGI协议建立一个的服务器，路由除静态图片外的全部请求到运行在 localhost:9000 上的代理服务器。
















> 这个路程并不顺！主要是php的支持一直搞不定。下面是反复尝试得到的笔记。

> 经验是：版本太多，且配置方法也很多，每个人差异太大，所以百度到的流程一般不可用，需要根据情况灵活处理。




```
切换成root用户
$ sudo su -


安装mysql5数据库：
# apt-get install mysql-server mysql-client

中间会让询问建立root用户密码，需要输入两次。


mysql> \s
--------------
mysql  Ver 14.14 Distrib 5.5.47, for debian-linux-gnu (x86_64) using readline 6.3

Connection id:		44
Current database:	
Current user:		root@localhost
SSL:			Not in use
Current pager:		stdout
Using outfile:		''
Using delimiter:	;
Server version:		5.5.47-0ubuntu0.14.04.1 (Ubuntu)
Protocol version:	10
Connection:		Localhost via UNIX socket
Server characterset:	latin1
Db     characterset:	latin1
Client characterset:	utf8
Conn.  characterset:	utf8
UNIX socket:		/var/run/mysqld/mysqld.sock
Uptime:			10 hours 22 min 11 sec

Threads: 1  Questions: 582  Slow queries: 0  Opens: 189  Flush tables: 1  Open tables: 41  Queries per second avg: 0.015
--------------







安装 fpm：  
我们必须通过 PHP-FPM 才能让PHP5正常工作，安装命令：
# apt-get install php5-fpm  (php-fpm是一个守护进程。)

安装php及其扩展：   
# apt-get install php5-gd  # Popular image manipulation library; used extensively by Wordpress and it's plugins.
# apt-get install php5-cli   # Makes the php5 command available to the terminal for php5 scripting
# apt-get install php5-curl    # Allows curl (file downloading tool) to be called from PHP5
# apt-get install php5-mcrypt   # Provides encryption algorithms to PHP scripts
# apt-get install php5-mysql   # Allows PHP5 scripts to talk to a MySQL Database
# apt-get install php5-readline  # Allows PHP5 scripts to use the readline function





查看php5运行进程
# ps -waux | grep php5





打开关闭php5进程
sudo service php5-fpm stop
sudo service php5-fpm start
sudo service php5-fpm restart
sudo service php5-fpm status






下面是对php-fpm运行用户进行设置
/etc/php5/fpm/pool.d/www.conf

(1)修改(不用修改，已经存在了)
user = www-data
group = www-data

如果www-data用户不存在，那么先添加www-data用户
# groupadd www-data
# useradd -g www-data www-data

(2)配置php5监听端口  /etc/php5/fpm/pool.d/www.conf
把 listen = /var/run/php5-fpm.sock  改为 listen = 127.0.0.1:9000





重新运行php进程
# service php5-fpm restart
php5-fpm stop/waiting
php5-fpm start/running, process 2793








创建文件夹：
mkdir /home/www 
vi /home/www/index.php 
<?php 
	phpinfo(); 
?>

修改文件权限
chown -R www-data:www-data /home/www









修改nginx配置文件nginx.conf以支持php-fpm。
其中server段增加如下配置，注意root就是你的php文件所在目录。
/usr/local/nginx# vim nginx.conf

# pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
#
location ~ \.php$ {
	root           /home/www/;
	fastcgi_pass   127.0.0.1:9000;
	fastcgi_index  index.php;
	fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
	include        fastcgi_params;
}



重新启动 nginx 和 php-fpm，配置完成：
service php5-fpm restart  
nginx -s reload  




在浏览器中输入http://localhost/index.php?id=1000 就可以看到了。修改代码发现参数是可以传递的。
但是输入 127.0.0.1:9000 或者 127.0.0.1:9000/index.php 啥都没有。[?]





常用监控命令：
1.80端口是否可用：
$ netstat -tupln | grep 80

2.php5是否在运行：
$ ps -waux | grep php5




为了运行php中引入的外部js文件，还需要在nginx配置文件中添加一条：
location /public/ {
	root /home/wjl/PhpstormProjects/phpDemo/;
}
```














nginx location匹配规则： http://www.nginx.cn/115.html

-------------
```
php5-fpm的安装主要参考：http://www.cnblogs.com/Bonker/p/4252588.html
安装nginx参考 http://www.nginx.cn/install

利用Nginx做负载均衡 http://www.cnblogs.com/liping13599168/archive/2011/04/15/2017369.html

[1]入门 http://www.chinaz.com/web/2015/0424/401323.shtml
```






## 适用于Symfony的nginx配置  

https://www.nginx.com/resources/wiki/start/topics/recipes/symfony/


