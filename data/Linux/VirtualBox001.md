VirtualBox v5.0.14
================

环境：win7  

安装：VirtualBox v5.0.14  

# 新建虚拟机  

点击工具栏 新建(N)，设置硬盘、内存等。参照 [百度经验](http://jingyan.baidu.com/article/67508eb4de2ae59cca1ce422.html) 

> 错误提示：运行Virtualbox去安装系统时出错：Failed to open a session for the virtual machine，Unable to load R3 module xxxx/VBoxDD.DLL(VBoxDD)，GetLastError=126，(VERR_MODULE_NOT_FOUND)
> 解决方案参考：http://blog.sina.com.cn/s/blog_4dc988240102vj8a.html


## 报错 VirtualBox安装问题--错误码0x80004002
之前一直都是用真机测试，然而想跑下模拟器，上genymotion官网安装遇到问题。

解决方案 修改注册表
1.Win+R     输入regedit打开注册表   
2.找到 HKEY_CLASSES_ROOT\CLSID\{00020420-0000-0000-C000-000000000046}\InprocServer32   把默认值修改为C:\Windows\System32\oleaut32.dll
3.找到 HKEY_CLASSES_ROOT\CLSID\{00020424-0000-0000-C000-000000000046}\InprocServer32   把默认值修改为C:\Windows\System32\oleaut32.dll

然后重新打开VirtualBox







# 安装Ubuntu 1404系统

1. Ctrl+Alt+T 调出ubuntu的命令行窗口；
2. 安装ssh服务: $ sudo apt-get install openssh-server (如果版本太古老，可能需要更新 sudo apt upgrade 和 sudo apt-get update 或重装新版本)
3. 查看是否启动了ssh服务: $ ps -e | grep ssh 
4. 查看IP的命令: $ ifconfig, 可以看到 HWaddr 08:00:27:a3:9d:85 是网卡MAC， inet addr:192.168.2.203 是IP地址；
5. 然后就可以局域网内部ssh登录了。 
6. 如果想让虚拟机有独立IP，则需要设置虚拟机为桥接网络(点击该虚拟机，点击顶部设置(S),选择左侧 网络，右侧 连接方式选择 桥接网卡)。

> 错误提示: "No root file system is defined, please correct this from the partitioning menu"。 参照 [这样划分硬盘](http://www.cnblogs.com/zhcncn/p/3987301.html)

```
	/boot	100MB
	/	10 000MB
	/home	5 000MB  
	swap	2000MB
free space	78MB
```


## Ubuntu1804 iso下载地址

1. 清华镜像 https://mirror.tuna.tsinghua.edu.cn/ubuntu-releases/18.04.3/ubuntu-18.04.3-desktop-amd64.iso
2. 交大镜像 http://ftp.sjtu.edu.cn/ubuntu-cd/18.04.3/ubuntu-18.04.3-desktop-amd64.iso
3. 修改下载源 https://blog.csdn.net/qq_39263240/article/details/79342582






# FAQ

## VirtualBox主机与虚拟机不能复制粘贴的解决办法
http://jingyan.baidu.com/article/574c521917db806c8d9dc18c.html
常规高级里共享粘贴板已经选中双向，但还是不能复制粘贴，这时到虚拟机设置-存储-控制器SATA-勾选"使用主机输入输出(I/O)缓存"，再同样在存储-控制器SATA-点击***.vdi-勾选"固态驱动器"，重启虚拟机就可以了～


## 修复 VirtualBox 下 Ubuntu 14.10 屏幕分辨率问题
http://www.oschina.net/question/12_178184
你需要安装一个 VirtualBox 的额外组件到你的 Ubuntu-Guest 中，可运行如下命令：
`sudo apt-get install virtualbox-guest-dkms`
安装完毕需要重启虚拟机就可以。



## 怎么让virtualBox中的Ubuntu和win7物理机共享文件夹？
http://jingyan.baidu.com/article/2fb0ba40541a5900f2ec5f07.html
1.打开ubuntu系统，虚拟机菜单 设备-安装增强功能，输入root密码后安装；
2.物理机上新建文件夹bdshare（名字可以自定义）作为共享文件夹，右击设置为共享；
3.虚拟机菜单 设备-共享文件夹，打开共享文件夹设置，点击右上角的添加按钮；
4.选择之前物理机上设置的共享文件夹，勾选固定分配，此时一定不可以勾选自动挂载（加上也行，下次共享文件夹启动还在）。
5.进入Ubuntu系统，【ctrl+alt+T】打开终端，先执行新建文件夹命令，在挂载点目录添加“bdshare”目录，接着执行"mount -t vboxsf BaiduShare /mnt/bdshare/",就能完成共享文件夹的设置。

```
# mkdir /mnt/bdshare  创建共享目录
# mount -t vboxsf BaiduShare /mnt/bdshare/   后两个参数分别是共享名和挂载点  
```

设置完成，可以创建几个文件，测试一下。测试方法：
	- 在本地创建一个文件，到mnt/share/目录 查看。
	- 在share目录创建一个文件，在本机进行查看。
 
6.卸载挂载点命令：umount -f /mnt/share   
 

 
 

 
## oracle virtualbox如何移动虚拟机目录？
默认是在c盘的，会越来越大，怎么处理？移动到另一个打的盘上。
(1)菜单——管理——全局设定 ，常规：更改 默认虚拟电脑位置。

(2)复制 （移动）现有虚拟机目录到新位置，删除现有虚拟机(右击删除-只是移除)，然后 菜单——控制——注册，导入虚拟机 配置 。
提问者评价
正解。“注册”完成的是导入的功能。






## 安装后，怎么样才能有独立IP？让虚拟机像一台物理机一样。
点击该虚拟机，点击顶部设置(S),选择左侧 网络，右侧 连接方式选择 桥接网卡。OK确定。








<br>
<br>
<br>
<br>
<br>
====================


# Ubuntu服务器命令行环境下VirtualBox的安装和管理  

1.确认版本号和位数：
```
//version of linux:
$ cat /etc/issue
Ubuntu 20.04.3 LTS \n \l

// bits of OS
$ sudo uname --m
x86_64
```


2.下载与安装 virtualbox
下载列表：https://www.virtualbox.org/wiki/Linux_Downloads

```
$ wget -b https://download.virtualbox.org/virtualbox/6.1.26/virtualbox-6.1_6.1.26-145957~Ubuntu~eoan_amd64.deb
-rw-rw-r--  1 wangjl wangjl   87M Jul 29 06:40 virtualbox-6.1_6.1.26-145957~Ubuntu~eoan_amd64.deb

$ sudo dpkg -i virtualbox-6.1_6.1.26-145957~Ubuntu~eoan_amd64.deb
安装重启完成后，登录。 
报错
dpkg: dependency problems prevent configuration of virtualbox-6.1:
 virtualbox-6.1 depends on libqt5opengl5 (>= 5.0.2); however:
  Package libqt5opengl5 is not installed.
 virtualbox-6.1 depends on libqt5x11extras5 (>= 5.6.0); however:
  Package libqt5x11extras5 is not installed.
 virtualbox-6.1 depends on libsdl1.2debian (>= 1.2.11); however:
  Package libsdl1.2debian is not installed.

E: Unmet dependencies. Try 'apt --fix-broken install' with no packages (or specify a solution).
$ sudo apt --fix-broken install
再次安装，正常。
```

3.下载虚拟机iso系统文件  
https://mirrorz.org/os/ubuntu
```
## https://mirrors.dgut.edu.cn/ubuntu-releases/focal/ubuntu-20.04.3-desktop-amd64.iso #另一个地址？
$ wget -c  https://mirrors.dgut.edu.cn/ubuntu-releases/20.04.3/ubuntu-20.04.3-desktop-amd64.iso #桌面版

-rw-rw-r-- 1 wangjl wangjl 2.9G Sep 18 16:36 /data/wangjl/soft/ubuntu/ubuntu-20.04.3-desktop-amd64.iso
```





4.进入vb图形界面操作
- https://tastethelinux.com/install-virtualbox-on-ubuntu-linux/
- https://brb.nci.nih.gov/seqtools/installUbuntu.html

(1) 点击 ubuntu 20.04 左上角 activities，输入 vit 点击出现的 vb 图标，打开 vb manager 图形界面。
(2) 点击 界面右侧 preferences，设定机器文件夹。
默认是 /home/wangjl/VirtualBox VMs
改为 /home/wangjl/data/VirtualBox_VMs

(3) 创建新虚拟机，并设置
界面右侧 new,
输入名字: ubt20
内存设置: 2048M
硬盘设置: 默认 10G;

(4) 安装系统
点右侧 settings，storage, 选择 IDE -empty，右侧选择 iso系统文件。
点右侧 start，开始安装系统。

点击 install ubuntu;
键盘 默认；
更新与软件：改选最小安装(不需要浏览器/办公/播放器等)，安装时下载更新 保留，不安装第三方软件。
安装方式：默认 擦除硬盘安装Ubuntu。

时区：上海；

name: 随便写
computer name: wangVM
username: wang 
passwd: 最简单的，三位数。
然后等待复制文件。 16:57--> 18:43 点击重启按钮。

查看，已经删除 iso 文件了。

(5) 双击启动 虚拟机中的系统。
回车。等待启动。
一路选择右上角的 next 跳过这些设置，到桌面。
右击桌面，选择 打开终端。
安装基本软件。

$ sudo apt-get install openssh-server net-tools vim
检查 sshd 进程:
$ ps -aux | grep sshd
root        2543  0.0  0.3  12184  6768 ?        Ss   18:51   0:00 sshd: /usr/sbin/sshd -D [listener] 0 of 10-100 startups



(6) 怎么获取独立ip呢？
vb 选择settings，network，选择 桥接模式。
网卡选择 eno1.
进虚拟机，断网再重连。
$ ifconfig 
查看虚拟机的ip地址是: 192.168.2.156

vb所在主机能ping通。
$ ping 192.168.2.156



(7) 保存快照
单机左侧虚拟机，点击三横线，点击snapshot，右侧点击 Take，填写名字 origin0.
接着就可以随便造了，搞坏了就回到该快照。


(8) 安装 docker
```
Ubuntu 20.04.3 LTS (GNU/Linux 5.11.0-34-generic x86_64)

$ sudo apt update
$ sudo apt install docker.io
$ docker --version
Docker version 20.10.7, build 20.10.7-0ubuntu1~20.04.1

查看权限
$ ls -lth /var/run/docker.sock
srw-rw---- 1 root docker 0 Sep 18 19:07 /var/run/docker.sock

$ sudo gpasswd -a $USER docker #将登陆用户加入到docker用户组中
$ su wang #重新登陆
$ groups
wang adm cdrom sudo dip plugdev lpadmin lxd sambashare docker


添加国内镜像源
$ sudo vim /etc/docker/daemon.json
{
  "registry-mirrors": [
	"https://registry.cn-hangzhou.aliyuncs.com",
	"https://reg-mirror.qiniu.com/"
  ]
}
sudo systemctl daemon-reload
sudo systemctl restart docker

下载镜像 
$ docker pull nginx
$ docker run --rm -d -p 80:80 nginx

$ docker ps
CONTAINER ID   IMAGE     COMMAND                  CREATED         STATUS         PORTS                               NAMES
0dc849217611   nginx     "/docker-entrypoint.…"   6 seconds ago   Up 3 seconds   0.0.0.0:80->80/tcp, :::80->80/tcp   confident_lumiere
```
访问主机 ip，能看到nginx欢迎页 http://192.168.2.156/



<br>
<br>
<br>
<br>
<br>
<br>
一下是命令行操作虚拟机，没尝试成功。
<hr>

## 共享网卡  
然后用如下命令安装bridge-utils。这个工具可将一块物理网卡变成一个虚拟网桥，以便使多台虚拟机共享这同一个网卡。
`sudo apt-get install bridge-utils`


## 新建虚拟机  
第一台虚拟机，我起名叫ngs，它将成为折腾无界面的测序软件的容器。
```
$ vboxmanage createvm --name "ngs" --ostype Ubuntu_64 --register
Virtual machine 'ngs' is created and registered.
UUID: 1c9b4a4f-8501-40a9-aa63-36c077fc5f17
```

VirtualBox会自动创建一个名叫”VirtualBox VMs”的子目录，所有的虚拟机都会保存在这个目录内。我们进入对应于ngs的子目录。
`$ cd ~/VirtualBox\ VMs/ngs/`


指定ngs使用2G内存、使用ACPI、启动顺序为先光盘再硬盘
```
$ vboxmanage modifyvm "ngs" --memory 2048 --acpi on --boot1 dvd --boot2 disk

产生新文件
wangjl@Bioinf1:~/VirtualBox VMs/ngs$ ls
ngs.vbox  ngs.vbox-prev
```




**配置网卡**  

把eth0配置成了从ISP处自动获取IP，而eth1将用于连接局域网内的其他计算机。两块网卡均配置为虚拟网桥（分别为br0和br1）。


```
$ sudo vi /etc/network/interfaces
    auto lo
    iface lo inet loopback

	auto br0
    iface br0 inet dhcp
        bridge_ports eth0
        bridge_fd 9
        bridge_hello 2
        bridge_maxage 12
        bridge_stp off

    auto br1
    iface br1 inet static
        address 10.83.77.1
        netmask 255.255.255.0
        network 10.83.77.0
        broadcast 10.83.77.255
        bridge_ports eth1
        bridge_fd 9
        bridge_hello 2
        bridge_maxage 12
        bridge_stp off
```


指定虚拟网卡1使用物理服务器上已经配置好的br0网桥（对外连接），并指定虚拟桌面使用物理服务器上的5911端口。
`vboxmanage modifyvm "ngs" --nic1 bridged --nictype1 virtio --bridgeadapter1 br0 --vrde on --vrdeport 5911`
(注意：br0替换为可用的网卡，ifconfig命令查找)

指定虚拟网卡2使用br1网桥（对内连接）  
`vboxmanage modifyvm "ngs" --nic2 bridged --nictype2 virtio --bridgeadapter2 br1`
(注意：br1替换为可用的网卡，ifconfig命令查找)











**配置硬盘**  
创建一个虚拟硬盘，最大容量30G（实际用量将随着文件增加而增加，上限为30G）
```
wangjl@Bioinf1:~/VirtualBox VMs/ngs$ vboxmanage createhd --filename ngs.vdi --size 30000
0%...10%...20%...30%...40%...50%...60%...70%...80%...90%...100%
Medium created. UUID: 0b272bc8-9a28-4586-a302-7898263d603e
```




创建虚拟硬盘控制器，使用SCSI接口，并将刚刚创建的虚拟硬盘连接到这个控制器
```
vboxmanage storagectl "ngs" --name "SCSI Controller" --add scsi
vboxmanage storageattach "ngs" --storagectl "SCSI Controller" --port 0 --device 0 --type hdd --medium ngs.vdi
```



创建虚拟硬盘控制器，使用IDE接口，并把ISO文件连接到这个接口（虚拟光驱）  
```
vboxmanage storagectl "ngs" --name "IDE Controller" --add ide
vboxmanage storageattach "ngs" --storagectl "IDE Controller" --port 0 --device 0 --type dvddrive --medium ../../ISO/ubuntu-14.04.4-server-amd64.iso
```


完成了，启动这台虚拟机吧！注意–type headless参数，这个是必须的，因为我们是在Ubuntu服务器的命令行环境下启动虚拟机，无法使用图形界面。我们将通过VRDE虚拟桌面来安装虚拟机上的操作系统。

```
$ vboxmanage startvm "ngs" --type headless
Waiting for VM "ngs" to power on...
VM "ngs" has been successfully started.


启动失败，报错。。。[网卡修改为可用的之后就正常了]
Waiting for VM "ngs" to power on...
VBoxManage: error: Failed to open/create the internal network 'HostInterfaceNetworking-wlan0' (VERR_INTNET_FLT_IF_NOT_FOUND).
VBoxManage: error: Failed to attach the network LUN (VERR_INTNET_FLT_IF_NOT_FOUND)
VBoxManage: error: Details: code NS_ERROR_FAILURE (0x80004005), component ConsoleWrap, interface IConsole
wangjl@Bioinf1:~/VirtualBox VMs/ngs$
```

如果启动失败，Try loading the kernel module (network filter driver) manually : `sudo modprobe vboxnetflt`






## 安装虚拟机操作系统

从网络上另一台运行Windows的计算机（或者Mac OSX、Ubuntu Desktop的都可以，只要有图形用户界面），启动远程桌面（Mac OS X或Ubuntu下就找一个VNC客户端软件，通常这些操作系统都已经自带一个了），连接到物理服务器的内网卡（10.83.77.1），端口号用上面设置的VRDE端口号（我这里是5911），你就可以看到虚拟机的安装界面了。然后像安装物理服务器一样安装即可。

其他虚拟机的安装过程与ngs服务器很相似。只是在指定VRDE端口号时，注意每台虚拟服务器都需要指定唯一的端口号，我的建议是，假设IP地址尾数是11，那么端口号就选5911；IP地址尾数是12，端口号就选5912，以此类推。这样记忆起来比较简单，逻辑关系也比较清晰。

这个教程到此结束。关于虚拟服务器的配置管理，将会有一系列的文章，敬请关注！



## VirtualBox的常用命令

	- 启动虚拟机：vboxmanage startvm vm-name
	- 关机（相当于直接拔电线）：vboxmanage controlvm vm-name poweroff
	- 软关机（相当于按一下电源键，如果虚拟机的操作系统支持，就会启动关机过程）：vboxmanage controlvm vm-name acpipowerbutton
	- 查看虚拟机配置：vboxmanage showvminfo vm-name
	- 查看全部虚拟机列表：vboxmanage list vms
	- 查看正在运行的虚拟机列表：vboxmanage list runningvms


