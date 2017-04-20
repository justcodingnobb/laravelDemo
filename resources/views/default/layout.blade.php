<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    @yield('title')
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{ $sites['url'] }}{{ $sites['static']}}home/css/home.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- 导航 -->
    <nav class="navbar navbar-default navbar-fixed-top" id="nav_top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav_top_ul" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"><img src="{{ $sites['url'] }}{{ $sites['static']}}home/images/logo.png" alt=""></a>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right" id="nav_top_ul">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">首页 <span class="sr-only">(current)</span></a></li>
            @foreach(App::make('tag')->cate() as $c)
            <li><a href="{{ url('cate',['url'=>$c->url]) }}">{{ $c->name }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
    </nav>

    <!-- 主内容 -->
    @yield('content')

    <!-- 橙 -->
    <section class="container-fluid cheng hidden-xs">
        <div class="row">
            <div class="col-xs-6 col-sm-3 text-center">
                <p><span class="nums">10</span>年</p>
                <p>互联网品牌建设与营销经验</p>
            </div>
            <div class="col-xs-6 col-sm-3 text-center">
                <p><span class="nums">6</span>个</p>
                <p>分支机构</p>
            </div>
            <div class="col-xs-6 col-sm-3 text-center">
                <p><span class="nums">50</span>余人</p>
                <p>专业团队</p>
            </div>
            <div class="col-xs-6 col-sm-3 text-center">
                <p><span class="nums">100</span>家客户</p>
                <p>值得信赖的合作伙伴和服务商</p>
            </div>
        </div>
    </section>
    <!-- footer -->
    <footer class="foot container-fluid">
        <div class="row hidden-xs">
            <div class="col-sm-3 col-md-2">
                <img src="{{ $sites['url'] }}{{ $sites['static']}}home/images/logo_f.png" alt="">
                <img src="{{ $sites['url'] }}{{ $sites['static']}}home/images/ewm.png" class="ewm" alt="">
            </div>
            <div class="col-sm-3 col-md-2">
                <h4 class="h4_foot">案例</h4>
                <ul>
                    <li><a href="{{ url('cate',['url'=>'an-li']) }}">最新</a></li>
                    @foreach(App::make('tag')->cate(2) as $c)
                    <li><a href="{{ url('cate',['url'=>$c->url]) }}">{{ $c->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-3 col-md-2">
                <h4 class="h4_foot">团队</h4>
                <ul>
                    @foreach(App::make('tag')->arts(20) as $c)
                    <li><a href="{{ url('post',['url'=>$c->url]) }}">{{ $c->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-3 col-md-6">
                <h4 class="h4_foot">站点链接</h4>
                <ul class="links">
                    <li><a href="#">BJ20官网</a></li>
                    <li><a href="#">BJ20官网-手机版</a></li>
                    <li><a href="#">BJ20官网-预热</a></li>
                    <li><a href="#">阿尔及利亚车展响应式</a></li>
                    <li><a href="#">BJ20官网</a></li>
                    <li><a href="#">BJ20官网-手机版</a></li>
                    <li><a href="#">BJ20官网-预热</a></li>
                    <li><a href="#">BJ20官网-预热</a></li>
                    <li><a href="#">阿尔及利亚车展响应式</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <p>电话：<a href="tel:18231817521">18231817521</a> / <a href="tel:18932813211">18932813211</a> 邮编：053000 邮箱：yanLq@muzisheji.com /liZG@muzisheji .com QQ:65770598/854378082</p>
        <p>地址：河北省衡水市育才街永兴路口逸升佳苑29号楼1011</p>
        <hr>
        <p>CopyRight @ 2017-2020 xi-yi.ren Design,All Rights Reserved 备案号：冀ICP备15021375号</p>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>