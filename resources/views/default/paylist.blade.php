@extends('default.pc.layout')

<!-- 内容 -->
@section('content')
<div class="wrap_home">
	<h3>订单情况</h3>
	<p>总价：￥ {{ $order->total_prices }}</p>
	<p>配送地址：{{ $order->address_id }}</p>
	<form action="{{ url('order/pay',['oid'=>$order->id]) }}" method="post" class="pure-form">
	<h3>选择支付方式</h3>
	{{ csrf_field() }}
	<ul class="list_good clearfix">
		@foreach($paylist as $l)
		<li class="pd10 pr">
			<input type="radio" name="pay" value="{{ $l->id }}">
			<img src="{{ $l->thumb }}" alt="">
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
