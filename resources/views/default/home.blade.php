@extends('default.layout')

@section('title')
    <title>{{ $info->title }}</title>
    <meta name="keywords" content="{{ $info->keyword }}">
    <meta name="description" content="{{ $info->describe }}">
@endsection

@section('banner')
	@include('default.banner')
@endsection

@section('content')
	
	<!-- 高级栏目 -->
	<div class="container mt20 cate_list">
		<div class="row good_list">
			@foreach(App::make('tag')->good('',12) as $l)
			<div class="col-xs-6 col-sm-4 col-md-3">
				<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="good_thumb"><img src="{{ $l->thumb }}" class="img-responsive" alt=""></a>
				<div class="good_info clearfix">
					<h4 class="good_title"><a href="{{ url('/shop/good',['id'=>$l->id]) }}">{{ $l->title }}</a></h4>
					<strong class="good_pric color_2">￥ {{ $l->price }}</strong>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	
	<!-- 介绍+新闻 -->
	<div class="mt20 container">
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<h3 class="h3_cate"><span class="h3_cate_span">关于我们</span><a href="{{ url('/cate',['url'=>cache('cateCache')['1']['url']]) }}" class="more">更多>></a></h3>
				<p>{{ cache('config')['content'] }}</p>
			</div>
			<div class="col-xs-12 col-md-6">
				<h3 class="h3_cate"><span class="h3_cate_span">新闻资讯</span><a href="{{ url('/cate',['url'=>cache('cateCache')['3']['url']]) }}" class="more">更多>></a></h3>
				<ul class="list_news">
					@foreach(App::make('tag')->arts(3,5) as $a)
					@if($loop->first)
					<li>
						<h4><a href="{{ url('/post',['url'=>$a->url]) }}" class="text-nowrap list_news_title">{{ $a->title }}</a><span class="list_news_time">{{ $a->
					updated_at->format('Y-m-d') }}</span></h4>
						<p>{{ substr($a->describe,'0','135') }}..</p>
					</li>
					@else
					<li><a href="{{ url('/post',['url'=>$a->url]) }}" class="text-nowrap list_news_title">{{ $a->title }}</a><span class="list_news_time">{{ $a->
					updated_at->format('Y-m-d') }}</span></li>
					@endif
					@endforeach
				</ul>
			</div>
		</div>
	</div>
@endsection