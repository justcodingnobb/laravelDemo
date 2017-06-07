@extends('default.layout')


@section('title')

    <title>{{ $info->title }}</title>
    <meta name="keywords" content="{{ $info->keyword }}">
    <meta name="description" content="{{ $info->describe }}">
@endsection



<!-- 内容 -->
@section('content')
<link href="{{ $sites['static']}}home/css/star-rating.min.css" rel="stylesheet">
<script src="{{ $sites['static']}}home/js/star-rating.min.js"></script>

<section class="container-fluid good_content">
    <div class="good_top">
		<div class="good_thumb"><img src="{{ $info->thumb }}" class="img-responsive" alt="{{ $info->title }}"></div>
		<!-- 团购信息 -->
		<div class="bgf mt10">
			<p class="tuan_times label label-success">自 {{ $tuan->starttime }} 开始</p>
			<p class="tuan_times label label-danger">至 {{ $tuan->endtime }} 结束</p>
			<span class="label label-warning mt5">最少参团：{{ $tuan->nums }} 人</span>
			<span class="label label-primary mt5">已参加：{{ $tuan->havnums }} 人</span>
		</div>

		<div class="good_bgf">
			<div class="good_show">
				<h1 class="good_show_title"><a href="{{ url('shop/good',['id'=>$info->id]) }}">{{ $info->title }}</a></h1>
				<!-- <h4>{{ $info->pronums }}</h4> -->
				<form action="{{ url('shop/tuan/addorder') }}" class="form_addcart">
					{{ csrf_field() }}
					<!-- 价格、库存，购物车 -->
					<input type="hidden" value="{{ $tuan->prices }}" name="gp">
					<input type="hidden" value="{{ $tuan->id }}" name="tid">
					<div class="row price_store mt10">
						<div class="col-xs-6">价格：<del class="price color_l">{{ $info->price }}</del>￥</div>
						<div class="col-xs-6">团购格：<del class="price color_l">{{ $tuan->prices }}</del>￥</div>
						<div class="col-xs-6 text-left mt store">库存：{{ $tuan->store }}</div>
					</div>
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
					<input type="hidden" name="aid" class="aid" value="0">
					<input type="hidden" name="ziti" class="ziti" value="0">
					<input type="hidden" name="tt" value="{{ microtime(true) }}">
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
					<div class="col-xs-5 text-right">
						<input class="score_name" value="{{ $g->score }}" type="number" name="data[score]" readonly="readonly" data-size="xs">
					</div>
				</div>
				<h5 class="text-success text-nowarp">{{ $g->title }}</h5>
				<p>{{$g->content}}</p>
			</li>
			@endforeach
			<script>
            	$(function(){
            		$(".score_name").rating({displayOnly:true});
            	});
            </script>
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
	<botton class="alert_addcart tuan_addcart">立即参团</botton>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">选择送货方式</h4>
	      </div>
      	<div class="modal-body">
      		<!-- 送货地址 -->
      		<h3 class="h3_cate"><span class="h3_cate_span">配送至</span></h3>
      		<ul class="mt10">
      			@foreach($address as $y)
      			<li class="radio ship_li">
      			  <label>
      			    <input type="radio" name="addid" value="{{ $y->id }}" class="addressid">
      			    <h4>{{ $y->people }}：{{ $y->phone }}</h4>
      			    <p class="mt5">{{ $y->address }}</p>
      			  </label>
      			</li>
      			@endforeach
      		</ul>
      		
      		<!-- 自提点 -->
      		<h3 class="h3_cate"><span class="h3_cate_span">自提</span></h3>
      		<ul class="mt10">
      			@foreach($ziti as $y)
      			<li class="radio ship_li">
      			  <label>
      			    <input type="radio" name="ziti" value="{{ $y->id }}" class="zitiid">
      			    <h4>{{ $y->address }}</h4>
      			    <p class="mt5">{{ $y->phone }}</p>
      			  </label>
      			</li>
      			@endforeach
      		</ul>
      	</div>
    </div>
  </div>
</div>
<script>
	$(function(){
		$('.aid').val($('.addressid:checked').val());

		$('.addressid').change(function() {
			var aid = $(this).val();
			$('.aid').val(aid);
			var html = '<h3 class="h3_cate"><span class="h3_cate_span">送货至</span></h3>' + $(this).parent('label').parent('.ship_li').html();
			$('.ship').html(html);
			$('.form_addcart').submit();
		});

		$('.zitiid').change(function() {
			var aid = $(this).val();
			$('.ziti').val(aid);
			$('.aid').val(0);
			var html = '<h3 class="h3_cate"><span class="h3_cate_span">自提点</span></h3>' + $(this).parent('label').parent('.ship_li').html();
			$('.ship').html(html);
			$('.form_addcart').submit();
		});
	});
</script>
@endsection
