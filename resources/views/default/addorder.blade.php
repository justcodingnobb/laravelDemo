@extends('default.layout')


@section('title')
    <title>提交订单成功-希夷SHOP</title>
@endsection


@section('content')
	<div class="container mt20">
		<h3 class="h3_cate"><span class="h3_cate_span">添加购物车完成</span></h3>

		<a href="{{ url('shop/order/pay',['oid'=>$oid]) }}" class="btn btn-success">立即支付</a> <a href="{{ url('/') }}" class="btn btn-default">继续购物</a>

	</div>
@endsection