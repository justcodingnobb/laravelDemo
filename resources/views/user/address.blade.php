@extends('default.layout')

@section('title')
    <title>收货地址-希夷SHOP</title>
@endsection

@section('banner')
    @include('default.banner')
@endsection

@section('content')
	<div class="container-fluid mt20">
		<a href="{{ url('user/order') }}" class="btn btn-sm btn-primary">我的订单</a>
		<a href="{{ url('user/yhq') }}" class="btn btn-sm btn-success">优惠券</a>
		<a href="{{ url('user/address') }}" class="btn btn-sm btn-info">收货地址</a>
	</div>

	<div class="container-fluid mt20">
		<a href="{{ url('user/address/add') }}" class="btn btn-sm btn-primary">添加地址</a>
	</div>

	<div class="container mt20">
		@foreach($list as $l)
		<div class="mt10">
			<h4>
			@if($l->default)
			<span class="bg-primary">默认</span>
			@endif
			{{ $l->address }}</h4>
			<p>{{ $l->people }}：{{ $l->phone }}</p>
			<a href="{{ url('user/address/edit',['id'=>$l->id]) }}" class="btn btn-sm btn-info">修改</a>
			<a href="{{ url('user/address/del',['id'=>$l->id]) }}" class="btn btn-sm btn-danger">删除</a>
		</div>
		@endforeach
	</div>
@endsection