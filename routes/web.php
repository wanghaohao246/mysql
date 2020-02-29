<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     // echo '123';
//     $name = '1908欢迎您';
//     return view('welcome',['name'=>$name]);
// });
// Route::get('/show', function () {
//     echo '这里是商品详情页';
// });

// Route::get('/shows', function () {
//     echo '这里是商品详情页';
// });


// Route::get('/goods/{id}', function ($id) {
//     echo '商品id是:'.$id;
// });

// Route::get('/show/{id}', function ($id) {
//     echo '商品id是:'.$id;
// });

// Route::get('/show/{id}/{name}', function ($id,$name) {
//     echo '商品id是:'.$id;
//     echo '商品是:'.$name;
// })->where(['name'=>'[a-z]\w','id'=>'\d+']);


// Route::get('/user', 'UserController@index');


// Route::get('/brand/add', 'UserController@add');//添加页面一种方法
// Route::get('/brand/adds', 'UserController@add');//第二种


// // Route::get('/cartgory', 'UserController@add');

// Route::get('/cartgory/add', 'UserController@cartgory');


// Route::post('/adddo', 'UserController@adddo');

//外来人口
Route::get('/create', 'User@create');
Route::post('/store', 'User@store');

Route::get('/user', 'User@index');

Route::get('/edit/{id}', 'User@edit');
Route::post('/update/{id}', 'User@update');
Route::get('/del/{id}', 'User@del');


// Route::view('/login','login');
// Route::post('/logindo', 'Login@logindo');


//学生
Route::get('/student', 'Stu@create');
Route::post('/ins', 'Stu@store');

Route::get('/list', 'Stu@index');

Route::get('/bj/{id}', 'Stu@edit');
Route::post('/xg/{id}', 'Stu@update');
Route::get('/de/{id}', 'Stu@del');


//商品
Route::get('/brand', 'Brand@create');
Route::post('/tj', 'Brand@store');
Route::get('/index', 'Brand@index');
Route::get('/bianji/{id}','Brand@edit');
Route::post('/xiugai/{id}','Brand@update');
Route::get('/delete/{id}','Brand@destroy');
//文章
Route::prefix('WZ')->middleware('checklogins')->group(function(){
	Route::get('/insert', 'Wenzhang@create');
	Route::post('/store', 'Wenzhang@store');
	Route::get('/list', 'Wenzhang@index');
	Route::get('/edit/{id}', 'Wenzhang@edit');
	Route::post('/update/{id}', 'Wenzhang@update');
	Route::get('/del/{id}', 'Wenzhang@destroy');
});
Route::view('/logins','logins');
Route::post('/logindos', 'Logins@logindo');
//唯一性验证
Route::post('/news/checkOnly', 'Wenzhang@checkOnly');

Route::post('/new/checkOnly', 'Brand@checkOnly');

//无限极分类
Route::prefix('type')->group(function(){
    Route::get('create','TypeController@create');
    Route::post('add','TypeController@add');    //添加aiax验证
    Route::post('store','TypeController@store');
    Route::get('/','TypeController@index');

    Route::get('edit/{id}','TypeController@edit');
    
    Route::post('update/{id}','TypeController@update');
    Route::get('destroy/{id}','TypeController@destroy'); 
    });
//管理员 
Route::prefix('adm')->group(function(){
    Route::get('create','Users@create');
    Route::post('store','Users@store');
    Route::get('index','Users@index');
    Route::get('destroy/{id}','Users@destroy');
    Route::get('edit/{id}','Users@edit');
    Route::post('update/{id}','Users@update');
});



//前台
Route::get('/','Index\IndexController@index');
Route::view('/login','index.login');
Route::view('/reg','index.reg');
Route::view('/prolist','index.prolist');
Route::view('/proinfo','index.proinfo');
Route::view('/car','index.car');
Route::view('/pay','index.pay');



//库存管理
Route::prefix('n')->middleware('checklogins')->group(function(){

Route::get('/num', 'Number@create');


Route::get('/cre', 'Number@list');
Route::get('/crea', 'Number@index');
Route::view('/creates','num.tianjia');
Route::post('/store', 'Number@store');
Route::get('/troy/{id}','Number@destroy');
 });