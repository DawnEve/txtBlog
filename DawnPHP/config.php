<?php
//定义css和js文件夹的上一级位置：
$publicPath='public/';

//定义数据文件的位置
//定义目录的位置
defined('BLOG_MENU')   or define('BLOG_MENU',     DAWN_PATH . '../data/');
//defined('THINK_PATH')   or define('THINK_PATH',     __DIR__.'/');

$web_status=0;//网络状态。0表示断网（评论、统计消失）。1表示联网（评论、统计显示）。

