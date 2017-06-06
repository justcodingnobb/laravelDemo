@extends('default.layout')


@section('title')

    <title>{{ $info->title }}</title>
    <meta name="keywords" content="{{ $info->keyword }}">
    <meta name="description" content="{{ $info->describe }}">

@endsection



<!-- 内容 -->
@section('content')

<section class="container-fluid good_content">
    <div class="good_top">
		<div class="good_thumb"><img src="{{ $info->thumb }}" class="img-responsive" alt="{{ $info->title }}"></div>
		<div class="good_bgf">
			<div class="good_show">
				<h1 class="good_show_title"><a href="{{ url('shop/good',['id'=>$info->id]) }}">{{ $info->title }}</a></h1>
				<!-- <h4>{{ $info->pronums }}</h4> -->
				<form action="{{ url('shop/addcart') }}" class="form_addcart">
					{{ csrf_field() }}
					@if ($formats->count() > 0)
					<!-- 属性 -->
					<div class="row">
						<div class="col-xs-12 sx_title"><h3><small>{{ $good_format->title }}</small></h3></div>
						@foreach($formats as $f)
						<div class="col-xs-3 col-sm-2 col-md-1"><a href="{{ url('shop/good',['id'=>$info->id,'format'=>$f->format]) }}" class="btn btn-sm btn-default @if($f->id == $good_format->id) btn-success @endif">{{ $f->value }}</a></div>
						@endforeach
					</div>

					<!-- 价格、库存，购物车 -->
					<div class="row price_store mt10">
						<div class="col-xs-6">价格：<span class="price color_l">{{ $good_format->price }}</span>￥</div>
						<div class="col-xs-6 mt5 text-right store">库存：{{ $good_format->store }}</div>
					</div>
					<input type="hidden" value="{{ $good_format->price }}" name="gp">
					<input type="hidden" value="{{ $good_format->id }}" name="fid">
					@else
					<!-- 价格、库存，购物车 -->
					<input type="hidden" value="{{ $info->price }}" name="gp">
					<input type="hidden" value="0" name="fid">
					<div class="row price_store mt10">
						<div class="col-xs-6">价格：<span class="price color_l">{{ $info->price }}</span>￥</div>
						<div class="col-xs-6 text-right mt store">库存：10000</div>
					</div>
					@endif

					<div class="row ship">
						<div class="col-xs-4">
							<span class="glyphicon glyphicon-home"></span>送至
						</div>
						<div class="col-xs-4 text-center">
							衡水市桃城区
						</div>
						<div class="col-xs-4 text-right">
							免运费
						</div>
					</div>

					
					<!-- 加购物车 -->
					<input type="hidden" value="{{ $info->id }}" name="gid">

					<input type="hidden" min="0" value="1" class="form-control cartnum" name="num">
				</form>
			</div>
		</div>
	</div>
	
	<!-- 店铺 -->
	<div class="shop_info">
		<div class="row">
			<div class="col-xs-3">
				<img src="{{ $sites['static']}}home/images/jxf_logo.png" class="img-responsive" alt="">
			</div>
			<div class="col-xs-9">
				<h5>吉鲜蜂</h5>
				<p class="color_l"><span class="glyphicon glyphicon-ok-sign"></span>微信认证</p>
			</div>
		</div>
		<div class="row mt10 text-center">
			<div class="col-xs-6">
				<a href="{{ url('/shop/goodcate') }}" class="shop_info_a"><span class="glyphicon glyphicon-fullscreen"></span>全部分类</a>
			</div>
			<div class="col-xs-6">
				<a href="{{ url('/') }}" class="shop_info_a"><span class="glyphicon glyphicon-user"></span>商家首页</a>
			</div>
		</div>
	</div>
	<!-- 商品详情 -->
	<div class="good_show_con mt10">
		{!! $info->content !!}
	</div>
	@if($info->notice != '')
	<div class="good_show_con mt10">
		{!! $info->notice !!}
	</div>
	@endif
	@if($info->pack != '')
	<div class="good_show_con mt10">
		<h3 class="h3_cate"><span class="h3_cate_span">规格包装</span></h3>
		{!! $info->pack !!}
	</div>
	@endif
	@if($goodcomment->count() > 0)
	<div class="good_show_con mt10">
		<h3 class="h3_cate"><span class="h3_cate_span">商品评价</span></h3>
		<ul class="list_goodcomment">
			@foreach($goodcomment as $g)
			<li class="clearfix">
				<div class="row">
					<div class="col-xs-7">
						@if($g->user->thumb)
						<img src="{{ $g->user->thumb }}" class="img-circle good_comment_img" alt="{{ $g->user->nickname }}">
						@else
						<img src="{{ $sites['static']}}home/images/jxf_logo.png" class="img-circle good_comment_img" alt="{{ $g->user->nickname }}">
						@endif
						{{ $g->user->nickname }}
					</div>
					<div class="col-xs-5 text-right text-danger">{{ $g->score }}</div>
				</div>
				<h5 class="text-success text-nowarp">{{ $g->title }}</h5>
				<p>{{$g->content}}</p>
			</li>
			@endforeach
		</ul>
	</div>
	@endif
</section>

<!-- 添加购物车 -->
<div class="good_alert clearfix navbar navbar-fixed-bottom">
	<a class="good_cart_nums pr" href="{{ url('shop/cart') }}">
		<span class="glyphicon glyphicon-shopping-cart"></span>
		<div class="good_alert_num ps"></div>
	</a>
	<botton class="alert_addcart">加入购物车</botton>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      	<h4>{{ $info->title }}</h4>
      	<div class=" clearfix mt10">
	      	<!-- 数量 -->
	        <div class="cart_nums clearfix pull-left">
				<div class="cart_dec">-</div>
				<div class="cart_num">1</div>
				<div class="cart_inc">+</div>
			</div>
			<div class="addcart btn btn-sm btn-success pull-right ml10">添加</div>
		</div>
      </div>
    </div>
  </div>
</div>

<div class="alert alert-success alert_good" style="display: none;" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <p>添加成功</p>
</div>
@endsection
