#apply 家族函数(包括了8个功能类似的函数)

推荐: [R语言 | 详解高效批量处理apply族函数(apply lapply sapply vapply mapply tapply rapply eapply)](https://mp.weixin.qq.com/s?__biz=MzU4MDAwODIyNw==&mid=2247483727&idx=1&sn=7458d90846765ceae214726cdef540d6)

[apply.R笔记 on github](https://github.com/DawnEve/bioToolKit/blob/master/R_scripts/docs/apply.R)

R是一种面向数组(array-oriented)的语法，它更像数学，方便科学家将数学公式转化为R代码。apply族功能强大，实用，可以代替很多循环语句。因为向量在R中在底层用C语言优化过，运行更快，性能更好，在使用R时，要尽量用array的方式思考，避免for、while循环语句，特别是数据量大的时候

apply族函数是高效能计算的运算向量化(Vectorization)实现方法之一。常用的向量操作就是apply的家族函数：apply, sapply, tapply, mapply, lapply, rapply, vapply, eapply等。

apply函数族是R语言中数据处理的一组核心函数，通过使用apply函数，我们可以实现对数据的循环、分组、过滤、类型控制等操作。但是，由于在R语言中apply函数与其他语言循环体的处理思路是完全不一样的，所以apply函数族一直是使用者玩不转的一类核心函数。很多R语言新手，写了很多的for循环代码，也不愿意多花点时间把apply函数的使用方法了解清楚，最后把R代码写的跟C似得，我严重鄙视只会写for的R程序员。



忘掉程序员的思维，换成数据的思维，也许你就一下子开朗了。



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


## 自定义输出函数
```
#自定义一个好用的输入函数，便于调试
myprint=function(...){
  a=paste0(...)
  print(a)
}
```




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






#例2：下面计算一个稍微复杂点的例子，按行循环，让数据框的x1列加1，并计算出x1,x2列的均值。
x <- cbind(x1 = 3, x2 = c(4:1, 2:5)); x
#  x1 x2
#  [1,]  3  4
#  [2,]  3  3
#  [3,]  3  2
#  [4,]  3  1
#  [5,]  3  2
#  [6,]  3  3
#  [7,]  3  4
#  [8,]  3  5

#自定义一个好用的输入函数，便于调试
myprint=function(...){
  a=paste0(...)
  print(a)
}

# 自定义函数myFUN，第一个参数x为数据
# 第二、三个参数为自定义参数，可以通过apply的'...'进行传入。
myFUN<- function(x, c1, c2) {
  
  print('==');
  str(x)#debug1.本行为什么只触发一次，而下一行会触发两次呢？
  #debug2.这个传入的x是什么东西？
  myprint('长度',length(x),"; Num=",x,'; One',x["x1"]," Two",x["x2"], " All", mean(x[c2]) )#mean(x[c2])前后值一样，说明一行结束后计算统计结果的
  #myprint('长度',length(x),"; Num=",x,'; One',x["x1"]," Two",x["x2"], " All", x[c2] )# x[c2] 时All后的数字不同
  
 c(sum(x[c1],1), mean(x[c2])) #这个写法很奇怪 x["x1"], mean(x[c('x1','x2')]) todo
}


# 把数据框按行做循环，每行分别传递给myFUN函数，设置c1,c2对应myFUN的第二、三个参数
rs=apply(x,1,myFUN,c1='x1',c2=c('x1','x2'))
rs
t(rs)


#通过这个上面的自定义函数myFUN就实现了，一个常用的循环计算。
#如果直接用for循环来实现，那么代码如下：
df<-data.frame() # 定义一个结果的数据框
# 定义for循环
for(i in 1:nrow(x)){
   row<-x[i,]  # 每行的值
   df<-rbind(df,rbind(c(sum(row[1],1), mean(row))))   # 计算，并赋值到结果数据框
}
df  # 打印结果数据框



#通过for循环的方式，也可以很容易的实现上面计算过程，但是这里还有一些额外的操作需要自己处理，
#比如构建循环体、定义结果数据集、并合每次循环的结果到结果数据集。

#对于上面的需求，还有第三种实现方法，那就是完全利用了R的特性，通过向量化计算来完成的。
data.frame(x1=x[,1]+1,x2=rowMeans(x)) #一行搞定。


#从CPU的耗时来看，用for循环实现的计算是耗时最长的，
#apply实现的循环耗时很短，
#而直接使用R语言内置的向量计算的操作几乎不耗时。

#通过上面的测试，对同一个计算来说，优先考虑R语言内置的向量计算，必须要用到循环时则使用apply函数，
#应该尽量避免显示的使用for,while等操作方法。
system.time(function(){
  data.frame(x1=x[,1]+1,x2=rowMeans(x))
})
#user  system elapsed 
#0       0       0 
```














## lapply, 对list使用fn，并返回list
lapply returns a list of the same length as X, each element of which is the result of applying FUN to the corresponding element of X.

lapply函数是一个最基础循环操作函数之一，用来对list、data.frame数据集进行循环，
并返回和X长度同样的list结构作为结果集，通过lapply的开头的第一个字母’l’就可以判断返回结果集的类型。

函数定义：lapply(X, FUN, ...)
参数列表：
  X:list、data.frame数据
  FUN: 自定义的调用函数
  …: 更多参数，可选



```R 
#比如，计算list中的每个KEY对应的该数据的分位数。
# 构建一个list数据集x，分别包括a,b,c 三个KEY值。
x <- list(a = 1:10, b = rnorm(5,0,5), c = c(TRUE,FALSE,FALSE,TRUE)); x

# 分别计算每个KEY对应该的数据的分位数。
lapply(x,fivenum)


#lapply就可以很方便地把list数据集进行循环操作了，还可以用data.frame数据集按列进行循环，
#但如果传入的数据集是一个向量或矩阵对象，那么直接使用lapply就不能达到想要的效果了。
#比如，对矩阵的列求和。
x <- cbind(x1=1, x2=c(2:1,4:5)) # 生成一个矩阵
x;class(x)
#  x1 x2
#  [1,]  1  2
#  [2,]  1  1
#  [3,]  1  4
#  [4,]  1  5
#  [1] "matrix"

# 求和
lapply(x, sum)#结果不理想
#lapply会分别循环矩阵中的每个值，而不是按行或按列进行分组计算。


#如果对数据框的列求和。
x
x2=data.frame(x);x2
#   x1 x2
# 1  1  2
# 2  1  1
# 3  1  4
# 4  1  5
class(x2)#[1] "data.frame"

lapply(x2, sum) #按列算，返回list
# $x1
# [1] 4
# 
# $x2
# [1] 12

lapply(x2, mean)
lapply(x2, length)
# lapply会自动把数据框按【列】进行分组，再进行计算。

#因为数据框本质上也是列list
x2[[1]] #[1] 1 1 1 1
x2[[2]] #[1] 2 1 4 5
```





















## sapply, 简化版的lapply，返回值更多样
sapply is a user-friendly version and wrapper of lapply by default returning a vector, matrix or, 
 if simplify = "array", an array if appropriate, by applying simplify2array(). 
 sapply(x, f, simplify = FALSE, USE.NAMES = FALSE) is the same as lapply(x, f).

sapply 函数是一个简化版的lapply，sapply增加了2个参数simplify和USE.NAMES，
主要就是让输出看起来更友好，返回值为向量，而不是list对象。

函数定义：sapply(X, FUN, ..., simplify=TRUE, USE.NAMES = TRUE)
参数列表：
  X:数组、矩阵、数据框
  FUN: 自定义的调用函数
  …: 更多参数，可选
  simplify: 是否数组化，当值array时，输出结果按数组进行分组
  USE.NAMES: 如果X为字符串，TRUE设置字符串为数据名，FALSE不设置

 simplify=F：返回值的类型是list，此时与lapply完全相同

返回的结果是一个向量或矩阵。
 simplify=T（默认值）：返回值的类型由计算结果定，如果函数返回值长度为1，则sapply将list简化为vector；
 如果返回的列表中每个元素的长度都大于1且长度相同，那么sapply将其简化为一个矩阵


```
#我们还用上面lapply的计算需求进行说明。
x <- cbind(x1=3, x2=c(2:1,4:5))
x;class(x)
##      x1 x2
## [1,]  3  2
## [2,]  3  1
## [3,]  3  4
## [4,]  3  5
## [1] "matrix"

# 对矩阵计算，计算过程同lapply函数，对matrix不适用：
sapply(x, sum) #[1] 3 3 3 3 2 1 4 5

# 对数据框计算，默认按列
sapply(data.frame(x), sum)
  #x1 x2 
  #12 12 

# 检查结果类型，sapply返回类型为向量，而lapply的返回类型为list
class(lapply(x, sum))
  #[1] "list"
class(sapply(x, sum))
  #[1] "numeric"


#如果simplify=FALSE和USE.NAMES=FALSE，那么sapply函数就完全等于lapply函数了。
lapply(data.frame(x), sum)
# $x1
# [1] 12
#
# $x2
# [1] 12

sapply(data.frame(x), sum, simplify=FALSE, USE.NAMES=FALSE)
# $x1
# [1] 12
#
# $x2
# [1] 12
sapply(data.frame(x), sum)
# x1 x2 
# 12 12 


# 对于simplify为array时，我们可以参考下面的例子，构建一个三维数组，其中二个维度为方阵。
a=1:2
# 按数组分组
sapply(a,function(x) matrix(x,2,2), simplify='array')
# 默认情况，则自动合并分组
sapply(a,function(x) matrix(x,2,2)) #todo?



# 例子：生成矩阵4行5列，每一列的mean=1, sd=5
a=sapply(1:5,function(x) rnorm(4,x));a
class(a) #[1] "matrix"



#对于字符串的向量，还可以自动生成数据名。
val<-head(letters);val
#[1] "a" "b" "c" "d" "e" "f"

# 默认设置数据名
sapply(val,paste,USE.NAMES=TRUE)
#a   b   c   d   e   f 
#"a" "b" "c" "d" "e" "f" 

# USE.NAMES=FALSE，则不设置数据名
sapply(val,paste,USE.NAMES=FALSE)
# [1] "a" "b" "c" "d" "e" "f"



# 第二个参数：自定义函数
a=data.frame(
  x1=c(1,2,3,4),
  x2=c(10,20,30,40)
);
a
##   x1 x2
## 1  1 10
## 2  2 20
## 3  3 30
## 4  4 40

yy=sapply(a,function(x) x^2);yy
##      x1   x2
## [1,]  1  100
## [2,]  4  400
## [3,]  9  900
## [4,] 16 1600

yy=sapply(a, function(x) mean(x));yy
#  x1   x2 
# 2.5 25.0 

yy=sapply(a,mean);yy# 默认变成矩阵格式
# 同上
yy=lapply(a,mean);yy #lapply默认返回list
## $x1
## [1] 2.5
## 
## $x2
## [1] 25

#
yy=sapply(a, function(x) {y=3;x^2+y});yy
##      x1   x2
## [1,]  4  103
## [2,]  7  403
## [3,] 12  903
## [4,] 19 1603



#求分位数
x <- list(a = 1:10, beta = exp(-3:3), logic = c(TRUE,FALSE,FALSE,TRUE))
lapply(x, quantile)#0%  25%  50%  75% 100% 
lapply(x, fivenum)#结果同上，就是没有name

sapply(x, quantile,simplify=FALSE,use.names=FALSE)#加上simplify=F后返回和lapply一样，是list。
sapply(x, quantile)#默认simplify=T，返回matrix
#         a        beta logic
#0%    1.00  0.04978707   0.0
#25%   3.25  0.25160736   0.0
#50%   5.50  1.00000000   0.5
#75%   7.75  5.05366896   1.0
#100% 10.00 20.08553692   1.0
```
















## vapply, 类似sapply，FUN.VALUE参数可控制返回值的行名
vapply is similar to sapply, but has a pre-specified type of return value, so it can be safer (and sometimes faster) to use.
vapply类似于sapply，提供了FUN.VALUE参数，用来控制返回值的行名，这样可以让程序更健壮。

函数定义：vapply(X, FUN, FUN.VALUE, ..., USE.NAMES = TRUE)
参数列表：
  X:数组、矩阵、数据框
  FUN: 自定义的调用函数
  FUN.VALUE: 定义返回值的行名row.names
  …: 更多参数，可选
  USE.NAMES: 如果X为字符串，TRUE设置字符串为数据名，FALSE不设置
比如，对数据框的数据进行累计求和，并对每一行设置行名row.names


```R 
# 生成数据集
x = data.frame(cbind(x1=3, x2=c(2:1,4:5)));x
##   x1 x2
## 1  3  2
## 2  3  1
## 3  3  4
## 4  3  5

# 设置行名，4行分别为a,b,c,d
vapply(x,cumsum,FUN.VALUE=c('a'=0,'b'=0,'c'=0,'d'=0))
#    x1 x2
#  a  3  2
#  b  6  3
#  c  9  7
#  d 12 12

#argument "FUN.VALUE" is missing, with no default
vapply(x,cumsum)#报错，必须指定行名


# sapply 不设置时，为默认的索引值
a<-sapply(x,cumsum);a
#        x1 x2
#  [1,]  3  2
#  [2,]  6  3
#  [3,]  9  7
#  [4,] 12 12
row.names(a)<-c('a','b','c','d') # 手动的方式设置行名
a
```


通过使用vapply可以直接设置返回值的行名，这样子做其实可以节省一行的代码，让代码看起来更顺畅，
当然如果不愿意多记一个函数，那么也可以直接忽略它，只用sapply就够了。

```
#例
lst = list(a=c(1:5), b=c(6:10));lst
res = vapply(lst, function(x) c(min(x), max(x)), c(min.=0, max.=0)) #指定行名
res
#        a  b
# Rmin. 1  6
# Rmax. 5 10

#例
i39 = sapply(3:9, seq);i39 # list of vectors
vapply(i39, fivenum,
       c(Min. = 0, "1st Qu." = 0, Median = 0, "3rd Qu." = 0, Max. = 0))
#       [,1] [,2] [,3] [,4] [,5] [,6] [,7]
#Min.     1.0  1.0    1  1.0  1.0  1.0    1
#1st Qu.  1.5  1.5    2  2.0  2.5  2.5    3
#Median   2.0  2.5    3  3.5  4.0  4.5    5
#3rd Qu.  2.5  3.5    4  5.0  5.5  6.5    7
#Max.     3.0  4.0    5  6.0  7.0  8.0    9
```

















## mapply, 是sapply的多变量版本，第一个参数是函数，后面能接收多个输入数据
mapply is a multivariate version of sapply. mapply applies FUN to the first elements of each ... argument, the second elements, the third elements, and so on. 
Arguments are recycled if necessary.

mapply 也是sapply的变形函数，类似多变量的sapply，但是参数定义有些变化。
第一参数为自定义的FUN函数，第二个参数’…’可以接收多个数据，作为FUN函数的参数调用。

函数定义：mapply(FUN, ..., MoreArgs = NULL, SIMPLIFY = TRUE,USE.NAMES = TRUE)
参数列表：
  FUN: 自定义的调用函数
  …: 接收多个数据
  MoreArgs: 参数列表
  SIMPLIFY: 是否数组化，当值array时，输出结果按数组进行分组
  USE.NAMES: 如果X为字符串，TRUE设置字符串为数据名，FALSE不设置

返回值是vector或matrix，取决于 FUN 返回值是一个还是多个。

```
#例1：比如，比较3个向量大小，按索引顺序取较大的值。
set.seed(1)
# 定义3个向量
x<-1:10;x
#[1]  1  2  3  4  5  6  7  8  9 10
y<-5:-4;y
#[1]  5  4  3  2  1  0 -1 -2 -3 -4
set.seed(1)
z<-round(runif(10,-5,5));z
#[1] -2 -1  1  4 -3  4  4  2  1 -4

# 按索引顺序取较大的值。
mapply(max,x,y,z)
# [1]  5  4  3  4  5  6  7  8  9 10





#例2：生成4个符合正态分布的数据集，分别对应的均值和方差为c(1,10,100,1000)。
# 长度为4
n<-rep(5,4);n # [1] 5 5 5 5

# m为均值，v为方差
m<-v<-c(1,10,100,1000)

# 生成4组数据，按列分组
set.seed(1)
mapply(rnorm,n,m,v)
#     [,1]      [,2]      [,3]       [,4]
# [1,] 0.3735462 13.295078 157.57814   378.7594
# [2,] 1.1836433  1.795316  69.46116 -1214.6999
# [3,] 0.1643714 14.874291 251.17812  2124.9309
# [4,] 2.5952808 17.383247 138.98432   955.0664
# [5,] 1.3295078  6.946116  212.49309 1593.9013
```


由于mapply是可以接收多个参数的，所以我们在做数据操作的时候，就不需要把数据先合并为data.frame了，
直接一次操作就能计算出结果了。

```
#例
mapply(sum, list(a=1,b=2,c=3), list(a=10,b=20,d=30))
#a  b  c 
#11 22 33 

#例
mapply(function(x,y) x^y, c(-1:-5), c(1:5))
#[1]    -1     4   -27   256 -3125
```



















## tapply: table(), by() , 
Apply a function to each cell of a ragged array, that is to each (non-empty) group of values 
given by a unique combination of the levels of certain factors.

tapply用于分组的循环计算，通过INDEX参数可以把数据集X进行分组，相当于group by的操作。

函数定义：tapply(X, INDEX, FUN = NULL, ..., simplify = TRUE)
参数列表：
  X: 向量
  INDEX: 用于分组的索引
  FUN: 自定义的调用函数
  …: 接收多个数据
  simplify : 是否数组化，当值array时，输出结果按数组进行分组

示例讲解：
```r
#tapply(a,b,c)
# a是一个一维数据，如 1,2,3,4,5,6
# b是和a等长度的一维数据，如   a，a，b，c，b，c
# c是执行函数，如求和-sum，结果是a的求和值为 1+2 = 3, b的求和值为 3+5=8，c的求和值为4+6=10

tapply(c(1,2,3,4,5,6), c('a','a','b','c','b','c'), sum)
# a  b  c 
# 3  8 10
```



### 例1：计算不同品种的鸢尾花花瓣长度均值
```
# 通过iris$Species品种进行分组
tapply(iris$Petal.Length,iris$Species,mean)
# setosa versicolor  virginica 
# 1.462      4.260      5.552 
```

### 例2：传入更多参数 ...
```
#对向量x和y进行计算，并以向量t为索引进行分组，求和。
set.seed(1)
# 定义x,y向量
x<-y<-1:10;x;y
# [1]  1  2  3  4  5  6  7  8  9 10
# [1]  1  2  3  4  5  6  7  8  9 10

# 设置分组索引t
#runif(10,1,100) #均匀分布10个，最小1，最大100.
#t<-round(runif(10,1,100))%%2;t #和下一行啥区别？整除不处理小数部分
t<-round(runif(10,1,100)%%2);t
# [1] 1 2 2 1 1 2 1 0 1 1

# 对x进行分组求和
tapply(x,t,sum)
# 0  1  2 
# 8 36 11 



#由于 tapply 只接收一个向量参考，通过’…’可以把再传给你FUN其他的参数，那么我们想去y向量也进行求和，
#把y作为tapply的第4个参数进行计算。
tapply(x,t,sum,y)
#0  1  2 
#63 91 66
#得到的结果并不符合我们的预期，结果不是把x和y对应的t分组后求和，而是得到了其他的结果。
#第4个参数y传入sum时，并不是按照循环一个一个传进去的，而是每次传了完整的向量数据，
#那么再执行sum时sum(y)=55，所以对于t=0时，x=8 再加上y=55，最后计算结果为63。

#那么，我们在使用’…’去传入其他的参数的时候，一定要看清楚传递过程的描述，才不会出现的算法上的错误。

tapply(x,t,sum)+tapply(y,t,sum) 
#0  1  2 
#16 72 22
```





### 例3，tapply() 实现excel中数据透视表的功能
```
# tapply实现crosstable功能
da=data.frame(
  year=c('2007', '2007', '2007', '2007', '2008', '2008', '2008', '2009', '2009', '2009'),
  province=c('A', 'B', 'C', 'D', 'A', 'C', 'D', 'B', 'C', 'D'),
  sale=c(1, 2, 3, 4, 5, 6, 7, 8, 9, 10)
)
da
#    year province sale
# 1  2007        A    1
# 2  2007        B    2
# 3  2007        C    3
# 4  2007        D    4
# 5  2008        A    5
# 6  2008        C    6
# 7  2008        D    7
# 8  2009        B    8
# 9  2009        C    9
# 10 2009        D   10
tapply(da$sale,da$year,mean)
# 2007 2008 2009 
# 2.5  6.0  9.0
tapply(da$sale,da$year) #缺省函数时输出的是分组 
# [1] 1 1 1 1 2 2 2 3 3 3 


#二维分组时缺省函数输出是什么？
seq=tapply(da$sale,list(da$year,da$province))
seq #输出的到底是啥？已经超过组数10了。
#[1]  1  4  7 10  2  8 11  6  9 12 
#注意输出最大的是12，缺少俩。嗯...懂了
factor(da$year) #Levels: 2007 2008 2009
factor(da$province) #Levels: A B C D
#两个因子的组合共3x4=12种。
#1 2007A
#2 2008A
#3 2009A 缺
#4 2007B
#...
#如果有重叠的(年份x省份)组合，则会分配相同的编号。
tapply(da$sale, seq, mean) #这样会扁平输出成一行
# 1  2  4  6  7  8  9 10 11 12 
# 1  5  2  8  3  6  9  4  7 10


# 上表输出不确定数据的对应关系，很不直观。
# 继续尝试：
rs=tapply(da$sale,list(da$year,da$province),function(x){
  print(paste0("输入",x))
})
#[1] "输入1"
#[1] "输入5"
#[1] "输入2"
#[1] "输入8"
#[1] "输入3"
#[1] "输入6"
#[1] "输入9"
#[1] "输入4"
#[1] "输入7"
#[1] "输入10"

rs #从这个结果更能看到顺序，就是先按照province排序，然后按照year输出。
#        A       B       C       D       
# 2007 "输入1" "输入2" "输入3" "输入4" 
# 2008 "输入5" NA      "输入6" "输入7" 
# 2009 NA      "输入8" "输入9" "输入10"


tapply(da$sale,list(da$year,da$province),function(x)x) #透视表效果
#       A  B C  D
# 2007  1  2 3  4
# 2008  5 NA 6  7
# 2009 NA  8 9 10

tapply(da$sale,list(da$year,da$province),mean) #mean，结果和上文一样，是因为每个交叉点只有一个数据


######################
#给原始数据增加几行
da2=rbind(da,data.frame(
  year=c('2007','2008','2009'),
  province=c('A',"C","B"),
  sale=c(100,2000,30000)
))
da2

tapply(da2$sale,list(da2$year,da2$province),mean)#正常
#         A     B    C  D
#2007 50.5     2    3  4
#2008  5.0    NA 1003  7
#2009   NA 15004    9 10

#看细节可以发现，数据是按照交叉点一次传入fun的，但是在fun内是按照向量分别执行语句的。
rs=tapply(da2$sale,list(da2$year,da2$province),function(x){print(paste("输入",x))})
# [1] "输入1"   "输入100"
# [1] "输入5"
# [1] "输入2"
# [1] "输入8"     "输入30000"
# [1] "输入3"
# [1] "输入6"    "输入2000"
# [1] "输入9"
# [1] "输入4"
# [1] "输入7"
# [1] "输入10"
rs #有些地方输入两个
#        A           B           C           D        
#2007 Character,2 "输入 2"    "输入 3"    "输入 4" 
#2008 "输入 5"    NULL        Character,2 "输入 7" 
#2009 NULL        Character,2 "输入 9"    "输入 10"

tapply(da2$sale,list(da2$year,da2$province)) #(年x省份)一样的序号也相同，符合预期
#[1]  1  4  7 10  2  8 11  6  9 12  1  8  6 
```



### gl() 产生因子
```
#补充个因子函数gl，它可以很方便的产生因子，在方差分析中经常会用到

gl(3,5) #3是因子水平数，5是重复次数
#[1] 1 1 1 1 1 2 2 2 2 2 3 3 3 3 3
#Levels: 1 2 3

gl(3,1,15) #15是结果的总长度
#[1] 1 2 3 1 2 3 1 2 3 1 2 3 1 2 3
#Levels: 1 2 3

gl(3,1,20) #如果更长，则会重复以上
```






### 函数table（求因子出现的频数）
```
# 使用格式为：
#table(..., exclude = if (useNA == "no") c(NA, NaN), useNA = c("no",
#        "ifany", "always"), dnn = list.names(...), deparse.level = 1)
#其中参数exclude表示哪些因子不计算。

d <- factor(rep(c("A","B","C"), 10), levels=c("A","B","C","D","E"));d
#[1] A B C A B C A B C A B C A B C A B C A B C A B C A B C A B C
#Levels: A B C D E

table(d, exclude="B")
#d
#A  C  D  E 
#10 10  0  0
```





### by(dataframe, INDICES, FUN, ..., simplify=TRUE)
```
# by 可以当成dataframe上的 tapply 。 indices 应当和dataframe每列的长度相同。
#返回值是 by 类型的object。若simplify=FALSE，本质上是个list。
a=data.frame(
  'x1'=c(1,2,3,4),
  'x2'=c(10,20,30,40)
)
a
#  x1 x2
#1  1 10
#2  2 20
#3  3 30
#4  4 40

ind=a$x1%%2;ind #[1] 1 0 1 0
tapply(a$x2,ind,sum)
#0  1 
#60 40 

by(a,ind,sum)
by(a,ind,sum,simplify=T) #没看到T和F的差别

by(a,ind,colMeans) #ind行分类，colMeans按列求平均
by(a,ind,rowMeans) #ind行分类，rowMeans按行row求平均
```













## rapply, 递归版本的lapply，只处理list类型数据
rapply is a recursive version of lapply.
rapply 是一个递归版本的lapply，它只处理list类型数据，对list的每个元素进行递归遍历，如果list包括子元素则继续遍历。

函数定义：rapply(object, f, classes = "ANY", deflt = NULL, how = c("unlist", "replace", "list"), ...)
参数列表：
  object:list数据
  f: 自定义的调用函数
  classes : 匹配类型, ANY为所有类型
  deflt: 非匹配类型的默认值

how: 3种操作方式，
  当为replace时，则用调用f后的结果替换原list中原来的元素；
  当为list时，新建一个list，类型匹配调用f函数，不匹配赋值为deflt；
  当为unlist时，会执行一次unlist(recursive = TRUE)的操作
  …: 更多参数，可选


比如，对一个list的数据进行过滤，把所有数字型numeric的数据进行从小到大的排序。
```
x=list(a=12,b=1:4,c=c('b','a'))
y=pi
z=data.frame(a=rnorm(10),b=1:10)
a <- list(x=x,y=y,z=z)
a
class(a$z$b)

# 进行排序，并替换原list的值
a2=rapply(a,sort, classes='numeric',how='replace')
a2
a
class(a$z$b)
#从结果发现，只有zza的数据进行了排序，检查zzb的类型，发现是integer，是不等于numeric的，所以没有进行排序。
#接下来，对字符串类型的数据进行操作，把所有的字符串型加一个字符串’++++’，非字符串类型数据设置为NA。

a3=rapply(a,function(x) paste(x,'++++'),classes="character",deflt=NA, how = "list")
a3
#只有xxc为字符串向量，都合并了一个新字符串。其他都变成NA了。
```
那么，有了rapply就可以对list类型的数据进行方便的数据过滤了。



















## eapply, 对环境内的所有变量批量(开发R包用)
These methods allow the user to manipulate any Bimap object as if it was an environment. 
This environment-like API is provided for backward compatibility with the traditional environment-based maps.

对一个环境空间中的所有变量进行遍历。
如果我们有好的习惯，把自定义的变量都按一定的规则存储到自定义的环境空间中，
那么这个函数将会让你的操作变得非常方便。当然，可能很多人都不熟悉空间的操作，那么请参考文章 
揭开R语言中环境空间的神秘面纱，https://zhuanlan.zhihu.com/p/26136111
解密R语言函数的环境空间 https://www.tuicool.com/articles/7fqEJr   http://blog.fens.me/r-environments-function/

函数定义：eapply(env, FUN, ..., all.names = FALSE, USE.NAMES = TRUE)
参数列表：
  env: 环境空间
  FUN: 自定义的调用函数
  …: 更多参数，可选
  all.names: 匹配类型, ANY为所有类型
  USE.NAMES: 如果X为字符串，TRUE设置字符串为数据名，FALSE不设置


```
#下面我们定义一个环境空间，然后对环境空间的变量进行循环处理。
#略
#require(stats)

#1.创建空间
env <- new.env(hash = FALSE) # so the order is fixed
class(env)#[1] "environment"
str(env)#<environment: 0x000000003763e3a0> 

#2.向空间绑定变量
env$a <- 1:10
env$beta <- exp(-3:3)
env$logic <- c(TRUE, FALSE, FALSE, TRUE)
# what have we there?
ls(env)#[1] "a"     "beta"  "logic"
utils::ls.str(env)

#3.对env内的所有变量使用fun，返回list
eapply(env, mean)
unlist(eapply(env, mean, USE.NAMES = FALSE))
#[1] 0.500000 4.535125 5.500000

eapply(env, mean, USE.NAMES = T)
unlist(eapply(env, mean, USE.NAMES = T))
#   logic     beta        a 
#0.500000 4.535125 5.500000


eapply(env, quantile, probs = 1:3/4) #1/4到3/4之间的分位数
eapply(env, quantile)


#计算当前环境空间中的变量和占用内存大小
ls()
eapply(environment(), object.size)
eapply(env, object.size)
```

eapply函数平时很难被用到，但对于R包开发来说，环境空间的使用是必须要掌握的。
特别是当R要做为工业化的工具时，对变量的精确控制和管理是非常必要的。

R的内置向量计算，要优于apply循环，大幅优于for循环。
那么我们在以后的R的开发和使用过程中，应该更多地把apply函数使用好。







## 习题与解答

只有问题，和答案示例。详解请看上文。

Example_1 问题：计算Ozone、Solar.R、 Wind和Tem在一个月内的平均值。
```R 
library(datasets)
dim(airquality) #[1] 153   6
head(airquality) #列名 Ozone Solar.R Wind Temp Month Day

#开始解题：
#有多少个月份？每月多少天？
table(airquality$Month) 
#5  6  7  8  9 
#31 30 31 31 30

#解题失败。难点：有NA值，NA去掉之后不等长。
with(airquality,{
  tapply(Ozone,Month,mean)
})




#参考答案：
#split函数能够分解类型更加复杂的对象
s <- split(airquality,airquality$Month);s
class(s)#[1] "list"

lapply(s, colMeans)
#还是有均值是NA，要去除掉
lapply(s, colMeans,na.rm=T)
#有多余的列，就是Month和Day列可以去掉
lapply(s, function(x){
  colMeans( x[, c("Ozone","Solar.R","Wind","Temp")] )
}) #还要去掉NA

lapply(s, function(x){
  colMeans( x[, c("Ozone","Solar.R","Wind","Temp")] ) 
}, na.rm=T) #Error: 这个na.rm不是放到这里吗？ todo

#最终答案
aa=lapply(s, function(x){
  colMeans( x[, c("Ozone","Solar.R","Wind","Temp")], na.rm=T) 
})
aa
unlist(aa)







#我的答案:也很麻烦
#1.测试：删除指定列含有NA的行。
t1=data.frame(
  a=c(1,2,3,NA,5),
  b=c(10,NA,30,40,50)
);t1
na.omit(t1)
na.omit(t1, cols="a")#为什么所有含NA行全删除了
#
#data.table才能用na.omit只删除指定列存在NA的行，而不是data.frame.
library(data.table)
t2=data.table(
  a=c(1,2,3,NA,5),
  b=c(10,NA,30,40,50)
)
t2
na.omit(t2)
na.omit(t2, cols="a")

#
#1.先转化数据为data.table
airqualityT=data.table(airquality)
#2.逐个去掉含有NA的行，并计算mean
t=na.omit(airqualityT, cols="Ozone");dim(t)
str(t)
class(t)
Ozone=tapply(t$Ozone,t$Month,mean)
#
t=na.omit(airqualityT, cols="Solar.R");dim(t)
Solar.R=tapply(t$Solar.R,t$Month,mean)
#
t=na.omit(airqualityT, cols="Wind");dim(t)
Wind=tapply(t$Wind,t$Month,mean)
#
t=na.omit(airqualityT, cols="Temp");dim(t)
Temp=tapply(t$Temp,t$Month,mean)
#
rbind(Ozone,Solar.R,Wind,Temp)
#
```






# 进阶 Next
```
# R语言plyr包——超越apply族的数据分块处理包 https://blog.csdn.net/emy_zj/article/details/46508653
# R-plyr包数据处理 http://rpubs.com/lee_dog/97768



#银河统计网 数据挖掘计数：http://www.galaxystatistics.com/webTJX/mobile/

# #good 表。| R语言︱数据分组统计函数族——apply族用法与心得 https://blog.csdn.net/sinat_26917383/article/details/51086663
# good图 | R语言中的apply函数族 http://www.cnblogs.com/cloudtj/articles/5523811.html

# 掌握R语言中的apply函数族 http://blog.fens.me/r-apply/
# R语言apply函数族笔记 https://www.tuicool.com/articles/Rn6ri2b
# R语言中的循环函数（Grouping Function） http://www.cnblogs.com/studyzy/p/4355082.html
# apply函数族 http://blog.sina.com.cn/s/blog_71f3890901017yax.html
```










