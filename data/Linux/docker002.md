docker简介
==========================

```
docker是未来吗？Container War in 2016, docker VS Rocket: http://www.imooc.com/video/7923  
	docker注册了自己的商标，使用该名词都很麻烦。
	spec (specification:规范) 都是自己定义的。趋向于封闭。  
	docker将要做成容器类的github。  
	openStock?
	
docker的原理和简介(张成远)：http://www.imooc.com/video/8011  
	单独的带有namespace的进程，该进程直接在物理机上跑；
	
	

```






# docker文档  


## Introduction to Engine user guide |引擎用户指南概要
https://docs.docker.com/engine/userguide/intro/

This guide takes you through the fundamentals of using Docker Engine and integrating it into your environment. You’ll learn how to use Engine to:
这个指南横跨Docker引擎基础和整合Docker到你的环境。你将学会使用引擎去：

 - Dockerize your applications. |Docker化你的应用
 - Run your own containers. | 运行你的容器
 - Build Docker images. |建立你的Docker镜像
 - Share your Docker images with others. |和他人分享你的Docker镜像
 - And a whole lot more! |以及更多！

This guide is broken into major sections that take you through learning the basics of Docker Engine and the other Docker products that support it.
这个指南分为主要的部分，介绍Docker引擎的基础，以及其他支持它的Docker产品。




## Dockerizing applications: A “Hello world” |Docker你的应用：一个“世界你好”

*How do I run applications inside containers? |怎么在容器中跑应用？* 

Docker Engine offers a containerization platform to power your applications. To learn how to Dockerize applications and run them:
Docker引擎提供一种容器化平台去支持你的应用的方式。学习怎么Docker化应用并运行：

Go to Dockerizing Applications.
查看 [Docker化应用程序](https://docs.docker.com/engine/userguide/containers/dockerizing/)。




## Working with containers |使用容器

*How do I manage my containers? |怎么管理我的容器？*

Once you get a grip[?] on running your applications in Docker containers, you’ll learn how to manage those containers. To find out about how to inspect, monitor and manage containers:
当你能在Docker容器中运行你的应用的时候，你就学会怎么管理那些容器了。学习怎么检查、监视和管理你的容器：

Go to Working With Containers.
查看 [使用容器工作](https://docs.docker.com/engine/userguide/containers/usingdocker/)




## Working with Docker images | 使用docker镜像  
*How can I access, share and build my own images? | 我怎么获取、分享和构建我的镜像？*

Once you’ve learnt how to use Docker it’s time to take the next step and learn how to build your own application images with Docker.
你学完怎么使用docker，就应该进行下一步了，学习使用docker构建你自己的应用。

Go to Working with Docker Images.
查看 [使用Docker镜像](https://docs.docker.com/engine/userguide/containers/dockerimages/)




## Networking containers | 联网的容器
Until now we’ve seen how to build individual applications inside Docker containers. Now learn how to build whole application stacks with Docker networking.
目前为止你看到怎么在docker容器中构建私人应用。现在学习怎么使用docker网络构建整个应用栈。

Go to Networking Containers.
查看 [联网的容器](https://docs.docker.com/engine/userguide/containers/networkingcontainers/)




## Managing data in containers | 管理容器中的数据 
Now we know how to link Docker containers together the next step is learning how to manage data, volumes and mounts inside our containers.
现在你知道了怎么把众多docker容器连接起来，下一步就是学习怎么管理这些容器内部的数据、容量和挂载。

Go to Managing Data in Containers.




<br>
<br>
<br>
<br>
-------------

# Docker products that complement Engine | docker引擎补充产品
Often, one powerful technology spawns many other inventions that make that easier to get to, easier to use, and more powerful. These spawned things share one common characteristic: they augment the central technology. The following Docker products expand on the core Docker Engine functions.
通常，一个强大的技术会产生很多其他创新，以便让它的获取和使用更简单，并变得更强大。这些产生的东西有一个共同点，放大了中心的技术。以下docker产品扩展了核心docker引擎的功能。


## Docker Hub
Docker Hub is the central hub for Docker. It hosts public Docker images and provides services to help you build and manage your Docker environment. To learn more:
Go to Using Docker Hub. 
docker hub是docker的核心。它是docker公开镜像的主机，提供构建和管理docker环境的服务。了解更多，请访问[使用docker hub](https://docs.docker.com/docker-hub)。


## Docker Machine
Docker Machine helps you get Docker Engines up and running quickly. Machine can set up hosts for Docker Engines on your computer, on cloud providers, and/or in your data center, and then configure your Docker client to securely talk to them.
docker Machine帮助你使用docker引擎，并加速运行。Machine可以在你的电脑，云端，和/或你的数据中心建立docker引擎服务器，然后配置docker客户端去安全的连接它们。

Go to Docker Machine user guide.
查看 [Docker Machine 用户指南](https://docs.docker.com/machine/)



## Docker Compose
Docker Compose allows you to define a application’s components -- their containers, configuration, links and volumes -- in a single file. Then a single command will set everything up and start your application running.
Docker Compose 可以让你在一个文件中定义一个应用的组件，包括它们的容器、配置、链接和容量。然后单文件就会建立起来一切，并开启你的应用。

Go to Docker Compose user guide.
查看 [Docker Compose 用户指南](https://docs.docker.com/compose/)

## Docker Swarm
Docker Swarm pools several Docker Engines together and exposes them as a single virtual Docker Engine. It serves the standard Docker API, so any tool that already works with Docker can now transparently scale up to multiple hosts.
Docker Swarm汇集了若干Docker引擎，并把它们暴露成单个虚拟docker引擎。它作为标准docker API，所以任何docker可以工作的工具现在可以透明的放大到多台主机。

Go to Docker Swarm user guide.
查看 [Docker Swarm 用户指南](https://docs.docker.com/Swarm/)












<br>
<br>
<br>
<br>
-----------


# Getting help
	- [Docker homepage](https://www.docker.com/)
	- [Docker Hub](https://hub.docker.com/)
	- [Docker blog](https://blog.docker.com/)
	- [Docker documentation](https://docs.docker.com/)
	- [Docker Getting Started Guide](https://docs.docker.com/mac/started/)
	- [Docker code on GitHub](https://github.com/docker/docker)
	- [Docker mailing list](https://groups.google.com/forum/#!forum/docker-user)
	- Docker on IRC: irc.freenode.net and channel #docker
	- [Docker on Twitter](https://twitter.com/docker)
	- Get [Docker help](https://stackoverflow.com/search?q=docker) on StackOverflow
	- [Docker.com](https://www.docker.com/)

