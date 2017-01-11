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

    <link rel="stylesheet" href="{{ $sites['url'] }}{{ $sites['static']}}admin/css/reset.css">
</head>

<body>
   <div class="login_box pure-u-1-4 pure-u-sm-1-2 m-a">
        <h1>LaravelCMF管理中心</h1>
        <form method="POST" action="{{ url('/admin/login') }}" class="pure-form pure-form-stacked">
            {!! csrf_field() !!}
           <label for="username">用户名：</label>
           <input type="text" name="name" value="{{ old('name') }}" class="pure-input-1">
           @if ($errors->has('name'))
                <span class="help-block">
                  {{ $errors->first('name') }}
                </span>
            @endif
           <label for="password">密码：</label>
           <input type="password" name="password" class="pure-input-1">
           @if ($errors->has('password'))
                <span class="help-block">
                  {{ $errors->first('password') }}
                </span>
            @endif
            
            @if(session('message'))
            <span class="help-block">{{ session('message') }}</span>
            @endif
            <div class="pure-u-1">
                <input type="submit" value="登陆" class="pure-button pure-button-primary pure-input-1-3">
                <input type="reset" value="重填" class="pure-button pure-input-1-3">
            </div>
        </form>
   </div>
</body>

</html>