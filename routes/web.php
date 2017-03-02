<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// 微信
Route::group(['middleware' => ['web']],function(){
    Route::get('/','HomeController@index');
    Route::get('test','HomeController@test');
});


// 微信
Route::group(['prefix'=>'wx','middleware' => ['web']],function(){
    // 静默授权
    Route::get('auth', 'Wx\WxAuthController@getIndex');
    // 手动授权
    Route::get('mauth', 'Wx\WxAuthController@getUserinfo');
});

// API路由
Route::group(['prefix'=>'api','middleware' => ['apis','jwt']],function(){
    // 用户
    Route::post('user/login', 'UserController@postLogin');
    Route::post('user/logout', 'UserController@postLogout');
    // 推送
    Route::post('push/msgtosingle', 'PushController@postMsgtosingle');
    // 环信
    Route::get('emchat/token', 'EmchatController@getToken');
    // 短信、阿里大鱼
    Route::post('sms/index', 'SmsController@postIndex');
});



// 后台路由
Route::group(['prefix'=>'admin','middleware' => ['web']],function(){
    // 后台管理不用其它，只用登陆，退出
    // Route::auth();
    Route::get('login', 'Admin\PublicController@getLogin');
    Route::post('login', 'Admin\PublicController@postLogin');
    Route::get('logout', 'Admin\PublicController@getLogout');
});
Route::group(['prefix'=>'admin','middleware' => ['web','auth:admin','rbac']],function(){
    // Index
    Route::get('index/index', 'Admin\IndexController@getIndex');
    Route::get('index/main', 'Admin\IndexController@getMain');
    Route::get('index/left/{id}', 'Admin\IndexController@getLeft');
    Route::get('index/cache', 'Admin\IndexController@getCache');
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
    Route::get('type/index', 'Admin\TypeController@getIndex');
    Route::get('type/add/{id?}', 'Admin\TypeController@getAdd');
    Route::post('type/add/{id?}', 'Admin\TypeController@postAdd');
    Route::get('type/edit/{id?}', 'Admin\TypeController@getEdit');
    Route::post('type/edit/{id?}', 'Admin\TypeController@postEdit');
    Route::get('type/del/{id?}', 'Admin\TypeController@getDel');
    // 微信 配置
    Route::get('wx/config', 'Admin\WxController@getConfig');
    Route::post('wx/config', 'Admin\WxController@postConfig');
    Route::get('wx/emptycache', 'Admin\WxController@getEmptycache');
    Route::get('wx/emptydata', 'Admin\WxController@getEmptydata');
    // 微信 关联菜单
    Route::get('wxlinkage/index/{pid?}', 'Admin\WxlinkageController@getIndex');
    Route::get('wxlinkage/add/{pid?}', 'Admin\WxlinkageController@getAdd');
    Route::post('wxlinkage/add/{pid?}', 'Admin\WxlinkageController@postAdd');
    Route::get('wxlinkage/edit/{id}', 'Admin\WxlinkageController@getEdit');
    Route::post('wxlinkage/edit/{id}', 'Admin\WxlinkageController@postEdit');
    Route::get('wxlinkage/del/{id}', 'Admin\WxlinkageController@getDel');
    // 微信 自定义菜单
    Route::get('wxmenu/index/{pid?}', 'Admin\WxmenuController@getIndex');
    Route::get('wxmenu/add/{pid?}', 'Admin\WxmenuController@getAdd');
    Route::post('wxmenu/add/{pid?}', 'Admin\WxmenuController@postAdd');
    Route::get('wxmenu/edit/{id}', 'Admin\WxmenuController@getEdit');
    Route::post('wxmenu/edit/{id}', 'Admin\WxmenuController@postEdit');
    Route::get('wxmenu/del/{id}', 'Admin\WxmenuController@getDel');
    Route::get('wxmenu/update', 'Admin\WxmenuController@getUpdate');
    // 微信 自定义回复
    Route::get('wxmsg/index', 'Admin\WxmsgController@getIndex');
    Route::get('wxmsg/add', 'Admin\WxmsgController@getAdd');
    Route::post('wxmsg/add', 'Admin\WxmsgController@postAdd');
    Route::get('wxmsg/edit/{id}', 'Admin\WxmsgController@getEdit');
    Route::post('wxmsg/edit/{id}', 'Admin\WxmsgController@postEdit');
    Route::get('wxmsg/del/{id}', 'Admin\WxmsgController@getDel');
    // 微信素材管理
    Route::get('wxattr/index', 'Admin\WxattrController@getIndex');
    Route::get('wxattr/add', 'Admin\WxattrController@getAdd');
    Route::post('wxattr/add', 'Admin\WxattrController@postAdd');
    Route::get('wxattr/del/{id}', 'Admin\WxattrController@getDel');
    Route::get('wxattr/nums', 'Admin\WxattrController@getNums');
    Route::post('wxattr/uploadimg', 'Admin\WxattrController@postUploadimg');
    // 微信 用户组管理
    Route::get('wxgroup/index', 'Admin\WxgroupController@getIndex');
    Route::get('wxgroup/add', 'Admin\WxgroupController@getAdd');
    Route::post('wxgroup/add', 'Admin\WxgroupController@postAdd');
    Route::get('wxgroup/edit/{id}', 'Admin\WxgroupController@getEdit');
    Route::post('wxgroup/edit/{id}', 'Admin\WxgroupController@postEdit');
    Route::get('wxgroup/del/{id}', 'Admin\WxgroupController@getDel');
    Route::get('wxgroup/update', 'Admin\WxgroupController@getUpdate');
    // 微信 用户管理
    Route::get('wxuser/index', 'Admin\WxuserController@getIndex');
    Route::get('wxuser/update', 'Admin\WxuserController@getUpdate');
    Route::get('wxuser/remark/{id}', 'Admin\WxuserController@getRemark');
    Route::post('wxuser/remark/{id}', 'Admin\WxuserController@postRemark');
    Route::get('wxuser/togroup', 'Admin\WxuserController@getTogroup');
});
