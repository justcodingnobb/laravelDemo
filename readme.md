系统基于Laravel 5.4，认证使用了RBAC及系统Gate，RBAC主要产生后台菜单，Gate细化小菜单并进行更细的权限管理

样式表，bootstrap

rbac 中间件控制打开页面是否有权限，同时判断是否登陆，App:make('com')->ifCan()控制细节显示与否

添加调试工具Debugbar http://laravelacademy.org/post/2774.html，主页里关闭调试

提示信息，使用一次性session，在back()或者redirect()后->with('message','信息');

数据库备份功能（改造自V9）

附件删除

用户功能，同时做了一套api的接口

商城，分类下可筛选，库存及属性按sku来进行设计

下单及支付过程完整，支付使用包来完成，目前只支持支付宝与微信，微信做了扫码支付功能

