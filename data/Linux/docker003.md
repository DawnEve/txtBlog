使用Dockerfile创建Docker镜像
========================

# Dockerfile
Dockerfile是docker构建镜像的基础，也是docker区别于其他容器的重要特征，正是有了Dockerfile，docker的自动化和可移植性才成为可能。

**不论是开发还是运维，学会编写Dockerfile几乎是必备的**，这有助于你理解整个容器的运行。




## Build your own images |build自己的镜像 
Docker images are the basis of containers. Each time you’ve used docker run you told it which image you wanted. In the previous sections of the guide you used Docker images that already exist, for example the ubuntu image and the training/webapp image.
docker镜像是容器的基础。每次使用docker运行，你需要告诉它你需要哪个镜像。指南之前的章节中，你使用的是已经存在的docker镜像，比如ubuntu镜像以及training/webapp镜像。


You also discovered that Docker stores downloaded images on the Docker host. If an image isn’t already present on the host then it’ll be downloaded from a registry: by default the Docker Hub Registry.
你也发现了docker保存下载的镜像到docker服务器。如果主机上镜像不存在，他就从登记处下载:默认是 [docker hub集市](https://registry.hub.docker.com/). 


In this section you’re going to explore Docker images a bit more including:
本节你将要探索更多docker镜像，包括：
	- Managing and working with images locally on your Docker host. |在你的docker主机本地管理和使用镜像  
	- Creating basic images. |创建基本镜像。  
	- Uploading images to Docker Hub Registry. |上传镜像到 [docker hub集市](https://registry.hub.docker.com/)。  




	
	
## Listing images on the host | 列举主机上的镜像	
Let’s start with listing the images you have locally on our host. You can do this using the docker images command like so:	
我们开始列举主机本地上的镜像。使用 docker images 命令：
```
$ docker images
REPOSITORY          TAG                 IMAGE ID            CREATED             SIZE
ubuntu              14.04               1d073211c498        3 days ago          187.9 MB
busybox             latest              2c5ac3f849df        5 days ago          1.113 MB
training/webapp     latest              54bb4e8718e8        5 months ago        348.7 MB
```

You can see the images you’ve previously used in the user guide. Each has been downloaded from Docker Hub when you launched a container using that image. When you list images, you get three crucial pieces of information in the listing.
你可以看到之前指南中用到的镜像。每个镜像都是当你使用镜像启动一个容器时从docker hub下载的。当你列表显示镜像时，你获得了三条重要信息。

	- What repository they came from, for example ubuntu. |来自于哪个仓库，比如 ubuntu
	- The tags for each image, for example 14.04. | 每个镜像的标签，比如 14.04  
	- The image ID of each image. |每个镜像的id  


> Tip: You can use a third-party dockviz tool or the Image layers site to display visualizations of image data.
提示：可以使用第三方的dockviz工具或者镜像层网站来展示可视化镜像数据。


A repository potentially holds multiple variants of an image. In the case of our ubuntu image you can see multiple variants covering Ubuntu 10.04, 12.04, 12.10, 13.04, 13.10 and 14.04. Each variant is identified by a tag and you can refer to a tagged image like so:
一个仓库可能包含镜像的很多变体。在本例的ubuntu镜像中，你可以看到涵盖ubuntu 10.04, 12.04, 12.10, 13.04, 13.10 和 14.04的很多变体。每个变体由一个标签标示，你可以像这样指定一个带标签的镜像：`ubuntu:14.04`

So when you run a container you refer to a tagged image like so:
所以，当你运行一个容器时，你可以这样指定一个带标签的镜像：
`$ docker run -t -i ubuntu:14.04 /bin/bash`



If instead you wanted to run an Ubuntu 12.04 image you’d use:
如果你想运行一个ubuntu 12.04镜像，你可以使用
`$ docker run -t -i ubuntu:12.04 /bin/bash`

If you don’t specify a variant, for example you just use ubuntu, then Docker will default to using the ubuntu:latest image.
如果不指定哪个变体，比如仅仅使用 ubuntu ，docker将会使用 ubuntu:latest 镜像。

> Tip: You should always specify an image tag, for example ubuntu:14.04. That way, you always know exactly what variant of an image you are using. This is useful for troubleshooting and debugging.
提示：你应该总是指定一个镜像标签，比如 ubuntu:14.04. 那样，你总是知道你使用的镜像变体的准确版本。这对于排错和调试很有用。




## Getting a new image | 获得一个新的镜像  
So how do you get new images? Well Docker will automatically download any image you use that isn’t already present on the Docker host. But this can potentially add some time to the launch of a container. If you want to pre-load an image you can download it using the docker pull command. Suppose you’d like to download the centos image.
怎么获得新镜像？如果你的docker主机上没有你要使用的镜像，docker会自动下载。但这会让启动一个容器慢一些。如果你想预先载入一个镜像，你可以使用docker pull命令。假设你想下载centos镜像。

```
$ docker pull centos
Pulling repository centos
b7de3133ff98: Pulling dependent layers
5cc9e91966f7: Pulling fs layer
511136ea3c5a: Download complete
ef52fb1fe610: Download complete
. . .

Status: Downloaded newer image for centos
```


You can see that each layer of the image has been pulled down and now you can run a container from this image and you won’t have to wait to download the image.
可以看到拉取的镜像的每一层，现在你可以从这个镜像运行容器，无需等待下载了。

```
$ docker run -t -i centos /bin/bash
bash-4.1#
```




## Finding images |查找镜像 
One of the features of Docker is that a lot of people have created Docker images for a variety of purposes. Many of these have been uploaded to Docker Hub. You can search these images on the Docker Hub website.
docker的一个特点是：很多人处于不同目的创建很多镜像。很多已经上传到docker hub。你可以在 [docker hub](https://hub.docker.com/)上搜索这些镜像。

![docker hub](https://docs.docker.com/engine/userguide/containers/search.png)


You can also search for images on the command line using the docker search command. Suppose your team wants an image with Ruby and Sinatra installed on which to do our web application development. You can search for a suitable image by using the docker search command to find all the images that contain the term sinatra.
你也可以在命令行使用docker search命令。假如你的团队想要一个安装Ruby 和 Sinatra的镜像，以便进行网络开发。你可以使用docker search命令查找所有包含sinatra条目的镜像。  


```
$ docker search sinatra
NAME                                   DESCRIPTION                                     STARS     OFFICIAL   AUTOMATED
training/sinatra                       Sinatra training image                          0                    [OK]
marceldegraaf/sinatra                  Sinatra test app                                0
mattwarren/docker-sinatra-demo                                                         0                    [OK]
luisbebop/docker-sinatra-hello-world                                                   0                    [OK]
bmorearty/handson-sinatra              handson-ruby + Sinatra for Hands on with D...   0
subwiz/sinatra                                                                         0
bmorearty/sinatra                                                                      0
. . .
```





You can see the command returns a lot of images that use the term sinatra. You’ve received a list of image names, descriptions, Stars (which measure the social popularity of images - if a user likes an image then they can “star” it), and the Official and Automated build statuses. Official Repositories are a carefully curated set of Docker repositories supported by Docker, Inc. Automated repositories are Automated Builds that allow you to validate the source and content of an image.
可以看到使用sinatra关键词返回很多镜像。你已经收到了镜像列表，包括名字、描述、星标（描述镜像的社区流行程度，如果使用者喜欢一个镜像就可以加星），官方和自动构建状态。官方仓库是docker公司支持的，良好监管的docker仓库的集合。自动构建仓库会自动构建，允许你验证镜像的源和内容。


You’ve reviewed the images available to use and you decided to use the training/sinatra image. So far you’ve seen two types of images repositories, images like ubuntu, which are called base or root images. These base images are provided by Docker Inc and are built, validated and supported. These can be identified by their single word names.
你已经浏览可用镜像列表，并决定使用 training/sinatra 镜像。目前，你已经看到两类镜像仓库，向ubuntu一样被称为基础或根镜像。那些镜像是docker公司提供或建立、验证和支持的。这类镜像可以用一个单词识别。


You’ve also seen user images, for example the training/sinatra image you’ve chosen. A user image belongs to a member of the Docker community and is built and maintained by them. You can identify user images as they are always prefixed with the user name, here training, of the user that created them.
你也见过用户的镜像，比如你选择的 training/sinatra 镜像。 用户镜像属于docker社区成员，并由他们建立和维护。你可以通过创建者的用户名前缀识别他们，比如这里的training。 




## Pulling our image |拉取镜像
You’ve identified a suitable image, training/sinatra, and now you can download it using the docker pull command.
你已经发现一个合适的镜像，training/sinatra，
`$ docker pull training/sinatra`

The team can now use this image by running their own containers.
现在团队可以在自己的容器中使用该镜像了。

```
$ docker run -t -i training/sinatra /bin/bash
root@a8cb6ce02d85:/#
```










<br>
<br>
<br>
<br>
<br>
------------------------



# Creating our own images | 创建自己的镜像 
https://docs.docker.com/engine/userguide/containers/dockerimages/

The team has found the training/sinatra image pretty useful but it’s not quite what they need and you need to make some changes to it. There are two ways you can update and create images.
如果小组发现某个镜像很有用，但是不是他们确切需要的，他们想做些改动。有两种方法更新和创建镜像：
	1. You can update a container created from an image and commit the results to an image. |你可以更新一个来自某个镜像的容器，然后把结果提交成镜像。
	2. You can use a Dockerfile to specify instructions to create an image. |可以使用Dockerfile来指定参数，创建镜像。

注：其中前者在 快速入门 教程中已经演示过。本文主要介绍Dockerfile。







# Building an image from a Dockerfile |从 Dockerfile 构建镜像    

Using the docker commit command is a pretty simple way of extending an image but it’s a bit cumbersome and it’s not easy to share a development process for images amongst a team. Instead you can use a new command, docker build, to build new images from scratch.
使用docker的commit命令是一个相当简单的扩展一个镜像的方式，但是很笨重，而且不容易在团队中分享开发进程。替代方案是使用新的命令，docker build，抓取建立镜像。  


To do this you create a Dockerfile that contains a set of instructions that tell Docker how to build our image.
你需要建立一个包含一系列指令的Dockerfile，告诉Docker怎么建立你需要的镜像。

First, create a directory and a Dockerfile.
首先创建一个目录和一个Dockerfile。
```
$ mkdir sinatra
$ cd sinatra
$ touch Dockerfile
```

If you are using Docker Machine on Windows, you may access your host directory by cd to /c/Users/your_user_name.
如果你是在windows上使用Docker Machine，你可以通过cd命令到达你的家目录  /c/Users/your_user_name.

Each instruction creates a new layer of the image. Try a simple example now for building your own Sinatra image for your fictitious development team.
每一条指令创建镜像的一个新层。现在尝试一个新的例子，为你虚构的开发团队构建你的sinatra镜像。

```
# This is a comment
FROM ubuntu:14.04
MAINTAINER Kate Smith <ksmith@example.com>
RUN apt-get update && apt-get install -y ruby ruby-dev
RUN gem install sinatra
```

Examine what your Dockerfile does. Each instruction prefixes a statement and is capitalized.
检查一下你的Dockerfile做了什么。每条指令都有一个大写的前缀声明。
`INSTRUCTION statement`


> Note: You use # to indicate a comment |注意：使用#指示注释。



The first instruction FROM tells Docker what the source of our image is, in this case you’re basing our new image on an Ubuntu 14.04 image. The instruction uses the MAINTAINER instruction to specify who maintains the new image.
第一个指令FROMO告诉Docker镜像的来源，本例是基于Ubuntu 14.04镜像的。指令MAINTAINER指定维护者。


Lastly, you’ve specified two RUN instructions. A RUN instruction executes a command inside the image, for example installing a package. Here you’re updating our APT cache, installing Ruby and RubyGems and then installing the Sinatra gem.
最后，列出了两条RUN指令。RUN指令执行一个镜像内部命令，比如安装一个包。这里是更新我们的APT缓存，安装Ruby和RubyGems，然后安装Sinatra gem。

Now let’s take our Dockerfile and use the docker build command to build an image.
现在我们拿出我们的Dockerfile，使用docker build命令建立一个镜像。

```
$ docker build -t ouruser/sinatra:v2 .

root@wjl-VirtualBox:/home/wjl/sinatra# docker build -t dawneve/sinatra:v2 .
Sending build context to Docker daemon 2.048 kB
Step 1 : FROM ubuntu:14.04
14.04: Pulling from library/ubuntu
5a132a7e7af1: Already exists 
fd2731e4c50c: Already exists 
28a2f68d1120: Already exists 
a3ed95caeb02: Already exists 
Digest: sha256:45b23dee08af5e43a7fea6c4cf9c25ccf269ee113168c19722f87876677c5cb2
Status: Downloaded newer image for ubuntu:14.04
 ---> 07c86167cdc4
Step 2 : MAINTAINER Kate Smith <ksmith@example.com>
 ---> Running in f5a7456c0484
 ---> 000ce535b66f
Removing intermediate container f5a7456c0484
Step 3 : RUN apt-get update && apt-get install -y ruby ruby-dev
 ---> Running in c3fa34fc9dc6
Ign http://archive.ubuntu.com trusty InRelease
Get:1 http://archive.ubuntu.com trusty-updates InRelease [65.9 kB]
Get:2 http://archive.ubuntu.com trusty-security InRelease [65.9 kB]
Hit http://archive.ubuntu.com trusty Release.gpg
Hit http://archive.ubuntu.com trusty Release
Get:3 http://archive.ubuntu.com trusty-updates/main Sources [328 kB]
Get:4 http://archive.ubuntu.com trusty-updates/restricted Sources [5217 B]
Get:5 http://archive.ubuntu.com trusty-updates/universe Sources [189 kB]
...
Processing triggers for ca-certificates (20160104ubuntu0.14.04.1) ...
Updating certificates in /etc/ssl/certs... 173 added, 0 removed; done.
Running hooks in /etc/ca-certificates/update.d....done.
 ---> c468f50df060
Removing intermediate container c3fa34fc9dc6
Step 4 : RUN gem install sinatra
 ---> Running in 4d9c30cbfd23
unable to convert "\xC3" to UTF-8 in conversion from ASCII-8BIT to UTF-8 to US-ASCII for README.rdoc, skipping
unable to convert "\xC3" to UTF-8 in conversion from ASCII-8BIT to UTF-8 to US-ASCII for README.rdoc, skipping
Successfully installed rack-1.6.4
Successfully installed tilt-2.0.2
Successfully installed rack-protection-1.5.3
Successfully installed sinatra-1.4.7
4 gems installed
Installing ri documentation for rack-1.6.4...
Installing ri documentation for tilt-2.0.2...
Installing ri documentation for rack-protection-1.5.3...
Installing ri documentation for sinatra-1.4.7...
Installing RDoc documentation for rack-1.6.4...
Installing RDoc documentation for tilt-2.0.2...
Installing RDoc documentation for rack-protection-1.5.3...
Installing RDoc documentation for sinatra-1.4.7...
 ---> 8e6dfd8a8d9f
Removing intermediate container 4d9c30cbfd23
Successfully built 8e6dfd8a8d9f
```



You’ve specified our docker build command and used the -t flag to identify our new image as belonging to the user ouruser, the repository name sinatra and given it the tag v2.
现在你已经指定了docker build命令，使用`-t`表明我们的新镜像属于用户ouruser，仓库名sinatra，标签v2。

You’ve also specified the location of our Dockerfile using the . to indicate a Dockerfile in the current directory.
使用`.`指定Dockerfile的位置是当前目录。


> Note: You can also specify a path to a Dockerfile.| 注释：你也可以指定Dockerfile的路径。



Now you can see the build process at work. The first thing Docker does is upload the build context: basically the contents of the directory you’re building in. This is done because the Docker daemon does the actual build of the image and it needs the local context to do it.
现在你可以看到正在工作的build过程。docker首先上传build上下文：基本上就是你正在build的文件夹。做这些是因为docker守护进程需要本地上下文来build镜像。



Next you can see each instruction in the Dockerfile being executed step-by-step. You can see that each step creates a new container, runs the instruction inside that container and then commits that change - just like the docker commit work flow you saw earlier. When all the instructions have executed you’re left with the 97feabe5d2ed image (also helpfully tagged as ouruser/sinatra:v2) and all intermediate containers will get removed to clean things up.
接下来你可以看到 Dockerfile 的指令一步一步执行。没可以看到每一步建立一个新容器，在其中运行指令，然后提交变化——就像你之前看到的docker的commit工作流。当所有指令执行完毕后，得到了97feabe5d2ed镜像（也同样被打上标签 ouruser/sinatra:v2），所有中间容器都将被移除以便清理干净。








> Note: An image can’t have more than 127 layers regardless of the storage driver. This limitation is set globally to encourage optimization of the overall size of images. 
注意：不管什么样的存储驱动，一个镜像都不能超过127层。这个限制是全局的，以鼓励优化镜像的总体尺寸。

You can then create a container from our new image.
你可以从我们的新镜像创建一个容器。

```
$ docker run -t -i ouruser/sinatra:v2 /bin/bash
root@8196968dac35:/#
```

> Note: This is just a brief introduction to creating images. We’ve skipped a whole bunch of other instructions that you can use. We’ll see more of those instructions in later sections of the Guide or you can refer to the Dockerfile reference for a detailed description and examples of every instruction. To help you write a clear, readable, maintainable Dockerfile, we’ve also written a Dockerfile Best Practices guide.
注意：这是一个创建镜像的简要介绍。我们已经跳过了很多其他可用指令。以后指导章节中我们可以看到更多指令，或者可以参考Dockerfile参考看每个指令的更详细的描述和例子。为了帮助你写一个清晰、可读、可维护的Dockerfile，我们写了一个[《Dockerfile最佳实践指南》](https://docs.docker.com/engine/userguide/eng-image/dockerfile_best-practices/)。


# Setting tags on an image |给一个镜像添加标签
You can also add a tag to an existing image after you commit or build it. We can do this using the docker tag command. Now, add a new tag to your ouruser/sinatra image.
可以在commit或build之后，给每一个已经存在的镜像添加标签。docker tag命令就可以做到。现在，为镜像ouruser/sinatra添加一个标签。

`$ docker tag 5db5f8471261 ouruser/sinatra:devel`

The docker tag command takes the ID of the image, here 5db5f8471261, and our user name, the repository name and the new tag.
docker tag命令需要镜像id（这里的5db5f8471261），以及我们的用户名、仓库名和新标签名。

Now, see your new tag using the docker images command.
现在，使用docker images命令查看新标签。
```
$ docker images ouruser/sinatra
REPOSITORY          TAG     IMAGE ID      CREATED        SIZE
ouruser/sinatra     latest  5db5f8471261  11 hours ago   446.7 MB
ouruser/sinatra     devel   5db5f8471261  11 hours ago   446.7 MB
ouruser/sinatra     v2      5db5f8471261  11 hours ago   446.7 MB
```





# Image Digests |镜像摘要(Digests)

Images that use the v2 or later format have a content-addressable identifier called a digest. As long as the input used to generate the image is unchanged, the digest value is predictable. To list image digest values, use the --digests flag:
使用v2（译者注：指的是docker规范第二版）或之后格式的镜像有一个上下文可寻址的标示符，就做digest。只要用于产生镜像的输入不变，digest值就是可预测的。列举镜像的digest值，使用 `--digests`标记：

```
$ docker images --digests | head
REPOSITORY        TAG      DIGEST                                                                     IMAGE ID      CREATED       SIZE
ouruser/sinatra   latest   sha256:cbbf2f9a99b47fc460d422812b6a5adff7dfee951d8fa2e4a98caa0382cfbdbf    5db5f8471261  11 hours ago  446.7 MB
```





> 译者注：我的没有显示digests值:
```
# docker images --digests
REPOSITORY          TAG                 DIGEST              IMAGE ID            CREATED             SIZE
dawneve/sinatra     v2                  <none>              8e6dfd8a8d9f        10 hours ago        320 MB  
```



When pushing or pulling to a 2.0 registry, the push or pull command output includes the image digest. You can pull using a digest value.
当推送或拉取到2.0注册[?]，push或pull命令输出包括镜像摘要。你可以使用一个摘要值拉取。

```
$ docker pull ouruser/sinatra@sha256:cbbf2f9a99b47fc460d422812b6a5adff7dfee951d8fa2e4a98caa0382cfbdbf
```


You can also reference by digest in create, run, and rmi commands, as well as the FROM image reference in a Dockerfile.
你可以在`create, run, rmi`命令，以及Dockerfile的`FROM`镜像参考中使用摘要参考。





# Push an image to Docker Hub |向Docker hub推送镜像 

Once you’ve built or created a new image you can push it to Docker Hub using the docker push command. This allows you to share it with others, either publicly, or push it into a private repository.
当你build或者新建一个新镜像后，你可以使用docker push命令把它推送到 [docker hub](https://hub.docker.com/)。这可以让你与其他人分享，公开或者推送到一个[私人仓库](https://registry.hub.docker.com/plans/)。

```
$ docker push ouruser/sinatra
The push refers to a repository [ouruser/sinatra] (len: 1)
Sending image list
Pushing repository ouruser/sinatra (3 tags)
. . .
```






# Remove an image from the host |从主机中移除镜像

You can also remove images on your Docker host in a way similar to containers using the docker rmi command.
你可以从你的docker host上移除主机，方法和 [容器类似](https://docs.docker.com/engine/userguide/containers/usingdocker/)，使用docker rmi命令。

Delete the training/sinatra image as you don’t need it anymore.
当你不需要 training/sinatra 镜像时可以删除它。

```
$ docker rmi training/sinatra
Untagged: training/sinatra:latest
Deleted: 5bc342fa0b91cabf65246837015197eecfa24b2213ed6a51a8974ae250fedd8d
Deleted: ed0fffdcdae5eb2c3a55549857a8be7fc8bc4241fb19ad714364cbfd7a56b22f
Deleted: 5c58979d73ae448df5af1d8142436d81116187a7633082650549c52c3a2418f0
```



> Note: To remove an image from the host, please make sure that there are no containers actively based on it.
注意：从host中移除镜像，请确认没有基于该镜像的容器处于激活状态[?]。 


# Next steps |下一步

Until now you’ve seen how to build individual applications inside Docker containers. Now learn how to build whole application stacks with Docker by networking together multiple Docker containers.
目前你已经知道如何在docker容器内部建立自己的应用。现在学习怎么使用docker，通过网络以及多个docker容器，建立全部应用栈。

Go to Network containers. |前往 [网络容器](https://docs.docker.com/engine/userguide/containers/networkingcontainers/)

























<br>
<br>
<br>
<br>
<br>

-----------------------





```
FROM , 从一个基础镜像构建新的镜像
FROM ubuntu 

MAINTAINER , 维护者信息
MAINTAINER William <wlj@nicescale.com>

ENV , 设置环境变量
ENV TEST 1

RUN , 非交互式运行shell命令
RUN apt-get -y update 
RUN apt-get -y install nginx

ADD , 将外部文件拷贝到镜像里,src可以为url
ADD http://nicescale.com/  /data/nicescale.tgz

WORKDIR /path/to/workdir, 设置工作目录
WORKDIR /var/www

USER , 设置用户ID
USER nginx

VULUME <#dir>, 设置volume
VOLUME [‘/data’]

EXPOSE , 暴露哪些端口
EXPOSE 80 443 

ENTRYPOINT [‘executable’, ‘param1’,’param2’]执行命令
ENTRYPOINT ["/usr/sbin/nginx"]

CMD [“param1”,”param2”]
CMD ["start"]

docker创建、启动container时执行的命令，如果设置了ENTRYPOINT，则CMD将作为参数
```




## Dockerfile最佳实践

	- 尽量将一些常用不变的指令放到前面
	- CMD和ENTRYPOINT尽量使用json数组方式
	
## 通过Dockerfile构建image
docker build csphere/nginx:1.7 .


## 镜像仓库Registry
镜像从Dockerfile build生成后，需要将镜像推送(push)到镜像仓库。企业内部都需要构建一个私有docker registry，这个registry可以看作二进制的scm，CI/CD也需要围绕registry进行。


## 部署registry
mkdir /registry
docker run  -p 80:5000  -e STORAGE_PATH=/registry  -v /registry:/registry  registry:2.0



## 推送镜像保存到仓库
假设192.168.1.2是registry仓库的地址：
```
docker tag  csphere/nginx:1.7 192.168.1.2/csphere/nginx:1.7
docker push 192.168.1.2/csphere/nginx:1.7
```


