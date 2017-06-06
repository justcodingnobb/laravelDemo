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

// 测试银联接口
Route::get('/pay/unionpay','PayController@unionpay');
Route::any('/pay/notify','PayController@unionNotify');
// 
Route::group([],function(){
    Route::get('/','HomeController@index');
    Route::get('/cate/{url}','HomeController@getCate');
    Route::get('/post/{url}','HomeController@getPost');
});

// 微信功能
Route::group(['prefix' => 'wx'],function(){
    // 微信登录扫码地址
    Route::any('index', 'Wx\WxController@index');
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
    // 退货
    Route::get('order/tui/{id}','ShopController@getTui');
    // 取消订单
    Route::get('order/over/{id}','ShopController@getOverOrder');
    // 订单列表
    Route::get('order/{status}','ShopController@getOrder');
    // 优惠券列表
    Route::get('yhq','YhqController@getList');
    // 删除优惠券
    Route::get('yhq/del/{id}','YhqController@getDel');
    // 优惠券比价
    Route::get('yhq/price/{id}','YhqController@getPrice');
    // 地址管理
    Route::get('address','UserController@getAddress');
    Route::get('address/add','UserController@getAddressAdd');
    Route::post('address/add','UserController@postAddressAdd');
    Route::get('address/edit/{id}','UserController@getAddressEdit');
    Route::post('address/edit/{id}','UserController@postAddressEdit');
    Route::get('address/del/{id}','UserController@getAddressDel');
    // 修改个人信息
    Route::get('info','UserController@getInfo');
    Route::post('info','UserController@postInfo');
    // 会员中心
    Route::get('center','UserController@getCenter');
    // 退出登陆
    Route::get('logout','UserController@getLogout');
});

// 社会化登录认证
Route::group(['prefix' => 'oauth'],function(){
    // 微信登录扫码地址
    Route::get('wxlogin', 'Auth\WxController@login');
    // 轮询地址
    Route::get('wxislogin', 'Auth\WxController@islogin');
    // 真正的微信登录地址
    Route::get('wx', 'Auth\WxController@wx');
    // 微信回调地址
    Route::get('wx/callback', 'Auth\WxController@callback');
});


// 商城功能
Route::group(['prefix'=>'shop','middleware' => ['homeurl']],function(){
    // 优惠券
    Route::get('yhq/index','YhqController@getIndex');
    // 分类
    Route::get('goodcate/{id?}','ShopController@getGoodcate');
    // 商品
    Route::get('good/{id}/{format?}','ShopController@getGood');
    // 取购物车数量
    Route::get('cartnums','ShopController@getCartnums');
});
// 添加购物车
Route::post('shop/addcart','ShopController@getAddcart');
// 商城功能-登陆后的
Route::group(['prefix'=>'shop','middleware' => ['homeurl','member']],function(){
    // 订单评价
    Route::get('order/ship/{oid}','ShopController@getShip');
    // 订单评价
    Route::get('good/comment/{oid}/{gid}','ShopController@getComment');
    Route::post('good/comment/{oid}/{gid}','ShopController@postComment');
    // 购物车
    Route::get('cart','ShopController@getCart');
    // 修改购物车数量
    Route::post('changecart','ShopController@postChangecart');
    // 移除购物车
    Route::post('removecart','ShopController@postRemovecart');
    // 领优惠券
    Route::get('yhq/get/{id}','YhqController@getGet');
    // 提交订单
    Route::get('addorder','ShopController@getAddorder');
    // 支付
    Route::get('order/pay/{oid}','PayController@list');
    Route::post('order/pay/{oid}','PayController@pay');
});

// 支付回调
Route::group([],function(){
    // 支付宝应用网关,异步回调
    Route::post('alipay/gateway','Pay\AlipayController@gateway');
    // 支付宝应用网关,同步回调
    Route::post('alipay/return','Pay\AlipayController@gateway');
    // 微信回调
    Route::post('weixin/return','Pay\WxpayController@gateway');
});

// 微信功能
Route::group(['prefix'=>'wx'],function(){
    // 接口,注意：一定是 Route::any, 因为微信服务端认证的时候是 GET, 接收用户消息时是 POST ！
    Route::any('index','Wx\WxController@index');
});



// 后台路由
Route::group(['prefix'=>'xyshop'],function(){
    // 后台管理不用其它，只用登陆，退出
    // Route::auth();
    Route::get('login', 'Admin\PublicController@getLogin');
    Route::post('login', 'Admin\PublicController@postLogin');
    // 退出登陆
    Route::get('logout', 'Admin\PublicController@getLogout');
});

