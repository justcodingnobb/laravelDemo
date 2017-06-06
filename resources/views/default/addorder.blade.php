@extends('default.layout')


@section('title')
    <title>提交订单成功-吉鲜商城</title>
@endsection


@section('content')
	<div class="container-fluid mt20 bgf">
		<h3 class="h3_cate"><span class="h3_cate_span">提交订单成功</span></h3>

		<a href="{{ url('shop/order/pay',['oid'=>$oid]) }}" class="btn btn-success mt10">立即支付</a> <a href="{{ url('/') }}" class="btn btn-default mt10">继续购物</a>

	</div>

@include('default.foot')
@endsection