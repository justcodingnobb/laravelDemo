@extends('default.layout')

@section('title')
    <title>{{ $info->title }}</title>
    <meta name="keywords" content="{{ $info->keyword }}">
    <meta name="description" content="{{ $info->describe }}">
@endsection


@section('content')
	
	<!-- 高级栏目 -->
	<div class="container mt20 cate_list">
		<div class="row">
			@foreach(App::make('tag')->cate(0,4) as $c)
			<div class="col-xs-6 col-md-3">
				<a href="{{ url('/cate',['url'=>$c->url]) }}"><img src="{{ $c->thumb }}" class="img-responsive" alt="{{ $c->title }}"></a>
				<a href="{{ url('/cate',['url'=>$c->url]) }}" class="cate_list_a text-center center-block">{{ $c->name }}</a>
			</div>
			@endforeach
		</div>
	</div>
	
	<!-- 介绍+新闻 -->
	<div class="mt20 container">
		<div class="row">
			<div class="col-xs-12 col-md-4">
				<h3 class="h3_cate"><span class="h3_cate_span">关于我们</span><a href="{{ url('/cate',['url'=>cache('cateCache')['1']['url']]) }}" class="more">更多>></a></h3>
				<p>{{ cache('config')['content'] }}</p>
			</div>
			<div class="col-xs-12 col-md-4">
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
			<div class="col-xs-12 col-md-4">
				<h3 class="h3_cate"><span class="h3_cate_span">行业文摘</span><a href="{{ url('/cate',['url'=>cache('cateCache')['3']['url']]) }}" class="more">更多>></a></h3>
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
	<!-- 最新产品 -->
	<div class="mt20 container">
		<h3 class="h3_cate"><span class="h3_cate_span">最新产品</span><a href="{{ url('/cate',['url'=>cache('cateCache')['2']['url']]) }}" class="more">更多>></a></h3>
		<ul class="row list_pro">
			@foreach(App::make('tag')->arts(2,8) as $a)
			<li class="col-xs-6 col-md-3 overh">
				<a href="{{ url('/post',['url'=>$a->url]) }}"><img src="{{ $a->thumb }}" class="img-responsive" alt="{{ $a->title }}"></a>
				<a href="{{ url('/post',['url'=>$a->url]) }}" class="text-nowrap text-center list_pro_title center-block">{{ $a->title }}</a>
			</li>
			@endforeach
		</ul>
	</div>
@endsection