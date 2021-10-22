underscore.js
================
目前最新版是nderscore.js 1.8.3, [官网(函数列表)](http://underscorejs.org/), [文档(带注释)](http://underscorejs.org/docs/underscore.html), [中文文档](http://www.css88.com/doc/underscore/).



----
推荐阅读：
- [underscore.js学习笔记](http://www.tuicool.com/articles/rUzya2)
- [UnderscoreJS精巧而强大工具包](http://blog.fens.me/nodejs-underscore/)
- [比Underscore更优秀的lazy.js](http://danieltao.com/lazy.js/)
- [你可能不再需要Underscore](http://www.css88.com/archives/5710)
---


## 前言

从其他语言转向Javascript时，通常都会遇到一些困惑性问题。比如，Java中的HashMap在Javascript中如何实现？Javascript面向对象式编程如何实现继承？如何实现通用的iterator对集合对象做遍历？如何对Array实现快速排序？….

如果你真的可以自己实现这些功能，那么你的Javascript基础很扎实的！我很佩服你！但对于大部分人来说，这些基础功能应该是由底层API支持的，就像JDK一样。Underscore为我们提供了这样的一个实用工具包，而且它真的很实用！

只有你动手做了，你才能有收获。

## 目录

1. Underscore介绍
1. Underscore安装
1. 集合部分:数组或对象
1. 数组部分
1. 函数部分
1. 对象部分
1. 实用功能
1. 链式语法
1. 字符串处理Underscore.String


### 1. 介绍


> Underscore一个JavaScript实用库，提供了一整套(类似Prototype.js或 Ruby的一些功能)函数式编程的实用功能，但是没有扩展任何JavaScript内置对象。它是这个问题的答案：“如果我在一个空白的HTML页面前坐下， 并希望立即开始工作， 我需要什么？“...它弥补了部分jQuery没有实现的功能,同时又是Backbone.js必不可少的部分。


Underscore提供了100多个函数,包括常用的: map, filter, invoke — 当然还有更多专业的辅助函数,如:函数绑定, JavaScript模板功能,创建快速索引, 强类型相等测试, 等等.

在新的浏览器中, 有许多函数如果浏览器本身直接支持,将会采用原生的,如 forEach, map, reduce, filter, every, some 和 indexOf.

![js内置核心对象](data/javascript/images/js001.png)
[内置核心对象](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Guide/Predefined_Core_Objects):在核心 JavaScript 中预定义的一些对象: Array, Boolean, Date, Function, Math, Number, RegExp, and String.




### 2. 安装

Underscore.js是一个Javascript功能类库，不依赖于环境，可以加载到HTML中在浏览器运行，也可以直接在nodejs的环境中使用。





