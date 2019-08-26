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

### Docker是什么
Docker是一个改进的容器技术。具体的“改进”体现在，Docker为容器引入了镜像，使得容器可以从预先定义好的模版（images）创建出来，并且这个模版还是分层的。

### Docker经常被提起的特点：
	- 轻量，体现在内存占用小，高密度
	- 快速，毫秒启动
	- 隔离，沙盒技术更像虚拟机
	
	
### Docker技术的基础：
	- namespace，容器隔离的基础，保证A容器看不到B容器. 6个名空间：User,Mnt,Network,UTS,IPC,Pid
	- cgroups，容器资源统计和隔离。主要用到的cgroups子系统：cpu,blkio,device,freezer,memory
	- unionfs，典型：aufs/overlayfs，分层镜像实现的基础



### Docker组件：
	- docker Client客户端————>向docker服务器进程发起请求，如:创建、停止、销毁容器等操作
	- docker Server服务器进程—–>处理所有docker的请求，管理所有容器
	- docker Registry镜像仓库——>镜像存放的中央仓库，可看作是存放二进制的scm



-------------------------------

	
	


# 安装docker  
Docker的安装非常简单，支持目前所有主流操作系统，从Mac到Windows到各种Linux发行版。具体参考： [docker安装](https://docs.docker.com/installation/)

本文仅介绍 [ubuntu1404](http://www.docker.org.cn/book/install/install-docker-trusty-14.04-26.html) 的安装。

依赖关系：Ubuntu 14.04版本无需安装额外的依赖包，可以直接安装。
安装步骤：
 1. 使用管理员帐号登录ubuntu 14.04系统，保证该管理有root权限，或者可以执行sudo命令。
 2. 检查curl包有没有安装。  
	`$ which curl`
如果curl没有安装的话，更新apt源之后，安装curl包。
	`$ sudo apt-get update`
	`$ sudo apt-get install curl`  
 3. 获得最新的docker安装包。
	`$ curl -sSL https://get.docker.com/ | sh` 
shell会提示你输入sudo的密码，然后开始执行安装过程。
 4. 确认Docker是否安装成功。
	`$ docker -v`
	Docker version 1.10.2, build c3959b1  


	
	
	
> 所有 docker 操作都需要 root 权限，需要加 sudo。或者干脆进入root用户：$sudo su -  





检查docker服务运行状态：
`# service docker status`

开启服务:
```
# service docker start
docker start/runing, process 7423  
```


这个命令会下载一个测试用的镜像并启动一个容器运行它(本地找不到，就到远程找)。
```
# docker run hello-world

Hello from Docker.来自Docker的问候。
This message shows that your installation appears to be working correctly. |这条消息表明你的安装看起来正确工作啦。

To generate this message, Docker took the following steps: |为了产生该条消息，Docker经历如下步骤：
 1. The Docker client contacted the Docker daemon. |Docker客户端和Docker守护进程联系；
 2. The Docker daemon pulled the "hello-world" image from the Docker Hub. |Docker守护进程从Docker hub推送“hello-world”镜像。 
 3. The Docker daemon created a new container from that image which runs the 
    executable that produces the output you are currently reading. |Docker守护进程从镜像创建一个新的容器，执行命令产生你现在阅读的输出结果。
 4. The Docker daemon streamed that output to the Docker client, which sent it
    to your terminal. | Docker守护进程把输出结果作为流推送给Docker客户端，最终发送消息到你的终端。

To try something more ambitious, you can run an Ubuntu container with:|试试更激动人心的，你可以运行一个Ubuntu容器：
 $ docker run -it ubuntu bash

Share images, automate workflows, and more with a free Docker Hub account: |分享镜像，自动工作流，以及更多免费Docker
 https://hub.docker.com

For more examples and ideas, visit: | 分享镜像，自动工作流，以及更多免费Docker hub账号：
 https://docs.docker.com/userguide/

```

我们试试docker推荐的命令：
```
root@ubt16:~# docker run -it ubuntu
Unable to find image 'ubuntu:latest' locally
latest: Pulling from library/ubuntu
e0a742c2abfd: Pulling fs layer
e0a742c2abfd: Pull complete
486cb8339a27: Pull complete
dc6f0d824617: Pull complete
4f7a5649a30e: Pull complete
672363445ad2: Pull complete
Digest: sha256:84c334414e2bfdcae99509a6add166bbb4fa4041dc3fa6af08046a66fed3005f
Status: Downloaded newer image for ubuntu:latest

root@bf835331c62c:/# pwd
/
root@bf835331c62c:/#
```
经过一些列的下载安装（本地找不到就找远程的，下载需要几分钟，取决于网速）......

注意，#前的主机名已经变了！我们进入了一个虚拟机~~

新打开一个终端，使用命令 `docker -ps` 可见正在运行的容器。

```
root@ubt16:~# docker ps
CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS              PORTS               NAMES
bf835331c62c        ubuntu              "/bin/bash"         5 minutes ago       Up 5 minutes                            frosty_cori
```




异常检查命令：
```
docker ps  #查看容器ID
docker stop id  #停止容器
docker rm id    #删除容器

解决方法：
rm -rf /var/lib/docker/*   #(记得备份重要数据)

哈哈 突然发现是如此的简单，前面都成扯淡的了...
cat xxx.tar.gz | docker import - name:tag

稍等片刻，成功部署...  
```



### 查找版本号
http://www.docker.org.cn/book/docker/prepare-docker-5.html
docker包括服务器和客户机，一般是在一台电脑上。

目标：检查docker的版本，这样可以用来确认docker服务在运行并可通过客户端链接。

提示：可以通过在终端输入docker命令来查看所有的参数。
官网的在线模拟器只提供了有限的命令，无法保证所有的命令可以正确执行。

正确的命令：
```
# docker -v
Docker version 1.10.2, build c3959b1

#docker version
Client:
 Version:      1.10.2
 API version:  1.22
 Go version:   go1.5.3
 Git commit:   c3959b1
 Built:        Mon Feb 22 21:37:01 2016
 OS/Arch:      linux/amd64

Server:
 Version:      1.10.2
 API version:  1.22
 Go version:   go1.5.3
 Git commit:   c3959b1
 Built:        Mon Feb 22 21:37:01 2016
 OS/Arch:      linux/amd64
```




### 搜索可用docker镜像
使用docker最简单的方式莫过于从现有的容器镜像开始。Docker官方网站专门有一个页面来存储所有可用的镜像，网址是：hub.docker.com。你可以通过浏览这个网页来查找你想要使用的镜像，或者使用命令行的工具来检索。

目标：学会使用命令行的工具来检索名字叫做tutorial的镜像。

提示：命令行的格式为：docker search 镜像名字

正确的命令：
```
# docker search nodeJS
NAME                                     DESCRIPTION                                     STARS     OFFICIAL   AUTOMATED
google/nodejs                                                                            62                   [OK]
readytalk/nodejs                         Node.js based off the official Debian Whee...   9                    [OK]
monostream/nodejs-gulp-bower             nodejs-gulp-bower                               3                    [OK]
```




### 下载容器镜像
http://www.docker.org.cn/book/docker/docker-download-image-7.html

学会使用docker命令来下载镜像

下载镜像的命令非常简单，使用docker pull命令即可。(译者按：docker命令和git有一些类似的地方）。在docker的镜像索引网站上面，镜像都是按照`用户名/镜像名`的方式来存储的。有一组比较特殊的镜像，比如ubuntu这类基础镜像，经过官方的验证，值得信任，可以直接用`镜像名`来检索到。


目标：通过docker命令下载tutorial镜像。

提示：执行pull命令的时候要写完整的名字，比如"learn/tutorial"。

正确的命令：
```
#docker pull learn/tutorial
Using default tag: latest
latest: Pulling from learn/tutorial
271134aeb542: Pull complete 
Digest: sha256:2933b82e7c2a72ad8ea89d58af5d1472e35dacd5b7233577483f58ff8f9338bd
Status: Downloaded newer image for learn/tutorial:latest


#docker pull google/nodejs
Using default tag: latest
latest: Pulling from google/nodejs
a3ed95caeb02: Pull complete 
14c935ef769c: Pull complete 
b57d38c2fe81: Pull complete 
06b0a6c3ea5d: Pull complete 
ba6860f8f186: Pull complete 
f94d07a02954: Pull complete 
d372c664546a: Pull complete 
Digest: sha256:1346904512c067aa86c682fda60d82f6bece489b71489f11e6bfeb0071d1a1e7
Status: Downloaded newer image for google/nodejs:latest
```





### 在docker容器中运行hello world!

docker容器可以理解为在沙盒中运行的进程。这个沙盒包含了该进程运行所必须的资源，包括文件系统、系统类库、shell 环境等等。但这个沙盒默认是不会运行任何程序的。你需要在沙盒中运行一个进程来启动某一个容器。这个进程是该容器的唯一进程，所以当该进程结束的时候，容器也会完全的停止。

目标：在我们刚刚下载的镜像中输出"hello word"。为了达到这个目的，我们需要在这个容器中运行"echo"命令，输出"hello word"。

提示：docker run命令有两个参数，一个是镜像名，一个是要在镜像中运行的命令。

正确的命令：
```
# docker run learn/tutorial echo "hello world"
hello world

# docker run google/nodejs npm -v
2.14.7
# docker run google/nodejs node -v
v4.2.3
```







### 在容器中安装新的程序

下一步我们要做的事情是在容器里面安装一个简单的程序(ping)。我们之前下载的tutorial镜像是基于ubuntu的，所以你可以使用ubuntu的apt-get命令来安装ping程序：`apt-get install -y ping`。
备注：apt-get 命令执行完毕之后，容器就会停止，但对容器的改动不会丢失。

目标：在learn/tutorial镜像里面安装ping程序。

提示：在执行apt-get 命令的时候，要带上-y参数。如果不指定-y参数的话，apt-get命令会进入交互模式，需要用户输入命令来进行确认，但在docker环境中是无法响应这种交互的。

正确的命令：
```
$docker run learn/tutorial apt-get install -y ping

```






### 保存对容器的修改

当你对某一个容器做了修改之后（通过在容器中运行某一个命令），可以把对容器的修改保存下来，这样下次可以从保存后的最新状态运行该容器。docker中保存状态的过程称之为committing，它保存的新旧状态之间的区别，从而产生一个新的版本。

目标：首先使用`docker ps -l`命令获得安装完ping命令之后容器的id。然后把这个镜像保存为learn/ping。

提示：

1.运行docker commit，可以查看该命令的参数列表。
```
# docker commit 

docker: "commit" requires a minimum of 1 argument.
See 'docker commit --help'.

Usage:	docker commit [OPTIONS] CONTAINER [REPOSITORY[:TAG]]

Create a new image from a container's changes
```

2.你需要指定要提交保存容器的ID。(译者按：通过docker ps -l 命令获得)
```
# docker ps -l
CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS                     PORTS               NAMES
452e5b68930d        learn/tutorial      "apt-get install -y p"   8 seconds ago       Exited (0) 6 seconds ago                       tiny_stallman



# docker ps -l
CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS                     PORTS               NAMES
465cc7ce4613        google/nodejs       "npm -v"            4 minutes ago       Exited (0) 4 minutes ago                       nauseous_swartz
```

3.无需拷贝完整的id，通常来讲最开始的三至四个字母即可区分。（译者按：非常类似git里面的版本号)

正确的命令：
```
# docker commit 452e5b689 learn/ping
sha256:b478d3dc4ec5edacef822679998c6420ed7448e13963e8b7f90c7682f38e1d60
```
请注意：Docker返回一个新的id，就是镜像id。


commit命令可以使用更多参数：-m指定评论（和git类似），-a指定此次更新的作者。
```
$ docker commit -m "Added json gem" -a "Kate Smith" \
0b2616b0e5a8 ouruser/sinatra:v2
4f177bd27a9ff0f6dc2a830403925b5360bfe0b93d476f7fc3231110e7f71b1c
```











### 运行新的镜像

ok，到现在为止，你已经建立了一个完整的、自成体系的docker环境，并且安装了ping命令在里面。它可以在任何支持docker环境的系统中运行啦！(译者按：是不是很神奇呢？)让我们来体验一下吧！

目标：
在新的镜像中运行ping www.google.com命令。

提示：
一定要使用新的镜像名`learn/ping`来运行ping命令。(译者按：最开始下载的learn/tutorial镜像中是没有ping命令的)

正确的命令：
```
# docker run learn/ping ping www.baidu.com
PING www.a.shifen.com (119.75.217.109) 56(84) bytes of data.
64 bytes from 119.75.217.109: icmp_req=1 ttl=49 time=13.7 ms
64 bytes from 119.75.217.109: icmp_req=2 ttl=49 time=12.4 ms
64 bytes from 119.75.217.109: icmp_req=3 ttl=49 time=12.4 ms
64 bytes from 119.75.217.109: icmp_req=4 ttl=49 time=12.5 ms
^C
--- www.a.shifen.com ping statistics ---
4 packets transmitted, 4 received, 0% packet loss, time 7294ms
rtt min/avg/max/mdev = 12.419/12.773/13.708/0.540 ms

```
提示：你可以通过ctrl+C停止命令。









### 检查运行中的镜像

现在你已经运行了一个docker容器，让我们来看下正在运行的容器。
使用`docker ps`命令可以查看所有正在运行中的容器列表，使用`docker inspect`命令我们可以查看更详细的关于某一个容器的信息。
```
# docker ps
CONTAINER ID        IMAGE               COMMAND                CREATED             STATUS              PORTS               NAMES
98dda58ec02a        learn/ping          "ping www.baidu.com"   3 seconds ago       Up 2 seconds                            reverent_hugle



# docker inspect
docker: "inspect" requires a minimum of 1 argument.
See 'docker inspect --help'.

Usage:	docker inspect [OPTIONS] CONTAINER|IMAGE [CONTAINER|IMAGE...]

Return low-level information on a container or image



# docker inspect learn/ping
[
    {
        "Id": "sha256:b478d3dc4ec5edacef822679998c6420ed7448e13963e8b7f90c7682f38e1d60",
        "RepoTags": [
            "learn/ping:latest"
        ],
        "RepoDigests": [],
        "Parent": "sha256:a7876479f1aae32c0716d7a85b5151af26f533fe48efa086010105cba02f5163",
        ...
        "Architecture": "amd64",
        "Os": "linux",
        "Size": 139492268,
        "VirtualSize": 139492268,
        "GraphDriver": {
            "Name": "aufs",
            "Data": null
        }
    }
]
```


目标：
查找某一个运行中容器的id，然后使用docker inspect命令查看容器的信息。

提示：
可以使用镜像id的前面部分，不需要完整的id。

正确的命令：
```
$ docker inspect 98dd
```
看结果：有IP地址[?]，状态等信息。







### 发布docker镜像
http://www.docker.org.cn/book/docker/docker-push-image-13.html

现在我们已经验证了新镜像可以正常工作，下一步我们可以将其发布到官方的索引网站。还记得我们最开始下载的learn/tutorial镜像吧，我们也可以把我们自己编译的镜像发布到索引页面，一方面可以自己重用，另一方面也可以分享给其他人使用。

目标：
把learn/ping镜像发布到docker的index网站。

提示：
1. docker images命令可以列出所有安装过的镜像。
2. docker push命令可以将某一个镜像发布到官方网站。
3. 你只能将镜像发布到自己的空间下面。这个模拟器登录的是learn帐号。

预期的命令：
```
$ docker push learn/ping

The push refers to a repository [docker.io/learn/ping]
25da6dc3f0ce: Preparing 
ee1ba0cc9b81: Preparing 
unauthorized: access to the requested resource is not authorized
```
提示没有授权。。。

话说我已经申请过hub.docker.com的账号了。

继续找官方文档。https://docs.docker.com/engine/reference/commandline/login/

#### 看来需要先登录：
```
root@wjl-VirtualBox:~# docker login -u dawneve -p yourPassWord
Email: jimmyMall@live.com
WARNING: login credentials saved in /root/.docker/config.json
Login Succeeded
```

#### 查看所有镜像
```
root@wjl-VirtualBox:~# docker images
REPOSITORY          TAG                 IMAGE ID            CREATED             SIZE
learn/ping          latest              b478d3dc4ec5        About an hour ago   139.5 MB
<none>              <none>              dfffdd34bc13        About an hour ago   128 MB
ubuntu              latest              07c86167cdc4        5 days ago          188 MB
google/nodejs       latest              d1921e7f8e86        6 weeks ago         493.3 MB
hello-world         latest              690ed74de00f        4 months ago        960 B
learn/tutorial      latest              a7876479f1aa        2 years ago         128 MB
root@wjl-VirtualBox:~# 
```

#### 重新命名docker镜像  

```
root@wjl-VirtualBox:~# docker run learn/ping echo "hi"
hi

root@wjl-VirtualBox:~# docker ps -l
CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS                     PORTS               NAMES
36279ac73153        learn/ping          "echo hi"           7 seconds ago       Exited (0) 7 seconds ago                       dreamy_yalow

root@wjl-VirtualBox:~# docker commit 36279 dawneve/ping
sha256:5bd062e39404b1c35c57383183b32b48431a43f701aabf093aae016f896cb097

root@wjl-VirtualBox:~# docker images
REPOSITORY          TAG                 IMAGE ID            CREATED             SIZE
dawneve/ping        latest              5bd062e39404        5 seconds ago       139.5 MB
learn/ping          latest              b478d3dc4ec5        About an hour ago   139.5 MB
<none>              <none>              dfffdd34bc13        About an hour ago   128 MB
ubuntu              latest              07c86167cdc4        5 days ago          188 MB
google/nodejs       latest              d1921e7f8e86        6 weeks ago         493.3 MB
hello-world         latest              690ed74de00f        4 months ago        960 B
learn/tutorial      latest              a7876479f1aa        2 years ago         128 MB
```

#### 执行上传  
```
root@wjl-VirtualBox:~# docker push dawneve/ping
The push refers to a repository [docker.io/dawneve/ping]
25da6dc3f0ce: Pushed 
ee1ba0cc9b81: Pushed 
latest: digest: sha256:4ce09a01b4193e90d1314b470fc30e670ed619de5b5deb6d148294f10ae76446 size: 2167
```
登陆我的账号 https://hub.docker.com/u/dawneve/ ，发现已经有2个pull了，难道不应该是push？



> 本文减缩版：https://segmentfault.com/a/1190000000482546





















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


## 容器操作

1.创建并拉取busybox
```
# docker run -it --name con01 busybox:latest
/ # ip addr    #容器里执行
1: lo: <LOOPBACK,UP,LOWER_UP> mtu 65536 qdisc noqueue state UNKNOWN group default 
link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00
inet 127.0.0.1/8 scope host lo
   valid_lft forever preferred_lft forever
Segmentation fault (core dumped)
/ # ping www.csphere.cn
PING www.csphere.cn (117.121.26.243): 56 data bytes
64 bytes from 117.121.26.243: seq=0 ttl=48 time=3.139 ms
64 bytes from 117.121.26.243: seq=1 ttl=48 time=3.027 ms
^C
--- www.csphere.cn ping statistics ---
2 packets transmitted, 2 packets received, 0% packet loss
round-trip min/avg/max = 3.027/3.083/3.139 ms
exit    #退出容器



2.创建测试容器
# docker run -d --name con03 csphere/test:0.1
efc9bda4a2ff2f479b18e0fc4698e42c47c9583a24c93f5ce6b28a828a172709


3.登陆到con03中
# docker exec -it con03 /bin/bash
[root@efc9bda4a2ff /]# exit


4.停止con03
# docker stop con03
con03


5.开启con03
# docker start con03
con03


6.删除con03
# docker ps -a
CONTAINER ID        IMAGE                    COMMAND                CREATED             STATUS                      PORTS                                             NAMES
efc9bda4a2ff        csphere/test:0.1         "/usr/local/bin/run    4 minutes ago       Up 17 seconds                                                                 con03               
99aa6ee25adc        busybox:latest           "/bin/sh"              14 minutes ago      Exited (0) 12 minutes ago                                                     con02               
831c93de9b9f        busybox:latest           "/bin/sh"              2 hours ago         Up 27 minutes                                                                 con01
# docker rm con02     #容器停止的状态
# docker rm -f con03  #容器开启的状态
```



## 镜像操作
```
1.从docker hub官方镜像仓库拉取镜像
# docker pull busybox:latest
atest: Pulling from busybox
cf2616975b4a: Pull complete 
6ce2e90b0bc7: Pull complete 
8c2e06607696: Already exists 
busybox:latest: The image you are pulling has been verified. Important: image verification is a tech preview feature and should not be relied on to provide security.
Digest: sha256:38a203e1986cf79639cfb9b2e1d6e773de84002feea2d4eb006b52004ee8502d
Status: Downloaded newer image for busybox:latest


2.从本地上传镜像到镜像仓库
docker push 192.168.1.2/csphere/nginx:1.7


3.查找镜像仓库的某个镜像
# docker search centos/nginx
NAME                                     DESCRIPTION     STARS     OFFICIAL   AUTOMATED
johnnyzheng/centos-nginx-php-wordpress                   1                    [OK]
sergeyzh/centos6-nginx                                   1                    [OK]
hzhang/centos-nginx                                      1                    [OK]


4.查看本地镜像列表
# docker images
TAG                 IMAGE ID            CREATED             VIRTUAL SIZE
docker.io/csphere/csphere   0.10.3              604c03bf0c9e        3 days ago          62.72 MB
docker.io/csphere/csphere   latest              604c03bf0c9e        3 days ago          62.72 MB
csphere/csphere             0.10.3              604c03bf0c9e        3 days ago          62.72 MB
registry                    2.0                 2971b6ce766c        7 days ago          548.1 MB
busybox                     latest              8c2e06607696        3 weeks ago         2.43 MB


5.删除镜像
docker rmi busybox:latest        #没有容器使用此镜像创建，如果有容器在使用此镜像会报错：Error response from daemon: Conflict, cannot delete 8c2e06607696 because the running container 831c93de9b9f is using it, stop it and use -f to force
FATA[0000] Error: failed to remove one or more images
docker rmi -f busybox:latest     #容器使用此镜像创建，此容器状态为Exited


6.查看构建镜像所用过的命令
# docker history busybox:latest
IMAGE               CREATED             CREATED BY                                      SIZE
8c2e06607696        3 weeks ago         /bin/sh -c #(nop) CMD ["/bin/sh"]               0 B
6ce2e90b0bc7        3 weeks ago         /bin/sh -c #(nop) ADD file:8cf517d90fe79547c4   2.43 MB
cf2616975b4a        3 weeks ago         /bin/sh -c #(nop) MAINTAINER Jérôme Petazzo     0 B
```


















<a name='mysql'></a>
<br>
----------------------------------

# 在docker中运行mysql 

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
--------------
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

