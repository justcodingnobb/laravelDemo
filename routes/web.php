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

Route::get('/vue','VueController@index');


// 
Route::group([],function(){
    Route::get('/','HomeController@index');
    Route::get('/cate/{url}','HomeController@getCate');
    Route::get('/post/{url}','HomeController@getPost');
});


// 会员功能
Route::group(['prefix'=>'user','middleware' => ['homeurl']],function(){
    // 注册
    Route::get('register','UserController@getRegister');
    Route::post('register','UserController@postRegister');
    // 登陆
    Route::get('login','UserController@getLogin');
    Route::post('login','UserController@postLogin');
});

// 会员功能
Route::group(['prefix'=>'user','middleware' => ['homeurl','member']],function(){
    // 注册
    Route::get('center','UserController@getCenter');
    // 退出登陆
    Route::get('logout','UserController@getLogout');
});


// 商城功能
Route::group(['prefix'=>'shop','middleware' => ['homeurl']],function(){
    // 分类
    Route::get('cate/{id}/{format?}','ShopController@goodcate');
    // 商品
    Route::get('good/{id}/{format?}','ShopController@good');
    // 购物车
    Route::get('cart','ShopController@cart');
    // 订单列表
    Route::get('order','ShopController@order');
    // 添加购物车
    Route::get('addcart','ShopController@getAddcart');
    // 修改购物车数量
    Route::post('changecart','ShopController@postChangecart');
    // 移除购物车
    Route::post('removecart','ShopController@postRemovecart');
    // 取购物车数量
    Route::get('cartnums','ShopController@cartnums');
});
// 商城功能-登陆后的
Route::group(['prefix'=>'shop','middleware' => ['homeurl','member']],function(){
    // 提交订单
    Route::get('addorder','ShopController@getAddorder');
    // 支付
    Route::get('order/pay/{oid}','PayController@list');
    Route::post('order/pay/{oid}','PayController@pay');
});

// 支付回调
Route::group(['middleware' => ['web']],function(){
    // 支付宝应用网关,异步回调
    Route::post('alipay/gateway','Pay\AlipayController@gateway');
    // 支付宝应用网关,同步回调
    Route::post('alipay/return','Pay\AlipayController@gateway');
    // 微信回调
    Route::post('weixin/return','Pay\WxpayController@gateway');
});




