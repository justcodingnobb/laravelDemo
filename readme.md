系统基于Laravel 5.3，认证使用了RBAC及系统Gate，RBAC主要产生后台菜单，Gate细化小菜单并进行更细的权限管理

后台用户使用auth认证（5.3的多用户系统guard功能，表admins），后台默认用户名密码 admin adminss

样式表，引用pure库，其它自己写的

rbac中间件控制打开页面是否有权限，auth:admin判断是否登陆，App:make('com')->ifCan()控制细节显示与否

添加调试工具Debugbar http://laravelacademy.org/post/2774.html，主页里关闭调试

分页完成，添加手动跳转，编辑完成后跳转到编辑前列表页面（用一个input字段存下跳转前的参数，传给跳转函数）

提示信息，使用一次性session，在back()或者redirect()后->with('message','信息');

附件删除

api认证使用JWT包，但是中间件自己写的JWT.php文件，主要判断两个用户系统的区别

使用JWT库、Redis库

添加阿里大鱼短信功能、支付宝、环信、百度推送

api的返回值记得统一data为一种类型{}或者[]

更新富文本编辑器为Ueditor上传组件为webuploader，文章中的图片及附件不再进行记录（需要进一步优化，做记录），只记录缩略图及附件

更新webuploader功能，缩略图片压缩尺寸并存入thumb文件夹，其它存入attrs文件夹

Ueditor整合到laraver中，注意csrf取消对url的token，进行存储记录

数据库备份功能（改造自V9）