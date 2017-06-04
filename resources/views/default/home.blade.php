@extends('default.layout')

@section('title')
    <title>{{ $info->title }}</title>
    <meta name="keywords" content="{{ $info->keyword }}">
    <meta name="description" content="{{ $info->describe }}">
@endsection


@section('content')
	

    <header class="head clearfix container-fluid">
    	<div class="row">
	        <div id="carousel" class="carousel slide" data-ride="carousel">
	            <!-- Indicators -->
	            <ol class="carousel-indicators">
	            @foreach(app('tag')->ad(2,5) as $k => $c)
	            <li data-target="#carousel" data-slide-to="{{ $k }}" class="@if($k == 0) active @endif"></li>
	            @endforeach
	            </ol>

	            <!-- Wrapper for slides -->
	            <div class="carousel-inner" role="listbox">
	            @foreach(app('tag')->ad(2,5) as $k => $c)
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
	        <script>
	            $(function(){
	            	$("#carousel").carousel();
	            });
	        </script>
        </div>
    </header>
	
	<!-- 搜索 -->
<!-- 	<section class="search container-fluid overh">
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
</section> -->
	<!-- 主分类 -->
	<section class="container-fluid mt10 row goodcate">
		@foreach(app('tag')->goodcate(0,8) as $c)
		<div class="col-xs-3 mt10">
			<a href="{{ url('/shop/goodcate',['id'=>$c->id]) }}" class="goodcate_img"><img src="{{ $c->thumb }}" alt="{{ $c->name }}" class="img-responsive"></a>
			<a href="{{ url('/shop/goodcate',['id'=>$c->id]) }}" class="mt5 db">{{ str_limit($c->name,10,'') }}</a>
		</div>
		@endforeach
	</section>

	<!-- 固定位广告 -->
	<div class="container-fluid mt20 cate_list">
		<h2 class="h_t"><img src="{{ $sites['static']}}home/images/t_1.png" class="img-responsive" alt=""></h2>
		<div class="row ad_pos">
			 @foreach(app('tag')->ad(3,3) as $k => $c)
            <div class="@if($k > 0) col-xs-7 @else col-xs-5  @endif @if($k == 2) mt5 @endif">
            	<a href="{{ $c->url }}"><img src="{{ $c->thumb }}" alt="{{ $c->title }}" class="img-responsive"></a>
            </div>
            @endforeach

		</div>
	</div>
	<!-- 新鲜蔬菜 -->
	<div class="container-fluid cate_list">
		<h2 class="h_t"><img src="{{ $sites['static']}}home/images/t_2.png" class="img-responsive" alt=""></h2>
		<div class="row good_list">
			@foreach(app('tag')->good(1127,6) as $l)
			<div class="col-xs-6 pr">
				<!-- 如果有标签，加标签 -->
				<div class="ps good_tag">
					<img src="{{ $sites['static']}}home/images/hot.png" class="img-responsive" alt="">
				</div>

				<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="good_thumb"><img src="{{ $l->thumb }}" class="img-responsive" alt=""></a>
				<div class="good_info clearfix">
					<h4 class="good_title text-nowarp"><a href="{{ url('/shop/good',['id'=>$l->id]) }}">{{ $l->title }}</a></h4>
					<div class="row">
						<div class="col-xs-9">
							<p class="good_pric">蜜蜂会员价：<strong class="good_pric_span color_2">￥{{ $l->price }}</strong></p>
							<p><span class="tags">限时</span><span class="tags">限量</span></p>
						</div>
						<div class="col-xs-3">
							<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="glyphicon glyphicon-shopping-cart addcart">
							</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<!-- 新鲜水果 -->
	<div class="container-fluid cate_list">
		<h2 class="h_t"><img src="{{ $sites['static']}}home/images/t_2.png" class="img-responsive" alt=""></h2>
		<div class="row good_list">
			@foreach(app('tag')->good(1126,6) as $l)
			<div class="col-xs-6">
				<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="good_thumb"><img src="{{ $l->thumb }}" class="img-responsive" alt=""></a>
				<div class="good_info clearfix">
					<h4 class="good_title text-nowarp"><a href="{{ url('/shop/good',['id'=>$l->id]) }}">{{ $l->title }}</a></h4>
					<div class="row">
						<div class="col-xs-9">
							<p class="good_pric">蜜蜂会员价：<strong class="good_pric_span color_2">￥{{ $l->price }}</strong></p>
							<p><span class="tags">限时</span><span class="tags">限量</span></p>
						</div>
						<div class="col-xs-3">
							<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="glyphicon glyphicon-shopping-cart addcart">
							</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	
	<!-- 酒水饮料 -->
	<div class="container-fluid cate_list">
		<h2 class="h_t"><img src="{{ $sites['static']}}home/images/t_2.png" class="img-responsive" alt=""></h2>
		<div class="row good_list">
			@foreach(app('tag')->good(1129,6) as $l)
			<div class="col-xs-6">
				<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="good_thumb"><img src="{{ $l->thumb }}" class="img-responsive" alt=""></a>
				<div class="good_info clearfix">
					<h4 class="good_title text-nowarp"><a href="{{ url('/shop/good',['id'=>$l->id]) }}">{{ $l->title }}</a></h4>
					<div class="row">
						<div class="col-xs-9">
							<p class="good_pric">蜜蜂会员价：<strong class="good_pric_span color_2">￥{{ $l->price }}</strong></p>
							<p><span class="tags">限时</span><span class="tags">限量</span></p>
						</div>
						<div class="col-xs-3">
							<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="glyphicon glyphicon-shopping-cart addcart">
							</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<!-- 大地农场系列	修改 -->
	<div class="container-fluid cate_list">
		<h2 class="h_t"><img src="{{ $sites['static']}}home/images/t_2.png" class="img-responsive" alt=""></h2>
		<div class="row good_list">
			@foreach(app('tag')->good(1188,6) as $l)
			<div class="col-xs-6">
				<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="good_thumb"><img src="{{ $l->thumb }}" class="img-responsive" alt=""></a>
				<div class="good_info clearfix">
					<h4 class="good_title text-nowarp"><a href="{{ url('/shop/good',['id'=>$l->id]) }}">{{ $l->title }}</a></h4>
					<div class="row">
						<div class="col-xs-9">
							<p class="good_pric">蜜蜂会员价：<strong class="good_pric_span color_2">￥{{ $l->price }}</strong></p>
							<p><span class="tags">限时</span><span class="tags">限量</span></p>
						</div>
						<div class="col-xs-3">
							<a href="{{ url('/shop/good',['id'=>$l->id]) }}" class="glyphicon glyphicon-shopping-cart addcart">
							</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>

@endsection