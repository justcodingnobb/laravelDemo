@extends('default.layout')


@section('title')
    <title>提交订单成功-吉鲜商城</title>
@endsection


@section('content')
	<div class="bgf text-center">
	    <h5 class="text-success mt20">提交订单成功</h5>
	    <p>单号：<span class="text-info">{{ $order->order_id }}</span></p>
	    <p>总价：<span class="text-danger">￥ {{ $order->total_prices }}</span></p>
	</div>

	<div class="bgf">
		<form action="{{ url('shop/order/pay',['oid'=>$order->id]) }}" method="post" class="pure-form">
		<h3 class="h3_cate"><span class="h3_cate_span">立即支付</span></h3>
		{{ csrf_field() }}
		<div class="row mt20">
			@foreach($paylist as $l)
			<div class="col-xs-12 col-sm-6 col-md-2">
				<label>
					<input type="radio" name="pay" value="{{ $l->id }}">
					<img src="{{ $l->thumb }}" alt="">
	  			</label>
			</div>
			@endforeach
		</div>
		<div class="mt20 clearfix">
			<a href="{{ url('/') }}" class="btn btn-default">继续购物</a>
			<button type="submit" class="btn btn-success">提交</button> 
		</div>
		</form>
	</div>

@include('default.foot')
@endsection