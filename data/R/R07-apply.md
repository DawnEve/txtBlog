#apply 家族函数(包括了8个功能类似的函数)

推荐: [R语言 | 详解高效批量处理apply族函数(apply lapply sapply vapply mapply tapply rapply eapply)](https://mp.weixin.qq.com/s?__biz=MzU4MDAwODIyNw==&mid=2247483727&idx=1&sn=7458d90846765ceae214726cdef540d6)

[apply.R笔记 on github](https://github.com/DawnEve/bioToolKit/blob/master/R_scripts/docs/apply.R)

R是一种面向数组(array-oriented)的语法，它更像数学，方便科学家将数学公式转化为R代码。apply族功能强大，实用，可以代替很多循环语句。因为向量在R中在底层用C语言优化过，运行更快，性能更好，在使用R时，要尽量用array的方式思考，避免for、while循环语句，特别是数据量大的时候

apply族函数是高效能计算的运算向量化(Vectorization)实现方法之一。常用的向量操作就是apply的家族函数：apply, sapply, tapply, mapply, lapply, rapply, vapply, eapply等。

apply函数族是R语言中数据处理的一组核心函数，通过使用apply函数，我们可以实现对数据的循环、分组、过滤、类型控制等操作。但是，由于在R语言中apply函数与其他语言循环体的处理思路是完全不一样的，所以apply函数族一直是使用者玩不转的一类核心函数。很多R语言新手，写了很多的for循环代码，也不愿意多花点时间把apply函数的使用方法了解清楚，最后把R代码写的跟C似得，我严重鄙视只会写for的R程序员。


## 提要

函数名	含义
apply: apply
lapply: list apply 
sapply: simplify list apply
tapply: table apply; table(), by() 
mapply: mutiple list apply
rapply: recursively apply
vapply: vector apply
eapply: environment apply


分组计算
tapply(); para: vector; return vector;
apply(); para: list,data.frame,array; return: vector,matrix;


循环迭代
lapply(); para:list,data.frame; return: list;
- 简化版 sapply(); 
|-	 可设置返回值模板 vapply();
- 递归版 rapply(); para:list; return:list;
- 多参数版 mapply(); para:vector,不限个数; return:vector,matrix;

环境空间遍历
eapply(); para:environment; return:list;


apply : 用于遍历数组中的行或列，并且使用指定函数来对其元素进行处理。
lapply : 遍历列表向量内的每个元素，并且使用指定函数来对其元素进行处理。返回列表向量。
  sapply : 与lapply基本相同，只是对返回结果进行了简化，返回的是普通的向量。
  vapply：和sapply类似，但可预先指定返回值类型，更安全。
mapply: 支持传入两个以上的列表。  
tapply: 接入参数INDEX，对数据分组进行运算，就和SQL中的group by一样。
rapply: 递归版的lapply.
eapply: 对环境变量内所有数据执行的fun函数。



## 提要2
1.apply
Apply Functions Over Array Margins
对阵列行或者列使用函数
apply(X, MARGIN, FUN, ...)

2.lapply
Apply a Function over a List or Vector
对列表或者向量使用函数
lapply(X, FUN, ...)

3.sapply
Apply a Function over a List or Vector
对列表或者向量使用函数
sapply(X, FUN, ..., simplify = TRUE, USE.NAMES = TRUE)

4.vapply
Apply a Function over a List or Vector
对列表或者向量使用函数
vapply(X, FUN, FUN.VALUE, ..., USE.NAMES = TRUE)

5.tapply
Apply a Function Over a Ragged Array
对不规则阵列使用函数
tapply(X, INDEX, FUN = NULL, ..., simplify = TRUE)

6.eapply
Apply a Function Over Values in an Environment
对环境中的值使用函数
eapply(env, FUN, ..., all.names = FALSE, USE.NAMES = TRUE)

7.mapply
Apply a Function to Multiple List or Vector Arguments
对多个列表或者向量参数使用函数
mapply(FUN, ..., MoreArgs = NULL, SIMPLIFY = TRUE, USE.NAMES = TRUE)

8.rapply
Recursively Apply a Function to a List
运用函数递归产生列表
rapply(object, f, classes = "ANY", deflt = NULL,how = c("unlist", "replace", "list"), ...)







# 详细用法与实例


## R语言性能分析 system.time()

add=function(x,y){x+y}
system.time(add(1,2))
用户user 系统system 流逝elapsed 
0.10 0.00 0.09 



## apply,
Returns a vector or array or list of values obtained by applying a function to margins of an array or matrix.

通过作用一个函数到一个array或matrix的行或列上,返回一个vector/array/list.
apply函数是最常用的代替for循环的函数。apply函数可以对矩阵、数据框、数组(二维、多维)，
按行或列进行循环计算，对子元素进行迭代，并把子元素以参数传递的形式给自定义的FUN函数中，并以返回计算结果。

函数定义：apply(X, MARGIN, FUN, ...)

参数列表：
  X: 数组、矩阵、数据框
  MARGIN: 按行计算或按按列计算，1表示按行，2表示按列
  FUN: 自定义的调用函数
  …: 更多参数，可选

用apply可以很方便地按行列求和/平均，其结果与colMeans,colSums,rowMeans,rowSums是一样的。

```r
#例1：比如，对一个数据框每一列求平均数，下面就要用到apply做循环了。
x<-data.frame(age=c(10,20,15,26,30),height=c(100,180,160,179,40))
x
apply(x,2,mean) #按列计算均值
#  age height 
#  20.2  158.6
apply(x,1,mean) #按行


#例1.2：计算每行的平方根
apply(x,1,function(x){
  sqrt(sum(x^2)) #最后一行是30 40 -> 50
})

#例1.3: 按照列标准化并归一化到100，就是每个值除以本列的和，再乘以100
x.norm=apply(x,2,function(x){
  100*x/(sum(x))
})
x.norm
apply(x.norm, 2, sum) #现在每列的和都是100




#例2.1 探究第三个函数返回的到底是啥
x <- cbind(x1 =c(1,2,3,4), x2 = c(10,20,30,40))#4行2列
x
class(x)#[1] "matrix"

#自定义函数
myfn=function(x){
  print( paste0("==input==",x));
  return(paste0("输出", sum(x) ))
}
myfn2=function(x){
  print( paste0("==input==",x));
  return(paste0("输出", x))
}
apply(x,1,mean)
apply(x,1,myfn) #按照行输入fun，但是向量化操作，字符串分别连接，返回向量的和
apply(x,1,myfn2) #按照row输入，向量化连接后返回，结果是一个matrix,列等于输入的行

#
apply(x,2,mean)
apply(x,2,myfn) #按照列输入fun
apply(x,2,myfn2) #返回结果的列=输入的行
#多用于mean、sum等统计量的计算。





#例2.2 计算行或者列的小计、总计。
col.sums <- apply(x, 2, sum);col.sums
row.sums <- apply(x, 1, sum);row.sums
rbind(cbind(x, Rtot = row.sums), Ctot = c(col.sums, sum(col.sums)))
#或者
cbind(rbind(x, Ctot = col.sums), Rtot = c(row.sums, sum(row.sums)))
#	 x1  x2 Rtot
#	 1  10   11
#	 2  20   22
#	 3  30   33
#	 4  40   44
#Ctot 10 100  110


```









 
## sapply, 
## tapply, 
## mapply, 
## lapply, 
## rapply, 
## vapply, 
## eapply