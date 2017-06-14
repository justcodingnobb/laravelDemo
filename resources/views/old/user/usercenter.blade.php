@extends('default.layout')

@section('title')
    <title>会员中心-{{ cache('config')['sitename'] }}</title>
@endsection

@section('banner')
    @include('default.banner')
@endsection

@section('content')
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