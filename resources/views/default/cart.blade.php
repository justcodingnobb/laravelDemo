@extends('default.pc.layout')

<!-- 内容 -->
@section('content')
<div class="wrap_home">
	<form action="{{ url('order') }}" method="post" class="pure-form">
	<h3>购物车</h3>
	{{ csrf_field() }}
	<ul class="list_good clearfix">
		@foreach($goodlists as $l)
		<li class="pd10 pr">
			<a href="{{ url('good',['id'=>$l->id]) }}" class="good_thumb pure-u-1-6 f-l mr10"><img src="{{ $l->thumb }}" alt=""></a>
			<div class="good_info clearfix">
				<h4 class="good_title"><a href="{{ url('good',['id'=>$l->id]) }}">{{ $l->title }}</a></h4>
				<p class="good_price">￥ <span class="good_prices">{{ $l->price }}</span></p>
				<span class="color-green good_nums">数量：<input type="number" name="num[]" value="{{ $l->num }}" class="pure-u-1-12 good_num"><input type="hidden" name="id[]" value="{{ $l->id }}"><input type="hidden" name="price[]" value="{{ $l->price }}"></span>
				<p class="total_prices">总价：￥ <span class="total_price">{{ $l->total_prices }}</span></p>
			</div>
			<span class="order_clear ps color-red curp" data-id="{{ $l->id }}">关闭</span>
		</li>
		@endforeach
	</ul>
	<div class="mt10 clearfix">
		<button type="reset" name="reset" class="pure-button pure-u-1-12 f-r">重填</button>
		<button type="submit" name="dosubmit" class="sub_1 pure-button pure-button-secondary pure-u-1-12 mr10 f-r">提交</button> 
	</div>
	</form>
</div>
@endsection
