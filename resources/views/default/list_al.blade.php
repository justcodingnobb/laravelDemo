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
        <div class="row jcal_list">
            @foreach($list as $c)
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                <a href="{{ url('post',['url'=>$c->url]) }}" class="jcal_a_t"><img src="{{ $c->thumb }}" alt="{{ $c->title }}" class="img-thumbnail"></a>
                <a href="{{ url('post',['url'=>$c->url]) }}" class="jcal_a_b text-nowrap">{{ $c->title }}</a>
            </div>
            @endforeach
        </div>
        <div class="pages">
            {!! $list->links() !!}
        </div>
    </section>


@endsection