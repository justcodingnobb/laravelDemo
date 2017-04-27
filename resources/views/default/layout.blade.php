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
</head>

<body>
  

    <header class="head clearfix container">
        <div class="row">
            <h1 class="col-xs-6"><a class="logo-font" href="/">希夷</a></h1>
            <div class="dh text-right col-xs-6 hidden-xs hidden-sm">
                <p>客服电话：{{ cache('config')['phone'] }}</p>
            </div>
            <div class="col-xs-6">
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
                @foreach(App::make('tag')->cate() as $c)
                <li @if($info->pid == $c->id) class="active"@endif><a href="{{ url('cate',['url'=>$c->url]) }}">{{ $c->name }}</a></li>
                @endforeach
              </ul>
            </div>
        </nav>
    </div>

    <!-- banner -->
    <div class="banner jumbotron">
        <div class="b_img"></div>
    </div>

    <!-- 主内容 -->
    @yield('content')

    <!-- footer -->
    <footer class="foot container-fluid text-center">
        <p>电话：<a href="tel:{{ cache('config')['phone'] }}">{{ cache('config')['phone'] }}</a> 邮箱：{{ cache('config')['email'] }}</p>
        <p>{{ cache('config')['address'] }}</p>
        <p>CopyRight @ 2017-2020 xi-yi.ren Design,All Rights Reserved 备案号：冀ICP备15021375号</p>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="{{ $sites['static']}}home/js/com.js"></script>

    <script id="__bs_script__">
        document.write("<script async src='http://www.l54.com:3000/browser-sync/browser-sync-client.js?v=2.18.8'><\/script>".replace("www.l54.com", location.hostname));
    </script>
</body>
</html>