Route::group(['prefix'=>'xyshop','middleware' => ['rbac','backurl']],function(){
    // 自提点管理
    Route::get('ziti/index', 'Good\ZitiController@getIndex');
    Route::get('ziti/add', 'Good\ZitiController@getAdd');
    Route::post('ziti/add', 'Good\ZitiController@postAdd');
    Route::get('ziti/edit/{id}', 'Good\ZitiController@getEdit');
    Route::post('ziti/edit/{id}', 'Good\ZitiController@postEdit');
    Route::get('ziti/del/{id}', 'Good\ZitiController@getDel');
    Route::post('ziti/sort', 'Good\ZitiController@postSort');
    Route::post('ziti/alldel', 'Good\ZitiController@postAlldel');
    // 广告管理
    Route::get('ad/index', 'Good\AdController@getIndex');
    Route::get('ad/add', 'Good\AdController@getAdd');
    Route::post('ad/add', 'Good\AdController@postAdd');
    Route::get('ad/edit/{id}', 'Good\AdController@getEdit');
    Route::post('ad/edit/{id}', 'Good\AdController@postEdit');
    Route::get('ad/del/{id}', 'Good\AdController@getDel');
    Route::post('ad/sort', 'Good\AdController@postSort');
    Route::post('ad/alldel', 'Good\AdController@postAlldel');
    // 团购管理
    Route::get('tuan/index', 'Good\TuanController@getIndex');
    Route::get('tuan/add/{id}', 'Good\TuanController@getAdd');
    Route::post('tuan/add/{id}', 'Good\TuanController@postAdd');
    Route::get('tuan/edit/{id}', 'Good\TuanController@getEdit');
    Route::post('tuan/edit/{id}', 'Good\TuanController@postEdit');
    Route::get('tuan/del/{id}', 'Good\TuanController@getDel');
    Route::post('tuan/sort', 'Good\TuanController@postSort');
    Route::post('tuan/alldel', 'Good\TuanController@postAlldel');
    // 满赠管理
    Route::get('manzeng/index', 'Good\ManzengController@getIndex');
    Route::get('manzeng/add/{id}', 'Good\ManzengController@getAdd');
    Route::post('manzeng/add/{id}', 'Good\ManzengController@postAdd');
    Route::get('manzeng/edit/{id}', 'Good\ManzengController@getEdit');
    Route::post('manzeng/edit/{id}', 'Good\ManzengController@postEdit');
    Route::get('manzeng/del/{id}', 'Good\ManzengController@getDel');
    Route::post('manzeng/sort', 'Good\ManzengController@postSort');
    Route::post('manzeng/alldel', 'Good\ManzengController@postAlldel');
    // 优惠券管理
    Route::get('youhuiquan/index', 'Good\YouhuiquanController@getIndex');
    Route::get('youhuiquan/add', 'Good\YouhuiquanController@getAdd');
    Route::post('youhuiquan/add', 'Good\YouhuiquanController@postAdd');
    Route::get('youhuiquan/edit/{id}', 'Good\YouhuiquanController@getEdit');
    Route::post('youhuiquan/edit/{id}', 'Good\YouhuiquanController@postEdit');
    Route::get('youhuiquan/del/{id}', 'Good\YouhuiquanController@getDel');
    Route::post('youhuiquan/sort', 'Good\YouhuiquanController@postSort');
    Route::post('youhuiquan/alldel', 'Good\YouhuiquanController@postAlldel');
    // 活动管理
    Route::get('huodong/index', 'Good\HuodongController@getIndex');
    Route::get('huodong/add', 'Good\HuodongController@getAdd');
    Route::post('huodong/add', 'Good\HuodongController@postAdd');
    Route::get('huodong/edit/{id}', 'Good\HuodongController@getEdit');
    Route::post('huodong/edit/{id}', 'Good\HuodongController@postEdit');
    Route::get('huodong/del/{id}', 'Good\HuodongController@getDel');
    Route::get('huodong/good/{gids?}', 'Good\HuodongController@getGood');
    Route::post('huodong/good/{gids?}', 'Good\HuodongController@postGood');
    Route::get('huodong/goodlist/{id}', 'Good\HuodongController@getGoodlist');
    Route::get('huodong/rmgood/{id}/{gid}', 'Good\HuodongController@getRmgood');
    Route::post('huodong/sort', 'Good\HuodongController@postSort');
    Route::post('huodong/alldel', 'Good\HuodongController@postAlldel');
    // 订单管理
    Route::get('order/index', 'Admin\OrderController@index');
    Route::get('order/del/{id}', 'Admin\OrderController@getDel');
    Route::get('order/ship/{id}', 'Admin\OrderController@getShip');
    Route::post('order/ship/{id}', 'Admin\OrderController@postShip');
    Route::get('order/tui/{id}', 'Admin\OrderController@getTui');
    Route::get('order/ziti/{id}', 'Admin\OrderController@getZiti');
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
    Route::post('goodcate/sort', 'Admin\GoodCateController@postSort');
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
    Route::post('good/sort', 'Admin\GoodController@postSort');
    Route::post('good/alldel', 'Admin\GoodController@postAlldel');
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
    Route::get('user/chong/{id}', 'Admin\UserController@getChong');
    Route::post('user/chong/{id}', 'Admin\UserController@postChong');

});