// 后台路由
Route::group(['prefix'=>'xyshop'],function(){
    // 后台管理不用其它，只用登陆，退出
    // Route::auth();
    Route::get('login', 'Admin\PublicController@getLogin');
    Route::post('login', 'Admin\PublicController@postLogin');
});
Route::group(['prefix'=>'xyshop','middleware' => ['rbac','backurl']],function(){
    // 支付配置
    Route::get('pay/index', 'Admin\PayController@getIndex');
    Route::get('pay/edit/{id}', 'Admin\PayController@getEdit');
    Route::post('pay/edit/{id}', 'Admin\PayController@postEdit');
    // 商品分类
    Route::get('goodcate/index', 'Admin\GoodCateController@getIndex');
    Route::get('goodcate/cache', 'Admin\GoodCateController@getCache');
    Route::get('goodcate/add/{id?}', 'Admin\GoodCateController@getAdd');
    Route::post('goodcate/add/{id?}', 'Admin\GoodCateController@postAdd');
    Route::get('goodcate/edit/{id?}', 'Admin\GoodCateController@getEdit');
    Route::post('goodcate/edit/{id?}', 'Admin\GoodCateController@postEdit');
    Route::get('goodcate/del/{id?}', 'Admin\GoodCateController@getDel');
    Route::get('goodcate/attr/{id?}', 'Admin\GoodCateController@getAttr');
    Route::post('goodcate/attr/{id?}', 'Admin\GoodCateController@postAttr');
    // 商品属性
    Route::get('goodattr/index/{pid?}', 'Admin\GoodAttrController@getIndex');
    Route::get('goodattr/add/{id}', 'Admin\GoodAttrController@getAdd');
    Route::post('goodattr/add/{id}', 'Admin\GoodAttrController@postAdd');
    Route::get('goodattr/edit/{id?}', 'Admin\GoodAttrController@getEdit');
    Route::post('goodattr/edit/{id?}', 'Admin\GoodAttrController@postEdit');
    Route::get('goodattr/del/{id?}', 'Admin\GoodAttrController@getDel');
    // 商品
    Route::get('good/index', 'Admin\GoodController@getIndex');
    Route::get('good/add/{id?}', 'Admin\GoodController@getAdd');
    Route::post('good/add/{id?}', 'Admin\GoodController@postAdd');
    Route::get('good/edit/{id?}', 'Admin\GoodController@getEdit');
    Route::post('good/edit/{id?}', 'Admin\GoodController@postEdit');
    Route::get('good/del/{id?}', 'Admin\GoodController@getDel');
    Route::get('good/format/{id}', 'Admin\GoodController@getFormat');
    Route::get('good/addformat/{id}', 'Admin\GoodController@getAddformat');
    Route::post('good/addformat/{id}', 'Admin\GoodController@postAddformat');
    Route::get('good/editformat/{id}', 'Admin\GoodController@getEditformat');
    Route::post('good/editformat/{id}', 'Admin\GoodController@postEditformat');
    Route::get('good/delformat/{id}', 'Admin\GoodController@getDelformat');
    // 退出登陆
    Route::get('logout', 'Admin\PublicController@getLogout');
    // Index
    Route::get('index/index', 'Admin\IndexController@getIndex');
    Route::get('index/main', 'Admin\IndexController@getMain');
    Route::get('index/left/{id}', 'Admin\IndexController@getLeft');
    Route::get('index/cache', 'Admin\IndexController@getCache');
    // 系统配置
    Route::get('config/index', 'Admin\ConfigController@index');
    Route::post('config/index', 'Admin\ConfigController@postIndex');
    // admin
    Route::get('admin/index', 'Admin\AdminController@getIndex');
    Route::get('admin/add', 'Admin\AdminController@getAdd');
    Route::post('admin/add', 'Admin\AdminController@postAdd');
    Route::post('admin/edit/{id?}', 'Admin\AdminController@postEdit');
    Route::get('admin/edit/{id?}', 'Admin\AdminController@getEdit');
    Route::get('admin/pwd/{id?}', 'Admin\AdminController@getPwd');
    Route::post('admin/pwd/{id?}', 'Admin\AdminController@postPwd');
    Route::get('admin/del/{id?}', 'Admin\AdminController@getDel');
    Route::get('admin/myedit', 'Admin\AdminController@getMyedit');
    Route::post('admin/myedit', 'Admin\AdminController@postMyedit');
    Route::get('admin/mypwd', 'Admin\AdminController@getMypwd');
    Route::post('admin/mypwd', 'Admin\AdminController@postMypwd');
    // role
    Route::get('role/index', 'Admin\RoleController@getIndex');
    Route::get('role/add', 'Admin\RoleController@getAdd');
    Route::post('role/add', 'Admin\RoleController@postAdd');
    Route::get('role/edit/{id?}', 'Admin\RoleController@getEdit');
    Route::post('role/edit/{id?}', 'Admin\RoleController@postEdit');
    Route::get('role/del/{id?}', 'Admin\RoleController@getDel');
    Route::get('role/priv/{id?}', 'Admin\RoleController@getPriv');
    Route::post('role/priv/{id?}', 'Admin\RoleController@postPriv');
    // 部门
    Route::get('section/index', 'Admin\SectionController@getIndex');
    Route::get('section/add', 'Admin\SectionController@getAdd');
    Route::post('section/add', 'Admin\SectionController@postAdd');
    Route::get('section/edit/{id}', 'Admin\SectionController@getEdit');
    Route::post('section/edit/{id}', 'Admin\SectionController@postEdit');
    Route::get('section/del/{id}', 'Admin\SectionController@getDel');
    // menu
    Route::get('menu/index', 'Admin\MenuController@getIndex');
    Route::get('menu/add/{id?}', 'Admin\MenuController@getAdd');
    Route::post('menu/add/{id?}', 'Admin\MenuController@postAdd');
    Route::get('menu/edit/{id}', 'Admin\MenuController@getEdit');
    Route::post('menu/edit/{id}', 'Admin\MenuController@postEdit');
    Route::get('menu/del/{id}', 'Admin\MenuController@getDel');
    // log
    Route::get('log/index', 'Admin\LogController@getIndex');
    Route::get('log/del', 'Admin\LogController@getDel');
    // cate
    Route::get('cate/index', 'Admin\CateController@getIndex');
    Route::get('cate/cache', 'Admin\CateController@getCache');
    Route::get('cate/add/{id?}', 'Admin\CateController@getAdd');
    Route::post('cate/add/{id?}', 'Admin\CateController@postAdd');
    Route::get('cate/edit/{id?}', 'Admin\CateController@getEdit');
    Route::post('cate/edit/{id?}', 'Admin\CateController@postEdit');
    Route::get('cate/del/{id?}', 'Admin\CateController@getDel');
    // attr
    Route::get('attr/index', 'Admin\AttrController@getIndex');
    Route::get('attr/delfile/{id?}', 'Admin\AttrController@getDelfile');
    Route::post('attr/uploadimg', 'Admin\AttrController@postUploadimg');
    // art
    Route::get('art/index', 'Admin\ArtController@getIndex');
    Route::get('art/add/{id?}', 'Admin\ArtController@getAdd');
    Route::post('art/add/{id?}', 'Admin\ArtController@postAdd');
    Route::get('art/edit/{id}', 'Admin\ArtController@getEdit');
    Route::post('art/edit/{id}', 'Admin\ArtController@postEdit');
    Route::get('art/del/{id}', 'Admin\ArtController@getDel');
    Route::get('art/show/{id}', 'Admin\ArtController@getShow');
    Route::post('art/alldel', 'Admin\ArtController@postAlldel');
    Route::post('art/listorder', 'Admin\ArtController@postListorder');
    // database
    Route::get('database/export', 'Admin\DatabaseController@getExport');
    Route::post('database/export', 'Admin\DatabaseController@postExport');
    Route::get('database/import/{pre?}', 'Admin\DatabaseController@getImport');
    Route::post('database/delfile', 'Admin\DatabaseController@postDelfile');
    // type
    Route::get('type/index/{pid?}', 'Admin\TypeController@getIndex');
    Route::get('type/add/{id?}', 'Admin\TypeController@getAdd');
    Route::post('type/add/{id?}', 'Admin\TypeController@postAdd');
    Route::get('type/edit/{id?}', 'Admin\TypeController@getEdit');
    Route::post('type/edit/{id?}', 'Admin\TypeController@postEdit');
    Route::get('type/del/{id?}', 'Admin\TypeController@getDel');
    // 会员组
    Route::get('group/index', 'Admin\GroupController@getIndex');
    Route::get('group/add', 'Admin\GroupController@getAdd');
    Route::post('group/add', 'Admin\GroupController@postAdd');
    Route::get('group/edit/{id}', 'Admin\GroupController@getEdit');
    Route::post('group/edit/{id}', 'Admin\GroupController@postEdit');
    Route::get('group/del/{id}', 'Admin\GroupController@getDel');
    // 会员
    Route::get('user/index', 'Admin\UserController@getIndex');
    Route::get('user/edit/{id}', 'Admin\UserController@getEdit');
    Route::post('user/edit/{id}', 'Admin\UserController@postEdit');
    Route::get('user/status/{id}/{status}', 'Admin\UserController@getStatus');

});
