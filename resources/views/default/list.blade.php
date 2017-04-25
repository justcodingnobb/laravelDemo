@extends('layout')

@section('title')
    <title>{{ $info->title }}</title>
    <meta name="keywords" content="{{ $info->keyword }}">
    <meta name="description" content="{{ $info->describe }}">
@endsection


@section('content')
    <!-- banner -->
    <div class="banner container-fluid">
        <img src="{{ $sites['url'] }}{{ $sites['static']}}home/images/b_n.jpg" alt="" class="img-responsive">
    </div>

    <!-- 精彩案例 -->
    <section class="container-fluid jcal">
        <h2 class="text-center">{{ $info->name }}</h2>
        <h4 class="text-center">{{ $info->describe }}</h4>
        <ul class="news_con row">
            @foreach($list as $l)
            <li class="col-xs-12 col-sm-6 col-md-3">
                <p class="news_time">{{ $l->updated_at }}</p>
                <a href="{{ url('post',['url'=>$l->url]) }}" class="news_a_t"><img src="{{ $l->thumb }}" alt="{{ $l->title }}" class="img-thumbnail"></a>
                <h3><a href="{{ url('post',['url'=>$l->url]) }}" class="news_a_b">{{ $l->title }}</a></h3>
            </li>
            @endforeach
        </ul>
        <div class="pages">
            {!! $list->links() !!}
        </div>
    </section>


@endsection