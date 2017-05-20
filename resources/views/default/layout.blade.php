<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    @yield('title')
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{ $sites['static']}}home/css/home.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

    <header class="head container-fluid mt10">
        <ul class="nav nav-pills">
            <li class="active"><a href="{{ url('shop/yhq/index') }}">优惠券</a></li>
            <li><a href="{{ url('shop/yhq/index') }}">优惠券</a></li>
        </ul>
    </header>
    <hr class="mt10">
    <!-- 主内容 -->
    @yield('content')

    <!-- 导航 -->
    <nav class="navbar navbar-fixed-bottom menu_main">
        <ul class="container-fluid class">
            <li><a href="{{ url('/') }}">商城首页</a></li>
            <li><a href="{{ url('/shop/goodcate') }}">商品分类</a></li>
            <li><a href="{{ url('/shop/cart') }}">购物车</a></li>
            <li><a href="{{ url('/user/center') }}">用户中心</a></li>
        </ul>
    </nav>
    <!-- footer -->
    <footer class="foot container-fluid text-center">
        <ul class="foot_nav">
            @foreach(App::make('tag')->cate(0,8) as $c)
            <li><a href="{{ url('cate',['url'=>$c->url]) }}">{{ $c->name }}</a></li>
            @endforeach
        </ul>
        <p>优鲜·吉鲜蜂</p>
    </footer>
    
    <!-- 提示信息 -->
    @if(session('message'))
    <div class="alert alert-info alert_shop" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ session('message') }}</p>
    </div>
    @endif
    <!-- 公用js文件 -->
    <script>
       var host = "{{ config('app.url') }}/";
    </script>
    <script src="{{ $sites['static']}}home/js/com.js"></script>

    <script id="__bs_script__">
        document.write("<script async src='http://www.xyshop.com:3000/browser-sync/browser-sync-client.js?v=2.18.8'><\/script>".replace("www.xyshop.com", location.hostname));
    </script>
</body>
</html>