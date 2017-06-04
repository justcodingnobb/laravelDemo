@extends('default.layout')

@section('title')
    <title>会员中心-吉鲜商城</title>
@endsection

@section('banner')
    @include('default.banner')
@endsection

@section('content')
	<div class="container-fluid mt20">
		<a href="{{ url('user/order') }}" class="btn btn-sm btn-primary">我的订单</a>
		<a href="{{ url('user/yhq') }}" class="btn btn-sm btn-success">优惠券</a>
		<a href="{{ url('user/address') }}" class="btn btn-sm btn-info">收货地址</a>
		<a href="{{ url('oauth/wx') }}" class="btn btn-sm btn-warning">绑定微信号</a>
	</div>

	<div class="container mt20">
		<table class="table table-striped">
			<tbody>
		        <tr>
		            <td width="80">用户名：</td>
		            <td>{{ $info->username }}</td>
		        </tr>
		        <tr>
		            <td>邮箱：</td>
		            <td>{{ $info->email }}</td>
		        </tr>
		        <tr>
		            <td>昵称：</td>
		            <td>{{ $info->nickname }}</td>
		        </tr>
		        <tr>
		            <td>电话：</td>
		            <td>{{ $info->phone }}</td>
		        </tr>
		        <tr>
		            <td>地址：</td>
		            <td>{{ $info->address }}</td>
		        </tr>
		        <tr>
		        	<td>操作：</td>
		        	<td><a href="/user/logout">退出登陆</a></td>
		        </tr>
	        </tbody>
		</table>
	</div>
@endsection