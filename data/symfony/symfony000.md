Symfony3文档翻译计划
====================

2016年2月28日，Symfony3.0.3发布了。出于学习英语的态度，决定翻译一下sf3的文档，顺便学习一下sf3框架。

参考网站:
	- [官方网站（2.x版本）](http://www.symfony.com/)  
	- [官方网站（1.x版本，功能已冻结）](http://www.symfony-project.org/)    
	- [sf英文视频](http://knpuniversity.com/screencast/symfony/routing-wildcards#play)

# sf3文档  
sf3包括组建和框架。官网展示了7本书：

 1. [Symfony Book](http://symfony.com/doc/current/index.html) Prepared by the core team, this is the reference that covers the needs for every kind of Symfony developer. <br>核心团队所写，这是一本涵盖各类Symfony开发者需求的参考手册。
 1. [Symfony Cookbook](http://symfony.com/doc/current/cookbook/index.html) The Symfony Cookbook is a continuously growing collection of specific recipes that explain how to correctly solve the most recurrent problems that Symfony developers face in their day to day work. <br>Symfony Cookbook是一个持续增长的特别方案的集合，它们准确的解决了sf开发者日常面临的最迫切的问题。
 1. [Symfony Components](http://symfony.com/doc/current/components/index.html) The Components implement common features needed to develop websites. They are the foundation of the Symfony full-stack framework, but they can also be used standalone even if you don't use the framework as they don't have any mandatory dependencies.<br> 组建实现了开发网站的公共特性。它们是sf全栈框架的基础，但是由于它们没有强制性依赖关系，即使你不用sf框架你也可以单独使用它们。
 1. [Symfony Best Practices](http://symfony.com/doc/current/best_practices/index.html) Discover the best practices that fit the philosophy of the framework as envisioned by its original creator Fabien Potencier. Learn a new pragmatic vision for Symfony application development and boost your productivity.<br> 探索符合sf3最初创建者Fabien Potencier预想的哲学思想的最佳实践。学习一种新的编程视角用于sf应用开发，并提升你的生产效率。
 1. [Symfony Bundles](http://symfony.com/doc/bundles/) These are some of the most commonly used bundles when developing Symfony applications. Learn more about them.<br> 开发sf应用时有些bundle用的特别频繁。更多的了解它们。
 1. [Symfony Reference](http://symfony.com/doc/current/reference/index.html) Ever wondered what configuration options you have available to you in files such as app/config/config.yml? In this section, all the available configuration is broken down by the key (e.g. framework) that defines each possible section of your Symfony configuration. <br> 曾经疑惑你有那些选项去设置文件，比如 app/config/config.yml？这一部分，所有可用的设置都按定义sf配置的每个部分的键（比如：framework）分类。
 1. [Symfony Training](https://training.sensiolabs.com/fr/) 不懂法语。

 
 
	

## The Symfony Book
包含如下章节：

```
	Controllers
	Routing
	Templating
	Doctrine
	Testing
	Forms
	Validation
	Security
	HTTP Cache
	Translation
	Services
	Performance
```
	

	

	
	
	
	

# sf社区评论

> Symfony是一个基于MVC模式的面向对象的PHP5框架。Symfony允许在一个web应用中分离事务控制，服务逻辑和表示层。symfony的目的是加速Web应用的创建与维护。


> Symfony更多的适用于高级开发者，即创建企业级应用的开发者，尤其是Askeet和Yahoo! Bookmarks。这个开源的PHP框架功能全面，但其速度相对于其他框架要慢，算是个缺点吧。



> Symfony为开发人员提供了一个架构、组件和工具，可以使用它更快地创建复杂的Web应用程序。Symfony可以让你更早地发布你的应用，而且长时间保持稳定。Symfony是经验的总结：它使用了大多数Web开发的最佳经验，并集成了一些伟大的第三方库。



>1.学习成本比较高，里面的概念理解起来比较抽象;  2.属于全栈框架，doctrine,twig都很好，bundle比较多;  3.这个东西熟悉后使用起来真是一种享受



# sf框架历史
Symfony是基于MVC架构的PHP框架。作为一款免费软件，在MIT License许可下发行。

- 2005年10月18日，其官方网站symfony-project.org对外开放;
- 2010年，对应2.0版本的新网站symfony.com启用；
- 2011年7月，Symfony 2.0正式版本发布。Symfony社区的工作重心已经完成从1.x版本向2.x版本的转移。
- 2016年2月28日，Symfony3.0.3发布。

新一代的Symfony 2，不只是开发框架，其真正的愿景是，成为解决Web开发中常见任务的标准件。一方面，各组件能单独使用，完全解耦，另一方面，在开发接口、规范上保持高度一致，从而实现高效的协作。


正因为对规范、便捷、协作和创造的追求，Symfony 2开发社区同时也成为了PSR、Composer、Doctrine以及BeHat的核心参与者。而对于团队开发中的技术管理者，采用Symfony 2，可以引入科学的规范，简单有效的依赖关系管理，主流测试框架，以及持续集成等积极的因素。

Symfony作为一种技术文化，已经对整个PHP社区产生深远的影响。Drupal, PhpBB, EzPublish等都将采用Symfony 2的核心组件，甚至完全基于Symfony 2重构。





