系统基于Laravel 5.3，认证使用了RBAC及系统Gate，RBAC主要产生后台菜单，Gate细化小菜单并进行更细的权限管理

后台用户使用auth认证（5.3的多用户系统guard功能，表admins），后台默认用户名密码 admin adminss

样式表，bootstrap

rbac中间件控制打开页面是否有权限，auth:admin判断是否登陆，App:make('com')->ifCan()控制细节显示与否

添加调试工具Debugbar http://laravelacademy.org/post/2774.html ，主页里关闭调试

提示信息，使用一次性session，在back()或者redirect()后->with('message','信息');

数据库备份功能（改造自V9）

附件删除
