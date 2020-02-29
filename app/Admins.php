<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    protected  $table = 'num';
    protected $primaryKey='u_id';
    public $timestamps=false;
    //黑名单
    protected $guarded=[];
}



//  composer是什么？  composer是PHP的包管理、包依赖关系管理工具
//  作用是：有了它，我们就很轻松一个命令就可以把他人优秀的代码用到我们的项目中来，而且很容易管理依赖关系，更新删除等操作也很轻易的实现。
//  命名空间的关键字是  use  目的是 PHP中不允许两个函数或者类出现相同的名字，否则会产生一个致命的错误。
// 什么是ORM 实现了数据模型与数据库的解耦，即数据模型不需要依赖于特定的数据库，通过简单的配置就可以轻松更换数据库。
// 理解   Model
// php artisan make:controller Brand --resource   //创建控制器

// php artisan make:model Brand //创建model

// php artisan make:request 文件名 //创建验证类
// Route::get('/brand', 'Brand@create');//get跳转控制器
// Route::post('/tj', 'Brand@store');//post跳转控制器
// Route::view('/logins','logins');//直接跳转视图

// app_path 返回 app 目录的完整路径。
// base_path 函数返回项目根目录的完整路径
// config_path 函数返回应用程序配置目录的完整路径：
// view 函数获取一个 视图
// public_path 函数返回 public 目录的完整路径：

// chmod
// 777读写运行权限
// r=4，w=2，x=1 
// chmod 777 file  


// 什么是路由分组 目的
// 路由分组功能允许把相同前缀的路由定义合并分组，这样可以简化路由定义，并且提高路由匹配的效率，不必每次都去遍历完整的路由规则（尤其是开启了路由延迟解析后性能更佳）。

// 请写出数组函数
// array_chunk — 将一个数组分割成多个
// array_column — 返回数组中指定的一列
// array_unique — 移除数组中重复的值
// array_unshift — 在数组开头插入一个或多个单元
// array_merge — 合并一个或多个数组

// liux命令
// (1)	打印出当前所在目录pwd
// (2)	清屏  clear
// (3)	切换目录  cd 目录名
// (4)	显示一个目录下 的所有文件和文件夹  ls
// (5)	创建目录   mkdir  目录名  如果想级联创建  需要增加-p参数
// (6)	删除目录   rm  -rf  目录名
// (7)	复制目录  cp -r 目录名   目标目录名
// (8)	移动目录  mv 目录名 目标目录名   重命名就是移动目录在当前目录 
