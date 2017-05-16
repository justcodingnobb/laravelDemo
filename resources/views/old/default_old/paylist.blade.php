@extends('default.layout')

@section('title')
    <title>选择支付方式-希夷SHOP</title>
@endsection



@section('content')
<section class="container mt20">
    <h3 class="h3_cate"><span class="h3_cate_span">订单情况</span></h3>
    <p>单号：<span class="text-info">{{ $order->order_id }}</span></p>
    <p>总价：<span class="text-success">￥ {{ $order->total_prices }}</span></p>


	<form action="{{ url('shop/order/pay',['oid'=>$order->id]) }}" method="post" class="pure-form">
	<h3 class="h3_cate"><span class="h3_cate_span">选择支付方式</span></h3>
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
		<button type="submit" class="btn btn-success">提交</button> 
		<button type="reset" name="reset" class="btn btn-default">重填</button>
	</div>
	</form>
</section>
@endsection
