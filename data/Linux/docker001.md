docker 快速入门——“Docker 是一个便携的应用容器”
====================
```
测试环境：物理机是win7。先安装了virtualBox 5.0.14，然后在其中安装和使用docker(Docker version 1.10.2, build c3959b1)。  
目的：帮助有一定的Linux基础知识的用户，了解docker基础。
测试时间：2016-3  
```



## 目录：
	- 概述: docker必要性, docker扫盲; 
	- [linux下docker的安装、下载、修改、推送](https://docs.docker.com/linux/); 
	- 实例(本文链接)：[Docker常见命令总结](#summary) ; [几个简单小例子](#examples); [mysql实例](#mysql)  

## 推荐阅读：
 - [docker官网](https://docs.docker.com/engine/quickstart/),  
 - [docker资源](http://www.docker.org.cn/page/resources.html),  
 - 推荐：[Docker从入门到实践](https://yeasy.gitbooks.io/docker_practice/content/image/index.html),
 - 推荐：[Docker一小时教程](https://blog.csphere.cn/archives/22),
 - 视频 [中国第一套Docker实战案例视频课程](http://edu.51cto.com/course/course_id-4238.html),
 
 - [docker简介](https://segmentfault.com/a/1190000003073069), 
 - [Docker 学习笔记](https://segmentfault.com/a/1190000002902909), 
 - [Docker与Vagrant的简单区别](http://dockone.io/article/271)
 - [容器虚拟化——docker详解](http://www.mamicode.com/info-detail-1300101.html)








# 开发者为什么需要docker?

http://www.docker.org.cn/docker/16.html

1. 尝试新软件: 如 Docker 只需要一条命令便可以运行 MySQL 数据库：docker run -d -p 3306:3306 tutum/mysql。例如 Gitlab，普通用户大概需要一天的时间去搭建 Gitlab 平台，而 Docker 则只需要一条命令。
2. 进行演示: 对于客户来说，我可以直接将 Docker 镜像提供给他们，而不必去做任何环境配置的工作，工作的效果也会和在他们演示中所看到的一模一样，同时不必担心他们的环境配置会导致我们的产品无法运行。
3. 避免“我机器上可以运行”: Docker 镜像并不会因为环境的变化而不能运行，也不会在不同的电脑上有不同的运行结果。可以给测试人员提交含有应用的 Docker 镜像，这样便不再会发生“在我机器上是可以运行的”这种事情，很大程度上减轻了开发人员测试人员互相检查机器环境设置带来的时间成本。
4. 学习 Linux 脚本: 我推荐使用 CoreOS 系统的云主机。虽然这样并不会让你成为专业的 Linux 运维，但是可以让你快速地学到 Linux 基础知识，爱上命令行操作，并且慢慢开始熟悉和欣赏 Linux。
5. 更好地利用资源: 虚拟机的粒度是“虚拟出的机器”，而 Docker 的粒度则是“被限制的应用”，相比较而言 Docker 的内存占用更少，更加轻量级。我经常在自己电脑中运行多个 Docker 应用，使用 Docker 比使用虚拟机更加简单，方便，粒度更细，也能持续地跟踪容器状态。
6. 为微服务定制: Docker 便可以在开发、测试和部署过程中一直充当微服务的容器。甚至生产环境也可以在 Docker 中部署微服务。
7. 在云服务提供商之间移植: 全面部署 Docker (Docker here and Docker there) 作为标准运行环境可以极大地减轻应用上线时的工作量和产生 BUG。
8. API 端: API 是应用之间的粘合剂，一个合格开发者肯定使用过别人提供的 REST API，或者自己开发过 REST API。需要指出的是，无论是客户端还是 API 提供端，在开发之前都需要先定义一组公共的 API 接口，写成文档，然后才能进行编码。如果服务端和客户端是共同开发的话，那么服务端通常会先实现能返回固定字符串的 API 接口，在以后的开发中再慢慢去实现 API 的功能。为了更好地解释我的意思，给大家提供一个实例：JSON Server，一个用于提供 JSON 数据的 REST API。使用过这个容器的人就会知道，既然有这么好用的 Docker JSON Server，我们没有理由不用 Docker。
9. 技术的创新: Docker 正在快速发展，工具也在不断更新，没有人能预见到未来 Docker 会是什么样子的。任何你使用 Docker 创建的工具都有可能成为社区关注的热点。这是 Docker 的机会，也是成就你自己的机会。

其他

还有两个技巧可以分享给你们。在学习 Docker 的过程中因为有了这两个的帮助，我才得意不断地提升自己。

一：Docker Hub Registry。这是 Docker 的官方镜像仓库，除了托管着 Docker 官方的镜像外，`和 Github 一样，你可以在上面上传自己的镜像，也可以在上面搜寻其他有用的镜像`，极大地节省自己的时间。例如 Oracle-XE-11g 镜像，所有的一切都是现成的，完全不需要自己去下载 Oracle XE 11g 安装。这样为你和团队节约了大量的时间成本。
如果你不太确定的话，可以去 Docker Hub 上搜有一下有没有自己用得到的镜像。大部分情况下你所需要的镜像在 Docker Hub 上都已经有人构建了。

二：多参考 IaaS 供应商的新闻，虽然我们不能像在他们会议室里那样完全了解他们的公司动态，但是仍然可以从新闻中可以了解到 Docker 最新的发展方向和技术趋势。可以肯定的是，容器化技术是未来的热点，我们不仅可以在本机运行 Docker，不仅仅在一家云服务提供商的主机上运行 Docker，未来所有的云服务提供商都会支持 Docker。

Docker 前景很明确，采用 Docker 只会让开发变得更方便。

-------------------




# Docker快速扫盲

## Docker是什么
Docker是一个改进的容器技术。具体的“改进”体现在，Docker为容器引入了镜像，使得容器可以从预先定义好的模版（images）创建出来，并且这个模版还是分层的。

## Docker经常被提起的特点：
	- 轻量，体现在内存占用小，高密度
	- 快速，毫秒启动
	- 隔离，沙盒技术更像虚拟机
	
	
## Docker技术的基础：
	- namespace，容器隔离的基础，保证A容器看不到B容器. 6个名空间：User,Mnt,Network,UTS,IPC,Pid
	- cgroups，容器资源统计和隔离。主要用到的cgroups子系统：cpu,blkio,device,freezer,memory
	- unionfs，典型：aufs/overlayfs，分层镜像实现的基础



## Docker组件：
	- docker Client客户端————>向docker服务器进程发起请求，如:创建、停止、销毁容器等操作
	- docker Server服务器进程—–>处理所有docker的请求，管理所有容器
	- docker Registry镜像仓库——>镜像存放的中央仓库，可看作是存放二进制的scm



-------------------------------

	
	














































<a name='summary'></a>
<br>
----------------------------------


# Docker常见命令总结

## 容器相关操作
	- docker create # 创建一个容器但是不启动它
	- docker run # 创建并启动一个容器
	- docker stop # 停止容器运行，发送信号SIGTERM
	- docker start # 启动一个停止状态的容器
	- docker restart # 重启一个容器
	- docker rm # 删除一个容器
	- docker kill # 发送信号给容器，默认SIGKILL
	- docker attach # 连接(进入)到一个正在运行的容器
	- docker wait # 阻塞到一个容器，直到容器停止运行


## 获取容器相关信息
	- docker ps # 显示状态为运行（Up）的容器
	- docker ps -a # 显示所有容器,包括运行中（Up）的和退出的(Exited)
	- docker inspect # 深入容器内部获取容器所有信息
	- docker logs # 查看容器的日志(stdout/stderr)
	- docker events # 得到docker服务器的实时的事件
	- docker port # 显示容器的端口映射
	- docker top # 显示容器的进程信息
	- docker diff # 显示容器文件系统的前后变化


## 导出容器
	- docker cp # 从容器里向外拷贝文件或目录
	- docker export # 将容器整个文件系统导出为一个tar包，不带layers、tag等信息


## 执行
	- docker exec # 在容器里执行一个命令，可以执行bash进入交互式

## 镜像操作
	- docker images # 显示本地所有的镜像列表
	- docker import # 从一个tar包创建一个镜像，往往和export结合使用
	- docker build # 使用Dockerfile创建镜像（推荐）
	- docker commit # 从容器创建镜像
	- docker rmi # 删除一个镜像
	- docker load # 从一个tar包创建一个镜像，和save配合使用
	- docker save # 将一个镜像保存为一个tar包，带layers和tag信息
	- docker history # 显示生成一个镜像的历史命令
	- docker tag # 为镜像起一个别名


## 镜像仓库(registry)操作
	- docker login # 登录到一个registry
	- docker search # 从registry仓库搜索镜像
	- docker pull # 从仓库下载镜像到本地
	- docker push # 将一个镜像push到registry仓库中

``````
 获取Container IP地址（Container状态必须是Up）
docker inspect id | grep IPAddress | cut -d '"' -f 4

 获取端口映射
docker inspect -f '{{range $p, $conf := .NetworkSettings.Ports}} {{$p}} -> {{(index $conf 0).HostPort}} {{end}}' id

 获取环境变量
docker exec container_id env

 杀掉所有正在运行的容器
docker kill $(docker ps -q)

 删除老的(一周前创建)容器
docker ps -a | grep 'weeks ago' | awk '{print $1}' | xargs docker rm

 删除已经停止的容器
docker rm `docker ps -a -q`

 删除所有镜像，小心
docker rmi $(docker images -q)
``````





















<a name='examples'></a>
<br>

-----------------------
# 几个简单小例子







<a name='mysql'></a>
<br>
----------------------------------

## 在docker中运行mysql 

1.下载mysql官方镜像 
`# docker pull mysql`

2.查看本机镜像
`# docker images`

3.运行MySQL镜像
```
# docker run --name app1-db -e MYSQL_ROOT_PASSWORD=123456 -d -p 3308:3306 -v /opt/mysql_data:/var/lib/mysql mysql:5.7
1add96f289a1b8744500a4a6709af6e2e0628b97797e8470be75efe67e2005f4

# docker run --name app2-db -e MYSQL_ROOT_PASSWORD=123456 -d -P -v /opt/mysql_data:/var/lib/mysql mysql
007e6c469dcfa930b74fe613b942ca2d75638c481003b95be8886297c44ab42a
```

--name 指定容器名称， -e 指定特殊的一些变量， -d 表示后台运行（服务化）


-p 表示将外部访问的3308端口映射到容器的3306端口，由于MySQL 镜像默认允许对外开放3306端口（我为什么知道？看它的dockerfile ，后面会有说明），所以也可以直接用-P ,这样的话外部访问3306也被映射到容器的3306端口上


-v 参数可以宿主机的目录映射到将容器内目录，上例-v /opt/mysql_data:/var/lib/mysql 会将宿主机/opt/mysql_data 映射到容器/var/lib/mysql (已知此目录为MySQL的数据目录)，这样可以保证容器删除时对应目录的数据不被删除（因为这个目录是宿主机上的），这点很重要，实际使用中几乎所有容器都要做此映射！

有了端口之后那IP呢？IP实际上就是你docker宿主机的IP。Docker的访问机制简单说明：Docker所有的对外服务统一使用`宿主机IP+特定端口`，当一个请求发起时会经由宿主面的iptables根据容器创建时的端口规则转发到对应的容器处理。


4.测试是否运行，记录docker中的`mysql的端口号`：
```
root@wjl-VirtualBox:~# docker ps
CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS                     NAMES
007e6c469dcf        mysql               "/entrypoint.sh mysql"   14 seconds ago      Up 12 seconds       0.0.0.0:32768->3306/tcp   app2-db
```


获得宿主机IP：
```
root@wjl-VirtualBox:~# ifconfig
docker0   Link encap:Ethernet  HWaddr 02:42:6a:e3:cf:6f  
          inet addr:172.17.0.1  Bcast:0.0.0.0  Mask:255.255.0.0
          inet6 addr: fe80::42:6aff:fee3:cf6f/64 Scope:Link
          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
          RX packets:13395 errors:0 dropped:0 overruns:0 frame:0
          TX packets:12833 errors:0 dropped:0 overruns:0 carrier:0
          collisions:0 txqueuelen:0 
          RX bytes:1155114 (1.1 MB)  TX bytes:11987637 (11.9 MB)

eth0      Link encap:Ethernet  HWaddr 08:00:27:0e:cc:c3  
          inet addr:192.168.1.177  Bcast:192.168.1.255  Mask:255.255.255.0
          inet6 addr: fe80::a00:27ff:fe0e:ccc3/64 Scope:Link
          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
          RX packets:383123 errors:0 dropped:0 overruns:0 frame:0
          TX packets:168487 errors:0 dropped:0 overruns:0 carrier:0
          collisions:0 txqueuelen:1000 
          RX bytes:423993098 (423.9 MB)  TX bytes:130714234 (130.7 MB)
```

5.在局域网的另一个win7上连接mysql：
```
F:\xampp\mysql\bin>mysql -h 192.168.1.177 -u root -P 32768 -p
Enter password: ******
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 2
Server version: 5.7.11 MySQL Community Server (GPL)

Copyright (c) 2000, 2013, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> \s
--------------
mysql  Ver 14.14 Distrib 5.6.11, for Win32 (x86)

Connection id:          2
Current database:
Current user:           root@192.168.1.100
SSL:                    Not in use
Using delimiter:        ;
Server version:         5.7.11 MySQL Community Server (GPL)
Protocol version:       10
Connection:             192.168.1.177 via TCP/IP
Server characterset:    latin1
Db     characterset:    latin1
Client characterset:    gbk
Conn.  characterset:    gbk
TCP port:               32768
Uptime:                 6 min 50 sec

Threads: 1  Questions: 5  Slow queries: 0  Opens: 105  Flush tables: 1  Open tab
les: 98  Queries per second avg: 0.012
```




6.停止/运行/重启MySQL容器  
```
# docker stop app2-db
app2-db  

# docker start app2-db
app2-db  前面如果不指定端口号，则重启后mysql的端口号会变化

# docker restart app2-db
app2-db
```



7.删除mysql容器
我们先删除刚才的容器
```
root@ubuntu:~# docker rm -f app2-db
app2-db
```

-f 表示强制删除运行中的容器


8.重新运行mysql容器，固定端口号。
```
# docker ps
CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS              PORTS               NAMES

# docker run --name app2-db -e MYSQL_ROOT_PASSWORD=123456 -d -p 32768:3306 -v /opt/mysql_data:/var/lib/mysql mysql
426b74b40571455a95bbaa7579983e411129389b846ac351ce1aea3b22f7977d

# docker ps
CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS                     NAMES
426b74b40571        mysql               "/entrypoint.sh mysql"   8 seconds ago       Up 6 seconds        0.0.0.0:32768->3306/tcp   app2-db
```
参考step5再次测试，局域网内可以连接数据库！










## 在docker中运行远程桌面 xrdp


[在Docker中运行桌面应用](http://www.dockerone.com/article/218)
2016[Runc Containers on the Desktop](https://blog.jessfraz.com/post/runc-containers-on-the-desktop/)
2015[Docker Containers on the Desktop](https://blog.jessfraz.com/post/docker-containers-on-the-desktop/)


### Xfce 比 KDE和GNOME 更轻量级。

```
运行 ubuntu 基础镜像

$ docker run --rm -d -it --name desk -p 3399:3389 ubuntu:20.04
$ docker exec -it desk bash

安装xrdp协议
cd \
&& sed -i "s/archive.ubuntu/mirrors.aliyun/g;s/security.ubuntu/mirrors.aliyun/g" /etc/apt/sources.list \
&& apt update \
&& apt install -y wget unzip \
## && apt install -y language-pack-zh-han* \
## && apt install -y language-pack-gnome-zh-han* \
&& apt install -y xfce4 xfce4-goodies xorg dbus-x11 x11-xserver-utils \
&& apt install -y xrdp \
&& service xrdp start

# 地址选择 6亚洲 70上海。
# 键盘 18china, 2汉语拼音
# 1 gdm3

提交镜像
$ docker commit desk ubuntu:20.04d

修改可用的端口
$ docker run --rm -d -it --name desk2 -p 9000:3389 ubuntu:20.04d
进入启动服务
$ docker exec -it desk2 bash
# service xrdp start
	xrdp-sesman is already running.
	if it's not running, try removing /var/run/xrdp/xrdp-sesman.pid
# service xrdp restart
# service xrdp status

新建用户
# useradd -s /bin/bash -m wangjl
# echo "wangjl:123" | chpasswd

防止闪退
# su wangjl
$ cd
$ touch .xsession
$ echo xfce4-session >~/.xsession


本地win10，左下角搜索 远程桌面连接，
输入 IP:9000 回车，
新窗口输入新建的用户名和密码 wangjl/123 回车；
新窗口就是桌面了!

使用体验：不好，浏览器无法运行。
```






### Ubuntu 20.04 in docker 安装 gnome 桌面 (闪退 //todo)

https://hub.docker.com/r/danielguerra/ubuntu-xrdp


```
运行 ubuntu 基础镜像
$ docker run --rm -d -it --name desk -p 9000:3389 ubuntu:20.04
$ docker exec -it desk bash

替换为国内源
# sed -i "s/archive.ubuntu/mirrors.aliyun/g;s/security.ubuntu/mirrors.aliyun/g" /etc/apt/sources.list
# apt update

安装 Gnome 和 xfce
# apt install -y ubuntu-desktop xubuntu-desktop

	地址选择 6亚洲 70上海。
	键盘 回车， 18china, 2汉语拼音
	选择 1

安装xrdp协议
# apt install xrdp -y

提交镜像 $ docker commit desk u:1










启动服务
$ docker run --rm -d -it --name desk -p 9000:3389 u:1
$ docker exec -it desk bash

新建用户
# useradd -s /bin/bash -m wangjl
# echo "wangjl:123" | chpasswd

# adduser xrdp ssl-cert
## systemctl restart xrdp

还是各种闪退！
# apt update
# apt upgrade


提交镜像 $ docker commit desk u:2






启动服务
$ docker run --rm -d -it --name desk -p 9000:3389 u:2
$ docker exec -it desk bash

# apt install vim -y
# service dbus start #解决报错1

# service xrdp start
		xrdp-sesman is already running.
		if it's not running, try removing /var/run/xrdp/xrdp-sesman.pid
	# service xrdp restart
# service xrdp status
 * xrdp-sesman is running
 * xrdp is running



# apt-get install xfce4

# echo xfce4-session >~/.xsession



报错1: win10远程桌面登录闪退，
在linux该用户目录下的错误文件最后一行：
$ cat ~/.xsession-errors
gnome-session-binary[25657]: ERROR: Failed to connect to system bus: Could not connect: No such file or directory
aborting...



报错2: 再次连接，报错
$ cat ~/.xsession-errors
gnome-session-binary[26417]: WARNING: Failed to connect to systemd: Error calling StartServiceByName for org.freedesktop.login1: Launch helper exited with unknown return code 1



## https://blog.csdn.net/fleaxin/article/details/109163451
远程桌面 xrdp 问题: https://blog.csdn.net/yyywxk/article/details/106136196
Linux 用户可以使用一个 RDP 客户端，例如 Remmina 或者 Vinagre： https://www.itcoder.tech/posts/how-to-install-xrdp-on-ubuntu-20-04/
```

