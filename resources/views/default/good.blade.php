@extends('default.layout')


@section('title')

    <title>{{ $info->title }}</title>
    <meta name="keywords" content="{{ $info->keyword }}">
    <meta name="description" content="{{ $info->describe }}">

@endsection



<!-- 内容 -->
@section('content')

<section class="container mt20">
	<ol class="breadcrumb">
        <li><a href="/">首页</a></li>
        {{ App::make('tag')->goodcatpos($info->cate_id) }}
    </ol>
    <div class="good_top">
		<div class="good_show row">
			<a href="{{ url('shop/good',['id'=>$info->id]) }}" class="col-xs-12 col-sm-3"><img src="{{ $info->thumb }}" class="img-responsive" alt="{{ $info->title }}"></a>
			<div class="col-xs-12 col-sm-9">
				<h1 class="good_show_title"><a href="{{ url('shop/good',['id'=>$info->id]) }}">{{ $info->title }}</a></h1>
				<!-- <h4>{{ $info->pronums }}</h4> -->
				
				@if ($formats->count() > 0)
				<!-- 属性 -->
				<div class="row">
					<div class="col-xs-12 sx_title"><h3><small>{{ $good_format->title }}</small></h3></div>
					@foreach($formats as $f)
					<div class="col-xs-3 col-sm-2 col-md-1"><a href="{{ url('shop/good',['id'=>$info->id,'format'=>$f->format]) }}" class="btn btn-sm btn-default @if($f->id == $good_format->id) btn-primary @endif">{{ $f->value }}</a></div>
					@endforeach
				</div>

				<!-- 价格、库存，购物车 -->
				<div class="row mt10">
					<div class="col-xs-12 col-sm-3">价格：<span class="price">{{ $good_format->price }}</span>￥</div>
					<div class="col-xs-12 col-sm-3">库存：<span class="store">{{ $good_format->store }}</span></div>
				</div>
				<input type="hidden" value="{{ $good_format->id }}" name="format_id">
				@else
				<!-- 价格、库存，购物车 -->
				<div class="row mt10">
					<div class="col-xs-12 col-sm-3">价格：<span class="price">{{ $info->price }}</span>￥</div>
					<div class="col-xs-12 col-sm-3">库存：<span class="store">10000</span></div>
				</div>
				@endif
				
				<!-- 加购物车 -->
				<div class="row mt10">
					<div class="col-xs-6 col-sm-2"><input type="number" value="1" class="form-control" class="nums"></div>
					<div class="col-xs-6 col-sm-2"><span class="add_cart btn btn-sm btn-success">加入购物车</span></div>
				</div>
			</div>
		</div>
	</div>

	
	
	
	<script>
		$(function(){
			$('.btn_attr').click(function(){
				var that = $(this);
				// 换属性class
				that.addClass('btn-primary').siblings('.btn_attr').removeClass('btn-primary');
				// 循环属性
				var format = '';
				$('.btn_attr_p').each(function(e){
					format += $(this).children('.btn-primary').attr('data-val') + '-';
				});
				format = format.substring(0,format.length -1);
				// 请求新的地址
				var url = "{{ url('shop/good',['id'=>$info->id]) }}" + '/' + format;
				that.attr('href',url).click();
			});
		})
	</script>

	<div class="good_show_con mt20">
		<h3 class="h3_cate"><span class="h3_cate_span">内容</span></h3>
		{!! $info->content !!}
	</div>
	<div class="good_show_con mt20">
		<h3 class="h3_cate"><span class="h3_cate_span">购买须知</span></h3>
		{!! $info->notice !!}
	</div>
	<div class="good_show_con mt20">
		<h3 class="h3_cate"><span class="h3_cate_span">规格包装</span></h3>
		{!! $info->pack !!}
	</div>

</section>










@endsection
