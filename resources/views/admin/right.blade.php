<!doctype html>
<html lang="zh-cn">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>{{ cache('config')['sitename'] }}-右侧框架</title>
    <meta name="author" content="李潇喃：www.www.xi-yi.ren" />
    <!-- IE最新兼容 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 国产浏览器高速/微信开发不要用 -->
     <meta name="renderer" content="webkit">
     
    <!-- 移动设备禁止缩放 -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <!-- 上传用的 css -->
    <link rel="stylesheet" href="{{ $sites['static']}}admin/css/reset.css">
    <link rel="stylesheet" href="{{ $sites['static']}}common/kindeditor/themes/default/default.css">
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- 上传用的 js -->
    <script src="{{ $sites['static']}}common/kindeditor/kindeditor-all.js"></script>
    <script src="{{ $sites['static']}}common/kindeditor/lang/zh-CN.js"></script>
    <script src="{{ $sites['static']}}common/laydate/laydate.js"></script>
    <script src="{{ $sites['static']}}admin/js/com.js"></script>
</head>

<body>
    <div class="right_con">
        @if(session('message'))
        <div class="alert_top">
            {{ session('message') }}
        </div>
        @endif
        
        <!-- 右侧标题 -->
        <div class="clearfix">
            <h2 class="main_title btn btn-primary f-l">{{ $title }}</h2>
            <div class="btn-group f-l">
                @yield('rmenu')
            </div>
        </div>
        <div class="right-main mt10">
            @yield('content')
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $('div.alert_top').delay(1500).slideUp(300);
        })
    </script>
</body>

</html>