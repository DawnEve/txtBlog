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

http://www.tuicool.com/articles/j6fMfa7


1.确认版本号和位数：
```
//version of linux:
$ cat /etc/issue
    Ubuntu 15.10 \n \l

// bits of OS
$ sudo uname --m
x86_64
```


2.下载  
下载列表：https://www.virtualbox.org/wiki/Linux_Downloads

`$ wget -b http://download.virtualbox.org/virtualbox/5.0.16/virtualbox-5.0_5.0.16-105871~Ubuntu~wily_amd64.deb`
pid=9097  


3.确保/home所在的分区有足够的空间  
（因为Virtual Box会在/home下建立一个子目录并用于存放虚拟机配置文件及虚拟硬盘，因此这个目录可能会变得很大！）。
安装重启完成后，登录。 


4.共享网卡  
然后用如下命令安装bridge-utils。这个工具可将一块物理网卡变成一个虚拟网桥，以便使多台虚拟机共享这同一个网卡。
`sudo apt-get install bridge-utils`

5.安装虚拟机  
`$ sudo dpkg -i virtualbox-5.0_5.0.16-105971~Ubuntu~wily_amd64.deb`


6.下载虚拟机系统文件  
ubuntu-14.04.4-server-amd64.iso          18-Feb-2016 00:10  579M  Server install image for 64-bit PC (AMD64) computers (standard download)
`
$ sudo wget -b  http://releases.ubuntu.com/trusty/ubuntu-14.04.4-server-amd64.iso
`

http://releases.ubuntu.com/trusty/
http://releases.ubuntu.com/precise/

Desktop CD
The desktop cd allows you to try Ubuntu without changing your computer at all, and at your option to install it permanently later. This type of cd is what most people will want to use. You will need at least 384MiB of RAM to install from this cd.
桌面版CD：可以不更改系统尝试ubuntu，后续决定是否永久安装。这是大多数人想试用的。从这个CD安装至少需要384MB的内存。

Server install CD
The server install cd allows you to install Ubuntu permanently on a computer for use as a server. It will not install a graphical user interface.
服务器版CD：永久安装到作为服务器的电脑上。不带图形化界面。



> 然后切换普通用户，进入该用户的家目录 `$cd` 。







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


