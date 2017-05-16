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
	

    <header class="head clearfix container-fluid">
    	<div class="row">
	        <div id="carousel" class="carousel slide" data-ride="carousel">
	            <!-- Indicators -->
	            <ol class="carousel-indicators">
	            @foreach(App::make('tag')->ad(2,5) as $k => $c)
	            <li data-target="#carousel" data-slide-to="{{ $k }}" class="@if($k == 0) active @endif"></li>
	            @endforeach
	            </ol>

	            <!-- Wrapper for slides -->
	            <div class="carousel-inner" role="listbox">
	            @foreach(App::make('tag')->ad(2,5) as $k => $c)
	            <div class="item @if($k == 0) active @endif">
	              <a href="{{ $c->url }}"><img src="{{ $c->thumb }}" alt="{{ $c->title }}"></a>
	            </div>
	            @endforeach
	            
	            </div>
	            <!-- Controls -->
	            <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
	            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	            <span class="sr-only">Previous</span>
	            </a>
	            <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
	            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	            <span class="sr-only">Next</span>
	            </a>
	        </div>
        </div>
    </header>
	
	<!-- 搜索 -->
	<section class="search container-fluid overh">
		<form action="#" class="form-inline mt10">
			<div class="row">
				<div class="col-xs-9">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search something">
					</div>
				</div>
				<div class="col-xs-3">
					<button type="submit" class="btn btn-success">Search</button>
				</div>
			</div>
		</form>
	</section>
	<!-- 主分类 -->
	<section class="container-fluid row goodcate">
		@foreach(App::make('tag')->goodcate(0,8) as $c)
		<div class="col-xs-3">
			<a href="{{ url('/shop/goodcate',['id'=>$c->id]) }}"><img src="{{ $c->thumb }}" alt="{{ $c->name }}" class="img-responsive"></a>
			<a href="{{ url('/shop/goodcate',['id'=>$c->id]) }}" class="mt5 db">{{ str_limit($c->name,10,'') }}</a>
		</div>
		@endforeach
	</section>

	<!-- 新品 -->
	<div class="container-fluid mt20 cate_list">
		<h2 class="t"><img src="{{ $sites['static']}}home/images/t1.jpg" class="img-responsive" alt=""></h2>
		<div class="row good_list">
			@foreach($news as $l)
			<div class="col-xs-4 col-sm-3">
				<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="good_thumb"><img src="{{ $l->thumb }}" class="img-responsive" alt=""></a>
				<div class="good_info clearfix">
					<h4 class="good_title"><a href="{{ url('/shop/good',['id'=>$l->id]) }}">{{ $l->title }}</a></h4>
					<strong class="good_pric color_2">￥ {{ $l->price }}</strong>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<!-- 新鲜蔬菜 -->
	<div class="container-fluid mt20 cate_list">
		<h2 class="t"><img src="{{ $sites['static']}}home/images/t2.jpg" class="img-responsive" alt=""></h2>
		<div class="row good_list">
			@foreach(App::make('tag')->good(1127,6) as $l)
			<div class="col-xs-4 col-sm-3">
				<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="good_thumb"><img src="{{ $l->thumb }}" class="img-responsive" alt=""></a>
				<div class="good_info clearfix">
					<h4 class="good_title"><a href="{{ url('/shop/good',['id'=>$l->id]) }}">{{ $l->title }}</a></h4>
					<strong class="good_pric color_2">￥ {{ $l->price }}</strong>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<!-- 新鲜水果 -->
	<div class="container-fluid mt20 cate_list">
		<h2 class="t"><img src="{{ $sites['static']}}home/images/t3.jpg" class="img-responsive" alt=""></h2>
		<div class="row good_list">
			@foreach(App::make('tag')->good(1126,6) as $l)
			<div class="col-xs-4 col-sm-3">
				<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="good_thumb"><img src="{{ $l->thumb }}" class="img-responsive" alt=""></a>
				<div class="good_info clearfix">
					<h4 class="good_title"><a href="{{ url('/shop/good',['id'=>$l->id]) }}">{{ $l->title }}</a></h4>
					<strong class="good_pric color_2">￥ {{ $l->price }}</strong>
				</div>
			</div>
			@endforeach
		</div>
	</div>

	<!-- 中广告 -->
	<section class="middle_ads container-fluid mt10">
		<div class="row">
			<div id="carousel2" class="carousel slide" data-ride="carousel">
	            <!-- Indicators -->
	            <ol class="carousel-indicators">
	            @foreach(App::make('tag')->ad(3,5) as $k => $c)
	            <li data-target="#carousel2" data-slide-to="{{ $k }}" class="@if($k == 0) active @endif"></li>
	            @endforeach
	            </ol>

	            <!-- Wrapper for slides -->
	            <div class="carousel-inner" role="listbox">
	            @foreach(App::make('tag')->ad(3,5) as $k => $c)
	            <div class="item @if($k == 0) active @endif">
	              <a href="{{ $c->url }}"><img src="{{ $c->thumb }}" alt="{{ $c->title }}"></a>
	            </div>
	            @endforeach
	            
	            </div>
	            <!-- Controls -->
	            <a class="left carousel-control" href="#carousel2" role="button" data-slide="prev">
	            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	            <span class="sr-only">Previous</span>
	            </a>
	            <a class="right carousel-control" href="#carousel2" role="button" data-slide="next">
	            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	            <span class="sr-only">Next</span>
	            </a>
	        </div>
	        <script>
	            $(function(){
	            	$("#carousel").carousel();
	            });
	        </script>
		</div>
	</section>
	
	<!-- 酒水饮料 -->
	<div class="container-fluid mt20 cate_list">
		<h2 class="t"><img src="{{ $sites['static']}}home/images/t4.jpg" class="img-responsive" alt=""></h2>
		<div class="row good_list">
			@foreach(App::make('tag')->good(1158,6) as $l)
			<div class="col-xs-4 col-sm-3">
				<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="good_thumb"><img src="{{ $l->thumb }}" class="img-responsive" alt=""></a>
				<div class="good_info clearfix">
					<h4 class="good_title"><a href="{{ url('/shop/good',['id'=>$l->id]) }}">{{ $l->title }}</a></h4>
					<strong class="good_pric color_2">￥ {{ $l->price }}</strong>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<!-- 大地农场系列	修改 -->
	<div class="container-fluid mt20 cate_list">
		<h2 class="t"><img src="{{ $sites['static']}}home/images/t5.jpg" class="img-responsive" alt=""></h2>
		<div class="row good_list">
			@foreach(App::make('tag')->good(1188,6) as $l)
			<div class="col-xs-4 col-sm-3">
				<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="good_thumb"><img src="{{ $l->thumb }}" class="img-responsive" alt=""></a>
				<div class="good_info clearfix">
					<h4 class="good_title"><a href="{{ url('/shop/good',['id'=>$l->id]) }}">{{ $l->title }}</a></h4>
					<strong class="good_pric color_2">￥ {{ $l->price }}</strong>
				</div>
			</div>
			@endforeach
		</div>
	</div>

@endsection