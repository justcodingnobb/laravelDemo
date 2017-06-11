@extends('default.layout')


@section('title')
    <title>购物车-吉鲜商城</title>
@endsection


@section('content')
	
	<div class="cart_empty">
		<img src="{{ $sites['static']}}home/images/cart_empty.png" width="142.5px" class="img-responsive center-block" alt="">
	</div>


	@include('default.foot')
@endsection