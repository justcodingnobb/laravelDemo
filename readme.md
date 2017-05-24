系统基于Laravel 5.4，认证使用了RBAC及系统Gate，RBAC主要产生后台菜单，Gate细化小菜单并进行更细的权限管理

样式表，bootstrap

rbac 中间件控制打开页面是否有权限，同时判断是否登陆，App:make('com')->ifCan()控制细节显示与否

添加调试工具Debugbar http://laravelacademy.org/post/2774.html，主页里关闭调试

提示信息，使用一次性session，在back()或者redirect()后->with('message','信息');

数据库备份功能（改造自V9）

附件删除

用户功能，同时做了一套api的接口

商城，分类下可筛选，库存及属性按sku来进行设计

下单及支付过程完整，支付使用包(omnipay-alipay/omnipay-wechatpay)来完成，目前只支持支付宝与微信，微信做了扫码支付功能

微信扫码登录功能完成，oauth的认证使用的是laravel-socialite包，PC与微信同步使用的是数据库存根auth_id的办法，pc端ajax轮询

购物车可以为负

后台订单管理

库存、限时、限量、新品

活动

优惠

满赠

团购

各种排序

商品页面

加购物车

优惠券

使用优惠券

送货地址

提交订单，满赠

余额支付

<!--  -->

###待改bug

支付过程、库存、退货、自提

商品属性、购物车更新

个人中心

网银支付

数据统计
