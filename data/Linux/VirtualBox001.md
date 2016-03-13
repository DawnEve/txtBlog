VirtualBox v5.0.14
================

环境：win7  

安装：VirtualBox v5.0.14  

# 新建虚拟机  

点击工具栏 新建(N)，设置硬盘、内存等。参照 [百度经验](http://jingyan.baidu.com/article/67508eb4de2ae59cca1ce422.html) 

> 错误提示：运行Virtualbox去安装系统时出错：Failed to open a session for the virtual machine，Unable to load R3 module xxxx/VBoxDD.DLL(VBoxDD)，GetLastError=126，(VERR_MODULE_NOT_FOUND)
> 解决方案参考：http://blog.sina.com.cn/s/blog_4dc988240102vj8a.html



# 安装Ubuntu 1404系统

> 错误提示: "No root file system is defined, please correct this from the partitioning menu"。 参照 [这样划分硬盘](http://www.cnblogs.com/zhcncn/p/3987301.html)

```
	/boot	100MB
	/	10 000MB
	/home	5 000MB  
	swap	2000MB
free space	78MB
```


# FAQ

### VirtualBox主机与虚拟机不能复制粘贴的解决办法
http://jingyan.baidu.com/article/574c521917db806c8d9dc18c.html
常规高级里共享粘贴板已经选中双向，但还是不能复制粘贴，这时到虚拟机设置-存储-控制器SATA-勾选"使用主机输入输出(I/O)缓存"，再同样在存储-控制器SATA-点击***.vdi-勾选"固态驱动器"，重启虚拟机就可以了～


### 修复 VirtualBox 下 Ubuntu 14.10 屏幕分辨率问题
http://www.oschina.net/question/12_178184
你需要安装一个 VirtualBox 的额外组件到你的 Ubuntu-Guest 中，可运行如下命令：
`sudo apt-get install virtualbox-guest-dkms`
安装完毕需要重启虚拟机就可以。



### 怎么让virtualBox中的Ubuntu和win7物理机共享文件夹？
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
 



