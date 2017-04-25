<!doctype html>
<html lang="zh-cn">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>{{ $info->title }}</title>
    <meta name="author" content="李潇喃：www.muzisheji.com" />
    <!-- IE最新兼容 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 国产浏览器高速/微信开发不要用 -->
    <meta name="renderer" content="webkit">
     
    <!-- 移动设备禁止缩放 -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="{{ $sites['static']}}reset.css">
    <script>
    function htmlFz(){var dpr, rem, f;var docEl = document.documentElement;var f = document.querySelector('html');rem = docEl.clientWidth > 750 ? 75 : (docEl.clientWidth / 10);window.onresize = function(){htmlFz();};f.style.fontSize = rem + 'px';}htmlFz();
    </script>
</head>

<body>
    @if(session('message'))
    <div class="alert">
        {{ session('message') }}
    </div>
    <script type="text/javascript">
        setTimeout(function(){
            document.querySelector('.alert').style.display = 'none';
        }, 2500);
    </script>
    @endif
   <div class="art_box">
        <h1 class="art_h1">{{ $info->title }}</h1>
        <div class="art_times_cate">{{ date('Y-m-d H:i:s',$info->inputtime) }} {{ $info->cate->name }}</div>
        <div class="art_con">
           {!! $info->content !!}
        </div>
        <div class="source">
            来源：<a href="{{ $info->url }}">{{ $info->source }}</a>
        </div>
        <div class="comments" id="comments">
            <h2 class="comment_h2"><span>评论 ({{ $info->comment->count() }})</span></h2>
            <ul class="list_comment">
            @foreach($info->comment as $c)
            <li>
                <h3 class="comment_h3">{{ $c->username }}</h3>
                <div class="times clearfix">
                    <span class="comment_times">{{ $c->date }}</span>
                    <!-- 判断是不是自己的评论，自己的显示删除，其它人的显示回复 -->
                    <a href="#">删除</a>
                    
                </div>
                <div class="comment_con">
                    <!-- 是不是回复的其它人的评论 -->
                    @if($c->touser == 1)
                    回复<span class="touser">@ {{ $c->tousername }}</span>
                    @endif
                    {{ $c->content }}
                </div>
            </li>
            @endforeach
            </ul>
        </div>
        <div class="fixed clearfix">
            <!-- 点击写评论 -->
            <a href="#" class="comment_input f-l">我想说两句..</a>
            <!-- 评论列表 -->
            <a href="#comments" class="f-l comments_btn pr"><span class="ps comments_font">{{ $info->comment->count() }}</span></a>
            <!-- 收藏，判断是否收藏过 -->
            <a href="#" class="favorites_btn f-l"></a>
            <!-- 复制链接 -->
            <span class="copylink_btn f-l">复制链接</span>
        </div>
   </div>
</body>

</html>