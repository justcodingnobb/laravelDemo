<!doctype html>
<html lang="zh-cn">

<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <title>LaravelCMF后台登陆</title>
  <meta name="author" content="李潇喃：www.muzisheji.com" />
  <!-- IE最新兼容 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- 国产浏览器高速/微信开发不要用 -->
  <meta name="renderer" content="webkit">
  <!-- 移动设备禁止缩放 -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="stylesheet" href="{{ $sites['url'] }}{{ $sites['static']}}admin/css/reset.css"></head>

<body>
  <div class="row container m-a">
    <div class="login_box col-xs-10 col-sm-6 col-md-4 m-a">
      <h1>
        <small>LaravelCMF管理中心</small>
      </h1>
      <form method="POST" action="{{ url('/admin/login') }}">
        {!! csrf_field() !!}
        <div class="form-group">
          <label for="username">用户名：</label>
          <input type="text" name="name" value="{{ old('name') }}" class="form-control">
          @if ($errors->has('name'))
          <span class="help-block">{{ $errors->first('name') }}</span>
          @endif
        </div>
        <div class="form-group">
          <label for="password">密码：</label>
          <input type="password" name="password" class="form-control">
          @if ($errors->has('password'))
          <span class="help-block">{{ $errors->first('password') }}</span>
          @endif
        </div>
        @if(session('message'))
        <span class="help-block">{{ session('message') }}</span>
        @endif
        <div class="form-group text-left">
          <input type="submit" value="登陆" class="btn btn-primary">
          <input type="reset" value="重填" class="btn btn-default"></div>
      </form>
    </div>
  </div>
</body>

</html>