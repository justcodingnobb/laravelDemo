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
    <section class="container-fluid mt30">
        <h2 class="text-center">{{ $info->title }}</h2>
        <h4 class="text-center">{{ $info->describe }}</h4>
        <div class="page_content mt30">
            {!! $info->content !!}
        </div>
    </section>


@endsection