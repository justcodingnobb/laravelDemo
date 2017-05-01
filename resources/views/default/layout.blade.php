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

  
    <div class="top_font hidden-xs hidden-sm">
        <div class="container clearfix">
            <p class="pull-left">欢迎访问，希夷商城系统！</p>
            <p class="pull-right">客服电话：<span class="color_2">{{ cache('config')['phone'] }}</span></p>
        </div>
    </div>

    <header class="head clearfix container">
        <div class="row">
            <h1 class="col-xs-4 col-sm-4 col-md-6"><a class="logo-font" href="/"><span class="color_1">希夷</span><span class="color_2 hidden-xs">SHOP</span></a></h1>
            <div class="text-right col-xs-4 col-sm-4 col-md-6 user_info">
                @if(!session()->has('member'))
                <a href="{{ url('user/login') }}">登陆</a>，<a href="{{ url('oauth/wxlogin') }}">扫码登陆</a>，<a href="{{ url('oauth/wx') }}">微信号登陆</a> | <a href="{{ url('user/register') }}">注册</a>，
                @else
                欢迎 <a href="{{ url('user/center') }}" class="color_2">@if(session('member')->nickname != ''){{ session('member')->nickname }}@else {{ session('member')->username }}@endif </a> 回来，<a href="{{ url('shop/order') }}">我的订单</a>，
                @endif
                <a href="{{ url('shop/cart') }}">购物车(<span class="color_2 cart_nums">0</span>)</a>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-6">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav_top_ul" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
        </div>
    </header>
    <!-- 导航 -->
    <div id="nav_top">
        <nav class="container">
            <div class="collapse navbar-collapse" id="nav_top_ul">
              <ul class="nav navbar-nav">
                <li @if($info->pid == 0) class="active"@endif><a href="/">首页</a></li>
                @foreach(App::make('tag')->goodcate(0) as $m)
                <li @if($info->pid == $m->id) class="active"@endif><a href="{{ url('/shop/cate',$m->id) }}">{{ $m->name }}</a></li>
                @endforeach
                <li class="active"><a href="https://github.com/freedomlizhigang/laravelDemo/tree/xyshop" target="_blank">Github</a></li>
              </ul>
            </div>
        </nav>
    </div>

    <!-- banner -->
    @yield('banner')

    <!-- 主内容 -->
    @yield('content')

    <!-- footer -->
    <footer class="foot container-fluid text-center">
        <ul class="foot_nav">
            @foreach(App::make('tag')->cate(0,8) as $c)
            <li><a href="{{ url('cate',['url'=>$c->url]) }}">{{ $c->name }}</a></li>
            @endforeach
        </ul>
        <p>电话：<a href="tel:{{ cache('config')['phone'] }}">{{ cache('config')['phone'] }}</a> 邮箱：{{ cache('config')['email'] }}</p>
        <p>{{ cache('config')['address'] }}</p>
        <p>CopyRight @ 2017-2020 xi-yi.ren Design,All Rights Reserved 备案号：冀ICP备15021375号</p>
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